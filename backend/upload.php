<?php
require "./vendor/autoload.php";

use App\ExpenseCategoryCalc;
use App\ExpenseCSVReader;

// for cors
header("Access-Control-Allow-Origin: *");

header('Content-Type: application/json; charset=utf-8');

if (isset($_FILES['csv'])) {
   $errors = [];
   $file_size = $_FILES['csv']['size'];
   $file_tmp = $_FILES['csv']['tmp_name'];
   $file_type = $_FILES['csv']['type'];

   // $file_name = $_FILES['csv']['name'];

   if ($file_size > 2097152) {
      $errors[] = 'File size must be less than 2MB';
   }

   if (empty($errors) == true) {
      // move_uploaded_file($file_tmp,"images/".$file_name);
      // read csv
      $reader = new ExpenseCSVReader($file_tmp);
      $expenses = $reader->getExpenses();

      // calculate total for categories
      $calc = new ExpenseCategoryCalc();
      $calc->addExpenses($expenses);
      
      $categoryTotals = $calc->getCategories();

      // convert to format [{ name, amount }]
      $result = [];
      foreach($categoryTotals as $category => $total) {
         $result[] = [
            "name" => $category, 
            "amount" => $total
         ];
      }
      $data = ["categories" => $result];
      echo json_encode($data);
   } else {
      echo json_encode(["error" => $errors]);
   }
}
