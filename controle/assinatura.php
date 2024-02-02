<?

session_start();
include_once "../repo/documentoCRUD.php";


$codigoDoc = $_GET['codigo'];
$user = $_GET['user'];

$result = assinar($codigoDoc, $user);

if(verificarDoc($codigoDoc)){
    mudarSituacao($codigoDoc);
} 
if($result == 0){
    header("Location: ../documento.php?result=1&codigo=".$codigoDoc);
    exit();
}else{
    header("Location: ../documento.php?result=2&codigo=".$codigoDoc);
    exit();
}
