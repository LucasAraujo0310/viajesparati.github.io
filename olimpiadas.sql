-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jun 13, 2025 at 01:09 PM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `olimpiadas`
--

-- --------------------------------------------------------

--
-- Table structure for table `aerolineas`
--

CREATE TABLE `aerolineas` (
  `id` int NOT NULL,
  `nombre` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `precio` decimal(20,0) NOT NULL,
  `descripcion` text COLLATE utf8mb4_general_ci NOT NULL,
  `lugar` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `salida` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `imagen` varchar(1000) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `alquilerauto`
--

CREATE TABLE `alquilerauto` (
  `id` int NOT NULL,
  `nombre` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `precio` decimal(10,2) NOT NULL,
  `lugar` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `descripcion` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `imagen` varchar(1000) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `clientes`
--

CREATE TABLE `clientes` (
  `cliente_id` int NOT NULL,
  `nombre` varchar(25) COLLATE utf8mb4_general_ci NOT NULL,
  `correo electronico` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `contraseña` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `telefono` varchar(20) COLLATE utf8mb4_general_ci NOT NULL,
  `fecha de alta` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `detallepedidos`
--

CREATE TABLE `detallepedidos` (
  `detalle_id` int NOT NULL,
  `pedido_id` int NOT NULL,
  `producto_id` int NOT NULL,
  `cantidad` int NOT NULL,
  `precio_unitario` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `inicio_sesion`
--

CREATE TABLE `inicio_sesion` (
  `id_usuario` int NOT NULL,
  `nombre` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `correo_electronico` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `usuario` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `contraseña` varchar(255) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `mailsenviados`
--

CREATE TABLE `mailsenviados` (
  `mail_id` int NOT NULL,
  `destinatario` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `asunto` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `cuerpo` text COLLATE utf8mb4_general_ci NOT NULL,
  `fecha_envio` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `paqueteproductos`
--

CREATE TABLE `paqueteproductos` (
  `paquete_id` int NOT NULL,
  `producto_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pedidohistorial`
--

CREATE TABLE `pedidohistorial` (
  `historial_id` int NOT NULL,
  `pedido_id` int NOT NULL,
  `fecha de entrega` date NOT NULL,
  `total cobrado` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pedidos`
--

CREATE TABLE `pedidos` (
  `pedido_id` int NOT NULL,
  `cliente_id` int NOT NULL,
  `fecha_pedido` datetime(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `productos`
--

CREATE TABLE `productos` (
  `producto_id` int NOT NULL,
  `codigo_producto` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `descripcion` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `tipo_producto` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `precio_unitario` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `servicio completo`
--

CREATE TABLE `servicio completo` (
  `id` int NOT NULL,
  `nombre` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `precio` decimal(10,2) NOT NULL,
  `lugar` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `descripcion` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `imagen` varchar(1000) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `usuariosinternos`
--

CREATE TABLE `usuariosinternos` (
  `usuario_id` int NOT NULL,
  `nombre` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `correo electronico` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `contraseña` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `rol` varchar(50) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `aerolineas`
--
ALTER TABLE `aerolineas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `alquilerauto`
--
ALTER TABLE `alquilerauto`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`cliente_id`),
  ADD UNIQUE KEY `correo electronico` (`correo electronico`);

--
-- Indexes for table `detallepedidos`
--
ALTER TABLE `detallepedidos`
  ADD PRIMARY KEY (`detalle_id`),
  ADD UNIQUE KEY `pedido_id` (`pedido_id`),
  ADD UNIQUE KEY `producto_id` (`producto_id`);

--
-- Indexes for table `inicio_sesion`
--
ALTER TABLE `inicio_sesion`
  ADD PRIMARY KEY (`id_usuario`),
  ADD UNIQUE KEY `correo_electronico` (`correo_electronico`),
  ADD UNIQUE KEY `usuario` (`usuario`);

--
-- Indexes for table `mailsenviados`
--
ALTER TABLE `mailsenviados`
  ADD PRIMARY KEY (`mail_id`),
  ADD UNIQUE KEY `destinatario` (`destinatario`);

--
-- Indexes for table `paqueteproductos`
--
ALTER TABLE `paqueteproductos`
  ADD PRIMARY KEY (`paquete_id`),
  ADD UNIQUE KEY `producto_id` (`producto_id`);

--
-- Indexes for table `pedidohistorial`
--
ALTER TABLE `pedidohistorial`
  ADD PRIMARY KEY (`historial_id`),
  ADD UNIQUE KEY `pedido_id` (`pedido_id`);

--
-- Indexes for table `pedidos`
--
ALTER TABLE `pedidos`
  ADD PRIMARY KEY (`pedido_id`),
  ADD UNIQUE KEY `cliente_id` (`cliente_id`);

--
-- Indexes for table `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`producto_id`);

--
-- Indexes for table `servicio completo`
--
ALTER TABLE `servicio completo`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `usuariosinternos`
--
ALTER TABLE `usuariosinternos`
  ADD PRIMARY KEY (`usuario_id`),
  ADD UNIQUE KEY `correo electronico` (`correo electronico`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `aerolineas`
--
ALTER TABLE `aerolineas`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `alquilerauto`
--
ALTER TABLE `alquilerauto`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `clientes`
--
ALTER TABLE `clientes`
  MODIFY `cliente_id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `detallepedidos`
--
ALTER TABLE `detallepedidos`
  MODIFY `detalle_id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `inicio_sesion`
--
ALTER TABLE `inicio_sesion`
  MODIFY `id_usuario` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `mailsenviados`
--
ALTER TABLE `mailsenviados`
  MODIFY `mail_id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `paqueteproductos`
--
ALTER TABLE `paqueteproductos`
  MODIFY `paquete_id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pedidohistorial`
--
ALTER TABLE `pedidohistorial`
  MODIFY `historial_id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pedidos`
--
ALTER TABLE `pedidos`
  MODIFY `pedido_id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `productos`
--
ALTER TABLE `productos`
  MODIFY `producto_id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `servicio completo`
--
ALTER TABLE `servicio completo`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `usuariosinternos`
--
ALTER TABLE `usuariosinternos`
  MODIFY `usuario_id` int NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `aerolineas`
--
ALTER TABLE `aerolineas`
  ADD CONSTRAINT `aerolineas_ibfk_1` FOREIGN KEY (`id`) REFERENCES `alquilerauto` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `alquilerauto`
--
ALTER TABLE `alquilerauto`
  ADD CONSTRAINT `alquilerauto_ibfk_1` FOREIGN KEY (`id`) REFERENCES `servicio completo` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `clientes`
--
ALTER TABLE `clientes`
  ADD CONSTRAINT `clientes_ibfk_1` FOREIGN KEY (`correo electronico`) REFERENCES `mailsenviados` (`destinatario`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `clientes_ibfk_2` FOREIGN KEY (`cliente_id`) REFERENCES `pedidos` (`cliente_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `detallepedidos`
--
ALTER TABLE `detallepedidos`
  ADD CONSTRAINT `detallepedidos_ibfk_1` FOREIGN KEY (`producto_id`) REFERENCES `productos` (`producto_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `inicio_sesion`
--
ALTER TABLE `inicio_sesion`
  ADD CONSTRAINT `inicio_sesion_ibfk_1` FOREIGN KEY (`correo_electronico`) REFERENCES `mailsenviados` (`destinatario`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `pedidohistorial`
--
ALTER TABLE `pedidohistorial`
  ADD CONSTRAINT `pedidohistorial_ibfk_1` FOREIGN KEY (`pedido_id`) REFERENCES `pedidos` (`pedido_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `pedidos`
--
ALTER TABLE `pedidos`
  ADD CONSTRAINT `pedidos_ibfk_1` FOREIGN KEY (`pedido_id`) REFERENCES `detallepedidos` (`pedido_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `productos`
--
ALTER TABLE `productos`
  ADD CONSTRAINT `productos_ibfk_1` FOREIGN KEY (`producto_id`) REFERENCES `paqueteproductos` (`producto_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `usuariosinternos`
--
ALTER TABLE `usuariosinternos`
  ADD CONSTRAINT `usuariosinternos_ibfk_1` FOREIGN KEY (`correo electronico`) REFERENCES `mailsenviados` (`destinatario`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
