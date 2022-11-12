
-- -----------------------------------------------------
-- Schema localtech
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `localtech` DEFAULT CHARACTER SET utf8 ;
USE `localtech` ;

-- -----------------------------------------------------
-- Schema localtech
-- -----------------------------------------------------
-- Remover Senha Root --

-- SET PASSWORD FOR root@localhost=PASSWORD('');


-- Permitir Comandos Com Qualquer Chave --

SET SQL_SAFE_UPDATES = 0;


-- Habilitar scripts sem valores definados --

SET @@SQL_MODE = REPLACE(@@SQL_MODE, 'STRICT_TRANS_TABLES', '');


CREATE TABLE IF NOT EXISTS `administrador` (
    `id_adm` INT(11) NOT NULL AUTO_INCREMENT,
    `nome_adm` VARCHAR(60) NOT NULL,
    `email_adm` VARCHAR(60) NOT NULL,
    `senha_adm` VARCHAR(45) NOT NULL,
    PRIMARY KEY (`id_adm`)
)  ENGINE=INNODB;


-- -----------------------------------------------------
-- Table `localtech`.`cliente`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `cliente` (
    `id_cliente` INT NOT NULL AUTO_INCREMENT,
    `cod` INT NOT NULL,
    `image` VARCHAR(1000) NOT NULL,
    `nome` VARCHAR(100) NOT NULL,
    `sobrenome` VARCHAR(100) NOT NULL,
    `tipo` ENUM('CPF', 'CNPJ') NOT NULL,
    `cpf` CHAR(15) NULL,
    `cnpj` CHAR(18) NULL,
    `datanascimento` DATE NOT NULL,
    `senha` VARCHAR(60) NOT NULL,
    `cadastro` DATE NOT NULL,
    PRIMARY KEY (`id_cliente`)
)  ENGINE=INNODB;


-- -----------------------------------------------------
-- Table `localtech`.`tecnico`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `tecnico` (
    `id_tecnico` INT NOT NULL AUTO_INCREMENT,
    `cod` INT NOT NULL,
    `image` VARCHAR(1000) NOT NULL,
    `nome` VARCHAR(100) NOT NULL,
    `sobrenome` VARCHAR(100) NOT NULL,
    `tipo` ENUM('CPF', 'CNPJ') NOT NULL,
    `cpf` CHAR(15) NULL,
    `cnpj` CHAR(18) NULL,
    `datanascimento` DATE NOT NULL,
    `senha` VARCHAR(60) NOT NULL,
    `cadastro` DATE NOT NULL,
    PRIMARY KEY (`id_tecnico`)
)  ENGINE=INNODB;


-- -----------------------------------------------------
-- Table `localtech`.`assistencia`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `assistencia` (
    `id_assistencia` INT NOT NULL AUTO_INCREMENT,
    `cod` INT NOT NULL,
    `image` VARCHAR(1000) NOT NULL,
    `nome` VARCHAR(100) NOT NULL,
    `cnpj` CHAR(18) NOT NULL,
    `senha` VARCHAR(60) NOT NULL,
    `cadastro` DATE NOT NULL,
    PRIMARY KEY (`id_assistencia`)
)  ENGINE=INNODB;


-- -----------------------------------------------------
-- Table `localtech`.`contato`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `contato` (
    `id_contato` int(11) NOT NULL AUTO_INCREMENT,
    `id_cliente` int(11) NOT NULL,
    `id_tecnico` int(11) NOT NULL,
    `id_assistencia` int(11) NOT NULL,
    `codificacao` varchar(100) DEFAULT NULL,
    `email` varchar(100) NOT NULL,
    `telefone` varchar(15) NOT NULL,
    `verificacao` enum('Sim','Nao') NOT NULL,
    PRIMARY KEY (`id_contato`)
)  ENGINE=INNODB;



-- -----------------------------------------------------
-- Table `localtech`.`status`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `status` (
    `id_status` INT NOT NULL AUTO_INCREMENT,
    `id_cliente` INT NOT NULL,
    `id_tecnico` INT NOT NULL,
    `status` ENUM('Online', 'Offline', 'Em Atendimento') NOT NULL,
    PRIMARY KEY (`id_status`)
)  ENGINE=INNODB;


-- -----------------------------------------------------
-- Table `localtech`.`atendimento`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `atendimento` (
  `id_atendimento` int(11) NOT NULL AUTO_INCREMENT,
  `id_tecnico` int(11) NOT NULL,
  `id_cliente` int(11) NOT NULL,
  `cod` int(11) NOT NULL,
  `inicio` datetime NOT NULL,
  `fim` datetime NOT NULL,
  `id_reabertura` int(11) NOT NULL,
  PRIMARY KEY (`id_atendimento`)
) ENGINE=InnoDB;


-- -----------------------------------------------------
-- Table `localtech`.`chat`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `chat` (
  `id_chat` int(11) NOT NULL AUTO_INCREMENT,
  `id_atendimento` int(11) NOT NULL,
  `remetente` enum('Tecnico','Cliente') NOT NULL,
  `mensagem` text NOT NULL,
  `horario` datetime NOT NULL,
  PRIMARY KEY (`id_chat`)
) ENGINE=InnoDB;


-- -----------------------------------------------------
-- Table `localtech`.`horario_assistencia`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `horario_assistencia` (
    `id_horario` INT NOT NULL AUTO_INCREMENT,
    `id_assistencia` INT NOT NULL,
    `descricao` TEXT(500) NULL,
    `horaabrir` TIME NOT NULL,
    `horafechar` TIME NOT NULL,
    `semanainicio` VARCHAR(45) NOT NULL,
    `semanafinal` VARCHAR(45) NOT NULL,
    PRIMARY KEY (`id_horario`)
)  ENGINE=INNODB;


-- -----------------------------------------------------
-- Table `localtech`.`estado`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `estado` (
    `id_estado` INT NOT NULL AUTO_INCREMENT,
    `sigla` CHAR(2) NOT NULL,
    PRIMARY KEY (`id_estado`)
)  ENGINE=INNODB;


-- -----------------------------------------------------
-- Table `localtech`.`cidade`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `cidade` (
    `id_cidade` INT NOT NULL AUTO_INCREMENT,
    `nome` VARCHAR(100) NOT NULL,
    `id_estado` INT NOT NULL,
    PRIMARY KEY (`id_cidade`)
)  ENGINE=INNODB;


-- -----------------------------------------------------
-- Table `localtech`.`bairro`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `bairro` (
    `id_bairro` INT NOT NULL AUTO_INCREMENT,
    `nome` VARCHAR(100) NOT NULL,
    `id_cidade` INT NOT NULL,
    PRIMARY KEY (`id_bairro`)
)  ENGINE=INNODB;


-- -----------------------------------------------------
-- Table `localtech`.`endereco`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `endereco` (
    `id_endereco` INT NOT NULL AUTO_INCREMENT,
    `id_cliente` INT NOT NULL,
    `id_assistencia` INT NOT NULL,
    `cep` CHAR(10) NOT NULL,
    `logradouro` VARCHAR(100) NOT NULL,
    `numero` INT(10) NOT NULL,
    `complemento` VARCHAR(150) NULL,
    `id_bairro` INT NOT NULL,
    PRIMARY KEY (`id_endereco`)
)  ENGINE=INNODB;


-- -----------------------------------------------------
-- Table `localtech`.`avaliacao`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `avaliacao` (
    `id_avaliacao` INT NOT NULL AUTO_INCREMENT,
    `id_chat` INT NOT NULL,
    `id_tecnico` INT NOT NULL,
    `id_cliente` INT NOT NULL,
    `data` DATETIME NOT NULL,
    `avaliacao` CHAR(1) NOT NULL,
    `descricao` TEXT NULL DEFAULT NULL,
    PRIMARY KEY (`id_avaliacao`)
)  ENGINE=INNODB;


-- -----------------------------------------------------
-- Table `localtech`.`report`
-- -----------------------------------------------------
CREATE TABLE `localtech`.`report` (
  `id_report` INT NOT NULL AUTO_INCREMENT,
  `cod` int(11) NOT NULL,
  `id_cliente` INT NOT NULL,
  `id_tecnico` INT NOT NULL,
  `assunto` TEXT NOT NULL,
  `tipo` ENUM('tecnico', 'assistencia', 'cliente') NOT NULL,
  `usuario` VARCHAR(100) NOT NULL,
  `relatorio` TEXT NOT NULL,
  `data` DATETIME NOT NULL,
  `resposta` TEXT NULL,
  PRIMARY KEY (`id_report`));
  

-- -----------------------------------------------------
-- Table `localtech`.`postagem`
-- -----------------------------------------------------
  CREATE TABLE `localtech`.`postagem` (
  `id_postagem` INT NOT NULL AUTO_INCREMENT,
  `cod` int(11) NOT NULL,
  `capa` VARCHAR(1000) NOT NULL,
  `titulo` VARCHAR(100) NOT NULL,
  `autor` VARCHAR(60) NOT NULL,
  `conteudo` TEXT NOT NULL,
  `postado` DATE NOT NULL,
  `atualizado` DATE NOT NULL,
  PRIMARY KEY (`id_postagem`));




-- Inserir Dados --


-- Administrador --

