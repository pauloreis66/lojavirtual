-- phpMyAdmin SQL Dump
-- version 4.8.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 07-Maio-2018 às 21:09
-- Versão do servidor: 10.1.31-MariaDB
-- PHP Version: 7.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `lojinha`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `artigos`
--

CREATE TABLE `artigos` (
  `id_artigo` tinyint(4) NOT NULL,
  `id_categoria` tinyint(4) NOT NULL,
  `nome_artigo` varchar(30) NOT NULL,
  `descricao_artigo` varchar(255) NOT NULL,
  `preco_artigo` double(5,2) DEFAULT NULL,
  `stock_artigo` tinyint(4) DEFAULT NULL,
  `imagem_artigo` varchar(255) DEFAULT NULL,
  `promocao` enum('S','N') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `artigos`
--

INSERT INTO `artigos` (`id_artigo`, `id_categoria`, `nome_artigo`, `descricao_artigo`, `preco_artigo`, `stock_artigo`, `imagem_artigo`, `promocao`) VALUES
(1, 2, 'Computador Stilo', 'Computador Stilo DS3515 Celeron Windows 10 Home 15.6', 379.40, 5, 'computador02.jpg', 'S'),
(2, 1, 'Monitor Amazon', 'Monitor 24Â´Â´ Led Aoc Gamer-75Hz-1Ms-Multimidia-Full Hd', 592.82, 3, 'monitor01.jpg', 'S'),
(3, 2, 'Galaxy Tab A', 'Tablet Samsung Galaxy Tab A Note SM-P585M 10.1\' 4G 16GB Preto', 322.49, 10, 'tablet01.jpg', 'S'),
(4, 2, 'iPad Apple', 'Tablet Apple iPad 9.7 4G 128 GB', 426.83, 2, 'tablet02.jpg', 'S'),
(5, 2, 'Disco Externo', 'Case Externa para HD SATA 2.5', 30.59, 2, 'discoexterno01.jpg', 'S'),
(6, 4, 'Surround System', 'VIZIO 42â€ 5.1 Home Theater Sound', 200.00, 1, 'surround01.jpg', 'S');

-- --------------------------------------------------------

--
-- Estrutura da tabela `categorias`
--

CREATE TABLE `categorias` (
  `id_categoria` tinyint(4) NOT NULL,
  `nome_categoria` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `categorias`
--

INSERT INTO `categorias` (`id_categoria`, `nome_categoria`) VALUES
(1, 'Ãudio e VÃ­deo'),
(2, 'Computadores'),
(3, 'Filmes'),
(4, 'Imagem e Som'),
(5, 'Livros'),
(6, 'MÃºsica'),
(7, 'Software');

-- --------------------------------------------------------

--
-- Estrutura da tabela `clientes`
--

CREATE TABLE `clientes` (
  `id_cliente` int(10) UNSIGNED NOT NULL,
  `nome_login` varchar(12) NOT NULL,
  `palavra_passe` varchar(8) NOT NULL,
  `primeiro_nome` varchar(20) NOT NULL,
  `apelido` varchar(20) NOT NULL,
  `endereco` varchar(50) NOT NULL,
  `localidade` varchar(20) NOT NULL,
  `codigo_postal` varchar(8) NOT NULL,
  `telefone` int(9) NOT NULL,
  `email` varchar(50) NOT NULL,
  `nivel_utilizador` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `clientes`
--

INSERT INTO `clientes` (`id_cliente`, `nome_login`, `palavra_passe`, `primeiro_nome`, `apelido`, `endereco`, `localidade`, `codigo_postal`, `telefone`, `email`, `nivel_utilizador`) VALUES
(1, 'admin', '123', 'Administrador', 'Administrador', 'Rua da Loja', 'Cidadela', '2000', 123456789, 'admin@nowhere.com', 1),
(2, 'preis', '123', 'Paulo', 'Reis', 'Rua B', 'Batalha', '2490', 987654321, 'preis@nowhere.pt', 2);

-- --------------------------------------------------------

--
-- Estrutura da tabela `compra_confirmada`
--

CREATE TABLE `compra_confirmada` (
  `id_compra` int(5) UNSIGNED NOT NULL,
  `data_compra` datetime NOT NULL,
  `id_cliente` int(10) UNSIGNED NOT NULL,
  `total_pagar` decimal(5,2) NOT NULL,
  `estado_compra` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `compra_confirmada`
--

INSERT INTO `compra_confirmada` (`id_compra`, `data_compra`, `id_cliente`, `total_pagar`, `estado_compra`) VALUES
(1, '2018-05-07 19:43:00', 2, '701.89', 0),
(2, '2018-05-07 19:44:03', 0, '0.00', 0),
(3, '2018-05-07 19:44:59', 2, '853.66', 0),
(4, '2018-05-07 19:47:03', 2, '853.66', 0);

-- --------------------------------------------------------

--
-- Estrutura da tabela `compra_temporaria`
--

CREATE TABLE `compra_temporaria` (
  `sessao` char(50) NOT NULL,
  `id_artigo` tinyint(4) NOT NULL,
  `quantidade` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `compra_temporaria`
--

INSERT INTO `compra_temporaria` (`sessao`, `id_artigo`, `quantidade`) VALUES
('7v8schh7r5o5asqo9lf067n91j', 4, 1),
('7v8schh7r5o5asqo9lf067n91j', 6, 1),
('9s5cq961fjddav9hd23sdls5mq', 3, 1),
('g1ehruheskfqhahcqdt3pk17g8', 5, 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `detalhes_compra`
--

CREATE TABLE `detalhes_compra` (
  `id_compra` int(5) UNSIGNED NOT NULL,
  `quantidade_compra` int(10) UNSIGNED NOT NULL,
  `id_artigo` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `detalhes_compra`
--

INSERT INTO `detalhes_compra` (`id_compra`, `quantidade_compra`, `id_artigo`) VALUES
(4, 2, 4);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `artigos`
--
ALTER TABLE `artigos`
  ADD PRIMARY KEY (`id_artigo`),
  ADD KEY `id_categoria` (`id_categoria`);

--
-- Indexes for table `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`id_categoria`);

--
-- Indexes for table `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`id_cliente`);

--
-- Indexes for table `compra_confirmada`
--
ALTER TABLE `compra_confirmada`
  ADD PRIMARY KEY (`id_compra`,`id_cliente`);

--
-- Indexes for table `compra_temporaria`
--
ALTER TABLE `compra_temporaria`
  ADD PRIMARY KEY (`sessao`,`id_artigo`);

--
-- Indexes for table `detalhes_compra`
--
ALTER TABLE `detalhes_compra`
  ADD KEY `id_compra` (`id_compra`),
  ADD KEY `id_artigo` (`id_artigo`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `artigos`
--
ALTER TABLE `artigos`
  MODIFY `id_artigo` tinyint(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `categorias`
--
ALTER TABLE `categorias`
  MODIFY `id_categoria` tinyint(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `clientes`
--
ALTER TABLE `clientes`
  MODIFY `id_cliente` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `compra_confirmada`
--
ALTER TABLE `compra_confirmada`
  MODIFY `id_compra` int(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Limitadores para a tabela `artigos`
--
ALTER TABLE `artigos`
  ADD CONSTRAINT `artigos_ibfk_1` FOREIGN KEY (`id_categoria`) REFERENCES `categorias` (`id_categoria`);

--
-- Limitadores para a tabela `detalhes_compra`
--
ALTER TABLE `detalhes_compra`
  ADD CONSTRAINT `detalhes_compra_ibfk_1` FOREIGN KEY (`id_compra`) REFERENCES `compra_confirmada` (`id_compra`),
  ADD CONSTRAINT `detalhes_compra_ibfk_2` FOREIGN KEY (`id_artigo`) REFERENCES `artigos` (`id_artigo`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
