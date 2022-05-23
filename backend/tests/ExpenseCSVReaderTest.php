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

   public function testMultipleCSVLinesReturnMultipleExpenses()
   {
      file_put_contents($this->filename, "Food, 30.8, 2\nHotel, 10, 4");
      $expenses = $this->reader->getExpenses();
      $this->assertEquals(
         $expenses, 
         [
            new Expense("Food", 30.8, 2),
            new Expense("Hotel", 10, 4),
         ]
      );
   }

   public function testValidationReturnsTrueForValidCSV()
   {
      file_put_contents($this->filename, "Food, 30.8, 2\nHotel, 10, 4");
      $this->assertTrue($this->reader->validate());
   }

   public function testValidationReturnsFalseForInvalidCSV()
   {
      file_put_contents($this->filename, "Food, Much money, 2\nHotel, 10, 4");
      $this->assertFalse($this->reader->validate());
   }


}