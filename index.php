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
        <div class="card mt-2">
            <div class="card-header">
                Documentos Pendentes de Assinatura
            </div>
            <div class="card-bodycard p-3">
                <?php
                include_once 'repo/documentoCRUD.php';
                $registros = listarPorUsuario($dadosUsuario['codigo']);
                $count = 0;
                foreach ($registros as $registro) {
                    if ($registro['situacao'] == "Pendente") {
                        $count = 1;
                        echo '<a href="documento.php?codigo='.$registro['codigoDocumento'].'" class="badge badge-success mt-2">'.$registro['nome'].'</a> <br>';
                    }
                } 
                if($count == 0){
                    echo '<p class="text-center text-muted">Não há documentos pendentes.</p>';
                }
                ?>
            </div>
        </div>
        <div class="card mt-2">
            <div class="card-header">
                Documentos Aguardando Assinatura de Terceiros
            </div>
            <div class="card-body">
            <?php
                include_once 'repo/documentoCRUD.php';
                $registros = listar();
                $count = 0;
                foreach ($registros as $registro) {
                    if ($registro['situacao'] == "Pendente" && verificarAssinatura($dadosUsuario['codigo'], $registro['codigoDocumento'])) {
                        $count = 1;
                        echo '<a href="documento.php?codigo='.$registro['codigoDocumento'].'" class="badge badge-success mt-2">'.$registro['nome'].'</a> <br>';
                    }
                } 
                if($count == 0){
                    echo '<p class="text-center text-muted">Não há documentos aguardando assinatura de terceiros.</p>';
                }
                ?>
            </div>
        </div>
    </div>
    <div>

        <?php include_once "geral/js.php" ?>
</body>

</html>