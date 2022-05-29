<?php 

namespace System\Middleware;

use System\Interfaces\IMiddleware;
use System\Request;

class SessionMiddleware implements IMiddleware {

   public function handle(Request $request)
   {
      if (session_status() === PHP_SESSION_NONE) {
         session_start();
     }
   }

}