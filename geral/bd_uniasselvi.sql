-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: 13-Jan-2020 às 03:18
-- Versão do servidor: 5.7.23
-- versão do PHP: 7.2.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bd_uniasselvi`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `clientes`
--

DROP TABLE IF EXISTS `clientes`;
CREATE TABLE IF NOT EXISTS `clientes` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `NomeCliente` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `CPF` char(11) COLLATE utf8_unicode_ci NOT NULL,
  `Email` char(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `clientes`
--

INSERT INTO `clientes` (`id`, `NomeCliente`, `CPF`, `Email`) VALUES
(4, 'Anderson Pires', '02114558595', 'aa@aa'),
(2, 'Isadora Sehnem da Costa', '11412144545', 'isa@isa'),
(3, 'João da Silva', '25545878885', NULL),
(5, 'Jean Carlos', '21225223658', NULL),
(6, 'Bianca Souza', '24558778547', 'bia@123'),
(7, 'Zeus', '32325665458', NULL),
(8, 'Ana', '02125445636', 'aa@asas'),
(9, 'aaaa', '09036565858', NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
CREATE TABLE IF NOT EXISTS `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `connection` text COLLATE utf8_unicode_ci NOT NULL,
  `queue` text COLLATE utf8_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `migrations`
--

DROP TABLE IF EXISTS `migrations`;
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=20 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(16, '2020_01_10_141523_create_clientes_table', 2),
(17, '2020_01_10_152114_create_produtos_table', 2),
(18, '2020_01_10_153007_create_pedidos_table', 2),
(19, '2020_01_10_154102_pedidos_produtos_table', 2);

-- --------------------------------------------------------

--
-- Estrutura da tabela `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `pedidos`
--

DROP TABLE IF EXISTS `pedidos`;
CREATE TABLE IF NOT EXISTS `pedidos` (
  `NumeroPedido` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `DtPedido` datetime NOT NULL,
  `cliente_id` int(11) NOT NULL,
  `status` enum('ABERTO','PAGO','CANCELADO','') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'ABERTO',
  PRIMARY KEY (`NumeroPedido`),
  KEY `pedidos_clienteid_foreign` (`cliente_id`)
) ENGINE=MyISAM AUTO_INCREMENT=39 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `pedidos`
--

INSERT INTO `pedidos` (`NumeroPedido`, `DtPedido`, `cliente_id`, `status`) VALUES
(38, '2020-01-13 02:58:55', 6, 'ABERTO'),
(36, '2020-01-13 01:09:28', 4, 'ABERTO');

-- --------------------------------------------------------

--
-- Estrutura da tabela `pedido_produto`
--

DROP TABLE IF EXISTS `pedido_produto`;
CREATE TABLE IF NOT EXISTS `pedido_produto` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `Quantidade` int(11) NOT NULL,
  `pedido_NumeroPedido` int(11) NOT NULL,
  `produto_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `pedidos_produtos_pedidoid_foreign` (`pedido_NumeroPedido`),
  KEY `pedidos_produtos_produtoid_foreign` (`produto_id`)
) ENGINE=MyISAM AUTO_INCREMENT=78 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `pedido_produto`
--

INSERT INTO `pedido_produto` (`id`, `Quantidade`, `pedido_NumeroPedido`, `produto_id`) VALUES
(77, 5, 38, 6),
(75, 4, 36, 6),
(74, 5, 36, 5);

-- --------------------------------------------------------

--
-- Estrutura da tabela `produtos`
--

DROP TABLE IF EXISTS `produtos`;
CREATE TABLE IF NOT EXISTS `produtos` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `NomeProduto` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `CodBarras` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `ValorUnitario` decimal(15,4) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `produtos`
--

INSERT INTO `produtos` (`id`, `NomeProduto`, `CodBarras`, `ValorUnitario`) VALUES
(6, 'Coca-Cola', '121215121', '8.0000'),
(5, 'Água mineral', '1245414', '2.5000'),
(7, 'Chocolate Barra', '54548745487845', '4.3000');

-- --------------------------------------------------------

--
-- Estrutura da tabela `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'admin@admin', NULL, '$2y$10$QHKOXPDlCDZ4K3BuNgkDv.aB17.M0Gf/rdFCmM6kKWkmAdbrxFbmq', NULL, '2020-01-10 15:51:14', '2020-01-10 15:51:14');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
