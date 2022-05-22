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

   public function addExpenses(array $expenses = [])
   {
      foreach ($expenses as $expense) {
         $this->addExpense($expense);
      }
   }

   public function addExpense(Expense $expense)
   {
      $this->expenses[] = $expense;
      $category = $expense->getCategory();
      $total = $expense->getTotal();
      $this->categories[$category] = $total;
   }

   public function getCategories()
   {
      return $this->categories;
   }
}