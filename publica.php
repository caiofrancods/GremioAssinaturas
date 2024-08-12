<!DOCTYPE html>
<html>

<head>
    <?php include_once "geral/head.php" ?>
    <title>Público</title>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light shadow-sm mb-4" id="mainNav">
        <div class="container px-2 d-flex justify-content-center">
            <a href="index.php"><img class="img-fluid logo ml-4" src="imagens/logo.jpeg" alt="logo do grêmio"></a>
            <a class="navbar-brand fw-bold" href="index.php">Grêmio Assinaturas</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive"
                aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                Menu
                <i class="bi-list"></i>
            </button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav ms-auto me-4 my-3 my-lg-0">
                    <li class="nav-item"><a class="nav-link me-lg-3" href="verificarAssinatura.php">Verificar Assinatura</a></li>
                    <li class="nav-item"><a class="nav-link me-lg-3" href="index.php">Acessar Sistema</a></li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="px-5 mt-4 container">
        <div>
            <h5 class="font-weight-bold text-center waves-light mt-4">Documentos Públicos do Grêmio Estudantil Campus
                Timóteo</h5>
            <hr>
            <div class="form-group col-md-4">
                <label for="filtro">Filtrar</label>
                <select id="filtro" class="form-control" name="filtro" onchange="filtroEscolhidoPublico()" required>
                    <option selected hidden value=''>
                        <?php
                        include_once 'repo/documentoCRUD.php';
                        if (isset($_GET['tipo'])) {
                            $tipoSelecionado = $_GET['tipo'];
                            if (!$tipoSelecionado == 0) {
                                $registros = buscarTipo($tipoSelecionado);
                                echo $registros["tipo"];
                            } else {
                                echo "Todos";
                            }

                        } else {
                            echo "Escolha...";
                        }
                        ?>
                    </option>
                    <option value='0'> Todos </option>
                    <?php
                    include_once 'repo/documentoCRUD.php';
                    $tipos = listarTipos();
                    // echo "<option value='' selected disabled>Escolha o Armário à Transferir</option>";
                    foreach ($tipos as $tipo) {
                        echo "<option value='" . $tipo['id'] . "'>{$tipo['tipo']}</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="row mt-4">
                <?php
                include_once 'repo/documentoCRUD.php';
                include_once 'repo/usuarioCRUD.php';
                $registros = [];

                // Verifica se o filtro por tipo foi aplicado
                
                if (isset($_GET['tipo'])) {
                    if (!$_GET['tipo'] == 0) {
                        $tipoSelecionado = $_GET['tipo'];
                        $registros = filtrarPorTipo($tipoSelecionado);
                    } else {
                        $registros = listar();
                    }
                } else {
                    $registros = listar();
                }

                $count1 = 0;
                foreach ($registros as $registro) {
                    $count1 = 1;
                    if ($registro['acesso'] == 1 && $registro['situacao'] == "Assinado") {
                        $nomeUsuario = buscarUsuarioPorId($registro['usuario']);
                        echo ' <div class="col-md-4">
                                        <div class="card mb-4 shadow-sm">
                                            <div class="card-body">
                                                <h5 class="card-title text-center">' . $registro['nome'] . '</h5>
                                                <p class="card-text text-muted text-center">' . $nomeUsuario['nome'] . '</p>
                                                <p class="card-text text-muted text-center">[' . $registro['situacao'] . ']</p>
                                                <div class="d-flex justify-content-between align-items-center">
                                                    <div class="btn-group">
                                                        <a href="verificado.php?codigo=' . $registro['codigoDocumento'] . '&comprovante=' . $registro['comprovante'] . '&origem=' . 1 . '" 
                                                        class="btn btn-sm btn-outline-secondary">Ver</a>
                                                    </div>
                                                    <small class="text-muted">' . $registro['horarioSubmissao'] . '</small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>';
                    }
                }
                if ($count1 == 0) {
                    echo '<p class="text-center text-muted mt-3">Não há documentos</p>';
                }
                ?>
            </div>
        </div>
    </div>
    </div>
    <script type="text/javascript" src="js/filtro.js"></script>
    <?php include_once "geral/js.php" ?>
</body>

</html>