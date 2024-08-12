<?php
ob_start();
require_once '../vendor/autoload.php';
include_once "../repo/documentoCRUD.php";
include_once "../repo/usuarioCRUD.php";

$codigo = $_GET['codigo'];
$registro = buscarDocumento($codigo);
$usuario = buscarUsuarioPorId($registro['usuario']);
$signatarios = buscarSignatarios($codigo);

$mpdf = new \Mpdf\Mpdf();
$mpdf->SetDisplayMode("fullpage");

$css = file_get_contents('../css/style.css');
$mpdf->WriteHTML($css, 1);

$html = '<div style="font-family: Arial, sans-serif; background-color: #f2f2f2; padding: 20px; border-radius: 5px;">

    <h2 style="text-align: center; color: #333;">Detalhes do Documento</h2>

    <hr style="border-top: 1px solid #ccc;">

    <div style="margin-bottom: 20px;">
        <p style="margin: 0; color: #666;"><strong>Submissão:</strong> ' . $usuario['nome'] . '</p>
        <p style="margin: 0; color: #666;"><strong>Horário de Submissão:</strong> ' . $registro['horarioSubmissao'] . '</p>
        <p style="margin: 0; color: #666;"><strong>Situação:</strong> ' . $registro['situacao'] . '</p>
    </div>

    <div style="margin-bottom: 20px;">
        <p style="margin: 0; color: #666;"><strong>Signatários:</strong></p>
        <ul style="padding-left: 20px; margin-top: 5px;">';

foreach ($signatarios as $sig) {
    $usuario = buscarUsuarioPorId($sig['codUsuario']);
    $html .= '<li style="margin-bottom: 5px; color: #666;">' . $usuario['nome'] . ' - ' . $sig['mudanca'] . ' [' . $sig['situacao'] . ']</li>';
}

$html .= '</ul>
    </div>

    <p style="margin-top: 20px; color: #666;">Verifique a validade no site: <a href="https://assinatura.gremiotimoteo.online/verificarAssinatura.php">https://assinatura.gremiotimoteo.online/verificarAssinatura.php</a> utilizando o código = ' . $codigo . ' e o código de verificação ' . $registro['comprovante'] . '.</p>

</div>';

date_default_timezone_set('America/Sao_Paulo');
$data = new DateTime();
$dataEmissao = $data->format('d/m/Y H:i:s');
$mpdf->SetHeader("Sistema Grêmio Assinaturas |  | Emissão: {$dataEmissao}");
$mpdf->setFooter("Grêmio Estudantil Campus Timóteo");
$mpdf->WriteHTML($html, 2);
$nome = substituirBarraPorUnderscore($registro['nome']);
$caminho = $_SERVER['DOCUMENT_ROOT']."/documentos/temp/".$nome . "_signed.pdf";
$mpdf->Output($caminho, "F");
include_once "mergePDF.php";
merge("../".$registro['caminho'], $caminho, $nome . "_signed.pdf");
unlink ("../documentos/temp/".$nome . "_signed.pdf");
exit();

function substituirBarraPorUnderscore($string) {
    // Substitui todas as barras por underscores
    return str_replace('/', '_', $string);
}
