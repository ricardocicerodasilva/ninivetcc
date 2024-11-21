Create DATABASE db_ninivebiblio;
use db_ninivebiblio;

CREATE TABLE bibliotecario(
	id_bibli int(4) PRIMARY KEY auto_increment NOT NULL,
    login varchar (30) not null UNIQUE,
	senha varchar (255) NOT NULL,
    foto_perfil varchar(255) default './assets/default.png',
    usuario_tipo varchar(20)
);
INSERT INTO bibliotecario (login, senha, usuario_tipo) VALUES ('admin', MD5('senha123'), 'master');
INSERT INTO bibliotecario (login, senha, usuario_tipo) VALUES ('elvira', MD5('123'), 'comum');
INSERT INTO bibliotecario (login, senha, usuario_tipo) VALUES ('master', MD5('123'), 'master');



CREATE TABLE aluno (
	rm_aluno int(4) PRIMARY KEY NOT NULL,
	senha varchar(30) NOT NULL,
	bloqueado boolean DEFAULT false,
	motivo_bloq varchar(50),
	nome_aluno varchar(30) NOT NULL,
	email varchar(50) NOT NULL UNIQUE,
	telefone varchar(11) NOT NULL,
	turma varchar(30) NOT NULL,
	periodo varchar(10) NOT NULL,
	foto_perfil varchar(255) default './assets/default.png'
);

CREATE TABLE livro(
	id_livro int(4) PRIMARY KEY AUTO_INCREMENT,
	data_cadastro date,
	arquivar_livro boolean DEFAULT false,
	motivo_arq varchar(50),    
    cdd varchar(10),
    cutter varchar(5),
	autor varchar(50),
	nome_livro varchar(50) NOT NULL ,
    subtitulo varchar(50),
    serie_colecao varchar(50),
	edicao int(4),
    volume int(4),
	local varchar(50),
    editor varchar(50),
	data_publicacao int(4),
    aquisicao varchar(50),
    exemplar int(4),
    lingua varchar(50),
    observacao varchar(50),
	capa_livro varchar(255) default './assets/capa/default.jpg'
);

CREATE TABLE reserva (
	num_reserva int(4) PRIMARY KEY AUTO_INCREMENT,
	data_reserva date,
	data_devolucao date,
	rm_aluno int(4) NOT NULL,
	id_livro  int(4) NOT NULL,   
    status VARCHAR(20) NOT NULL DEFAULT 'ativo',
	FOREIGN KEY (rm_aluno) REFERENCES aluno (rm_aluno) ON DELETE CASCADE,
	FOREIGN KEY (id_livro) REFERENCES livro (id_livro) ON DELETE CASCADE

);

CREATE TABLE confirma_reserva (
	confirmar_reserva boolean DEFAULT false,
	confirmar_devolucao boolean DEFAULT false,
	livro_disponivel boolean DEFAULT true,
	data_confirmacao timestamp DEFAULT current_timestamp,
	anotacao varchar(30) NOT NULL,
	rm_aluno int(4),
	num_reserva int(4),
	FOREIGN KEY (rm_aluno) REFERENCES aluno (rm_aluno) ON DELETE CASCADE,
	FOREIGN KEY (num_reserva) REFERENCES reserva (num_reserva) ON DELETE CASCADE	
);


CREATE TABLE localizacao (
	prateleira varchar(4) PRIMARY KEY NOT NULL,
	corredor int(4),
	setor varchar(4)
);
create table anotacao(
id_anotacao int (4) primary key auto_increment,
anotacao varchar (30),
data_anotacao date

);

CREATE TABLE notificacao(
	id_notificacao int(4) PRIMARY KEY AUTO_INCREMENT,
    titulo_notificacao varchar(30) NOT NULL,
    menssagem_notificacao varchar(100) NOT NULL,
	data_notificacao timestamp DEFAULT current_timestamp,
    menssagem_lida boolean DEFAULT false,
	rm_aluno int(4),
	id_bibli int(4),
	FOREIGN KEY (rm_aluno) REFERENCES aluno (rm_aluno) ON DELETE CASCADE,
	FOREIGN KEY (id_bibli) REFERENCES bibliotecario (id_bibli) ON DELETE CASCADE	
);

