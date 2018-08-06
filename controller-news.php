<?php
require_once __DIR__ . '/model-fb-feed.php'; /* FbFeed */

class ControllerNews
{
    static public function index($request, $response, $args) {
        $fb_feed = FbFeed::get('electricstringtrio/feed?limit=30&fields=message,created_time');
        $fb_feed_filtered = [];
        foreach($fb_feed["data"] as $d) {
            if (!isset($d["message"])) {
                continue;
            }
            if (strpos($d["message"], '#est') !== false) {
                $fb_feed_filtered[] = $d;
            }
        }
        return $fb_feed_filtered;
    }
}
