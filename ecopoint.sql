-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 26-Abr-2025 às 07:08
-- Versão do servidor: 10.4.32-MariaDB
-- versão do PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `ecopoint`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuario`
--

CREATE TABLE `usuario` (
  `id` int(11) NOT NULL,
  `nome` varchar(80) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `cpf` varchar(14) DEFAULT NULL,
  `login` varchar(50) DEFAULT NULL,
  `senha` varchar(225) DEFAULT NULL,
  `endereco` varchar(80) DEFAULT NULL,
  `cidade` varchar(80) DEFAULT NULL,
  `bairro` varchar(80) DEFAULT NULL,
  `cep` varchar(9) DEFAULT NULL,
  `numero` int(11) DEFAULT NULL,
  `complemento` varchar(50) DEFAULT NULL,
  `telefone` varchar(20) DEFAULT NULL,
  `nascimento` date DEFAULT NULL,
  `criado_em` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `usuario`
--

INSERT INTO `usuario` (`id`, `nome`, `email`, `cpf`, `login`, `senha`, `endereco`, `cidade`, `bairro`, `cep`, `numero`, `complemento`, `telefone`, `nascimento`, `criado_em`) VALUES
(5, 'Jake Peralta e Amy Santiago', 'alessandra@gmail.com', '13789213721', 'pesant', '$2y$10$KMp0uwpnhtr4J8209hcZzOyW79U3mJ12kAUsSpk.Xsol9n0dQOXuK', 'Rua Castro Alves', 'Rio de Janeiro', 'Méier', '20775-040', 158, 'Casa 08', '(21) 96444-3878', '2005-07-07', '2025-04-24 00:28:41'),
(6, 'Laika Cristina da Silva Pereira', 'laika54@gmail.com', '13789213721', 'laika_', '$2y$10$jlhNDRmeA2Gav0.MiTPgZe/ZvmugD85NDoayqgozBXUx9bBgWCYNS', 'Rua Castro Alves', 'Rio de Janeiro', 'Méier', '20775-040', 158, 'Casa 08', '(21) 96444-3978', '2004-01-01', '2025-04-24 00:46:22'),
(7, 'Alessandra Cristina da Silva', 'alesilva@gmail.com', '13789213721', 'ale_si', '$2y$10$pOmN4aYURumAIjiJXWNuout.OH0hFLINHz7bAMXCWbL22ffKf9/5y', 'Rua Castro Alves', 'Rio de Janeiro', 'Méier', '20775-040', 158, 'Casa 08', '(21) 96444-3878', '2004-07-07', '2025-04-25 02:30:51'),
(8, 'Camilly Cristina da Silva Pereira', 'teste@gmail.com', '13789213721', 'milly_', '$2y$10$7taUV57x0.b4C/4dKVWwXOMfDZzvF6TMqG/OAuOOgK3yez0rqohBq', 'Rua Castro Alves', 'Rio de Janeiro', 'Méier', '20775-040', 158, '12', '(21) 96444-3878', '2004-07-07', '2025-04-25 02:48:19');

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
