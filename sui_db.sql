CREATE DATABASE sistema_chamados;
USE sistema_chamados;

CREATE TABLE tb_setor (
    id_setor INT PRIMARY KEY AUTO_INCREMENT,
    nm_setor VARCHAR(50) NOT NULL
);

CREATE TABLE tb_user (
    id_user INT PRIMARY KEY AUTO_INCREMENT,
    nm_user VARCHAR(40) NOT NULL,
    email VARCHAR(40) UNIQUE NOT NULL,
    senha VARCHAR(255) NOT NULL,
    nr_celular VARCHAR(11),
    setor varchar(40),
    dt_cadastro DATETIME DEFAULT CURRENT_TIMESTAMP
);

select * from tb_user;

/*insert do banco*/
create table tb_tipo(
	id_tipo int auto_increment primary key,
    nm_tipo varchar(20)
);

insert into tb_tipo value 
	(null, 'Incidente'), 
    (null, 'Requisição');

create table tb_categoria(
	id_categoria int auto_increment primary key,
    nm_categoria varchar(30)
);

insert into tb_categoria value 
	(null, 'Notebook'),
    (null, 'Desktop'),
    (null, 'Celular'),
    (null, 'Redes');

create table tb_urgencia(
	id_urgencia int auto_increment primary key,
    nm_urgencia varchar(20)
);

insert into tb_urgencia value
	(null, 'Muito baixa'),
    (null, 'Baixa'),
    (null, 'Média'),
    (null, 'Alta'),
    (null, 'Muito Alta');

 /*fim insert*/

CREATE TABLE tb_chamado (
	cd_chamado int auto_increment primary key, 
    fk_tipo int,
    fk_categoria int,
    fk_urgencia int,
    titulo varchar(60),
    descricao varchar(100),
    
    foreign key (fk_tipo) references tb_tipo (id_tipo),
	foreign key (fk_categoria) references tb_categoria (id_categoria),
	foreign key (fk_urgencia) references tb_urgencia (id_urgencia)
);

CREATE TABLE log_chamado (
    id_log INT PRIMARY KEY AUTO_INCREMENT,
    id_chamado INT NOT NULL,
    acao ENUM('INSERT','UPDATE','DELETE') NOT NULL,
    usuario_responsavel INT,
    dados_anteriores TEXT,
    dados_novos TEXT,
    data_acao DATETIME DEFAULT CURRENT_TIMESTAMP,

    FOREIGN KEY (id_chamado) REFERENCES tb_chamado(id_chamado),
    FOREIGN KEY (usuario_responsavel) REFERENCES tb_user(id_user)
);

DELIMITER $$
CREATE TRIGGER trg_chamado_insert
AFTER INSERT ON tb_chamado
FOR EACH ROW
BEGIN
    INSERT INTO log_chamado (
        id_chamado, acao, usuario_responsavel, dados_novos
    ) VALUES (
        NEW.id_chamado,
        'INSERT',
        NEW.fk_id_usuario,
        CONCAT(
            'Titulo: ', NEW.titulo,
            ' | Descricao: ', NEW.descricao,
            ' | Status: ', NEW.status_chamado,
            ' | Prioridade: ', NEW.prioridade
        )
    );
END$$
DELIMITER ;

DELIMITER $$
CREATE TRIGGER trg_chamado_update
AFTER UPDATE ON tb_chamado
FOR EACH ROW
BEGIN
    INSERT INTO log_chamado (
        id_chamado, acao, usuario_responsavel, dados_anteriores, dados_novos
    ) VALUES (
        OLD.id_chamado,
        'UPDATE',
        NEW.fk_id_usuario,
        CONCAT(
            'Titulo: ', OLD.titulo,
            ' | Descricao: ', OLD.descricao,
            ' | Status: ', OLD.status_chamado,
            ' | Prioridade: ', OLD.prioridade
        ),
        CONCAT(
            'Titulo: ', NEW.titulo,
            ' | Descricao: ', NEW.descricao,
            ' | Status: ', NEW.status_chamado,
            ' | Prioridade: ', NEW.prioridade
        )
    );
END$$
DELIMITER ;

DELIMITER $$
CREATE TRIGGER trg_chamado_delete
AFTER DELETE ON tb_chamado
FOR EACH ROW
BEGIN
    INSERT INTO log_chamado (
        id_chamado, acao, usuario_responsavel, dados_anteriores
    ) VALUES (
        OLD.id_chamado,
        'DELETE',
        OLD.fk_id_usuario,
        CONCAT(
            'Titulo: ', OLD.titulo,
            ' | Descricao: ', OLD.descricao,
            ' | Status: ', OLD.status_chamado,
            ' | Prioridade: ', OLD.prioridade
        )
    );
END$$
DELIMITER ;
