<?php

namespace App;

use App\Controllers\UploadController;
use System\Application;

$app = Application::getInstance();

$app->router->get('/', function() {
   return "Hello from custom framework";
});

$app->router->get('/upload', [UploadController::class, 'index']);