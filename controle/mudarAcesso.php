<?php	
	session_start();		
	include_once "../repo/documentoCRUD.php";
	
    $codigo=$_GET['codigo'];

    $documento= buscarDocumento($codigo);

    if($documento['acesso'] == 1){
      alterarAcesso(2, $codigo); 
    }else{
      alterarAcesso(1, $codigo);
    };

    echo "<script>window.location.replace('../documentoDetalhado.php?codigo=". $codigo ."');</script>";

    
