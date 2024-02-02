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
        $sentenca->bindValue(':situacao', "Pendente");
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
        $sql = "SELECT * FROM Documento ORDER BY horarioSubmissao DESC;";
        $sentenca = $conexao->prepare($sql);
        $sentenca->execute(); 
        $conexao = null;
        return $sentenca->fetchAll();;
    } catch (PDOException $erro) {
        echo ($erro);
        die();
    }
}

function listarPorUsuario($id){
    try {
        $conexao = criarConexao();
        $sql = "SELECT * FROM Documento INNER JOIN DocumentoUsuario AS du ON du.codigoDocumento = Documento.codigoDocumento WHERE codUsuario = :codigo;";
        $sentenca = $conexao->prepare($sql);
        $sentenca->bindValue(':codigo', $id); 
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

function buscarSignatariosPorId($codigo, $id){
    try{
        $sql = "SELECT * FROM DocumentoUsuario WHERE codigoDocumento = :codigoDocumento AND codUsuario = :codUsuario;";

        $conexao = criarConexao();        
        $sentenca = $conexao->prepare($sql);
        $sentenca->bindValue(':codigoDocumento', $codigo); 
        $sentenca->bindValue(':codUsuario', $id); 
        $sentenca->execute();     
        $conexao = null;
        return $sentenca->fetch();
    }catch (PDOException $erro){
        return -1;
    }
}


function cancelarSubmissao($id){
    try{
        $sql = "UPDATE Documento SET situacao = :sit WHERE codigoDocumento = :codigoDocumento;";

        $conexao = criarConexao();        
        $sentenca = $conexao->prepare($sql);
        $sentenca->bindValue(':sit', "Cancelado"); 
        $sentenca->bindValue(':codigoDocumento', $id); 
    
        $sentenca->execute();     

        $sql = "UPDATE DocumentoUsuario SET situacao = :sit, mudanca = :mudanca WHERE codigoDocumento = :codigoDocumento;";

        date_default_timezone_set('America/Sao_Paulo');
        $data = new DateTime();
        $dataFormatada = $data->format('d/m/Y H:i:s');

        $conexao = criarConexao();        
        $sentenca = $conexao->prepare($sql);
        $sentenca->bindValue(':sit', "Cancelado"); 
        $sentenca->bindValue(':mudanca', $dataFormatada); 
        $sentenca->bindValue(':codigoDocumento', $id); 
    
        $sentenca->execute();
        
        
        $conexao = null;
        return 0;
    }catch (PDOException $erro){
        return -1;
    }
}

function assinar($cod, $user){
    try{
        $sql = "UPDATE DocumentoUsuario SET situacao = :sit, mudanca = :horario WHERE codigoDocumento = :codigoDocumento AND codUsuario = :codUsuario;";

        $conexao = criarConexao();        
        $sentenca = $conexao->prepare($sql);
        $sentenca->bindValue(':sit', "Assinado");
        date_default_timezone_set('America/Sao_Paulo');
        $data = new DateTime();
        $dataFormatada = $data->format('d/m/Y H:i:s');
        $sentenca->bindValue(':horario', $dataFormatada);  
        $sentenca->bindValue(':codigoDocumento', $cod); 
        $sentenca->bindValue(':codUsuario', $user); 
    
        $sentenca->execute();         
        
        $conexao = null;
        return 0;
    }catch (PDOException $erro){
        return -1;
    }
}

function contarSignatarios($cod){
    try{
        $sql = "SELECT COUNT(*) 
                FROM DocumentoUsuario 
                WHERE codDocumento = :codigoDocumento;";

        $conexao = criarConexao();        
        $sentenca = $conexao->prepare($sql); 
        $sentenca->bindValue(':codigoDocumento', $cod); 
    
        $sentenca->execute();         
        
        $totalLinhas = $sentenca->fetchColumn();

        $conexao = null;

        return $totalLinhas; // Retorna true se todas as linhas têm situação 'Assinado' ou nula, caso contrário, retorna false.
    } catch (PDOException $erro){
        return -1; // Retorna false em caso de erro.
    }
    
}

function contarAssinaturas($cod){
    try{
        $sql = "SELECT COUNT(*) 
                FROM DocumentoUsuario 
                WHERE codDocumento = :codigoDocumento 
                AND situacao = 'Assinado'";

        $conexao = criarConexao();        
        $sentenca = $conexao->prepare($sql); 
        $sentenca->bindValue(':codigoDocumento', $cod); 
    
        $sentenca->execute();         
        
        $totalLinhas = $sentenca->fetchColumn();

        $conexao = null;

        return $totalLinhas; // Retorna true se todas as linhas têm situação 'Assinado' ou nula, caso contrário, retorna false.
    } catch (PDOException $erro){
        return -1; // Retorna false em caso de erro.
    }
}

function verificarDoc($cod){
   $sigs = contarSignatarios($cod);
   $assis = contarAssinaturas($cod);
   if($sigs == $assis){
    return true;
   }else{
    return false;
   }
}

function mudarSituacao($codigo){
    try{
        $sql = "UPDATE Documento SET situacao = :sit WHERE codigoDocumento = :codigoDocumento;";

        $conexao = criarConexao();        
        $sentenca = $conexao->prepare($sql);
        $sentenca->bindValue(':sit', "Assinado"); 
        $sentenca->bindValue(':codigoDocumento', $codigo); 
    
        $sentenca->execute();         
        
        $conexao = null;
        return 0;
    }catch (PDOException $erro){
        return -1;
    }
}