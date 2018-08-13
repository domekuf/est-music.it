<?php
require_once __DIR__ . '/model-fb-feed.php'; /* FbFeed */

class ControllerEst
{
    static public function index($request, $response, $args) {
        $fb_feed = FbFeed::get('electricstringtrio?fields=bio');
        $fb_feed["data"] = json_decode(str_replace("\\n", "<br/>", json_encode($fb_feed["bio"])));
        return $fb_feed;
    }
}
