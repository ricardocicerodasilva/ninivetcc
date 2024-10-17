create database agenda_compromissos;
use agenda_compromissos;

;

create table agenda(
id_compromisso int(4) primary key auto_increment,
nome_compromisso varchar(30),
data_compromisso date,
hora_inicio time,
hora_fim time,
descricao varchar (30),
localizacao varchar(30),
responsavel varchar(30)
);

