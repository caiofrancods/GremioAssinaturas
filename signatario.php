<?php include_once "geral/acesso.php" ?>
<!DOCTYPE html>
<html>

<head>
    <?php include_once "geral/head.php" ?>
    <title>Signatário</title>
</head>

<body>
    <?php include_once "geral/menu.php" ?>
    <div class="container">
        <div
            class="d-flex justify-content-center flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h4 class="h4">Signatário</h4>
        </div>
        <ul class="nav nav-tabs d-flex justify-content-center" id="myTab" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home"
                    aria-selected="true">Todos</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="profile-tab" data-toggle="tab" href="#meus" role="tab" aria-controls="profile"
                    aria-selected="false">Pendentes</a>
            </li>
        </ul>
        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                <div class="row mt-4">
                    <?php
                    include_once 'repo/documentoCRUD.php';
                    include_once 'repo/usuarioCRUD.php';
                    $count1 = 0;
                    $registros = listarPorUsuario($dadosUsuario['codigo']);
                    foreach ($registros as $registro) {
                        $count1 = 1;
                        $nomeUsuario = buscarUsuarioPorId($registro['usuario']);
                        echo ' <div class="col-md-4">
                                    <div class="card mb-4 shadow-sm">
                                        <div class="card-body">
                                            <h5 class="card-title text-center">' . $registro['nome'] . '</h5>
                                            <p class="card-text text-muted text-center">' . $nomeUsuario['nome'] . '</p>
                                            <p class="card-text text-muted text-center">[' . $registro['situacao'] . ']</p>
                                            <div class="d-flex justify-content-between align-items-center">
                                                <div class="btn-group">
                                                    <a href="documentoDetalhado.php?codigo=' . $registro['codigoDocumento'] . '"
                                                        class="btn btn-sm btn-outline-secondary">Ver</a>
                                                </div>
                                                <small class="text-muted">' . $registro['horarioSubmissao'] . '</small>
                                            </div>
                                        </div>
                                    </div>
                                </div>';
                    }
                    if ($count1 == 0) {
                        echo '<p class="text-center text-muted mt-3">Não há documentos</p>';
                    }
                    ?>
                </div>

            </div>
            <div class="tab-pane fade" id="meus" role="tabpanel" aria-labelledby="profile-tab">
                <div class="row mt-4">
                    <?php
                    include_once 'repo/documentoCRUD.php';
                    include_once 'repo/usuarioCRUD.php';
                    $registros = listarPorUsuario($dadosUsuario['codigo']);
                    $count = 0;
                    foreach ($registros as $registro) {
                        if ($registro['situacao'] == "Pendente") {
                            $count = 1;
                            $nomeUsuario = buscarUsuarioPorId($registro['usuario']);
                            echo ' <div class="col-md-4">
                                            <div class="card mb-4 shadow-sm">
                                                <div class="card-body">
                                                    <h5 class="card-title text-center">' . $registro['nome'] . '</h5>
                                                    <p class="card-text text-muted text-center">' . $nomeUsuario['nome'] . '</p>
                                                    <p class="card-text text-muted text-center">[' . $registro['situacao'] . ']</p>
                                                    <div class="d-flex justify-content-between align-items-center">
                                                        <div class="btn-group">
                                                            <a href="documentoDetalhado.php?codigo=' . $registro['codigoDocumento'] . '"
                                                                class="btn btn-sm btn-outline-secondary">Ver</a>
                                                        </div>
                                                        <small class="text-muted">' . $registro['horarioSubmissao'] . '</small>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>';
                        }
                    }
                    if ($count == 0) {
                        echo '<p class="text-center text-muted mt-3">Não há documentos pendentes</p>';
                    }

                    ?>
                </div>
            </div>
        </div>
    </div>
    <?php include_once "geral/js.php" ?>
</body>

</html>