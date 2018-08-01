<?php
require __DIR__ . '/vendor/autoload.php';
require __DIR__ . '/controller-news.php'; /* ControllerNews */

include ('config.php');

use Slim\Views\PhpRenderer;
use Slim\Flash\Messages;

$db = new PDO("sqlite:".DB);
$routes = new Slim\App();
$container = $routes->getContainer();
$container['renderer'] = new PhpRenderer("./view");
$container['flash'] = function () {
    return new Messages();
};

session_start();

function flash($t) {
    $messages = $t->flash->getMessages();
    if ($messages) {
        $flash["title"] = $messages["error"][0]["title"];
        $flash["content"] = $messages["error"][0]["content"];
    }
    return $flash;
}

function cookieGet($request, $cookieName) {
    $cookieName = urldecode($cookieName);
    return urldecode($request->getCookieParam($cookieName));
}

function cookieSet(&$response, $cookieName, $cookieValue) {
    $expirationMinutes = 10;
    $expiry = new \DateTimeImmutable('now + '.$expirationMinutes.'minutes');
    $cookie = urlencode($cookieName).'='.
    urlencode($cookieValue).'; expires='.$expiry->format(\DateTime::COOKIE).'; Max-Age=' .
    $expirationMinutes * 60 . '; path=/;';
    $response = $response->withAddedHeader('Set-Cookie', $cookie);
}

function isAuthenticated(&$user_id, &$username) {
    global $db, $container;
    $request = $container->request;
    $username = trim($request->getParsedBody()["username"]);
    if (!isset($username) || $username == "") {
        $username = cookieGet($request, "username");
    }
    $res = $db->query("select * from users where email like '$username'");
    while ($row = $res->fetch(\PDO::FETCH_ASSOC)){
        $user_id = $row["id"];
    }
    return isset($user_id);
}

function authenticate(&$response, $username) {
    cookieSet($response, "username", $username);
}

function createNav($t, $user_id) {
    $pages = [
        "Home" => ["home", []],
        "Page1" => ["page-1", ["user_id" => $user_id]],
        "Page2" => ["page-2", []]
    ];
    $nav = [];
    foreach ($pages as $k=>$p) {
        $nav[] = [
            "label"=>$k,
            "link"=>$t->router->pathFor($p[0], $p[1])
        ];
    }
    return $nav;
}

$routes->get('/home', function ($request, $response, $args) {
    $args["flash"] = flash($this);
    $args["test"] = ["abc", "bdf"];
    return $this->renderer->render($response, '/home.php', $args);
})->setName("home");

$routes->get('/news', function ($request, $response, $args) {
    $args["flash"] = flash($this);
    $args["news"] = ControllerNews::index($request, $response, $args);
    return $this->renderer->render($response, '/news.php', $args);
})->setName("news");

$routes->any('/page-1', function ($request, $response, $args) {
    $args["flash"] = flash($this);
    return $this->renderer->render($response, '/page-1.php', $args);
})->setName("page-1");

$routes->any('/page-2', function ($request, $response, $args) {
    $args["flash"] = flash($this);
    return $this->renderer->render($response, '/page-2.php', $args);
})->setName("page-2");

$routes->any('/wip', function ($request, $response, $args) {
    $args["flash"] = flash($this);
    return $this->renderer->render($response, '/wip.php', $args);
})->setName("wip");

$routes->any('/private', function ($request, $response, $args) {
    if (!isAuthenticated($user_id, $username)) {
        $this->flash->addMessage("error", [
            "title" => "Login failed",
            "content" => "User $username not found. Psst, try with user@company.com"
        ]);
        return $response->withRedirect($this->router->pathFor('login'));
    }
    authenticate($response, $username);
    $args["flash"] = flash($this);
    return $this->renderer->render($response, '/private.php', $args);
})->setName("private");

$routes->get('/login', function ($request, $response, $args) {
    $args["flash"] = flash($this);
    return $this->renderer->render($response, '/login.php', $args);
})->setName("login");

$routes->run();

