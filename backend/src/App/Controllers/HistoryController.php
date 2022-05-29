<?php 

namespace App\Controllers;

use System\Controller;
use System\Request;
use System\Response;

class HistoryController extends Controller {

   public function index()
   {
      $results = $_SESSION['results'] ?? [];
      return Response::json(array_keys($results));
   }

   public function show(Request $request, $key)
   {
      $results = $_SESSION['results'] ?? [];
      $result = $results[$key] ?? [];
      return Response::json(["categories" => $result]);
   }
}