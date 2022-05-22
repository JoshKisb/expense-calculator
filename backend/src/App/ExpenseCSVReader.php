<?php 

namespace App;

use Exception;

use function PHPUnit\Framework\isNull;

/**
 * Reads a csv file and returns expenses
 */
class ExpenseCSVReader {
   /*
   if (($handle = fopen("test.csv", "r")) !== FALSE) {
      fclose($handle);
   }
   */
   private $filepath;
   private $fp;
   private ?array $expenses;

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

   public function open()
   {
      if (!isset($this->fp)) {
         $this->fp = fopen($this->filepath, "r");
      }
   }

   public function getExpenses(): array
   {
      $this->open();

      // parse csv if hasnt yet been parsed
      if (isNull($this->expenses))
         $this->parseCSV();

      return $this->expenses;
   }

   public function parseCSV()
   {
      $expenses = [];
      while (($data = fgetcsv($this->fp)) !== FALSE) {
         $num = count($data);
         if ($num >= 3) {
            $expenses[] = new Expense($data[0], $data[1], $data[2]);
         }
      }
      $this->expenses = $expenses;
   }
}