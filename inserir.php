<html>

<head>
    <title>AutoRep - Registe-se!</title>
    <meta charset="UTF-8">
</head>

<body>
    <h2>inserir registo na BD</h2>
    <?php

   include ('funcao.php');
     session_start();
     
     
     //captar os dados recebidos do formúlario com o método post
     $username=$_POST['username'];
     $password=md5($_POST['password']);
     $email=$_POST['email'];
     $nif=$_POST['nif'];
     $nomeapelido=$_POST['nomeapelido'];
     $morada=$_POST['morada'];
     $cidade=$_POST['cidade'];
     $codigopostal=$_POST['codigopostal'];
          
     
     /*avalia se alguma das varáveis contém um valor nulo ou string vazia*/
     if(!$username || !$password || !$email || !$nif || !$nomeapelido)
     
     {
     echo 'campos em falta. volte atrás e tente de novo.';
     exit;
     }
     echo 'Registado com sucesso!</br>';
 
     //estabelercer a ligação ao MYSQL server
     //$ligacao=mysqli_connect ('localhost:3306','root','usbw','bdusers',3306);
     if(!$db = DBConnect()){
         echo'<p> Erro: falha na ligacao.';
         exit;
         }
         //inserir os dados na tabela do registo
         
        
         
         //$insere= "INSERT INTO `utilizadores` (`id`, `username`, `password`, `email`, `tipo`) VALUES ('".$username."','".$password."','".$email."','".$tipo."')";
         $insere= "INSERT INTO `utilizadores` (`id`, `username`, `nomeapelido` , `password`, `email` , `nif` , `morada` , `cidade` , `codigopostal` ) VALUES (NULL, '".$username."', '".$nomeapelido."', '".$password."', '".$email."' , '".$nif."' , '".$morada."', '".$cidade."' , '".$codigopostal."');";
         
         $resultado=DBExecute($insere);
         
         if($resultado==1){  echo"<script language='javascript' type='text/javascript'>alert('Registo realizado com sucesso!!');window.location.href='logar.php';</script>";
               
     
         ;
         }
         else {echo'<p>Os dados não foram inseridos</br>';
         }
         
         
 ?>
    <p><a href="login1.html">voltar à página de login</p>

</body>

</html>