<?php
session_start();
include_once "../repo/documentoCRUD.php";

$codigoDoc = $_POST['codigo'];
$comp = $_POST['comprovante'];

if (verificarValidadeDocumento($codigoDoc, $comp)) {
    echo "<script>window.location.replace('../verificado.php?codigo=" . $codigoDoc . "')</script>";
} else {
    echo "<script>window.location.replace('../verificado.php?erro=1')</script>";
}
?>
