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
    tipo VARCHAR(255),
    acesso INT, 
    comprovante VARCHAR(255),
    FOREIGN KEY (tipo) REFERENCES TipoDocumento(id),
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

-- Criação de tabela tipo 
CREATE TABLE IF NOT EXISTS TipoDocumento (
    id INT,
    tipo VARCHAR(255),
    PRIMARY KEY (id)
);

INSERT INTO TipoDocumento (id, tipo)
Values
(1, "Oficio"),
(2, "Ata"),
(3, "Prestação de contas"),
(4, "Registro Movimentação Financeira"),
(5, "Documentos de Gestão"),
(6, "Convocação"),
(7, "Solicitação de Verba"),
(8, "Outro");
