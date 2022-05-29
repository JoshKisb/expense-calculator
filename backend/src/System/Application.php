<?php 

namespace System;

use Exception;
use System\Interfaces\IMiddleware;

class Application {

   // its a singleton
   private static $instance = null;

   public Router $router;

   public Request $request;

   private function __construct()
   {
      $this->router = new Router();
      $this->request = Request::create();
   }

   public static function getInstance()
   {
      if (self::$instance == null)
      {
         self::$instance = new static();
      }
      return self::$instance;
   }

   public function registerRoutes()
   {
      if (file_exists(__DIR__.'/../App/routes.php'))
         require __DIR__.'/../App/routes.php';
   }


   public function handleRequest()
   {
      $this->applyMiddlewares();
      $callback = $this->router->resolve($this->request);

      if ($callback === false)
         return "404: Not Found";

      if (is_callable($callback))
         return call_user_func($callback, $this->request);
      else if (is_array($callback)) {
         if (!method_exists($callback[0], $callback[1])) {
            throw new Exception("No method {$callback[1]} on class {$callback[0]}");
         }
         $controller = new $callback[0];
         return $controller->$callback[1]($this->request);
      }
   }

   protected function applyMiddlewares()
   {
      if (class_exists(\App\Middlewares::class)) {
         $middlewares = \App\Middlewares::$middlewares ?? [];

         foreach ($middlewares as $middleware) {
            if (class_exists($middleware))
               $this->applyMiddleware(new $middleware);
         }
      }
   }

   protected function applyMiddleware(IMiddleware $middleware)
   {
      $middleware->handle($this->request);
   }
}