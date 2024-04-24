create database projetointegrador2

create table usuario
(
idusuario int not null auto_increment,
nome varchar (50) not null,
cpf int not null,
telefone int not null,
email varchar (30),
senha varchar (50) not null,
tipo varchar (50) not null,
primary key (idusuario)
)

create table equipamento
(
idequipamento int not null auto_increment,
nome_equipamento varchar (100) not null,
descricao varchar (200) not null,
condicoes ENUM ('Novo', 'Semi Novo', 'Usado', 'descarte') not null,
preco decimal (10,2) not null,
disponibilidade boolean,
idusuario int,
primary key (idequipamento),
foreign key (idusuario) references usuario (idusuario)
)

create table pecas
(
idpeca int not null auto_increment,
nome_peca varchar(80),
descricao text,
disponibilidade boolean,
preco decimal(10,2),
idequipamento int,
primary key (idpeca),
foreign key (idequipamento) references equipamento (idequipamento)
)

create table pontodecoleta
(
idloja int not null auto_increment,
idusuario int,
nome_loja varchar (100) not null,
endereco varchar (255) not null,
horario_funcionamento varchar (100) not null,
responsavel varchar (100) not null,
contato varchar (50) not null,
primary key (idloja),
foreign key (idusuario) references usuario (idusuario)
)

create table logistica_reversa
(
idlogistica int not null auto_increment,
idequipamento int,
motivo_descarte varchar(200),
data_recebimento date,
estado_equipamento varchar(50),
responsavel_recebimento varchar(100),
observacoes text,
primary key (idlogistica),
foreign key (idequipamento) references equipamento (idequipamento)
)
