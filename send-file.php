<?php

  // variables
  $api_key = ''; // find your API key here: https://www.hubuco.com/api
  $file_name = ''; // TXT or CSV files are accepted
  $file_name_with_full_path = ''; // absolute path to your file you want to upload. Eg. '/var/www/vhosts/domain.com/upload/'.$file_name
  
  $target_url = 'https://bulkapi.hubuco.com/bulkapi/upload/'; // HuBuCo upload API url, do not change

  if (function_exists('curl_file_create'))
  { // php 5.6+
    $cFile = curl_file_create($file_name_with_full_path);
  } 
  else 
  { 
    $cFile = '@' . realpath($file_name_with_full_path);
  }

  $post = array('api_key'=> $api_key, 'file_name' => $file_name, 'file_contents'=> $cFile);
  $ch = curl_init();
  curl_setopt($ch, CURLOPT_URL,$target_url);
  curl_setopt($ch, CURLOPT_POST,1);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  curl_setopt($ch, CURLOPT_POSTFIELDS, $post);

  // get file id
  $file_id = curl_exec ($ch); // save $file_id. It will be used to retreive file progress and results
  curl_close ($ch);
    
 ?>
