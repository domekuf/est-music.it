<?php
require __DIR__ . '/vendor/autoload.php';
require __DIR__ . '/controller-news.php'; /* ControllerNews */
require __DIR__ . '/controller-est.php'; /* ControllerEst */

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

$registered_routes = [
    ["name" => "home"],
    ["name" => "est", "controller" => ControllerEst, "action" => "index"],
    ["name" => "video"],
    ["name" => "news", "controller" => ControllerNews, "action" => "index"],
    ["name" => "contacts"],
    ["name" => "est play mozart"]
];

function createNav($_this) {
    global $registered_routes;
    $nav = [];
    foreach ($registered_routes as $r) {
        $n = $r["name"];
        $nav[] = [
            "name"=>$n,
            "link"=>$_this->router->pathFor($n)
        ];
    }
    return $nav;
}

function asset($filename) {
    return RT."/$filename?v=".md5_file(AB."/$filename");
}

function social() {
    $social = [];
    $social[] = [
        "link" => "https://www.facebook.com/electricstringtrio",
        "icon" => "facebook"
    ];
    $social[] = [
        "link" => "https://www.instagram.com/est_musicproject",
        "icon" => "instagram"
    ];
    $social[] = [
        "link" => "https://www.youtube.com/channel/UCdY0dNJEseVizErYPH3kfyA",
        "icon" => "youtube"
    ];
    $social[] = [
        "link" => "https://itunes.apple.com/it/album/est-play-mozart-arr-for-jazz-trio/1364427290",
        "icon" => "music"
    ];
    return $social;
}

foreach ($registered_routes as $r) {
	$n = $r["name"];
	$n_=str_replace(' ', '-', $n);
    $controller = $r["controller"];
    $action = $r["action"];
    $routes->get("/$n_", function ($request, $response, $args) use($n, $n_, $controller, $action) {
        if (isset($controller) && isset($action)) {
            $args[$n] = $controller::$action($request, $response, $args);
        }
        $args["nav"] = createNav($this);
        $args["title"] = " | $n";
        $args["social"] = social();
        $args["css"] = [];
        $args["css"][] = asset(BS."/css/bootstrap.min.css");
        $args["css"][] = asset(FA."/css/font-awesome.min.css");
        $args["css"][] = asset("css/main.css");
        $args["css"][] = asset("css/first-letter.css");
        $args["js"] = [];
        $args["js"][] = asset(JQ."/jquery.min.js");
        $args["js"][] = asset(BS."/js/bootstrap.bundle.min.js");
        $args["js"][] = asset("js/main.js");

        $this->renderer->render($response, "/head.php", $args);
        $this->renderer->render($response, "/$n_.php", $args);
        $this->renderer->render($response, "/foot.php", $args);
        return;
    })->setName($n);
}

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
