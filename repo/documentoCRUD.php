<?php
include_once "bancoDadosCRUD.php";

function submissao($nome, $usuario, $caminho, $tipo, $acesso)
{
    try {
        $conexao = criarConexao();
        date_default_timezone_set('America/Sao_Paulo');
        $data = new DateTime();
        $dataFormatada = $data->format('d/m/Y H:i:s');
        $sql = "INSERT INTO Documento(nome, usuario, horarioSubmissao, situacao, caminho, tipo, acesso) 
                    VALUES(:nome, :usuario, :horarioSubmissao, :situacao, :caminho, :tipo, :acesso);";
        $sentenca = $conexao->prepare($sql);
        $sentenca->bindValue(':nome', $nome);
        $sentenca->bindValue(':usuario', $usuario);
        $sentenca->bindValue(':horarioSubmissao', $dataFormatada);
        $sentenca->bindValue(':situacao', "Pendente");
        $sentenca->bindValue(':caminho', $caminho);
        $sentenca->bindValue(':tipo', $tipo);
        $sentenca->bindValue(':acesso', $acesso);
        $sentenca->execute();
        $codigo = $conexao->lastInsertId();
        $conexao = null;
        return $codigo;
    } catch (PDOException $erro) {
        echo ($erro);
        die();
    }
}

function enviarParaAssinar($signatarios, $codDoc, $nomeDoc)
{
    try {
        $conexao = criarConexao();
        $processos = [];
        $x = 0;
        $signatarios = json_decode($signatarios);
        foreach ($signatarios as $sig) {
            include '../controle/envioEmail.php';
            include 'usuarioCRUD.php';
            $usuario=buscarUsuarioPorId($sig);
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
            enviarEmail($usuario['email'], $codDoc, $usuario['nome'], $nomeDoc);
        }

        $conexao = null;
        return $processos;
    } catch (PDOException $erro) {
        echo ($erro);
        die();
    }
}

function listar()
{
    try {
        $conexao = criarConexao();
        $sql = "SELECT * FROM Documento ORDER BY horarioSubmissao DESC;";
        $sentenca = $conexao->prepare($sql);
        $sentenca->execute();
        $conexao = null;
        return $sentenca->fetchAll();
        ;
    } catch (PDOException $erro) {
        echo ($erro);
        die();
    }
}

function filtrarPorTipo($tipoSelecionado)
{
    try {
        $conexao = criarConexao();
        $sql = "SELECT * FROM Documento WHERE tipo = :tipo";
        $sentenca = $conexao->prepare($sql);
        $sentenca->bindValue(':tipo', $tipoSelecionado);
        $sentenca->execute();
        $conexao = null;
        return $sentenca->fetchAll();
        ;
    } catch (PDOException $erro) {
        echo ($erro);
        die();
    }
}

function buscarTipo($tipoSelecionado)
{
    try {
        $conexao = criarConexao();
        $sql = "SELECT * FROM TipoDocumento WHERE id = :id";
        $sentenca = $conexao->prepare($sql);
        $sentenca->bindValue(':id', $tipoSelecionado);
        $sentenca->execute();
        $conexao = null;
        return $sentenca->fetch();
        ;
    } catch (PDOException $erro) {
        echo ($erro);
        die();
    }
}

function listarPorUsuario($id)
{
    try {
        $conexao = criarConexao();
        $sql = "SELECT * FROM Documento INNER JOIN DocumentoUsuario AS du ON du.codigoDocumento = Documento.codigoDocumento WHERE codUsuario = :codigo;";
        $sentenca = $conexao->prepare($sql);
        $sentenca->bindValue(':codigo', $id);
        $sentenca->execute();
        $conexao = null;
        return $sentenca->fetchAll();
        ;
    } catch (PDOException $erro) {
        echo ($erro);
        die();
    }
}

function buscarDocumento($codigo)
{
    try {
        $sql = "SELECT * FROM Documento WHERE codigoDocumento = :codigo;";

        $conexao = criarConexao();
        $sentenca = $conexao->prepare($sql);
        $sentenca->bindValue(':codigo', $codigo);

        $sentenca->execute();
        $conexao = null;
        return $sentenca->fetch();
    } catch (PDOException $erro) {
        return -1;
    }
}

function buscarVerificacao($codigo, $comprovante)
{
    try {
        $sql = "SELECT * FROM Documento WHERE codigoDocumento = :codigo AND comprovante = :comprovante;";

        $conexao = criarConexao();
        $sentenca = $conexao->prepare($sql);
        $sentenca->bindValue(':codigo', $codigo);
        $sentenca->bindValue(':comprovante', $comprovante);


        $sentenca->execute();
        $conexao = null;
        return $sentenca->fetch();
    } catch (PDOException $erro) {
        return -1;
    }
}

function buscarSignatarios($codigo)
{
    try {
        $sql = "SELECT * FROM DocumentoUsuario WHERE codigoDocumento = :codigoDocumento;";

        $conexao = criarConexao();
        $sentenca = $conexao->prepare($sql);
        $sentenca->bindValue(':codigoDocumento', $codigo);

        $sentenca->execute();
        $conexao = null;
        return $sentenca->fetchAll();
    } catch (PDOException $erro) {
        return -1;
    }
}

