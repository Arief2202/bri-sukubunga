<?php
   header("Content-Type: text/plain");
   $exec = exec("hostname"); //the "hostname" is a valid command in both windows and linux
   $hostname = trim($exec); //remove any spaces before and after
   $ip = gethostbyname($hostname);
   if($ip == "127.0.0.1") $ip = " Disconnected from wifi";
   else $ip = "Local IP : ".$ip;
   echo $ip;
?>