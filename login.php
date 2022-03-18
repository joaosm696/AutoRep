<?php
// este ficheiro login.php tem o código PHP e HTML necessário para fazer o login 
include ('funcao.php');
session_start();

if ($_SERVER["REQUEST_METHOD"]=="POST"){
	//username and password enviados do formulario (form)
	
	$myusername = filter_var($_POST['username'], FILTER_SANITIZE_ADD_SLASHES);
	$mypassword = md5(filter_var($_POST['password'], FILTER_SANITIZE_ADD_SLASHES));

	
	
		$sql = "SELECT id FROM `utilizadores` WHERE username='$myusername' AND password='$mypassword'";
		$result = DBExecute($sql);
		$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
		$count = mysqli_num_rows($result);
		$dados = mysqli_free_result($result);
	  
	//se a query (consulta) der 1 resultado concidente com $myusername e $mypassword,
	//$count será igual a 1 (1 linha de resultado)
	
	
	if($count == 1){
		$_SESSION['id']= $row['id']; //criar a variavel de sessão login_user(variável global)		
		header('location: index.php');
		} else{
			
		   echo"<script language='javascript' type='text/javascript'>alert('Login e/ou senha incorretos');window.location.href='logar.php';</script>";
			
			  $error = "Nome de utilizador ou palavra passe inválido";
		  
		
		}
}
DBClose($db);
?>