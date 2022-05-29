<?php

namespace System;

use System\Request;

class Router {

   protected $routes;

   public function resolve(Request $request)
   {
      $method = $request->getMethod();
      $path = $request->getPath();

      return $this->routes[$method][$path] ?? false;
   }

   public function get($path, $action)
   {
      $this->routes['get'][$path] = $action;
   }

   public function post($path, $action)
   {
      $this->routes['post'][$path] = $action;
   }
}