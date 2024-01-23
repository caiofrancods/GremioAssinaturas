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
        <div
            class="d-flex justify-content-center flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h4 class="h4">Nome do Documento</h4>
        </div>
        <div class="form-row d-flex justify-content-center mb-3">
            <button type="submit" class="btn btn-success">Assinar</button>
            <button type="submit" class="btn btn-danger ml-3">Recusar</button>
        </div>
        <div class="d-flex justify-content-center mb-3">
            <iframe src="{{ asset('documentos/relatorioFinanceiro.pdf') }}" frameborder="0" scrolling="no"></iframe>
        </div>

    </div>

    <?php include_once "geral/js.php" ?>
</body>

</html>