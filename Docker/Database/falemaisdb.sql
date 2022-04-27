-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: db
-- Tempo de geração: 27/04/2022 às 19:13
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

DELIMITER $$
--
-- Procedimentos
--
CREATE DEFINER=`root`@`%` PROCEDURE `getDiscagemDestino` (IN `p_origem` INT)   SELECT DD.* FROM discagem AS DO 
INNER JOIN tarifas AS TA ON DO.iddiscagem=TA.idorigem
INNER JOIN discagem AS DD ON TA.iddestino=DD.iddiscagem
WHERE DO.iddiscagem=p_origem$$

CREATE DEFINER=`root`@`%` PROCEDURE `getDiscagemOrigem` (IN `p_id` INT)   IF p_id = 0 THEN
	SELECT * FROM discagem;
ELSE
	SELECT * FROM discagem WHERE iddiscagem=p_id;
END IF$$

CREATE DEFINER=`root`@`%` PROCEDURE `getPlanos` (IN `p_idPlano` INT)   IF p_idPlano>0 THEN
SELECT * FROM planos WHERE idplanos=p_idPlano;
ELSE
SELECT * FROM planos;
END IF$$

CREATE DEFINER=`root`@`%` PROCEDURE `getTarifasCalcular` (IN `p_origem` INT, IN `p_destino` INT, IN `p_plano` INT, IN `p_minutos` INT)   SELECT
	CONCAT(DO.ddd,'   (',DO.regiao,'-',DO.uf,')') AS origen,
    CONCAT(DD.ddd,'   (',DD.regiao,'-',DD.uf,')') AS destino,
    TA.valorminuto,
    PLA.name,
(
        CASE
            WHEN p_minutos > 0 THEN p_minutos * TA.valorminuto
            ELSE 0.00
        END
    ) AS semfalemais,
    (
        CASE
            WHEN PLA.minutos IS NOT NULL THEN CASE
                WHEN (p_minutos - PLA.minutos) > 0 THEN 
        			CAST(((p_minutos - PLA.minutos) * TA.valorminuto) +(
                    ((p_minutos - PLA.minutos) * TA.valorminuto) * PLA.porcacrecimo
                ) / 100 AS DECIMAL(5,2))
                ELSE 0.00
            END
            ELSE p_minutos * TA.valorminuto
        END
    ) AS comfalemais    
FROM discagem AS DO
    INNER JOIN tarifas AS TA ON DO.iddiscagem = TA.idorigem
    INNER JOIN discagem AS DD ON TA.iddestino = DD.iddiscagem
    LEFT JOIN planos AS PLA ON PLA.idplanos = p_plano
WHERE TA.idorigem = p_origem
    AND TA.iddestino = p_destino$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Estrutura para tabela `discagem`
--

CREATE TABLE `discagem` (
  `iddiscagem` int(11) NOT NULL,
  `ddd` varchar(5) NOT NULL,
  `type` int(11) NOT NULL DEFAULT '1' COMMENT '1 - Nacionais, 2 Internacionais',
  `regiao` varchar(50) CHARACTER SET utf8 NOT NULL DEFAULT 'São Paulo',
  `uf` varchar(5) NOT NULL DEFAULT 'SP',
  `datareg` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `datamod` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Despejando dados para a tabela `discagem`
--

INSERT INTO `discagem` (`iddiscagem`, `ddd`, `type`, `regiao`, `uf`, `datareg`, `datamod`) VALUES
(1, '011', 1, 'São Paulo', 'SP', '2022-04-24 20:30:56', '2022-04-27 00:14:22'),
(2, '016', 1, 'São Paulo', 'SP', '2022-04-24 20:30:56', '2022-04-27 00:14:26'),
(3, '017', 1, 'São Paulo', 'SP', '2022-04-24 20:30:56', '2022-04-27 00:14:29'),
(4, '018', 1, 'São Paulo', 'SP', '2022-04-24 20:30:56', '2022-04-27 00:14:32');

-- --------------------------------------------------------

--
-- Estrutura para tabela `planos`
--

CREATE TABLE `planos` (
  `idplanos` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `minutos` int(11) NOT NULL,
  `porcacrecimo` int(11) NOT NULL COMMENT 'porcentagem de acessimo',
  `valor` decimal(5,2) NOT NULL DEFAULT '0.00' COMMENT 'valor do plano',
  `datareg` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `datamod` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Despejando dados para a tabela `planos`
--

INSERT INTO `planos` (`idplanos`, `name`, `minutos`, `porcacrecimo`, `valor`, `datareg`, `datamod`) VALUES
(1, 'FaleMais 30 (30 minutos)', 30, 10, '20.00', '2022-04-24 20:30:56', '2022-04-26 19:21:09'),
(2, 'FaleMais 60 (60 minutos)', 60, 10, '25.00', '2022-04-24 20:30:56', '2022-04-26 19:21:15'),
(3, 'FaleMais 120 (120 minutos)', 120, 10, '30.00', '2022-04-24 20:30:56', '2022-04-26 19:21:28');

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