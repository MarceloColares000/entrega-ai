-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 28/11/2023 às 22:23
-- Versão do servidor: 10.4.28-MariaDB
-- Versão do PHP: 8.0.28

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `deliveries`
--

CREATE TABLE `deliveries` (
  `id` int(11) NOT NULL,
  `delivery_id` varchar(17) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `driver_id` int(11) DEFAULT NULL,
  `sender_latitude` varchar(100) NOT NULL,
  `sender_longitude` varchar(100) NOT NULL,
  `sender_address_details` varchar(255) NOT NULL,
  `sender_house_number` int(10) NOT NULL,
  `recipient_name` varchar(255) NOT NULL,
  `recipient_latitude` varchar(100) NOT NULL,
  `recipient_longitude` varchar(100) NOT NULL,
  `recipient_address_details` varchar(255) NOT NULL,
  `recipient_house_number` varchar(20) NOT NULL,
  `vehicle_type_id` int(11) NOT NULL,
  `vehicle_id` int(11) NOT NULL,
  `weight` varchar(10) NOT NULL,
  `total_km` varchar(255) NOT NULL,
  `total_price` decimal(10,2) NOT NULL,
  `delivery_status_id` int(11) NOT NULL DEFAULT 1,
  `delivery_details` text DEFAULT NULL,
  `delivery_date` datetime DEFAULT NULL,
  `current_latitude` varchar(255) NOT NULL,
  `current_longitude` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `delivery_status`
--

CREATE TABLE `delivery_status` (
  `id` int(11) NOT NULL,
  `status_name` varchar(100) NOT NULL,
  `status_description` text DEFAULT NULL,
  `icon` varchar(255) NOT NULL,
  `css_class` varchar(50) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `delivery_status`
--

INSERT INTO `delivery_status` (`id`, `status_name`, `status_description`, `icon`, `css_class`, `created_at`, `updated_at`) VALUES
(1, 'Pedido Recebido', 'Eba! Recebemos seu pedido! Estamos conectando você a um motorista parceiro que logo estará a caminho.', 'fa-exclamation-triangle', 'bg-warning', '2023-11-17 04:56:23', '2023-11-25 03:47:11'),
(2, 'Motorista Confirmado', 'Excelente! Um motorista parceiro já aceitou seu pedido. Ele está se preparando para buscar ou entregar seu item!', 'fa-check-square-o', 'bg-info', '2023-11-17 04:56:23', '2023-11-25 03:49:25'),
(3, 'A Caminho', 'Seu motorista está a caminho para buscar ou entregar seu item. Logo logo ele chega, tudo pronto para você!', 'fa-truck', 'bg-info', '2023-11-17 04:56:23', '2023-11-25 03:49:46'),
(4, 'Entrega Concluída', 'Sucesso! Seu pedido foi entregue com carinho pelo nosso motorista parceiro. Obrigado por contar com a gente!', 'fa-check-square-o', 'bg-success', '2023-11-17 04:56:23', '2023-11-25 03:49:39'),
(5, 'Pegou sua encomenda', 'O motorista acabou de pegar sua encomenda e já está a caminho', 'fa-archive', 'bg-success', '2023-11-16 23:00:00', '2023-11-25 04:19:09'),
(6, 'Cancelado pelo Motorista', 'O motorista parceiro cancelou o pedido de entrega.', 'fa-ban', 'bg-danger', '2023-11-16 23:00:00', '2023-11-25 03:48:30'),
(7, 'Problemas de Entrega', 'Houve um problema durante a entrega. Estamos resolvendo para garantir a melhor experiência.', 'fa-exclamation-triangle', 'bg-warning', '2023-11-16 23:00:00', '2023-11-25 03:52:25'),
(8, 'Entrega Adiada', 'Sua entrega foi adiada para um novo horário. Desculpe pelo inconveniente!', 'fa-clock-o', 'bg-warning', '2023-11-16 23:00:00', '2023-11-25 03:52:22'),
(11, 'Entrega Devolvida', 'Sua entrega foi devolvida ao remetente.', 'path/to/icon/returned.png', 'returned', '2023-11-16 23:00:00', '2023-11-16 23:00:00'),
(12, 'Cancelado pelo usuário', 'Você cancelou essa entrega', 'fa-ban', 'bg-danger', '2023-11-25 03:31:35', '2023-11-25 03:48:26');

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `payment_cards`
--

CREATE TABLE `payment_cards` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `card_number` varchar(19) NOT NULL,
  `cardholder_name` varchar(250) NOT NULL,
  `expiration_date` varchar(7) NOT NULL,
  `cvv` varchar(4) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `ratings`
--

CREATE TABLE `ratings` (
  `id` int(11) NOT NULL,
  `delivery_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `driver_id` int(11) NOT NULL,
  `rating` int(11) NOT NULL,
  `comment` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
  `cpf` int(11) UNSIGNED ZEROFILL NOT NULL,
  `validated` int(11) NOT NULL,
  `type_user` int(1) NOT NULL DEFAULT 2,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `update_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `vehicles`
--

CREATE TABLE `vehicles` (
  `id` int(11) NOT NULL,
  `vehicle_type_id` int(11) NOT NULL,
  `driver_id` int(11) NOT NULL,
  `plate_number` varchar(20) NOT NULL,
  `brand` varchar(100) NOT NULL,
  `model` varchar(100) NOT NULL,
  `color` varchar(50) NOT NULL,
  `manufacture_year` int(4) NOT NULL,
  `details` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `vehicle_types`
--

INSERT INTO `vehicle_types` (`id`, `type_name`, `description`, `image_path`, `base_rate`, `rate_per_km`, `max_weight`, `created_at`, `updated_at`) VALUES
(1, 'Motos', 'Ideal para documentos, pacotes pequenos e delivery de comida', 'caminho/para/imagem_moto.png', 6.00, 0.70, 20.00, '2023-10-20 17:52:58', '2023-10-20 17:52:58'),
(2, 'Carros', 'Perfeito para compras de mercado e pacotes médios', 'caminho/para/imagem_carro.png', 12.00, 2.20, 300.00, '2023-10-20 17:52:58', '2023-10-20 17:52:58'),
(3, 'Caminhões', 'Ideal para mudanças ou materiais grandes e pesados', 'caminho/para/imagem_caminhao.png', 100.00, 5.60, 1500.00, '2023-10-20 17:52:58', '2023-10-20 17:52:58');

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
-- Índices de tabela `delivery_status`
--
ALTER TABLE `delivery_status`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `drivers`
--
ALTER TABLE `drivers`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `payment_cards`
--
ALTER TABLE `payment_cards`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Índices de tabela `ratings`
--
ALTER TABLE `ratings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `delivery_id` (`delivery_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `driver_id` (`driver_id`);

--
-- Índices de tabela `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `vehicles`
--
ALTER TABLE `vehicles`
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT de tabela `deliveries`
--
ALTER TABLE `deliveries`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT de tabela `delivery_status`
--
ALTER TABLE `delivery_status`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de tabela `drivers`
--
ALTER TABLE `drivers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT de tabela `payment_cards`
--
ALTER TABLE `payment_cards`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de tabela `ratings`
--
ALTER TABLE `ratings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de tabela `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=81;

--
-- AUTO_INCREMENT de tabela `vehicles`
--
ALTER TABLE `vehicles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de tabela `vehicle_types`
--
ALTER TABLE `vehicle_types`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
