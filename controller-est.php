<?php
require_once __DIR__ . '/model-curriculum.php'; /* Curriculum */

class ControllerEst
{
    static public function index($request, $response, $args) {
        return Curriculum::get();
    }
}
