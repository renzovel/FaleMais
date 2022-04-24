-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: db
-- Tempo de geração: 24/04/2022 às 20:31
-- Versão do servidor: 5.7.37
-- Versão do PHP: 8.0.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `falemaisdb`
--
CREATE DATABASE IF NOT EXISTS `falemaisdb` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `falemaisdb`;

-- --------------------------------------------------------

--
-- Estrutura para tabela `discagem`
--

CREATE TABLE `discagem` (
  `iddiscagem` int(11) NOT NULL,
  `ddd` varchar(5) NOT NULL,
  `type` int(11) NOT NULL DEFAULT '1' COMMENT '1 - Nacionais, 2 Internacionais',
  `datareg` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `datamod` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Despejando dados para a tabela `discagem`
--

INSERT INTO `discagem` (`iddiscagem`, `ddd`, `type`, `datareg`, `datamod`) VALUES
(1, '011', 1, '2022-04-24 20:30:56', '2022-04-24 20:30:56'),
(2, '016', 1, '2022-04-24 20:30:56', '2022-04-24 20:30:56'),
(3, '017', 1, '2022-04-24 20:30:56', '2022-04-24 20:30:56'),
(4, '018', 1, '2022-04-24 20:30:56', '2022-04-24 20:30:56');

-- --------------------------------------------------------

--
-- Estrutura para tabela `planos`
--

CREATE TABLE `planos` (
  `idplanos` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `minutos` int(11) NOT NULL,
  `porcacrecimo` int(11) NOT NULL COMMENT 'porcentagem de acessimo',
  `datareg` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `datamod` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Despejando dados para a tabela `planos`
--

INSERT INTO `planos` (`idplanos`, `name`, `minutos`, `porcacrecimo`, `datareg`, `datamod`) VALUES
(1, 'FaleMais 30 (30 minutos)', 30, 10, '2022-04-24 20:30:56', '2022-04-24 20:30:56'),
(2, 'FaleMais 60 (60 minutos)', 60, 10, '2022-04-24 20:30:56', '2022-04-24 20:30:56'),
(3, 'FaleMais 120 (120 minutos)', 120, 10, '2022-04-24 20:30:56', '2022-04-24 20:30:56');

-- --------------------------------------------------------

--
-- Estrutura para tabela `tarifas`
--

CREATE TABLE `tarifas` (
  `idtarifa` int(11) NOT NULL,
  `idorigem` int(11) NOT NULL,
  `iddestino` int(11) NOT NULL,
  `valorminuto` decimal(5,2) NOT NULL,
  `datareg` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `datamod` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Despejando dados para a tabela `tarifas`
--

INSERT INTO `tarifas` (`idtarifa`, `idorigem`, `iddestino`, `valorminuto`, `datareg`, `datamod`) VALUES
(1, 1, 2, '1.90', '2022-04-24 20:30:56', '2022-04-24 20:30:56'),
(2, 2, 1, '2.90', '2022-04-24 20:30:56', '2022-04-24 20:30:56'),
(3, 1, 3, '1.70', '2022-04-24 20:30:56', '2022-04-24 20:30:56'),
(4, 3, 1, '2.70', '2022-04-24 20:30:56', '2022-04-24 20:30:56'),
(5, 1, 4, '0.90', '2022-04-24 20:30:56', '2022-04-24 20:30:56'),
(6, 4, 2, '1.90', '2022-04-24 20:30:56', '2022-04-24 20:30:56');

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `discagem`
--
ALTER TABLE `discagem`
  ADD PRIMARY KEY (`iddiscagem`);

--
-- Índices de tabela `planos`
--
ALTER TABLE `planos`
  ADD PRIMARY KEY (`idplanos`);

--
-- Índices de tabela `tarifas`
--
ALTER TABLE `tarifas`
  ADD PRIMARY KEY (`idtarifa`),
  ADD KEY `fk_discagem_tarifas_idorigin` (`idorigem`),
  ADD KEY `fk_discagem_tarifas_iddestino` (`iddestino`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `discagem`
--
ALTER TABLE `discagem`
  MODIFY `iddiscagem` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de tabela `planos`
--
ALTER TABLE `planos`
  MODIFY `idplanos` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `tarifas`
--
ALTER TABLE `tarifas`
  MODIFY `idtarifa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `tarifas`
--
ALTER TABLE `tarifas`
  ADD CONSTRAINT `fk_discagem_tarifas_iddestino` FOREIGN KEY (`iddestino`) REFERENCES `discagem` (`iddiscagem`),
  ADD CONSTRAINT `fk_discagem_tarifas_idorigin` FOREIGN KEY (`idorigem`) REFERENCES `discagem` (`iddiscagem`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;