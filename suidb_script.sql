create database db_sui;

use db_sui;

create table tb_setor (
	id_setor int primary key auto_increment,
    nm_setor varchar(50) not null
);

create table tb_urgencia (
	id_urgencia int primary key auto_increment,
    nm_urgencia varchar(15) not null
);

create table tb_categoria (
	id_categoria int primary key auto_increment,
    nm_categoria varchar(50) not null
);

create table tb_tipo_chamado (
	id_tipo int primary key auto_increment,
    nm_tipo varchar(30) not null
);

create table tb_user (
	id_user int primary key auto_increment,
    nm_user varchar(40) not null,
    email varchar(150) unique not null,
    senha varchar(255) not null,
    nr_celular varchar(15),
    fk_id_setor int not null,
    FOREIGN KEY (fk_id_setor) REFERENCES tb_setor(id_setor),
    dt_cadastro datetime default current_timestamp
);

create table tb_chamado(
	id_chamado int primary key auto_increment,
    fk_id_tipo int not null,
    FOREIGN KEY (fk_id_tipo) REFERENCES tb_tipo_chamado(id_tipo),
    fk_id_categoria int not null,
    FOREIGN KEY (fk_id_categoria) REFERENCES tb_categoria(id_categoria),
    nm_titulo varchar(100) not null,
    descricao text,
    dt_abertura datetime default current_timestamp,
    dt_fechamento datetime null,
    status_atual ENUM('aberto','em andamento','fechado'),
    fk_id_urgencia int not null,
    FOREIGN KEY (fk_id_urgencia) REFERENCES tb_urgencia(id_urgencia),
    fk_id_user int not null,
    FOREIGN KEY (fk_id_user) REFERENCES tb_user(id_user)
);

create table tb_status_chamado (
	id_status int primary key auto_increment,
    fk_id_chamado int not null,
    foreign key (fk_id_chamado) REFERENCES tb_chamado(id_chamado),
    status varchar(30) not null,
    dt_status datetime default current_timestamp,
    observacao varchar(255)
);

create table tb_tecnico (
	id_tecnico int primary key auto_increment,
    nm_tecnico varchar(50) not null,
    email varchar(50) unique not null,
    ativo boolean not null default true
);

create table tb_tecnico_chamado (
    id_tecnico int,
    id_chamado int,
    dt_atribuicao DATETIME default current_timestamp,
    primary key(id_tecnico, id_chamado),
    foreign key(id_tecnico) references tb_tecnico(id_tecnico),
    foreign key(id_chamado) references tb_chamado(id_chamado)
);

create table  tb_lembrete_publico (
	id_lembrete int primary key auto_increment,
	titulo varchar(80),
    mensagem text,
    dt_criacao datetime default current_timestamp,
    fk_id_user int,
    foreign key(fk_id_user) references tb_user(id_user)
);

ALTER TABLE tb_chamado ADD INDEX (fk_id_user);
ALTER TABLE tb_chamado ADD INDEX (fk_id_categoria);
ALTER TABLE tb_chamado ADD INDEX (fk_id_tipo);
ALTER TABLE tb_chamado ADD INDEX (fk_id_urgencia);
ALTER TABLE tb_status_chamado ADD INDEX (fk_id_chamado);

INSERT INTO tb_setor (nm_setor) VALUES
('TI'),
('Financeiro'),
('RH'),
('Atendimento'),
('Diretoria');

INSERT INTO tb_urgencia (nm_urgencia) VALUES
('Baixa'),
('Média'),
('Alta'),
('Crítica');

INSERT INTO tb_categoria (nm_categoria) VALUES
('Hardware'),
('Software'),
('Rede'),
('Acesso'),
('Sistema Interno');

INSERT INTO tb_tipo_chamado (nm_tipo) VALUES
('Problema'),
('Solicitação'),
('Incidente'),
('Melhoria');

INSERT INTO tb_user (nm_user, email, senha, nr_celular, fk_id_setor) VALUES
('Gustavo Martines', 'gustavomartines@sui.com', '123456', '11988887777', 1),
('Ana Pereira', 'anapereira@sui.com', '123456', '11999998888', 2),
('Carlos Souza', 'carlossouza@sui.com', '123456', '11977776666', 3),
('Mariana Lima', 'marianalima@sui.com', '123456', '11955554444', 4);

INSERT INTO tb_chamado 
(fk_id_tipo, fk_id_categoria, nm_titulo, descricao, status_atual, fk_id_urgencia, fk_id_user)
VALUES
(1, 1, 'Computador não liga', 'Ao tentar ligar, apenas a luz pisca.', 'aberto', 3, 1),
(1, 3, 'Sem conexão com a rede', 'Usuário não consegue acessar a internet.', 'em andamento', 4, 2),
(2, 4, 'Solicitação de acesso ao sistema X', 'Usuário precisa de acesso administrativo.', 'aberto', 2, 3),
(3, 2, 'Erro ao abrir o software Y', 'Mensagem de erro desconhecida.', 'fechado', 1, 4);

INSERT INTO tb_status_chamado 
(fk_id_chamado, status, observacao)
VALUES
(1, 'aberto', 'Chamado criado pelo usuário'),
(2, 'em andamento', 'Equipe de rede está investigando'),
(3, 'aberto', 'Aguardando aprovação do gestor'),
(4, 'fechado', 'Problema resolvido pelo suporte');

INSERT INTO tb_tecnico (nm_tecnico, email, ativo) VALUES
('João Silva', 'joao@suporte.com', true),
('Renata Costa', 'renata@suporte.com', true),
('Fábio Mendes', 'fabio@suporte.com', false);

INSERT INTO tb_tecnico_chamado (id_tecnico, id_chamado) VALUES
(1, 1),
(2, 2),
(1, 3),
(2, 4);

INSERT INTO tb_lembrete_publico (titulo, mensagem, fk_id_user) VALUES
('Manutenção programada', 'O sistema ficará indisponível amanhã das 20h às 22h.', 1),
('Treinamento interno', 'Haverá treinamento para novos colaboradores na sexta.', 2);
