<?php
    session_start();

    if (!isset($_SESSION['dadosUsuario'])) {
        echo "<script>location.href='login.php?acesso=1';</script>";
    }
    $dadosUsuario = $_SESSION['dadosUsuario'];
?>