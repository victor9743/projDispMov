create database eleicao;
use eleicao;

create table votacoes(
	id int primary key auto_increment,
    cpf varchar(14) not null,
    voto varchar(2) not null
);