INSERT INTO `localtech`.`administrador` (`id_adm`, `nome_adm`, `email_adm`, `senha_adm`) VALUES ('1', 'Admin', 'admin@admin.com', 'senha');

-- ---------------------------------------------------------------------------------------------------------------------------------------------------------

-- DADOS CLIENTE --

-- ---------------------------------------------------------------------------------------------------------------------------------------------------------

INSERT INTO `localtech`.`cliente` (`id_cliente`, `cod`, `image`, `nome`, `sobrenome`, `tipo`, `cpf`, `datanascimento`, `senha`, `cadastro`) VALUES ('1', '136044965', '16467494751643659558Douglas.png', 'Douglas', 'Souza', 'CPF', '212.744.610-06', '2001-11-11', 'e8d95a51f3af4a3b134bf6bb680a213a', '2022-03-08');

INSERT INTO `localtech`.`endereco` (`id_endereco`, `id_cliente`, `cep`, `logradouro`, `numero`, `complemento`, `id_bairro`) VALUES ('1', '1', '11365-140', 'Avenida Sambaiatuba', '232', '', '2');

INSERT INTO `localtech`.`contato` (`id_contato`, `id_cliente`, `codificacao`, `email`, `telefone`, `verificacao`) VALUES ('1', '1', '839643b3e99d7a6c87d696f3319791d1', 'douglas@souza.com', '(11) 11111-1111', 'Sim');

INSERT INTO `localtech`.`status` (`id_status`, `id_cliente`, `status`) VALUES ('1', '1', 'Offline');

-- -----------------------------------------------------------------------------------------
INSERT INTO `localtech`.`cliente` (`id_cliente`, `cod`, `image`, `nome`, `sobrenome`, `tipo`, `cpf`, `datanascimento`, `senha`, `cadastro`) VALUES ('2', '136154965', 'usuario_sem_foto.png', 'Giovanni', 'Martins', 'CPF', '587.847.749-16', '1989-03-11', 'e8d95a51f3af4a3b134bf6bb680a213a', '2022-02-08');

INSERT INTO `localtech`.`endereco` (`id_endereco`, `id_cliente`, `cep`, `logradouro`, `numero`, `complemento`, `id_bairro`) VALUES ('2', '2', '78563-970', 'Avenida José Pedro Dias 920', '541', '', '3');

INSERT INTO `localtech`.`contato` (`id_contato`, `id_cliente`, `codificacao`, `email`, `telefone`, `verificacao`) VALUES ('2', '2', '839643b3e99d7a6c87d696f3319791d2', 'giovanni_augusto_martins@eccofibra.com.br', '(66) 99419-8659', 'Sim');

INSERT INTO `localtech`.`status` (`id_status`, `id_cliente`, `status`) VALUES ('2', '2', 'Online');

-- -----------------------------------------------------------------------------------------

INSERT INTO `localtech`.`cliente` (`id_cliente`, `cod`, `image`, `nome`, `sobrenome`, `tipo`, `cpf`, `datanascimento`, `senha`, `cadastro`) VALUES ('3', '136254965', 'usuario_sem_foto.png', 'Thiago', 'Lopes', 'CPF', '755.119.870-93', '1981-03-01', 'e8d95a51f3af4a3b134bf6bb680a213a', '2022-03-14');

INSERT INTO `localtech`.`endereco` (`id_endereco`, `id_cliente`, `cep`, `logradouro`, `numero`, `complemento`, `id_bairro`) VALUES ('3', '3', '65600-730', 'Rua da Felicidade', '716', '', '4');

INSERT INTO `localtech`.`contato` (`id_contato`, `id_cliente`, `codificacao`, `email`, `telefone`, `verificacao`) VALUES ('3', '3', '839643b3e99d7a6c87d696f3319791d3', 'thiago_lopes@outlock.com.br', '(99) 98365-0865', 'Sim');

INSERT INTO `localtech`.`status` (`id_status`, `id_cliente`, `status`) VALUES ('3', '3', 'Offline');

-- -----------------------------------------------------------------------------------------

INSERT INTO `localtech`.`cliente` (`id_cliente`, `cod`, `image`, `nome`, `sobrenome`, `tipo`, `cpf`, `datanascimento`, `senha`, `cadastro`) VALUES ('4', '136354965', 'usuario_sem_foto.png', 'Jennifer', 'Cardoso', 'CPF', '116.647.464-04', '1946-03-09', 'e8d95a51f3af4a3b134bf6bb680a213a', '2022-02-14');

INSERT INTO `localtech`.`endereco` (`id_endereco`, `id_cliente`, `cep`, `logradouro`, `numero`, `complemento`, `id_bairro`) VALUES ('4', '4', '69044-781', 'Rua Adelaide Carraro', '793', '', '5');

INSERT INTO `localtech`.`contato` (`id_contato`, `id_cliente`, `codificacao`, `email`, `telefone`, `verificacao`) VALUES ('4', '4', '839643b3e99d7a6c87d696f3319791d4', 'jennifer_cardoso@leonardocordeiro.com', '(92) 98106-7622', 'Sim');

INSERT INTO `localtech`.`status` (`id_status`, `id_cliente`, `status`) VALUES ('4', '4', 'Online');

-- -----------------------------------------------------------------------------------------

INSERT INTO `localtech`.`cliente` (`id_cliente`, `cod`, `image`, `nome`, `sobrenome`, `tipo`, `cpf`, `datanascimento`, `senha`, `cadastro`) VALUES ('5', '136464965', 'usuario_sem_foto.png', 'Alana', 'Mata', 'CPF', '269.073.255-60', '1980-03-13', 'e8d95a51f3af4a3b134bf6bb680a213a', '2022-03-15');

INSERT INTO `localtech`.`endereco` (`id_endereco`, `id_cliente`, `cep`, `logradouro`, `numero`, `complemento`, `id_bairro`) VALUES ('5', '5', '67115-840', 'Travessa H', '763', '', '6');

INSERT INTO `localtech`.`contato` (`id_contato`, `id_cliente`, `codificacao`, `email`, `telefone`, `verificacao`) VALUES ('5', '5', '839643b3e99d7a6c87d696f3319791d5', 'alana.maya.damata@folha.com.br', '(91) 98973-9992', 'Sim');

INSERT INTO `localtech`.`status` (`id_status`, `id_cliente`, `status`) VALUES ('5', '5', 'Offline');

-- ---------------------------------------------------------------------------------------------------------------------------------------------------------

-- DADOS TECNICO --

-- ---------------------------------------------------------------------------------------------------------------------------------------------------------
INSERT INTO `localtech`.`tecnico` (`id_tecnico`, `cod`, `image`, `nome`, `sobrenome`, `tipo`, `cpf`, `datanascimento`, `senha`, `cadastro`) VALUES ('1', '223969097', '16467495081643658981Leticia.png', 'Letícia', 'Moreira', 'CPF', '876.937.360-42', '2002-02-22', 'e8d95a51f3af4a3b134bf6bb680a213a', '2022-03-08');

INSERT INTO `localtech`.`contato` (`id_contato`, `id_tecnico`, `codificacao`, `email`, `telefone`, `verificacao`) VALUES ('6', '1', '839643b3e99d7a6c87d696f3319791e6', 'leticia@moreira.com', '(22) 22222-2222', 'Sim');

INSERT INTO `localtech`.`status` (`id_status`, `id_tecnico`, `status`) VALUES ('6', '1', 'Offline');

-- -----------------------------------------------------------------------------------------

INSERT INTO `localtech`.`tecnico` (`id_tecnico`, `cod`, `image`, `nome`, `sobrenome`, `tipo`, `cpf`, `datanascimento`, `senha`, `cadastro`) VALUES ('2', '223499097', 'usuario_sem_foto.png', 'Bruno', 'Barbosa', 'CPF', '106.296.945-67', '1977-02-23', 'e8d95a51f3af4a3b134bf6bb680a213a', '2022-02-08');

INSERT INTO `localtech`.`contato` (`id_contato`, `id_tecnico`, `codificacao`, `email`, `telefone`, `verificacao`) VALUES ('7', '2', '839643b3e99d7a6c87d696f3319791d6', 'bruno_barbosa@drimenezes.com', '(65) 99629-5200', 'Sim');

INSERT INTO `localtech`.`status` (`id_status`, `id_tecnico`, `status`) VALUES ('7', '2', 'Online');

-- -----------------------------------------------------------------------------------------

INSERT INTO `localtech`.`tecnico` (`id_tecnico`, `cod`, `image`, `nome`, `sobrenome`, `tipo`, `cpf`, `datanascimento`, `senha`, `cadastro`) VALUES ('3', '223499657', 'usuario_sem_foto.png', 'Heitor', 'Ramos', 'CPF', '079.019.070-29', '1996-01-24', 'e8d95a51f3af4a3b134bf6bb680a213a', '2022-03-11');

INSERT INTO `localtech`.`contato` (`id_contato`, `id_tecnico`, `codificacao`, `email`, `telefone`, `verificacao`) VALUES ('8', '3', '839643b3e99d7a6c87d696f3319791d7', 'heitor.kaique.ramos@acmsaopaulo.org', '(86) 99628-1232', 'Sim');

