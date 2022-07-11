<?php
if (isset($_POST['alterar'])){
    include('funcao.php');
 $id = $_POST['id'];
                    // variaveis
 $username = $_POST['username'];
 $nome = $_POST['nomeapelido'];
 $admin = $_POST['admin'];
$sql="UPDATE utilizadores SET `username`='$username', `nomeapelido`='$nome',  `admin`='$admin' WHERE `id`='$id';";
$query=DBExecute($sql);
header("location: adminutilizadores.php");
}
