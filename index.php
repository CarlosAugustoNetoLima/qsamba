<?php

// Front Controller — routes all requests to the appropriate controller

define('BASE_PATH', __DIR__);

require_once BASE_PATH . '/app/controllers/HomeController.php';

// Simple router: for now all requests go to HomeController@index
$controller = new HomeController();
$controller->index();
