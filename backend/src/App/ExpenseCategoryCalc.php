<?php 

namespace App;

class ExpenseCategoryCalc {

   private $expenses;
   private $categories;

   public function __construct()
   {
      $this->expenses = [];
      $this->categories = [];
   }

   public function addExpenses(Array $expenses = [])
   {
      foreach ($expenses as $expense) {
         $this->addExpense($expense);
      }
   }

   public function addExpense(Array $expense)
   {
      $this->expenses[] = $expense;
      $this->categories[] = $expense;
   }

   public function getCategories()
   {
      return $this->categories;
   }
}