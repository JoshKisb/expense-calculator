<?php

namespace App;

use App\Controllers\HistoryController;
use App\Controllers\UploadController;
use System\Application;

$app = Application::getInstance();

$app->router->get('/', function() {
   return "Hello from custom framework";
});

$app->router->post('/upload', [UploadController::class, 'upload']);

// Wanted to have some sort of history
// based on sessions.
// but cannot really do that cross domain
// and all solutions i can think of would take too much wor.. time
$app->router->get('/history', [HistoryController::class, 'index']);