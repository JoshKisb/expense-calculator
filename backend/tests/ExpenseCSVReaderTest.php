<?php

use App\Expense;
use App\ExpenseCSVReader;
use PHPUnit\Framework\TestCase;

class ExpenseCSVReaderTest extends TestCase{

   private $filename = __DIR__."/test.csv";
   private ?ExpenseCSVReader $reader;

   protected function setUp(): void
   {
      $this->reader = new ExpenseCSVReader($this->filename);
   }

   protected function tearDown(): void
   {
      $this->reader = null;
      unlink($this->filename);
   }

   public function testEmptyFileInputReturnsEmptyArray()
   {
      file_put_contents($this->filename, "");
      $this->assertSame($this->reader->getExpenses(), []);
   }

   public function testOneCSVLineReturnsSingleExpense()
   {
      file_put_contents($this->filename, "Food, 30.8, 2");
      $expenses = $this->reader->getExpenses();
      $this->assertEquals($expenses, [new Expense("Food", 30.8, 2)]);
   }
}