-- phpMyAdmin SQL Dump
-- version 4.5.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: May 28, 2016 at 09:05 PM
-- Server version: 10.1.11-MariaDB
-- PHP Version: 7.0.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `expo`
--

-- --------------------------------------------------------

--
-- Table structure for table `acciones`
--

CREATE TABLE `acciones` (
  `Id_accion` int(11) NOT NULL,
  `accion` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `bitacoras`
--

CREATE TABLE `bitacoras` (
  `Id_bitacora` int(11) NOT NULL,
  `Id_accion` int(11) NOT NULL,
  `descripcion` varchar(140) NOT NULL,
  `Id_personal` int(11) NOT NULL,
  `fechaBitacora` date NOT NULL,
  `horaBitacora` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `blogs`
--

CREATE TABLE `blogs` (
  `Id_blog` int(11) NOT NULL,
  `titulo` varchar(35) NOT NULL,
  `encabezado` varchar(200) NOT NULL,
  `cuerpo` varchar(5000) NOT NULL,
  `fehcaIngreso` date NOT NULL,
  `horaIngreso` time NOT NULL,
  `estadoBlog` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `calificaciones`
--

CREATE TABLE `calificaciones` (
  `Id_calificacion` int(11) NOT NULL,
  `calificacion` tinyint(1) NOT NULL,
  `Id_producto` int(11) NOT NULL,
  `Id_cliente` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `cargos`
--

CREATE TABLE `cargos` (
  `Id_cargo` int(11) NOT NULL,
  `cargos` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cargos`
--

INSERT INTO `cargos` (`Id_cargo`, `cargos`) VALUES
(1, 'administrador');

-- --------------------------------------------------------

--
-- Table structure for table `carritos`
--

CREATE TABLE `carritos` (
  `Id_carrito` int(11) NOT NULL,
  `Id_producto` int(11) NOT NULL,
  `Id_cliente` int(11) NOT NULL,
  `cantidadCarrito` int(11) NOT NULL,
  `estadoCarrito` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `categorias`
--

CREATE TABLE `categorias` (
  `Id_categoria` int(11) NOT NULL,
  `categoria` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `clientes`
--

CREATE TABLE `clientes` (
  `Id_cliente` int(11) NOT NULL,
  `nombreCliente` varchar(25) NOT NULL,
  `apellidoCliente` varchar(25) NOT NULL,
  `correo_cliente` varchar(150) NOT NULL,
  `usuario` varchar(100) NOT NULL,
  `contraCliente` varchar(200) NOT NULL,
  `fechaIngreso` date NOT NULL,
  `horaIngreso` time NOT NULL,
  `estadoCliente` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `contactocliente`
--

CREATE TABLE `contactocliente` (
  `Id_contactoCliente` int(11) NOT NULL,
  `contactoCliente` varchar(140) NOT NULL,
  `Id_tipoContacto` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `contactopersonal`
--

CREATE TABLE `contactopersonal` (
  `Id_contactopersonal` int(11) NOT NULL,
  `Id_tipoContacto` int(11) NOT NULL,
  `contactoPersonal` varchar(140) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `cotizaciones`
--

CREATE TABLE `cotizaciones` (
  `Id_cotizacion` int(11) NOT NULL,
  `Id_cliente` int(11) NOT NULL,
  `imagenCotizacion` varchar(200) DEFAULT NULL,
  `cotizacion` varchar(1000) NOT NULL,
  `estadoCotizacion` tinyint(1) NOT NULL DEFAULT '1',
  `horaIngreso` time NOT NULL,
  `fechaIngreso` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `facturas`
--

CREATE TABLE `facturas` (
  `Id_factura` int(11) NOT NULL,
  `Id_carrito` int(11) NOT NULL,
  `fechaCompra` date NOT NULL,
  `horaCompra` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `immagenproductos`
--

CREATE TABLE `immagenproductos` (
  `Id_imagenProducto` int(11) NOT NULL,
  `imagemProducto` varchar(200) NOT NULL,
  `prioridad` tinyint(1) DEFAULT '1',
  `Id_producto` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `inventarios`
--

CREATE TABLE `inventarios` (
  `Id_inventario` int(11) NOT NULL,
  `material` varchar(35) NOT NULL,
  `cantidadMaterial` int(11) NOT NULL,
  `precioMaterial` decimal(10,2) NOT NULL,
  `fechaIngreso` date NOT NULL,
  `horaIngreso` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `modulos`
--

CREATE TABLE `modulos` (
  `Id_modulo` int(11) NOT NULL,
  `permiso` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `modulos`
--

INSERT INTO `modulos` (`Id_modulo`, `permiso`) VALUES
(2, 'Administrar Blog'),
(3, 'Recursos Humanos'),
(1, 'super Usuario');

-- --------------------------------------------------------

--
-- Table structure for table `notaspedidos`
--

CREATE TABLE `notaspedidos` (
  `Id_nota` int(11) NOT NULL,
  `notaPedido` varchar(500) NOT NULL,
  `Id_pedido` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `pedidos`
--

CREATE TABLE `pedidos` (
  `Id_pedido` int(11) NOT NULL,
  `Id_carrito` int(11) NOT NULL,
  `fechaEntrega` date NOT NULL,
  `fechaInicio` date NOT NULL,
  `Id_personal` int(11) NOT NULL,
  `estadoPedido` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `permisos`
--

CREATE TABLE `permisos` (
  `Id_permiso` int(11) NOT NULL,
  `Id_cargo` int(11) NOT NULL,
  `Id_modulo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `permisos`
--

INSERT INTO `permisos` (`Id_permiso`, `Id_cargo`, `Id_modulo`) VALUES
(1, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `personal`
--

CREATE TABLE `personal` (
  `Id_personal` int(11) NOT NULL,
  `nombrePersonal` varchar(35) NOT NULL,
  `apellidoPersonal` varchar(35) NOT NULL,
  `usuario` varchar(25) NOT NULL,
  `correo_personal` varchar(140) NOT NULL,
  `Id_cargo` int(11) DEFAULT NULL,
  `clave_personal` varchar(400) NOT NULL,
  `fechaIngreso` date NOT NULL,
  `horaIngreso` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `personal`
--

INSERT INTO `personal` (`Id_personal`, `nombrePersonal`, `apellidoPersonal`, `usuario`, `correo_personal`, `Id_cargo`, `clave_personal`, `fechaIngreso`, `horaIngreso`) VALUES
(13, 'Edwin Alberto', 'López Almira', 'EdwinAlmira', 'ealopezalmira@gmail.com', 1, '$2y$10$fLJdXS0SAR8Sguxot1XF3.1IXV799VzmB1sRDFHLdE28QGWZfpCUm', '2016-05-28', '12:19:05');

-- --------------------------------------------------------

--
-- Table structure for table `productos`
--

CREATE TABLE `productos` (
  `Id_producto` int(11) NOT NULL,
  `nombreProdu` varchar(30) NOT NULL,
  `miniDescrip` varchar(35) DEFAULT NULL,
  `descripcion` varchar(500) NOT NULL,
  `precio` decimal(10,2) NOT NULL,
  `Id_subcategoria` int(11) NOT NULL,
  `estadoProducto` tinyint(1) NOT NULL DEFAULT '1',
  `fechaIngreso` date NOT NULL,
  `horaIngreso` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `quienessomos`
--

CREATE TABLE `quienessomos` (
  `Id_quienes` int(11) NOT NULL,
  `mision` varchar(500) NOT NULL,
  `vision` varchar(500) NOT NULL,
  `valores` varchar(500) NOT NULL,
  `objetivos` varchar(500) NOT NULL,
  `servicio` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `subcategorias`
--

CREATE TABLE `subcategorias` (
  `Id_subcategoria` int(11) NOT NULL,
  `subcategoria` varchar(20) NOT NULL,
  `Id_categoria` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tipocontacto`
--

CREATE TABLE `tipocontacto` (
  `Id_tipoContacto` int(11) NOT NULL,
  `tipoContacto` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `acciones`
--
ALTER TABLE `acciones`
  ADD PRIMARY KEY (`Id_accion`),
  ADD UNIQUE KEY `accion` (`accion`);

--
-- Indexes for table `bitacoras`
--
ALTER TABLE `bitacoras`
  ADD PRIMARY KEY (`Id_bitacora`),
  ADD KEY `Id_accion` (`Id_accion`),
  ADD KEY `Id_personal` (`Id_personal`);

--
-- Indexes for table `blogs`
--
ALTER TABLE `blogs`
  ADD PRIMARY KEY (`Id_blog`),
  ADD UNIQUE KEY `titulo` (`titulo`),
  ADD UNIQUE KEY `encabezado` (`encabezado`);

--
-- Indexes for table `calificaciones`
--
ALTER TABLE `calificaciones`
  ADD PRIMARY KEY (`Id_calificacion`),
  ADD KEY `Id_cliente` (`Id_cliente`),
  ADD KEY `Id_producto` (`Id_producto`);

--
-- Indexes for table `cargos`
--
ALTER TABLE `cargos`
  ADD PRIMARY KEY (`Id_cargo`),
  ADD UNIQUE KEY `cargos` (`cargos`);

--
-- Indexes for table `carritos`
--
ALTER TABLE `carritos`
  ADD PRIMARY KEY (`Id_carrito`),
  ADD KEY `Id_producto` (`Id_producto`),
  ADD KEY `Id_cliente` (`Id_cliente`);

--
-- Indexes for table `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`Id_categoria`),
  ADD UNIQUE KEY `categoria` (`categoria`);

--
-- Indexes for table `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`Id_cliente`);

--
-- Indexes for table `contactocliente`
--
ALTER TABLE `contactocliente`
  ADD PRIMARY KEY (`Id_contactoCliente`),
  ADD UNIQUE KEY `contactoCliente` (`contactoCliente`),
  ADD KEY `Id_tipoContacto` (`Id_tipoContacto`);

--
-- Indexes for table `contactopersonal`
--
ALTER TABLE `contactopersonal`
  ADD PRIMARY KEY (`Id_contactopersonal`),
  ADD UNIQUE KEY `contactoPersonal` (`contactoPersonal`),
  ADD KEY `Id_tipoContacto` (`Id_tipoContacto`);

--
-- Indexes for table `cotizaciones`
--
ALTER TABLE `cotizaciones`
  ADD PRIMARY KEY (`Id_cotizacion`),
  ADD KEY `Id_cliente` (`Id_cliente`);

--
-- Indexes for table `facturas`
--
ALTER TABLE `facturas`
  ADD PRIMARY KEY (`Id_factura`),
  ADD KEY `Id_carrito` (`Id_carrito`);

--
-- Indexes for table `immagenproductos`
--
ALTER TABLE `immagenproductos`
  ADD PRIMARY KEY (`Id_imagenProducto`),
  ADD UNIQUE KEY `imagemProducto` (`imagemProducto`),
  ADD KEY `Id_producto` (`Id_producto`);

--
-- Indexes for table `inventarios`
--
ALTER TABLE `inventarios`
  ADD PRIMARY KEY (`Id_inventario`),
  ADD UNIQUE KEY `material` (`material`);

--
-- Indexes for table `modulos`
--
ALTER TABLE `modulos`
  ADD PRIMARY KEY (`Id_modulo`),
  ADD UNIQUE KEY `permiso` (`permiso`);

--
-- Indexes for table `notaspedidos`
--
ALTER TABLE `notaspedidos`
  ADD PRIMARY KEY (`Id_nota`),
  ADD KEY `Id_pedido` (`Id_pedido`);

--
-- Indexes for table `pedidos`
--
ALTER TABLE `pedidos`
  ADD PRIMARY KEY (`Id_pedido`),
  ADD KEY `Id_carrito` (`Id_carrito`),
  ADD KEY `Id_personal` (`Id_personal`);

--
-- Indexes for table `permisos`
--
ALTER TABLE `permisos`
  ADD PRIMARY KEY (`Id_permiso`),
  ADD KEY `Id_modulo` (`Id_modulo`),
  ADD KEY `Id_cargo` (`Id_cargo`);

--
-- Indexes for table `personal`
--
ALTER TABLE `personal`
  ADD PRIMARY KEY (`Id_personal`),
  ADD UNIQUE KEY `usuario` (`usuario`),
  ADD UNIQUE KEY `correoPersonal` (`correo_personal`),
  ADD KEY `Id_cargo` (`Id_cargo`);

--
-- Indexes for table `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`Id_producto`),
  ADD UNIQUE KEY `nombreProdu` (`nombreProdu`),
  ADD KEY `Id_subcategoria` (`Id_subcategoria`);

--
-- Indexes for table `quienessomos`
--
ALTER TABLE `quienessomos`
  ADD PRIMARY KEY (`Id_quienes`);

--
-- Indexes for table `subcategorias`
--
ALTER TABLE `subcategorias`
  ADD PRIMARY KEY (`Id_subcategoria`),
  ADD UNIQUE KEY `subcategoria` (`subcategoria`),
  ADD KEY `Id_categoria` (`Id_categoria`);

--
-- Indexes for table `tipocontacto`
--
ALTER TABLE `tipocontacto`
  ADD PRIMARY KEY (`Id_tipoContacto`),
  ADD UNIQUE KEY `tipoContacto` (`tipoContacto`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `acciones`
--
ALTER TABLE `acciones`
  MODIFY `Id_accion` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `bitacoras`
--
ALTER TABLE `bitacoras`
  MODIFY `Id_bitacora` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `blogs`
--
ALTER TABLE `blogs`
  MODIFY `Id_blog` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `calificaciones`
--
ALTER TABLE `calificaciones`
  MODIFY `Id_calificacion` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `cargos`
--
ALTER TABLE `cargos`
  MODIFY `Id_cargo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `carritos`
--
ALTER TABLE `carritos`
  MODIFY `Id_carrito` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `categorias`
--
ALTER TABLE `categorias`
  MODIFY `Id_categoria` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `clientes`
--
ALTER TABLE `clientes`
  MODIFY `Id_cliente` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `contactocliente`
--
ALTER TABLE `contactocliente`
  MODIFY `Id_contactoCliente` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `contactopersonal`
--
ALTER TABLE `contactopersonal`
  MODIFY `Id_contactopersonal` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `cotizaciones`
--
ALTER TABLE `cotizaciones`
  MODIFY `Id_cotizacion` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `facturas`
--
ALTER TABLE `facturas`
  MODIFY `Id_factura` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `immagenproductos`
--
ALTER TABLE `immagenproductos`
  MODIFY `Id_imagenProducto` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `inventarios`
--
ALTER TABLE `inventarios`
  MODIFY `Id_inventario` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `modulos`
--
ALTER TABLE `modulos`
  MODIFY `Id_modulo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `notaspedidos`
--
ALTER TABLE `notaspedidos`
  MODIFY `Id_nota` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `pedidos`
--
ALTER TABLE `pedidos`
  MODIFY `Id_pedido` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `permisos`
--
ALTER TABLE `permisos`
  MODIFY `Id_permiso` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `personal`
--
ALTER TABLE `personal`
  MODIFY `Id_personal` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `productos`
--
ALTER TABLE `productos`
  MODIFY `Id_producto` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `quienessomos`
--
ALTER TABLE `quienessomos`
  MODIFY `Id_quienes` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `subcategorias`
--
ALTER TABLE `subcategorias`
  MODIFY `Id_subcategoria` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tipocontacto`
--
ALTER TABLE `tipocontacto`
  MODIFY `Id_tipoContacto` int(11) NOT NULL AUTO_INCREMENT;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `bitacoras`
--
ALTER TABLE `bitacoras`
  ADD CONSTRAINT `bitacoras_ibfk_1` FOREIGN KEY (`Id_accion`) REFERENCES `acciones` (`Id_accion`),
  ADD CONSTRAINT `bitacoras_ibfk_2` FOREIGN KEY (`Id_personal`) REFERENCES `personal` (`Id_personal`);

--
-- Constraints for table `calificaciones`
--
ALTER TABLE `calificaciones`
  ADD CONSTRAINT `calificaciones_ibfk_1` FOREIGN KEY (`Id_cliente`) REFERENCES `clientes` (`Id_cliente`),
  ADD CONSTRAINT `calificaciones_ibfk_2` FOREIGN KEY (`Id_producto`) REFERENCES `productos` (`Id_producto`);

--
-- Constraints for table `carritos`
--
ALTER TABLE `carritos`
  ADD CONSTRAINT `carritos_ibfk_1` FOREIGN KEY (`Id_producto`) REFERENCES `productos` (`Id_producto`),
  ADD CONSTRAINT `carritos_ibfk_2` FOREIGN KEY (`Id_cliente`) REFERENCES `clientes` (`Id_cliente`);

--
-- Constraints for table `contactocliente`
--
ALTER TABLE `contactocliente`
  ADD CONSTRAINT `contactocliente_ibfk_1` FOREIGN KEY (`Id_tipoContacto`) REFERENCES `tipocontacto` (`Id_tipoContacto`);

--
-- Constraints for table `contactopersonal`
--
ALTER TABLE `contactopersonal`
  ADD CONSTRAINT `contactopersonal_ibfk_1` FOREIGN KEY (`Id_tipoContacto`) REFERENCES `tipocontacto` (`Id_tipoContacto`);

--
-- Constraints for table `cotizaciones`
--
ALTER TABLE `cotizaciones`
  ADD CONSTRAINT `cotizaciones_ibfk_1` FOREIGN KEY (`Id_cliente`) REFERENCES `clientes` (`Id_cliente`);

--
-- Constraints for table `facturas`
--
ALTER TABLE `facturas`
  ADD CONSTRAINT `facturas_ibfk_1` FOREIGN KEY (`Id_carrito`) REFERENCES `carritos` (`Id_carrito`);

--
-- Constraints for table `immagenproductos`
--
ALTER TABLE `immagenproductos`
  ADD CONSTRAINT `immagenproductos_ibfk_1` FOREIGN KEY (`Id_producto`) REFERENCES `productos` (`Id_producto`);

--
-- Constraints for table `notaspedidos`
--
ALTER TABLE `notaspedidos`
  ADD CONSTRAINT `notaspedidos_ibfk_1` FOREIGN KEY (`Id_pedido`) REFERENCES `pedidos` (`Id_pedido`);

--
-- Constraints for table `pedidos`
--
ALTER TABLE `pedidos`
  ADD CONSTRAINT `pedidos_ibfk_1` FOREIGN KEY (`Id_carrito`) REFERENCES `carritos` (`Id_carrito`),
  ADD CONSTRAINT `pedidos_ibfk_2` FOREIGN KEY (`Id_personal`) REFERENCES `personal` (`Id_personal`);

--
-- Constraints for table `permisos`
--
ALTER TABLE `permisos`
  ADD CONSTRAINT `permisos_ibfk_1` FOREIGN KEY (`Id_modulo`) REFERENCES `modulos` (`Id_modulo`),
  ADD CONSTRAINT `permisos_ibfk_2` FOREIGN KEY (`Id_cargo`) REFERENCES `cargos` (`Id_cargo`);

--
-- Constraints for table `personal`
--
ALTER TABLE `personal`
  ADD CONSTRAINT `personal_ibfk_1` FOREIGN KEY (`Id_cargo`) REFERENCES `cargos` (`Id_cargo`);

--
-- Constraints for table `productos`
--
ALTER TABLE `productos`
  ADD CONSTRAINT `productos_ibfk_1` FOREIGN KEY (`Id_subcategoria`) REFERENCES `subcategorias` (`Id_subcategoria`);

--
-- Constraints for table `subcategorias`
--
ALTER TABLE `subcategorias`
  ADD CONSTRAINT `subcategorias_ibfk_1` FOREIGN KEY (`Id_categoria`) REFERENCES `categorias` (`Id_categoria`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
