<?php 

namespace App;

class Expense {
   
   private $category;
   private $price;
   private $quantity;

   public function __construct(string $category, float $price, int $quantity)
   {
      $this->category = $category;
      $this->price = $price;
      $this->quantity = $quantity;
   }

   public function getTotal(): float
   {
      return $this->price * $this->quantity;
   }

   public function getCategory(): string
   {
      return $this->category;
   }
}