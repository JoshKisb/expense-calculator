<?php 

namespace App;

use System\Middleware\CorsMiddleware;
use System\Middleware\SessionMiddleware;

class Middlewares {

   public static $middlewares = [
      SessionMiddleware::class,
      CorsMiddleware::class,
   ];
}