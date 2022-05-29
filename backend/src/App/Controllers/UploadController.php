<?php 

namespace App\Controllers;

use App\Models\ExpenseCategoryCalc;
use App\Models\ExpenseCSVReader;
use System\Controller;
use System\Request;
use System\Response;

class UploadController extends Controller {

   public function upload(Request $request)
   {
      if (isset($_FILES['csv'])) {

         $errors = [];
         $file_size = $_FILES['csv']['size'];
         $file_tmp = $_FILES['csv']['tmp_name'];
         $file_type = $_FILES['csv']['type'];
      
         // $file_name = $_FILES['csv']['name'];
      
         if ($file_size > 2097152) {
            $errors[] = 'File size must be less than 2MB';
         }
      
         if (empty($errors)) {
            $reader = new ExpenseCSVReader($file_tmp);
            $valid = $reader->validate();
      
            if (!$valid) {
               $errors[] = "Improper format in CSV";
            }
         }
      
         if (empty($errors)) {
            $expenses = $reader->getExpenses();
      
            // calculate total for categories
            $calc = new ExpenseCategoryCalc();
            $calc->addExpenses($expenses);
      
            $categoryTotals = $calc->getCategories();
      
            // convert to format [{ name, amount }]
            $result = [];
            foreach ($categoryTotals as $category => $total) {
               $result[] = [
                  "name" => $category,
                  "amount" => $total
               ];
            }
            $data = ["categories" => $result];
            return Response::json($data);
         } else {
            http_response_code(400);
            return Response::json(["error" => $errors]);
         }
   
      }
        
   }
}