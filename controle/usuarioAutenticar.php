<?php	
	session_start();		
	include_once "../repo/usuarioCRUD.php";
	
    $email = $_POST['email'];
    $senha =  $_POST['senha'];

    $registro = autenticarUsuario($email, $senha);
	if($registro != null){	
		$_SESSION['dadosUsuario'] = $registro;
		echo "<script>location.href='../index.php';</script>"; 
	}else{
		echo "<script>location.href='../login.php?result=2';</script>"; 			
	}
?>	