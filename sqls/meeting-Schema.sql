-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 29-Abr-2019 às 02:54
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

CREATE Database meeting;
use meeting;
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

-- --------------------------------------------------------

--
-- Estrutura da tabela `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
  `tipo` enum('Convite','Convocação','Convite Geral','Convocação Geral') COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `data_inicio` datetime NOT NULL,
  `data_fim` datetime NOT NULL,
  `encerrada` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `pautas`
--

CREATE TABLE `pautas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `reuniao_id` bigint(20) UNSIGNED NOT NULL,
  `nome` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nome` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `label` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nome` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `label` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `permission_role`
--

CREATE TABLE `permission_role` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `role_user`
--

CREATE TABLE `role_user` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `users_reuniao`
--

CREATE TABLE `users_reuniao` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL DEFAULT '1',
  `reuniao_id` bigint(20) UNSIGNED NOT NULL DEFAULT '1',
  `confimou_presenca` tinyint(1) NOT NULL DEFAULT '0',
  `presente` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



-- --------------------------------------------------------

--
-- Estrutura da tabela `atas`
--

CREATE TABLE `atas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `reuniao_id` bigint(20) UNSIGNED NOT NULL DEFAULT '1',
  `ata` longtext COLLATE utf8mb4_unicode_ci NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


-- --------------------------------------------------------

--
-- Estrutura da tabela `meeting_notifies`
--

CREATE TABLE `meeting_notifies` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `user_autor_id` bigint(20) DEFAULT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `texto` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `read` tinyint(1) NOT NULL DEFAULT '0',
  `table_references` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `table_references_id` bigint(20) DEFAULT NULL,
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
-- Indexes for table `pautas`
--
ALTER TABLE `pautas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pautas_reuniao_id_foreign` (`reuniao_id`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permissions_nome_unique` (`nome`);

--
-- Indexes for table `permission_role`
--
ALTER TABLE `permission_role`
  ADD PRIMARY KEY (`id`),
  ADD KEY `permission_role_permission_id_foreign` (`permission_id`),
  ADD KEY `permission_role_role_id_foreign` (`role_id`);

--
-- Indexes for table `reunioes`
--
ALTER TABLE `reunioes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `reunioes_user_id_foreign` (`user_id`),
  ADD KEY `reunioes_localizacao_id_foreign` (`localizacao_id`),
  ADD KEY `reunioes_organizacao_id_foreign` (`organizacao_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_nome_unique` (`nome`);

--
-- Indexes for table `role_user`
--
ALTER TABLE `role_user`
  ADD PRIMARY KEY (`id`),
  ADD KEY `role_user_user_id_foreign` (`user_id`),
  ADD KEY `role_user_role_id_foreign` (`role_id`);

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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `localizacoes`
--
ALTER TABLE `localizacoes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `organizacoes`
--
ALTER TABLE `organizacoes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pautas`
--
ALTER TABLE `pautas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `permission_role`
--
ALTER TABLE `permission_role`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `reunioes`
--
ALTER TABLE `reunioes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `role_user`
--
ALTER TABLE `role_user`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

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
-- Limitadores para a tabela `pautas`
--
ALTER TABLE `pautas`
  ADD CONSTRAINT `pautas_reuniao_id_foreign` FOREIGN KEY (`reuniao_id`) REFERENCES `reunioes` (`id`) ON DELETE CASCADE;

--
-- Limitadores para a tabela `permission_role`
--
ALTER TABLE `permission_role`
  ADD CONSTRAINT `permission_role_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `permission_role_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Limitadores para a tabela `reunioes`
--
ALTER TABLE `reunioes`
  ADD CONSTRAINT `reunioes_localizacao_id_foreign` FOREIGN KEY (`localizacao_id`) REFERENCES `localizacoes` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `reunioes_organizacao_id_foreign` FOREIGN KEY (`organizacao_id`) REFERENCES `organizacoes` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `reunioes_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Limitadores para a tabela `role_user`
--
ALTER TABLE `role_user`
  ADD CONSTRAINT `role_user_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_user_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

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


ALTER TABLE `atas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `atas_reuniao_id_foreign` (`reuniao_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `atas`
--
ALTER TABLE `atas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Limitadores para a tabela `atas`
--
ALTER TABLE `atas`
  ADD CONSTRAINT `atas_reuniao_id_foreign` FOREIGN KEY (`reuniao_id`) REFERENCES `reunioes` (`id`) ON DELETE CASCADE;



--
-- Indexes for table `meeting_notifies`
--
ALTER TABLE `meeting_notifies`
  ADD PRIMARY KEY (`id`),
  ADD KEY `meeting_notifies_user_id_foreign` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `meeting_notifies`
--
ALTER TABLE `meeting_notifies`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Limitadores para a tabela `meeting_notifies`
--
ALTER TABLE `meeting_notifies`
  ADD CONSTRAINT `meeting_notifies_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;


COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
