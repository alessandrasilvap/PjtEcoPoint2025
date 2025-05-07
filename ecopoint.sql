-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 06/05/2025 às 04:37
-- Versão do servidor: 10.4.32-MariaDB
-- Versão do PHP: 8.2.12

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
-- Estrutura para tabela `pontos_coleta`
--

CREATE TABLE `pontos_coleta` (
  `id` int(11) NOT NULL,
  `usuario_id` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `endereco` varchar(80) NOT NULL,
  `estado` varchar(80) NOT NULL,
  `bairro` varchar(80) NOT NULL,
  `observacao` varchar(225) DEFAULT NULL,
  `criado_em` timestamp NOT NULL DEFAULT current_timestamp(),
  `cep` int(10) NOT NULL,
  `numero` int(11) NOT NULL,
  `complemento` varchar(50) DEFAULT NULL,
  `cidade` varchar(80) NOT NULL,
  `situacao` enum('pendente','aprovado','reprovado') DEFAULT 'pendente',
  `latitude` decimal(10,8) DEFAULT NULL,
  `longitude` decimal(11,8) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `pontos_coleta`
--

INSERT INTO `pontos_coleta` (`id`, `usuario_id`, `nome`, `endereco`, `estado`, `bairro`, `observacao`, `criado_em`, `cep`, `numero`, `complemento`, `cidade`, `situacao`, `latitude`, `longitude`) VALUES
(1, 18, 'RETIPEL ', 'Rua Leandro Martins', 'Rio de Janeiro', 'Centro', 'Recebe e retira de acordo com o volume', '2025-05-04 17:45:45', 20080, 51, '', 'Rio de Janeiro', 'aprovado', -22.90116020, -43.18414110),
(2, 18, 'SABOR SAÚDE', 'Rua da Quitanda', 'Rio de Janeiro', 'Centro', 'Apenas recebe.', '2025-05-04 17:50:09', 20011, 21, '', 'Rio de Janeiro', 'aprovado', -22.90470390, -43.17639650),
(5, 18, 'SPOLETO URUGUAIANA', 'Rua Buenos Aires', 'Rio de Janeiro', 'Centro', '', '2025-05-04 17:56:27', 20061, 249, '', 'Rio de Janeiro', 'aprovado', -22.90513640, -43.18469550),
(6, 18, 'Colégio EDEM', 'Rua Gago Coutinho', 'Rio de Janeiro', 'Laranjeiras', '', '2025-05-04 17:59:59', 22221, 14, '', 'Rio de Janeiro', 'aprovado', -22.93126270, -43.18096420),
(8, 18, 'Loja Ahlma', 'Rua Carlos Gois', 'Rio de Janeiro', 'Leblon', 'Apenas recebe.', '2025-05-04 18:04:49', 22440, 208, '', 'Rio de Janeiro', 'aprovado', -22.98423560, -43.21987310),
(9, 18, 'Clube de Regatas Flamengo', 'Avenida Borges de Medeiros', 'Rio de Janeiro', 'Leblon', 'Apenas recebe.', '2025-05-04 18:05:55', 22430, 997, '', 'Rio de Janeiro', 'aprovado', -22.98432690, -43.21593270),
(10, 18, 'Shopping Rio Design Leblon', 'Avenida Ataulfo de Paiva', 'Rio de Janeiro', 'Leblon', 'Apenas recebe.', '2025-05-04 18:07:44', 22440, 270, '2º andar', 'Rio de Janeiro', 'aprovado', -22.98367300, -43.21695900),
(11, 18, 'T.T. Burguer', 'Avenida Ataulfo de Paiva', 'Rio de Janeiro', 'Leblon', 'Apenas recebe.', '2025-05-04 18:08:52', 22440, 1240, '', 'Rio de Janeiro', 'aprovado', -22.98595700, -43.22737300),
(12, 18, 'NEX COWORKING', 'Ladeira da Glória', 'Rio de Janeiro', 'Glória', 'Apenas recebe.', '2025-05-04 18:10:23', 22211, 26, 'Bloco 3', 'Rio de Janeiro', 'aprovado', -22.92201600, -43.17527430),
(13, 18, 'UNIRIO', 'Rua Voluntários da Pátria', 'Rio de Janeiro', 'Botafogo', '', '2025-05-04 18:11:40', 22270, 107, '', 'Rio de Janeiro', 'aprovado', -22.95206330, -43.18477470),
(14, 18, 'REDE ASTA', 'Rua Gago Coutinho', 'Rio de Janeiro', 'Laranjeiras', '', '2025-05-04 18:13:06', 22221, 66, 'Loja A', 'Rio de Janeiro', 'aprovado', -22.93142760, -43.18208630),
(15, 18, 'COOPAMA', 'Rua Miguel Ângelo', 'Rio de Janeiro', 'Posse', 'Recebe e coleta.', '2025-05-04 18:14:32', 25973, 385, '', 'Teresópolis', 'aprovado', -22.37218620, -42.99113300),
(16, 18, 'ACMR', 'Rua Itaigara', 'Rio de Janeiro', 'Coelho Neto', '', '2025-05-04 18:15:11', 21510, 77, '', 'Rio de Janeiro', 'aprovado', -22.83417490, -43.34902380),
(17, 18, 'COOPCAL', 'Avenida Itaóca', 'Rio de Janeiro', 'Inhaúma', '', '2025-05-04 18:15:59', 21061, 2353, '', 'Rio de Janeiro', 'aprovado', -22.87220010, -43.27692950),
(18, 18, 'COOPGALEÃO', 'Rua Macedo Costa', 'Rio de Janeiro', 'Inhaúma', '', '2025-05-04 18:16:44', 20765, 62, '', 'Rio de Janeiro', 'aprovado', -22.87367880, -43.28066670),
(19, 18, 'Maraca Hostel', 'Rua Ribeiro Guimarães', 'Rio de Janeiro', 'Vila Isabel', 'Apenas recebe.', '2025-05-04 18:17:24', 20541, 367, '', 'Rio de Janeiro', 'aprovado', -22.91947980, -43.23713910),
(20, 18, 'One On One Coworking', 'Rua Nossa Senhora de Lourdes', 'Rio de Janeiro', 'Grajaú', 'Apenas recebe.', '2025-05-04 18:18:20', 20540, 101, '', 'Rio de Janeiro', 'aprovado', -22.92110210, -43.25466060),
(21, 18, 'IJOKER no Shopping Bayside', 'Avenida das Américas', 'Rio de Janeiro', 'Barra da Tijuca', 'Apenas recebe.', '2025-05-04 18:20:47', 22640, 3120, 'loja 213', 'Rio de Janeiro', 'aprovado', -22.99940580, -43.34383850),
(22, 18, 'Shopping Rio Design Barra', 'Avenida das Américas', 'Rio de Janeiro', 'Barra da Tijuca', 'Apenas recebe.', '2025-05-04 18:21:33', 22793, 7777, '', 'Rio de Janeiro', 'aprovado', -23.00137360, -43.38588680),
(23, 18, 'ASSOCIAÇÃO BOSQUE MARAPENDI', 'Avenida Prefeito Dulcídio Cardoso', 'Rio de Janeiro', 'Barra da Tijuca', 'Apenas recebe.', '2025-05-04 18:22:16', 22620, 1250, '', 'Rio de Janeiro', 'aprovado', -23.00630520, -43.38880820),
(24, 18, 'T.T. BURGUER', 'Avenida Prefeito Dulcídio Cardoso', 'Rio de Janeiro', 'Barra da Tijuca', 'Apenas recebe.', '2025-05-04 18:22:58', 22621, 460, '', 'Rio de Janeiro', 'aprovado', -23.00785090, -43.41646440),
(26, 18, 'ESTACIONAMENTO TERREIRÃO', 'Avenida Guiomar Novais', 'Rio de Janeiro', 'Recreio dos Bandeirantes', 'Apenas recebe.', '2025-05-04 18:23:38', 22795, 400, '', 'Rio de Janeiro', 'aprovado', NULL, NULL),
(27, 18, 'VEZPA - PARQUE DAS ROSAS', 'Avenida Marechal Henrique Lott', 'Rio de Janeiro', 'Barra da Tijuca', '', '2025-05-04 18:24:43', 22631, 120, '', 'Rio de Janeiro', 'aprovado', -23.00145100, -43.34812470),
(28, 18, 'ICAIU - CITTÁ AMÉRICA', 'Avenida das Américas', 'Rio de Janeiro', 'Barra da Tijuca', '', '2025-05-04 18:25:33', 22640, 700, 'Bl. 01, 135', 'Rio de Janeiro', 'aprovado', -23.00282750, -43.32117410),
(29, 18, 'Ecoponto Caiuá', 'Estrada Velha do Barigui', 'Paraná', 'Cidade Industrial', '', '2025-05-04 18:29:00', 81250, 6800, '', 'Curitiba', 'aprovado', -25.49735750, -49.34536310),
(30, 18, 'Ecoponto Cajuru', 'Rua Neusa Vieira Bet', 'Paraná', 'Cajuru', '', '2025-05-04 18:29:44', 82990, 255, '', 'Curitiba', 'aprovado', -25.46308050, -49.19524200),
(31, 18, 'Ecoponto Campo de Santana', 'Rua Teresa de Freitas Tavares', 'Paraná', 'Campo de Santana', '', '2025-05-04 18:31:01', 81490, 331, '', 'Curitiba', 'aprovado', -25.57969070, -49.32736630),
(32, 18, 'Ecoponto Érico Veríssimo', 'Rua Capitão Amin Mosse', 'Paraná', 'Alto Boqueirão', '', '2025-05-04 18:32:57', 81850, 557, '', 'Curitiba', 'aprovado', -25.53159820, -49.25045250),
(33, 18, 'Ecoponto Jandaia', 'Rua Jornalista José Pedro dos Santos', 'Paraná', 'Ganchinho', '', '2025-05-04 18:36:10', 81935, 801, 'Ao lado do Eco Cidadão Jandaia', 'Curitiba', 'aprovado', -25.55291930, -49.24690700),
(34, 18, 'Ecoponto Metropolitano', 'Rua da Independência', 'Paraná', 'São Braz', '', '2025-05-04 18:36:56', 82310, 340, 'Esquina com a Rua Pedro Corrêa da Cruz', 'Curitiba', 'aprovado', -25.42130940, -49.36380760),
(35, 18, 'DMT Reciclagem', 'Rua Francisco Derosso', 'Paraná', 'Xaxim', '', '2025-05-04 18:40:03', 81710, 3485, '', 'Curitiba', 'aprovado', -25.49656150, -49.27335040),
(36, 18, 'Reeecicle', 'Rua da Aurora', 'Pernambuco', 'Boa Vista', '', '2025-05-04 18:41:55', 50050, 500, '', 'Recife', 'aprovado', -8.05962370, -34.88007970),
(37, 18, 'Rapidosucata', 'Estrada do Pêssego', 'São Paulo', 'Colônia (Zona Leste)', '', '2025-05-04 18:43:01', 8260, 1000, '', 'São Paulo', 'aprovado', NULL, NULL),
(38, 18, 'E-lixo RJ – Vigário Geral', 'Rua Isidro Rocha', 'Rio de Janeiro', 'Vigário Geral', 'Não realizam coletas em residências.', '2025-05-04 19:00:05', 21241, 70, '', 'Rio de Janeiro', 'aprovado', -22.81011540, -43.31305360),
(39, 18, 'Green Eletron', 'Estrada da Água Branca', 'Rio de Janeiro', 'Magalhães Bastos', 'Coleta em casa: Disponível mediante solicitação.', '2025-05-04 19:01:53', 21735, 1160, '', 'Rio de Janeiro', 'aprovado', -22.86875390, -43.41935400),
(40, 18, 'Green Eletron', 'Rua Rafael de Almeida Ribeiro', 'Maranhão', 'São Salvador', 'Coleta em casa: Disponível mediante solicitação.', '2025-05-04 19:02:13', 65916, 600, '', 'Imperatriz', 'aprovado', NULL, NULL),
(41, 18, 'Green Eletron', 'Avenida Santos Dumont', 'Bahia', 'Buraquinho', 'Coleta em casa: Disponível mediante solicitação.', '2025-05-04 19:03:55', 42710, 7552, '', 'Lauro de Freitas', 'aprovado', NULL, NULL),
(42, 18, 'Green Eletron', 'Rua Otto Pfuetzenreuter', 'Santa Catarina', 'Costa e Silva', 'Coleta em casa: Disponível mediante solicitação.', '2025-05-04 19:04:32', 89219, 59, '', 'Joinville', 'aprovado', -26.27308580, -48.87192890),
(43, 18, 'Green Eletron', 'Rua Rosa Kasinski', 'São Paulo', 'Capuava', 'Coleta em casa: Disponível mediante solicitação.', '2025-05-04 19:05:02', 9380, 1109, '', 'Mauá', 'aprovado', NULL, NULL),
(44, 18, 'Green Eletron', 'Rua José de Alencar', 'Minas Gerais', 'São Benedito', 'Coleta em casa: Disponível mediante solicitação.', '2025-05-04 19:05:34', 38022, 157, '', 'Uberaba', 'aprovado', -19.75737790, -47.93609730),
(45, 18, 'Real Grandeza – Botafogo', 'Rua Mena Barreto', 'Rio de Janeiro', 'Botafogo', 'Possui ponto de arrecadação de lixo eletrônico na entrada do edifício-sede.', '2025-05-04 19:06:29', 22271, 143, '', 'Rio de Janeiro', 'aprovado', -22.95612810, -43.19067010),
(46, 18, 'Central Log', 'Rua Edmundo Júnior', 'Rio de Janeiro', 'Parque Colúmbia', 'Oferece coleta gratuita para empresas e pessoas físicas.', '2025-05-04 19:07:11', 21535, 289, '', 'Rio de Janeiro', 'aprovado', -22.81569290, -43.34011070);

-- --------------------------------------------------------

--
-- Estrutura para tabela `tokens_recuperacao`
--

CREATE TABLE `tokens_recuperacao` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `expiracao` datetime NOT NULL,
  `usado` tinyint(1) DEFAULT 0,
  `criado_em` timestamp NOT NULL DEFAULT current_timestamp(),
  `usuario_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `tokens_recuperacao`
--

INSERT INTO `tokens_recuperacao` (`id`, `email`, `token`, `expiracao`, `usado`, `criado_em`, `usuario_id`) VALUES
(27, 'alessandracris393@gmail.com', 'fb72e82b3cdec5b4a70fb9d4085e0cb3e610bff8d6ea532ab9a9bb14dd9190b8', '2025-05-04 03:54:46', 1, '2025-05-04 00:54:46', 18),
(28, 'carlaaafsilva@gmail.com', 'cf397c4e3b4bd4ef62c7a74cf7f839b3917716cd1dcef243c86fbe3d6c3d4f72', '2025-05-04 17:23:07', 0, '2025-05-04 14:23:07', 20),
(29, 'alessandracris393@gmail.com', 'e0c380e72984336bbf158d24f03450b84e3b9d742822ec97ede06375daa7fb7f', '2025-05-04 17:24:45', 1, '2025-05-04 14:24:45', 18),
(30, 'alessandracris393@gmail.com', 'b78b3014ab520019975c4c04434b92b10d71269afbc3ca0cfa3ed5b105f52e92', '2025-05-06 02:21:10', 1, '2025-05-05 23:21:10', 18);

-- --------------------------------------------------------

--
-- Estrutura para tabela `usuario`
--

CREATE TABLE `usuario` (
  `id` int(11) NOT NULL,
  `nome` varchar(80) NOT NULL,
  `email` varchar(50) NOT NULL,
  `cpf` varchar(14) NOT NULL,
  `login` varchar(50) NOT NULL,
  `senha` varchar(100) NOT NULL,
  `endereco` varchar(80) NOT NULL,
  `cidade` varchar(80) NOT NULL,
  `bairro` varchar(80) NOT NULL,
  `cep` int(10) NOT NULL,
  `numero` int(11) NOT NULL,
  `complemento` varchar(50) DEFAULT NULL,
  `telefone` int(16) NOT NULL,
  `nascimento` date NOT NULL,
  `criado_em` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `usuario`
--

INSERT INTO `usuario` (`id`, `nome`, `email`, `cpf`, `login`, `senha`, `endereco`, `cidade`, `bairro`, `cep`, `numero`, `complemento`, `telefone`, `nascimento`, `criado_em`) VALUES
(5, 'Jake Peralta e Amy Santiago', 'alessandra@gmail.com', '981.793.470-52', 'pesant', '$2y$10$KMp0uwpnhtr4J8209hcZzOyW79U3mJ12kAUsSpk.Xsol9n0dQOXuK', 'Rua Castro Alves', 'Rio de Janeiro', 'Méier', 20775, 158, 'Casa 08', 0, '2005-07-07', '2025-04-24 00:28:41'),
(6, 'Laika Cristina da Silva Pereira', 'laika54@gmail.com', '137.892.137-21', 'laika_', '$2y$10$jlhNDRmeA2Gav0.MiTPgZe/ZvmugD85NDoayqgozBXUx9bBgWCYNS', 'Rua Castro Alves', 'Rio de Janeiro', 'Méier', 20775, 158, 'Casa 08', 0, '2004-01-01', '2025-04-24 00:46:22'),
(7, 'Alessandra Cristina da Silva', 'alesilva@gmail.com', '481.737.900-60', 'ale_si', '$2y$10$pOmN4aYURumAIjiJXWNuout.OH0hFLINHz7bAMXCWbL22ffKf9/5y', 'Rua Castro Alves', 'Rio de Janeiro', 'Méier', 20775, 158, 'Casa 08', 0, '2004-07-07', '2025-04-25 02:30:51'),
(8, 'Camilly Cristina da Silva Pereira', 'teste@gmail.com', '125.447.610-59', 'milly_', '$2y$10$7taUV57x0.b4C/4dKVWwXOMfDZzvF6TMqG/OAuOOgK3yez0rqohBq', 'Rua Castro Alves', 'Rio de Janeiro', 'Méier', 20775, 158, '12', 0, '2004-07-07', '2025-04-25 02:48:19'),
(11, 'Alessandra Pereira Dias1', 'alesilva@teste.com', '994.776.010-39', 'Ale_silva', '$2y$10$l/DvZXSMkYvA6ZFrciiw4u3372GgzCVVL0o8r3YQksOoUJlCiYVr.', 'Rua Castro Alves', 'Rio de Janeiro', 'Méier', 20775, 126, '301', 0, '2004-07-07', '2025-05-03 02:02:17'),
(13, 'Larissa G Lima Dias', 'larissagld@gmail.com', '138.968.237-44', 'Lari_Dias', '$2y$10$by8b9e5eUHfBGSOWy9UU5ebQDZvLeEbeJyLIAnWvY9FsB6n.eHURi', 'Rua Castro Alves', 'Rio de Janeiro', 'Méier', 20775, 126, '08', 0, '2004-07-07', '2025-05-03 02:18:16'),
(18, 'Alessandra Pereira Dias', 'alessandracris393@gmail.com', '480.074.190-47', 'Ale_dias', '$2y$10$upV4LQsIA9pK9BtkCPRwlOUtUK0Z9t0/0Nivinv1WwgQdNF1Bu9RC', '', '', '', 20775, 145, '04', 0, '2004-07-07', '2025-05-03 19:56:46'),
(20, 'Carla Ferreira da Silva', 'carlaaafsilva@gmail.com', '813.017.700-51', 'Carla_sil', '$2y$10$SE5fV.uNDwWjpr9dEHAbqezRClCGGg4BFYVxfx7Oj2IK9X3vOlMsm', 'Rua Castro Alves', 'Rio de Janeiro', 'Méier', 20775, 126, '', 0, '2004-07-07', '2025-05-04 14:22:10');

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `pontos_coleta`
--
ALTER TABLE `pontos_coleta`
  ADD PRIMARY KEY (`id`),
  ADD KEY `usuario_id` (`usuario_id`);

--
-- Índices de tabela `tokens_recuperacao`
--
ALTER TABLE `tokens_recuperacao`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `token` (`token`),
  ADD KEY `email` (`email`),
  ADD KEY `expiracao` (`expiracao`),
  ADD KEY `fk_usuario_token` (`usuario_id`);

--
-- Índices de tabela `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `cpf_unico` (`cpf`),
  ADD UNIQUE KEY `cpf` (`cpf`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `pontos_coleta`
--
ALTER TABLE `pontos_coleta`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT de tabela `tokens_recuperacao`
--
ALTER TABLE `tokens_recuperacao`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT de tabela `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `pontos_coleta`
--
ALTER TABLE `pontos_coleta`
  ADD CONSTRAINT `pontos_coleta_ibfk_1` FOREIGN KEY (`usuario_id`) REFERENCES `usuario` (`id`) ON DELETE CASCADE;

--
-- Restrições para tabelas `tokens_recuperacao`
--
ALTER TABLE `tokens_recuperacao`
  ADD CONSTRAINT `fk_usuario_token` FOREIGN KEY (`usuario_id`) REFERENCES `usuario` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;