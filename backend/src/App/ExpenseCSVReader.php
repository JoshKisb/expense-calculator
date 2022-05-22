<?php 

namespace App;

use function PHPUnit\Framework\isNull;

/**
 * Reads a csv file and returns expenses
 */
class ExpenseCSVReader {
   /*
   if (($handle = fopen("test.csv", "r")) !== FALSE) {
      while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
         $num = count($data);
         echo "<p> $num fields in line $row: <br /></p>\n";
         $row++;
         for ($c=0; $c < $num; $c++) {
            echo $data[$c] . "<br />\n";
         }
      }
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

      $this->expenses = $expenses;
   }
}