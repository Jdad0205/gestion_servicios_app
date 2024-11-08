-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 08-11-2024 a las 09:08:10
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `gestion_servicios_app`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientes`
--

CREATE TABLE `clientes` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `correo` varchar(100) NOT NULL,
  `direccion` varchar(150) NOT NULL,
  `telefono` varchar(15) DEFAULT NULL,
  `detalle` text DEFAULT NULL,
  `id_usuario` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `clientes`
--

INSERT INTO `clientes` (`id`, `nombre`, `correo`, `direccion`, `telefono`, `detalle`, `id_usuario`, `created_at`, `updated_at`) VALUES
(1, 'Juan Perez', 'juan@example.com', '123 Calle Falsa', '5551234567', 'Cliente especial', 2, '2024-11-08 00:19:01', '2024-11-08 06:11:38'),
(2, 'Juan david', 'juandavid@gmail.com', 'ederremasteringsiu', '3113391450', NULL, 1, '2024-11-08 06:39:32', '2024-11-08 06:11:26'),
(3, 'juaco', 'EDERLUISMESTRA79@GMAIL.COM', 'OBRERO BLOQUE 4 MANZANA 33 CASA 12', '3113391450', NULL, 14, '2024-11-08 11:48:50', '2024-11-08 11:48:50');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `contratos`
--

CREATE TABLE `contratos` (
  `id` int(11) NOT NULL,
  `id_cliente` int(11) NOT NULL,
  `id_servicio` int(11) NOT NULL,
  `descripcion` text DEFAULT NULL,
  `fecha_inicio` date DEFAULT NULL,
  `fecha_fin` date DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `contratos`
--

INSERT INTO `contratos` (`id`, `id_cliente`, `id_servicio`, `descripcion`, `fecha_inicio`, `fecha_fin`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 'Contrato de prueba', '2024-01-01', '2024-12-31', '2024-11-08 00:19:01', '2024-11-08 00:19:01');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `contrato_productos`
--

CREATE TABLE `contrato_productos` (
  `id` int(11) NOT NULL,
  `id_contrato` int(11) NOT NULL,
  `id_producto` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `facturas`
--

CREATE TABLE `facturas` (
  `id` int(11) NOT NULL,
  `id_contrato` int(11) NOT NULL,
  `id_cliente` int(11) NOT NULL,
  `precio` decimal(10,2) NOT NULL,
  `impuestos` decimal(10,2) NOT NULL,
  `total_pagar` decimal(10,2) NOT NULL,
  `fecha_emision` date NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `facturas`
--

INSERT INTO `facturas` (`id`, `id_contrato`, `id_cliente`, `precio`, `impuestos`, `total_pagar`, `fecha_emision`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 100.00, 18.00, 118.00, '2024-11-07', '2024-11-08 00:19:01', '2024-11-08 01:13:16');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `factura_productos`
--

CREATE TABLE `factura_productos` (
  `id` int(11) NOT NULL,
  `id_factura` int(11) NOT NULL,
  `id_producto` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `precio` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2024_09_20_195854_create_contratos_table', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pqr`
--

CREATE TABLE `pqr` (
  `id` int(11) NOT NULL,
  `id_cliente` int(11) NOT NULL,
  `tipo` enum('Petición','Queja','Reclamo') NOT NULL,
  `descripcion` text NOT NULL,
  `estado` enum('Pendiente','Resuelta') NOT NULL DEFAULT 'Pendiente',
  `fecha_creacion` timestamp NOT NULL DEFAULT current_timestamp(),
  `descripcion_solucion` text DEFAULT NULL,
  `fecha_solucion` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `pqr`
--

INSERT INTO `pqr` (`id`, `id_cliente`, `tipo`, `descripcion`, `estado`, `fecha_creacion`, `descripcion_solucion`, `fecha_solucion`, `created_at`, `updated_at`) VALUES
(1, 2, 'Petición', 'asdf', 'Resuelta', '2024-11-08 07:21:45', 'es muy facil mijo', '2024-11-08 07:15:37', '2024-11-08 07:21:45', '2024-11-08 12:15:37'),
(2, 2, 'Petición', 'af', 'Resuelta', '2024-11-08 08:15:57', 'más fácil mijo jasja', '2024-11-08 07:15:49', '2024-11-08 08:15:57', '2024-11-08 12:15:49'),
(9, 3, 'Petición', 'me muero', 'Resuelta', '2024-11-08 06:51:36', 'esto es muy fácl mijo, muy facil', '2024-11-08 07:16:11', '2024-11-08 11:51:36', '2024-11-08 12:16:11'),
(10, 3, 'Reclamo', 'lkajflsdf', 'Resuelta', '2024-11-08 07:08:22', 'esto es muy fáicl mijo', '2024-11-08 07:22:46', '2024-11-08 12:08:22', '2024-11-08 12:22:46'),
(12, 3, 'Petición', 'Solicitud de servicio: Descripción del servicio 1', 'Resuelta', '2024-11-08 07:40:59', 'no te lo voy a dar, no jodas.', '2024-11-08 07:43:15', '2024-11-08 12:40:59', '2024-11-08 12:43:15');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `descripcion` text DEFAULT NULL,
  `precio` decimal(10,2) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`id`, `nombre`, `descripcion`, `precio`, `created_at`, `updated_at`) VALUES
