<?php 

namespace App\Models;

use Exception;

/**
 * Reads a csv file and returns expenses
 */
class ExpenseCSVReader {
  
   private $filepath;
   private $fp;
   private ?array $expenses;
   private $valid = true;

   public function __construct($filepath)
   {
      $this->filepath = $filepath;
      $this->expenses = null;
   }

   public function __destruct()
   {
      if (isset($this->fp))
         fclose($this->fp);
   }

   private function open()
   {
      if (!isset($this->fp)) {
         $this->fp = fopen($this->filepath, "r");
      }
   }

   private function openAndParse()
   {
      $this->open();

      // parse csv if hasnt yet been parsed
      if (is_null($this->expenses))
         $this->parseCSV();
   }

   public function validate(): bool
   {
      $this->openAndParse();
      return $this->valid;
   }

   public function getExpenses(): array
   {
      $this->openAndParse();
      return $this->expenses;
   }

   private function validateRow($row): bool
   {
      $num = count($row);
      return ($num >= 3 && is_numeric($row[1]) && is_numeric($row[2]));
   }

   public function parseCSV()
   {
      $expenses = [];
      while (($data = fgetcsv($this->fp)) !== FALSE) {
         if ($this->validateRow($data)) {
            $category = $data[0];
            $price = floatval($data[1]);
            $quantity = intval($data[2]);
            $expenses[] = new Expense($category, $price, $quantity);
         } else {
            $this->valid = false;
         }
      }
      $this->expenses = $expenses;
   }
}