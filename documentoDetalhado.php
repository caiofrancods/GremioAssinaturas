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
        <div
            class="d-flex justify-content-center flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h4 class="h4">Nome do Documento</h4>
        </div>
        <div class="d-flex">
            <div class="col-lg-6">
                <p><span class="text-muted">Submissão: </span> Fulano</p>
                <p><span class="text-muted">Horário de Submissão:</span> 23/12/2023 14:30:35</p>
                <p><span class="text-muted">Situação</span> Pendente</p>
                <p class="text-muted">Signatários: </p>
                <p>Fulano - 23/12/2023 14:30:35 [Assinado]</p>
                <p>Fulano - 23/12/2023 14:30:35 [Recusado]</p>
                <p>Fulano - [Pendente]</p>
                <p></p>
                <div class="d-flex justify-content-center mt-4">
                    <button type="submit" class="btn btn-danger btn-sm ml-3">Cancelar Submissão</button>
                    <button type="submit" class="btn btn-success btn-sm ml-3">Imprimir Assinado</button>
                </div>
            </div>
            <div class="d-flex justify-content-center mb-3 col-lg-6">
                <iframe src="{{ asset('documentos/relatorioFinanceiro.pdf') }}" class="frame" frameborder="0"
                    scrolling="no"></iframe>
            </div>
        </div>
    </div>

    <?php include_once "geral/js.php" ?>
</body>

</html>