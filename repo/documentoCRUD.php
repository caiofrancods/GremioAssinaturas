<?php
include_once "bancoDadosCRUD.php";

function submissao($nome, $usuario, $caminho)
{
    try {
        $conexao = criarConexao();
        date_default_timezone_set('America/Sao_Paulo');
        $data = new DateTime();
        $dataFormatada = $data->format('d/m/Y H:i:s');
        $sql = "INSERT INTO Documento(nome, usuario, horarioSubmissao, situacao, caminho) 
                    VALUES(:nome, :usuario, :horarioSubmissao, :situacao, :caminho);";
        $sentenca = $conexao->prepare($sql);
        $sentenca->bindValue(':nome', $nome);
        $sentenca->bindValue(':usuario', $usuario);
        $sentenca->bindValue(':horarioSubmissao', $dataFormatada);
        $sentenca->bindValue(':horarioSubmissao', "Pendente");
        $sentenca->bindValue(':caminho', $caminho);
        $sentenca->execute();
        $codigo = $conexao->lastInsertId();
        $conexao = null;
        return $codigo;
    } catch (PDOException $erro) {
        echo ($erro);
        die();
    }
}

function enviarParaAssinar($signatarios, $codDoc)
{
    try {
        $conexao = criarConexao();
        $processos = [];
        $x = 0;
        $signatarios = json_decode($signatarios);
        foreach ($signatarios as $sig) {
            $sig = intval($sig);
            $sql = "INSERT INTO DocumentoUsuario(codUsuario, codigoDocumento, horario, situacao) 
                    VALUES(:codUsuario, :codDocumento, :horario, :situacao);";
            $sentenca = $conexao->prepare($sql);
            $sentenca->bindValue(':codUsuario', $sig);
            $sentenca->bindValue(':codDocumento', $codDoc);
            date_default_timezone_set('America/Sao_Paulo');
            $data = new DateTime();
            $dataFormatada = $data->format('d/m/Y H:i:s');
            $sentenca->bindValue(':horario', $dataFormatada);
            $sentenca->bindValue(':situacao', "Pendente");
            $sentenca->execute();
            $processos[$x] = 1;
            $x++;
        }

        $conexao = null;
        return $processos;
    } catch (PDOException $erro) {
        echo ($erro);
        die();
    }
}

function listar(){
    try {
        $conexao = criarConexao();
        $sql = "SELECT * FROM Documento;";
        $sentenca = $conexao->prepare($sql);
        $sentenca->execute(); 
        $conexao = null;
        return $sentenca->fetchAll();;
    } catch (PDOException $erro) {
        echo ($erro);
        die();
    }
}

function buscarDocumento($codigo){
    try{
        $sql = "SELECT * FROM Documento WHERE codigoDocumento = :codigo;";

        $conexao = criarConexao();        
        $sentenca = $conexao->prepare($sql);
        $sentenca->bindValue(':codigo', $codigo); 
    
        $sentenca->execute();     
        $conexao = null;
        return $sentenca->fetch();
    }catch (PDOException $erro){
        return -1;
    }
}

function buscarSignatarios($codigo){
    try{
        $sql = "SELECT * FROM DocumentoUsuario WHERE codigoDocumento = :codigoDocumento;";

        $conexao = criarConexao();        
        $sentenca = $conexao->prepare($sql);
        $sentenca->bindValue(':codigoDocumento', $codigo); 
    
        $sentenca->execute();     
        $conexao = null;
        return $sentenca->fetchAll();
    }catch (PDOException $erro){
        return -1;
    }
}