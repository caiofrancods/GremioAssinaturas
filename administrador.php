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
                    <div class="col-md-4">
                        <div class="card mb-4 shadow-sm">
                            <div class="card-body">
                                <h5 class="card-title text-center">Nome Documento</h5>
                                <p class="card-text text-muted text-center">Fulano</p>
                                <p class="card-text text-muted text-center">[Assinado]</p>
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="btn-group">
                                        <a href="http://gremiotimoteo.online/noticia.php?codigo='.$registro['codigo'].'"
                                            class="btn btn-sm btn-outline-secondary">Ver</a>
                                    </div>
                                    <small class="text-muted">23/12/2023 14:30:35</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- <?php
                // foreach($registros as $registro){
                //   echo '<div class="col-md-4">
                //   <div class="card mb-4 shadow-sm">
                //     <div class="card-body">
                //       <h5 class="card-title text-center">'.$registro['titulo'].'</h5>
                //       <p class="card-text text-muted">'.$registro['subtitulo'].'</p>
                //       <div class="d-flex justify-content-between align-items-center">
                //         <div class="btn-group">
                //         <a href="http://gremiotimoteo.online/noticia.php?codigo='.$registro['codigo'].'" class="btn btn-sm btn-outline-secondary">Ver</a>
                //         </div>
                //         <small class="text-muted">'.$registro['dataHorario'].'</small>
                //       </div>
                //     </div>
                //   </div>
                // </div>';
                // }
                // ?> -->
            </div>
            <div class="tab-pane fade" id="meus" role="tabpanel" aria-labelledby="profile-tab">
                <div class="row mt-4">
                    <div class="col-md-4">
                        <div class="card mb-4 shadow-sm">
                            <div class="card-body">
                                <h5 class="card-title text-center">Nome Documento</h5>
                                <p class="card-text text-muted text-center">[Fulano]</p>
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="btn-group">
                                        <a href="http://gremiotimoteo.online/noticia.php?codigo='.$registro['codigo'].'"
                                            class="btn btn-sm btn-outline-secondary">Ver</a>
                                    </div>
                                    <small class="text-muted">23/12/2023 14:30:35</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="cadastrar" role="tabpanel" aria-labelledby="criar-tab">
                <form id="formulario" class="mt-2" action="{{ route('submissao') }}" method="POST"
                    enctype="multipart/form-data">
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="signatario">Signatário</label>
                            <select id="signatario" class="form-control" name="signatario"
                                onchange="adicionarElemento()" required>
                                <option selected hidden value=''>Escolha...</option>

                                <?php
                                include_once 'repo/usuarioCRUD.php';
                                $usuarios = listarUsuarios();
                                // echo "<option value='' selected disabled>Escolha o Armário à Transferir</option>";
                                foreach ($usuarios as $user) {
                                    echo "<option value='{$user['nome']}'>{$user['nome']}</option>";
                                }
                                ?>
                            </select>
                            <input type="hidden" id="nomesArray" name="nomesArray" value="">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="doc">Documento</label>
                            <input type="file" id="doc" name="doc" class="form-control" placeholder="" required>
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