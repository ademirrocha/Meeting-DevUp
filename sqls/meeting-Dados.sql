-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 29-Abr-2019 às 03:00
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

use meeting;

-- Extraindo dados da tabela `organizacoes`
--

INSERT INTO `organizacoes` (`id`, `meeting_confirmed`, `razao_social`, `cnpj`, `fantasia`, `created_at`, `updated_at`) VALUES
(1, 0, 'Nenhuma', '0000000', 'Nenhuma', '2019-04-29 03:53:36', '2019-04-29 03:53:36'),
(2, 1, 'Meeting Enterprise', '0000000', 'Meeting Enterprise', '2019-04-29 03:53:36', '2019-04-29 03:53:36'),
(3, 1, 'Equipe Dev - BSI', '00000000000000000', 'Equipe Dev - BSI', '2019-04-29 03:53:36', '2019-04-29 03:53:36');

--
-- Extraindo dados da tabela `cargos`
--



INSERT INTO `cargos` (`id`, `cargo`, `created_at`, `updated_at`) VALUES
(1, 'Indefinido', '2019-04-29 03:53:36', '2019-04-29 03:53:36'),
(2, 'Gerente/TI', '2019-04-29 03:53:36', '2019-04-29 03:53:36');


--
-- Extraindo dados da tabela `users`
--

INSERT INTO `users` (`id`, `organizacao_id`, `organizacao_confirmed`, `cargo_id`, `nome`, `email`, `cpf`, `telefone`, `sexo`, `email_verified_at`, `password`, `imagem`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 2, 1, 2, 'Admin do Meeting', 'admin@meeting.com', '00000000000', NULL, NULL, NULL, '$2y$10$/8STTlB6JCm4wx5IojsrI.N.EDjW5rZH6gwanEgYJr34daM5oPx5K', NULL, NULL, '2019-04-29 03:53:37', '2019-04-29 03:53:37'),
(2, 3, 1, 2, 'Ademir Rocha', 'tiademir.rocha93@gmail.com', '00000000000', NULL, NULL, NULL, '$2y$10$GNEczMBu0sYq21BGsYeTZ..BGFxOap5kXlSDuCs/KEAud5TQavlNm', NULL, NULL, '2019-04-29 03:53:37', '2019-04-29 03:53:37');



--
-- Extraindo dados da tabela `localizacoes`
--

INSERT INTO `localizacoes` (`id`, `organizacao_id`, `created_at`, `updated_at`, `nome`) VALUES
(1, 2, '2019-04-29 03:53:37', '2019-04-29 03:53:37', 'Sala dos Professores - IFNMG - Campus Arinos');

--
--
-- Extraindo dados da tabela `permissions`
--

INSERT INTO `permissions` (`id`, `nome`, `label`, `created_at`, `updated_at`) VALUES
(1, 'create_organizacao', 'Cadastrar Organização', '2019-04-29 03:53:38', '2019-04-29 03:53:38'),
(2, 'update_organizacao', 'Editar Organização', '2019-04-29 03:53:38', '2019-04-29 03:53:38'),
(3, 'view_organizacao', 'Visualizar a Própria Organização', '2019-04-29 03:53:38', '2019-04-29 03:53:38'),
(4, 'view_organizacoes', 'Visualizar Qualquer Organizacao Organização', '2019-04-29 03:53:38', '2019-04-29 03:53:38'),
(5, 'delete_organizacao', 'Deletar Organização', '2019-04-29 03:53:38', '2019-04-29 03:53:38'),
(6, 'confirmar_organizacao', 'Confirmar Organização', '2019-04-29 03:53:38', '2019-04-29 03:53:38'),
(7, 'update_reuniao', 'Editar a Própria Reunião', '2019-04-29 03:53:38', '2019-04-29 03:53:38'),
(8, 'update_reunioes', 'Editar Todas Reuniões', '2019-04-29 03:53:38', '2019-04-29 03:53:38'),
(9, 'view_reuniao', 'Visualizar Reunião', '2019-04-29 03:53:38', '2019-04-29 03:53:38'),
(10, 'delete_reuniao', 'Deletar Reunião', '2019-04-29 03:53:38', '2019-04-29 03:53:38'),
(11, 'update_user', 'Editar o Próprio Usuário', '2019-04-29 03:53:38', '2019-04-29 03:53:38'),
(12, 'update_users', 'Editar Todos os Usuário', '2019-04-29 03:53:38', '2019-04-29 03:53:38'),
(13, 'view_user', 'Visualizar Usuário', '2019-04-29 03:53:38', '2019-04-29 03:53:38'),
(14, 'delete_user', 'Deletar Usuário', '2019-04-29 03:53:38', '2019-04-29 03:53:38'),
(15, 'confirmar_user', 'Confirmar Usuário', '2019-04-29 03:53:39', '2019-04-29 03:53:39');



--
-- Extraindo dados da tabela `roles`
--

INSERT INTO `roles` (`id`, `nome`, `label`, `created_at`, `updated_at`) VALUES
(1, 'super_admin', 'Administrador do Sistema Meenting', '2019-04-29 03:53:39', '2019-04-29 03:53:39'),
(2, 'admin', 'Administrador de TI', '2019-04-29 03:53:39', '2019-04-29 03:53:39'),
(3, 'usuario', 'Usuário do Sistema', '2019-04-29 03:53:39', '2019-04-29 03:53:39'),
(4, 'unauthorized', 'Usuário ou Organização Não Autorizados', '2019-04-29 03:53:39', '2019-04-29 03:53:39');

--
-- Extraindo dados da tabela `permission_role`
--

INSERT INTO `permission_role` (`id`, `permission_id`, `role_id`) VALUES
(1, 2, 2),
(2, 3, 2),
(3, 7, 2),
(4, 8, 2),
(5, 9, 2),
(6, 11, 2),
(7, 12, 2),
(8, 13, 2),
(9, 15, 2),
(10, 3, 3),
(11, 7, 3),
(12, 9, 3),
(13, 11, 3),
(14, 13, 3),
(15, 1, 4);

--
-- Extraindo dados da tabela `role_user`
--

INSERT INTO `role_user` (`id`, `user_id`, `role_id`) VALUES
(1, 1, 1),
(2, 2, 2);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
