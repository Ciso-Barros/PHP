-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Tempo de geração: 21/11/2022 às 21:21
-- Versão do servidor: 10.4.25-MariaDB
-- Versão do PHP: 7.4.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `trabalho_puc`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `cadastro_pessoas`
--

CREATE TABLE `cadastro_pessoas` (
  `id` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `senha` varchar(255) NOT NULL,
  `telefone` varchar(11) DEFAULT NULL,
  `nascimento` date DEFAULT NULL,
  `data` datetime NOT NULL DEFAULT current_timestamp(),
  `item` varchar(20) NOT NULL,
  `admin` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Despejando dados para a tabela `cadastro_pessoas`
--

INSERT INTO `cadastro_pessoas` (`id`, `nome`, `email`, `senha`, `telefone`, `nascimento`, `data`, `item`, `admin`) VALUES
(20, 'Fulano', 'fulano@gmail.com', '$2y$10$9MAm/y8FteR.rtiXdC61tuznWamPc9nsy1nfeI7lzcnASVaZzAwNq', '41911112222', '1997-06-19', '2022-11-19 15:16:30', 'Projetor', 1),
(21, 'Cicrano', 'cicrano@hotmail.com', '$2y$10$loU01JnYQKrgjcAPWgm6ee1NkL0plGTBeNkhkGZvPsW/p1zWLB2.q', '41988887777', '1997-06-19', '2022-11-21 17:12:00', 'Livro de Matemática', 0),
(22, 'Beltrano', 'beltrano@hotmail.com', '$2y$10$X0S/tVRrR9HMaFEPdE6BgehWUCQmAZPcyneuBPHuV94XhL98O4HSG', '41988886666', '1997-06-19', '2022-11-21 17:13:04', 'Livro de Português', 0);

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `cadastro_pessoas`
--
ALTER TABLE `cadastro_pessoas`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `cadastro_pessoas`
--
ALTER TABLE `cadastro_pessoas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
