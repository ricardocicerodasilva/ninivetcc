create database  bd_login;
use bd_login;

CREATE TABLE  usuario (
  id_usuario INT AUTO_INCREMENT PRIMARY KEY,
  login varchar(50) NOT NULL,
  senha varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO usuario (login, senha) VALUES ('ricardo', MD5('123456'));
INSERT INTO usuario (login, senha) VALUES ('tiago', MD5('123456'));
INSERT INTO usuario (login, senha) VALUES ('joao', MD5(''));
UPDATE usuario SET senha = MD5('1') WHERE senha = '';
SET SQL_SAFE_UPDATES = 0;
select * from usuario;
ALTER TABLE usuario ADD UNIQUE (login);


CREATE TABLE aluno (

rm_aluno int (4) primary key not null,
nome_aluno varchar(30) not null,
email varchar (50) not null,
telefone varchar (11) not null,
turma varchar(30) not null,
periodo varchar (10) not null,
senha varchar (30) not null,
bloqueado TINYINT DEFAULT FALSE,
motivo_bloq varchar(50)
);
CREATE TABLE LIVRO(
 id_livro int(4) primary key auto_increment,
   nome_livro varchar(30) not null,    
    autor varchar (30),
genero varchar(30),
edicao int (4),
	editora varchar(30),
    data_publi date,
    quantidade int (4),
    descricao varchar (300),
    arquivar_livro boolean DEFAULT false,
	motivo_arq varchar(50)
        
);
CREATE TABLE reserva (
  num_reserva int(4) PRIMARY KEY AUTO_INCREMENT,
  data_reserva TIMESTAMP DEFAULT CURRENT_TIMESTAMP NOT NULL,
  data_devolucao TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  rm_aluno int(4) NOT NULL,
  id_livro int(4) NOT NULL,
  login varchar(50) NOT NULL,
  FOREIGN KEY (rm_aluno) REFERENCES aluno (rm_aluno) ON DELETE CASCADE,
  FOREIGN KEY (id_livro) REFERENCES Livro (id_livro) ON DELETE CASCADE,
  FOREIGN KEY (login) REFERENCES usuario (login) ON DELETE CASCADE
);

SHOW FULL COLUMNS FROM usuario WHERE Field = 'login';

ALTER TABLE LIVRO ADD COLUMN arquivar_livro BOOLEAN DEFAULT FALSE;
ALTER TABLE LIVRO ADD COLUMN motivo_arq varchar(50);

select * from reserva;
SHOW INDEX FROM usuario;

SHOW FULL COLUMNS FROM usuario WHERE Field = 'login';
SHOW FULL COLUMNS FROM reserva WHERE Field = 'login';

ALTER TABLE usuario ADD UNIQUE (login);


 DROP TABLE reserva;
 SHOW CREATE TABLE aluno;
SHOW CREATE TABLE livro;
SHOW CREATE TABLE usuario;
