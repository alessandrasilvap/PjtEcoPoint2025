-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 18/06/2025 às 02:07
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
-- Estrutura para tabela `alternativas`
--

CREATE TABLE `alternativas` (
  `id` int(11) NOT NULL,
  `pergunta_id` int(11) DEFAULT NULL,
  `texto` varchar(255) NOT NULL,
  `correta` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `alternativas`
--

INSERT INTO `alternativas` (`id`, `pergunta_id`, `texto`, `correta`) VALUES
(1, 1, 'É o reaproveitamento de lixo orgânico', 0),
(2, 1, 'É a coleta seletiva de embalagens de papel', 0),
(3, 1, 'É o descarte correto de equipamentos eletrônicos para reaproveitamento de materiais', 1),
(4, 1, 'É descartar lixo eletrônico no lixo comum', 0),
(5, 2, 'Plástico, vidro e madeira', 0),
(6, 2, 'Chumbo, mercúrio e cádmio', 1),
(7, 2, 'Cobre, alumínio e ferro', 0),
(8, 2, 'Estanho, prata e ouro', 0),
(9, 3, 'Monitores', 0),
(10, 3, 'Computadores', 0),
(11, 3, 'Televisores', 0),
(12, 3, 'Telefones celulares', 1),
(13, 4, 'Índia', 0),
(14, 4, 'Estados Unidos', 0),
(15, 4, 'China', 1),
(16, 4, 'Japão', 0),
(17, 5, 'Separação magnética', 1),
(18, 5, 'Fusão', 0),
(19, 5, 'Eletrolise', 0),
(20, 5, 'Extração química', 0),
(21, 6, 'Islândia e Suéci', 1),
(22, 6, 'China e EUA', 0),
(23, 6, 'Brasil e Japão', 0),
(24, 6, 'Canadá e Austrália', 0),
(25, 7, 'Melhora a eficiência energética', 0),
(26, 7, 'Reduz a necessidade de mão de obra', 0),
(27, 7, 'Aumenta a automação', 0),
(28, 7, 'Gera empregos em diversas áreas', 1),
(29, 8, 'Aquecimento global', 0),
(30, 8, 'Contaminação do solo e da água', 1),
(31, 8, 'Alteração do ciclo de nutrientes', 0),
(32, 8, 'Perda de biodiversidade', 0),
(33, 9, 'Reduz o custo de produção de novos aparelhos para as empresas', 0),
(34, 9, 'Economiza energia e recursos naturais, além de prolongar a vida útil do produto\n', 1),
(35, 9, 'Aumenta a demanda por novos produtos, estimulando a economia', 0),
(36, 9, 'Elimina completamente a necessidade de reciclagem de eletrônicos', 0),
(37, 10, 'Joga-lo no lixo comum, já que não serve mais para você', 0),
(38, 10, 'Deixar ele guardado em uma gaveta por tempo indeterminado', 0),
(39, 10, 'Desmontá-lo em casa para tentar aproveitar algumas peças', 0),
(40, 10, 'Doá-lo, vendê-lo ou entregá-lo em um ponto de coleta de eletrônicos para reuso', 1),
(41, 11, 'Lixo comum', 0),
(42, 11, 'Entregar em pontos de coleta específicos', 1),
(43, 11, 'Lixo orgânico', 0),
(44, 11, 'Jogar no ralo', 0),
(45, 12, 'Ignorar, não é problema seu', 0),
(46, 12, 'Pegar o eletrônico e jogar em outro lugar', 0),
(47, 12, 'Apenas comentar com amigos', 0),
(48, 12, 'Chamar a atenção da pessoa e explicar o descarte correto', 1),
(49, 13, 'Aumento do consumo de energia nas casas', 0),
(50, 13, 'Contaminação do solo e da água por metais pesados', 1),
(51, 13, 'Crescimento de novas florestas', 0),
(52, 13, 'Diminuição da vida útil de outros lixos', 0),
(53, 14, 'Eletrônicos que são desenvolvidos para ter vida útil curta', 1),
(54, 14, 'Produtos que são feitos para durar muito tempo', 0),
(55, 14, 'A prática de programar o software de um aparelho para durar mais', 0),
(56, 14, 'Aumento na durabilidade dos eletrônicos', 0),
(57, 15, 'Usá-lo constantemente até quebrar', 0),
(58, 15, 'Comprar sempre o modelo mais novo', 0),
(59, 15, 'Desmontá-lo para limpeza interna regularmente', 0),
(60, 15, 'Fazer manutenção preventiva e usá-lo com cuidado', 1),
(61, 16, 'A cor do produto', 0),
(62, 16, 'Se ele é feito com materiais reciclados ou possui certificações ambientais', 1),
(63, 16, 'A marca mais cara disponível', 0),
(64, 16, 'Se a embalagem é grande e bonita', 0);

-- --------------------------------------------------------

--
-- Estrutura para tabela `perguntas`
--

CREATE TABLE `perguntas` (
  `id` int(11) NOT NULL,
  `texto` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `perguntas`
--

INSERT INTO `perguntas` (`id`, `texto`) VALUES
(1, 'O que é reciclagem eletrônica?'),
(2, 'Quais são os principais componentes tóxicos encontrados em equipamentos eletrônicos?'),
(3, 'Qual é o tipo de resíduo eletrônico mais comum?'),
(4, 'Qual é o país com a maior quantidade de resíduos eletrônicos no mundo?'),
(5, 'Qual é o processo mais comum utilizado para reciclar metais pesados em equipamentos eletrônicos?'),
(6, 'Quais são os dois países que mais reciclam lixo eletrônico?'),
(7, 'Qual é o benefício da reciclagem eletrônica em relação à criação de empregos?'),
(8, 'Qual é o impacto ambiental do descarte inadequado de pilhas e baterias?'),
(9, 'Quais são os principais benefícios de reutilizar equipamentos eletrônicos (em vez de apenas reciclar), como doar um smartphone antigo?'),
(10, 'Você tem um celular antigo que ainda funciona, mas você comprou um novo. Qual a melhor ação para o celular antigo?'),
(11, 'O que fazer com pilhas e baterias usadas?'),
(12, 'Você viu alguém jogando um eletrônico velho na lixeira comum. O que fazer?'),
(13, 'Descartar lixo eletrônico no aterro sanitário causa principalmente qual problema?'),
(14, 'O que significa a \"obsolescência programada\"?'),
(15, 'Qual a melhor forma de prolongar a vida útil de um eletrônico?'),
(16, 'Ao comprar um eletrônico novo, qual fator ambiental é importante considerar?');

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
(1, 5, 'RETIPEL ', 'Rua Leandro Martins', 'Rio de Janeiro', 'Centro', 'Recebe e retira de acordo com o volume', '2025-05-04 23:45:45', 20080, 51, '', 'Rio de Janeiro', 'aprovado', -22.90116020, -43.18414110),
(2, 5, 'SABOR SAÚDE', 'Rua da Quitanda', 'Rio de Janeiro', 'Centro', 'Apenas recebe.', '2025-05-04 23:50:09', 20011, 21, '', 'Rio de Janeiro', 'aprovado', -22.90470390, -43.17639650),
(5, 5, 'SPOLETO URUGUAIANA', 'Rua Buenos Aires', 'Rio de Janeiro', 'Centro', '', '2025-05-04 23:56:27', 20061, 249, '', 'Rio de Janeiro', 'aprovado', -22.90513640, -43.18469550),
(6, 5, 'Colégio EDEM', 'Rua Gago Coutinho', 'Rio de Janeiro', 'Laranjeiras', '', '2025-05-04 23:59:59', 22221, 14, '', 'Rio de Janeiro', 'aprovado', -22.93126270, -43.18096420),
(8, 5, 'Loja Ahlma', 'Rua Carlos Gois', 'Rio de Janeiro', 'Leblon', 'Apenas recebe.', '2025-05-05 00:04:49', 22440, 208, '', 'Rio de Janeiro', 'aprovado', -22.98423560, -43.21987310),
(9, 5, 'Clube de Regatas Flamengo', 'Avenida Borges de Medeiros', 'Rio de Janeiro', 'Leblon', 'Apenas recebe.', '2025-05-05 00:05:55', 22430, 997, '', 'Rio de Janeiro', 'aprovado', -22.98432690, -43.21593270),
(10, 5, 'Shopping Rio Design Leblon', 'Avenida Ataulfo de Paiva', 'Rio de Janeiro', 'Leblon', 'Apenas recebe.', '2025-05-05 00:07:44', 22440, 270, '2º andar', 'Rio de Janeiro', 'aprovado', -22.98367300, -43.21695900),
(11, 5, 'T.T. Burguer', 'Avenida Ataulfo de Paiva', 'Rio de Janeiro', 'Leblon', 'Apenas recebe.', '2025-05-05 00:08:52', 22440, 1240, '', 'Rio de Janeiro', 'aprovado', -22.98595700, -43.22737300),
(12, 5, 'NEX COWORKING', 'Ladeira da Glória', 'Rio de Janeiro', 'Glória', 'Apenas recebe.', '2025-05-05 00:10:23', 22211, 26, 'Bloco 3', 'Rio de Janeiro', 'aprovado', -22.92201600, -43.17527430),
(13, 5, 'UNIRIO', 'Rua Voluntários da Pátria', 'Rio de Janeiro', 'Botafogo', '', '2025-05-05 00:11:40', 22270, 107, '', 'Rio de Janeiro', 'aprovado', -22.95206330, -43.18477470),
(14, 5, 'REDE ASTA', 'Rua Gago Coutinho', 'Rio de Janeiro', 'Laranjeiras', '', '2025-05-05 00:13:06', 22221, 66, 'Loja A', 'Rio de Janeiro', 'aprovado', -22.93142760, -43.18208630),
(15, 5, 'COOPAMA', 'Rua Miguel Ângelo', 'Rio de Janeiro', 'Posse', 'Recebe e coleta.', '2025-05-05 00:14:32', 25973, 385, '', 'Teresópolis', 'aprovado', -22.37218620, -42.99113300),
(16, 5, 'ACMR', 'Rua Itaigara', 'Rio de Janeiro', 'Coelho Neto', '', '2025-05-05 00:15:11', 21510, 77, '', 'Rio de Janeiro', 'aprovado', -22.83417490, -43.34902380),
(17, 5, 'COOPCAL', 'Avenida Itaóca', 'Rio de Janeiro', 'Inhaúma', '', '2025-05-05 00:15:59', 21061, 2353, '', 'Rio de Janeiro', 'aprovado', -22.87220010, -43.27692950),
(18, 5, 'COOPGALEÃO', 'Rua Macedo Costa', 'Rio de Janeiro', 'Inhaúma', '', '2025-05-05 00:16:44', 20765, 62, '', 'Rio de Janeiro', 'aprovado', -22.87367880, -43.28066670),
(19, 5, 'Maraca Hostel', 'Rua Ribeiro Guimarães', 'Rio de Janeiro', 'Vila Isabel', 'Apenas recebe.', '2025-05-05 00:17:24', 20541, 367, '', 'Rio de Janeiro', 'aprovado', -22.91947980, -43.23713910),
(20, 5, 'One On One Coworking', 'Rua Nossa Senhora de Lourdes', 'Rio de Janeiro', 'Grajaú', 'Apenas recebe.', '2025-05-05 00:18:20', 20540, 101, '', 'Rio de Janeiro', 'aprovado', -22.92110210, -43.25466060),
(21, 5, 'IJOKER no Shopping Bayside', 'Avenida das Américas', 'Rio de Janeiro', 'Barra da Tijuca', 'Apenas recebe.', '2025-05-05 00:20:47', 22640, 3120, 'loja 213', 'Rio de Janeiro', 'aprovado', -22.99940580, -43.34383850),
(22, 5, 'Shopping Rio Design Barra', 'Avenida das Américas', 'Rio de Janeiro', 'Barra da Tijuca', 'Apenas recebe.', '2025-05-05 00:21:33', 22793, 7777, '', 'Rio de Janeiro', 'aprovado', -23.00137360, -43.38588680),
(23, 5, 'ASSOCIAÇÃO BOSQUE MARAPENDI', 'Avenida Prefeito Dulcídio Cardoso', 'Rio de Janeiro', 'Barra da Tijuca', 'Apenas recebe.', '2025-05-05 00:22:16', 22620, 1250, '', 'Rio de Janeiro', 'aprovado', -23.00630520, -43.38880820),
(24, 5, 'T.T. BURGUER', 'Avenida Prefeito Dulcídio Cardoso', 'Rio de Janeiro', 'Barra da Tijuca', 'Apenas recebe.', '2025-05-05 00:22:58', 22621, 460, '', 'Rio de Janeiro', 'aprovado', -23.00785090, -43.41646440),
(26, 5, 'ESTACIONAMENTO TERREIRÃO', 'Avenida Guiomar Novais', 'Rio de Janeiro', 'Recreio dos Bandeirantes', 'Apenas recebe.', '2025-05-05 00:23:38', 22795, 400, '', 'Rio de Janeiro', 'aprovado', NULL, NULL),
(27, 5, 'Ecoponto Espaço Convivência Sustentável - INEA', 'Avenida Borges de Medeiros', 'Rio de Janeiro', 'Lagoa', 'Apenas recebe.', '2025-05-16 02:24:53', 22430, 1444, '', 'Rio de Janeiro', 'aprovado', -22.97072200, -43.21927000),
(28, 5, 'Paróquia São José', 'Avenida Borges de Medeiros', 'Rio de Janeiro', 'Lagoa', 'Apenas recebe.', '2025-05-16 02:24:53', 22470, 2735, '', 'Rio de Janeiro', 'aprovado', -22.97072200, -43.21927000),
(29, 5, '15º Ofício de Notas - Unidade Barra da Tijuca', 'Avenida das Américas', 'Rio de Janeiro', 'Barra da Tijuca', 'Apenas recebe.', '2025-05-16 02:24:53', 22640, 500, 'Bloco 11, Loja 106', 'Rio de Janeiro', 'aprovado', -23.00300000, -43.36500000),
(30, 5, 'Ecoponto Horto Municipal Carlos Guinle', 'Avenida Tobias Barreto', 'Rio de Janeiro', 'Quarenta Casas', 'Apenas recebe.', '2025-05-16 02:24:53', 25973, 21, '', 'Teresópolis', 'aprovado', -22.41670000, -42.97500000),
(31, 5, 'SESC Teresópolis', 'Avenida Delfim Moreira', 'Rio de Janeiro', 'Várzea', 'Apenas recebe.', '2025-05-16 02:24:53', 25963, 749, '', 'Teresópolis', 'aprovado', -22.41750000, -42.97500000),
(32, 5, 'COOPAMA', 'Rua Miguel Ângelo', 'Rio de Janeiro', 'Posse', 'Recebe e coleta.', '2025-05-05 00:14:32', 25973, 385, '', 'Teresópolis', 'aprovado', -22.37218620, -42.99113300),
(33, 5, 'SESC Teresópolis', 'Avenida Delfim Moreira', 'Rio de Janeiro', 'Várzea', 'Apenas recebe.', '2025-05-16 02:24:53', 25963, 749, '', 'Teresópolis', 'aprovado', -22.41750000, -42.97500000),
(34, 5, 'Ecoponto Horto Municipal Carlos Guinle', 'Avenida Tobias Barreto', 'Rio de Janeiro', 'Quarenta Casas', 'Apenas recebe.', '2025-05-16 02:24:53', 25973, 21, '', 'Teresópolis', 'aprovado', -22.41670000, -42.97500000),
(35, 5, 'Ponto de Coleta Centro Ambiental', 'Rua São Sebastião', 'Minas Gerais', 'Centro', 'Recebe resíduos recicláveis.', '2025-05-16 02:25:53', 30140, 123, '', 'Belo Horizonte', 'aprovado', -19.92083000, -43.93777800),
(36, 5, 'Reciclagem MG', 'Avenida Amazonas', 'Minas Gerais', 'Centro', 'Recebe papel, plástico e vidro.', '2025-05-16 02:26:15', 30180, 456, 'Sala 5', 'Belo Horizonte', 'aprovado', -19.92450000, -43.93830000),
(37, 5, 'Ponto Verde', 'Rua XV de Novembro', 'São Paulo', 'Centro', 'Recebe apenas vidros.', '2025-05-16 02:26:50', 1001, 789, '', 'São Paulo', 'aprovado', -23.55052000, -46.63330800),
(38, 5, 'Coleta Seletiva SP', 'Avenida Paulista', 'São Paulo', 'Bela Vista', 'Recebe papel, plástico, metal.', '2025-05-16 02:27:20', 1311, 1000, 'Loja 10', 'São Paulo', 'aprovado', -23.56141400, -46.65588100),
(39, 5, 'Centro de Reciclagem Brasília', 'Setor Comercial Sul', 'Distrito Federal', 'Centro', 'Recebe todos os tipos de material reciclável.', '2025-05-16 02:35:00', 70070, 500, '', 'Brasília', 'aprovado', -15.79388900, -47.88277800),
(40, 5, 'Ponto Verde Curitiba', 'Rua XV de Novembro', 'Paraná', 'Centro', 'Recebe papel e plástico.', '2025-05-16 02:36:10', 80020, 1100, '', 'Curitiba', 'aprovado', -25.42895400, -49.26713700),
(41, 5, 'EcoPonto Porto Alegre', 'Avenida Borges de Medeiros', 'Rio Grande do Sul', 'Centro', 'Recebe vidro e metal.', '2025-05-16 02:37:20', 90020, 250, '', 'Porto Alegre', 'aprovado', -30.03464700, -51.21765800),
(42, 5, 'Coleta Reciclável Salvador', 'Avenida Sete de Setembro', 'Bahia', 'Centro', 'Apenas recebe plástico.', '2025-05-16 02:38:15', 40020, 700, '', 'Salvador', 'aprovado', -12.97139900, -38.50130500),
(43, 5, 'Reciclagem Fortaleza', 'Rua Major Facundo', 'Ceará', 'Centro', 'Recebe papel e vidro.', '2025-05-16 02:39:00', 60020, 890, '', 'Fortaleza', 'aprovado', -3.71722000, -38.54337000),
(44, 5, 'EcoPonto Manaus', 'Avenida Djalma Batista', 'Amazonas', 'Centro', 'Recebe papel, plástico e metal.', '2025-05-16 02:40:00', 69020, 1200, '', 'Manaus', 'aprovado', -3.11902800, -60.02173100),
(45, 5, 'Ponto de Coleta Recife', 'Rua do Bom Jesus', 'Pernambuco', 'Recife Antigo', 'Recebe todos os materiais recicláveis.', '2025-05-16 02:41:00', 50030, 320, '', 'Recife', 'aprovado', -8.04756200, -34.87700300),
(46, 5, 'Coleta Seletiva Belém', 'Avenida Almirante Barroso', 'Pará', 'Marco', 'Apenas recebe plástico.', '2025-05-16 02:42:00', 66020, 600, '', 'Belém', 'aprovado', -1.45583300, -48.49017900),
(47, 21, 'Shopping Nova América', 'Avenida Pastor Martin Luther King Jr', 'Rio de Janeiro', 'Del Castilho', 'No primeiro andar, atrás da praça de alimentação.\r\n\r\nApenas recebe.', '2025-05-13 02:45:53', 20765, 126, 'Shopping', 'Rio de Janeiro', 'aprovado', -22.87782434, -43.27150826);

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
(28, 'carlaaafsilva@gmail.com', 'cf397c4e3b4bd4ef62c7a74cf7f839b3917716cd1dcef243c86fbe3d6c3d4f72', '2025-05-04 17:23:07', 0, '2025-05-04 14:23:07', 20),
(32, 'fc.alissa13@gmail.com', '4f9f9f49454f5e59c6bd02a654f347dd5373ec41e028a53b836511d4698d08fc', '2025-05-13 05:31:20', 0, '2025-05-13 02:31:20', 21),
(34, 'larissagld@gmail.com', '427437a31e777469e35888c1ff52d9d5c2e596be11730b5ac9920f411da62802', '2025-05-16 01:33:24', 0, '2025-05-15 22:33:24', 13),
(35, 'larissagld@gmail.com', '2c336ea40a17a9448fe7c305202dcc50f24dc702889325afa590541600ebcb53', '2025-05-16 01:33:35', 0, '2025-05-15 22:33:35', 13);

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
(20, 'Carla Ferreira da Silva', 'carlaaafsilva@gmail.com', '813.017.700-51', 'Carla_sil', '$2y$10$SE5fV.uNDwWjpr9dEHAbqezRClCGGg4BFYVxfx7Oj2IK9X3vOlMsm', 'Rua Castro Alves', 'Rio de Janeiro', 'Méier', 20775, 126, '', 0, '2004-07-07', '2025-05-04 14:22:10'),
(21, 'Alissa Gabriela Cristina Pereira Dias', 'fcalissa13@gmail.com', '150.641.380-32', 'ali_dia', '$2y$10$b1u0Q1TwIjaDuYP1mAsRUOPKMLED5oLNJK1K3kFDLiTbqoJx28dh6', 'Rua Castro Alves', 'Rio de Janeiro', 'Méier', 20775, 164, 'Sem', 0, '2000-05-12', '2025-05-13 02:28:51'),
(22, 'Alessandra Cristina da Silva Pereira', 'alessandracris393@gmail.com', '275.069.120-66', 'ale_pe', '$2y$10$xmywUw7ixexC9jE5.cTKeOhxo0YASFkbaLeuBDjKCRDnvH76c/cwy', 'Rua Castro Alves', 'Rio de Janeiro', 'Méier', 20775, 158, 'Casa 08', 0, '2004-07-07', '2025-05-16 02:00:42');

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `alternativas`
--
ALTER TABLE `alternativas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pergunta_id` (`pergunta_id`);

--
-- Índices de tabela `perguntas`
--
ALTER TABLE `perguntas`
  ADD PRIMARY KEY (`id`);

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
-- AUTO_INCREMENT de tabela `alternativas`
--
ALTER TABLE `alternativas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;

--
-- AUTO_INCREMENT de tabela `perguntas`
--
ALTER TABLE `perguntas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de tabela `pontos_coleta`
--
ALTER TABLE `pontos_coleta`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT de tabela `tokens_recuperacao`
--
ALTER TABLE `tokens_recuperacao`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT de tabela `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `alternativas`
--
ALTER TABLE `alternativas`
  ADD CONSTRAINT `alternativas_ibfk_1` FOREIGN KEY (`pergunta_id`) REFERENCES `perguntas` (`id`) ON DELETE CASCADE;

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
