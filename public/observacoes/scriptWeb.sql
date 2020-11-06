CREATE TABLE aluno (
  idAluno INTEGER UNSIGNED NOT NULL AUTO_INCREMENT,
  projeto_idprojeto INTEGER UNSIGNED NOT NULL,
  curso_idCurso INTEGER UNSIGNED NOT NULL,
  nome VARCHAR(255) NULL,
  idCurso INTEGER UNSIGNED NULL,
  idProjeto INTEGER UNSIGNED NULL,
  ra INTEGER UNSIGNED NULL,
  senha VARCHAR(255) NULL,
  PRIMARY KEY(idAluno),
  INDEX aluno_FKIndex1(curso_idCurso),
  INDEX aluno_FKIndex2(projeto_idprojeto)
);

CREATE TABLE curso (
  idCurso INTEGER UNSIGNED NOT NULL AUTO_INCREMENT,
  instituicao_idInstituicao INTEGER UNSIGNED NOT NULL,
  descricao VARCHAR(255) NULL,
  idInstituicao INTEGER UNSIGNED NULL,
  duracao INTEGER UNSIGNED NULL,
  area VARCHAR(255) NULL,
  PRIMARY KEY(idCurso),
  INDEX curso_FKIndex1(instituicao_idInsittuicao)
);

CREATE TABLE instituicao (
  idInstituicao INTEGER UNSIGNED NOT NULL AUTO_INCREMENT,
  nome VARCHAR(255) NULL,
  telefone INTEGER UNSIGNED NULL,
  endereco VARCHAR(255) NULL,
  PRIMARY KEY(idInsittuicao)
);

CREATE TABLE professor (
  idProfessor INTEGER UNSIGNED NOT NULL AUTO_INCREMENT,
  instituicao_idInstituicao INTEGER UNSIGNED NOT NULL,
  nome VARCHAR(255) NULL,
  idCurso INTEGER UNSIGNED NULL,
  idInstituicao INTEGER UNSIGNED NULL,
  senha VARCHAR(255) NULL,
  PRIMARY KEY(idProfessor),
  INDEX professor_FKIndex1(instituicao_idInsittuicao)
);

CREATE TABLE projeto (
  idprojeto INTEGER UNSIGNED NOT NULL AUTO_INCREMENT,
  professor_idProfessor INTEGER UNSIGNED NOT NULL,
  instituicao_idInstituicao INTEGER UNSIGNED NOT NULL,
  descricao VARCHAR(255) NULL,
  dataInicio DATE NULL,
  dataFim DATE NULL,
  idInstituicao INTEGER UNSIGNED NULL,
  idProfessor INTEGER UNSIGNED NULL,
  qntHoras INTEGER UNSIGNED NULL,
  PRIMARY KEY(idprojeto),
  INDEX projeto_FKIndex1(instituicao_idInsittuicao),
  INDEX projeto_FKIndex2(professor_idProfessor)
);


