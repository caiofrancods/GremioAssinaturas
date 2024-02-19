<!DOCTYPE html>
<html>

<head>
    <?php include_once "geral/head.php" ?>
    <title>Verificar Assinatura</title>
</head>

<body>
    <?php include_once "geral/menu.php" ?>
    <div class="px-5 mt-4">
        <div>
            <div class="d-flex mt-4">
                <a href="index.php">
                    <svg xmlns="http://www.w3.org/2000/svg" height="32" width="28"
                        viewBox="0 0 448 512"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2023 Fonticons, Inc.-->
                        <path
                            d="M9.4 233.4c-12.5 12.5-12.5 32.8 0 45.3l160 160c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L109.2 288 416 288c17.7 0 32-14.3 32-32s-14.3-32-32-32l-306.7 0L214.6 118.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0l-160 160z" />
                    </svg>
                </a>
                <p class="ml-2">Voltar</p>
            </div>

            <h5 class="font-weight-bold text-center waves-light mt-4">Verificar Assinatura de Documento</h5>
            <hr>
            <form id="#formularioTransferir" class="mt-4" action="controle/validacao.php" method="POST">
                <div class="form-row mt-3">
                    <div class="form-group col-md-6">
                        <label for="codigo">Código do Documento</label>
                        <input type="text" id="codigo" name="codigo" class="form-control" placeholder="Ex: 32" required>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="comprovante">Código de Verificação de Assinatura</label>
                        <input type="text" id="comprovante" name="comprovante" class="form-control" placeholder="Ex: e4tsre"
                            required>
                    </div>
                </div>
                <div class="form-row d-flex justify-content-center">
                    <button type="submit" class="btn btn-success">Pesquisar</button>
                </div>
            </form>
        </div>
    </div>
    <?php include_once "geral/js.php" ?>
</body>

</html>