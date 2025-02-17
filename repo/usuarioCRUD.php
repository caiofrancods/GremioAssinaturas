<?php

include_once "../controle/acessoServer.php";

function autenticarUsuario($email, $senha) {
    $url = 'https://gremiogerencia.gremiotimoteo.online/api/?acesso='.acesso(); // URL da API de autenticação

    $data = array(
        'email' => $email,
        'senha' => $senha
    );

    $ch = curl_init($url);

    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));

    $response = curl_exec($ch);
    curl_close($ch);

    $resultado = json_decode($response, true);

    if (isset($resultado['codigo'])) {
        // Usuário autenticado com sucesso
        return $resultado;
    } else {
        // Falha na autenticação
        return null;
    }
}

function listarUsuarios() {
    $url = 'https://gremiogerencia.gremiotimoteo.online/api/?acesso='.acesso(); // URL da API de listagem de usuários

    $ch = curl_init();

    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

    $response = curl_exec($ch);
    curl_close($ch);

    $usuarios = json_decode($response, true);

    return $usuarios;
}

function buscarUsuarioPorId($idUsuario) {
    $url = 'https://gremiogerencia.gremiotimoteo.online/api/?id=' . $idUsuario . '&acesso='.acesso(); // URL da API de busca por ID

    $ch = curl_init();

    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

    $response = curl_exec($ch);
    curl_close($ch);

    $usuario = json_decode($response, true);

    return $usuario;
}

// Função para salvar (adicionar ou atualizar) um usuário
function salvarUsuario($usuario) {
    $url = 'https://gremiogerencia.gremiotimoteo.online/api/?acesso='.acesso();

    $ch = curl_init($url);
    $method = $usuario['id'] === 0 ? CURLOPT_POST : CURLOPT_CUSTOMREQUEST;

    curl_setopt($ch, $method, $usuario['id'] === 0 ? true : "PUT");
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($usuario));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));

    $response = curl_exec($ch);
    curl_close($ch);

    return json_decode($response, true);
}

// Função para excluir um usuário por ID
function excluirUsuario($idUsuario) {
    $url = 'https://gremiogerencia.gremiotimoteo.online/api/?id=' . $idUsuario . '&acesso='.acesso();

    $ch = curl_init($url);

    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

    $response = curl_exec($ch);
    curl_close($ch);

    return json_decode($response, true);
}

// Função para verificar se um e-mail já está registrado
function verificarEmail($email) {
    $url = 'https://gremiogerencia.gremiotimoteo.online/api/?email=' . $email . '&acesso='.acesso();

    $ch = curl_init($url);

    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

    $response = curl_exec($ch);
    curl_close($ch);

    return json_decode($response, true)['existe'];
}

// Função para solicitar cadastro do usuário
function solicitarCadastro($email, $senha) {
    $url = 'https://gremiogerencia.gremiotimoteo.online/api/solicitacao?acesso='.acesso();

    $data = array(
        'email' => $email,
        'senha' => $senha
    );

    $ch = curl_init($url);

    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));

    $response = curl_exec($ch);
    curl_close($ch);

    return json_decode($response, true);
}

// Função para enviar um e-mail ao administrador
function enviarEmailParaAdmin($emailUsuario) {
    $url = 'https://gremiogerencia.gremiotimoteo.online/api/email-admin?acesso='.acesso();

    $data = array(
        'email' => $emailUsuario
    );

    $ch = curl_init($url);

    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));

    $response = curl_exec($ch);
    curl_close($ch);

    return json_decode($response, true);
}

?>
