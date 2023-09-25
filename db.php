<?php

 $db_hostname = "localhost";
 $db_user = "root";
 $db_password = "";
 $db_name = "multidb";
 
 try{
  
  $db_con = new PDO("mysql:host={$db_hostname};dbname={$db_name}",$db_user,$db_password);
  
 }catch(PDOException $x){
  
  die($x->getMessage());
 }
