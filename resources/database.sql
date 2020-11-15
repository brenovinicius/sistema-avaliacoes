CREATE DATABASE `sistema-avaliacoes` /*!40100 DEFAULT CHARACTER SET utf8 */;

CREATE TABLE IF NOT EXISTS `sistema-avaliacoes`.`professor` (
  `id` BIGINT NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(255) NOT NULL,
  `matricula` VARCHAR(15) NOT NULL,
  `email` VARCHAR(50) NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `matricula_UNIQUE` (`matricula` ASC),
  UNIQUE INDEX `email_UNIQUE` (`email` ASC))
ENGINE = InnoDB;


CREATE TABLE IF NOT EXISTS `sistema-avaliacoes`.`curso` (
  `id` BIGINT NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(255) NOT NULL,
  `coordenador` BIGINT NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `nome_UNIQUE` (`nome` ASC),
  INDEX `fk_curso_professor1_idx` (`coordenador` ASC),
  CONSTRAINT `fk_curso_professor1`
    FOREIGN KEY (`coordenador`)
    REFERENCES `sistema-avaliacoes`.`professor` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

INSERT INTO `sistema-avaliacoes`.curso
(id, nome, coordenador)
VALUES(1, 'SISTEMAS DE INFORMAÇÕES', NULL);


CREATE TABLE IF NOT EXISTS `sistema-avaliacoes`.`funcionario` (
  `id` BIGINT NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(255) NOT NULL,
  `cpf` VARCHAR(14) NOT NULL,
  `email` VARCHAR(50) NULL,
  `celular` VARCHAR(45) NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `cpf_UNIQUE` (`cpf` ASC),
  UNIQUE INDEX `email_UNIQUE` (`email` ASC))
ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS `sistema-avaliacoes`.`bloco` (
  `id` BIGINT NOT NULL AUTO_INCREMENT,
  `codigo` INT NOT NULL,
  `curso_id` BIGINT NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_bloco_curso1_idx` (`curso_id` ASC),
  CONSTRAINT `fk_bloco_curso1`
    FOREIGN KEY (`curso_id`)
    REFERENCES `sistema-avaliacoes`.`curso` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

INSERT INTO `sistema-avaliacoes`.bloco (id, codigo, curso_id) VALUES(1, 1, 1);
INSERT INTO `sistema-avaliacoes`.bloco (id, codigo, curso_id) VALUES(2, 2, 1);
INSERT INTO `sistema-avaliacoes`.bloco (id, codigo, curso_id) VALUES(3, 3, 1);
INSERT INTO `sistema-avaliacoes`.bloco (id, codigo, curso_id) VALUES(4, 4, 1);
INSERT INTO `sistema-avaliacoes`.bloco (id, codigo, curso_id) VALUES(5, 5, 1);
INSERT INTO `sistema-avaliacoes`.bloco (id, codigo, curso_id) VALUES(6, 6, 1);
INSERT INTO `sistema-avaliacoes`.bloco (id, codigo, curso_id) VALUES(7, 7, 1);
INSERT INTO `sistema-avaliacoes`.bloco (id, codigo, curso_id) VALUES(8, 8, 1);
INSERT INTO `sistema-avaliacoes`.bloco (id, codigo, curso_id) VALUES(9, 9, 1);
INSERT INTO `sistema-avaliacoes`.bloco (id, codigo, curso_id) VALUES(10, 10, 1);


CREATE TABLE IF NOT EXISTS `sistema-avaliacoes`.`aluno` (
  `id` BIGINT NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(45) NOT NULL,
  `matricula` VARCHAR(15) NOT NULL,
  `cpf` VARCHAR(14) NULL,
  `email` VARCHAR(50) NULL,
  `celular` VARCHAR(45) NULL,
  `cor` VARCHAR(100) NULL,
  `sexo` VARCHAR(50) NULL,
  `data_nascimento` DATE NULL,
  `bloco_id` BIGINT NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `cpf_UNIQUE` (`cpf` ASC),
  UNIQUE INDEX `email_UNIQUE` (`email` ASC),
  UNIQUE INDEX `matricula_UNIQUE` (`matricula` ASC),
  INDEX `fk_aluno_bloco1_idx` (`bloco_id` ASC),
  CONSTRAINT `fk_aluno_bloco1`
    FOREIGN KEY (`bloco_id`)
    REFERENCES `sistema-avaliacoes`.`bloco` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS `sistema-avaliacoes`.`endereco` (
  `id` BIGINT NOT NULL AUTO_INCREMENT,
  `logradouro` VARCHAR(255) NULL,
  `numero` VARCHAR(50) NULL,
  `cep` VARCHAR(9) NULL,
  `bairro` VARCHAR(50) NULL,
  `uf` CHAR(2) NULL,
  `cidade` VARCHAR(50) NULL,
  `complemento` VARCHAR(255) NULL,
  `aluno_id` BIGINT NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_endereco_aluno1_idx` (`aluno_id` ASC),
  CONSTRAINT `fk_endereco_aluno1`
    FOREIGN KEY (`aluno_id`)
    REFERENCES `sistema-avaliacoes`.`aluno` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


CREATE TABLE IF NOT EXISTS `sistema-avaliacoes`.`usuario` (
  `id` BIGINT NOT NULL AUTO_INCREMENT,
  `username` VARCHAR(255) NOT NULL,
  `permissao` VARCHAR(100) NOT NULL,
  `senha` VARCHAR(255) NOT NULL,
  `status` TINYINT NOT NULL,
  `acesso_inicial` TINYINT NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `username_UNIQUE` (`username` ASC))
ENGINE = InnoDB;

INSERT INTO `sistema-avaliacoes`.usuario
(id, username, permissao, senha, status, acesso_inicial)
VALUES(12, 'admin', 'ADMIN', '$2y$10$ihc5r/X1aVPO2lcfLzoGqeuhEdbB05wm.oeAA8CVP8HwTitEaT7wO', 1, 0);

