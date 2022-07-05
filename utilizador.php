<?php
function buscarUtilizador($idUtilizador){
    $sql = "SELECT * FROM `utilizadores` WHERE `id` = $idUtilizador";
    $resp = DBExecute($sql);
	$result = mysqli_fetch_array($resp, MYSQLI_ASSOC);
	return $result;

}
