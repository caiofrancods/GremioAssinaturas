<?php include_once "geral/acesso.php" ?>
<!DOCTYPE html>
<html>

<head>
    <?php include_once "geral/head.php" ?>
    <title>Administrador</title>
</head>

<body>
    <?php include_once "geral/menu.php" ?>
    <div class="container">
        <?php include_once "geral/alertas.php" ?>
        <div
            class="d-flex justify-content-center flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h4 class="h4">Administrador</h4>
        </div>
        <ul class="nav nav-tabs d-flex justify-content-center" id="myTab" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home"
                    aria-selected="true">Todos</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="profile-tab" data-toggle="tab" href="#meus" role="tab" aria-controls="profile"
                    aria-selected="false">Meus</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="criar-tab" data-toggle="tab" href="#cadastrar" role="tab" aria-controls="criar"
                    aria-selected="false">Cadastrar</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="relatorios-tab" data-toggle="tab" href="#relatorios" role="tab"
                    aria-controls="relatorios" aria-selected="false">Relatórios</a>
            </li>
        </ul>
        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                <div class="row mt-4">
                    <?php
                    include_once 'repo/documentoCRUD.php';
                    include_once 'repo/usuarioCRUD.php';
                    $registros = listar();
                    foreach ($registros as $registro) {
                        $nomeUsuario = buscarUsuarioPorId($registro['usuario']);
                        echo ' <div class="col-md-4">
                                    <div class="card mb-4 shadow-sm">
                                        <div class="card-body">
                                            <h5 class="card-title text-center">' . $registro['nome'] . '</h5>
                                            <p class="card-text text-muted text-center">' . $nomeUsuario['nome'] . '</p>
                                            <p class="card-text text-muted text-center">[' . $registro['situacao'] . ']</p>
                                            <div class="d-flex justify-content-between align-items-center">
                                                <div class="btn-group">
                                                    <a href="documentoDetalhado.php?codigo=' . $registro['codigoDocumento'].'"
                                                        class="btn btn-sm btn-outline-secondary">Ver</a>
                                                </div>
                                                <small class="text-muted">' . $registro['horarioSubmissao'] . '</small>
                                            </div>
                                        </div>
                                    </div>
                                </div>';
                    }
                    ?>
                </div>
            </div>
            <div class="tab-pane fade" id="meus" role="tabpanel" aria-labelledby="profile-tab">
                <div class="row mt-4">
                    <?php
                    include_once 'repo/documentoCRUD.php';
                    include_once 'repo/usuarioCRUD.php';
                    $registros = listar();
                    foreach ($registros as $registro) {
                        if($registro['usuario'] == $dadosUsuario['codigo']){
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
                    ?>
                </div>
            </div>
            <div class="tab-pane fade" id="cadastrar" role="tabpanel" aria-labelledby="criar-tab">
                <? if (isset($_GET['alert'])) {
                    if ($_GET['alert'] == 1) {
                        echo '<div class="alert alert-danger text-center mt-4" role="alert">
                    Apenas arquivos PDF são aceitos
                </div>';
                    }
                }
                ?>
                <form id="formulario" class="mt-2" action="controle/submeterDocumento.php" method="POST"
                    enctype="multipart/form-data">
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="nome">Nome do Documento</label>
                            <input type="text" id="nome" name="nome" class="form-control" placeholder="" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="doc">Documento</label>
                            <input type="file" id="doc" name="doc" class="form-control" placeholder="" required>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="signatario">Signatário</label>
                            <select id="signatario" class="form-control" name="signatario"
                                onchange="adicionarElemento()" required>
                                <option selected hidden value=''>Escolha...</option>

                                <?php
                                include_once 'repo/usuarioCRUD.php';
                                $usuarios = listarUsuarios();
                                // echo "<option value='' selected disabled>Escolha o Armário à Transferir</option>";
                                foreach ($usuarios as $user) {
                                    echo "<option value='" . $user['codigo'] . " - " . $user['nome'] . "'>{$user['nome']}</option>";
                                }
                                ?>
                            </select>
                            <input type="hidden" id="nomesArray" name="nomesArray" value="">
                            <input type="hidden" id="usuario" name="usuario" value="<? echo $dadosUsuario['codigo'] ?>">
                        </div>
                        <div class="form-group col-md-12">
                            <ul class="list-group" id="lista">
                                <li class="list-group-item">Lista de Signatários</li>

                            </ul>
                        </div>
                    </div>
                    <div class="form-row d-flex justify-content-end">
                        <button type="button" class="btn btn-success" onclick="verificarElementos()">Enviar</button>
                    </div>
                </form>
            </div>
            <div class="tab-pane fade d-flex justify-content-center" id="relatorios" role="tabpanel"
                aria-labelledby="relatorios-tab">
                <a href="control/relatorios/relatorioFinanceiro.php" class="btn btn-success btn-sm mt-4">Relatório
                    Financeiro</a>
            </div>
        </div>
    </div>
    <script>

    </script>
    <script type="text/javascript" src="js/submissaoDoc.js"></script>
    <?php include_once "geral/js.php" ?>
</body>