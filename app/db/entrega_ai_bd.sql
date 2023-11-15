-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 15/11/2023 às 13:56
-- Versão do servidor: 10.4.20-MariaDB
-- Versão do PHP: 8.0.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `entrega_ai_bd`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `adresses`
--

CREATE TABLE `adresses` (
  `id` int(11) NOT NULL,
  `user_id` int(10) NOT NULL,
  `description` varchar(255) NOT NULL,
  `latitude` varchar(255) NOT NULL,
  `longitude` varchar(255) NOT NULL,
  `addressDetails` varchar(255) NOT NULL,
  `number` int(10) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `update_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura para tabela `deliveries`
--

CREATE TABLE `deliveries` (
  `id` int(11) NOT NULL,
  `delivery_id` varchar(17) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `driver_id` int(11) DEFAULT NULL,
  `sender_name` varchar(255) NOT NULL,
  `sender_latitude` varchar(100) NOT NULL,
  `sender_longitude` varchar(100) NOT NULL,
  `sender_house_number` int(10) NOT NULL,
  `recipient_name` varchar(255) NOT NULL,
  `recipient_latitude` varchar(100) NOT NULL,
  `recipient_longitude` varchar(100) NOT NULL,
  `recipient_house_number` varchar(20) NOT NULL,
  `vehicle_type_id` int(11) NOT NULL,
  `total_km` float NOT NULL,
  `total_price` decimal(10,2) NOT NULL,
  `delivery_status_id` int(11) NOT NULL DEFAULT 1,
  `delivery_details` text DEFAULT NULL,
  `delivery_date` datetime DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura para tabela `drivers`
--

CREATE TABLE `drivers` (
  `id` int(11) NOT NULL,
  `name` varchar(250) NOT NULL,
  `email` varchar(250) NOT NULL,
  `password` varchar(250) NOT NULL,
  `phone` varchar(12) NOT NULL,
  `cpf` int(11) NOT NULL,
  `licence` int(12) NOT NULL,
  `birthdate` varchar(10) NOT NULL,
  `validated` int(1) NOT NULL,
  `type_user` int(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura para tabela `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(250) NOT NULL,
  `email` varchar(250) NOT NULL,
  `password` varchar(250) NOT NULL,
  `phone` varchar(12) NOT NULL,
  `birthdate` varchar(10) NOT NULL,
  `validated` int(11) NOT NULL,
  `type_user` int(1) NOT NULL DEFAULT 2,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `update_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura para tabela `vehicle_types`
--

CREATE TABLE `vehicle_types` (
  `id` int(11) NOT NULL,
  `type_name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `image_path` varchar(255) NOT NULL,
  `base_rate` decimal(10,2) NOT NULL,
  `rate_per_km` decimal(10,2) NOT NULL,
  `max_weight` decimal(10,2) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Despejando dados para a tabela `vehicle_types`
--

INSERT INTO `vehicle_types` (`id`, `type_name`, `description`, `image_path`, `base_rate`, `rate_per_km`, `max_weight`, `created_at`, `updated_at`) VALUES
(1, 'Motos', 'Ideal para documentos, pacotes pequenos e delivery de comida', 'caminho/para/imagem_moto.png', 6.00, 0.70, 20.00, '2023-10-20 14:52:58', '2023-10-20 14:52:58'),
(2, 'Carros', 'Perfeito para compras de mercado e pacotes médios', 'caminho/para/imagem_carro.png', 12.00, 2.20, 300.00, '2023-10-20 14:52:58', '2023-10-20 14:52:58'),
(3, 'Caminhões', 'Ideal para mudanças ou materiais grandes e pesados', 'caminho/para/imagem_caminhao.png', 100.00, 5.60, 1500.00, '2023-10-20 14:52:58', '2023-10-20 14:52:58');

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `adresses`
--
ALTER TABLE `adresses`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `deliveries`
--
ALTER TABLE `deliveries`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `drivers`
--
ALTER TABLE `drivers`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `vehicle_types`
--
ALTER TABLE `vehicle_types`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `adresses`
--
ALTER TABLE `adresses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de tabela `deliveries`
--
ALTER TABLE `deliveries`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `drivers`
--
ALTER TABLE `drivers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de tabela `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT de tabela `vehicle_types`
--
ALTER TABLE `vehicle_types`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
