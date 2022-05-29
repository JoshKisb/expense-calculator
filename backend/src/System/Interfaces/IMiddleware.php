<?php 

namespace System\Interfaces;

use System\Request;

interface IMiddleware {
   public function handle(Request $request);
}