INSERT INTO `localtech`.`status` (`id_status`, `id_tecnico`, `status`) VALUES ('8', '3', 'Offline');

-- -----------------------------------------------------------------------------------------

INSERT INTO `localtech`.`tecnico` (`id_tecnico`, `cod`, `image`, `nome`, `sobrenome`, `tipo`, `cpf`, `datanascimento`, `senha`, `cadastro`) VALUES ('4', '226599657', 'usuario_sem_foto.png', 'Jéssica', 'Nascimento', 'CPF', '073.187.969-41', '1988-01-19', 'e8d95a51f3af4a3b134bf6bb680a213a', '2022-03-03');

INSERT INTO `localtech`.`contato` (`id_contato`, `id_tecnico`, `codificacao`, `email`, `telefone`, `verificacao`) VALUES ('9', '4', '839643b3e99d7a6c87d696f3319791d8', 'jessica-nascimento76@grupoamericaville.com.br', '(63) 98391-0133', 'Sim');

INSERT INTO `localtech`.`status` (`id_status`, `id_tecnico`, `status`) VALUES ('9', '4', 'Online');

-- -----------------------------------------------------------------------------------------

INSERT INTO `localtech`.`tecnico` (`id_tecnico`, `cod`, `image`, `nome`, `sobrenome`, `tipo`, `cpf`, `datanascimento`, `senha`, `cadastro`) VALUES ('5', '295499657', 'usuario_sem_foto.png', 'Laís', 'Salva', 'CPF', '375.140.059-19', '1964-03-06', 'e8d95a51f3af4a3b134bf6bb680a213a', '2022-02-03');

INSERT INTO `localtech`.`contato` (`id_contato`, `id_tecnico`, `codificacao`, `email`, `telefone`, `verificacao`) VALUES ('10', '5', '839643b3e99d7a6c87d696f3319791d9', 'lais-silva81@structureesquadrias.com.br', '(69) 98653-3550', 'Sim');

INSERT INTO `localtech`.`status` (`id_status`, `id_tecnico`, `status`) VALUES ('10', '5', 'Online');

-- ---------------------------------------------------------------------------------------------------------------------------------------------------------

-- DADOS ASSISTENCIA TECNICO --

-- ---------------------------------------------------------------------------------------------------------------------------------------------------------

INSERT INTO `localtech`.`assistencia` (`id_assistencia`, `cod`, `image`, `nome`, `cnpj`, `senha`, `cadastro`) VALUES ('1', '118056596', '1652142278assistencia_sem_foto.jpg', 'Assistência Técnica 1', '33.333.333/3333-33', 'e8d95a51f3af4a3b134bf6bb680a213a', '2022-03-08');

INSERT INTO `localtech`.`endereco` (`id_endereco`, `id_assistencia`, `cep`, `logradouro`, `numero`, `complemento`, `id_bairro`) VALUES ('6', '1', '11348-450', 'Rua Bráz Ferreira', '33', '', '1');

INSERT INTO `localtech`.`contato` (`id_contato`, `id_assistencia`, `codificacao`, `email`, `telefone`, `verificacao`) VALUES ('11', '1', '839643b3e99d7a6c87d696f3319791e1', 'assistencia1@gmail.com', '(33) 3333-3333', 'Sim');

-- -----------------------------------------------------------------------------------------

INSERT INTO `localtech`.`assistencia` (`id_assistencia`, `cod`, `image`, `nome`, `cnpj`, `senha`, `cadastro`) VALUES ('2', '118059596', '1646746574DSC03468.jpg', 'Assistência Técnica 2', '84.101.246/0001-40', 'e8d95a51f3af4a3b134bf6bb680a213a', '2022-03-15');

INSERT INTO `localtech`.`endereco` (`id_endereco`, `id_assistencia`, `cep`, `logradouro`, `numero`, `complemento`, `id_bairro`) VALUES ('7', '2', '14805-343', 'Avenida Maurício Benedito Girasol', '814', '', '7');

INSERT INTO `localtech`.`contato` (`id_contato`, `id_assistencia`, `codificacao`, `email`, `telefone`, `verificacao`) VALUES ('12', '2', '839643b3e99d7a6c87d696f3319791e2', 'assistencia2@gmail.com', '(16) 2827-0908', 'Sim');

-- -----------------------------------------------------------------------------------------

INSERT INTO `localtech`.`assistencia` (`id_assistencia`, `cod`, `image`, `nome`, `cnpj`, `senha`, `cadastro`) VALUES ('3', '118036796', '1652142278assistencia_sem_foto.jpg', 'Assistência Técnica 3', '30.124.849/0001-38', 'e8d95a51f3af4a3b134bf6bb680a213a', '2022-03-10');

INSERT INTO `localtech`.`endereco` (`id_endereco`, `id_assistencia`, `cep`, `logradouro`, `numero`, `complemento`, `id_bairro`) VALUES ('8', '3', '20720-294', 'Rua Aquidabã', '254', '', '8');

INSERT INTO `localtech`.`contato` (`id_contato`, `id_assistencia`, `codificacao`, `email`, `telefone`, `verificacao`) VALUES ('13', '3', '839643b3e99d7a6c87d696f3319791e3', 'assistencia3@gmail.com', '(21) 3763-4056', 'Sim');

-- -----------------------------------------------------------------------------------------

INSERT INTO `localtech`.`assistencia` (`id_assistencia`, `cod`, `image`, `nome`, `cnpj`, `senha`, `cadastro`) VALUES ('4', '118736796', '1646746574DSC03468.jpg', 'Assistência Técnica 4', '22.375.168/0001-14', 'e8d95a51f3af4a3b134bf6bb680a213a', '2022-02-10');

INSERT INTO `localtech`.`endereco` (`id_endereco`, `id_assistencia`, `cep`, `logradouro`, `numero`, `complemento`, `id_bairro`) VALUES ('9', '4', '26088-235', 'Rua Araguá', '970', '', '9');

INSERT INTO `localtech`.`contato` (`id_contato`, `id_assistencia`, `codificacao`, `email`, `telefone`, `verificacao`) VALUES ('14', '4', '839643b3e99d7a6c87d696f3319791e4', 'assistencia4@gmail.com', '(21) 2547-0971', 'Sim');

-- -----------------------------------------------------------------------------------------

INSERT INTO `localtech`.`assistencia` (`id_assistencia`, `cod`, `image`, `nome`, `cnpj`, `senha`, `cadastro`) VALUES ('5', '118736796', '1652142278assistencia_sem_foto.jpg', 'Assistência Técnica 5', '29.826.955/0001-84', 'e8d95a51f3af4a3b134bf6bb680a213a', '2022-03-09');

INSERT INTO `localtech`.`endereco` (`id_endereco`, `id_assistencia`, `cep`, `logradouro`, `numero`, `complemento`, `id_bairro`) VALUES ('10', '5', '13468-490', 'Rua Ibirapuera', '117', '', '10');

INSERT INTO `localtech`.`contato` (`id_contato`, `id_assistencia`, `codificacao`, `email`, `telefone`, `verificacao`) VALUES ('15', '5', '839643b3e99d7a6c87d696f3319791e5', 'assistencia5@gmail.com', '(19) 2686-9667', 'Sim');

-- -----------------------------------------------------------------------------------------

INSERT INTO `localtech`.`assistencia` (`id_assistencia`, `cod`, `image`, `nome`, `cnpj`, `senha`, `cadastro`) VALUES ('6', '118735796', '1646746574DSC03468.jpg', 'Assistência Técnica 6', '29.826.955/0001-84', 'e8d95a51f3af4a3b134bf6bb680a213a', '2022-03-09');

INSERT INTO `localtech`.`endereco` (`id_endereco`, `id_assistencia`, `cep`, `logradouro`, `numero`, `complemento`, `id_bairro`) VALUES ('11', '6', '13468-490', 'Rua Ibirapuera', '117', '', '10');

INSERT INTO `localtech`.`contato` (`id_contato`, `id_assistencia`, `codificacao`, `email`, `telefone`, `verificacao`) VALUES ('16', '6', '839643b3e99d7a6c87d696f3319791e5', 'assistencia5@gmail.com', '(19) 2686-9667', 'Sim');


-- HORARIO ASSISTENCIAS TECNICAS -- 

INSERT INTO `localtech`.`horario_assistencia` (`id_horario`, `id_assistencia`, `descricao`, `horaabrir`, `horafechar`, `semanainicio`, `semanafinal`) VALUES ('1', '1', 'Conserto de Computadores Desktop, Notebook e muito mais.', '09:00:00', '21:00:00', 'Segunda', 'Sexta');

-- -----------------------------------------------------------------------------------------

INSERT INTO `localtech`.`horario_assistencia` (`id_horario`, `id_assistencia`, `descricao`, `horaabrir`, `horafechar`, `semanainicio`, `semanafinal`) VALUES ('2', '2', 'Conserto de Computadores Desktop, Notebook e muito mais.', '08:00:00', '22:00:00', 'Segunda', 'Sabado');

-- -----------------------------------------------------------------------------------------

INSERT INTO `localtech`.`horario_assistencia` (`id_horario`, `id_assistencia`, `descricao`, `horaabrir`, `horafechar`, `semanainicio`, `semanafinal`) VALUES ('3', '3', 'Conserto de Computadores Desktop, Notebook e muito mais.', '10:00:00', '23:00:00', 'Segunda', 'Sexta');

