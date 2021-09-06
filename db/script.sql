CREATE DATABASE IF NOT EXISTS projeto_gazin;
USE projeto_gazin

CREATE TABLE IF NOT EXISTS desenvolvedores (
    id INT (11) AUTO_INCREMENT,
    nome VARCHAR(255),
    sexo CHAR(25),
    idade INT(25),
    hobby VARCHAR(100),
    data_nascimento DATE,
    PRIMARY KEY (id)
);

-- INSERT INTO desenvolvedores (id,nome,sexo,idade,hobby,data_nascimento) VALUES ('0','teste','teste','25','teste','2020-09-3');