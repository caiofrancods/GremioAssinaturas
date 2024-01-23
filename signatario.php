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
                    <div class="col-md-4">
                        <div class="card mb-4 shadow-sm">
                            <div class="card-body">
                                <h5 class="card-title text-center">Nome Documento</h5>
                                <p class="card-text text-muted text-center">[Pendente]</p>
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="btn-group">
                                        <a href="http://gremiotimoteo.online/noticia.php?codigo='.$registro['codigo'].'"
                                            class="btn btn-sm btn-outline-secondary">Assinar</a>
                                    </div>
                                    <small class="text-muted">23/12/2023 14:30:35</small>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card mb-4 shadow-sm">
                            <div class="card-body">
                                <h5 class="card-title text-center">Nome Documento</h5>
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
                    <div class="col-md-4">
                        <div class="card mb-4 shadow-sm">
                            <div class="card-body">
                                <h5 class="card-title text-center">Nome Documento</h5>
                                <p class="card-text text-muted text-center">[Recusado]</p>
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
                                <p class="card-text text-muted text-center">[Pendente]</p>
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="btn-group">
                                        <a href="http://gremiotimoteo.online/noticia.php?codigo='.$registro['codigo'].'"
                                            class="btn btn-sm btn-outline-secondary">Assinar</a>
                                    </div>
                                    <small class="text-muted">23/12/2023 14:30:35</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="cadastrar" role="tabpanel" aria-labelledby="criar-tab">
                <form id="#formularioPatrimonio" class="mt-2" action="control/financeiroSalvar.php" method="POST">
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label for="tipo">Tipo de Lançamento</label>
                            <select id="tipo" class="form-control" name="tipo" required>
                                <option selected hidden value=''>Escolha...</option>
                                <option value="1">Entrada</option>
                                <option value="2">Saída</option>
                            </select>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="valor">Valor</label>
                            <input type="text" onkeypress="$(this).mask('R$ #.##0,00', {reverse: true});" id="valor"
                                name="valor" class="form-control" placeholder="" required>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="cod">Link do Documento</label>
                            <input type="text" id="cod" name="cod" class="form-control" placeholder="" required>
                        </div>
                        <div class="form-group col-md-12">
                            <label for="desc">Descrição</label>
                            <input type="text" id="desc" name="desc" class="form-control" placeholder="" required>
                        </div>
                    </div>
                    <div class="form-row d-flex justify-content-end">
                        <button type="submit" class="btn btn-success">Lançar</button>
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
    <?php include_once "geral/js.php" ?>
</body>

</html>