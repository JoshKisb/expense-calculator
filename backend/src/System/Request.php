<?php 

namespace System;

class Request {

   protected $path;
   protected $method;
   protected $query;

   protected function __construct($path, $method, $query)
   {
      $this->path = $path;
      $this->method = $method;
      $this->query = $query;
   }

   public function getMethod()
   {
      return $this->method;
   }

   public function getPath()
   {
      return $this->path;
   }

   public static function create()
   {
      $uri = $_SERVER["REQUEST_URI"] ?? '/';
      $method = strtolower($_SERVER["REQUEST_METHOD"]);
      $queryStr = $_SERVER["QUERY_STRING"] ?? "";

      parse_str($queryStr, $query);
      $path = explode("?", $uri, 2)[0];

      return new self($path, $method, $query);
   }
}