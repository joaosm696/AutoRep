<?php
session_start();
if (isset($_POST['btnGuardar'])){
include('funcao.php');
include('utilizador.php');
$id = $_SESSION['id'];
$nomecompleto = $_POST['nomecompleto'];
$email = $_POST['email'];
$nif = $_POST['nif'];
$morada = $_POST['morada'];
$codigopostal = $_POST['codigopostal'];
	$sql="UPDATE utilizadores SET `nomeapelido`='$nomecompleto', `email`='$email',  `nif`='$nif', `morada`='$morada', `cidade`='$cidade', `codigopostal`='$codigopostal' WHERE `id`='$id';";
	$query=DBExecute($sql);
	header("location: profile.php");
}
?>