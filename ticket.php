<?php
session_start();
include('funcao.php');
if (isset($_SESSION['id'])) {
    $id = $_SESSION['id'];
    $sql = "SELECT * FROM utilizadores WHERE id = '$id'";
    $result = DBExecute($sql);
    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
    $admin = $row['admin'];
    $username = $row['username'];
}

?>
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




    <title> AutoRep - Envia o teu ticket! </title>



    <!-- multistep form -->
    <link href="./login.css" rel="stylesheet">
    <link href="./login.js" rel="stylesheet">
    <?php
    require "navbar.php";
    ?>

<body class="text-center">

    <form id="msform" method="POST" action="mail.php">
        <!-- progressbar -->

        <!-- fieldsets -->
        <fieldset>
            <h2 class="fs-title">Ticket</h2>
            <input type="text" placeholder="Nome" name="nome">
            <input type="text" placeholder="Email" name="email">
            <input type="text" placeholder="Motivo" name="motivo">
            <textarea rows="5" placeholder="Mensagem" name="mensagem" cols="30"></textarea>


            <input type="submit" name="submit" value="Enviar ticket" />
        </fieldset>

    </form>
    <footer>
        <?php
require "footer.php"
?>
    </footer>
</body>

</html>