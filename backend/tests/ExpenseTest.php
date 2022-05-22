<?php

use App\Expense;
use PHPUnit\Framework\TestCase;

class ExpenseTest extends TestCase
{

   /**
    * @dataProvider expenseProvider
    */
   public function testValidTotal($price, $quantity, $expected)
   {
      $expense = new Expense("category", $price, $quantity);
      $this->assertEquals($expense->getTotal(), $expected);
   }

   public function expenseProvider()
   {
      return [
         'zero price and quantity'  => [0, 0, 0],
         'zero price' => [0, 2, 0],
         'zero quanity' => [2, 0, 0],
         'one quantity' => [3.0, 1, 3.0],
         'one price'  => [1, 4, 4.0],
         'many quantity' => [4.0, 6, 24.0],
      ];
   }
}