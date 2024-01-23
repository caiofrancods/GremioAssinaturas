<?php include_once "geral/acesso.php" ?>
<!DOCTYPE html>
<html>

<head>
    <?php include_once "geral/head.php" ?>
    <title>Inicial</title>
</head>

<body>
    <?php include_once "geral/menu.php" ?>
    <div class="container">
        <div class="<?php if (isset($_SESSION['dadosUsuario'])) {
            echo " d-none";
        } ?>">
            <div class="d-flex justify-content-center">
                <a href="login" class="btn btn-success mb-2">Entrar</a>
            </div>
            <div class="d-flex justify-content-center">
                <a href="verificarComprovante.php" class="btn btn-success mt-2 mb-2">Verificar Documento</a>
            </div>
        </div>
        <div class="<?php if (!isset($_SESSION['dadosUsuario'])) {
            echo " d-none";
        } ?>">
            <div class="card mt-2">
                <div class="card-header">
                    Documentos Pendentes de Assinatura
                </div>
                <div class="card-body">
                    <?php
                    // if (count($registros) == 0) {
                    //     echo '<p class="text-center text-muted">Não há eventos cadastrados nesta semana.</p>';
                    // }else{
                    //     foreach($registros as $registro){
                    //         $dataFormatada = date("d/m/Y", strtotime($registro['dataHorario']));
                    //         echo '<p class="card-text"><span class="text-muted">['.$registro['responsavel'].']</span> '.$dataFormatada.' - '.$registro['nome'].'</p>';
                    //       }
                    // }
                    
                    ?>
                </div>
            </div>
            <div class="card mt-2">
                <div class="card-header">
                    Documentos Aguardando Assinatura de Terceiros
                </div>
                <div class="card-body">
                    <?php
                    // if (count($registros) == 0) {
                    //     echo '<p class="text-center text-muted">Não há eventos cadastrados nesta semana.</p>';
                    // }else{
                    //     foreach($registros as $registro){
                    //         $dataFormatada = date("d/m/Y", strtotime($registro['dataHorario']));
                    //         echo '<p class="card-text"><span class="text-muted">['.$registro['responsavel'].']</span> '.$dataFormatada.' - '.$registro['nome'].'</p>';
                    //       }
                    // }
                    
                    ?>
                </div>
            </div>
        </div>
        <div>

            <?php include_once "geral/js.php" ?>
</body>

</html>