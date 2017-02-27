# HuBuCo's Bulk API
Our bulk API is suitable to clean your database programatically and can be used to verify Millions of emails on a daily basis, including reselling, without manually exporting your database, uploading into HuBuCo, downloading results, uploading into your system. :-)

# Send a TXT or CSV file to HuBuCo
Using send-file.php you can send a csv or txt file to HuBuCo programtically. 
You will need to set:
- your HuBuCo API key
- filename
- file absoulte path

As a result you will be returned a variable: $file_id

Save this $file_id, as it will be used for retreiving the results

# Check progress of uploded file, and download
You can keep checking the progress of your file using get-results.php

You will need: 
- your HuBuCo API key
- $file_id returned by send-file.php

Results:
- $file_id => the file id of the uploaded file
- $filename => file name
- $date_uploaded => unix timestamp of the file uploaded to HuBuCo
- $status => file process status; options: waiting, parsing, pre_verifying, pre_verifying_completed, verifying_in_progress, completed, error_in_file
- $uploaded_emails => number emails uploaded into HuBuCo's system after deduplication
- $verified_emails => number of emails already verified

Once verification is completed the following links are available, you can use these links to download results. Results are available for 2 months
- $url_ok => link to download ok emails
- $url_ok_and_catch_all => link to download ok and catch all emails
- $url_all => link to download full report