/*
This section doesn't belong to this project and it is here only for reference, should be deleted asap

$routes->any('/review', function ($request, $response, $args) {
    global $db, $container, $nav;
    if (!isAuthenticated($user_id, $username)) {
        $this->flash->addMessage("error", [
            "title" => "Login failed",
            "content" => "User $username not found. Psst, try with user@company.com"
        ]);
        return $response->withRedirect($this->router->pathFor('login'));
    }
    authenticate($response, $username);
    $args["user_id"] = $user_id;
    $args["nav"] = createNav($this, $user_id);
    $employees = $db->query("select * from employees");
    while ($row = $employees->fetch(\PDO::FETCH_ASSOC)) {
            $args["employees"][] = [
                    "id" => $row["id"],
                    "name" => $row["name"]
            ];
    }
    return $this->renderer->render($response, '/review.php', $args);
})->setName("review");

$routes->post('/submit', function ($request, $response, $args) {
    global $db;
    if (!isAuthenticated($user_id, $username)) {
        $this->flash->addMessage("error", [
            "title" => "Authentication failed",
            "content" => "Please login again."
        ]);
        return $response->withRedirect($this->router->pathFor('login'));
    }
    $args["nav"] = createNav($this, $user_id);
    $b = $request->getParsedBody();
    $res = $db->query("select count(*) c from reviews where user = ".$b["user-id"]." and employee = ".$b["employee-id"]);
    while ($row = $res->fetch(\PDO::FETCH_ASSOC)){
        $count_before = $row["c"];
    }
    $res = $db->query("insert
        into reviews (user, employee, content, rate)
        values (".$b["user-id"].", ".$b["employee-id"].", '".urlencode($b["review-text"])."', ".$b["review-rate"].")");
    $res = $db->query("select count(*) c from reviews where user = ".$b["user-id"]." and employee = ".$b["employee-id"]);
    while ($row = $res->fetch(\PDO::FETCH_ASSOC)){
        $count_after = $row["c"];
    }
    if ($count_before + 1 == $count_after) {
        $res = $db->query("select * from reviews r join employees e on r.employee = e.id where r.id = (select max(id) from reviews)");
        while ($row = $res->fetch(\PDO::FETCH_ASSOC)){
            $args["name"] = $row["name"];
            $args["rate"] = $row["rate"];
            $args["content"] = urldecode($row["content"]);
            return $this->renderer->render($response, '/submit.php', $args);
        }
    } else {
        return $this->renderer->render($response, '/error.php', $args);
    }
})->setName("submit");;

$routes->get('/review-history/{user_id}', function($request, $response, $args) {
    global $db;
    $user_id = $args["user_id"];
    $args["nav"] = createNav($this, $user_id);
    $res = $db->query("select * from reviews join employees e on (employee=e.id) where user=".$user_id);
    while ($row = $res->fetch(\PDO::FETCH_ASSOC)) {
        $args["reviews"][] = [
            "name" => $row["name"],
            "content" => urldecode($row["content"]),
            "rate" => $row["rate"]
        ];
    }
    return $this->renderer->render($response, '/review-history.php', $args);
})->setName("review-history");

$routes->get('/employees', function($request, $response, $args) {
    global $db;
    if (!isAuthenticated($user_id, $username)) {
        $this->flash->addMessage("error", [
            "title" => "Login failed",
            "content" => "User $username not found. Psst, try with user@company.com"
        ]);
        return $response->withRedirect($this->router->pathFor('login'));
    }
    $args["nav"] = createNav($this, $user_id);
    $employees = $db->query("select * from employees");
    while ($row = $employees->fetch(\PDO::FETCH_ASSOC)) {
            $args["employees"][] = [
                    "link" => $this->router->pathFor('employee', ["employee_id" => $row["id"]]),
                    "name" => $row["name"]
            ];
    }
    return $this->renderer->render($response, '/employees.php', $args);
})->setName("employees");

$routes->get('/employees/{employee_id}', function($request, $response, $args) {
    global $db;
    if (!isAuthenticated($user_id, $username)) {
        $this->flash->addMessage("error", [
            "title" => "Login failed",
            "content" => "User $username not found. Psst, try with user@company.com"
        ]);
        return $response->withRedirect($this->router->pathFor('login'));
    }
    $args["nav"] = createNav($this, $user_id);
    $res = $db->query("select name from employees where id=".$args["employee_id"]);
    while ($row = $res->fetch(\PDO::FETCH_ASSOC)) {
        $args["name"] = $row["name"];
        $res = $db->query("select * from reviews where employee=".$args["employee_id"]);
        while ($row = $res->fetch(\PDO::FETCH_ASSOC)) {
            $args["reviews"][] = [
                "content" => urldecode($row["content"]),
                "rate" => $row["rate"]
            ];
        }
        return $this->renderer->render($response, '/employees%{employee_id}.php', $args);
    }
    return $this->renderer->render($response, '/error.php', $args);
})->setName("employee");
*/
