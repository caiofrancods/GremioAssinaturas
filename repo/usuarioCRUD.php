<?php
    include_once "bancoDadosCRUD.php";
    function autenticarUsuario($email, $senha) {
        try {
            $sql = "SELECT * FROM Usuario WHERE email = :email AND senha = :senha;";
    
            $conexao = criarConexaoUsuario();
            $sentenca = $conexao->prepare($sql);
            $sentenca->bindValue(':email', $email);
            $sentenca->bindValue(':senha', md5($senha));
    
            $sentenca->execute();
            $conexao = null;
    
            return $sentenca->fetch();
        } catch (PDOException $erro) {
            return -1;
        }
    }

    function listarUsuarios(){
        try {
            $sql = "SELECT * FROM Usuario";
    
            $conexao = criarConexaoUsuario();
            $sentenca = $conexao->prepare($sql);
    
            $sentenca->execute();
            $conexao = null;
    
            return $sentenca->fetchAll();
        } catch (PDOException $erro) {
            return -1;
        }
    }

    function buscarUsuarioPorId($idUsuario){
        try{
            $sql = "SELECT * FROM Usuario WHERE codigo = :codigo;";

            $conexao = criarConexaoUsuario();        
            $sentenca = $conexao->prepare($sql);
            $sentenca->bindValue(':codigo', $idUsuario); 
        
            $sentenca->execute();     
            $conexao = null;
            return $sentenca->fetch();
        }catch (PDOException $erro){
            return -1;
        }
    }    

?>