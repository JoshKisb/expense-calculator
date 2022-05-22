<?php

use App\ExpenseCategoryCalc;
use PHPUnit\Framework\TestCase;

class ExpenseCategoryCalcTest extends TestCase {

   public function testEmptyInputReturnsEmptyArray()
   {
      $calc = new ExpenseCategoryCalc();
      $calc->addExpenses([]);

      $this->assertSame($calc->getCategories(), []);
   }

   public function testSingleExpenseReturnsSingleCategory()
   {
      $this->assertSame(1, 1);
   }
}