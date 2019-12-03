<?php  
 $time_start = microtime(true);   
 //$server = '{imap.mail.yahoo.com:993/ssl}';  
 $server = '{imap.gmail.com:993/ssl}';  
 //$user = 'xxx@gmail.com';  
 $user = $argv[1];  
 //$pass = 'xxx';  
 $pass = "$argv[2]";  
 date_default_timezone_set('Asia/Shanghai');  
 $criteria = 'SINCE "'.date('d M Y', strtotime('- 1 days')).'"';  
 $connection = imap_open($server, $user, $pass) or die("can't connect: " . imap_last_error());  
 $mailboxes = imap_list($connection, $server, '*');  
 $folder = "./$user/";  
 if(!file_exists($folder)){  
   mkdir($folder, 0777, true);  
 }  
 foreach($mailboxes as $mailbox) {  
   $shortname = str_replace($server, '', $mailbox);  
   echo "$shortname\n";  
   //create folder  
   if(!file_exists("$folder$shortname")){  
     mkdir("$folder$shortname", 0777, true);  
     }  
   //enter into folder  
   imap_reopen($connection, $server.$shortname);  
   $count = imap_num_msg($connection);  
   $uids = imap_search($connection, $criteria, SE_UID, 'UTF-8');  
   if(is_array($uids)){  
     foreach($uids as $ud){    
       $k = imap_msgno ($connection, $ud);  
       //approach A  
       //$headers = imap_fetchheader($connection, $k, FT_PREFETCHTEXT);  
       //$body = imap_body($connection, $k);  
       //file_put_contents("$folder$shortname/$ud.eml", $headers ."\n". $body);  
       //approach B  
       //$body=imap_fetchbody($connection, $k, "");  
       //file_put_contents("$folder$shortname/$ud.eml", $body);  
       //approach C  
       imap_savebody($connection, "$folder$shortname/$ud.eml", $k);  
       echo "saved $ud.eml " . "($count-$k)\n";    
     }  
   }else{  
 //          echo "imap_search failed: " . imap_last_error() . "\n";  
     }  
 }  
   imap_errors();  
   imap_close($connection);  
 $time_end = microtime(true);  
 //dividing with 60 will give the execution time in minutes other wise seconds  
 $execution_time = ($time_end - $time_start)/60;  
 //execution time of the script  
 echo 'Total Execution Time: '.$execution_time.' Mins';  
 ?>  
