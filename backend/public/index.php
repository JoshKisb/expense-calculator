<?php

require "../vendor/autoload.php";

use System\Application;

$app = Application::getInstance();

// register routes
$app->registerRoutes();

echo $app->handleRequest();