-- -----------------------------------------------------------------------------------------

INSERT INTO `localtech`.`horario_assistencia` (`id_horario`, `id_assistencia`, `descricao`, `horaabrir`, `horafechar`, `semanainicio`, `semanafinal`) VALUES ('4', '4', 'Conserto de Computadores Desktop, Notebook e muito mais.', '09:00:00', '21:00:00', 'Segunda', 'Sabado');

-- -----------------------------------------------------------------------------------------

INSERT INTO `localtech`.`horario_assistencia` (`id_horario`, `id_assistencia`, `descricao`, `horaabrir`, `horafechar`, `semanainicio`, `semanafinal`) VALUES ('5', '5', 'Conserto de Computadores Desktop, Notebook e muito mais.', '08:00:00', '22:00:00', 'Segunda', 'Sexta');

-- -----------------------------------------------------------------------------------------

INSERT INTO `localtech`.`horario_assistencia` (`id_horario`, `id_assistencia`, `descricao`, `horaabrir`, `horafechar`, `semanainicio`, `semanafinal`) VALUES ('6', '6', 'Conserto de Computadores Desktop, Notebook e muito mais.', '08:00:00', '22:00:00', 'Segunda', 'Sexta');

-- -----------------------------------------------------------------------------------------


-- DADOS ENDEREÇOS -- 

INSERT INTO `localtech`.`estado` (`id_estado`, `sigla`) VALUES ('1', 'SP');

INSERT INTO `localtech`.`cidade` (`id_cidade`, `nome`, `id_estado`) VALUES ('1', 'São Vicente', '1');

INSERT INTO `localtech`.`bairro` (`id_bairro`, `nome`, `id_cidade`) VALUES ('1', 'Parque Continetal', '1');

-- ------------------------------------------------------------------------------------------

INSERT INTO `localtech`.`bairro` (`id_bairro`, `nome`, `id_cidade`) VALUES ('2', 'Vila Joquei Clube', '1');

-- ------------------------------------------------------------------------------------------

INSERT INTO `localtech`.`estado` (`id_estado`, `sigla`) VALUES ('2', 'MT');

INSERT INTO `localtech`.`cidade` (`id_cidade`, `nome`, `id_estado`) VALUES ('2', 'Tabaporã', '2');

INSERT INTO `localtech`.`bairro` (`id_bairro`, `nome`, `id_cidade`) VALUES ('3', 'Centro', '2');

-- ------------------------------------------------------------------------------------------

INSERT INTO `localtech`.`estado` (`id_estado`, `sigla`) VALUES ('3', 'MA');

INSERT INTO `localtech`.`cidade` (`id_cidade`, `nome`, `id_estado`) VALUES ('3', 'Caxias', '3');

INSERT INTO `localtech`.`bairro` (`id_bairro`, `nome`, `id_cidade`) VALUES ('4', 'Vila Alecrim', '3');

-- ------------------------------------------------------------------------------------------

INSERT INTO `localtech`.`estado` (`id_estado`, `sigla`) VALUES ('4', 'AM');

INSERT INTO `localtech`.`cidade` (`id_cidade`, `nome`, `id_estado`) VALUES ('4', 'Manaus', '4');

INSERT INTO `localtech`.`bairro` (`id_bairro`, `nome`, `id_cidade`) VALUES ('5', 'Planalto', '4');

-- ------------------------------------------------------------------------------------------

INSERT INTO `localtech`.`estado` (`id_estado`, `sigla`) VALUES ('5', 'PA');

INSERT INTO `localtech`.`cidade` (`id_cidade`, `nome`, `id_estado`) VALUES ('5', 'Ananindeua', '5');

INSERT INTO `localtech`.`bairro` (`id_bairro`, `nome`, `id_cidade`) VALUES ('6', 'Coqueiro', '5');

-- ------------------------------------------------------------------------------------------

INSERT INTO `localtech`.`cidade` (`id_cidade`, `nome`, `id_estado`) VALUES ('6', 'Araraquara', '1');

INSERT INTO `localtech`.`bairro` (`id_bairro`, `nome`, `id_cidade`) VALUES ('7', 'Chácara Flora Araraquara', '6');

-- ------------------------------------------------------------------------------------------

INSERT INTO `localtech`.`estado` (`id_estado`, `sigla`) VALUES ('6', 'RJ');

INSERT INTO `localtech`.`cidade` (`id_cidade`, `nome`, `id_estado`) VALUES ('7', 'Rio de Janeiro', '6');

INSERT INTO `localtech`.`bairro` (`id_bairro`, `nome`, `id_cidade`) VALUES ('8', 'Méier', '7');

-- ------------------------------------------------------------------------------------------

INSERT INTO `localtech`.`cidade` (`id_cidade`, `nome`, `id_estado`) VALUES ('8', 'Nova Iguaçu', '6');

INSERT INTO `localtech`.`bairro` (`id_bairro`, `nome`, `id_cidade`) VALUES ('9', 'Vila Guimarães', '8');

-- ------------------------------------------------------------------------------------------

INSERT INTO `localtech`.`cidade` (`id_cidade`, `nome`, `id_estado`) VALUES ('9', 'Americana', '1');

INSERT INTO `localtech`.`bairro` (`id_bairro`, `nome`, `id_cidade`) VALUES ('10', 'Jardim Ipiranga', '9');



-- DADOS ATENDIMENTO -- 

INSERT INTO `localtech`.`atendimento` (`id_atendimento`, `id_tecnico`, `id_cliente`, `cod`, `inicio`, `fim`) VALUES ('1', '2', '1', '136044965', '2022-03-15 16:36:13', '2022-03-16 23:36:13');

-- ------------------------------------------------------------------------------------------

INSERT INTO `localtech`.`atendimento` (`id_atendimento`, `id_tecnico`, `id_cliente`, `cod`, `inicio`, `fim`, `id_reabertura`) VALUES ('2', '4', '2', '136154965', '2022-03-14 12:18:19', '2022-03-15 18:42:15', '3');

-- ------------------------------------------------------------------------------------------

INSERT INTO `localtech`.`atendimento` (`id_atendimento`, `id_tecnico`, `id_cliente`, `cod`, `inicio`, `fim`) VALUES ('3', '5', '4', '136354965', '2022-03-16 08:59:03', '2022-03-16 11:27:10');

-- ------------------------------------------------------------------------------------------

INSERT INTO `localtech`.`atendimento` (`id_atendimento`, `id_tecnico`, `id_cliente`, `cod`, `inicio`, `fim`) VALUES ('4', '1', '2', '136044965', '2022-03-15 16:36:13', '0000-00-00 00:00:00');

-- ------------------------------------------------------------------------------------------

INSERT INTO `localtech`.`atendimento` (`id_atendimento`, `id_tecnico`, `id_cliente`, `cod`, `inicio`, `fim`, `id_reabertura`) VALUES ('5', '2', '5', '136154965', '2022-03-14 12:18:19', '2022-03-15 18:42:15', '6');

-- ------------------------------------------------------------------------------------------

INSERT INTO `localtech`.`atendimento` (`id_atendimento`, `id_tecnico`, `id_cliente`, `cod`, `inicio`, `fim`) VALUES ('6', '4', '5', '136354965', '2022-03-16 08:59:03', '0000-00-00 00:00:00');



-- DADOS CHAT -- 

INSERT INTO `localtech`.`chat` (`id_chat`, `id_atendimento`, `remetente`, `mensagem`) VALUES ('1', '1', 'Cliente', 'Oi');

-- ------------------------------------------------------------------------------------------

INSERT INTO `localtech`.`chat` (`id_chat`, `id_atendimento`, `remetente`, `mensagem`) VALUES ('2', '1', 'Tecnico', 'Ola! Como posso ajuda-lo?');

-- ------------------------------------------------------------------------------------------

INSERT INTO `localtech`.`chat` (`id_chat`, `id_atendimento`, `remetente`, `mensagem`) VALUES ('3', '2', 'Cliente', 'Boa Tarde');

-- ------------------------------------------------------------------------------------------

INSERT INTO `localtech`.`chat` (`id_chat`, `id_atendimento`, `remetente`, `mensagem`) VALUES ('4', '2', 'Tecnico', 'Boa Tarde! Qual sua dúvida?');

-- ------------------------------------------------------------------------------------------

INSERT INTO `localtech`.`chat` (`id_chat`, `id_atendimento`, `remetente`, `mensagem`) VALUES ('5', '3', 'Cliente', 'Tenho um problema!');

-- ------------------------------------------------------------------------------------------

INSERT INTO `localtech`.`chat` (`id_chat`, `id_atendimento`, `remetente`, `mensagem`) VALUES ('6', '3', 'Tecnico', 'Olá, me descreva o problema por favor.');

-- ------------------------------------------------------------------------------------------

INSERT INTO `localtech`.`chat` (`id_chat`, `id_atendimento`, `remetente`, `mensagem`) VALUES ('7', '4', 'Cliente', 'Oie');

-- ------------------------------------------------------------------------------------------