(1, 'Producto A', 'Descripción de Producto A', 100.00, '2024-11-08 00:19:01', '2024-11-08 00:19:01'),
(2, 'Producto B', 'Descripción de Producto B', 150.00, '2024-11-08 00:19:01', '2024-11-08 00:19:01'),
(3, 'carro moto', 'el mejor carromoto de todos, corre por el aire, vuela por el agua, y nada por la tierra.', 100.00, '2024-11-08 04:54:03', '2024-11-08 04:54:03'),
(1324, 'mototo', 'el mejor', 100.00, '2024-11-08 04:54:53', '2024-11-08 04:54:53');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles`
--

CREATE TABLE `roles` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `roles`
--

INSERT INTO `roles` (`id`, `nombre`) VALUES
(1, 'admin'),
(2, 'cliente'),
(3, 'soporte'),
(4, 'tecnico');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `servicios`
--

CREATE TABLE `servicios` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `descripcion` text DEFAULT NULL,
  `precio` decimal(10,2) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `servicios`
--

INSERT INTO `servicios` (`id`, `nombre`, `descripcion`, `precio`, `created_at`, `updated_at`) VALUES
(1, 'Servicio 1', 'Descripción del servicio 1', 2220.00, '2024-11-08 00:19:01', '2024-11-08 07:20:43');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('TkyvJDzBL8mBAwSsur317ozNWIjvGB8WrzRu0KMw', 15, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/130.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiWU4yYk8xckpRd2tKRGZmRkxnOEd5d1RHUldFbHVIc1FUSFNnMmpMNiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NjU6Imh0dHA6Ly9sb2NhbGhvc3QvbGFyYXZlbC9nZXN0aW9uX3NlcnZpY2lvc19hcHAvcHVibGljL3Bxci1zb3BvcnRlIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MTU7fQ==', 1731053252);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nombre_usuario` varchar(50) NOT NULL,
  `correo` varchar(100) NOT NULL,
  `contrasena` varchar(255) NOT NULL,
  `id_rol` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombre_usuario`, `correo`, `contrasena`, `id_rol`, `created_at`, `updated_at`) VALUES
(1, 'juaco', 'EDERLUISMESTRA19@GMAIL.COM', '$2y$12$HLws7tupRBJfD8xKOQ8QVuWq35rB7GTPR9ZrGJBaF3HmSInrbtRr2', 1, '2024-11-08 04:22:21', '2024-11-08 06:15:24'),
(2, 'soso', 'eder@gmail.com', 'Eder1032', 2, '2024-11-08 02:43:52', '2024-11-08 06:15:56'),
(3, 'tecnico1', 'tecnico1@example.com', 'hashedpassword', 3, '2024-11-08 00:19:01', '2024-11-08 00:19:01'),
(5, 'michone', 'EDERLUISMESTRA9@GMAIL.COM', '$2y$12$XEfeRMVBBcFPAjbVW3jNcOOtiI81SvXE8nijbgU7r7L.xvN52F5Li', 1, '2024-11-08 04:09:45', '2024-11-08 04:09:45'),
(6, 'michone', 'EDERLUISMESTRA99@GMAIL.COM', '$2y$12$PvPwi2zsjZ0MWBFJYfQeQO5eX3K/3XkssNEJkbulRG8JAF982PuTa', 1, '2024-11-08 04:14:42', '2024-11-08 04:14:42'),
(8, 'juaco', 'juaco9@GMAIL.COM', '$2y$12$UdC8YKqGjVwcZSMTGlR6d.sWx99EkPB7uMjbdbKrPL/RC8ffUo.Bu', 2, '2024-11-08 04:29:31', '2024-11-08 04:29:31'),
(9, 'eder mestra', 'edermestra@gmail.com', '$2y$12$jlBPazZGGgHUY0V8xYJ5Iuo3wE8cnbYojPpMpweXKRdvMCdqxJ6B6', 2, '2024-11-08 06:40:08', '2024-11-08 06:40:08'),
(10, 'eder morelo', 'EDERLUISMESTRA999@GMAIL.COM', '$2y$12$q9aoE3k.6KVYynXM/O6GluyYMVtC0w8d7QpcJK6MLtjjWs72yC5bK', 2, '2024-11-08 06:42:06', '2024-11-08 06:42:06'),
(11, 'asdf', 'asf@gmial.com', '$2y$12$DUYnNNYS1yMwpF9vS/jpiewmihOVy04BxZ2h2UkC/45uAoqT9q81i', 2, '2024-11-08 06:42:43', '2024-11-08 06:42:43'),
(12, 'alksdf', 'EDERLUISMESTadsfRA9@GMAIL.COM', '$2y$12$SoBpEggfYuzTM5R0yOSbeOA4LCPxcrnNKIzXokBGwKJCgrUVPuy66', 2, '2024-11-08 06:44:20', '2024-11-08 06:44:20'),
(13, 'eder', 'EDERLUISMESTRA998@GMAIL.COM', '$2y$12$UTRlKlIoEAzePEXcEZCCQevGG4Txzv1q9PVXHBomOwuX00QCIQn6q', 2, '2024-11-08 06:45:18', '2024-11-08 06:45:18'),
(14, 'juaco', 'EDERLUISMESTRA79@GMAIL.COM', '$2y$12$AQTQPIqtqTicfEwQ9Mbuh.BtSNEFYHvU2PbVBAT1dLXTS4dssaucy', 2, '2024-11-08 06:48:50', '2024-11-08 06:48:50'),
(15, 'sosororo', 'sososoro@gmail.com', '$2y$12$rXzzTeWaD93XQ7pcPH/ryePk/..On04OyV/eShsVbghR5DoDljWiW', 3, '2024-11-08 07:09:01', '2024-11-08 07:09:01');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indices de la tabla `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indices de la tabla `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `correo` (`correo`),
  ADD KEY `id_usuario` (`id_usuario`);

--
-- Indices de la tabla `contratos`
--
ALTER TABLE `contratos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_cliente` (`id_cliente`),
  ADD KEY `id_servicio` (`id_servicio`);

--
-- Indices de la tabla `contrato_productos`
--
ALTER TABLE `contrato_productos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_contrato` (`id_contrato`),
  ADD KEY `id_producto` (`id_producto`);

--
-- Indices de la tabla `facturas`
--
ALTER TABLE `facturas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_contrato` (`id_contrato`),
  ADD KEY `id_cliente` (`id_cliente`);

--
-- Indices de la tabla `factura_productos`
--
ALTER TABLE `factura_productos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_factura` (`id_factura`),
  ADD KEY `id_producto` (`id_producto`);

--
-- Indices de la tabla `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indices de la tabla `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indices de la tabla `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indices de la tabla `pqr`
--
ALTER TABLE `pqr`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_cliente` (`id_cliente`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nombre` (`nombre`);

