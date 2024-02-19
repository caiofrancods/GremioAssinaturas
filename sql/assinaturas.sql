-- Criação do banco de dados
CREATE DATABASE IF NOT EXISTS Assinaturas3;

-- Seleciona o banco de dados
USE Assinaturas3;


-- Criação da tabela Documento
CREATE TABLE IF NOT EXISTS Documento (
    codigoDocumento INT PRIMARY KEY AUTO_INCREMENT,
    nome VARCHAR(255),
    usuario INT,
    horarioSubmissao VARCHAR(255),
    situacao VARCHAR(255),
    caminho VARCHAR(255),
    comprovante VARCHAR(255)
);

-- Criação da tabela DocumentoUsuario
CREATE TABLE IF NOT EXISTS DocumentoUsuario (
    codUsuario INT,
    codigoDocumento INT,
    horario VARCHAR(255),
    situacao VARCHAR(255),
    mudanca VARCHAR (255),
    FOREIGN KEY (codigoDocumento) REFERENCES Documento(codigoDocumento),
    PRIMARY KEY (codUsuario, codigoDocumento)
);