INSERT INTO `localtech`.`chat` (`id_chat`, `id_atendimento`, `remetente`, `mensagem`) VALUES ('8', '5', 'Cliente', 'Boa Noite');

-- ------------------------------------------------------------------------------------------


-- DADOS REPORTS -- 

INSERT INTO `localtech`.`report` (`id_report`, `cod`, `id_cliente`, `id_tecnico`, `assunto`, `tipo`, `usuario`, `relatorio`, `data`, `resposta`) VALUES ('1', '129885397', '1', '0', 'Encerrou o atendimento sem motivo', 'tecnico', 'Letícia Moreira', 'O técnico encerrou o atendimento, logo após dizer bom dia.\r\nNão me deu nenhuma satisfação, somente encerrou o atendimento.', '2022-06-17 20:48:21', NULL);

-- ------------------------------------------------------------------------------------------


-- DADOS POSTAGENS -- 


INSERT INTO `localtech`.`postagem` (`id_postagem`, `cod`, `capa`, `titulo`, `autor`, `conteudo`, `postado`, `atualizado`) VALUES ('1', '39441966', '1655512255Capa.jpg', 'Otimizando o Windows 10', 'CanalTech', '<p>Seu computador está lento, travando ou apresentando bugs com muita frequência ?&nbsp;</p><p>Compilamos uma lista de dicas para tirar o máximo proveito do Windows 10, e tudo isso pode ser feito modificando certas configurações padrão no sistema operacional da Microsoft.</p><p><br></p><h2>Ajustar Configurações Visuais</h2><p><br></p><p>1 - Para alterar suas configurações visuais, acesse a página \"Sistema\" e então clique em \"Configurações avançadas do sistema\";</p><p>2 - Na categoria \"Desempenho\" clique em \"Configurações\";</p><p>3 - Então você poderá alterar suas configurações de efeitos visuais entre algumas opções;</p><p>4 - Selecione \"Ajustar para obter um melhor desempenho\" para melhorar o desempenho de PC, desabilitando todos os efeitos visuais ou \"Personalizar\", para escolher quais configurações visuais quer manter.</p><br><p><img src=\"http://localhost/xampp/LocalTech/Site/view/assets/images/Postagens/Imagens/287146fb1fbd748a.webp\" alt=\"\" style=\"width: 100%; max-width: 714px; height: auto; max-height: 447px;\"></p><p><br></p><p><br></p><h2>Memória Virtual</h2><p><br></p><p>1 - Na janela \"Opções de Desempenho\", acesse a aba \"Avançado\" e logo em seguida clique em \"Alterar\";</p><p>2 - Depois marque a opção \"Tamanho personalizado\" para configurar o uso de memória de seu computador;</p><br><p><img src=\"http://localhost/xampp/LocalTech/Site/view/assets/images/Postagens/Imagens/c734a738445bfa01.webp\" alt=\"\" style=\"\"></p><p><br></p><p><br></p><h2>Planos de Energia</h2><p><br></p><p>1 - Para isso acesse o \"Painel de controle\" e então clique na categoria \"Hardware e sons\";</p><p>2 - Em seguida, acesse \"Opções de Energia\";</p><p>3 - Por fim, basta alterar o modo de energia para “Alto desempenho” ou outro modo desejado.</p><p><br></p><p><img src=\"http://localhost/xampp/LocalTech/Site/view/assets/images/Postagens/Imagens/f940e0ce1613529b.webp\" alt=\"\" style=\"width: 100%; max-width: 1326px; height: auto; max-height: 830px;\"></p><p><br></p><p><br></p><h2>Desativar Aplicativos em Segundo Plano</h2><p><br></p><p>1 - Acesse o menu \"Iniciar\" e pesquise por \"Aplicativos em segundo plano\";</p><p>2 - Feito isso, você poderá gerenciar quais aplicativos serão executados em segundo plano ou não;</p><p>3 - Também é possível desativar a função para todos os apps. Dessa forma, seu computador irá dedicar o processamento exclusivamente para aplicativos abertos em primeiro plano, com exceção apenas de tarefas essenciais do sistema.</p><p>4 - Então é possível desativar todos os aplicativos em segundo plano.</p><p><br></p><p><img src=\"http://localhost/xampp/LocalTech/Site/view/assets/images/Postagens/Imagens/96b3d106fd70cc33.webp\" alt=\"\"></p><p><br></p><h2>Modo de Jogo</h2><p><br></p><p>1 - Para ativar o \"Modo Jogo\" no Windows 10 acesse as configurações do sistema, então abra a categoria \"Jogos\";</p><p>2 - Em seguida, você poderá ativar o \"Modo de Jogo\", para que seu computador reconheça seus programas como jogos;</p><p>3 - Aqui é possível ativar o \"Modo de Jogo\".</p><p><br></p><p><img src=\"http://localhost/xampp/LocalTech/Site/view/assets/images/Postagens/Imagens/5e348bfa94cc277d.webp\" alt=\"\"></p><p><br></p><h2>Desativar Aplicativos de Inicialização</h2><p><br></p><p>1 - Acesse o menu de \"Configurações\" do Windows 10;</p><p>2 - Em seguida, acesse a categoria \"Aplicativos\";</p><p>3 - Por fim, basta clicar na aba \"Inicialização\" para ativar ou desativar aplicativos que estão iniciando ao ligar seu computador.</p><p>4 - Você pode gerenciar os aplicativos em \"Inicialização\".</p><p><br></p><p><img src=\"http://localhost/xampp/LocalTech/Site/view/assets/images/Postagens/Imagens/1616d4a0857b9506.webp\" alt=\"\"></p><p><br></p><h2>Ativar o Sensor de Armazenamento</h2><p><br></p><p>1 - Para ativar o sensor de armazenamento, acesse p menu de \"Configurações\";</p><p>2 - Em seguida, clique em \"Sistema\";</p><p>3 - Na aba \"Armazenamento\" você poderá ativar o \"Sensor de Armazenamento\";</p><p>4 - Então ative o \"Sensor de Armazenamento\".</p><p><br></p><p><img src=\"http://localhost/xampp/LocalTech/Site/view/assets/images/Postagens/Imagens/6267bec452ccced0.webp\" alt=\"\"></p><p><br></p><h2>Desativar a opção \"Dicas e Truques do Windows\"</h2><p><br></p><p>1 - Para encontrar a opção \"Dicas e Truques do Windows\", clique na categoria \"Sistema\" em \"Configurações\";</p><p>2 - Na aba de \"Notificações e ações\" no menu esquerdo, você poderá desativar a opção \"Obter dicas, truques e sugestões de como usar o Windows\";</p><p>3 - Então desmarque \"Obter dicas e truques\".</p><p><br></p><p><img src=\"http://localhost/xampp/LocalTech/Site/view/assets/images/Postagens/Imagens/14cdc5d9b398884f.webp\" alt=\"\"></p><p><br></p><h2>Desativar os Efeitos de Transparência</h2><p><br></p><p>1 - Para desativar o \"Efeito Transparência\", acesse a aba de \"Configurações\" através do menu \"Iniciar\";</p><p>2 - Acesse a categoria \"Personalização\";</p><p>3 - Então, acesse a aba \"Cores\" no menu esquerdo para ativar ou desativar os \"Efeitos de transparência\";</p><p><br></p><p><img src=\"http://localhost/xampp/LocalTech/Site/view/assets/images/Postagens/Imagens/b1247df8194d7ede.webp\"></p>', '2022-06-18', '2022-06-18');

-- ------------------------------------------------------------------------------------------

