-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 29/11/2023 às 18:59
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
-- Estrutura para tabela `banking_info`
--

CREATE TABLE `banking_info` (
  `id` int(11) NOT NULL,
  `driver_id` int(11) NOT NULL,
  `account_number` varchar(50) NOT NULL,
  `account_holder_name` varchar(250) NOT NULL,
  `bank_name` varchar(250) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Despejando dados para a tabela `banking_info`
--

INSERT INTO `banking_info` (`id`, `driver_id`, `account_number`, `account_holder_name`, `bank_name`, `created_at`, `updated_at`) VALUES
(1, 24, '123123123123', 'Teste', 'Ress', '2023-11-29 17:38:26', '2023-11-29 17:38:26');

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Despejando dados para a tabela `deliveries`
--

INSERT INTO `deliveries` (`id`, `delivery_id`, `user_id`, `driver_id`, `sender_latitude`, `sender_longitude`, `sender_address_details`, `sender_house_number`, `recipient_name`, `recipient_latitude`, `recipient_longitude`, `recipient_address_details`, `recipient_house_number`, `vehicle_type_id`, `vehicle_id`, `weight`, `total_km`, `total_price`, `delivery_status_id`, `delivery_details`, `delivery_date`, `current_latitude`, `current_longitude`, `created_at`, `updated_at`) VALUES
(37, 'BRAKE11BI27P178AI', 81, 0, '-4.9619237725246', '-39.007172584534', 'Av. Belo Horizonte, Campo Velho, Quixadá, CE, BR', 654, 'Teste', '-4.9726978221939', '-39.024038314819', 'CE-060, Combate, Quixadá, CE, BR', '2', 2, 0, '122', '2,8 km', 12.00, 12, 'Entrega Urgente', NULL, '', '', '2023-11-28 21:50:00', '2023-11-28 23:10:43'),
(39, 'BRGGF1U003J4MO2AI', 81, 24, '-4.9789398497117', '-39.006915092468', 'R. Juvêncio Alves de Oliveira, Baviera, Quixadá, CE, BR', 654, 'Teste', '-4.9627788622627', '-39.024338722229', 'Av. Estados Unidos, São João, Quixadá, CE, BR', '2', 2, 10, '122', '3,6 km', 12.00, 4, 'Entrega Urgente', NULL, '-4.9712', '-39.0175', '2023-11-29 12:10:06', '2023-11-29 16:59:01');

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Despejando dados para a tabela `drivers`
--

INSERT INTO `drivers` (`id`, `name`, `email`, `password`, `phone`, `cpf`, `licence`, `birthdate`, `validated`, `type_user`, `created_at`, `updated_at`) VALUES
(24, 'Teste Motorista', 'testemotorista@gmail.com', '$2y$10$58IT40jnL/8CK75efzEFnu5oRkKoOgxRzcicYwvkFYlpOtH46OcnG', '88888888888', 2147483647, 2147483647, '2001-11-21', 0, 1, '2023-11-28 21:49:34', '2023-11-29 17:11:36');

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Despejando dados para a tabela `payment_cards`
--

INSERT INTO `payment_cards` (`id`, `user_id`, `card_number`, `cardholder_name`, `expiration_date`, `cvv`, `created_at`, `updated_at`) VALUES
(8, 81, '1231 2123 1321 3132', 'TESTE USUARIO', '09/2029', '123', '2023-11-28 21:44:09', '2023-11-29 17:59:36');

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Despejando dados para a tabela `ratings`
--

INSERT INTO `ratings` (`id`, `delivery_id`, `user_id`, `driver_id`, `rating`, `comment`, `created_at`, `updated_at`) VALUES
(5, 39, 81, 24, 5, NULL, '2023-11-29 17:07:40', '2023-11-29 17:07:40'),
(6, 39, 81, 24, 3, NULL, '2023-11-29 17:10:27', '2023-11-29 17:10:27'),
(7, 39, 81, 24, 2, NULL, '2023-11-29 17:10:32', '2023-11-29 17:10:32'),
(8, 39, 81, 24, 4, NULL, '2023-11-29 17:10:38', '2023-11-29 17:10:38'),
(9, 39, 81, 24, 5, NULL, '2023-11-29 17:10:42', '2023-11-29 17:10:42');

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Despejando dados para a tabela `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `phone`, `birthdate`, `cpf`, `validated`, `type_user`, `created_at`, `update_at`) VALUES
(81, 'Usuario Teste', 'usuarioteste@gmail.com', '$2y$10$e2mVn1oyy7hrfWAwrRjiFeCtlupuskA3sBY4ZqGrMNL8w/VFiCl9S', '88888888888', '2000-09-05', 04294967295, 0, 2, '2023-11-28 21:42:23', '2023-11-29 17:12:13');

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Despejando dados para a tabela `vehicles`
--

INSERT INTO `vehicles` (`id`, `vehicle_type_id`, `driver_id`, `plate_number`, `brand`, `model`, `color`, `manufacture_year`, `details`, `created_at`, `updated_at`) VALUES
(10, 2, 24, 'OYO-1500', 'Ford', 'Fiesta', '#d01616', 2012, 'Nenhum', '2023-11-29 12:20:26', '2023-11-29 12:20:26');

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
-- Índices de tabela `banking_info`
--
ALTER TABLE `banking_info`
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
-- AUTO_INCREMENT de tabela `banking_info`
--
ALTER TABLE `banking_info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `deliveries`
--
ALTER TABLE `deliveries`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT de tabela `delivery_status`
--
ALTER TABLE `delivery_status`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de tabela `drivers`
--
ALTER TABLE `drivers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT de tabela `payment_cards`
--
ALTER TABLE `payment_cards`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de tabela `ratings`
--
ALTER TABLE `ratings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de tabela `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=82;

--
-- AUTO_INCREMENT de tabela `vehicles`
--
ALTER TABLE `vehicles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de tabela `vehicle_types`
--
ALTER TABLE `vehicle_types`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
