<?php 

session_start();
include_once "../repo/documentoCRUD.php";

$idFiltro = $_POST['idFiltro'];

$registros = filtrarPorTipo($idFiltro);

if($registros){

    return $registros;
} else {
    
}