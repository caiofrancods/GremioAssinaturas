<?php include_once "geral/acesso.php" ?>
<!DOCTYPE html>
<html>

<head>
    <?php include_once "geral/head.php" ?>
    <title>Detalhes</title>
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
        <div
            class="d-flex justify-content-center flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h4 class="h4"><?php echo $registro['nome']; ?></h4>
        </div>
        <div class="d-flex">

            <div class="col-lg-6">
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
                <? foreach($signatarios as $sig){
                    $usuario = buscarUsuarioPorId($sig['codUsuario']);
                    echo '<p>'.$usuario['nome'].' - '.$sig['mudanca'].' ['.$sig['situacao'].']';
                }
                ?>
                <p></p>
                <div class="d-flex justify-content-center mt-4">
                    <button type="submit" class="btn btn-danger btn-sm ml-3">Cancelar Submissão</button>
                    <button type="submit"
                        class="btn btn-success btn-sm ml-3 <? if ($registro['situacao'] == "Pendente" || $registro['situacao'] == "Recusado") {
                            echo 'disabled';
                        } ?>">Imprimir
                        Assinado</button>
                </div>
            </div>
            <div class="d-flex justify-content-center mb-3 col-lg-6">
                <iframe src="<?php echo $registro['caminho'] ?>" class="frame" frameborder="0" scrolling="no"></iframe>
            </div>
        </div>
    </div>

    <?php include_once "geral/js.php" ?>
</body>

</html>