<!DOCTYPE html>
<html>

<head>
    <?php include_once "geral/head.php" ?>
    <title>Público</title>
</head>

<body>
    <?php include_once "geral/menu.php" ?>
    <div class="px-5 mt-4">
        <div>
            <h5 class="font-weight-bold text-center waves-light mt-4">Documentos Públicos do Grêmio Estudantil Campus
                Timóteo</h5>
            <hr>
            <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton"
                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Filtros
            </button>
            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                <a class="dropdown-item" href="#">Atas</a>
                <a class="dropdown-item" href="#">Ofícios</a>
                <a class="dropdown-item" href="#">Alguma coisa aqui</a>
            </div>
            <div class="form-row mt-5">
                <div class="col-md-3">
                    <div class="card mb-4 shadow-sm">
                        <div class="card-body">
                            <h5 class="card-title text-center">Nome do Documento</h5>
                            <p class="card-text text-muted text-center">Tipo</p>
                            <p class="card-text text-muted text-center">Data</p>
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="btn-group">
                                    <a href="#" class="btn btn-sm btn-outline-secondary">Ver</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-row d-flex justify-content-center">
                <button type="submit" class="btn btn-success">Pesquisar</button>
            </div>
        </div>
    </div>
    <?php include_once "geral/js.php" ?>
</body>

</html>