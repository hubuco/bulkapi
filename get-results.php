<?php

  // set variables
  $api_key = ''; // find your API key here: https://www.hubuco.com/api
  $file_id = ''; // this file id was returned when uploded the file using send-file.php

  $curl = curl_init();
  curl_setopt_array($curl, array(
    CURLOPT_RETURNTRANSFER => 1,
    CURLOPT_URL => 'https://bulkapi.hubuco.com/bulkapi/progress/?api_key='.$api_key.'&file_id='.$file_id
  ));

  $resp = curl_exec($curl);
  curl_close($curl);

  if($resp != 'error')
  {
    list($file_id,$filename,$date_uploaded,$status,$uploaded_emails,$verified_emails) = explode(',',$resp);
  }

  if($status == 'completed')
  {
    // download ok emails
    $url_ok = 'https://bulkapi.hubuco.com/download/results/'.$file_id.'/1/'.$api_key;

    // download ok and catch all emails
    $url_ok_and_catch_all = 'https://bulkapi.hubuco.com/download/results/'.$file_id.'/2/'.$api_key;

    // download all emails
    $url_all = 'https://bulkapi.hubuco.com/download/results/'.$file_id.'/3/'.$api_key;
  }


  // displays results in an array
  unset($api_key, $curl, $resp);
  $results = get_defined_vars();
  echo '<pre>';
  print_r($results);
  echo '</pre>';
  
  /*
  Returned varibables:

  $file_id => the file id of the uploaded file
  $filename => file name
  $date_uploaded => unix timestamp of the file uploaded to HuBuCo
  $status => file process status; options: waiting, parsing, pre_verifying, pre_verifying_completed, verifying_in_progress, completed, error_in_file
  $uploaded_emails => number emails uploaded into HuBuCo's system after deduplication
  $verified_emails => number of emails already verified
  $url_ok => link to download ok emails
  $url_ok_and_catch_all => link to download ok and catch all emails
  $url_all => link to download full report

  DOWNLOAD
  if status is completed you can download the results from the following links:
  please replace file_id and api key accordingly

  OK ONLY:
  https://bulkapi.hubuco.com/download/results/<file_id>/1/<api_key>/

  OK + CATCH ALL:
  https://bulkapi.hubuco.com/download/results/<file_id>/2/<api_key>/

  FULL REPORT:
  https://bulkapi.hubuco.com/download/results/<file_id>/3/<api_key>/
  */ 
?>
