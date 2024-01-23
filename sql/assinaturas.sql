-- Criação do banco de dados
CREATE DATABASE Assinaturas;

-- Seleciona o banco de dados
USE Assinaturas;

-- Criação da tabela Usuario
CREATE TABLE Usuario (
    codigo INT PRIMARY KEY AUTO_INCREMENT,
    cargo VARCHAR(255),
    senha VARCHAR(255),
    email VARCHAR(255),
    nome VARCHAR(255)
);

CREATE TABLE Documento (
    codigoDocumento INT PRIMARY KEY AUTO_INCREMENT,
    nome VARCHAR(255),
    usuario VARCHAR(255),
    horarioSubmissao VARCHAR(255)    
);

CREATE TABLE DocumentoUsuario (
    codUsuario FOregin Key
    codigoDocumento Foregin Keu
    horario VARCHAR(255)
    situacao VARCHAR(255)
);
