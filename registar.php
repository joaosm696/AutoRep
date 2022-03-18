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



    <title> AutoRep - Faça o seu Registro! </title>



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

    <form id="msform" method="POST" action="inserir.php">
        <!-- progressbar -->

        <!-- fieldsets -->
        <fieldset>
            <h2 class="fs-title">registe os seus dados</h2>
            <input type="text" name="username" id="inputUsername" class="form-control" placeholder="Username"  name="username" required autofocus>

            <input type="text" name="nomeapelido" id="inputUsername" class="form-control" placeholder="O seu nome completo" name="nomeapelido" required>   

            <input type="password" name="password" id="inputNome" class="form-control" placeholder="Password" name="password" required>

            <input type="email" name="email" id="inputPassword" class="form-control" placeholder="E-mail" name="email" required>

            <input type="text" name="nif" id="inputNIF" class="form-control" placeholder="NIF" name="nif" required>

            <input type="text" name="morada" id="inputmorada" class="form-control" placeholder="Morada" name="morada" required>

            <input type="text" name="cidade" id="inputcidade" class="form-control" placeholder="Cidade" name="cidade" required>

            <input type="text" name="codigopostal" id="inputCodigoPostal" class="form-control" placeholder="Codigo-Postal" name="CodigoPostal" required>

            <input type="submit" name="submit" type="button" name="Registar" class="next action-button" value="registar" />
        </fieldset>

    </form>
</body>

</html>