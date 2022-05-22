<?php

use App\Expense;
use App\ExpenseCategoryCalc;
use PHPUnit\Framework\TestCase;

class ExpenseCategoryCalcTest extends TestCase
{

   private $calc;

   protected function setUp(): void
   {
      $this->calc = new ExpenseCategoryCalc();
   }

   protected function tearDown(): void
   {
      $this->calc = null;
   }

   public function testEmptyInputReturnsEmptyArray()
   {
      $this->calc->addExpenses([]);
      $this->assertSame($this->calc->getCategories(), []);
   }

   public function testSingleExpenseReturnsSingleCategory()
   {
      $expense = new Expense("Food", 100, 2);
      $this->calc->addExpense($expense);
      $this->assertSame(
         $this->calc->getCategories(),
         ["Food" => 200.0]
      );
   }

   public function testMultipleExpensesReturnValidCategories()
   {
      $this->calc->addExpense(new Expense("Food", 100, 2));
      $this->calc->addExpense(new Expense("Hotel", 400, 1));
      $this->calc->addExpense(new Expense("Fuel", 60.2, 5));
      $this->assertSame(
         $this->calc->getCategories(),
         ["Food" => 200.0, "Hotel" => 400.0, "Fuel" => 301.0]
      );
   }

   public function testMultipleExpensesInCategoriesReturnValidCategories()
   {
      $this->calc->addExpense(new Expense("Food", 100, 2));
      $this->calc->addExpense(new Expense("Food", 400, 1));
      $this->calc->addExpense(new Expense("Fuel", 60.2, 5));
      $this->assertSame(
         $this->calc->getCategories(),
         ["Food" => 600.0, "Fuel" => 301.0]
      );
   }
}
