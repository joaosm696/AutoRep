<?php
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);
 require("config.php");
 
 function DBConnect()
 {
	 $basededados = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE)	OR die (mysqli_connect_error());
	 return $basededados;
 }

 function DBClose($basededados)
 {
	 mysqli_close($basededados) or die (mysqli_connect_error());
 }  
 
 function DBExecute($sql)
 {
	 $basededados = DBConnect(); 
	 $result=mysqli_query($basededados, $sql);
	 DBClose($basededados);
	 return $result;
	 
 }
 
 