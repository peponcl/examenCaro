-- phpMyAdmin SQL Dump
-- version 4.3.11
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 11-07-2015 a las 20:05:55
-- Versión del servidor: 5.6.24
-- Versión de PHP: 5.6.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `importadora_db`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_oc`
--

CREATE TABLE IF NOT EXISTS `detalle_oc` (
  `id_oc` int(11) NOT NULL,
  `id_producto` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `sub_total` int(11) NOT NULL,
  `orden_compras_id_oc` int(11) NOT NULL,
  `orden_compras_usuarios_id_usuario` int(11) NOT NULL,
  `productos_id_producto` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `orden_compras`
--

CREATE TABLE IF NOT EXISTS `orden_compras` (
  `id_oc` int(11) NOT NULL,
  `fecha_emision` date DEFAULT NULL,
  `total_oc` int(11) DEFAULT NULL,
  `estado` varchar(45) COLLATE latin1_spanish_ci NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `usuarios_id_usuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `perfil`
--

CREATE TABLE IF NOT EXISTS `perfil` (
  `id_perfil` int(11) NOT NULL,
  `descripcion_perfil` varchar(45) COLLATE latin1_spanish_ci NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Volcado de datos para la tabla `perfil`
--

INSERT INTO `perfil` (`id_perfil`, `descripcion_perfil`) VALUES
(1, 'administrador'),
(2, 'consulta'),
(3, 'vendedor');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE IF NOT EXISTS `productos` (
  `id_producto` int(11) NOT NULL,
  `descripcion` varchar(45) COLLATE latin1_spanish_ci NOT NULL,
  `precio` int(11) DEFAULT NULL,
  `unidad` int(11) DEFAULT NULL,
  `id_tipo` int(11) NOT NULL,
  `tipo_producto_id_tipoProducto` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_producto`
--

CREATE TABLE IF NOT EXISTS `tipo_producto` (
  `id_tipoProducto` int(11) NOT NULL,
  `descripcion_tipo` varchar(45) COLLATE latin1_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE IF NOT EXISTS `usuarios` (
  `id_usuario` int(11) NOT NULL,
  `login_usuario` varchar(45) COLLATE latin1_spanish_ci NOT NULL,
  `pass_usuario` varchar(45) COLLATE latin1_spanish_ci NOT NULL,
  `nombre_usuario` varchar(45) COLLATE latin1_spanish_ci NOT NULL,
  `correo_usuario` varchar(45) COLLATE latin1_spanish_ci DEFAULT NULL,
  `edad_usuario` int(11) DEFAULT NULL,
  `id_perfil` int(11) NOT NULL,
  `fechaNacimiento_usuario` date DEFAULT NULL,
  `perfil_id_perfil` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id_usuario`, `login_usuario`, `pass_usuario`, `nombre_usuario`, `correo_usuario`, `edad_usuario`, `id_perfil`, `fechaNacimiento_usuario`, `perfil_id_perfil`) VALUES
(2, 'admin', '81dc9bdb52d04dc20036dbd8313ed055', 'admin importadora', 'admin@lotenemostodo.cl', 27, 1, '1987-09-23', 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `detalle_oc`
--
ALTER TABLE `detalle_oc`
  ADD PRIMARY KEY (`id_oc`,`id_producto`,`orden_compras_id_oc`,`orden_compras_usuarios_id_usuario`,`productos_id_producto`), ADD KEY `fk_detalle_oc_orden_compras1_idx` (`orden_compras_id_oc`,`orden_compras_usuarios_id_usuario`), ADD KEY `fk_detalle_oc_productos1_idx` (`productos_id_producto`);

--
-- Indices de la tabla `orden_compras`
--
ALTER TABLE `orden_compras`
  ADD PRIMARY KEY (`id_oc`,`usuarios_id_usuario`), ADD KEY `fk_orden_compras_usuarios_idx` (`usuarios_id_usuario`);

--
-- Indices de la tabla `perfil`
--
ALTER TABLE `perfil`
  ADD PRIMARY KEY (`id_perfil`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`id_producto`,`tipo_producto_id_tipoProducto`), ADD KEY `fk_productos_tipo_producto1_idx` (`tipo_producto_id_tipoProducto`);

--
-- Indices de la tabla `tipo_producto`
--
ALTER TABLE `tipo_producto`
  ADD PRIMARY KEY (`id_tipoProducto`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id_usuario`,`perfil_id_perfil`), ADD KEY `fk_usuarios_perfil1_idx` (`perfil_id_perfil`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `orden_compras`
--
ALTER TABLE `orden_compras`
  MODIFY `id_oc` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `perfil`
--
ALTER TABLE `perfil`
  MODIFY `id_perfil` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `id_producto` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `tipo_producto`
--
ALTER TABLE `tipo_producto`
  MODIFY `id_tipoProducto` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `detalle_oc`
--
ALTER TABLE `detalle_oc`
ADD CONSTRAINT `fk_detalle_oc_orden_compras1` FOREIGN KEY (`orden_compras_id_oc`, `orden_compras_usuarios_id_usuario`) REFERENCES `orden_compras` (`id_oc`, `usuarios_id_usuario`) ON DELETE NO ACTION ON UPDATE NO ACTION,
ADD CONSTRAINT `fk_detalle_oc_productos1` FOREIGN KEY (`productos_id_producto`) REFERENCES `productos` (`id_producto`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `orden_compras`
--
ALTER TABLE `orden_compras`
ADD CONSTRAINT `fk_orden_compras_usuarios` FOREIGN KEY (`usuarios_id_usuario`) REFERENCES `usuarios` (`id_usuario`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `productos`
--
ALTER TABLE `productos`
ADD CONSTRAINT `fk_productos_tipo_producto1` FOREIGN KEY (`tipo_producto_id_tipoProducto`) REFERENCES `tipo_producto` (`id_tipoProducto`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `usuarios`
--
ALTER TABLE `usuarios`
ADD CONSTRAINT `fk_usuarios_perfil1` FOREIGN KEY (`perfil_id_perfil`) REFERENCES `perfil` (`id_perfil`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
