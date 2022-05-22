<?php

// for cors
header("Access-Control-Allow-Origin: *");

   if(isset($_FILES['csv'])){
      $errors = [];
      $file_size =$_FILES['csv']['size'];
      $file_tmp =$_FILES['csv']['tmp_name'];
      $file_type=$_FILES['csv']['type'];

      // $file_name = $_FILES['csv']['name'];
      
      if($file_size > 2097152){
         $errors[] = 'File size must be less than 2MB';
      }
      
      if(empty($errors)==true){
         // move_uploaded_file($file_tmp,"images/".$file_name);
         $data = ["categories" => []];
         header('Content-Type: application/json; charset=utf-8');
         echo json_encode($data);
      }else{
         return json_encode(["error" => $errors]);
      }
   }
