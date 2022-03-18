<!doctype html>
<html lang"PT">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<meta name="description" content="">
		<meta name="author" content="">

    <!-- Favicon-->
    <link rel="icon" type="image/x-icon" href="assets/favicon.png" />

    <!-- Bootstrap icons-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
   <!-- Core theme CSS (includes Bootstrap)-->
    <link href="css/styles.css" rel="stylesheet" />
		
		
		
		
		<title> AutoRep - Faça o seu Login! </title>
		


<!-- multistep form -->
<link href="login.css" rel="stylesheet"> 
<link href="login.js" rel="stylesheet"> 
  <!-- Navigation-->
  <header>
<?php
        require "navbar.php";
        ?>
</header>
<body class="text-center">

<form id="msform" method="POST" action="login.php">
    <!-- progressbar -->
 
    <!-- fieldsets -->
    <fieldset>
      <h2 class="fs-title">Iniciar sessao</h2>
      <input type="text" id="inputUsername" class="form-control" placeholder="Username" name="username" required autofocus>

      <input type="password" id="inputPassword" class="form-control" placeholder="Password" name="password" required>

      <input  type="submit" name="submit" type="button" name="Login" class="next action-button" value="Login" />
    </fieldset>
    <a style="color:black; font-size: 18px; font-family: 'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;" href="registar.php">Se ainda não se registou, clique aqui para efectuar o seu registo</a>
   
  </form>   
</body>
</html>

 