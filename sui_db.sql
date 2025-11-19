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
    fk_id_setor INT,
    dt_cadastro DATETIME DEFAULT CURRENT_TIMESTAMP,

    FOREIGN KEY (fk_id_setor) REFERENCES tb_setor(id_setor)
);

CREATE TABLE tb_chamado (
    id_chamado INT PRIMARY KEY AUTO_INCREMENT,
    titulo VARCHAR(100) NOT NULL,
    descricao TEXT NOT NULL,
    status_chamado ENUM('aberto','em_andamento','finalizado') DEFAULT 'aberto',
    prioridade ENUM('baixa','media','alta') DEFAULT 'media',
    dt_abertura DATETIME DEFAULT CURRENT_TIMESTAMP,
    dt_fechamento DATETIME NULL,

    fk_id_usuario INT NOT NULL,
    fk_id_setor INT NOT NULL,

    FOREIGN KEY (fk_id_usuario) REFERENCES tb_user(id_user),
    FOREIGN KEY (fk_id_setor) REFERENCES tb_setor(id_setor)
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