INSERT INTO `localtech`.`postagem` (`id_postagem`, `cod`, `capa`, `titulo`, `autor`, `conteudo`, `postado`, `atualizado`) VALUES ('2', '1228419802', '1655585604Capa.jpg', 'As distribuições Linux mais leves para ressuscitar seu PC', 'Ninja do Linux', '<h2>Devuan Linux</h2><p><br></p><p>O Devuan Linux é baseado no Debian e usa o SysVinit, ele conta com o seu próprio repositório de softwares, mas também se espelha nos upstream do Debian. O seu ambiente é o Xfce. Duvuan é o ideal para computadores com pouco memoria RAM e pouco processamento.</p><p><br></p><p><img src=\"http://localhost/xampp/LocalTech/Site/view/assets/images/Postagens/Imagens/c21be9d73ab3e9ad.png\" alt=\"\"></p><p><br></p><h3>Requisito mínimos:</h3><p><br></p><p>- 15G de espaço em disco para instalação</p><p>- 2GB de RAM</p><p><br></p><p><br></p><h2>MX&nbsp; Linux</h2><p><br></p><p>O MX&nbsp; Linux é uma das distribuições Linux mais leves, e sem perde a beleza, a sua base é o Debian, e o ambiente padrão é o Xfce com muitas personalizações. O usuário pode personalizar da forma que desejar, mas a distribuição é tão bem acabada que pouca coisa precisará ser feito no pós instalação. MX Linux é uma boa distribuição Linux para computadores antigos e muito bonita também.</p><p><br></p><p><img src=\"http://localhost/xampp/LocalTech/Site/view/assets/images/Postagens/Imagens/e336754aa6c75600.jpg\" alt=\"\"></p><p><br></p><h3>Requisito mínimos:</h3><p><br></p><p>- Processador i686 ou AMD</p><p>- 512 de RAM</p><p>- 5GB de espaço em disco para instalação</p><p><br></p><p><br></p><h2>Puppy Linux</h2><p><br></p><p>Pyppy Linux é uma distro bem conhecida, já foi eleita pelos usuários uma das melhores para computadores antigos, isso porque o seu sistema consegue rodar em computadores com quase 20 anos, especialmente naqueles processadores da família K6. O seu sistema salva muita coisa na memória RAM, o que faz o sistema bem mais rápido, o usuário também pode executá-lo a partir de uma unidade USB, seja qual for. O seu ambiente gráfico é o Openbox e JWM, ambos são focados em consumir menos recursos da máquina, por ser tão otimizado, os gráficos não são tão bonitos, se o seu foco é leveza e beleza, talvez o Puppy Linux não seja a melhor opção.</p><p><br></p><p><img src=\"http://localhost/xampp/LocalTech/Site/view/assets/images/Postagens/Imagens/fbda1e4ae3fdb544.jpg\" alt=\"\"></p><p><br></p><h3>Requisito mínimos:</h3><p><br></p><p><span style=\"font-size: 12.32px;\">-</span><span style=\"font-size: 12.32px;\">&nbsp;</span>64MB de RAM ou 256 MB</p><p><span style=\"font-size: 12.32px;\">-</span><span style=\"font-size: 12.32px;\">&nbsp;</span>Processador a partir de 333MHz</p><p><br></p><p><br></p><h2>SparkyLinux</h2><p><br></p><p>O SparkyLinux&nbsp; é uma distribuição leve e que pode ser executada tanto em compatodes antigos como em mais recentes. O seu sistema tem como base o Debian teste, que é uma versão semi-rolling e uma estável e uma estável, e conta com vários ambiente de Desktop a escolha do usuário.</p><p>A distribuição tem duas edições, uma edição completa e outra base. A diferença entre elas é que na completa não é preciso fazer muitas coisas, só instalar e usar, já na versão base vem apenas com o que é necessário para o sistema rodar, por isso pode ser instalada em computadores mais antigos.</p><p><br></p><p><img src=\"http://localhost/xampp/LocalTech/Site/view/assets/images/Postagens/Imagens/74f34feaf9d8d06d.png\" alt=\"\"></p><p><br></p><h3>Requisito mínimos:</h3><p><br></p><p>- 256MB de RAM se estiver usando LXDE, Openbox, Gameover e e17</p><p>- 384 MB de RAM para MATE e LXQt</p><p>- Processador I486 ou amd64</p><p>- 5 GB de espaço em disco para instalação</p><p>&nbsp;</p><p><br></p><h2>LXLE</h2><p><br></p><p>LXLE é baseado no Lubuntu LTS, é como se fosse um Lubtuntu otimizado, e serve para computadores mais antigos. O seu foco é ser mais leve que sua base original, onde até os aplicativos escolhidos para ISO são os mais leves possíveis, e dessa forma garantir uma melhor performance da distribuição.</p><p><br></p><p><img src=\"http://localhost/xampp/LocalTech/Site/view/assets/images/Postagens/Imagens/332bf1f96504eb2f.jpg\" alt=\"\"></p><p><br></p><h3>Requisito mínimos:</h3><p><br></p><p>- 512 MB de RAM ou 1 GB para melhor desempenho</p><p>- Processador Pentium III ou para um melhor desempenho Pentium IV</p><p>- 8GB de espaço em disco</p><p><br></p><p><br></p><h2>Antix Linux</h2><p><br></p><p>Baseado no Debiano Antix usa o ambien icewm o que deixa o sistema bem mais leve e exigindo muito pouco dos computadores, por isso, a distro é cotado para o uso em computadores antigos e outro bem mais antigos. No entanto, o AntiX não vem com softwares instalados, ao menos os populares e conhecidos, o usuário devera instalar os softwares de sua preferência no pos instalação.</p><p>Caso o usuário escolha o Antix, devera tomar cuidado com os softwares que vai instalar em sua maquina, ou terá que adicionar mais recursos o que descaracterizara a leveza do sistema.</p><p><br></p><p><img src=\"http://localhost/xampp/LocalTech/Site/view/assets/images/Postagens/Imagens/95c18b8b84cdd6cc.png\" alt=\"\"></p><p><br></p><h3>Requisito mínimos:</h3><p><br></p><p>- 256MB de RAM</p><p>- Processador Pentium III</p><p>- 7GB de espaço em disco</p><p><br></p><p><br></p><h2>Peppermint</h2><p><br></p><p>Peppermint quando foi lançado, teve o seu foco nos famosos netbooks, mas a distribuição e focada em nuvem, e assim consegue atingir o consumo básico de recursos, o seu ambiente padrão do sistema é o LXDE e a sua base é o Ubuntu.</p><p>No ano de 2018 a distro se tornou muito popular e recebendo grande atenção da comunidade. Devido a isso, a distribuição conta com um amplo suporte comunitário.</p><p><br></p><p><img src=\"http://localhost/xampp/LocalTech/Site/view/assets/images/Postagens/Imagens/b6868f711f4c3d20.jpg\" alt=\"\"></p><p><br></p><h3>Requisito mínimos:</h3><p><br></p><p>- 1GB de RAM e para um desempenho satisfatório 2GB</p><p>- Qualquer processador de arquitetura Intel x86</p><p>- 4GB de espaço em disco</p><p><br></p><p><br></p><h2>Bodhi Linux</h2><p><br></p><p>O bodhi Linux é muito indicada para computadores antigos, os usuários instalam a distribuição tento em PCs quando em notebooks. A ISO do Bodhi é reduzida, mas claro, usuário instala os softwares que deseja posteriormente.</p><p>A distribuição usa o ambiente Enlightenment que deixa tudo mais leve, mas o usuário também pode instalar outros ambientes se desejar, mas obviamente que ambiente amis pesados iriam descaracterizar o sistema, e precisaria de mais recursos para funcionar.</p><p><br></p><p><img src=\"http://localhost/xampp/LocalTech/Site/view/assets/images/Postagens/Imagens/e235947df41cc522.jpg\" alt=\"\"></p><p><br></p><h3>Requisito mínimos:</h3><p><br></p><p>- 256 MB de RAM</p><p>- 4GB de espaço em disco</p><p>- Processador Pentium IV ou superior</p><p>&nbsp;</p><p><br></p><h2>Lubuntu</h2><p><br></p><p>O lubunto&nbsp; conta como ambiente padrão o LXDE\\LXQT, e dessa forma o torna leve, o que permite instala ele em computadores bem antigos. Possui um conjunto de aplicativos e software com ferramentas como escritório, internet, aplicativos gráficos e utilitários relacionados. Os aplicativos executados no Lubuntu usam menos recursos e caso necessário, têm melhores alternativas. O usuário pode acessar milhares de pacotes adicionais através do repositório de software Ubuntu.</p><p><br></p><p><img src=\"http://localhost/xampp/LocalTech/Site/view/assets/images/Postagens/Imagens/c3129ce0c64507b1.jpg\" alt=\"\"></p><p><br></p><h3>Requisitos Mínimos:</h3><p><br></p><p>- 128MB de RAM</p><p>- Processador Pentium II, Celeron desde que suporte PAE</p><p>- 2GB de espaço em disco</p><p><br></p><p><br></p><h2>Linux Lite</h2><p><br></p><p>Linux Lite é leve e focado exclusivamente em computadores antigos. A distribuição tem como base o Ubuntu LTS o que garante uma maior estabilidade e acesso a muitos softwares.</p><p>A distro já vem com alguns softwares especialmente selecionados para computadores antigos, então, fique atento no que vai instalar depois, ou vai precisar aumentar os recursos de sua máquina.</p><p>Alguns aplicativos já vêm pré-instalados, como o Firefox, Thunderbird, Dropbox, LibreOffice, VLC, GIMP e o Lite para ajustar as configurações da área de trabalho. O ambiente padrão é o XFCE bem polido o que garante o menor consumo de recursos.</p><p><br></p><p><img src=\"http://localhost/xampp/LocalTech/Site/view/assets/images/Postagens/Imagens/2dc0bd30c45c78c8.jpg\"></p><p><br></p><h3>Requisitos mínimos:</h3><p><br></p><p>- 512MB de RAM</p><p>- Processador de 700Mhz</p><p>- 5GB de espaço em disco</p>', '2022-06-18', '2022-06-19');

-- ------------------------------------------------------------------------------------------

