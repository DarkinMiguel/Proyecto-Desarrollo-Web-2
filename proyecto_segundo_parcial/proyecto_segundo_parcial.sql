-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost
-- Tiempo de generación: 04-02-2026 a las 05:30:07
-- Versión del servidor: 12.0.2-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `proyecto_segundo_parcial`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `compras`
--

CREATE TABLE `compras` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `producto_id` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `precio` decimal(10,2) NOT NULL,
  `fecha` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `compras`
--

INSERT INTO `compras` (`id`, `user_id`, `producto_id`, `cantidad`, `precio`, `fecha`) VALUES
(21, 4, 3, 1, 264.96, '2026-02-04 03:43:54'),
(22, 4, 4, 1, 185.99, '2026-02-04 03:43:55'),
(23, 4, 4, 1, 185.99, '2026-02-04 03:43:57');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ordenes`
--

CREATE TABLE `ordenes` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `total` decimal(10,2) NOT NULL,
  `metodo_pago` varchar(50) NOT NULL,
  `fecha` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `ordenes`
--

INSERT INTO `ordenes` (`id`, `nombre`, `email`, `total`, `metodo_pago`, `fecha`) VALUES
(1, 'ss', 'user2@user.com', 240.00, 'transferencia', '2026-02-04 02:33:48'),
(2, 'ss', 'user1@user.com', 570.00, 'transferencia', '2026-02-04 02:36:39'),
(3, 'ss', 'user2@user.com', 120.00, 'transferencia', '2026-02-04 02:38:54'),
(4, 'ss', 'user2@user.com', 570.00, 'transferencia', '2026-02-04 02:40:20'),
(5, 'ss', 'user2@user.com', 1206.94, 'transferencia', '2026-02-04 02:44:59'),
(6, 'ss', 'user2@user.com', 1086.94, 'transferencia', '2026-02-04 02:48:48'),
(7, 'ss', 'user2@user.com', 900.95, 'transferencia', '2026-02-04 02:53:16'),
(8, 'miguel', 'user2@user.com', 1164.96, 'transferencia', '2026-02-04 03:34:52'),
(9, 'ss', 'user2@user.com', 1087.89, 'transferencia', '2026-02-04 03:44:11');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `id` int(11) NOT NULL,
  `nombre` varchar(150) NOT NULL,
  `precio` decimal(10,2) NOT NULL,
  `imagen` varchar(255) NOT NULL,
  `stock` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`id`, `nombre`, `precio`, `imagen`, `stock`) VALUES
(1, 'Procesador Intel i9 14900K', 450.00, 'producto1.webp', 4),
(2, 'Case Gaming Corsair 3500X', 120.00, 'producto2.webp', 3),
(3, 'ASUS DUAL RTX 3050 6GB OC', 264.96, 'producto3.webp', 2),
(4, 'Water Cooler Antec Symphony 360', 185.99, 'producto4.webp', 3),
(5, 'Notebook ASUS ROG Strix Scar 18', 185.99, 'producto5.webp', 1),
(6, 'Monitor Gigabyte GS27QA 27\" QHD', 185.99, 'producto6.webp', 5),
(7, 'EcoFlow River 2 Max', 448.18, 'producto7.webp', 2),
(8, 'RAM Kingston Fury Beast 32GB DDR5', 171.38, 'producto8.webp', 10),
(9, 'SSD Kingston Fury Renegade G5 1TB', 185.99, 'producto9.webp', 7);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `registro`
--

CREATE TABLE `registro` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `telefono` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `direccion` varchar(255) DEFAULT NULL,
  `telefono` varchar(20) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `direccion`, `telefono`, `password`, `created_at`) VALUES
(1, 'admin', 'admin@example.com', 'quito', '099999', '123456', '2026-02-03 01:44:30'),
(2, 'migue', 'moraaaa@a.com', 'plaza quil', '099999', '123456', '2026-02-03 03:17:10'),
(3, 'user1', 'user1@user.com', 'quitoec', '099999', '12345678', '2026-02-03 03:19:02'),
(4, 'user2', 'user2@user.com', 'la alborada', '01977', '1234', '2026-02-03 04:01:26');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `compras`
--
ALTER TABLE `compras`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `producto_id` (`producto_id`);

--
-- Indices de la tabla `ordenes`
--
ALTER TABLE `ordenes`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `registro`
--
ALTER TABLE `registro`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `compras`
--
ALTER TABLE `compras`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT de la tabla `ordenes`
--
ALTER TABLE `ordenes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `registro`
--
ALTER TABLE `registro`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `compras`
--
ALTER TABLE `compras`
  ADD CONSTRAINT `compras_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `compras_ibfk_2` FOREIGN KEY (`producto_id`) REFERENCES `productos` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
