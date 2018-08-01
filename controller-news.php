<?php
require_once __DIR__ . '/model-fb-feed.php'; /* FbFeed */

class ControllerNews
{
    static public function index($request, $response, $args) {
        return FbFeed::get('electricstringtrio/feed?limit=15&fields=message,created_time'/*,full_picture,created_time,permalink_url'*/);
    }
}