CREATE TABLE relatorio_mensal (
    id INT AUTO_INCREMENT PRIMARY KEY,
    mes INT NOT NULL,
    ano INT NOT NULL,
    descricao VARCHAR(255),
    data_geracao TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    conteudo TEXT NOT NULL
);




INSERT INTO livro (nome_livro, autor, genero, edicao, editora, data_publicacao, quantidade, descricao) VALUES
('O Senhor dos Anéis', 'J.R.R. Tolkien', 'Fantasia', 1, 'HarperCollins', '1954-07-29', 5, 'Uma das maiores obras da fantasia.'),
('1984', 'George Orwell', 'Distopia', 1, 'Secker & Warburg', '1949-06-08', 3, 'Um clássico sobre vigilância e totalitarismo.'),
('Dom Casmurro', 'Machado de Assis', 'Romance', 1, 'Mestre Jou', '1899-04-01', 4, 'Uma narrativa sobre ciúmes e traições.'),
('A Revolução dos Bichos', 'George Orwell', 'Fábula', 1, 'Secker & Warburg', '1945-08-17', 6, 'Uma crítica ao totalitarismo através de uma fábula.'),
('O Pequeno Príncipe', 'Antoine de Saint-Exupéry', 'Fábula', 1, 'Reynal & Hitchcock', '1943-04-06', 7, 'Uma reflexão sobre a vida e a inocência.'),
('Cem Anos de Solidão', 'Gabriel García Márquez', 'Realismo Mágico', 1, 'Harper & Row', '1967-06-05', 2, 'A história da família Buendía.'),
('O Alquimista', 'Paulo Coelho', 'Ficção', 1, 'HarperCollins', '1988-05-01', 5, 'Uma jornada em busca do sonho pessoal.'),
('A Menina que Roubava Livros', 'Markus Zusak', 'Ficção', 1, 'Knopf', '2005-03-01', 4, 'Uma história sobre o poder das palavras.'),
('Orgulho e Preconceito', 'Jane Austen', 'Romance', 1, 'T. Egerton', '1813-01-28', 3, 'Uma crítica social através da história de Elizabeth Bennet.'),
('O Hobbit', 'J.R.R. Tolkien', 'Fantasia', 1, 'George Allen & Unwin', '1937-09-21', 8, 'A aventura de Bilbo Bolseiro.');

INSERT INTO aluno (rm_aluno, senha, bloqueado, motivo_bloq, nome_aluno, email, telefone, turma, periodo) VALUES
(1001, 'senha123', false, NULL, 'Ana Silva', 'ana@email.com', '11987654321', '1A', '2023-1'),
(1002, 'senha456', false, NULL, 'Pedro Santos', 'pedro@email.com', '11998765432', '1B', '2023-1'),
(1003, 'senha789', false, NULL, 'Maria Oliveira', 'maria@email.com', '11876543210', '2A', '2023-2'),
(1004, 'senha321', false, NULL, 'Lucas Pereira', 'lucas@email.com', '11765432109', '2B', '2023-2'),
(1005, 'senha654', false, NULL, 'Julia Almeida', 'julia@email.com', '11654321098', '3A', '2023-3'),
(1006, 'senha987', false, NULL, 'Felipe Costa', 'felipe@email.com', '11543210987', '3B', '2023-3'),
(1007, 'senha1234', false, NULL, 'Tatiane Lima', 'tatiane@email.com', '11432109876', '4A', '2023-4'),
(1008, 'senha5678', false, NULL, 'Renan Rocha', 'renan@email.com', '11321098765', '4B', '2023-4'),
(1009, 'senha4321', false, NULL, 'Fernanda Martins', 'fernanda@email.com', '11210987654', '5A', '2023-5'),
(1010, 'senha8765', false, NULL, 'Gabriel Torres', 'gabriel@email.com', '11109876543', '5B', '2023-5');

INSERT INTO bibliotecario (login, senha) VALUES ('ricardo', MD5('123'));


INSERT INTO reserva (data_reserva, data_devolucao, rm_aluno, id_livro) VALUES
('2024-10-01', '2024-10-15', 1001, '1'),
('2024-10-02', '2024-10-16', 1002, '5'),
('2024-10-03', '2024-10-17', 1003, '8');

select * from reserva;
SELECT * FROM relatorio 




