-- phpMyAdmin SQL Dump
-- version 3.4.9
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tempo de Geração: 27/11/2012 às 20h09min
-- Versão do Servidor: 5.5.19
-- Versão do PHP: 5.4.0RC4

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Banco de Dados: `dacommerce`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `dc_images`
--

CREATE TABLE IF NOT EXISTS `dc_images` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `image_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `image_url` varchar(255) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

--
-- Extraindo dados da tabela `dc_images`
--

INSERT INTO `dc_images` (`ID`, `image_date`, `image_url`) VALUES
(7, '2012-10-24 15:15:19', 'http://localhost:8080/daCommerce/dc-content/uploads/curso-negocio-do-vinho.jpg'),
(8, '2012-10-24 15:15:19', 'http://localhost:8080/daCommerce/dc-content/uploads/VINHO-E-DIABESTES.jpg'),
(9, '2012-10-24 15:21:50', 'http://localhost:8080/daCommerce/dc-content/uploads/Koala.jpg'),
(10, '2012-10-24 15:21:50', 'http://localhost:8080/daCommerce/dc-content/uploads/Penguins.jpg'),
(11, '2012-11-07 23:32:52', 'http://localhost:8080/daCommerce/dc-content/uploads/1346284310_wordpress_logo.png'),
(12, '2012-11-07 23:32:52', 'http://localhost:8080/daCommerce/dc-content/uploads/1347409199_Wordpress.png');

-- --------------------------------------------------------

--
-- Estrutura da tabela `dc_options`
--

CREATE TABLE IF NOT EXISTS `dc_options` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `option_key` varchar(255) DEFAULT NULL,
  `option_value` text,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Extraindo dados da tabela `dc_options`
--

INSERT INTO `dc_options` (`ID`, `option_key`, `option_value`) VALUES
(1, 'base_href', 'http://localhost:8080/daCommerce/');

-- --------------------------------------------------------

--
-- Estrutura da tabela `dc_orders`
--

CREATE TABLE IF NOT EXISTS `dc_orders` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `order_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `order_payment_type` int(1) NOT NULL,
  `order_totalprice` decimal(10,2) DEFAULT NULL,
  `order_status` int(1) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Extraindo dados da tabela `dc_orders`
--

INSERT INTO `dc_orders` (`ID`, `user_id`, `order_date`, `order_payment_type`, `order_totalprice`, `order_status`) VALUES
(1, 1, '2012-10-09 16:35:25', 1, NULL, 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `dc_order_products`
--

CREATE TABLE IF NOT EXISTS `dc_order_products` (
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `product_amount` int(11) DEFAULT NULL,
  `product_price` decimal(10,2) DEFAULT NULL,
  PRIMARY KEY (`order_id`,`product_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `dc_order_products`
--

INSERT INTO `dc_order_products` (`order_id`, `product_id`, `product_amount`, `product_price`) VALUES
(1, 1, 1, '50.00');

-- --------------------------------------------------------

--
-- Estrutura da tabela `dc_products`
--

CREATE TABLE IF NOT EXISTS `dc_products` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `product_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `product_name` varchar(255) DEFAULT NULL,
  `product_description` text,
  `product_price` decimal(10,2) DEFAULT NULL,
  `product_fromprice` decimal(10,2) DEFAULT NULL,
  `product_count` int(11) DEFAULT NULL,
  `product_thumbnail_id` int(11) DEFAULT NULL,
  `product_status` int(1) DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Extraindo dados da tabela `dc_products`
--

INSERT INTO `dc_products` (`ID`, `product_date`, `product_name`, `product_description`, `product_price`, `product_fromprice`, `product_count`, `product_thumbnail_id`, `product_status`) VALUES
(3, '2012-10-24 15:15:19', 'Vinho Tinto p/ 2 Pessoas', 'Vinho para 2 pessoas no melhor restaurante da cidade, acompanhado por buffet de frios.', '45.00', '120.00', 0, 7, 1),
(4, '2012-10-24 15:21:50', 'Mouse', 'Mouse Logitech', '100.00', '560.00', 0, 9, 1),
(5, '2012-11-07 23:32:52', 'Arroz Integral', 'Arroz Integral de 5kg', '50.00', '200.00', 0, 11, 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `dc_product_images`
--

CREATE TABLE IF NOT EXISTS `dc_product_images` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` int(11) NOT NULL,
  `image_id` int(11) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Extraindo dados da tabela `dc_product_images`
--

INSERT INTO `dc_product_images` (`ID`, `product_id`, `image_id`) VALUES
(3, 3, 7),
(4, 3, 8),
(5, 4, 9),
(6, 4, 10),
(7, 5, 11),
(8, 5, 12);

-- --------------------------------------------------------

--
-- Estrutura da tabela `dc_rules`
--

CREATE TABLE IF NOT EXISTS `dc_rules` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` int(11) NOT NULL,
  `rule_key` varchar(255) DEFAULT NULL,
  `rule_value` text,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `dc_users`
--

CREATE TABLE IF NOT EXISTS `dc_users` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `user_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `user_name` varchar(255) DEFAULT NULL,
  `user_email` varchar(255) DEFAULT NULL,
  `user_pass` varchar(255) DEFAULT NULL,
  `user_access` int(1) NOT NULL,
  `user_status` int(1) DEFAULT '1',
  `idade` int(11) NOT NULL,
  PRIMARY KEY (`ID`),
  UNIQUE KEY `user_email` (`user_email`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Extraindo dados da tabela `dc_users`
--

INSERT INTO `dc_users` (`ID`, `user_date`, `user_name`, `user_email`, `user_pass`, `user_access`, `user_status`, `idade`) VALUES
(1, '2012-10-09 16:35:24', 'Diego', 'diego@arealocal.com.br', '078c007bd92ddec308ae2f5115c1775d', 0, 1, 0),
(3, '2012-11-07 23:31:35', 'Gabriel Buzzi Venturi', 'gabriel@arealocal.com.br', '647431b5ca55b04fdf3c2fce31ef1915', 1, 1, 0),
(4, '2012-11-07 23:49:33', 'Fernando Santos', 'fernando@hotmail.com', 'df10ef8509dc176d733d59549e7dbfaf', 1, 1, 23);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
