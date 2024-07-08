<?php	
	session_start();		
	include_once "../repo/documentoCRUD.php";
	
    $usuario = $_POST['usuario'];
    $nome =  $_POST['nome'];
    $arquivo = $_FILES['doc'];
    $tipo = $_POST['tipo'];

	$nomeArquivo = $arquivo['name'];
	$extensao = pathinfo($nomeArquivo, PATHINFO_EXTENSION);
	$temp = $arquivo['tmp_name'];

	if($extensao != 'pdf'){
		echo  "<script>window.location.replace('../administrador.php?alert=1');</script>";
    }else{
        $caminho = "../documentos/".$nomeArquivo;
		move_uploaded_file($temp, $caminho);
        $caminho = substr($caminho, 3);
		$id = submissao($nome, $usuario, $caminho, $tipo);
        if($id > 0){
            $signatarios = $_POST['nomesArray'];
            $quant = enviarParaAssinar($signatarios, $id, $nome);
            $signatarios = json_decode($signatarios);
            if(count($quant) == count($signatarios)){
                echo  "<script>window.location.replace('../administrador.php?result=1');</script>";
            }else{
                echo  "<script>window.location.replace('../administrador.php?result=2');</script>";
            }
        }
    }

?>	