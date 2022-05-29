<?php 

namespace System\Middleware;

use System\Interfaces\IMiddleware;
use System\Request;

class CorsMiddleware implements IMiddleware {

   public function handle(Request $request)
   {
      header("Access-Control-Allow-Origin: *");
   }

}