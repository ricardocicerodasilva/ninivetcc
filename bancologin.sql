create database  bd_login;
use bd_login;

CREATE TABLE usuario (
  id_usuario INT AUTO_INCREMENT PRIMARY KEY,
  login VARCHAR(50) NOT NULL,
  senha VARCHAR(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


INSERT INTO usuario (login, senha) VALUES ('ricardo', MD5('123456'));


select * from usuario;

-- DROP TABLE tb_dados;