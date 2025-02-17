<!DOCTYPE html>
<html>

<head>
    <?php include_once "geral/head.php" ?>
    <title>Cadastro</title>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light shadow-sm mb-4" id="mainNav">
        <div class="container px-5 d-flex justify-content-center">
            <a href="index.php"><img class="img-fluid logo ml-4" src="imagens/logo.jpeg" alt="logo do grêmio"></a>
            <a class="navbar-brand fw-bold" href="index.php">Grêmio Assinaturas</a>
        </div>
    </nav>
    <div class="container">
        <?php
        if (isset($_GET['result'])) {
            if ($_GET['result'] == 'success') {
                echo '<div class="alert alert-success text-center" role="alert">
                        Solicitação enviada com sucesso!
                    </div>';
            } elseif ($_GET['result'] == 'error') {
                echo '<div class="alert alert-danger text-center" role="alert">
                        Erro ao enviar a solicitação. Tente novamente.
                    </div>';
            }
        }
        ?>
        <form class="form-signin" action="controle/usuarioCadastrar.php" method="POST">
            <h5 class="h3 mb-2 font-weight-normal text-center">Cadastro de Usuário</h5>
            <h6 class="h6 mb-3 font-weight-normal text-center mt-4 text-muted font-italic">Sistema de Assinaturas do Grêmio Estudantil</h6>
            <hr />
            <div class="form-row">
                <div class="form-group col-md-12">
                    <label for="email">E-mail</label>
                    <input type="email" id="email" name="email" class="form-control" placeholder="Seu e-mail" required>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-12">
                    <label for="senha">Senha</label>
                    <input type="password" id="senha" name="senha" class="form-control" placeholder="Sua senha" required>
                </div>
            </div>
            <button class="btn btn-primary mt-4 float-right" type="submit">Solicitar Cadastro</button>
        </form>
    </div>
    <?php include_once "geral/js.php"; ?>
</body>

</html>
