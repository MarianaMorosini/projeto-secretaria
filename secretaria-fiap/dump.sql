/* Criando o banco de dados */
CREATE SCHEMA `secretaria` ;

/* Criando tabelas */
create table alunos (
    id integer primary key auto_increment,
    nome varchar(100) not null,
    data_nascimento date not null,
    cpf varchar(11) not null unique
);

create table turmas (
    id integer primary key auto_increment,
    nome varchar(100) not null,
    descricao varchar(255) not null
);

create table matriculas (
    id integer primary key auto_increment,
    aluno_id integer not null,
    turma_id integer not null,
    CONSTRAINT fk_aluno FOREIGN KEY (aluno_id) REFERENCES alunos(id),
    CONSTRAINT fk_turma FOREIGN KEY (turma_id) REFERENCES turmas(id)
);

INSERT INTO alunos (nome, data_nascimento, cpf) VALUES
('João Silva', '2005-05-15', '19369515097'),
('Maria Oliveira', '2006-08-20', '69461116055'),
('Pedro Santos', '2004-12-30', '50915200074');

INSERT INTO turmas (nome, descricao) VALUES
('Turma A', 'Turma de Matemática'),
('Turma B', 'Turma de História'),
('Turma C', 'Turma de Ciências');