--
-- Indices de la tabla `servicios`
--
ALTER TABLE `servicios`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `correo` (`correo`),
  ADD KEY `id_rol` (`id_rol`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `clientes`
--
ALTER TABLE `clientes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `contratos`
--
ALTER TABLE `contratos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `contrato_productos`
--
ALTER TABLE `contrato_productos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `facturas`
--
ALTER TABLE `facturas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `factura_productos`
--
ALTER TABLE `factura_productos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `pqr`
--
ALTER TABLE `pqr`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1325;

--
-- AUTO_INCREMENT de la tabla `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `servicios`
--
ALTER TABLE `servicios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `clientes`
--
ALTER TABLE `clientes`
  ADD CONSTRAINT `clientes_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id`);

--
-- Filtros para la tabla `contratos`
--
ALTER TABLE `contratos`
  ADD CONSTRAINT `contratos_ibfk_1` FOREIGN KEY (`id_cliente`) REFERENCES `clientes` (`id`),
  ADD CONSTRAINT `contratos_ibfk_2` FOREIGN KEY (`id_servicio`) REFERENCES `servicios` (`id`);

--
-- Filtros para la tabla `contrato_productos`
--
ALTER TABLE `contrato_productos`
  ADD CONSTRAINT `contrato_productos_ibfk_1` FOREIGN KEY (`id_contrato`) REFERENCES `contratos` (`id`),
  ADD CONSTRAINT `contrato_productos_ibfk_2` FOREIGN KEY (`id_producto`) REFERENCES `productos` (`id`);

--
-- Filtros para la tabla `facturas`
--
ALTER TABLE `facturas`
  ADD CONSTRAINT `facturas_ibfk_1` FOREIGN KEY (`id_contrato`) REFERENCES `contratos` (`id`),
  ADD CONSTRAINT `facturas_ibfk_2` FOREIGN KEY (`id_cliente`) REFERENCES `clientes` (`id`);

--
-- Filtros para la tabla `factura_productos`
--
ALTER TABLE `factura_productos`
  ADD CONSTRAINT `factura_productos_ibfk_1` FOREIGN KEY (`id_factura`) REFERENCES `facturas` (`id`),
  ADD CONSTRAINT `factura_productos_ibfk_2` FOREIGN KEY (`id_producto`) REFERENCES `productos` (`id`);

--
-- Filtros para la tabla `pqr`
--
ALTER TABLE `pqr`
  ADD CONSTRAINT `pqr_ibfk_1` FOREIGN KEY (`id_cliente`) REFERENCES `clientes` (`id`);

--
-- Filtros para la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `usuarios_ibfk_1` FOREIGN KEY (`id_rol`) REFERENCES `roles` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
