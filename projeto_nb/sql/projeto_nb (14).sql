-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 03-Jun-2020 às 05:53
-- Versão do servidor: 10.4.11-MariaDB
-- versão do PHP: 7.4.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `projeto_nb`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `acoes_aluno`
--

CREATE TABLE `acoes_aluno` (
  `id` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL DEFAULT 0,
  `id_notebook` int(11) NOT NULL DEFAULT 0,
  `id_dispenser` int(11) DEFAULT NULL,
  `id_turma` int(11) DEFAULT 0,
  `nome_usuario` varchar(100) DEFAULT NULL,
  `fonte` int(11) NOT NULL DEFAULT 0,
  `data_emp` datetime DEFAULT NULL,
  `data_dev` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `acoes_aluno`
--

INSERT INTO `acoes_aluno` (`id`, `id_usuario`, `id_notebook`, `id_dispenser`, `id_turma`, `nome_usuario`, `fonte`, `data_emp`, `data_dev`) VALUES
(30, 7, 4, 3, 2, 'Joao', 6, '2020-06-03 00:29:28', '2020-06-03 00:44:11'),
(31, 7, 4, 3, 2, 'Joao', 6, '2020-06-03 00:30:50', '2020-06-03 00:44:11'),
(32, 8, 5, 3, 2, 'Marcelo', 5, '2020-06-03 00:31:44', '2020-06-03 00:45:25'),
(33, 7, 4, 3, 2, 'Joao', 8, '2020-06-03 00:40:57', '2020-06-03 00:44:11'),
(34, 8, 7, 4, 2, 'Marcelo', 4, '2020-06-03 00:44:28', '2020-06-03 00:45:25');

-- --------------------------------------------------------

--
-- Estrutura da tabela `dispenser`
--

CREATE TABLE `dispenser` (
  `id` int(11) NOT NULL,
  `dispenser_turma` int(11) DEFAULT 0,
  `capacidade` int(10) DEFAULT 0,
  `status` varchar(50) DEFAULT 'BLOQUEADO'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `dispenser`
--

INSERT INTO `dispenser` (`id`, `dispenser_turma`, `capacidade`, `status`) VALUES
(1, 1, 5, 'LIBERADO'),
(2, 1, 5, 'LIBERADO'),
(3, 2, 3, 'LIBERADO'),
(4, 2, 3, 'LIBERADO');

-- --------------------------------------------------------

--
-- Estrutura da tabela `fonte`
--

CREATE TABLE `fonte` (
  `id` int(11) NOT NULL,
  `numero` int(11) NOT NULL DEFAULT 0,
  `status` varchar(50) NOT NULL DEFAULT 'LIVRE',
  `excluido` int(10) NOT NULL DEFAULT 0,
  `fonte_dispenser` int(10) NOT NULL DEFAULT 0,
  `fonte_turma` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `fonte`
--

INSERT INTO `fonte` (`id`, `numero`, `status`, `excluido`, `fonte_dispenser`, `fonte_turma`) VALUES
(1, 1, 'LIVRE', 0, 1, 1),
(2, 2, 'LIVRE', 0, 1, 1),
(3, 3, 'LIVRE', 0, 2, 1),
(4, 1, 'LIVRE', 0, 3, 2),
(5, 2, 'LIVRE', 0, 3, 2),
(6, 3, 'LIVRE', 0, 3, 2),
(7, 1, 'LIVRE', 0, 4, 2),
(8, 2, 'LIVRE', 0, 4, 2);

-- --------------------------------------------------------

--
-- Estrutura da tabela `notebook`
--

CREATE TABLE `notebook` (
  `id` int(11) NOT NULL,
  `nome` varchar(50) NOT NULL DEFAULT '0',
  `status` varchar(50) DEFAULT NULL,
  `excluido` int(1) DEFAULT 0,
  `note_dispenser` int(11) DEFAULT NULL,
  `note_turma` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `notebook`
--

INSERT INTO `notebook` (`id`, `nome`, `status`, `excluido`, `note_dispenser`, `note_turma`) VALUES
(1, 'Notebook 1', 'LIVRE', 0, 1, 1),
(2, 'Notebook 2', 'LIVRE', 0, 1, 1),
(3, 'Notebook 3', 'LIVRE', 0, 2, 1),
(4, 'Notebook BCC 1', 'LIVRE', 0, 3, 2),
(5, 'Notebook BCC2', 'LIVRE', 0, 3, 2),
(6, 'Notebook BCC3', 'LIVRE', 0, 3, 2),
(7, 'Notebook Dell 1', 'LIVRE', 0, 4, 2),
(8, 'Notebook Dell 2', 'LIVRE', 0, 4, 2);

-- --------------------------------------------------------

--
-- Estrutura da tabela `problema`
--

CREATE TABLE `problema` (
  `ID_Problema` int(11) NOT NULL,
  `ID_Aluno` int(11) NOT NULL,
  `ID_Notebook` int(11) NOT NULL,
  `ID_Dispenser` int(11) NOT NULL,
  `problema` text CHARACTER SET utf8 NOT NULL DEFAULT '',
  `status` varchar(20) CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `problema`
--

INSERT INTO `problema` (`ID_Problema`, `ID_Aluno`, `ID_Notebook`, `ID_Dispenser`, `problema`, `status`) VALUES
(1, 4, 1, 1, 'Problema com XAMPP', 'Resolvido');

-- --------------------------------------------------------

--
-- Estrutura da tabela `turma`
--

CREATE TABLE `turma` (
  `id` int(11) NOT NULL,
  `sala` varchar(50) NOT NULL DEFAULT '0',
  `curso` varchar(50) NOT NULL DEFAULT '0',
  `periodo` int(11) NOT NULL DEFAULT 0,
  `status` tinyint(1) DEFAULT 0,
  `ano` int(100) DEFAULT NULL,
  `turno` varchar(50) DEFAULT NULL,
  `excluido` int(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `turma`
--

INSERT INTO `turma` (`id`, `sala`, `curso`, `periodo`, `status`, `ano`, `turno`, `excluido`) VALUES
(1, '1', 'BES', 1, 0, 2020, 'Manha', 0),
(2, '2', 'BCC', 2, 0, 2020, 'Manha', 0),
(3, '2', 'BES', 1, 0, 2020, 'Tarde', 0);

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `email` varchar(50) DEFAULT NULL,
  `nome` varchar(100) NOT NULL DEFAULT '0',
  `senha` varchar(32) NOT NULL DEFAULT '0',
  `status` varchar(50) NOT NULL DEFAULT '0',
  `nivel` varchar(20) NOT NULL,
  `excluido` int(1) DEFAULT 0,
  `turma_usuario` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `usuarios`
--

INSERT INTO `usuarios` (`id`, `email`, `nome`, `senha`, `status`, `nivel`, `excluido`, `turma_usuario`) VALUES
(1, 'admin@nb.com', 'Admin', '202cb962ac59075b964b07152d234b70', 'Ativo', 'Administrador', 0, NULL),
(2, 'aug@nb.com', 'Augusto', '202cb962ac59075b964b07152d234b70', 'Ativo', 'Aluno', 0, 1),
(3, 'paludo@nb.com', 'Paludo', '202cb962ac59075b964b07152d234b70', 'Ativo', 'Professor', 0, 1),
(4, 'theo@nb.com', 'Theo', '202cb962ac59075b964b07152d234b70', 'Ativo', 'Aluno', 0, 1),
(5, 'mark@nb.com', 'Mark', '202cb962ac59075b964b07152d234b70', 'Ativo', 'Aluno', 0, 1),
(6, 'lucas@nb.com', 'Lucas', '202cb962ac59075b964b07152d234b70', 'Ativo', 'Aluno', 0, 1),
(7, 'joao@nb.com', 'Joao', '202cb962ac59075b964b07152d234b70', 'Ativo', 'Aluno', 0, 2),
(8, 'mar@nb.com', 'Marcelo', '202cb962ac59075b964b07152d234b70', 'Ativo', 'Aluno', 0, 2),
(12, 'teste@teste.com', 'teste', '202cb962ac59075b964b07152d234b70', 'Ativo', 'Administrador', 0, NULL);

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `acoes_aluno`
--
ALTER TABLE `acoes_aluno`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_id_usuario` (`id_usuario`),
  ADD KEY `fk_id_notebook` (`id_notebook`),
  ADD KEY `fk_id_dispenser` (`id_dispenser`),
  ADD KEY `fk_id_turma` (`id_turma`);

--
-- Índices para tabela `dispenser`
--
ALTER TABLE `dispenser`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_dispenser_turma` (`dispenser_turma`);

--
-- Índices para tabela `fonte`
--
ALTER TABLE `fonte`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_fonte_dispenser` (`fonte_dispenser`),
  ADD KEY `fk_fonte_turma` (`fonte_turma`);

--
-- Índices para tabela `notebook`
--
ALTER TABLE `notebook`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_notebook_dispenser` (`note_dispenser`),
  ADD KEY `fk_notebook_turma` (`note_turma`);

--
-- Índices para tabela `problema`
--
ALTER TABLE `problema`
  ADD PRIMARY KEY (`ID_Problema`),
  ADD KEY `ID_Usuario` (`ID_Aluno`),
  ADD KEY `ID_Notebook` (`ID_Notebook`),
  ADD KEY `ID_Dispenser` (`ID_Dispenser`);

--
-- Índices para tabela `turma`
--
ALTER TABLE `turma`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `fk_usuario_turma` (`turma_usuario`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `acoes_aluno`
--
ALTER TABLE `acoes_aluno`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT de tabela `dispenser`
--
ALTER TABLE `dispenser`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de tabela `fonte`
--
ALTER TABLE `fonte`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de tabela `notebook`
--
ALTER TABLE `notebook`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de tabela `problema`
--
ALTER TABLE `problema`
  MODIFY `ID_Problema` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `turma`
--
ALTER TABLE `turma`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `acoes_aluno`
--
ALTER TABLE `acoes_aluno`
  ADD CONSTRAINT `fk_id_dispenser` FOREIGN KEY (`id_dispenser`) REFERENCES `dispenser` (`id`),
  ADD CONSTRAINT `fk_id_notebook` FOREIGN KEY (`id_notebook`) REFERENCES `notebook` (`id`),
  ADD CONSTRAINT `fk_id_turma` FOREIGN KEY (`id_turma`) REFERENCES `turma` (`id`),
  ADD CONSTRAINT `fk_id_usuario` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id`);

--
-- Limitadores para a tabela `dispenser`
--
ALTER TABLE `dispenser`
  ADD CONSTRAINT `fk_dispenser_turma` FOREIGN KEY (`dispenser_turma`) REFERENCES `turma` (`id`);

--
-- Limitadores para a tabela `fonte`
--
ALTER TABLE `fonte`
  ADD CONSTRAINT `fk_fonte_dispenser` FOREIGN KEY (`fonte_dispenser`) REFERENCES `dispenser` (`id`),
  ADD CONSTRAINT `fk_fonte_turma` FOREIGN KEY (`fonte_turma`) REFERENCES `turma` (`id`);

--
-- Limitadores para a tabela `notebook`
--
ALTER TABLE `notebook`
  ADD CONSTRAINT `fk_notebook_dispenser` FOREIGN KEY (`note_dispenser`) REFERENCES `dispenser` (`id`),
  ADD CONSTRAINT `fk_notebook_turma` FOREIGN KEY (`note_turma`) REFERENCES `turma` (`id`);

--
-- Limitadores para a tabela `problema`
--
ALTER TABLE `problema`
  ADD CONSTRAINT `ID_Notebook` FOREIGN KEY (`ID_Notebook`) REFERENCES `notebook` (`id`),
  ADD CONSTRAINT `ID_Usuario` FOREIGN KEY (`ID_Aluno`) REFERENCES `usuarios` (`id`);

--
-- Limitadores para a tabela `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `fk_usuario_turma` FOREIGN KEY (`turma_usuario`) REFERENCES `turma` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
