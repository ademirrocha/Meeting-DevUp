-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 22-Abr-2019 às 12:33
-- Versão do servidor: 10.1.38-MariaDB
-- versão do PHP: 7.3.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `meeting`
--
CREATE DATABASE IF NOT EXISTS `meeting` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE `meeting`;

-- --------------------------------------------------------

--
-- Estrutura da tabela `cargos`
--

CREATE TABLE `cargos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `cargo` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `cargos`
--

INSERT INTO `cargos` (`id`, `cargo`, `created_at`, `updated_at`) VALUES
(1, 'Indefinido', '2019-04-22 13:32:01', '2019-04-22 13:32:01'),
(2, 'Gerente/TI', '2019-04-22 13:32:01', '2019-04-22 13:32:01');

-- --------------------------------------------------------

--
-- Estrutura da tabela `localizacoes`
--

CREATE TABLE `localizacoes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `organizacao_id` bigint(20) UNSIGNED NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `nome` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `localizacoes`
--

INSERT INTO `localizacoes` (`id`, `organizacao_id`, `created_at`, `updated_at`, `nome`) VALUES
(1, 2, '2019-04-22 13:32:03', '2019-04-22 13:32:03', 'Sala dos Professores - IFNMG - Campus Arinos');

-- --------------------------------------------------------

--
-- Estrutura da tabela `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2019_04_08_011854_create_cargos_table', 1),
(2, '2019_04_08_020655_create_organizacaos_table', 1),
(3, '2019_04_17_090000_create_users_table', 1),
(4, '2019_04_17_100000_create_password_resets_table', 1),
(5, '2019_04_21_193439_create_localizacaos_table', 1),
(6, '2019_04_21_204217_create_reunioes_table', 1),
(7, '2019_04_22_001434_create_users_reuniao_table', 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `organizacoes`
--

CREATE TABLE `organizacoes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `meeting_confirmed` tinyint(1) NOT NULL DEFAULT '0',
  `razao_social` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cnpj` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fantasia` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `organizacoes`
--

INSERT INTO `organizacoes` (`id`, `meeting_confirmed`, `razao_social`, `cnpj`, `fantasia`, `created_at`, `updated_at`) VALUES
(1, 0, 'Nenhuma', '0000000', 'Nenhuma', '2019-04-22 13:32:00', '2019-04-22 13:32:00'),
(2, 0, 'Meeting Enterprise', '0000000', 'Meeting Enterprise', '2019-04-22 13:32:00', '2019-04-22 13:32:00'),
(3, 0, 'Equipe Dev - BSI', '00000000000000000', 'Equipe Dev - BSI', '2019-04-22 13:32:00', '2019-04-22 13:32:00');

-- --------------------------------------------------------

--
-- Estrutura da tabela `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `reunioes`
--

CREATE TABLE `reunioes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL DEFAULT '1',
  `localizacao_id` bigint(20) UNSIGNED NOT NULL DEFAULT '1',
  `organizacao_id` bigint(20) UNSIGNED NOT NULL DEFAULT '1',
  `pauta` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `data_inicio` datetime NOT NULL,
  `data_fim` datetime NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `organizacao_id` bigint(20) UNSIGNED NOT NULL DEFAULT '1',
  `organizacao_confirmed` tinyint(1) NOT NULL DEFAULT '0',
  `cargo_id` bigint(20) UNSIGNED NOT NULL DEFAULT '1',
  `nome` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cpf` varchar(16) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `telefone` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sexo` varchar(9) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `imagem` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `users`
--

INSERT INTO `users` (`id`, `organizacao_id`, `organizacao_confirmed`, `cargo_id`, `nome`, `email`, `cpf`, `telefone`, `sexo`, `email_verified_at`, `password`, `imagem`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 2, 1, 2, 'Admin do Meeting', 'admin@meeting.com', '00000000000', NULL, NULL, NULL, '$2y$10$oFbGMCkTUtQxtdFBc61QYeVhx2y3m22pem945pDwbHEmyHrCsbs6u', NULL, NULL, '2019-04-22 13:32:01', '2019-04-22 13:32:01'),
(2, 3, 1, 2, 'Ademir Rocha', 'tiademir.rocha93@gmail.com', '00000000000', NULL, NULL, NULL, '$2y$10$x0fXCw/jaUR2mxJX.jY/tuK3qwTloQpQJdROijs4c40YhfBaA5bvO', NULL, NULL, '2019-04-22 13:32:02', '2019-04-22 13:32:02');

-- --------------------------------------------------------

--
-- Estrutura da tabela `users_reuniao`
--

CREATE TABLE `users_reuniao` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL DEFAULT '1',
  `reuniao_id` bigint(20) UNSIGNED NOT NULL DEFAULT '1',
  `tipo` enum('Convidado','Convocado') COLLATE utf8mb4_unicode_ci NOT NULL,
  `presente` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cargos`
--
ALTER TABLE `cargos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `localizacoes`
--
ALTER TABLE `localizacoes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `localizacoes_organizacao_id_foreign` (`organizacao_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `organizacoes`
--
ALTER TABLE `organizacoes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `reunioes`
--
ALTER TABLE `reunioes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `reunioes_user_id_foreign` (`user_id`),
  ADD KEY `reunioes_localizacao_id_foreign` (`localizacao_id`),
  ADD KEY `reunioes_organizacao_id_foreign` (`organizacao_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD KEY `users_cargo_id_foreign` (`cargo_id`),
  ADD KEY `users_organizacao_id_foreign` (`organizacao_id`);

--
-- Indexes for table `users_reuniao`
--
ALTER TABLE `users_reuniao`
  ADD PRIMARY KEY (`id`),
  ADD KEY `users_reuniao_user_id_foreign` (`user_id`),
  ADD KEY `users_reuniao_reuniao_id_foreign` (`reuniao_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cargos`
--
ALTER TABLE `cargos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `localizacoes`
--
ALTER TABLE `localizacoes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `organizacoes`
--
ALTER TABLE `organizacoes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `reunioes`
--
ALTER TABLE `reunioes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users_reuniao`
--
ALTER TABLE `users_reuniao`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Limitadores para a tabela `localizacoes`
--
ALTER TABLE `localizacoes`
  ADD CONSTRAINT `localizacoes_organizacao_id_foreign` FOREIGN KEY (`organizacao_id`) REFERENCES `organizacoes` (`id`) ON DELETE CASCADE;

--
-- Limitadores para a tabela `reunioes`
--
ALTER TABLE `reunioes`
  ADD CONSTRAINT `reunioes_localizacao_id_foreign` FOREIGN KEY (`localizacao_id`) REFERENCES `localizacoes` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `reunioes_organizacao_id_foreign` FOREIGN KEY (`organizacao_id`) REFERENCES `organizacoes` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `reunioes_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Limitadores para a tabela `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_cargo_id_foreign` FOREIGN KEY (`cargo_id`) REFERENCES `cargos` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `users_organizacao_id_foreign` FOREIGN KEY (`organizacao_id`) REFERENCES `organizacoes` (`id`) ON DELETE CASCADE;

--
-- Limitadores para a tabela `users_reuniao`
--
ALTER TABLE `users_reuniao`
  ADD CONSTRAINT `users_reuniao_reuniao_id_foreign` FOREIGN KEY (`reuniao_id`) REFERENCES `reunioes` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `users_reuniao_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
