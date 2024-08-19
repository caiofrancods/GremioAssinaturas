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

?>