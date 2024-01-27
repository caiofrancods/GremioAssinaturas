<?php include_once "geral/acesso.php" ?>
<!DOCTYPE html>
<html>

<head>
    <?php include_once "geral/head.php" ?>
    <title>Documento</title>
</head>

<body>
    <?php include_once "geral/menu.php" ?>
    <div class="container">
        <?php include_once "repo/documentoCRUD.php";
        include_once "repo/usuarioCRUD.php";
        if (isset($_GET['codigo'])) {

            $codigo = $_GET['codigo'];

            $registro = buscarDocumento($codigo);
            $usuario = buscarUsuarioPorId($registro['usuario']);
            $signatarios = buscarSignatarios($codigo);
        }
        ?>
        <div class="d-flex justify-content-center pt-3 pb-2 mb-3 border-bottom">
            <h4 class="h4">
                <?php echo $registro['nome']; ?>
            </h4>
        </div>
        <div class="mb-3">
            <p><span class="text-muted">Submissão: </span>
                <?php echo $usuario['nome']; ?>
            </p>
            <p><span class="text-muted">Horário de Submissão:</span>
                <?php echo $registro['horarioSubmissao']; ?>
            </p>
            <p><span class="text-muted">Situação: </span>
                <?php echo $registro['situacao']; ?>
            </p>
            <p class="text-muted">Signatários: </p>
            <? foreach ($signatarios as $sig) {
                $usuario = buscarUsuarioPorId($sig['codUsuario']);
                echo '<p>' . $usuario['nome'] . ' - ' . $sig['mudanca'] . ' [' . $sig['situacao'] . ']';
            }
            ?>
            <p></p>
        </div>
        <div class="form-row d-flex justify-content-center mb-3">
            <button type="submit" class="btn btn-success mt-3">Assinar</button>
            <button type="submit" class="btn btn-danger ml-3 mt-3">Recusar</button>
        </div>
        <div class="d-flex justify-content-center mb-3">
            <iframe src="documentos/OS DHD 0301.pdf" frameborder="0" scrolling="no"></iframe>
        </div>
        <div class="d-flex justify-content-center mb-3 pb-3">
            <a class="btn btn-success btn-sm ml-3 mt-2 text-white <? if ($registro['situacao'] == "Pendente" || $registro['situacao'] == "Recusado" || $registro['situacao'] == "Cancelado") {
                echo 'disabled';
            } ?>">Imprimir
                Assinado</a>
        </div>


    </div>

    <?php include_once "geral/js.php" ?>
</body>

</html>