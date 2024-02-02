<?php
ob_start();
require_once '../vendor/autoload.php';
include_once "../repo/documentoCRUD.php";
include_once "../repo/usuarioCRUD.php";

try {
    $codigo = $_GET['codigo'];
    $registro = buscarDocumento($codigo);
    $usuario = buscarUsuarioPorId($registro['usuario']);
    $signatarios = buscarSignatarios($codigo);

    // Caminho do documento existente
    $documentoExistente = "../" . $registro['caminho'];

    // Caminho para o novo documento
    $novoDocumento = "../temp/novo_documento.pdf";

    // Criar uma nova instância do Mpdf
    $mpdf = new \Mpdf\Mpdf();

    // Adicionar as páginas do documento existente ao novo documento
    $pages = $mpdf->SetSourceFile($documentoExistente);
    for ($i = 1; $i <= $pages; $i++) {
        $mpdf->AddPage();
        $tplId = $mpdf->ImportPage($i);
        $mpdf->UseTemplate($tplId);
    }

    // Adicionar a nova página
    $mpdf->AddPage();

    // Adicionar conteúdo à nova página
    $css = file_get_contents('../css/bootstrap.css');
    $mpdf->WriteHTML($css, 1);

    $html = '<div class="mb-3">
        <p><span class="text-muted">Submissão: </span>' . $usuario['nome'] . '</p>
        <p><span class="text-muted">Horário de Submissão:</span>' . $registro['horarioSubmissao'] . '</p>
        <p><span class="text-muted">Situação: </span>' . $registro['situacao'] . '</p>
        <p class="text-muted">Signatários: </p>';

    foreach ($signatarios as $sig) {
        $usuario = buscarUsuarioPorId($sig['codUsuario']);
        $html .= '<p>' . $usuario['nome'] . ' - ' . $sig['mudanca'] . ' [' . $sig['situacao'] . ']</p>';
    }

    $html .= "</div>";

    // Adicionar conteúdo HTML à nova página
    $mpdf->WriteHTML($html, 2);

    // Configurar o cabeçalho da nova página
    $dataEmissao = date("d/m/Y H:i:s");
    $mpdf->SetHeader("Sistema de Assinaturas - Grêmio Timóteo | | Assinado: {$dataEmissao}");

    // Saída do novo PDF para o navegador ou salvar em um arquivo
    $mpdf->Output($novoDocumento, "D");
    return true;
} catch (\Exception $erro) {
    echo $erro->getMessage(); // ou faça o tratamento adequado para a exceção
}
?>