function buscarSignatariosPorId($codigo, $id)
{
    try {
        $sql = "SELECT * FROM DocumentoUsuario WHERE codigoDocumento = :codigoDocumento AND codUsuario = :codUsuario;";

        $conexao = criarConexao();
        $sentenca = $conexao->prepare($sql);
        $sentenca->bindValue(':codigoDocumento', $codigo);
        $sentenca->bindValue(':codUsuario', $id);
        $sentenca->execute();
        $conexao = null;
        return $sentenca->fetch();
    } catch (PDOException $erro) {
        return -1;
    }
}


function cancelarSubmissao($id)
{
    try {
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
    } catch (PDOException $erro) {
        return -1;
    }
}

function assinar($cod, $user)
{
    try {
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
    } catch (PDOException $erro) {
        return -1;
    }
}

function contarSignatarios($cod)
{
    try {
        $sql = "SELECT COUNT(*) 
                FROM DocumentoUsuario 
                WHERE codigoDocumento = :codigoDocumento;";

        $conexao = criarConexao();
        $sentenca = $conexao->prepare($sql);
        $sentenca->bindValue(':codigoDocumento', $cod);

        $sentenca->execute();

        $totalLinhas = $sentenca->fetchColumn();

        $conexao = null;

        return $totalLinhas; // Retorna true se todas as linhas têm situação 'Assinado' ou nula, caso contrário, retorna false.
    } catch (PDOException $erro) {
        return -1; // Retorna false em caso de erro.
    }

}

function contarAssinaturas($cod)
{
    try {
        $sql = "SELECT COUNT(*) 
                FROM DocumentoUsuario 
                WHERE codigoDocumento = :codigoDocumento 
                AND situacao = 'Assinado'";

        $conexao = criarConexao();
        $sentenca = $conexao->prepare($sql);
        $sentenca->bindValue(':codigoDocumento', $cod);

        $sentenca->execute();

        $totalLinhas = $sentenca->fetchColumn();

        $conexao = null;

        return $totalLinhas; // Retorna true se todas as linhas têm situação 'Assinado' ou nula, caso contrário, retorna false.
    } catch (PDOException $erro) {
        return -2; // Retorna false em caso de erro.
    }
}

function verificarDoc($cod)
{
    $sigs = contarSignatarios($cod);
    $assis = contarAssinaturas($cod);
    if ($sigs == $assis) {
        return true;
    } else {
        return false;
    }
}
function verificarAssinatura($codUsuario, $codigoDocumento)
{
    try {
        $conexao = criarConexao();
        $sql = "SELECT COUNT(*) 
                FROM DocumentoUsuario 
                WHERE codUsuario = :codUsuario 
                AND codigoDocumento = :codigoDocumento 
                AND situacao = 'Assinado';";
        $sentenca = $conexao->prepare($sql);
        $sentenca->bindValue(':codUsuario', $codUsuario);
        $sentenca->bindValue(':codigoDocumento', $codigoDocumento);
        $sentenca->execute();
        $conexao = null;
        $totalAssinaturas = $sentenca->fetchColumn();
        return $totalAssinaturas > 0; // Retorna verdadeiro se houver pelo menos uma assinatura para o usuário e o documento especificados.
    } catch (PDOException $erro) {
        echo ($erro);
        die();
    }
}

function verificarValidadeDocumento($codigoDocumento, $comprovante)
{
    try {
        $conexao = criarConexao();
        $sql = "SELECT COUNT(*) 
                FROM Documento 
                WHERE codigoDocumento = :codigoDocumento 
                AND comprovante = :comprovante 
                AND situacao = 'Assinado';";
        $sentenca = $conexao->prepare($sql);
        $sentenca->bindValue(':codigoDocumento', $codigoDocumento);
        $sentenca->bindValue(':comprovante', $comprovante);
        $sentenca->execute();
        $conexao = null;
        $totalDocumentos = $sentenca->fetchColumn();
        return $totalDocumentos > 0; // Retorna verdadeiro se o comprovante corresponder ao código do documento e o documento estiver assinado.
    } catch (PDOException $erro) {
        echo ($erro);
        die();
    }
}

function mudarSituacao($codigoDocumento)
{
    $comprovante = '';
    $caracteres = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';

    // Gera um código com 6 caracteres para o comprovante
    for ($i = 0; $i < 6; $i++) {
        $comprovante .= $caracteres[rand(0, strlen($caracteres) - 1)];
    }
    try {
        $sql = "UPDATE Documento SET situacao = :sit, comprovante = :comp WHERE codigoDocumento = :codigoDocumento;";

        $conexao = criarConexao();
        $sentenca = $conexao->prepare($sql);
        $sentenca->bindValue(':sit', "Assinado");
        $sentenca->bindValue(':comp', $comprovante); // Usando o comprovante gerado aleatoriamente
        $sentenca->bindValue(':codigoDocumento', $codigoDocumento); // Usando o código do documento fornecido

        $sentenca->execute();

        $conexao = null;
        return 0;
    } catch (PDOException $erro) {
        echo $erro;
    }

    
}

function listarTipos()
{
    try {
        $conexao = criarConexao();
        $sql = "SELECT * FROM TipoDocumento;";
        $sentenca = $conexao->prepare($sql);
        $sentenca->execute();
        $conexao = null;
        return $sentenca->fetchAll();
    } catch (PDOException $erro) {
        echo ($erro);
        die();
    }
}