INSERT INTO `localtech`.`postagem` (`id_postagem`, `cod`, `capa`, `titulo`, `autor`, `conteudo`, `postado`, `atualizado`) VALUES ('3', '987091618', '1655695142Capa.png', 'Conheça o Windows 10 Lite', 'ReviOS', '<p>O ReviOS pretende recriar o que o Windows como sistema operacional deveria ter sido - fácil e simples.</p><p><br></p><p>Com o público principal sendo jogadores, usuários avançados e entusiastas, entendemos que desempenho, velocidade e baixa latência são obrigatórios, e é por isso que um grande esforço foi investido para tornar o ReviOS um sistema operacional capaz, eficiente e privado.</p><p><br></p><p>Sendo naturalmente leve em recursos, espaço e tamanho, também é uma ótima opção para sistemas de baixo custo.</p><p><br></p><h2>1 - Baixar o Sistema</h2><p><br></p><p>Você pode encontrar o download do sistema no site oficial do ReviOS, acessando esse <a href=\"https://www.revi.cc/revios/download\" target=\"_blank\">link</a>.</p><p><br></p><p><img src=\"http://localhost/xampp/LocalTech/Site/view/assets/images/Postagens/Imagens/e215136b03140b54.png\" alt=\"\"></p><p><br></p><h2>2 - Criar um Instalador do Sistema</h2><p class=\"MsoNormal\"><o:p></o:p></p><p class=\"MsoNormal\"><o:p>&nbsp;</o:p></p><p>\r\n\r\n\r\n\r\n</p><p class=\"MsoNormal\">Após baixar o sistema será necessário, ter um pendrive para colocar\r\no instalado, e baixar o criado de pendrive bootável, o Rufus, que pode ser\r\nbaixado neste <a href=\"https://rufus.ie/pt_BR/\" target=\"_blank\">link</a>.<o:p></o:p></p><p class=\"MsoNormal\"><br></p><p class=\"MsoNormal\">Ao abrir o Rufus, deverá clicar em <strong>SELECIONAR </strong>e indicar onde\r\nse encontra o download ISO do sistema ReviOS baixado anteriormente.<o:p></o:p></p><p class=\"MsoNormal\"><br></p><p class=\"MsoNormal\">\r\n\r\n</p><p class=\"MsoNormal\">E escolher o Esquema de Partição de sua placa mãe, caso não\r\nsaiba se sua placa é MBR ou GPT, ou apenas\r\nescolha MBR que funcionará em qualquer versão de placa mãe.</p><p class=\"MsoNormal\"><br></p><p class=\"MsoNormal\">E clique em <strong>Iniciar</strong>.</p><p class=\"MsoNormal\"><br></p><img src=\"http://localhost/xampp/LocalTech/Site/view/assets/images/Postagens/Imagens/599f3841d3625392.png\" alt=\"\"><p class=\"MsoNormal\">&nbsp;<o:p></o:p></p><h2>3 – Instalando o Sistema</h2><p class=\"MsoNormal\"><o:p></o:p></p><p class=\"MsoNormal\"><o:p>&nbsp;</o:p></p><p class=\"MsoNormal\">Ao concluir a criação do pendrive bootável, deverá desligar\r\nseu computador e iniciar o boot pelo pendrive.<o:p></o:p></p><p class=\"MsoNormal\"><br></p><p class=\"MsoNormal\">\r\n\r\n\r\n\r\n\r\n\r\n</p><p class=\"MsoNormal\"><em>Lembrando que todos os arquivos do seu sistema atual serão\r\nperdidos.</em><br><o:p></o:p></p><p class=\"MsoNormal\"><em><br></em></p><p class=\"MsoNormal\">Quando o boot foi iniciar pelo pendrive, infelizmente só estará\r\ndisponível para instalar o sistema no idioma inglês, mas poderá ser ao alterado\r\ndepois dentro do sistema.<o:p></o:p></p><p class=\"MsoNormal\"><br></p><p class=\"MsoNormal\"><img src=\"http://localhost/xampp/LocalTech/Site/view/assets/images/Postagens/Imagens/d99c33a20b2c4f27.png\" alt=\"\"></p><p class=\"MsoNormal\"><br></p><p class=\"MsoNormal\">Clique em <strong>Next</strong>, e depois em <strong>Install Now</strong>.</p><p class=\"MsoNormal\"><br></p><p class=\"MsoNormal\"><img src=\"http://localhost/xampp/LocalTech/Site/view/assets/images/Postagens/Imagens/a8606cf44bbd0a9f.png\" alt=\"\"></p><p class=\"MsoNormal\"><br></p><p class=\"MsoNormal\">Logo após será pedido que aceite os termos de uso do sistema da Microsoft para que possa continuar com a instalação normalmente, clique em&nbsp;<strong>I accept the license terms</strong> e depois em <strong>Next</strong>.</p><p class=\"MsoNormal\"><br></p><p class=\"MsoNormal\"><img src=\"http://localhost/xampp/LocalTech/Site/view/assets/images/Postagens/Imagens/64f5a46c13448b52.png\" alt=\"\"></p><p class=\"MsoNormal\"><br></p><p class=\"MsoNormal\">Seleciona a Partição em que o sistema ReviOS será instalado em seu computador.</p><p class=\"MsoNormal\"><br></p><p class=\"MsoNormal\">E clique em <strong>Next</strong>.</p><p class=\"MsoNormal\"><br></p><p class=\"MsoNormal\"><em>Lembrando que é recomendado que delete as partições anteriores do Windows.</em></p><p class=\"MsoNormal\"><em><br></em></p><p class=\"MsoNormal\"><img src=\"http://localhost/xampp/LocalTech/Site/view/assets/images/Postagens/Imagens/3702fea541cd7c41.png\" alt=\"\"></p><p class=\"MsoNormal\"><br></p><p class=\"MsoNormal\">Assim sua instalação será iniciada, e o sistema será reiniciado\r\nautomaticamente e entrará em preparação automática.<o:p></o:p></p><p class=\"MsoNormal\"><br></p><p class=\"MsoNormal\"><img src=\"http://localhost/xampp/LocalTech/Site/view/assets/images/Postagens/Imagens/7859f33845d02473.png\" alt=\"\"></p><p class=\"MsoNormal\"><br></p><p class=\"MsoNormal\">Insira normalmente, suas configurações de uso para o sistema,\r\ne assim seu Windows será iniciado.<o:p></o:p></p><p class=\"MsoNormal\"><br></p><p class=\"MsoNormal\"><img src=\"http://localhost/xampp/LocalTech/Site/view/assets/images/Postagens/Imagens/8b65b624ee7a1689.jpg\" alt=\"\"></p><p class=\"MsoNormal\"><br></p><h2>4 - Configurando o Sistema</h2><p class=\"MsoNormal\"><br></p><p class=\"MsoNormal\">Para alterar o idioma e data de seu sistema será necessário clicar\r\nno <strong>Menu Iniciar</strong>, ir em <strong>Settings </strong>e depois em <strong>Time &amp; Language</strong>.</p><p class=\"MsoNormal\"><br></p><p class=\"MsoNormal\"><img src=\"http://localhost/xampp/LocalTech/Site/view/assets/images/Postagens/Imagens/9364985671a2ce79.png\" alt=\"\"></p><p class=\"MsoNormal\"><br></p><p class=\"MsoNormal\">Assim poderá encontrar as opções para poder mudar o idioma\r\ndo sistema para a sua preferência.<o:p></o:p></p><p class=\"MsoNormal\"><br></p><p class=\"MsoNormal\">\r\n\r\n</p><p class=\"MsoNormal\">E desfrutar do Windows 10 Lite normalmente.<o:p></o:p></p>', '2022-05-20', '2022-06-20');

-- ------------------------------------------------------------------------------------------

