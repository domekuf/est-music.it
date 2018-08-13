<?php

define("APP_ROUTES", "app.php");
define("APP_ENTRY", "home");
function RT_generate() {
    $rt = "//".$_SERVER["SERVER_NAME"];
    $req = explode("/", $_SERVER["REQUEST_URI"]);
    foreach ($req as $r) {
        if ($r == APP_ROUTES)
            break;
        if ($r == "")
            continue;
        $rt .= "/$r";
    }
    return $rt;
}
define("AB", getcwd());
define("RT", RT_generate());
define("BS", "vendor/twbs/bootstrap/dist");
define("JQ", "vendor/components/jquery");
define("FA", "vendor/components/font-awesome");
define("DB", "database/db");
define("TITLE", "est-music.it");

