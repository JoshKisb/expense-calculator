<?php

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
      $expense = [
         "category" => "Food",
         "price" => 100,
         "amount" => 2,
      ];
      $this->calc->addExpenses([$expense]);
      $this->assertSame(
         $this->calc->getCategories(),
         ["Food" => 200]
      );
   }
}