INSERT INTO `localtech`.`postagem` (`id_postagem`, `cod`, `capa`, `titulo`, `autor`, `conteudo`, `postado`, `atualizado`) VALUES ('4', '1319655876', '1655699884Capa.jpg', 'MBR e GPT? Qual a diferença?', 'TechTudo', '<p class=\"MsoNormal\">As duas tecnologias são destinadas a tipos bem diferentes de\r\nsistemas, e escolher entre elas não é difícil. Os discos em MBR, por exemplo,\r\nsão melhores para computadores antigos, sem as BIOS UEFI ou com sistemas\r\noperacionais anteriores ao Windows 8.1.<o:p></o:p></p><p class=\"MsoNormal\"><br></p><p class=\"MsoNormal\">Já o GPT, mais recente, é a melhor escolha para computadores\r\nnovos e sistemas mais recentes, já que apresenta maior capacidade para criar\r\npartições.<o:p></o:p></p><p class=\"MsoNormal\" style=\"font-size: 12.32px;\"><br></p><h2>O que são MBR e GPT?</h2><p><br></p><p class=\"MsoNormal\">MBR e GPT são padrões que determinam a forma pela qual dados\r\nsão armazenados no disco. Isso inclui a forma como as partições são\r\ndistribuídas e como esses drives de SSDs ou HDs se comportam caso você instale\r\num sistema operacional inicializável neles. Embora cumpram a mesma tarefa e\r\ntenham compatibilidade com diversos sistemas operacionais, ambas são\r\ntecnologias distintas e é importante saber suas diferenças para escolher de\r\nmaneira correta.<o:p></o:p></p><p class=\"MsoNormal\" style=\"font-size: 12.32px;\"><o:p></o:p></p><p class=\"MsoNormal\" style=\"font-size: 12.32px;\"><o:p>&nbsp;</o:p></p><h2>MBR e GPT: Diferenças</h2><p><br></p><p class=\"MsoNormal\">As partições são delimitações lógicas que fracionam o espaço\r\nda mídia. Dessa forma, são criadas unidades menores, que se comportam como se\r\nfossem HDs independentes, ainda que, na prática, coexistam dentro da mesma peça\r\nde hardware.<o:p></o:p></p><p class=\"MsoNormal\"><br></p><p>\r\n\r\n</p><p class=\"MsoNormal\">MBR é sigla para “Master Boot Record”. O padrão antigo hoje\r\nse encontra em processo de substituição pelo GPT, que significa “GUID Partition\r\nTable”. Entre as limitações do MBR está o fato de não permitir ao usuário\r\nestabelecer mais do que quatro partições primárias no mesmo disco. Do outro\r\nlado, o GPT pode criar até 128 partições diferentes dentro de um mesmo disco em\r\nWindows; outros sistemas operacionais podem apresentar limites até maiores.<o:p></o:p></p><p class=\"MsoNormal\" style=\"font-size: 12.32px;\"><o:p></o:p></p><p class=\"MsoNormal\" style=\"font-size: 12.32px;\"><br></p><p class=\"MsoNormal\"><img src=\"http://localhost/xampp/LocalTech/Site/view/assets/images/Postagens/Imagens/20477ee704335fc3.png\" alt=\"\"></p><p class=\"MsoNormal\"><br></p><p class=\"MsoNormal\">Embora seja raro precisar de tantas divisões, há outra\r\nlimitação dessa tecnologia que fica mais evidente ao usuário comum: o MBR\r\nreconhece partições de até 2 TB, o que significa que esse padrão não é\r\nrecomendado para HDs e SSDs com capacidades maiores. O GPT, por sua vez, conta\r\nos setores da mídia de armazenamento de outra forma, permitindo suporte a 9,4\r\nZB (zetabytes, unidade que representa um trilhão de gigabytes).<o:p></o:p></p><p class=\"MsoNormal\"><br></p><p>\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n</p><p class=\"MsoNormal\">Outra diferença entre as duas estruturas é a forma pela qual\r\nelas trabalham com a inicialização do sistema operacional. No mais antigo MBR,\r\nos registros que permitem ao computador “achar” o sistema e dar início ao carregamento\r\nficam em uma única partição. Se algo de errado acontecer com o disco e esses\r\ndados forem corrompidos, é possível que o PC não inicialize mais. No GPT esses\r\nproblemas são amenizados com o uso de uma estrutura replicante, que posiciona\r\ncópias dos dados de inicialização em outras partições do disco, tornando o\r\nsistema mais robusto.<o:p></o:p></p>', '2022-06-20', '2022-06-20');

-- ------------------------------------------------------------------------------------------

INSERT INTO `localtech`.`postagem` (`id_postagem`, `cod`, `capa`, `titulo`, `autor`, `conteudo`, `postado`, `atualizado`) VALUES ('5', '550290916', '1655732547Capa.png', 'Como Atualizar os Drivers de Seu PC', 'Iobit', '<p class=\"MsoNormal\">Manter os drivers do sistema atualizados é essencial para\r\nque tudo funcione sem problemas. Além de garantir a segurança das informações,\r\nos drivers também garantem o máximo desempenho de cada componente.<o:p></o:p></p><p class=\"MsoNormal\"><br></p><p class=\"MsoNormal\">O Windows mantém os drivers atualizados por padrão, mas o\r\nusuário pode conferir se tudo está correto, por meio do programa Driver\r\nBooster.<o:p></o:p></p><p class=\"MsoNormal\"><br></p><p class=\"MsoNormal\">O Driver Booster é um aplicativo gratuito que oferece o\r\ngerenciamento dos drivers do seu computador. De forma simples, é possível\r\natualizar tudo de uma só vez.<o:p></o:p></p><p class=\"MsoNormal\"><o:p>&nbsp;</o:p></p><h2>1 – Como Baixar</h2><p class=\"MsoNormal\"><o:p></o:p></p><p class=\"MsoNormal\"><o:p>&nbsp;</o:p></p><p class=\"MsoNormal\">Para baixar o Driver Booster, visite o site oficial através deste\r\n<a href=\"https://www.iobit.com/pt/driver-booster.php\" target=\"_blank\">link</a>.<o:p></o:p></p><p class=\"MsoNormal\"><br></p><p class=\"MsoNormal\">E clique em <strong>Free Download</strong>. Para assim iniciar o download de\r\nseu atualizador de drivers.<o:p></o:p></p><p class=\"MsoNormal\"><br></p><p class=\"MsoNormal\"><img src=\"http://localhost/xampp/LocalTech/Site/view/assets/images/Postagens/Imagens/afa3f03d9880b120.jpg\" alt=\"\"></p><p class=\"MsoNormal\"><o:p>&nbsp;</o:p></p><h2>2 – Como Instalar</h2><p class=\"MsoNormal\"><o:p></o:p></p><p class=\"MsoNormal\"><o:p>&nbsp;</o:p></p><p class=\"MsoNormal\">Ao abrir o instalador, aparecerá uma janela onde deve\r\napertar em Iniciar.<o:p></o:p></p><p class=\"MsoNormal\"><br></p><p class=\"MsoNormal\"><img src=\"http://localhost/xampp/LocalTech/Site/view/assets/images/Postagens/Imagens/0137b4962f09203d.png\" alt=\"\"></p><p class=\"MsoNormal\"><o:p>&nbsp;</o:p></p><p class=\"MsoNormal\">Logo após serão apresentadas algumas ferramentas recomendas\r\npela Iobit, clique em <strong>Não, obrigado</strong>, e avance com a instalação.<o:p></o:p></p><p class=\"MsoNormal\"><br></p><p class=\"MsoNormal\"><img src=\"http://localhost/xampp/LocalTech/Site/view/assets/images/Postagens/Imagens/26cb679520ebd1f6.png\" alt=\"\"></p><p class=\"MsoNormal\"><o:p>&nbsp;</o:p></p><p class=\"MsoNormal\">Após isso a instalação será iniciada.<o:p></o:p></p><p class=\"MsoNormal\"><br></p><p class=\"MsoNormal\"><img src=\"http://localhost/xampp/LocalTech/Site/view/assets/images/Postagens/Imagens/e97cccd959e080a1.png\" alt=\"\"></p><p class=\"MsoNormal\"><br></p><h2>3 - Como Usar</h2><p class=\"MsoNormal\"><br></p><p class=\"MsoNormal\">Ao finalizar a instalação a tela inicial do programa será\r\naberta, basta apenas clicar em <strong>Verificar</strong>.<o:p></o:p></p><p class=\"MsoNormal\"><br></p><p class=\"MsoNormal\"><img src=\"http://localhost/xampp/LocalTech/Site/view/assets/images/Postagens/Imagens/8a76f26e7124c575.png\" alt=\"\"></p><p class=\"MsoNormal\"><o:p>&nbsp;</o:p></p><p class=\"MsoNormal\">E aguardar o processo de varredura de seus drivers\r\nacontecer.<o:p></o:p></p><p class=\"MsoNormal\"><br></p><p class=\"MsoNormal\"><img src=\"http://localhost/xampp/LocalTech/Site/view/assets/images/Postagens/Imagens/f589c74aa65e1aa9.png\" alt=\"\"></p><p class=\"MsoNormal\"><o:p>&nbsp;</o:p></p><p>\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n</p><p class=\"MsoNormal\">Assim serão listados todos os drivers disponíveis para instalação\r\nem seu computador, clique em <strong>Atualizar Agora</strong>.</p><p class=\"MsoNormal\"><br></p><p class=\"MsoNormal\">E aguarde a atualização de seus\r\ndrivers acontecer automaticamente, e logo após finalizar reinicie o sistema.<o:p></o:p></p><p class=\"MsoNormal\"><br></p><p class=\"MsoNormal\"><img src=\"http://localhost/xampp/LocalTech/Site/view/assets/images/Postagens/Imagens/b0d730540cb43fcd.png\" alt=\"\"></p><p class=\"MsoNormal\"><br></p><p class=\"MsoNormal\">Lembrando que será possível atualizar apenas os drivers de\r\ndispositivos, para atualizar todos os componentes de jogos, é necessário que se\r\ntenha uma assinatura ativa.<o:p></o:p></p><p class=\"MsoNormal\"><br></p><p class=\"MsoNormal\">Ao comprar uma licença, irá liberar a atualização de todos\r\nos drivers do PC.<o:p></o:p></p><p class=\"MsoNormal\"><br></p><p class=\"MsoNormal\"><img src=\"http://localhost/xampp/LocalTech/Site/view/assets/images/Postagens/Imagens/5662879a2d6af7c6.png\" alt=\"\"></p><p class=\"MsoNormal\"><o:p>&nbsp;</o:p></p><p class=\"MsoNormal\">A assinatura do Driver Booster Pro sai no valor de R$ 79,99.\r\nCom ativação de 1 ano em até 3 computadores.<o:p></o:p></p><p class=\"MsoNormal\"><br></p><p class=\"MsoNormal\">\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n</p><p class=\"MsoNormal\">Poderá encontrar mais detalhes neste <a href=\"https://www.iobit.com/pt/driver-booster-pro.php\" target=\"_blank\">link</a>.<o:p></o:p></p>', '2022-05-20', '2022-06-20');

-- ------------------------------------------------------------------------------------------

-- INSERT INTO `localtech`.`postagem` (`id_postagem`, `cod`, `capa`, `titulo`, `autor`, `conteudo`, `postado`, `atualizado`) VALUES ();