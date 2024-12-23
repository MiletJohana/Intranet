-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 23-12-2024 a las 09:40:09
-- Versión del servidor: 10.0.38-MariaDB-cll-lve
-- Versión de PHP: 8.1.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `masterqu_intranet`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `act_economica`
--

CREATE TABLE `act_economica` (
  `id_act` int(11) NOT NULL,
  `cod_act` int(90) DEFAULT NULL COMMENT 'Codigo',
  `nom_act` varchar(90) DEFAULT NULL COMMENT 'Nombre actividad económica'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `agen_comerciales`
--

CREATE TABLE `agen_comerciales` (
  `id_agen` int(11) NOT NULL,
  `id_cli` varchar(45) NOT NULL COMMENT 'Nit o cedula del cliente',
  `dir_cli` varchar(60) DEFAULT NULL COMMENT 'Dirección cliente',
  `nom_con` varchar(60) DEFAULT NULL COMMENT 'Contacto de la empresa',
  `eml_con` varchar(50) DEFAULT NULL COMMENT 'Correo electrónico de Contacto',
  `carg_con` varchar(30) DEFAULT NULL COMMENT 'Cargo de Contacto',
  `tel_con` int(20) DEFAULT NULL,
  `id_usu` varchar(45) NOT NULL COMMENT 'Agente que realiza la visita',
  `concl_agen` varchar(10000) DEFAULT NULL COMMENT 'Conclusiones de la visita',
  `obs_agen` varchar(10000) DEFAULT NULL COMMENT 'Observación del agente que realiza visita',
  `id_raz` int(11) NOT NULL COMMENT 'Id de razón de visita',
  `id_est` int(11) DEFAULT NULL COMMENT 'Estado del visita',
  `fec_cre` datetime DEFAULT NULL,
  `fec_fin` datetime DEFAULT NULL,
  `lat_ini` varchar(20) DEFAULT NULL,
  `lon_ini` varchar(20) DEFAULT NULL,
  `lat_fin` varchar(80) DEFAULT NULL,
  `lon_fin` varchar(20) DEFAULT NULL,
  `id_sac` varchar(45) DEFAULT NULL,
  `id_tipcli` int(11) DEFAULT NULL COMMENT 'tipo de cliente ',
  `id_llam` int(11) DEFAULT NULL COMMENT 'id de la llamada'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `agen_est`
--

CREATE TABLE `agen_est` (
  `id_est` int(11) NOT NULL,
  `nom_est` varchar(15) CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `agen_perfil`
--

CREATE TABLE `agen_perfil` (
  `id_perf` int(11) NOT NULL,
  `nom_perf` varchar(30) CHARACTER SET utf8 DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `agen_raz`
--

CREATE TABLE `agen_raz` (
  `id_raz` int(11) NOT NULL,
  `nom_raz` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `agen_tipclie`
--

CREATE TABLE `agen_tipclie` (
  `id_tipcli` int(11) NOT NULL,
  `nom_tipcli` varchar(60) DEFAULT NULL COMMENT 'tipo de cliente'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `agen_tip_llamada`
--

CREATE TABLE `agen_tip_llamada` (
  `id_llam` int(11) NOT NULL COMMENT 'id llamada',
  `nom_llamada` varchar(70) DEFAULT NULL COMMENT 'nombre de llamada'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `capacitaciones_view`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `capacitaciones_view` (
`id_cap` int(11)
,`fue_cap` varchar(30)
,`lug_cap` varchar(30)
,`tip_cap` varchar(30)
,`obj_cap` varchar(40)
,`tem_cap` varchar(50)
,`resp_cap` varchar(40)
,`nom_are` varchar(45)
,`fec_cap` date
,`eva_cap` varchar(30)
,`met_cap` varchar(30)
,`real_cap` varchar(30)
,`nom_usu` varchar(10000)
);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cat_clientes`
--

CREATE TABLE `cat_clientes` (
  `id_cat` int(11) NOT NULL,
  `nom_cat` varchar(90) CHARACTER SET utf8 DEFAULT NULL COMMENT 'Nombre de categoria cliente'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cat_x_cont_andi`
--

CREATE TABLE `cat_x_cont_andi` (
  `id_cat` int(11) DEFAULT NULL,
  `id_cont` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cat_x_neg`
--

CREATE TABLE `cat_x_neg` (
  `id_cat` int(11) DEFAULT NULL,
  `id_neg` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `certificados_view`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `certificados_view` (
`id_cert` int(11)
,`id_usu` varchar(45)
,`id_carg` int(11)
,`nom_usu` varchar(10000)
,`fec_creacion` date
,`cer_salario` varchar(30)
,`cer_varia` varchar(30)
,`cer_rodam` varchar(30)
,`cer_sinsal` varchar(30)
,`lugar_remi` varchar(45)
);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `certiPersonal_view`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `certiPersonal_view` (
`id_usu` varchar(45)
,`nom_usu` varchar(10000)
,`nom_carg` varchar(2000)
,`fec_firm` date
,`fec_ret` date
,`tip_contrato` varchar(45)
);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ciudades`
--

CREATE TABLE `ciudades` (
  `id_ciu` int(11) NOT NULL COMMENT 'Identificador',
  `nom_ciu` varchar(45) DEFAULT NULL COMMENT 'Nombre ciudad'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `clientes_view`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `clientes_view` (
`id_cli` int(11)
,`tip_doc` varchar(5)
,`num_doc` varchar(45)
,`nom_cli` varchar(100)
,`tel_cli` varchar(60)
,`eml_cli` varchar(45)
,`dir_cli` varchar(90)
,`web_cli` varchar(90)
,`id_tipo` int(11)
,`fec_crea` datetime
,`id_ciu` int(11)
,`nom_usu` varchar(10000)
,`nom_ase` varchar(10000)
,`nom_sac` varchar(10000)
);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `contactos`
--

CREATE TABLE `contactos` (
  `id_cont` int(11) NOT NULL COMMENT 'Identificador',
  `id_cli` int(11) DEFAULT NULL COMMENT 'Cliente relacionado',
  `nom_cont` varchar(100) CHARACTER SET utf8 DEFAULT NULL COMMENT 'Nombre del contacto',
  `eml_cont` varchar(90) CHARACTER SET utf8 DEFAULT NULL COMMENT 'Correo del contacto',
  `car_cont` varchar(90) CHARACTER SET utf8 DEFAULT NULL COMMENT 'Cargo del contacto',
  `tel_cont` varchar(40) CHARACTER SET utf8 DEFAULT NULL COMMENT 'Teléfono del contacto',
  `tel_con2` varchar(40) CHARACTER SET utf8 DEFAULT NULL COMMENT 'Teléfono2 del contacto',
  `cont_desh` varchar(10) CHARACTER SET utf8 DEFAULT 'No' COMMENT 'Contacto deshabilitado',
  `id_usu` varchar(20) CHARACTER SET utf8 DEFAULT NULL COMMENT 'Usuario que registra el contacto',
  `fec_crea` datetime DEFAULT CURRENT_TIMESTAMP COMMENT 'Fecha de creación'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `contactos1`
--

CREATE TABLE `contactos1` (
  `id_cont` int(11) NOT NULL COMMENT 'Identificador',
  `id_cli` int(11) DEFAULT NULL COMMENT 'Cliente relacionado',
  `nom_cont` varchar(100) CHARACTER SET utf8 DEFAULT NULL COMMENT 'Nombre del contacto',
  `eml_cont` varchar(90) CHARACTER SET utf8 DEFAULT NULL COMMENT 'Correo del contacto',
  `car_cont` varchar(90) CHARACTER SET utf8 DEFAULT NULL COMMENT 'Cargo del contacto',
  `tel_cont` varchar(40) CHARACTER SET utf8 DEFAULT NULL COMMENT 'Teléfono del contacto',
  `tel_con2` varchar(40) CHARACTER SET utf8 DEFAULT NULL COMMENT 'Teléfono2 del contacto',
  `cont_desh` varchar(10) CHARACTER SET utf8 DEFAULT 'No' COMMENT 'Contacto deshabilitado',
  `id_usu` varchar(20) CHARACTER SET utf8 DEFAULT NULL COMMENT 'Usuario que registra el contacto',
  `fec_crea` datetime DEFAULT CURRENT_TIMESTAMP COMMENT 'Fecha de creación'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `contactos_andi`
--

CREATE TABLE `contactos_andi` (
  `id_cont` int(11) NOT NULL COMMENT 'Id contacto andi',
  `nom_cont` varchar(60) DEFAULT NULL COMMENT 'Nombre del contacto',
  `eml_cont` varchar(50) DEFAULT NULL COMMENT 'Email contacto',
  `car_cont` varchar(50) DEFAULT NULL COMMENT 'Cargo contacto',
  `tel_cont` varchar(50) DEFAULT NULL COMMENT 'Telefono contacto',
  `nom_cli` varchar(60) DEFAULT NULL COMMENT 'Nombre cliente',
  `comentarios` longtext COMMENT 'Comentarios'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `contactos_view`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `contactos_view` (
`id_cont` int(11)
,`id_cli` int(11)
,`nom_cont` varchar(100)
,`eml_cont` varchar(90)
,`car_cont` varchar(90)
,`tel_cont` varchar(40)
,`tel_con2` varchar(40)
,`cont_desh` varchar(10)
,`id_usu` varchar(20)
,`fec_crea` datetime
,`nom_cli` varchar(100)
,`num_doc` varchar(45)
);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `correspondencias`
--

CREATE TABLE `correspondencias` (
  `id_seg` int(11) NOT NULL,
  `id_prove` int(60) DEFAULT NULL,
  `fech_cre` date DEFAULT NULL COMMENT 'Fecha de Creación',
  `fech_ini` date DEFAULT NULL COMMENT 'fecha inicial que  recibe el documento',
  `fech_fin` datetime DEFAULT NULL COMMENT 'fecha final que se entrega el documento',
  `id_nom` int(11) DEFAULT NULL COMMENT 'id del nombre del documento ',
  `fec_ven` date DEFAULT NULL COMMENT 'fecha de vencimiento del documento',
  `my_process` varchar(30) DEFAULT NULL COMMENT 'documento registrado en myprocess',
  `id_usu` varchar(45) DEFAULT NULL,
  `id_reg` int(11) DEFAULT NULL,
  `num_facR` varchar(300) DEFAULT NULL COMMENT 'numero de la factura real',
  `id_rol` varchar(100) DEFAULT NULL,
  `id_bodeg` varchar(11) DEFAULT NULL,
  `conse_fac` varchar(30) DEFAULT NULL COMMENT 'consecutivo de la factura en my process',
  `area_remit` varchar(30) DEFAULT NULL COMMENT 'area a donde se va a remitir el  documento',
  `sub_tota` varchar(30) DEFAULT NULL COMMENT 'subtotal',
  `iva` varchar(30) DEFAULT NULL COMMENT 'iva',
  `sop_factura` varchar(150) DEFAULT NULL COMMENT 'documento soporte de la factura',
  `id_estSeg` int(11) DEFAULT NULL,
  `per_encarga` varchar(30) DEFAULT NULL COMMENT 'nombre de la persona del area',
  `valor_tota` varchar(30) DEFAULT NULL COMMENT 'valor total de la caja menor ',
  `concept_justifi` varchar(300) DEFAULT NULL COMMENT 'concepto de la justificacion de cada documento ',
  `seg_rec` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cotizadores`
--

CREATE TABLE `cotizadores` (
  `ced_cotz` varchar(20) NOT NULL,
  `id_car` int(11) NOT NULL COMMENT 'id del cargo',
  `grup_car` int(11) DEFAULT NULL,
  `id_tipu` int(11) NOT NULL COMMENT 'Tipo de usuario',
  `nom_cotz` varchar(100) NOT NULL,
  `tel_cotz` varchar(30) DEFAULT NULL,
  `tel2_cotz` varchar(30) DEFAULT NULL,
  `eml_cotz` varchar(100) DEFAULT NULL,
  `ext_cotz` varchar(3) DEFAULT NULL,
  `usu_cotz` varchar(20) DEFAULT NULL,
  `nom_cns` varchar(4) DEFAULT NULL COMMENT 'Nombre Consecutivo',
  `cns_cotz` int(11) DEFAULT NULL,
  `con_cotz` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cot_ACA_cotizaciones`
--

CREATE TABLE `cot_ACA_cotizaciones` (
  `id_cotiA` int(11) NOT NULL,
  `doc_cotiA` varchar(300) DEFAULT NULL COMMENT 'ruta del documento',
  `fec_cotiA` datetime DEFAULT NULL COMMENT 'fecha de creacion de la cotizacion',
  `id_cli` varchar(20) DEFAULT NULL COMMENT 'nit del cliente',
  `id_usu` varchar(20) DEFAULT NULL COMMENT 'cedula del cotizador',
  `id_ema` int(11) DEFAULT NULL COMMENT 'id del estado del email',
  `ced_aseA` varchar(20) DEFAULT NULL COMMENT 'Cédula Asesor Comercial',
  `ced_sacA` varchar(20) DEFAULT NULL COMMENT 'Cédula Rep. Serv. Cliente',
  `dia_entA` varchar(300) DEFAULT NULL COMMENT 'Días habiles para entregar el pedido',
  `for_pagA` varchar(100) NOT NULL COMMENT 'Forma de pago para los productos cotizados',
  `id_tip_cotA` int(11) NOT NULL COMMENT 'id del tipo de cotizacion',
  `cost_cotA` varchar(20) DEFAULT NULL COMMENT 'costo de la cotizacion',
  `id_cont` int(11) DEFAULT NULL COMMENT 'Contacto de empresa',
  `val_cotA` varchar(200) NOT NULL COMMENT 'Validez de la cotizacion ',
  `cot_garA` varchar(10000) NOT NULL COMMENT 'garantia de la cotizacion',
  `id_ciu` int(11) DEFAULT NULL COMMENT 'id de la ciudad',
  `cns_coti` int(11) DEFAULT NULL COMMENT 'consecutivo de la cotización',
  `cot_iva` int(11) DEFAULT NULL COMMENT 'Cotización con iva',
  `sol_cot` int(11) DEFAULT NULL COMMENT 'quien solicito la cotización',
  `sol_upd` datetime DEFAULT NULL COMMENT 'fecha de actualizacion de la solicitud de cotizacion',
  `prec_cot` int(11) DEFAULT NULL COMMENT 'confirmación de la entrega de la cotización',
  `prec_updA` datetime DEFAULT NULL COMMENT 'fecha de actualización de la entrega ',
  `prc_cotA` varchar(50) DEFAULT NULL COMMENT 'productos cotizados en la cotización',
  `prc_updA` datetime DEFAULT NULL COMMENT 'actualizacion de los productos cotizados',
  `env_cotA` date DEFAULT NULL COMMENT 'dia que se envio la cotizacion',
  `env_updA` datetime DEFAULT NULL COMMENT 'actualizacion del momento en el que se actualizo',
  `est_cot` int(11) NOT NULL COMMENT 'estado de la cotización',
  `est_updA` datetime DEFAULT NULL COMMENT 'actualizacion del estado de la cotizacion',
  `com_cotA` varchar(100) DEFAULT NULL COMMENT 'comentario de la cotizacion',
  `com_updA` datetime DEFAULT NULL COMMENT 'actualización del comentario de la cotización',
  `mot_cotA` varchar(100) DEFAULT NULL COMMENT 'motivo de la cotización ',
  `mot_updA` datetime DEFAULT NULL COMMENT 'actualizacion del motivo de la cotización',
  `llam_cotA` int(11) DEFAULT NULL COMMENT 'Llamadas realizadas',
  `llam_updA` datetime DEFAULT NULL COMMENT 'Fecha actualización llamadas realizadas',
  `rem_ciu` int(11) DEFAULT NULL COMMENT 'Remitido A ciudad',
  `com_emaA` varchar(10000) DEFAULT NULL COMMENT 'comentario del cliente de la cotizacion',
  `envio_masivA` int(1) DEFAULT NULL COMMENT 'idica si se realiza el envio masivo de la cotizacion ',
  `com_cotOnlA` int(11) DEFAULT NULL COMMENT 'idica si se realizaron comentarios en la cotizacion en linea '
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cot_ACA_ubi_x_cot`
--

CREATE TABLE `cot_ACA_ubi_x_cot` (
  `id_ubica` int(11) NOT NULL,
  `id_cotiA` int(11) NOT NULL COMMENT 'id de la cotizacion de Aca',
  `cot_ubica` varchar(10000) NOT NULL COMMENT 'ubicacion donde se va instalar',
  `cot_med_metros` int(100) NOT NULL COMMENT 'medida de metros',
  `cot_med_cant` int(100) NOT NULL COMMENT 'cantidad'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cot_categoria`
--

CREATE TABLE `cot_categoria` (
  `id_cat` int(11) NOT NULL COMMENT 'Id Categoría',
  `nom_cat` varchar(20) NOT NULL COMMENT 'Nombre Categoría'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cot_cat_dlg`
--

CREATE TABLE `cot_cat_dlg` (
  `id_cat` int(11) DEFAULT NULL,
  `id_coti` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cot_ciudad`
--

CREATE TABLE `cot_ciudad` (
  `id_ciu` int(11) NOT NULL,
  `nom_ciu` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cot_comentarios_onl`
--

CREATE TABLE `cot_comentarios_onl` (
  `id_coti` int(11) NOT NULL COMMENT 'id de la cotizacion',
  `comentario` varchar(8800) NOT NULL COMMENT 'comentario de la cotizacion ',
  `fec_coment` datetime NOT NULL,
  `id_usu` varchar(15) NOT NULL COMMENT 'id usuario ',
  `usu_mq` varchar(15) NOT NULL COMMENT 'usuario de mq',
  `nom_usu` varchar(1000) NOT NULL COMMENT 'nombre del usuario '
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cot_cont_ema`
--

CREATE TABLE `cot_cont_ema` (
  `id_coti` int(11) NOT NULL,
  `fec_ema` datetime DEFAULT NULL COMMENT 'fecha',
  `email_contacto` varchar(300) CHARACTER SET utf8 NOT NULL COMMENT 'email del contacto ',
  `nom_contacto` varchar(500) CHARACTER SET utf8 NOT NULL COMMENT 'nombre del contacto',
  `email_contacto1` varchar(300) CHARACTER SET utf8 DEFAULT NULL,
  `nom_contacto1` varchar(300) CHARACTER SET utf8 DEFAULT NULL,
  `email_contacto2` varchar(300) CHARACTER SET utf8 DEFAULT NULL,
  `nom_contacto2` varchar(300) CHARACTER SET utf8 DEFAULT NULL,
  `email_contacto3` varchar(300) CHARACTER SET utf8 DEFAULT NULL,
  `nom_contacto3` varchar(300) CHARACTER SET utf8 DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cot_cotizaciones`
--

CREATE TABLE `cot_cotizaciones` (
  `id_coti` int(11) NOT NULL,
  `doc_coti` varchar(300) DEFAULT NULL COMMENT 'ruta del documento',
  `fec_coti` date DEFAULT NULL COMMENT 'fecha de creacion de la cotizacion',
  `id_cli` varchar(20) DEFAULT NULL COMMENT 'nit del cliente',
  `id_usu` varchar(20) DEFAULT NULL COMMENT 'cedula del cotizador',
  `id_ema` int(11) DEFAULT NULL COMMENT 'id del estado del email',
  `ced_ase` varchar(20) DEFAULT NULL COMMENT 'Cédula Asesor Comercial',
  `ced_sac` varchar(20) DEFAULT NULL COMMENT 'Cédula Rep. Serv. Cliente',
  `dia_ent` varchar(300) DEFAULT NULL COMMENT 'Días habiles para entregar el pedido',
  `for_pag` varchar(100) NOT NULL COMMENT 'Forma de pago para los productos cotizados',
  `id_tip_cot` int(11) NOT NULL COMMENT 'id del tipo de cotizacion',
  `cost_cot` varchar(20) DEFAULT NULL COMMENT 'costo de la cotizacion',
  `id_cont` int(11) DEFAULT NULL COMMENT 'Contacto de empresa',
  `val_cot` varchar(200) NOT NULL COMMENT 'Validez de la cotizacion ',
  `id_ciu` int(11) DEFAULT NULL COMMENT 'id de la ciudad',
  `cns_coti` int(11) DEFAULT NULL COMMENT 'consecutivo de la cotización',
  `cot_iva` int(11) DEFAULT NULL COMMENT 'Cotización con iva',
  `sol_cot` int(11) DEFAULT NULL COMMENT 'quien solicito la cotización',
  `sol_upd` datetime DEFAULT NULL COMMENT 'fecha de actualizacion de la solicitud de cotizacion',
  `prec_cot` varchar(30) DEFAULT NULL COMMENT 'confirmación de la entrega de la cotización',
  `prec_upd` datetime DEFAULT NULL COMMENT 'fecha de actualización de la entrega ',
  `prc_cot` varchar(50) DEFAULT NULL COMMENT 'productos cotizados en la cotización',
  `prc_upd` datetime DEFAULT NULL COMMENT 'actualizacion de los productos cotizados',
  `env_cot` date DEFAULT NULL COMMENT 'dia que se envio la cotizacion',
  `dif_diasEn` varchar(30) DEFAULT NULL COMMENT 'es la diferencia de dias que se envió la cotización ',
  `env_upd` datetime DEFAULT NULL COMMENT 'actualizacion del momento en el que se actualizo',
  `est_cot` int(11) NOT NULL COMMENT 'estado de la cotización',
  `est_upd` datetime DEFAULT NULL COMMENT 'actualizacion del estado de la cotizacion',
  `com_cot` varchar(100) DEFAULT NULL COMMENT 'comentario de la cotizacion',
  `com_upd` datetime DEFAULT NULL COMMENT 'actualización del comentario de la cotización',
  `mot_cot` varchar(100) DEFAULT NULL COMMENT 'motivo de la cotización ',
  `mot_upd` datetime DEFAULT NULL COMMENT 'actualizacion del motivo de la cotización',
  `llam_cot` int(11) DEFAULT NULL COMMENT 'Llamadas realizadas',
  `llam_upd` datetime DEFAULT NULL COMMENT 'Fecha actualización llamadas realizadas',
  `rem_ciu` int(11) DEFAULT NULL COMMENT 'Remitido A ciudad',
  `com_ema` varchar(10000) DEFAULT NULL COMMENT 'comentario del cliente de la cotizacion',
  `conf_cotiz` varchar(200) DEFAULT NULL COMMENT 'persona que autorizo la corzacion  ',
  `envio_masiv` int(1) DEFAULT NULL COMMENT 'idica si se realiza el envio masivo de la cotizacion ',
  `com_cotOnl` int(11) DEFAULT NULL COMMENT 'idica si se realizaron comentarios en la cotizacion en linea ',
  `id_tip_pedi` int(11) DEFAULT NULL COMMENT 'id tipo de pedido ',
  `id_pag` int(11) DEFAULT NULL COMMENT 'id del pago de  myprocces',
  `direccion_1` varchar(500) DEFAULT NULL COMMENT 'direccion del pedido ',
  `direccion_2` varchar(500) DEFAULT NULL COMMENT 'direccion del pedido 2',
  `date_mypro` datetime DEFAULT NULL COMMENT 'fecha del pedido ',
  `post_code` varchar(500) DEFAULT NULL,
  `pedi_rev` varchar(50) DEFAULT NULL COMMENT 'pedido revisado en myprocess',
  `id_estmarg` int(15) DEFAULT NULL COMMENT 'cotización con productos del margen debajo del 16 ',
  `est_vigen` int(11) DEFAULT NULL COMMENT 'estado de vigencia antiguo o nuevo'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cot_cotizaciones1`
--

CREATE TABLE `cot_cotizaciones1` (
  `id_coti` int(11) NOT NULL,
  `doc_coti` varchar(300) DEFAULT NULL COMMENT 'ruta del documento',
  `fec_coti` date DEFAULT NULL COMMENT 'fecha de creacion de la cotizacion',
  `id_cli` varchar(20) DEFAULT NULL COMMENT 'nit del cliente',
  `id_usu` varchar(20) DEFAULT NULL COMMENT 'cedula del cotizador',
  `id_ema` int(11) DEFAULT NULL COMMENT 'id del estado del email',
  `ced_ase` varchar(20) DEFAULT NULL COMMENT 'Cédula Asesor Comercial',
  `ced_sac` varchar(20) DEFAULT NULL COMMENT 'Cédula Rep. Serv. Cliente',
  `dia_ent` varchar(300) DEFAULT NULL COMMENT 'Días habiles para entregar el pedido',
  `for_pag` varchar(100) NOT NULL COMMENT 'Forma de pago para los productos cotizados',
  `id_tip_cot` int(11) NOT NULL COMMENT 'id del tipo de cotizacion',
  `cost_cot` varchar(20) DEFAULT NULL COMMENT 'costo de la cotizacion',
  `id_cont` int(11) DEFAULT NULL COMMENT 'Contacto de empresa',
  `val_cot` varchar(200) NOT NULL COMMENT 'Validez de la cotizacion ',
  `id_ciu` int(11) DEFAULT NULL COMMENT 'id de la ciudad',
  `cns_coti` int(11) DEFAULT NULL COMMENT 'consecutivo de la cotización',
  `cot_iva` int(11) DEFAULT NULL COMMENT 'Cotización con iva',
  `sol_cot` int(11) DEFAULT NULL COMMENT 'quien solicito la cotización',
  `sol_upd` datetime DEFAULT NULL COMMENT 'fecha de actualizacion de la solicitud de cotizacion',
  `prec_cot` varchar(30) DEFAULT NULL COMMENT 'confirmación de la entrega de la cotización',
  `prec_upd` datetime DEFAULT NULL COMMENT 'fecha de actualización de la entrega ',
  `prc_cot` varchar(50) DEFAULT NULL COMMENT 'productos cotizados en la cotización',
  `prc_upd` datetime DEFAULT NULL COMMENT 'actualizacion de los productos cotizados',
  `env_cot` date DEFAULT NULL COMMENT 'dia que se envio la cotizacion',
  `dif_diasEn` varchar(30) DEFAULT NULL COMMENT 'es la diferencia de dias que se envió la cotización ',
  `env_upd` datetime DEFAULT NULL COMMENT 'actualizacion del momento en el que se actualizo',
  `est_cot` int(11) NOT NULL COMMENT 'estado de la cotización',
  `est_upd` datetime DEFAULT NULL COMMENT 'actualizacion del estado de la cotizacion',
  `com_cot` varchar(100) DEFAULT NULL COMMENT 'comentario de la cotizacion',
  `com_upd` datetime DEFAULT NULL COMMENT 'actualización del comentario de la cotización',
  `mot_cot` varchar(100) DEFAULT NULL COMMENT 'motivo de la cotización ',
  `mot_upd` datetime DEFAULT NULL COMMENT 'actualizacion del motivo de la cotización',
  `llam_cot` int(11) DEFAULT NULL COMMENT 'Llamadas realizadas',
  `llam_upd` datetime DEFAULT NULL COMMENT 'Fecha actualización llamadas realizadas',
  `rem_ciu` int(11) DEFAULT NULL COMMENT 'Remitido A ciudad',
  `com_ema` varchar(10000) DEFAULT NULL COMMENT 'comentario del cliente de la cotizacion',
  `conf_cotiz` varchar(200) DEFAULT NULL COMMENT 'persona que autorizo la corzacion  ',
  `envio_masiv` int(1) DEFAULT NULL COMMENT 'idica si se realiza el envio masivo de la cotizacion ',
  `com_cotOnl` int(11) DEFAULT NULL COMMENT 'idica si se realizaron comentarios en la cotizacion en linea ',
  `id_tip_pedi` int(11) DEFAULT NULL COMMENT 'id tipo de pedido ',
  `id_pag` int(11) DEFAULT NULL COMMENT 'id del pago de  myprocces',
  `direccion_1` varchar(500) DEFAULT NULL COMMENT 'direccion del pedido ',
  `direccion_2` varchar(500) DEFAULT NULL COMMENT 'direccion del pedido 2',
  `date_mypro` datetime DEFAULT NULL COMMENT 'fecha del pedido ',
  `post_code` varchar(500) DEFAULT NULL,
  `pedi_rev` varchar(50) DEFAULT NULL COMMENT 'pedido revisado en myprocess',
  `id_estmarg` int(15) DEFAULT NULL COMMENT 'cotización con productos del margen debajo del 16 ',
  `est_vigen` int(11) DEFAULT NULL COMMENT 'estado de vigencia antiguo o nuevo'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `cot_crm_view`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `cot_crm_view` (
`id_coti` int(11)
,`doc_coti` varchar(300)
,`fec_coti` date
,`id_cli` varchar(20)
,`id_usu` varchar(20)
,`id_ema` int(11)
,`ced_ase` varchar(20)
,`ced_sac` varchar(20)
,`dia_ent` varchar(300)
,`for_pag` varchar(100)
,`id_tip_cot` int(11)
,`cost_cot` varchar(20)
,`id_cont` int(11)
,`val_cot` varchar(200)
,`id_ciu` int(11)
,`cns_coti` int(11)
,`cot_iva` int(11)
,`sol_cot` int(11)
,`sol_upd` datetime
,`prec_cot` varchar(30)
,`prec_upd` datetime
,`prc_cot` varchar(50)
,`prc_upd` datetime
,`env_cot` date
,`dif_diasEn` varchar(30)
,`env_upd` datetime
,`est_cot` int(11)
,`est_upd` datetime
,`com_cot` varchar(100)
,`com_upd` datetime
,`mot_cot` varchar(100)
,`mot_upd` datetime
,`llam_cot` int(11)
,`llam_upd` datetime
,`rem_ciu` int(11)
,`com_ema` varchar(10000)
,`conf_cotiz` varchar(200)
,`envio_masiv` int(1)
,`com_cotOnl` int(11)
,`id_tip_pedi` int(11)
,`id_pag` int(11)
,`direccion_1` varchar(500)
,`direccion_2` varchar(500)
,`date_mypro` datetime
,`post_code` varchar(500)
,`pedi_rev` varchar(50)
,`nom_cns` varchar(4)
,`nom_est` varchar(45)
,`nom_cont` varchar(100)
);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cot_descrip_rech`
--

CREATE TABLE `cot_descrip_rech` (
  `id_rechazo` int(15) NOT NULL COMMENT 'id ',
  `id_coti` int(15) DEFAULT NULL COMMENT 'id de la cotizacion',
  `desc_rechazo` varchar(1000) DEFAULT NULL COMMENT 'descripción del rechazo '
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cot_ema_est`
--

CREATE TABLE `cot_ema_est` (
  `id_ema` int(11) NOT NULL,
  `nom_ema` varchar(50) DEFAULT NULL COMMENT 'nombre del estado del email'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cot_estados_cot`
--

CREATE TABLE `cot_estados_cot` (
  `id_est` int(11) NOT NULL,
  `nom_est` varchar(45) NOT NULL,
  `color` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cot_est_margen`
--

CREATE TABLE `cot_est_margen` (
  `id_estmarg` int(11) NOT NULL COMMENT 'id del estado de margen',
  `nom_estmarg` varchar(100) DEFAULT NULL COMMENT 'nombre del estado de la margen '
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cot_form_pag_mypro`
--

CREATE TABLE `cot_form_pag_mypro` (
  `id_pag` int(15) NOT NULL,
  `nom_pag` varchar(300) NOT NULL COMMENT 'nombre del pago'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `cot_historial_view`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `cot_historial_view` (
`id_coti` int(11)
,`doc_coti` varchar(300)
,`fec_coti` date
,`id_cli` varchar(20)
,`id_usu` varchar(20)
,`id_ema` int(11)
,`ced_ase` varchar(20)
,`ced_sac` varchar(20)
,`dia_ent` varchar(300)
,`for_pag` varchar(100)
,`id_tip_cot` int(11)
,`cost_cot` varchar(20)
,`id_cont` int(11)
,`val_cot` varchar(200)
,`id_ciu` int(11)
,`cns_coti` int(11)
,`cot_iva` int(11)
,`sol_cot` int(11)
,`sol_upd` datetime
,`prec_cot` varchar(30)
,`prec_upd` datetime
,`prc_cot` varchar(50)
,`prc_upd` datetime
,`env_cot` date
,`dif_diasEn` varchar(30)
,`env_upd` datetime
,`est_cot` int(11)
,`est_upd` datetime
,`com_cot` varchar(100)
,`com_upd` datetime
,`mot_cot` varchar(100)
,`mot_upd` datetime
,`llam_cot` int(11)
,`llam_upd` datetime
,`rem_ciu` int(11)
,`com_ema` varchar(10000)
,`conf_cotiz` varchar(200)
,`envio_masiv` int(1)
,`com_cotOnl` int(11)
,`id_tip_pedi` int(11)
,`id_pag` int(11)
,`direccion_1` varchar(500)
,`direccion_2` varchar(500)
,`date_mypro` datetime
,`post_code` varchar(500)
,`pedi_rev` varchar(50)
,`nom_cns` varchar(4)
,`nom_cli` varchar(100)
,`nom_tip_cot` varchar(30)
);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cot_margen`
--

CREATE TABLE `cot_margen` (
  `id_margen` int(11) NOT NULL COMMENT 'id del margen',
  `nom_margen` varchar(100) DEFAULT NULL COMMENT 'nombre del margen',
  `num_margen` int(11) NOT NULL,
  `color` varchar(100) DEFAULT NULL COMMENT 'color '
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cot_precios`
--

CREATE TABLE `cot_precios` (
  `id_pre` int(11) NOT NULL,
  `cod_pro` int(11) DEFAULT NULL,
  `cod_mp` varchar(30) DEFAULT NULL COMMENT 'Codigo en My Process',
  `nit_cli` varchar(20) DEFAULT NULL,
  `pre_pro` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cot_productos`
--

CREATE TABLE `cot_productos` (
  `cod_pro` int(11) NOT NULL,
  `cod_ref` mediumtext NOT NULL,
  `nom_pro` varchar(1400) DEFAULT NULL,
  `des_pro` varchar(10000) DEFAULT NULL,
  `img_pro` varchar(1160) DEFAULT NULL,
  `lin_pro` int(11) DEFAULT NULL COMMENT 'linea del producto',
  `und_emp` varchar(10) NOT NULL COMMENT 'unidad de empaque',
  `can_emp` int(11) NOT NULL COMMENT 'cantidad de empaque',
  `sin_dev` int(11) DEFAULT NULL COMMENT 'No se puede devolver',
  `cat_prod` varchar(30) DEFAULT NULL COMMENT 'categoria de los productos '
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cot_pro_x_cot`
--

CREATE TABLE `cot_pro_x_cot` (
  `id_coti` int(11) DEFAULT NULL,
  `cod_pro` varchar(10) CHARACTER SET utf8 DEFAULT NULL,
  `pre_cot` varchar(1000) CHARACTER SET utf8 DEFAULT NULL,
  `des_pro_cot` longtext CHARACTER SET utf8,
  `obs_prod` varchar(200) CHARACTER SET utf8 DEFAULT NULL COMMENT 'Observaciones Extra',
  `can_com` int(11) NOT NULL,
  `nom_pro_cot` varchar(200) CHARACTER SET utf8 NOT NULL,
  `margen` varchar(300) DEFAULT NULL COMMENT 'margen del producto'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cot_solicitud`
--

CREATE TABLE `cot_solicitud` (
  `id_soli` int(11) NOT NULL,
  `med_soli` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cot_tap_complejo`
--

CREATE TABLE `cot_tap_complejo` (
  `dis_tapCom_min` varchar(100) NOT NULL COMMENT 'diseño de tapete min',
  `dis_tapCom_hor` varchar(100) NOT NULL COMMENT 'diseño de tapete horas',
  `cal_tapCom_min` varchar(100) NOT NULL COMMENT 'calcado del tapete min',
  `cal_tapCom_hor` varchar(100) NOT NULL COMMENT 'calcado del tapete horas',
  `peg_tapCom_min` varchar(100) NOT NULL COMMENT 'Pegado logo en tapete min',
  `peg_tapCom_hor` varchar(100) NOT NULL COMMENT 'Pegado logo en tapete horas',
  `cort_tapCom_min` varchar(100) NOT NULL COMMENT 'Corte tapete base de acuerdo a Dimensiones min ',
  `cort_tapCom_hor` varchar(100) NOT NULL COMMENT 'Corte tapete base de acuerdo a Dimensiones horas',
  `cort_baseCom_min` varchar(100) NOT NULL COMMENT 'Corte base min',
  `cort_baseCom_hor` varchar(100) NOT NULL COMMENT 'Corte base horas',
  `cort_logoCom_min` varchar(100) NOT NULL COMMENT 'Corte Logo min',
  `cort_logoCom_hor` varchar(100) NOT NULL COMMENT 'Corte Logo horas',
  `uni_logoCom_min` varchar(100) NOT NULL COMMENT 'Union Logo min',
  `uni_logoCom_hor` varchar(100) NOT NULL COMMENT 'Union Logo horas',
  `esc_tapCom_min` varchar(100) NOT NULL COMMENT 'Escuadra tapete min',
  `esc_tapCom_hor` varchar(100) NOT NULL COMMENT 'Escuadra tapete horas',
  `perf_tapCom_min` varchar(100) NOT NULL COMMENT 'perfilado tapete',
  `perf_tapCom_hor` varchar(100) NOT NULL COMMENT 'perfilado tapete',
  `rell_tapCom_min` varchar(100) NOT NULL COMMENT 'resellado tapete',
  `rell_tapCom_hor` varchar(100) NOT NULL COMMENT 'resellado tapete',
  `tot_tapCom` varchar(100) NOT NULL COMMENT 'total tapete sencillo',
  `fech_mods` datetime NOT NULL COMMENT 'fecha de la ultima modificación ',
  `id_usu` varchar(45) NOT NULL COMMENT 'usuario que modifico '
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cot_tap_costos`
--

CREATE TABLE `cot_tap_costos` (
  `perm_cl` varchar(100) NOT NULL COMMENT 'perfil mediano Valor Cl',
  `perm_ml` varchar(100) NOT NULL COMMENT 'perfil mediano Valor ml',
  `perm_m` varchar(100) NOT NULL COMMENT 'perfil mediano Valor mt2',
  `perg_cl` varchar(100) NOT NULL COMMENT 'perfil grueso Valor Cl',
  `perg_ml` varchar(100) NOT NULL COMMENT 'perfil grueso Valor ml',
  `perg_m` varchar(100) NOT NULL COMMENT 'perfil grueso Valor mt2',
  `nomtre_cl` varchar(100) NOT NULL COMMENT 'Nomad T3000 Valor Cl',
  `nomtre_ml` varchar(100) NOT NULL COMMENT 'Nomad T3000 Valor ml',
  `nomtre_m` varchar(100) NOT NULL COMMENT 'Nomad T3000 Valor mt2',
  `nomil_cl` varchar(100) NOT NULL COMMENT 'Nomad T1000  Valor Cl',
  `nomil_ml` varchar(100) NOT NULL COMMENT 'Nomad T1000 Valor ml',
  `nomil_m` varchar(100) NOT NULL COMMENT 'Nomad T1000 Valor mt2',
  `korl_cl` varchar(100) NOT NULL COMMENT ' Koreano Trafico Pesado Valor Cl',
  `korl_ml` varchar(100) NOT NULL COMMENT ' Koreano Trafico Pesado Valor ml',
  `korl_m` varchar(100) NOT NULL COMMENT ' Koreano Trafico Pesado Valor mt2',
  `korp_cl` varchar(100) NOT NULL COMMENT 'Koreano Trafico Liviano Valor Cl',
  `korp_ml` varchar(100) NOT NULL COMMENT 'Koreano Trafico Liviano Valor ml',
  `korp_m` varchar(100) NOT NULL COMMENT 'Koreano Trafico Liviano Valor mt2',
  `bost_cl` varchar(100) NOT NULL COMMENT 'boston valor cl',
  `bost_ml` varchar(100) NOT NULL COMMENT 'boston valor ml',
  `bost_m` varchar(100) NOT NULL COMMENT 'boston valor m2',
  `aqua_cl` varchar(100) NOT NULL COMMENT 'aqua valor cl',
  `aqua_ml` varchar(100) NOT NULL COMMENT 'aqua valor ml',
  `aqua_m` varchar(100) NOT NULL COMMENT 'aqua valor cl ',
  `nomsinb_cl` varchar(100) NOT NULL COMMENT 'nomad sin base valor cl',
  `nomsinb_ml` varchar(100) NOT NULL COMMENT 'nomad sin base valor ml',
  `nomsinb_m` varchar(100) NOT NULL COMMENT 'nomad sin base valor m2',
  `val_pegan` varchar(100) NOT NULL COMMENT 'Pegante valor ',
  `val_pegxtap` varchar(100) NOT NULL COMMENT 'Pegante Valor x Tapete',
  `papel_bond` varchar(100) NOT NULL COMMENT 'papel_bond',
  `fech_mod` datetime NOT NULL COMMENT 'fecha de modificacion ',
  `id_usu` varchar(45) NOT NULL COMMENT 'usuario que modifica '
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cot_tap_depre`
--

CREATE TABLE `cot_tap_depre` (
  `vr_depre` varchar(100) NOT NULL COMMENT 'Mesa Plancha vr',
  `vr_xdepre` varchar(100) NOT NULL COMMENT 'Mesa Plancha vr x depre',
  `dep_mes` varchar(100) NOT NULL COMMENT 'Mesa Plancha dep mes',
  `dep_hora` varchar(100) NOT NULL COMMENT 'Mesa Plancha dep hora',
  `fecha_mod` datetime NOT NULL COMMENT 'fecha de modificacion ',
  `id_usu` varchar(45) NOT NULL COMMENT 'usuario que modifica '
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cot_tap_mano`
--

CREATE TABLE `cot_tap_mano` (
  `sal_bas` varchar(100) NOT NULL COMMENT 'salario base',
  `sub_tran` varchar(100) NOT NULL COMMENT 'subsido de transporte',
  `fac_pres` varchar(100) NOT NULL COMMENT 'Factor prestacional',
  `tot_sal` varchar(100) NOT NULL COMMENT 'total de salario',
  `hor_dia` varchar(100) NOT NULL COMMENT 'Horas habiles dia',
  `hor_mes` varchar(100) NOT NULL COMMENT 'Horas habiles mes',
  `cost_hora` varchar(100) NOT NULL COMMENT 'Costo hora M/O',
  `fech_mod` datetime NOT NULL COMMENT 'fecha de modificaciom',
  `id_usu` varchar(45) NOT NULL COMMENT 'id_usu'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cot_tap_man_x_tap`
--

CREATE TABLE `cot_tap_man_x_tap` (
  `man_tapsen` varchar(100) NOT NULL COMMENT 'mano de obra por tapete sencillo ',
  `man_tapcom` varchar(100) NOT NULL COMMENT 'mano de obra por tapete complejo',
  `man_taplog` varchar(100) NOT NULL COMMENT 'mano de obra por tapete sin logo '
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cot_tap_sencillo`
--

CREATE TABLE `cot_tap_sencillo` (
  `dis_tap_min` varchar(100) NOT NULL COMMENT 'diseño de tapete min ',
  `dis_tap_hor` varchar(100) NOT NULL COMMENT 'diseño de tapete horas',
  `cal_tap_min` varchar(100) NOT NULL COMMENT 'calcado del tapete min',
  `cal_tap_hor` varchar(100) NOT NULL COMMENT 'calcado del tapete horas',
  `peg_tap_min` varchar(100) NOT NULL COMMENT 'Pegado logo en tapete min',
  `peg_tap_hor` varchar(100) NOT NULL COMMENT 'Pegado logo en tapete horas',
  `cort_tap_min` varchar(100) NOT NULL COMMENT 'Corte tapete base de acuerdo a Dimensiones min',
  `cort_tap_hor` varchar(100) NOT NULL COMMENT 'Corte tapete base de acuerdo a Dimensiones horas',
  `cort_base_min` varchar(100) NOT NULL COMMENT 'Corte base min',
  `cort_base_hor` varchar(100) NOT NULL COMMENT 'Corte base horas',
  `cort_logo_min` varchar(100) NOT NULL COMMENT 'Corte Logo min',
  `cort_logo_hor` varchar(100) NOT NULL COMMENT 'Corte Logo horas',
  `uni_logo_min` varchar(100) NOT NULL COMMENT 'Union Logo min',
  `uni_logo_hor` varchar(100) NOT NULL COMMENT 'Union Logo horas',
  `esc_tap_min` varchar(100) NOT NULL COMMENT 'Escuadra tapete min',
  `esc_tap_hor` varchar(100) NOT NULL COMMENT 'Escuadra tapete horas',
  `perf_tap_min` varchar(100) NOT NULL COMMENT 'perfilado tapete min',
  `perf_tap_hor` varchar(100) NOT NULL COMMENT 'perfilado tapete horas',
  `rell_tap_min` varchar(100) NOT NULL COMMENT 'resellado tapete min',
  `rell_tap_hor` varchar(100) NOT NULL COMMENT 'resellado tapete horas',
  `tot_tapsen` varchar(100) NOT NULL COMMENT 'total tapete sencillo min ',
  `fech_mods` datetime NOT NULL COMMENT 'fecha de la ultima modificación ',
  `id_usu` varchar(45) NOT NULL COMMENT 'usuario que modifico '
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cot_tap_serpublicos`
--

CREATE TABLE `cot_tap_serpublicos` (
  `ener_mes` varchar(100) NOT NULL COMMENT 'Energia Costo mes',
  `ener_hora` varchar(100) NOT NULL COMMENT 'Energia Costo Hora',
  `cons_mes` varchar(100) NOT NULL COMMENT 'Consumo Promedio Planta mes',
  `cons_hora` varchar(100) NOT NULL COMMENT 'Consumo Promedio Planta hora',
  `siat_mes` varchar(100) NOT NULL COMMENT 'Consumo SIAT mes',
  `siat_hora` varchar(100) NOT NULL COMMENT 'Consumo SIAT hora',
  `fech_mod` datetime NOT NULL COMMENT 'fecha de modificacion ',
  `id_usu` varchar(45) NOT NULL COMMENT 'usuario que modifica '
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cot_tap_sinlogo`
--

CREATE TABLE `cot_tap_sinlogo` (
  `dis_tapSin_min` varchar(100) NOT NULL COMMENT 'diseño de tapete min',
  `dis_tapSin_hor` varchar(100) NOT NULL COMMENT 'diseño de tapete horas',
  `cal_tapSin_min` varchar(100) NOT NULL COMMENT 'calcado del tapete min',
  `cal_tapSin_hor` varchar(100) NOT NULL COMMENT 'calcado del tapete horas',
  `peg_tapSin_min` varchar(100) NOT NULL COMMENT 'Pegado logo en tapete min',
  `peg_tapSin_hor` varchar(100) NOT NULL COMMENT 'Pegado logo en tapete horas',
  `cort_tapSin_min` varchar(100) NOT NULL COMMENT 'Corte tapete base de acuerdo a Dimensiones min ',
  `cort_tapSin_hor` varchar(100) NOT NULL COMMENT 'Corte tapete base de acuerdo a Dimensiones horas',
  `cort_baseSin_min` varchar(100) NOT NULL COMMENT 'Corte base min',
  `cort_baseSin_hor` varchar(100) NOT NULL COMMENT 'Corte base horas',
  `cort_logoSin_min` varchar(100) NOT NULL COMMENT 'Corte Logo min',
  `cort_logoSin_hor` varchar(100) NOT NULL COMMENT 'Corte Logo horas',
  `uni_logoSin_min` varchar(100) NOT NULL COMMENT 'Union Logo min',
  `uni_logoSin_hor` varchar(100) NOT NULL COMMENT 'Union Logo horas',
  `esc_tapSin_min` varchar(100) NOT NULL COMMENT 'Escuadra tapete min',
  `esc_tapSin_hor` varchar(100) NOT NULL COMMENT 'Escuadra tapete horas',
  `perf_tapSin_min` varchar(100) NOT NULL COMMENT 'perfilado tapete',
  `perf_tapSin_hor` varchar(100) NOT NULL COMMENT 'perfilado tapete',
  `rell_tapSin_min` varchar(100) NOT NULL COMMENT 'resellado tapete',
  `rell_tapSin_hor` varchar(100) NOT NULL COMMENT 'resellado tapete',
  `tot_tapSin` varchar(100) NOT NULL COMMENT 'total tapete sencillo',
  `fech_mod` datetime NOT NULL COMMENT 'fecha de la ultima modificación ',
  `id_usu` varchar(45) NOT NULL COMMENT 'usuario que modifico '
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cot_tap_tip_logo`
--

CREATE TABLE `cot_tap_tip_logo` (
  `id_tip_log` int(11) NOT NULL,
  `nom_tip_log` varchar(60) NOT NULL COMMENT 'tipo de tapete para el logo '
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cot_tap_tip_mano`
--

CREATE TABLE `cot_tap_tip_mano` (
  `id_mano` int(11) NOT NULL COMMENT 'id tipo de ',
  `nom_mano` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cot_tap_tip_perfil`
--

CREATE TABLE `cot_tap_tip_perfil` (
  `id_tiper` int(11) NOT NULL COMMENT 'id del tipo de perfill ',
  `nom_tiper` varchar(45) NOT NULL COMMENT 'nombre del tipo de perfil'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cot_tap_tip_tapete`
--

CREATE TABLE `cot_tap_tip_tapete` (
  `id_tap` int(11) NOT NULL COMMENT 'id tipo de tapete',
  `nom_tap` varchar(500) NOT NULL COMMENT 'nombre del tipo de tapete'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cot_tip_cotizacion`
--

CREATE TABLE `cot_tip_cotizacion` (
  `id_tip_cot` int(11) NOT NULL,
  `nom_tip_cot` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cot_tip_cotizacion_ACA`
--

CREATE TABLE `cot_tip_cotizacion_ACA` (
  `id_tip_cotA` int(11) NOT NULL COMMENT 'id tip cotizacion Aca',
  `nom_tip_cotA` varchar(100) NOT NULL COMMENT 'nom tipo de cotizacion Aca'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cot_tip_cotizador`
--

CREATE TABLE `cot_tip_cotizador` (
  `id_car` int(11) NOT NULL,
  `nom_car` varchar(40) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cot_tip_pedido`
--

CREATE TABLE `cot_tip_pedido` (
  `id_tip_pedi` int(11) NOT NULL,
  `nom_tip_pedi` varchar(50) NOT NULL COMMENT 'nombre del tipo de pedido '
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cot_tip_usuario`
--

CREATE TABLE `cot_tip_usuario` (
  `id_tipu` int(11) NOT NULL,
  `nom_tipu` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cot_x_mov`
--

CREATE TABLE `cot_x_mov` (
  `id_coti` int(11) DEFAULT NULL,
  `id_estado` int(11) DEFAULT NULL,
  `nom_estado` varchar(100) DEFAULT NULL,
  `id_usu` int(11) NOT NULL,
  `nom_usu` varchar(300) NOT NULL COMMENT 'nombre del usuario',
  `fec_mov` datetime DEFAULT NULL COMMENT 'fecha de cambios del estado '
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `creditos_view1`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `creditos_view1` (
`id_reg` varchar(11)
,`id_sol` int(11)
,`nom_cli` varchar(100)
,`nom_cont` varchar(100)
,`fec_sol` date
,`ase_com` varchar(45)
,`id_cli` int(11)
,`nom_est` varchar(50)
,`id_est` int(11)
,`nom_act` varchar(100)
,`rep_sac` varchar(20)
,`nom_usu` varchar(10000)
,`fecha_crea` date
,`nom_atc` varchar(100)
,`eml_enviado` int(4)
);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `creditos_view2`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `creditos_view2` (
`id_usu` varchar(45)
,`id_reg` varchar(11)
,`id_sol` int(11)
,`nom_cli` varchar(100)
,`id_cont` varchar(10)
,`nom_cont` varchar(100)
,`fec_sol` date
,`ase_com` varchar(45)
,`nom_atc` varchar(100)
,`id_cli` int(11)
,`fecha_crea` date
,`nom_est` varchar(50)
,`id_est` int(11)
,`nom_usu` varchar(10000)
,`nom_act` varchar(100)
,`eml_enviado` int(4)
);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `credit_actSol`
--

CREATE TABLE `credit_actSol` (
  `id_act` int(11) NOT NULL,
  `nom_act` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `credit_concepAt`
--

CREATE TABLE `credit_concepAt` (
  `id_conAt` int(11) NOT NULL,
  `nom_conAt` varchar(200) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `credit_concept`
--

CREATE TABLE `credit_concept` (
  `id_concept` int(11) NOT NULL,
  `id_sol` int(11) NOT NULL COMMENT 'id de la solicitud de credito ',
  `nom_rep` varchar(45) CHARACTER SET utf8 DEFAULT NULL COMMENT 'nombre del representante legal ',
  `act_eco` varchar(150) DEFAULT NULL COMMENT 'actividad económica',
  `tiem_merc` varchar(30) CHARACTER SET utf8 DEFAULT NULL COMMENT 'tiempo en el mercado',
  `num_emple` varchar(30) CHARACTER SET utf8 DEFAULT NULL COMMENT 'numero de empleados	',
  `cupo_sol` varchar(300) CHARACTER SET utf8 DEFAULT NULL COMMENT 'cupo de credito solicitado	',
  `term_pag` varchar(300) CHARACTER SET utf8 DEFAULT NULL COMMENT 'termino de pago',
  `dia_pag` varchar(45) CHARACTER SET utf8 DEFAULT NULL COMMENT 'dias en que se realiza el pago',
  `reg_clie` varchar(45) CHARACTER SET utf8 DEFAULT NULL COMMENT 'regimen del cliente',
  `cupoSugA` varchar(100) CHARACTER SET utf8 DEFAULT NULL COMMENT 'cupo sugerido por ATC',
  `plaSugeA` varchar(100) CHARACTER SET utf8 DEFAULT NULL COMMENT 'plazo sugerido por atc',
  `jusPlaCup` varchar(500) CHARACTER SET utf8 DEFAULT NULL COMMENT 'justificacion del plazo y cupo de atc	',
  `cup_aut` varchar(500) CHARACTER SET utf8 DEFAULT NULL COMMENT 'cupo de credito autorizado',
  `term_auto` varchar(30) CHARACTER SET utf8 DEFAULT NULL COMMENT 'termino de pago autorizado	',
  `ob_cupasig` varchar(10000) DEFAULT NULL COMMENT 'observacion del cupo asignado',
  `retFuen` varchar(45) DEFAULT NULL COMMENT 'retencion de la fuente',
  `segm_clie` varchar(30) DEFAULT NULL COMMENT 'segmento del cliente',
  `congen_ase` varchar(300) DEFAULT NULL COMMENT 'concepto general del asesor	',
  `ana_referen` varchar(500) DEFAULT NULL COMMENT 'análisis de referencias	',
  `tiem_rad` varchar(45) DEFAULT NULL COMMENT 'tiempo de años y meses del tiempo en el mercado ',
  `obser_perm` varchar(300) DEFAULT NULL COMMENT 'observación de por que se le da en pendiente al	',
  `num_letra` varchar(150) DEFAULT NULL COMMENT 'numero en letras del cupo autorizado',
  `cau_rec` varchar(100) DEFAULT NULL COMMENT 'tipo de rechazo'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `credit_docum`
--

CREATE TABLE `credit_docum` (
  `id_docum` int(11) NOT NULL,
  `id_sol` int(11) NOT NULL COMMENT 'id de la solicitud de credito ',
  `doc_consGer` varchar(300) CHARACTER SET utf8 DEFAULT NULL,
  `doc_rut` varchar(300) CHARACTER SET utf8 DEFAULT NULL,
  `doc_refCom` varchar(150) CHARACTER SET utf8 DEFAULT NULL,
  `doc_refcom2` varchar(150) CHARACTER SET utf8 DEFAULT NULL,
  `doc_refBanc` varchar(150) CHARACTER SET utf8 DEFAULT NULL,
  `doc_form` varchar(155) CHARACTER SET utf8 DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `credit_env_mercancia`
--

CREATE TABLE `credit_env_mercancia` (
  `id_mer` int(11) NOT NULL,
  `direcion_1` varchar(100) DEFAULT NULL,
  `direcion_2` varchar(100) DEFAULT NULL,
  `direcion_3` varchar(100) DEFAULT NULL,
  `ciudad_1` varchar(100) DEFAULT NULL,
  `ciudad_2` varchar(100) DEFAULT NULL,
  `ciudad_3` varchar(100) DEFAULT NULL,
  `telefono_1` int(30) DEFAULT NULL,
  `telefono_2` int(30) DEFAULT NULL,
  `telefono_3` int(30) DEFAULT NULL,
  `horario_1` int(30) DEFAULT NULL,
  `horario1_1` int(30) DEFAULT NULL COMMENT 'hora final del despacho ',
  `horario_2` int(30) DEFAULT NULL,
  `horario2_2` int(11) DEFAULT NULL COMMENT 'horario  de despachos ',
  `horario_3` int(11) DEFAULT NULL,
  `horario3_3` int(11) DEFAULT NULL COMMENT 'hora final del despacho ',
  `id_sol` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `credit_estadosol`
--

CREATE TABLE `credit_estadosol` (
  `id_est` int(11) NOT NULL,
  `nom_est` varchar(30) CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `credit_regimen`
--

CREATE TABLE `credit_regimen` (
  `id_regimen` int(11) NOT NULL,
  `nom_regimen` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `credit_segmento`
--

CREATE TABLE `credit_segmento` (
  `id_segmento` int(11) NOT NULL,
  `nom_segmento` varchar(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `credit_sol`
--

CREATE TABLE `credit_sol` (
  `id_sol` int(11) NOT NULL,
  `fec_sol` date NOT NULL COMMENT 'fecha de la solicitud ',
  `fecha_crea` date NOT NULL COMMENT 'fecha de creación ',
  `id_cli` varchar(60) NOT NULL COMMENT 'id de cliente ',
  `id_est` int(11) NOT NULL COMMENT 'id_estado',
  `id_usu` varchar(45) NOT NULL COMMENT 'id_usuario',
  `ase_com` varchar(45) DEFAULT NULL COMMENT 'asesor comercial',
  `rep_sac` varchar(45) DEFAULT NULL COMMENT 'representante sac'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `credit_x_mov`
--

CREATE TABLE `credit_x_mov` (
  `id_sol` int(11) DEFAULT NULL,
  `id_usu` varchar(45) CHARACTER SET utf8 DEFAULT NULL,
  `id_est` int(11) DEFAULT NULL,
  `fech_crm` datetime DEFAULT NULL COMMENT 'fecha tomada por el sistema '
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cre_contactos`
--

CREATE TABLE `cre_contactos` (
  `id_cont` int(11) NOT NULL,
  `id_sol` int(11) DEFAULT NULL,
  `id_cli` varchar(45) DEFAULT NULL,
  `id_usu` varchar(45) CHARACTER SET utf32 DEFAULT NULL,
  `enc_com` varchar(100) DEFAULT NULL COMMENT 'encargado de compras',
  `enc_com2` varchar(100) DEFAULT NULL COMMENT 'encargado de compras 2',
  `ema_com` varchar(100) DEFAULT NULL COMMENT 'email de compras 1',
  `ema_com2` varchar(100) DEFAULT NULL COMMENT 'email de compras 2',
  `con_ocu` varchar(100) DEFAULT NULL COMMENT 'contacto ocupacional',
  `con_ocu2` varchar(100) DEFAULT NULL COMMENT 'contacto ocupacional 2',
  `ema_ocu` varchar(100) DEFAULT NULL COMMENT 'email de contacto ocupacional',
  `ema_ocu2` varchar(100) DEFAULT NULL COMMENT 'email de contacto ocupacional 2',
  `con_gen` varchar(100) DEFAULT NULL COMMENT 'contacto servicios generales',
  `con_gen2` varchar(100) DEFAULT NULL COMMENT 'contacto servicios generales2',
  `ema_gen` varchar(100) DEFAULT NULL COMMENT 'email contactos servicios generales',
  `ema_gen2` varchar(100) DEFAULT NULL COMMENT 'email contactos servicios generales 2',
  `con_teso` varchar(100) DEFAULT NULL COMMENT 'contacto  de tesoreria',
  `con_teso2` varchar(100) DEFAULT NULL COMMENT 'contacto  de tesoreria 2',
  `ema_tes` varchar(100) DEFAULT NULL COMMENT 'email de contacto de tesoreria ',
  `ema_tes2` varchar(100) DEFAULT NULL COMMENT 'email de contacto de tesoreria 2',
  `con_cont` varchar(100) DEFAULT NULL COMMENT 'contacto de contabilidad',
  `con_cont2` varchar(100) DEFAULT NULL COMMENT 'contacto de contabilidad 2',
  `ema_cont` varchar(100) DEFAULT NULL COMMENT 'email de contacto de contabilidad',
  `ema_cont2` varchar(100) DEFAULT NULL COMMENT 'email de contacto de contabilidad 2'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cre_env_mercancia`
--

CREATE TABLE `cre_env_mercancia` (
  `id_mer` int(11) NOT NULL,
  `direcion_1` varchar(100) DEFAULT NULL,
  `direcion_2` varchar(100) DEFAULT NULL,
  `direcion_3` varchar(100) DEFAULT NULL,
  `ciudad_1` varchar(100) DEFAULT NULL,
  `ciudad_2` varchar(100) DEFAULT NULL,
  `ciudad_3` varchar(100) DEFAULT NULL,
  `telefono_1` int(30) DEFAULT NULL,
  `telefono_2` int(30) DEFAULT NULL,
  `telefono_3` int(30) DEFAULT NULL,
  `horario_1` int(30) DEFAULT NULL,
  `horario1_1` int(30) DEFAULT NULL COMMENT 'hora final del despacho ',
  `horario_2` int(30) DEFAULT NULL,
  `horario2_2` int(11) DEFAULT NULL COMMENT 'horario  de despachos ',
  `horario_3` int(11) DEFAULT NULL,
  `horario3_3` int(11) DEFAULT NULL COMMENT 'hora final del despacho ',
  `id_cli` varchar(45) DEFAULT NULL,
  `id_sol` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cre_estadosol`
--

CREATE TABLE `cre_estadosol` (
  `id_est` int(11) NOT NULL,
  `nom_est` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cre_eva_clie`
--

CREATE TABLE `cre_eva_clie` (
  `id_evaCl` int(11) NOT NULL,
  `ref_bancu` varchar(500) DEFAULT NULL COMMENT 'primera referencia bancaria',
  `ref_bancd` varchar(600) DEFAULT NULL COMMENT 'segunda referencia bancaria ',
  `ref_comeru` varchar(600) DEFAULT NULL COMMENT 'primera referencia comercial ',
  `ref_comerd` varchar(600) DEFAULT NULL COMMENT 'segunda referencia comercial',
  `super_socie` varchar(600) DEFAULT NULL COMMENT 'superintendecia de sociedades',
  `reg_emp` varchar(600) DEFAULT NULL COMMENT 'registro único empresarial ',
  `fech_ini` datetime DEFAULT NULL COMMENT 'fecha inicial del indice de estados financieros',
  `fech_fin` datetime DEFAULT NULL COMMENT 'fecha terminal de indices financieros',
  `act_in` varchar(70) DEFAULT NULL COMMENT 'activo corriente inicial',
  `act_fin` varchar(70) DEFAULT NULL COMMENT 'activo corriente final',
  `pas_ini` varchar(70) DEFAULT NULL COMMENT 'pasivo corriente inicial',
  `pas_fin` varchar(70) DEFAULT NULL COMMENT 'pasivo corriente final',
  `activ_in` varchar(70) DEFAULT NULL COMMENT 'activo inicial ',
  `activ_fin` varchar(70) DEFAULT NULL COMMENT 'activo final',
  `pasiv_in` varchar(70) DEFAULT NULL COMMENT 'pasivo inicial',
  `pasiv_fin` varchar(70) DEFAULT NULL COMMENT 'pasivo final',
  `capi_pag` varchar(70) DEFAULT NULL COMMENT 'capital pagado ',
  `ingop_in` varchar(70) DEFAULT NULL COMMENT 'ingreso operacional inicial ',
  `ingop_fin` varchar(70) DEFAULT NULL COMMENT 'ingreso operacional final ',
  `utope_in` varchar(70) DEFAULT NULL COMMENT 'utilidad operacional incial',
  `utope_fin` varchar(70) DEFAULT NULL COMMENT 'utilidad operacional final',
  `utdesim_in` varchar(700) DEFAULT NULL COMMENT 'utilidad despues de impuestos inicial ',
  `utdesim_fin` varchar(30) DEFAULT NULL COMMENT 'utilidad despues de impuestos final',
  `inv_ini` varchar(700) DEFAULT NULL COMMENT 'inventario incial',
  `inv_fin` varchar(700) DEFAULT NULL COMMENT 'inventario final',
  `id_sol` int(11) NOT NULL,
  `id_cli` varchar(45) NOT NULL,
  `fech_actua` date DEFAULT NULL COMMENT 'fecha de actualización '
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cre_factura`
--

CREATE TABLE `cre_factura` (
  `id_factura` int(11) NOT NULL,
  `telfono_fac` varchar(15) DEFAULT NULL,
  `direccion` varchar(1000) DEFAULT NULL,
  `ciudad` varchar(15) DEFAULT NULL,
  `num_copias` varchar(10) DEFAULT NULL COMMENT 'numero de copias',
  `cer_calidad` varchar(11) DEFAULT NULL COMMENT 'exige certificado de calidad',
  `ext_comp` varchar(11) DEFAULT NULL COMMENT 'exige orden de compra',
  `ext_remis` varchar(11) DEFAULT NULL COMMENT 'exige remisión',
  `id_cli` varchar(45) DEFAULT NULL,
  `id_sol` int(11) DEFAULT NULL,
  `hor_fac` varchar(30) DEFAULT NULL COMMENT 'horario de la factura'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cre_solicitud`
--

CREATE TABLE `cre_solicitud` (
  `id_sol` int(11) NOT NULL,
  `nom_rep` varchar(1000) DEFAULT NULL COMMENT 'nombre del representante legal',
  `fec_sol` date DEFAULT NULL COMMENT 'fecha de solicitud',
  `act_eco` varchar(150) DEFAULT NULL COMMENT 'actividad economica',
  `activ_solicitada` int(5) DEFAULT NULL COMMENT 'actividad solicitada',
  `tiem_merc` bigint(20) DEFAULT NULL COMMENT 'tiempo en el mercado',
  `num_emple` varchar(30) DEFAULT NULL COMMENT 'numero de empleados',
  `cupo_sol` mediumtext COMMENT 'cupo de credito solicitado ',
  `term_pag` varchar(100) DEFAULT NULL COMMENT 'termino de pago',
  `dia_pag` varchar(45) DEFAULT NULL COMMENT 'dias en que se realiza el pago ',
  `reg_clie` varchar(45) DEFAULT NULL COMMENT 'regimen del cliente',
  `cupoSugA` varchar(45) DEFAULT NULL COMMENT 'cupo sugerido por ATC',
  `plaSugeA` varchar(100) DEFAULT NULL COMMENT 'plazo sugerido por atc',
  `jusPlaCup` varchar(300) DEFAULT NULL COMMENT 'justificacion del plazo y cupo de atc ',
  `cup_aut` varchar(300) DEFAULT NULL COMMENT 'cupo de credito autorizado',
  `term_auto` varchar(30) DEFAULT NULL COMMENT 'termino de pago autorizado',
  `ob_cupasig` varchar(10000) DEFAULT NULL COMMENT 'observacion del cupo asignado',
  `retFuen` varchar(45) DEFAULT NULL COMMENT 'retencion de la fuente',
  `id_cont` varchar(10) DEFAULT NULL,
  `id_cli` varchar(45) DEFAULT NULL,
  `id_est` int(11) DEFAULT NULL,
  `eml_enviado` int(4) NOT NULL DEFAULT '0',
  `segm_clie` varchar(30) DEFAULT NULL COMMENT 'segmento del cliente',
  `congen_ase` varchar(300) DEFAULT NULL COMMENT 'concepto general del asesor ',
  `ana_referen` varchar(500) DEFAULT NULL COMMENT 'análisis de referencias ',
  `doc_consGer` varchar(1000) DEFAULT NULL,
  `doc_rut` varchar(1000) DEFAULT NULL,
  `doc_estFin` varchar(1000) DEFAULT NULL,
  `doc_refCom` varchar(1000) DEFAULT NULL,
  `doc_refcom2` varchar(1000) DEFAULT NULL,
  `doc_refBanc` varchar(1000) DEFAULT NULL,
  `doc_form` varchar(1000) DEFAULT NULL COMMENT 'documento formulario  de solicitud de credito',
  `id_usu` varchar(45) DEFAULT NULL,
  `tiem_rad` varchar(45) DEFAULT NULL COMMENT 'tiempo de años y meses del tiempo en el mercado ',
  `obser_perm` varchar(300) DEFAULT NULL COMMENT 'observación de por que se le da en pendiente al ',
  `num_letra` varchar(150) DEFAULT NULL COMMENT 'numero en letras del cupo autorizado ',
  `cau_rec` varchar(100) DEFAULT NULL COMMENT 'tipo de rechazo ',
  `fecha_crea` date DEFAULT NULL COMMENT 'fecha del sistema',
  `ase_com` varchar(45) DEFAULT NULL COMMENT 'asesor comercial',
  `rep_sac` varchar(20) DEFAULT NULL COMMENT 'representante SAC',
  `nom_sac` varchar(100) DEFAULT NULL,
  `nom_atc` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cre_solicitud2`
--

CREATE TABLE `cre_solicitud2` (
  `id_sol` int(11) NOT NULL,
  `nom_rep` varchar(1000) DEFAULT NULL COMMENT 'nombre del representante legal',
  `fec_sol` date DEFAULT NULL COMMENT 'fecha de solicitud',
  `act_eco` varchar(150) DEFAULT NULL COMMENT 'actividad economica',
  `activ_solicitada` int(5) DEFAULT NULL COMMENT 'actividad solicitada',
  `tiem_merc` bigint(20) DEFAULT NULL COMMENT 'tiempo en el mercado',
  `num_emple` varchar(30) DEFAULT NULL COMMENT 'numero de empleados',
  `cupo_sol` mediumtext COMMENT 'cupo de credito solicitado ',
  `term_pag` varchar(100) DEFAULT NULL COMMENT 'termino de pago',
  `dia_pag` varchar(45) DEFAULT NULL COMMENT 'dias en que se realiza el pago ',
  `reg_clie` varchar(45) DEFAULT NULL COMMENT 'regimen del cliente',
  `cupoSugA` varchar(45) DEFAULT NULL COMMENT 'cupo sugerido por ATC',
  `plaSugeA` varchar(100) DEFAULT NULL COMMENT 'plazo sugerido por atc',
  `jusPlaCup` varchar(300) DEFAULT NULL COMMENT 'justificacion del plazo y cupo de atc ',
  `cup_aut` varchar(300) DEFAULT NULL COMMENT 'cupo de credito autorizado',
  `term_auto` varchar(30) DEFAULT NULL COMMENT 'termino de pago autorizado',
  `ob_cupasig` varchar(10000) DEFAULT NULL COMMENT 'observacion del cupo asignado',
  `retFuen` varchar(45) DEFAULT NULL COMMENT 'retencion de la fuente',
  `id_cont` varchar(10) DEFAULT NULL,
  `id_cli` varchar(45) DEFAULT NULL,
  `id_est` int(11) DEFAULT NULL,
  `eml_enviado` int(4) NOT NULL DEFAULT '0',
  `segm_clie` varchar(30) DEFAULT NULL COMMENT 'segmento del cliente',
  `congen_ase` varchar(300) DEFAULT NULL COMMENT 'concepto general del asesor ',
  `ana_referen` varchar(500) DEFAULT NULL COMMENT 'análisis de referencias ',
  `doc_consGer` varchar(1000) DEFAULT NULL,
  `doc_rut` varchar(1000) DEFAULT NULL,
  `doc_estFin` varchar(1000) DEFAULT NULL,
  `doc_refCom` varchar(1000) DEFAULT NULL,
  `doc_refcom2` varchar(1000) DEFAULT NULL,
  `doc_refBanc` varchar(1000) DEFAULT NULL,
  `doc_form` varchar(1000) DEFAULT NULL COMMENT 'documento formulario  de solicitud de credito',
  `id_usu` varchar(45) DEFAULT NULL,
  `tiem_rad` varchar(45) DEFAULT NULL COMMENT 'tiempo de años y meses del tiempo en el mercado ',
  `obser_perm` varchar(300) DEFAULT NULL COMMENT 'observación de por que se le da en pendiente al ',
  `num_letra` varchar(150) DEFAULT NULL COMMENT 'numero en letras del cupo autorizado ',
  `cau_rec` varchar(100) DEFAULT NULL COMMENT 'tipo de rechazo ',
  `fecha_crea` date DEFAULT NULL COMMENT 'fecha del sistema',
  `ase_com` varchar(45) DEFAULT NULL COMMENT 'asesor comercial',
  `rep_sac` varchar(20) DEFAULT NULL COMMENT 'representante SAC',
  `nom_sac` varchar(100) DEFAULT NULL,
  `nom_atc` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cre_x_mov`
--

CREATE TABLE `cre_x_mov` (
  `id_sol` int(11) DEFAULT NULL,
  `id_usu` varchar(45) CHARACTER SET utf8 DEFAULT NULL,
  `id_est` int(11) DEFAULT NULL,
  `fech_crm` datetime DEFAULT NULL COMMENT 'fecha tomada por el sistema '
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `crm_correos`
--

CREATE TABLE `crm_correos` (
  `id_correo` int(11) NOT NULL,
  `id_tra` int(11) DEFAULT NULL COMMENT 'transaccion relacionada',
  `destino` varchar(45) DEFAULT NULL COMMENT 'destino del correo',
  `asunto` varchar(60) DEFAULT NULL COMMENT 'asunto del correo',
  `cuerpo` varchar(400) DEFAULT NULL COMMENT 'cuerpo del correo'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `crm_llamadas`
--

CREATE TABLE `crm_llamadas` (
  `id_llamada` int(11) NOT NULL,
  `id_tra` int(11) DEFAULT NULL COMMENT 'transaccion relacionada',
  `destino` varchar(20) DEFAULT NULL COMMENT 'destino de la llamada',
  `agendar` varchar(2) DEFAULT NULL COMMENT 'Si se agendó o no',
  `observacion` varchar(100) DEFAULT NULL COMMENT 'observaciones de la llamada'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `crm_notas`
--

CREATE TABLE `crm_notas` (
  `id_nota` int(11) NOT NULL,
  `id_tra` int(11) DEFAULT NULL COMMENT 'transaccion relacionada',
  `titulo` varchar(20) DEFAULT NULL COMMENT 'titulo de la nota',
  `contenido` varchar(280) DEFAULT NULL COMMENT 'contenido de la nota'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `crm_recordatorios`
--

CREATE TABLE `crm_recordatorios` (
  `id_recordatorio` int(11) NOT NULL,
  `id_tra` int(11) DEFAULT NULL COMMENT 'transaccion relacionada',
  `fecha_recorda` datetime DEFAULT NULL COMMENT 'fecha a recordar',
  `asunto` varchar(45) DEFAULT NULL COMMENT 'asunto del recordatorio'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `crm_tipo_tran`
--

CREATE TABLE `crm_tipo_tran` (
  `id_tipo` int(11) NOT NULL,
  `tipo` varchar(15) DEFAULT NULL COMMENT 'nombre del tipo de transaccion'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `crm_transaccion`
--

CREATE TABLE `crm_transaccion` (
  `id_tra` int(11) NOT NULL,
  `fec_crea` datetime DEFAULT CURRENT_TIMESTAMP COMMENT 'Fecha de creación',
  `id_usu` varchar(45) DEFAULT NULL COMMENT 'Usuario que la crea',
  `id_tipo` int(11) DEFAULT NULL COMMENT 'Tipo de transacción',
  `id_neg` int(11) DEFAULT NULL COMMENT 'Negocio relacionado',
  `id_cli` int(11) DEFAULT NULL COMMENT 'Cliente relacionado'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `diligencias_view`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `diligencias_view` (
`num_dlg` int(11)
,`nom_cli` varchar(100)
,`con_dlg` varchar(100)
,`dia_dlg` date
,`dir_dlg` varchar(100)
,`nom_tip_dlg` varchar(45)
,`dil_des` varchar(300)
,`tel_dlg` varchar(100)
,`nom_est_dlg` varchar(10)
,`est_dlg` int(10)
,`id_cli` int(11)
,`id_reg` int(11)
,`nom_reg` varchar(45)
,`nom_res` varchar(45)
);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `encu_covid`
--

CREATE TABLE `encu_covid` (
  `id_cov` int(11) NOT NULL,
  `id_vis` int(11) DEFAULT NULL,
  `temp_ini` varchar(30) DEFAULT NULL,
  `temp_fin` varchar(30) DEFAULT NULL,
  `via_cov` varchar(30) DEFAULT NULL,
  `cont_cov` varchar(30) DEFAULT NULL,
  `diag_cov` varchar(30) DEFAULT NULL,
  `per_cov` varchar(30) DEFAULT NULL,
  `sint_cov` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `enrutamientos_view`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `enrutamientos_view` (
`num_enr` int(11)
,`fec_enr` date
,`fec_crea` date
,`usu_upt` varchar(60)
,`lst_upt` date
,`est_enr` varchar(45)
,`cos_enr` varchar(300)
,`id_reg` int(11)
,`nom_reg` varchar(45)
);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `errornomina_view`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `errornomina_view` (
`id_error` int(11)
,`fech_sis` datetime
,`fech_error` date
,`id_pag` int(11)
,`col_error` varchar(45)
,`erro_obser` varchar(30)
,`error_per` varchar(30)
,`id_estaErr` int(11)
,`mes_err` varchar(30)
,`nom_pag` varchar(30)
,`nom_estaErro` varchar(30)
);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `eventos_view`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `eventos_view` (
`id_act` int(11)
,`mes_act` varchar(11)
,`nom_act` varchar(30)
,`cum_act` varchar(30)
,`nom_usu` varchar(10000)
);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ind_act`
--

CREATE TABLE `ind_act` (
  `id_act` int(11) NOT NULL,
  `fec_act` date DEFAULT NULL COMMENT 'Fecha de la actividad',
  `mes_act` varchar(11) CHARACTER SET utf8 DEFAULT NULL COMMENT 'Mes en el que se realiza la actividad',
  `nom_act` varchar(30) CHARACTER SET utf8 DEFAULT NULL COMMENT 'Nombre de la actividad',
  `cum_act` varchar(30) CHARACTER SET utf8 DEFAULT NULL COMMENT 'Cumplimiento de la actividad',
  `fec_cum` date DEFAULT NULL COMMENT 'Fecha del cumplimiento',
  `fec_sis` datetime DEFAULT NULL COMMENT 'Fecha del sistema',
  `id_usu` varchar(45) CHARACTER SET utf8 DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ind_cap`
--

CREATE TABLE `ind_cap` (
  `id_cap` int(11) NOT NULL,
  `fue_cap` varchar(30) DEFAULT NULL COMMENT 'Fuente o proceso de capacitacion',
  `lug_cap` varchar(30) DEFAULT NULL COMMENT 'Donde se realiza la capacitacion',
  `id_tipcap` int(11) DEFAULT NULL,
  `otro_tip` varchar(30) DEFAULT NULL COMMENT 'Otro tipo de capacitacion',
  `obj_cap` varchar(40) DEFAULT NULL COMMENT 'Objetivo de la capacitacion',
  `tem_cap` varchar(50) DEFAULT NULL COMMENT 'Tema de la capacitación',
  `resp_cap` varchar(40) DEFAULT NULL COMMENT 'Responsable de la capacitación',
  `id_are` int(11) DEFAULT NULL,
  `asis_cap` varchar(60) DEFAULT NULL COMMENT 'Asistentes a capacitación',
  `fec_cap` date DEFAULT NULL COMMENT 'Fecha de la capacitación',
  `eva_cap` varchar(30) DEFAULT NULL COMMENT 'Evaluación de la eficacia de la eficacia de la capacitación',
  `prd_cap` varchar(30) DEFAULT NULL COMMENT 'La capacitación es de producto?',
  `met_cap` varchar(30) DEFAULT NULL COMMENT 'Metodo de evaluacion de la capacitacion',
  `real_cap` varchar(30) DEFAULT NULL COMMENT 'Capacitación realizada',
  `fec_real` date DEFAULT NULL COMMENT 'Fecha de realización de la capacitación',
  `id_usu` varchar(45) DEFAULT NULL,
  `fec_sis` datetime DEFAULT NULL COMMENT 'Fecha del sistema'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ind_cargos`
--

CREATE TABLE `ind_cargos` (
  `id_carg` int(11) NOT NULL,
  `nom_carg` varchar(2000) DEFAULT NULL COMMENT 'nombre del cargo',
  `descr_car` varchar(300) DEFAULT NULL COMMENT 'descripcion del cargo ',
  `rec_car` int(11) DEFAULT NULL COMMENT 'Reclutamiento',
  `ent_car` int(11) DEFAULT NULL COMMENT 'Entrrevistas',
  `pru_car` int(11) DEFAULT NULL COMMENT 'Pruebas',
  `ana_car` int(11) DEFAULT NULL COMMENT 'An?lisis  Desici?n',
  `pol_car` int(11) DEFAULT NULL COMMENT 'Poligrafo',
  `exa_car` int(11) DEFAULT NULL COMMENT 'Vista y Examen m?dico',
  `tot_car` int(11) DEFAULT NULL COMMENT 'Total',
  `id_are` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ind_carg_x_are`
--

CREATE TABLE `ind_carg_x_are` (
  `id_carg` int(11) DEFAULT NULL,
  `id_are` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ind_cert_x_usu`
--

CREATE TABLE `ind_cert_x_usu` (
  `id_cert` int(11) NOT NULL,
  `id_usu` varchar(45) DEFAULT NULL,
  `lugar_remi` varchar(45) DEFAULT NULL COMMENT 'lugar a donde remite el certificado ',
  `id_carg` int(11) NOT NULL,
  `ruta_pdf` varchar(500) DEFAULT NULL COMMENT 'ruta  del documeto ',
  `fec_creacion` date DEFAULT NULL COMMENT 'fecha de creacion ',
  `cer_salario` varchar(30) DEFAULT NULL COMMENT 'certificado con salario	',
  `cer_varia` varchar(30) DEFAULT NULL COMMENT 'certificado con variable	',
  `cer_rodam` varchar(30) DEFAULT NULL COMMENT 'certificado con rodamiento	',
  `cer_sinsal` varchar(30) DEFAULT NULL COMMENT 'certificado sin salario	',
  `prom_varia` varchar(80) DEFAULT NULL COMMENT 'promedio de variable'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ind_clim`
--

CREATE TABLE `ind_clim` (
  `id_clim` int(11) NOT NULL,
  `clima` int(11) DEFAULT NULL COMMENT 'Resultado Evaluación Clima Laboral',
  `fec_clim` date DEFAULT NULL COMMENT 'Fecha de evaluacion',
  `fec_sis` datetime DEFAULT NULL COMMENT 'Fecha del sistema'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ind_desc`
--

CREATE TABLE `ind_desc` (
  `id_desc` int(11) NOT NULL,
  `val_desc` int(11) DEFAULT NULL COMMENT 'Valor del descuento',
  `cuo_des` int(11) DEFAULT NULL COMMENT 'Cantidad de cuotas',
  `per_desc` varchar(30) CHARACTER SET utf8 DEFAULT NULL COMMENT 'Periodicidad de pago',
  `conc_desc` varchar(30) CHARACTER SET utf8 DEFAULT NULL COMMENT 'Concepto del descuento',
  `id_tip_desc` int(11) NOT NULL,
  `otro_tip_desc` varchar(30) DEFAULT NULL COMMENT 'Otro tipo de descuento',
  `id_usu` varchar(45) CHARACTER SET utf8 DEFAULT NULL,
  `id_usus` varchar(45) CHARACTER SET utf8 DEFAULT NULL,
  `id_are` int(11) DEFAULT NULL,
  `id_reg` int(11) DEFAULT NULL,
  `id_estado` int(11) DEFAULT NULL,
  `fec_sis` datetime DEFAULT NULL COMMENT 'Fecha del sistema',
  `fact_desc` varchar(30) DEFAULT NULL COMMENT 'numero de la factura'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ind_desc_esta`
--

CREATE TABLE `ind_desc_esta` (
  `id_estado` int(11) NOT NULL,
  `nom_est` varchar(30) DEFAULT NULL COMMENT 'Nombre de estado',
  `color` varchar(15) DEFAULT NULL COMMENT 'Color de campo'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ind_desc_tip`
--

CREATE TABLE `ind_desc_tip` (
  `id_tip_desc` int(11) NOT NULL,
  `tip_desc` varchar(30) DEFAULT NULL COMMENT 'Tipo de Descuento'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ind_desc_x_seg`
--

CREATE TABLE `ind_desc_x_seg` (
  `id_desc` int(11) DEFAULT NULL,
  `id_usu` varchar(45) CHARACTER SET utf8 DEFAULT NULL COMMENT 'Usuario que modifica el registro',
  `id_are` int(11) DEFAULT NULL,
  `fec_mod` date DEFAULT NULL COMMENT 'Fecha de modificacion',
  `id_estado` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ind_des_cuo`
--

CREATE TABLE `ind_des_cuo` (
  `id_desc` int(11) NOT NULL,
  `cuot_desc` int(15) DEFAULT NULL COMMENT 'Cuota 1 del descuento',
  `fec_desc` date DEFAULT NULL COMMENT 'Fecha de cuota 1 del descuento'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ind_edad`
--

CREATE TABLE `ind_edad` (
  `id_edad` int(11) NOT NULL,
  `num_edad` varchar(30) DEFAULT NULL COMMENT 'numero de edad'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ind_errores`
--

CREATE TABLE `ind_errores` (
  `id_error` int(11) NOT NULL,
  `fech_sis` datetime DEFAULT NULL COMMENT 'fecha de sistema creada por el usuario ',
  `fech_error` date DEFAULT NULL COMMENT 'fecha detectada del error',
  `id_pag` int(11) DEFAULT NULL,
  `col_error` varchar(45) DEFAULT NULL COMMENT 'colaborador del error',
  `erro_obser` varchar(30) DEFAULT NULL COMMENT 'observación del error  ',
  `error_per` varchar(30) NOT NULL COMMENT 'error de nomina ',
  `id_estaErr` int(11) DEFAULT NULL,
  `mes_err` varchar(30) DEFAULT NULL COMMENT 'mes del error'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ind_estados`
--

CREATE TABLE `ind_estados` (
  `id_estaSol` int(11) NOT NULL,
  `nom_estS` varchar(30) DEFAULT NULL COMMENT 'nombre del estado',
  `color` varchar(15) DEFAULT NULL COMMENT 'color del estado',
  `back-ground` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ind_estad_error`
--

CREATE TABLE `ind_estad_error` (
  `id_estaErr` int(11) DEFAULT NULL COMMENT 'id_estado de error de nomina ',
  `nom_estaErro` varchar(30) CHARACTER SET utf8 DEFAULT NULL COMMENT 'id_estado de error de nomina'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ind_fechas`
--

CREATE TABLE `ind_fechas` (
  `id_relPag` int(11) NOT NULL,
  `id_pag` int(11) DEFAULT NULL COMMENT 'nombre del pago',
  `fech_pag` date DEFAULT NULL COMMENT 'fecha de pago',
  `fech_ref` date DEFAULT NULL COMMENT 'fecha de referencia ',
  `fec_ent` date DEFAULT NULL COMMENT 'fecha de entrega ',
  `dias_indicador` varchar(30) CHARACTER SET utf8 DEFAULT NULL COMMENT 'días de la diferencia  '
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ind_infoli`
--

CREATE TABLE `ind_infoli` (
  `id_liqui` int(11) NOT NULL,
  `id_are` int(11) DEFAULT NULL,
  `id_usu` varchar(45) CHARACTER SET utf8 DEFAULT NULL,
  `id_liquiInf` int(11) DEFAULT NULL,
  `obs_info` varchar(30) CHARACTER SET utf8 DEFAULT NULL COMMENT 'observacion ',
  `fech_pag` date DEFAULT NULL COMMENT 'fecha de pago',
  `fech_ref` date DEFAULT NULL COMMENT 'fecha de referencia entrgar a tesoreria',
  `dias_habiles` varchar(30) CHARACTER SET utf8 DEFAULT NULL COMMENT 'dias habiles',
  `fec_ret` date DEFAULT NULL COMMENT 'Fecha de retiro',
  `fech_sis` datetime NOT NULL COMMENT 'fecha de sistema'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ind_liqui`
--

CREATE TABLE `ind_liqui` (
  `id_liquiInf` int(11) NOT NULL,
  `nom_liqui` varchar(100) DEFAULT NULL COMMENT 'nombre de la liquidación'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ind_mes`
--

CREATE TABLE `ind_mes` (
  `id_mes` int(11) NOT NULL COMMENT 'id mes indicador ',
  `nom_mes` varchar(30) COLLATE latin1_general_ci DEFAULT NULL COMMENT 'mes'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ind_nompag`
--

CREATE TABLE `ind_nompag` (
  `id_pag` int(11) NOT NULL,
  `nom_pag` varchar(30) DEFAULT NULL COMMENT 'nombre del pago'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ind_select_per`
--

CREATE TABLE `ind_select_per` (
  `id_sel` int(11) NOT NULL,
  `id_solC` int(11) DEFAULT NULL,
  `id_usu` varchar(45) DEFAULT NULL,
  `id_per` bigint(20) DEFAULT NULL,
  `nom_per` varchar(50) DEFAULT NULL,
  `cel_per` bigint(20) DEFAULT NULL,
  `ema_ent` varchar(100) DEFAULT NULL COMMENT 'email del usuario ',
  `fec_ent` date DEFAULT NULL,
  `obs_sel` varchar(600) DEFAULT NULL COMMENT 'Observación Adicional',
  `id_estaSol` int(11) DEFAULT NULL,
  `obs_lid` varchar(400) DEFAULT NULL COMMENT 'Observación de Líder',
  `obs_th` varchar(400) DEFAULT NULL COMMENT 'Observación de Talento H',
  `obs_ger` varchar(400) DEFAULT NULL COMMENT 'Observación de Gerente ',
  `fec_cre` datetime DEFAULT NULL COMMENT 'Fecha de Creación',
  `req_sol` int(11) DEFAULT NULL COMMENT 'Requisiciór solicitud',
  `pro_entre` varchar(30) DEFAULT NULL COMMENT 'Proceso de entrevista',
  `pro_prue` varchar(30) DEFAULT NULL COMMENT 'Proceso de Pruebas ',
  `pro_ana` varchar(30) DEFAULT NULL COMMENT 'Proceso de analisis y decision ',
  `pro_poli` varchar(30) DEFAULT NULL COMMENT 'proceso de polígrafo ',
  `pro_visi` varchar(30) DEFAULT NULL COMMENT 'proceso  de visita y examen',
  `fec_req` datetime DEFAULT NULL COMMENT 'fecha de actualiza del estado ',
  `hor_ent` varchar(30) DEFAULT NULL COMMENT 'hora de la entrevista ',
  `obs_rech` varchar(150) DEFAULT NULL COMMENT 'observación de personal'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ind_solcarg`
--

CREATE TABLE `ind_solcarg` (
  `id_solC` int(11) NOT NULL,
  `sal_sol` varchar(30) DEFAULT NULL COMMENT 'salario del cargo ',
  `var_sal` int(11) DEFAULT NULL COMMENT 'Variable',
  `rod_sal` varchar(11) DEFAULT NULL COMMENT 'Rodamiento',
  `area_sol` varchar(30) DEFAULT NULL COMMENT 'area que se solicita el cargo ',
  `carg_sol` varchar(30) DEFAULT NULL COMMENT 'cargo que se solicita',
  `cont_sol` varchar(30) DEFAULT NULL COMMENT 'tipo de contrato',
  `fecha_sol` date DEFAULT NULL COMMENT 'fecha de creación de la solicitud',
  `fesi_sol` datetime DEFAULT NULL COMMENT 'fecha tomada del sistema',
  `per_sol` varchar(30) DEFAULT NULL COMMENT 'cantidad de personas',
  `id_edad` int(11) DEFAULT NULL,
  `id_estaSol` int(11) DEFAULT NULL,
  `id_usu` varchar(45) DEFAULT NULL,
  `obs_sol` varchar(150) DEFAULT NULL COMMENT 'observacion del cargo',
  `concep_sol` varchar(150) DEFAULT NULL COMMENT 'consepto de por que crear un nuevo cargo',
  `car_sol` varchar(30) DEFAULT NULL COMMENT 'el cargo es nuevo',
  `fec_rec` datetime DEFAULT NULL COMMENT 'Fecha recibida la solicitud',
  `fec_fin` datetime DEFAULT NULL COMMENT 'Fecha Finalización para el cargo',
  `fec_estip` date DEFAULT NULL COMMENT 'fecha estipulada para que se cumpla el indicador ',
  `obs_rec` varchar(150) DEFAULT NULL COMMENT 'Observación Solicitud'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ind_tipcap`
--

CREATE TABLE `ind_tipcap` (
  `id_tipcap` int(11) NOT NULL,
  `tip_cap` varchar(30) DEFAULT NULL COMMENT 'Tipo de capacitación'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ind_tipcontrato`
--

CREATE TABLE `ind_tipcontrato` (
  `id_tipcont` int(11) NOT NULL,
  `nom_contrato` varchar(150) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `inv_config`
--

CREATE TABLE `inv_config` (
  `id` int(11) NOT NULL COMMENT 'Id de la configuración',
  `clave` varchar(50) NOT NULL COMMENT 'Clave de la opción de configuración',
  `valor` varchar(255) DEFAULT NULL COMMENT 'Valor de la opción de configuración'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `inv_est_sol`
--

CREATE TABLE `inv_est_sol` (
  `id_est_sol` int(4) NOT NULL COMMENT 'Id autoincrementable estado solicitud',
  `nom_est_sol` varchar(100) NOT NULL COMMENT 'Nombre estado de la solicitud',
  `color_est` varchar(50) NOT NULL COMMENT 'Color dependiendo del estado'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `inv_inventario`
--

CREATE TABLE `inv_inventario` (
  `id_inv` int(12) NOT NULL COMMENT 'Id autoincrementable inventario',
  `id_prod` int(12) NOT NULL COMMENT 'FK id producto',
  `id_reg` int(12) NOT NULL COMMENT 'FK id regional',
  `cantidad` int(20) NOT NULL COMMENT 'Cantidad de productos disponibles',
  `fec_asig` datetime NOT NULL COMMENT 'Fecha de asignación del producto',
  `usu_asig` int(12) NOT NULL COMMENT 'Usuario quien asigno el producto'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `inv_inventario_view`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `inv_inventario_view` (
`id_inv` int(12)
,`id_prod` int(12)
,`nom_prod` varchar(150)
,`img_prod` varchar(500)
,`cantidad` int(20)
,`id_reg` int(12)
);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `inv_inventario_x_area_view`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `inv_inventario_x_area_view` (
`id_inv` int(12)
,`id_prod` int(12)
,`nom_prod` varchar(150)
,`img_prod` varchar(500)
,`cantidad` int(20)
,`can_max` int(11)
,`id_reg` int(12)
,`id_are` int(11)
);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `inv_mov_inventario`
--

CREATE TABLE `inv_mov_inventario` (
  `id_mov` int(5) NOT NULL COMMENT 'Id movimiento Inventario MQ',
  `id_prod` int(10) NOT NULL COMMENT 'Id producto FK - inv_product',
  `id_reg` int(11) NOT NULL COMMENT 'Id regional FK mq_reg',
  `razon` varchar(100) NOT NULL COMMENT 'Motivo por el cual se presento el movimiento',
  `razon_det` varchar(1000) DEFAULT NULL COMMENT 'Razón detallada del movimiento',
  `cant_ant` int(20) NOT NULL COMMENT 'Cantidad antes del movimiento',
  `new_cant` int(20) NOT NULL COMMENT 'Cantidad después del movimiento',
  `fec_mov` datetime NOT NULL COMMENT 'Fecha del movimiento',
  `usu_mov` varchar(45) NOT NULL COMMENT 'Usuario quien realizo el movimiento'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `inv_mov_inventario_view`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `inv_mov_inventario_view` (
`id_mov` int(5)
,`id_prod` int(10)
,`nom_prod` varchar(150)
,`img_prod` varchar(500)
,`razon` varchar(100)
,`razon_det` varchar(1000)
,`cant_ant` int(20)
,`new_cant` int(20)
,`fec_mov` datetime
,`usu_mov` varchar(45)
,`nom_usu` varchar(10000)
);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `inv_product`
--

CREATE TABLE `inv_product` (
  `id_prod` int(10) NOT NULL COMMENT 'Id del producto autoincrementable Inventarios',
  `nom_prod` varchar(150) NOT NULL COMMENT 'Nombre del producto',
  `desc_prod` varchar(1000) DEFAULT NULL COMMENT 'Descripción del producto',
  `img_prod` varchar(500) NOT NULL COMMENT 'Descripción del producto',
  `req_aprob` int(3) NOT NULL COMMENT 'Requiere Aprobación (1=Si) (0=No)',
  `prod_elim` int(3) NOT NULL DEFAULT '0' COMMENT 'Producto Eliminado (1=Si) (0=No)',
  `fec_crea` datetime NOT NULL COMMENT 'Fecha de creación',
  `usu_crea` int(12) NOT NULL COMMENT 'Id usuario quien crea el producto'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `inv_prod_x_are`
--

CREATE TABLE `inv_prod_x_are` (
  `id` int(11) NOT NULL,
  `id_prod` int(11) NOT NULL,
  `id_are` int(11) NOT NULL,
  `can_max` int(11) NOT NULL,
  `req_aprob` int(3) NOT NULL COMMENT 'Algunos productos necesitan aprobacion; 0 => No necesita; 1 => Necesita aprobacion; 2 => Aprobado; 3 => Rechazado'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `inv_prod_x_are_view`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `inv_prod_x_are_view` (
`id` text
,`id_products` text
,`id_are` int(11)
,`cant_max` text
,`nom_are` varchar(45)
,`nombre_products` text
,`img_products` text
);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `inv_solicitud`
--

CREATE TABLE `inv_solicitud` (
  `id_sol` int(12) NOT NULL COMMENT 'Id autoincrementable solicitud',
  `id_usu` int(12) NOT NULL COMMENT 'FK id usuario quien realiza solicitud',
  `est_sol` int(4) NOT NULL COMMENT 'FK id estado de la solicitud',
  `fec_sol` datetime NOT NULL COMMENT 'Fecha de la solicitud',
  `sol_elim` int(4) NOT NULL DEFAULT '0' COMMENT '0 => Solicitud Activa, 1 => Solicitud Eliminada o Archivada'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `inv_solicitud_view`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `inv_solicitud_view` (
`id_sol` int(12)
,`id_usu` int(12)
,`nom_usu` varchar(10000)
,`est_sol` int(4)
,`fec_sol` datetime
,`sol_elim` int(4)
,`id_products` text
,`img_products` text
,`nom_products` text
,`cant_sol_products` text
,`nom_est_sol` varchar(100)
,`color_est` varchar(50)
);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `inv_sol_detallada_view`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `inv_sol_detallada_view` (
`id_sol` int(12)
,`id_usu` int(12)
,`est_sol` int(4)
,`fec_sol` datetime
,`sol_elim` int(4)
,`id_prod` int(12)
,`img_prod` varchar(500)
,`nom_prod` varchar(150)
,`cant_sol` int(5)
,`entregado` int(3)
,`fec_ent` datetime
,`usu_ent` varchar(45)
,`nom_usu` varchar(10000)
,`aprob_prod` int(3)
,`nom_est_sol` varchar(100)
,`color_est` varchar(50)
);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `inv_sol_x_mov`
--

CREATE TABLE `inv_sol_x_mov` (
  `id_sol` int(12) NOT NULL COMMENT 'FK id solicitud',
  `id_usu` int(12) NOT NULL COMMENT 'FK id usuario',
  `est_sol` int(3) NOT NULL COMMENT 'FK id estado solicitud',
  `fec_mov` datetime NOT NULL COMMENT 'Fecha del movimiento o cambio de la solicitud',
  `obs_mov` varchar(300) DEFAULT NULL COMMENT 'Observacion del movimiento o cambio de la solicitud'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `inv_sol_x_prod`
--

CREATE TABLE `inv_sol_x_prod` (
  `id` int(12) NOT NULL COMMENT 'Id autoincrementable productos relacionados a la solicitud',
  `id_sol` int(12) NOT NULL COMMENT 'FK id de la solicitud respectiva',
  `id_prod` int(12) NOT NULL COMMENT 'FK id del producto solicitado',
  `cant_sol` int(5) NOT NULL COMMENT 'Cantidad del producto solicitada',
  `entregado` int(3) NOT NULL DEFAULT '0' COMMENT 'Si no es igual a la cantidad solicitada, se realizo entrega parcial',
  `aprob_prod` int(3) NOT NULL COMMENT 'Algunos productos necesitan aprobacion; 0 => No necesita; 1 => Necesita aprobacion; 2 => Aprobado; 3 => Rechazado',
  `fec_ent` datetime DEFAULT NULL COMMENT 'Fecha de entrega del producto',
  `usu_ent` varchar(45) DEFAULT NULL COMMENT 'FK Usuario quien realiza la entrega del producto'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `liquidacion_view`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `liquidacion_view` (
`nom_usu` varchar(10000)
,`nom_liqui` varchar(100)
,`nom_are` varchar(45)
,`id_liqui` int(11)
,`id_are` int(11)
,`id_usu` varchar(45)
,`id_liquiInf` int(11)
,`obs_info` varchar(30)
,`fech_pag` date
,`fech_ref` date
,`dias_habiles` varchar(30)
,`fec_ret` date
,`fech_sis` datetime
);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mq_are`
--

CREATE TABLE `mq_are` (
  `id_are` int(11) NOT NULL,
  `nom_are` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mq_clie`
--

CREATE TABLE `mq_clie` (
  `id_cli` varchar(45) NOT NULL COMMENT 'id del cliente',
  `tip_id` varchar(45) DEFAULT NULL COMMENT 'tipo de documento del cliente',
  `nom_cli` varchar(10000) NOT NULL COMMENT 'Nombre del cliente',
  `con_cli` varchar(45) DEFAULT NULL COMMENT 'Nombre del contacto del cliente',
  `dir_cli` varchar(90) DEFAULT NULL COMMENT 'dirección del cliente',
  `tel_cli` varchar(45) DEFAULT NULL COMMENT 'teléfono del cliente',
  `eml_cli` varchar(100) DEFAULT NULL COMMENT 'correo del cliente',
  `web_cli` varchar(200) DEFAULT NULL COMMENT 'sitio web del cliente',
  `hor_cli` varchar(100) DEFAULT NULL COMMENT 'horario del cliente',
  `usu_upt` varchar(45) DEFAULT NULL COMMENT 'usuario que realizo la ultima actualizacion del cliente\n',
  `lst_upt` datetime DEFAULT NULL COMMENT 'fecha de la ultima actualizacion ',
  `fec_cre` datetime DEFAULT NULL COMMENT 'fecha de creacion ',
  `id_reg` int(11) DEFAULT NULL COMMENT 'Id de la regional del cliente',
  `tip_clie` varchar(23) DEFAULT NULL COMMENT 'tipo de cliente segun el asesor',
  `telefono_fijo` varchar(11) DEFAULT NULL COMMENT 'telefono fijo ',
  `seg_cliente` varchar(30) DEFAULT NULL COMMENT 'area que corresponde al cliente ',
  `cargo_conta` varchar(30) DEFAULT NULL COMMENT 'cargo del contacto ',
  `activ_solicitada` varchar(30) DEFAULT NULL COMMENT 'actividad solicitada',
  `ase_com` varchar(45) DEFAULT NULL COMMENT 'asesor comercial',
  `rep_sac` varchar(20) DEFAULT NULL COMMENT 'representante de servicio al cliente',
  `tel_cont` varchar(15) DEFAULT NULL COMMENT 'teléfono del contacto',
  `id_tipcli` varchar(60) DEFAULT NULL COMMENT 'Tip de cliente  de descuentos'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mq_clientes`
--

CREATE TABLE `mq_clientes` (
  `id_cli` int(11) NOT NULL COMMENT 'Identificador',
  `nom_cli` varchar(100) CHARACTER SET utf8 NOT NULL COMMENT 'Nombre o razón social',
  `tip_doc` varchar(5) CHARACTER SET utf8 DEFAULT 'NIT' COMMENT 'Tipo documento',
  `num_doc` varchar(45) CHARACTER SET utf8 DEFAULT NULL COMMENT 'Numero de documento',
  `id_tipo` int(11) DEFAULT NULL COMMENT 'Tipo de cliente',
  `id_cat` int(11) DEFAULT '1' COMMENT 'Id categoria de cliente',
  `id_act` int(11) DEFAULT NULL COMMENT 'Id actividad económica del cliente',
  `tel_cli` varchar(60) CHARACTER SET utf8 DEFAULT NULL COMMENT 'Teléfono de cliente',
  `eml_cli` varchar(45) CHARACTER SET utf8 NOT NULL COMMENT 'Correo del cliente',
  `web_cli` varchar(90) CHARACTER SET utf8 DEFAULT NULL COMMENT 'Web del cliente',
  `zip_cli` int(15) DEFAULT NULL COMMENT 'Código postal del cliente',
  `hor_cli1` time DEFAULT '07:00:00' COMMENT 'Hora 1 de horario',
  `hor_cli2` time DEFAULT '17:00:00' COMMENT 'Hora 2 de horario',
  `dir_cli` varchar(90) CHARACTER SET utf8 DEFAULT NULL COMMENT 'Dirección del cliente',
  `id_ciu` int(11) DEFAULT '1' COMMENT 'Ciudad del cliente',
  `log_cli` varchar(100) CHARACTER SET utf8 DEFAULT NULL COMMENT 'Logo del cliente',
  `tip_clie` varchar(23) DEFAULT NULL COMMENT 'Tipo de cliente segun el asesor',
  `ase_com` varchar(20) CHARACTER SET utf8 DEFAULT NULL COMMENT 'Asesor técnico comercial',
  `rep_sac` varchar(20) CHARACTER SET utf8 DEFAULT NULL COMMENT 'Representante SAC',
  `id_usu` varchar(20) CHARACTER SET utf8 DEFAULT NULL COMMENT 'Usuario que registra el cliente',
  `fec_crea` datetime DEFAULT CURRENT_TIMESTAMP COMMENT 'Fecha de creación',
  `act_eco` varchar(200) DEFAULT NULL COMMENT 'actividad economica'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Nueva tabla de clientes, unificar datos de clientes en esta tabla';

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mq_clientesTEMP`
--

CREATE TABLE `mq_clientesTEMP` (
  `id_cli` int(11) NOT NULL COMMENT 'Identificador',
  `id_cliente` int(50) NOT NULL COMMENT 'id antiguo cliente',
  `nom_cli` varchar(100) CHARACTER SET utf8 NOT NULL COMMENT 'Nombre o raz�n social',
  `tip_doc` varchar(5) CHARACTER SET utf8 DEFAULT 'NIT' COMMENT 'Tipo documento',
  `num_doc` varchar(45) CHARACTER SET utf8 DEFAULT NULL COMMENT 'Numero de documento',
  `id_tipo` int(11) DEFAULT NULL COMMENT 'Tipo de cliente',
  `id_cat` int(11) DEFAULT '1' COMMENT 'Id categoria de cliente',
  `id_act` int(11) DEFAULT NULL COMMENT 'Id actividad econ�mica del cliente',
  `tel_cli` varchar(60) CHARACTER SET utf8 DEFAULT NULL COMMENT 'Tel�fono de cliente',
  `eml_cli` varchar(45) CHARACTER SET utf8 NOT NULL COMMENT 'Correo del cliente',
  `web_cli` varchar(90) CHARACTER SET utf8 DEFAULT NULL COMMENT 'Web del cliente',
  `zip_cli` int(15) DEFAULT NULL COMMENT 'C�digo postal del cliente',
  `hor_cli1` time DEFAULT '07:00:00' COMMENT 'Hora 1 de horario',
  `hor_cli2` time DEFAULT '17:00:00' COMMENT 'Hora 2 de horario',
  `dir_cli` varchar(90) CHARACTER SET utf8 DEFAULT NULL COMMENT 'Direcci�n del cliente',
  `id_ciu` int(11) DEFAULT '1' COMMENT 'Ciudad del cliente',
  `log_cli` varchar(100) CHARACTER SET utf8 DEFAULT NULL COMMENT 'Logo del cliente',
  `ase_com` varchar(20) CHARACTER SET utf8 DEFAULT NULL COMMENT 'Asesor t�cnico comercial',
  `rep_sac` varchar(20) CHARACTER SET utf8 DEFAULT NULL COMMENT 'Representante SAC',
  `id_usu` varchar(20) CHARACTER SET utf8 DEFAULT NULL COMMENT 'Usuario que registra el cliente',
  `fec_crea` datetime DEFAULT CURRENT_TIMESTAMP COMMENT 'Fecha de creaci�n'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mq_diligencias`
--

CREATE TABLE `mq_diligencias` (
  `num_dlg` int(11) NOT NULL COMMENT 'numero de la diligencia',
  `dir_dlg` varchar(100) DEFAULT NULL COMMENT 'direccion de diligencia',
  `tel_dlg` varchar(100) DEFAULT NULL COMMENT 'Teléfono de diligencia',
  `con_dlg` varchar(100) DEFAULT NULL COMMENT 'contacto de la empresa',
  `hor_dlg` varchar(50) DEFAULT NULL COMMENT 'horario de diligencia',
  `dia_dlg` date DEFAULT NULL COMMENT 'día de la diligencia',
  `obs_dlg` varchar(1000) DEFAULT NULL COMMENT 'Observaciones de la Diligencia',
  `dil_des` varchar(300) DEFAULT NULL COMMENT 'Descripción de la diligencia',
  `est_dlg` int(10) DEFAULT NULL COMMENT 'estado de diligencia',
  `efc_dlg` int(10) DEFAULT NULL COMMENT 'Efectiva Si/NO',
  `fec_cre` datetime DEFAULT NULL COMMENT 'Fecha de creación de la diligencia',
  `lst_upt` datetime DEFAULT NULL COMMENT 'ultima actualizaciòn',
  `cos_dlg` varchar(11) DEFAULT NULL COMMENT 'Costos de la diligencia',
  `id_cli` varchar(45) DEFAULT NULL,
  `id_tip_dlg` int(11) NOT NULL,
  `id_reg` int(11) NOT NULL,
  `usu_upt` varchar(45) DEFAULT NULL COMMENT 'usuario que actualizo',
  `nom_res` varchar(45) DEFAULT NULL COMMENT 'Usuario responsable',
  `fot_dlg` varchar(300) DEFAULT NULL COMMENT 'Foto del lugar de la diligencia'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mq_diligencias1`
--

CREATE TABLE `mq_diligencias1` (
  `num_dlg` int(11) NOT NULL COMMENT 'numero de la diligencia',
  `dir_dlg` varchar(100) DEFAULT NULL COMMENT 'direccion de diligencia',
  `tel_dlg` varchar(100) DEFAULT NULL COMMENT 'Teléfono de diligencia',
  `con_dlg` varchar(100) DEFAULT NULL COMMENT 'contacto de la empresa',
  `hor_dlg` varchar(50) DEFAULT NULL COMMENT 'horario de diligencia',
  `dia_dlg` date DEFAULT NULL COMMENT 'día de la diligencia',
  `obs_dlg` varchar(1000) DEFAULT NULL COMMENT 'Observaciones de la Diligencia',
  `dil_des` varchar(300) DEFAULT NULL COMMENT 'Descripción de la diligencia',
  `est_dlg` int(10) DEFAULT NULL COMMENT 'estado de diligencia',
  `efc_dlg` int(10) DEFAULT NULL COMMENT 'Efectiva Si/NO',
  `fec_cre` datetime DEFAULT NULL COMMENT 'Fecha de creación de la diligencia',
  `lst_upt` datetime DEFAULT NULL COMMENT 'ultima actualizaciòn',
  `cos_dlg` varchar(11) DEFAULT NULL COMMENT 'Costos de la diligencia',
  `id_cli` varchar(45) DEFAULT NULL,
  `id_tip_dlg` int(11) NOT NULL,
  `id_reg` int(11) NOT NULL,
  `usu_upt` varchar(45) DEFAULT NULL COMMENT 'usuario que actualizo',
  `nom_res` varchar(45) DEFAULT NULL COMMENT 'Usuario responsable',
  `fot_dlg` varchar(300) DEFAULT NULL COMMENT 'Foto del lugar de la diligencia'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mq_dilig_x_enrt`
--

CREATE TABLE `mq_dilig_x_enrt` (
  `num_dlg` int(11) NOT NULL COMMENT 'numero de la diligencia',
  `num_enr` int(11) NOT NULL COMMENT 'numero de enrutamiento',
  `num_ord` varchar(45) CHARACTER SET utf8 NOT NULL COMMENT 'Numero de orden'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mq_enrt`
--

CREATE TABLE `mq_enrt` (
  `num_enr` int(11) NOT NULL COMMENT 'numero de enrutamiento',
  `fec_enr` date DEFAULT NULL COMMENT 'fecha de enrutamiento',
  `fec_crea` date DEFAULT NULL COMMENT 'fecha de creacion del enrutamiento',
  `usu_upt` varchar(60) CHARACTER SET utf8 DEFAULT NULL COMMENT 'usuario que actualizo el enrutamiento',
  `lst_upt` date DEFAULT NULL COMMENT 'fecha de la ultima actualizacion del enrutamiento',
  `est_enr` varchar(45) CHARACTER SET utf8 DEFAULT NULL COMMENT 'Estado del enrutamiento\\nnuevo\\nen ruta\\ncompleto \\nincompleto',
  `cos_enr` varchar(300) CHARACTER SET utf8 DEFAULT NULL COMMENT 'Costos Adicionales',
  `id_reg` int(11) DEFAULT NULL COMMENT 'Id de la regional'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mq_est_dlg`
--

CREATE TABLE `mq_est_dlg` (
  `id_est_dlg` tinyint(4) NOT NULL COMMENT 'id del estado de la diligencia',
  `nom_est_dlg` varchar(10) NOT NULL COMMENT 'nombre del estado de la diligencia'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mq_hist`
--

CREATE TABLE `mq_hist` (
  `num_hist` int(11) NOT NULL COMMENT 'numero del historial',
  `fec_act` varchar(45) DEFAULT NULL COMMENT 'fecha de actualizacion',
  `num_dlg` int(11) DEFAULT NULL COMMENT 'numero de diligencia',
  `usu_upt` varchar(45) DEFAULT NULL COMMENT 'usuario que actualizo',
  `est_ant` varchar(45) DEFAULT NULL COMMENT 'estado anterior de la diligencia',
  `est_dlg` varchar(45) DEFAULT NULL COMMENT 'estado de la diligencia',
  `efec_dlg` varchar(45) DEFAULT NULL COMMENT 'efectividad de la diligencia'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mq_inventarios`
--

CREATE TABLE `mq_inventarios` (
  `id_rolinv` int(11) NOT NULL,
  `nom_rol` varchar(50) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mq_lider`
--

CREATE TABLE `mq_lider` (
  `id_are` int(11) DEFAULT NULL,
  `id_lider` int(11) DEFAULT NULL,
  `nom_lider` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mq_log`
--

CREATE TABLE `mq_log` (
  `id` int(11) NOT NULL,
  `social_id` varchar(45) DEFAULT NULL,
  `id_usu` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mq_per`
--

CREATE TABLE `mq_per` (
  `id_per` int(11) NOT NULL COMMENT 'Id del permiso',
  `nom_per` varchar(45) DEFAULT NULL COMMENT 'nombre del permiso',
  `padre` int(11) DEFAULT NULL COMMENT 'Permiso padre'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mq_pers`
--

CREATE TABLE `mq_pers` (
  `id_per` int(11) NOT NULL,
  `nom_per` varchar(50) DEFAULT NULL,
  `eps_per` varchar(45) DEFAULT NULL,
  `arl_per` varchar(45) DEFAULT NULL,
  `emp_per` varchar(100) DEFAULT NULL,
  `con_per` varchar(100) DEFAULT NULL,
  `tel_con` varchar(45) DEFAULT NULL,
  `tel_per` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mq_prove`
--

CREATE TABLE `mq_prove` (
  `id_prove` int(60) NOT NULL,
  `dig_ver` varchar(30) DEFAULT NULL COMMENT 'digito de verificacion',
  `nom_pro` varchar(50) DEFAULT NULL COMMENT 'mobre del proveedor',
  `direc_prov` varchar(45) DEFAULT NULL COMMENT 'direccion del proveedor',
  `tel_prov` varchar(30) DEFAULT NULL COMMENT 'telefono del proveedor ',
  `ciu_prov` varchar(30) DEFAULT NULL COMMENT 'ciudad del proved',
  `reg_prov` varchar(30) DEFAULT NULL COMMENT 'region del proveedor',
  `email_prov` varchar(50) DEFAULT NULL COMMENT 'email del pro'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mq_reg`
--

CREATE TABLE `mq_reg` (
  `id_reg` int(11) NOT NULL,
  `nom_reg` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mq_rol`
--

CREATE TABLE `mq_rol` (
  `id_rol` int(11) NOT NULL,
  `nom_rol` varchar(25) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mq_rolinv`
--

CREATE TABLE `mq_rolinv` (
  `id_rolinv` int(11) NOT NULL COMMENT 'id rol inv',
  `nom_rolinv` varchar(100) NOT NULL COMMENT 'nombre rol inventarios'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mq_rol_inv`
--

CREATE TABLE `mq_rol_inv` (
  `id_rol_inv` int(11) NOT NULL COMMENT 'Id rol del aplicativo de Inventarios',
  `nom_rol_inv` varchar(30) NOT NULL COMMENT 'Nombre del rol'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mq_tip_usu`
--

CREATE TABLE `mq_tip_usu` (
  `id_tipumq` int(11) NOT NULL,
  `nom_tip` varchar(15) COLLATE latin1_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mq_usu`
--

CREATE TABLE `mq_usu` (
  `id_usu` varchar(45) NOT NULL COMMENT 'id del usuario',
  `nom_usu` varchar(10000) DEFAULT NULL COMMENT 'nombres del usuario ',
  `usuario` varchar(450) DEFAULT NULL COMMENT 'login del usuario',
  `exp_id` varchar(30) DEFAULT NULL COMMENT 'Lugar de expedicion del documento',
  `con_usu` varchar(255) DEFAULT NULL COMMENT 'contraseña del usuario',
  `eml_usu` varchar(100) DEFAULT NULL COMMENT 'correo del usuario',
  `fec_crea` datetime DEFAULT NULL COMMENT 'fecha de la creacion del usuario',
  `fec_firm` date DEFAULT NULL COMMENT 'Fecha de firma de contrato	',
  `fec_ind` date DEFAULT NULL COMMENT 'Fecha en la que se debe cumplir el indicador (6 meses después de firmar contrato)	',
  `fec_ret` date DEFAULT NULL COMMENT 'Fecha de retiro (Si aplica)	',
  `usu_upt` varchar(45) DEFAULT NULL COMMENT 'persona que crea o modifica el usuario',
  `id_are` varchar(11) NOT NULL,
  `id_reg` varchar(11) NOT NULL,
  `id_perf` varchar(11) DEFAULT NULL COMMENT 'Perfil Comercial',
  `id_rol` varchar(11) DEFAULT NULL COMMENT 'Crédito',
  `rol_inv` int(11) DEFAULT NULL COMMENT 'Id FK rol aplicativo Inventarios ',
  `ext_usu` varchar(20) DEFAULT NULL COMMENT 'Extensión Colaborador',
  `cel_usu` varchar(20) DEFAULT NULL COMMENT 'teléfono Corporativo',
  `usu_elim` varchar(45) DEFAULT NULL COMMENT 'usuarios eliminados',
  `tip_ret` varchar(11) DEFAULT NULL,
  `id_car` varchar(11) DEFAULT NULL COMMENT 'Tipo de cargo en Cotizador',
  `grup_car` varchar(11) DEFAULT NULL,
  `id_tipu` varchar(11) DEFAULT NULL COMMENT 'Tipo de usuario en Cotizador',
  `cel2_usu` varchar(20) DEFAULT NULL,
  `nom_cns` varchar(4) DEFAULT NULL,
  `cns_cotz` varchar(11) DEFAULT NULL,
  `id_tipumq` varchar(11) DEFAULT NULL COMMENT 'Tipo de usuario en MQ',
  `id_lider` varchar(11) DEFAULT NULL,
  `num_perfil` int(5) DEFAULT '1' COMMENT 'Perfil -> 1 = Usuario / Perfil -> 2 = Lider',
  `id_carg` varchar(11) DEFAULT NULL,
  `tip_contrato` varchar(45) DEFAULT NULL COMMENT 'tipo de contrato',
  `sala_base` varchar(45) DEFAULT NULL COMMENT 'salario base',
  `sala_varia` varchar(45) DEFAULT NULL COMMENT 'salario variable',
  `sal_roda` varchar(45) DEFAULT NULL COMMENT 'salario rodamiento',
  `destino_cert` varchar(30) DEFAULT NULL COMMENT 'destino del certificado',
  `url_cert` varchar(150) DEFAULT NULL COMMENT 'link de la certificiacion',
  `cer_salario` varchar(30) DEFAULT NULL COMMENT 'certificado con salario',
  `cer_varia` varchar(30) DEFAULT NULL COMMENT 'certificado con variable',
  `cer_rodam` varchar(30) DEFAULT NULL COMMENT 'certificado con rodamiento',
  `cer_sinsal` varchar(30) DEFAULT NULL COMMENT 'certificado sin salario',
  `prom_varia` varchar(100) DEFAULT NULL COMMENT 'promedio de variable acumulado',
  `id_sac` varchar(45) DEFAULT NULL COMMENT 'id del representante sac',
  `theme` tinyint(4) DEFAULT '2' COMMENT 'Tema de intranet',
  `nav_size` varchar(10) DEFAULT 'py-md-1' COMMENT 'Ancho de navbar',
  `dark` tinyint(4) DEFAULT '0' COMMENT 'Tema oscuro'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Usuarios de MQ agenda';

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mq_usu1`
--

CREATE TABLE `mq_usu1` (
  `id_usu` varchar(45) NOT NULL COMMENT 'id del usuario',
  `nom_usu` varchar(10000) DEFAULT NULL COMMENT 'nombres del usuario ',
  `usuario` varchar(450) DEFAULT NULL COMMENT 'login del usuario',
  `exp_id` varchar(30) DEFAULT NULL COMMENT 'Lugar de expedicion del documento',
  `con_usu` varchar(255) DEFAULT NULL COMMENT 'contraseña del usuario',
  `eml_usu` varchar(100) DEFAULT NULL COMMENT 'correo del usuario',
  `fec_crea` datetime DEFAULT NULL COMMENT 'fecha de la creacion del usuario',
  `fec_firm` date DEFAULT NULL COMMENT 'Fecha de firma de contrato	',
  `fec_ind` date DEFAULT NULL COMMENT 'Fecha en la que se debe cumplir el indicador (6 meses después de firmar contrato)	',
  `fec_ret` date DEFAULT NULL COMMENT 'Fecha de retiro (Si aplica)	',
  `usu_upt` varchar(45) DEFAULT NULL COMMENT 'persona que crea o modifica el usuario',
  `id_are` varchar(11) NOT NULL,
  `id_reg` varchar(11) NOT NULL,
  `id_perf` varchar(11) DEFAULT NULL COMMENT 'Perfil Comercial',
  `id_rol` varchar(11) DEFAULT NULL COMMENT 'Crédito',
  `id_rolinv` int(11) DEFAULT NULL COMMENT 'rol inventarios',
  `ext_usu` varchar(20) DEFAULT NULL COMMENT 'Extensión Colaborador',
  `cel_usu` varchar(20) DEFAULT NULL COMMENT 'teléfono Corporativo',
  `usu_elim` varchar(45) DEFAULT NULL COMMENT 'usuarios eliminados',
  `tip_ret` varchar(11) DEFAULT NULL,
  `id_car` varchar(11) DEFAULT NULL COMMENT 'Tipo de cargo en Cotizador',
  `grup_car` varchar(11) DEFAULT NULL,
  `id_tipu` varchar(11) DEFAULT NULL COMMENT 'Tipo de usuario en Cotizador',
  `cel2_usu` varchar(20) DEFAULT NULL,
  `nom_cns` varchar(4) DEFAULT NULL,
  `cns_cotz` varchar(11) DEFAULT NULL,
  `id_tipumq` varchar(11) DEFAULT NULL COMMENT 'Tipo de usuario en MQ',
  `id_lider` varchar(11) DEFAULT NULL,
  `num_perfil` int(5) DEFAULT '1' COMMENT 'Perfil -> 1 = Usuario / Perfil -> 2 = Lider',
  `id_carg` varchar(11) DEFAULT NULL,
  `tip_contrato` varchar(45) DEFAULT NULL COMMENT 'tipo de contrato',
  `sala_base` varchar(45) DEFAULT NULL COMMENT 'salario base',
  `sala_varia` varchar(45) DEFAULT NULL COMMENT 'salario variable',
  `sal_roda` varchar(45) DEFAULT NULL COMMENT 'salario rodamiento',
  `destino_cert` varchar(30) DEFAULT NULL COMMENT 'destino del certificado',
  `url_cert` varchar(150) DEFAULT NULL COMMENT 'link de la certificiacion',
  `cer_salario` varchar(30) DEFAULT NULL COMMENT 'certificado con salario',
  `cer_varia` varchar(30) DEFAULT NULL COMMENT 'certificado con variable',
  `cer_rodam` varchar(30) DEFAULT NULL COMMENT 'certificado con rodamiento',
  `cer_sinsal` varchar(30) DEFAULT NULL COMMENT 'certificado sin salario',
  `prom_varia` varchar(100) DEFAULT NULL COMMENT 'promedio de variable acumulado',
  `id_sac` varchar(45) DEFAULT NULL COMMENT 'id del representante sac',
  `theme` tinyint(4) DEFAULT '2' COMMENT 'Tema de intranet',
  `nav_size` varchar(10) DEFAULT 'py-md-1' COMMENT 'Ancho de navbar',
  `dark` tinyint(4) DEFAULT '0' COMMENT 'Tema oscuro'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Usuarios de MQ agenda';

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mq_vis`
--

CREATE TABLE `mq_vis` (
  `id_usu` varchar(45) NOT NULL,
  `id_vis` int(11) NOT NULL,
  `fec_vis` datetime DEFAULT NULL,
  `fec_sal` varchar(20) DEFAULT NULL,
  `fot_vis` varchar(100) DEFAULT NULL,
  `doc_induccion` varchar(200) DEFAULT NULL COMMENT 'Nombre del documento de la encuesta de Inducción',
  `id_are` int(11) NOT NULL,
  `id_per` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `negocios`
--

CREATE TABLE `negocios` (
  `id_neg` int(11) NOT NULL COMMENT 'Identificador',
  `nom_neg` varchar(40) DEFAULT NULL COMMENT 'Nombre del negocio',
  `des_neg` varchar(280) DEFAULT NULL COMMENT 'Descripción del negocio',
  `obs_neg` varchar(280) DEFAULT NULL COMMENT 'Observaciones del negocio',
  `val_neg` int(50) DEFAULT NULL COMMENT 'Valor del negocio',
  `pot_crea` varchar(15) DEFAULT 'No' COMMENT 'Potencial Creado',
  `cont_rea` varchar(15) DEFAULT 'No' COMMENT 'Contacto Realizado',
  `visi_rea` varchar(15) DEFAULT 'No' COMMENT 'Visita Realizada',
  `cot_soli` varchar(15) DEFAULT 'No' COMMENT 'Cotización solicitada',
  `ped_rea` varchar(15) DEFAULT 'No' COMMENT 'Pedido realizado',
  `id_est` int(15) DEFAULT NULL COMMENT 'Estado de negocio',
  `id_tipo` int(11) DEFAULT '1' COMMENT 'Tipo de negocio',
  `id_usu` varchar(20) DEFAULT NULL COMMENT 'Usuario que registra el negocio',
  `ase_com` varchar(20) DEFAULT NULL COMMENT 'Asesor técnico comercial',
  `fec_ini` date DEFAULT NULL COMMENT 'Fecha de inicio del negocio',
  `fec_fin` date DEFAULT NULL COMMENT 'Fecha de fin del negocio',
  `fec_crea` timestamp NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Fecha de creación',
  `id_cli` int(11) DEFAULT NULL COMMENT 'Cliente relacionado'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `negocios_view`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `negocios_view` (
`id_neg` int(11)
,`nom_neg` varchar(40)
,`des_neg` varchar(280)
,`obs_neg` varchar(280)
,`val_neg` int(50)
,`pot_crea` varchar(15)
,`cont_rea` varchar(15)
,`visi_rea` varchar(15)
,`cot_soli` varchar(15)
,`ped_rea` varchar(15)
,`id_est` int(15)
,`estado` varchar(25)
,`id_tipo` int(11)
,`nom_tipo` varchar(50)
,`id_usu` varchar(45)
,`nom_usu` varchar(10000)
,`ase_com` text
,`fec_ini` date
,`fec_fin` date
,`fec_crea` timestamp
,`id_cli` int(11)
,`nom_cli` varchar(100)
,`neg_cat` text
);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `neg_est`
--

CREATE TABLE `neg_est` (
  `id_est` int(15) NOT NULL COMMENT 'Identificador',
  `estado` varchar(25) DEFAULT NULL COMMENT 'Estado del negocio'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `permisos_view`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `permisos_view` (
`id_per` int(11)
,`id_usu` varchar(45)
,`nom_usu` varchar(10000)
,`id_lider` varchar(11)
,`fech_sis` datetime
,`fech_aus` date
,`nom_are` varchar(45)
,`fech_ini` varchar(30)
,`fech_fin` varchar(30)
,`mot_per` int(11)
,`obser_perm` varchar(300)
,`descrip_per` varchar(50)
,`id_estPer` int(11)
,`nom_estPer` varchar(30)
,`doc_perm` varchar(300)
,`crea_rec` varchar(11)
,`revi_rec` varchar(30)
,`id_are` int(11)
);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `per_estado`
--

CREATE TABLE `per_estado` (
  `id_estPer` int(11) NOT NULL,
  `nom_estPer` varchar(30) DEFAULT NULL COMMENT 'nombre del estado ',
  `color` varchar(20) DEFAULT NULL COMMENT 'color de los estados '
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `per_ingreso`
--

CREATE TABLE `per_ingreso` (
  `id_per` int(11) NOT NULL,
  `fech_sis` datetime DEFAULT NULL COMMENT 'fecha tomada del sistema',
  `fech_aus` date DEFAULT NULL COMMENT 'fecha de la ausencia',
  `id_are` int(11) DEFAULT NULL,
  `id_usu` varchar(45) DEFAULT NULL,
  `fech_ini` varchar(30) DEFAULT NULL COMMENT 'fecha inicial de la ausencia',
  `fech_fin` varchar(30) DEFAULT NULL COMMENT 'fecha final de la ausencia',
  `hor_tot` varchar(30) DEFAULT NULL COMMENT 'HORAS TOTALES ',
  `mot_per` int(11) DEFAULT NULL COMMENT 'motivo de la ausencia',
  `otro_motiv` varchar(30) DEFAULT NULL COMMENT 'otro motivo de la ausencia ',
  `obser_perm` varchar(300) DEFAULT NULL COMMENT 'observación del permiso ',
  `usu_perm` varchar(45) DEFAULT NULL COMMENT 'persona que pide el permiso RH',
  `crea_rec` varchar(11) DEFAULT NULL COMMENT 'variable si crea la solicitud RH',
  `id_estPer` int(11) DEFAULT NULL,
  `doc_perm` varchar(300) DEFAULT NULL COMMENT 'docum',
  `perEst_upd` datetime DEFAULT NULL COMMENT 'fecha de la ultima actualización del estado ',
  `revi_rec` varchar(30) DEFAULT NULL COMMENT 'revisado por rh ',
  `obs_talen` varchar(10000) DEFAULT NULL COMMENT 'observación de talento humano ',
  `id_mes` int(11) DEFAULT NULL COMMENT 'id del mes '
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `per_ingre_x_mov`
--

CREATE TABLE `per_ingre_x_mov` (
  `id_per` int(11) DEFAULT NULL,
  `id_usu` varchar(45) CHARACTER SET utf8 DEFAULT NULL,
  `id_estPer` int(11) DEFAULT NULL,
  `fech_sis` datetime DEFAULT NULL COMMENT 'fecha del sistema',
  `id_are` int(11) DEFAULT NULL,
  `fech_aus1` date DEFAULT NULL COMMENT 'fecha de la ausencia ',
  `mot_per` int(11) DEFAULT NULL COMMENT 'id motivo del permiso '
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `per_motivo`
--

CREATE TABLE `per_motivo` (
  `mot_per` int(11) NOT NULL,
  `descrip_per` varchar(50) DEFAULT NULL COMMENT 'descripción del permiso'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `precios`
--

CREATE TABLE `precios` (
  `id_pre` int(11) NOT NULL,
  `id_prod` int(11) NOT NULL COMMENT 'Id producto',
  `pre_base` int(50) NOT NULL COMMENT 'Precio base'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `id_prod` int(11) NOT NULL,
  `cod_pro` varchar(100) DEFAULT NULL COMMENT 'Código del producto',
  `cod_stock` varchar(100) DEFAULT NULL COMMENT 'Código masterquimica',
  `nom_prod` varchar(1000) DEFAULT NULL COMMENT 'Nombre del producto',
  `desc_prod` longtext COMMENT 'Descripción del producto',
  `id_uni_med` varchar(30) DEFAULT NULL COMMENT 'Id unidad de medida',
  `uni_emp` varchar(11) DEFAULT NULL COMMENT 'Unidad de empaque',
  `uni_emp_mq` varchar(11) DEFAULT NULL COMMENT 'Unidad de empaque Masterquimica',
  `id_fam` varchar(50) DEFAULT NULL COMMENT 'Id familia del producto',
  `url_img` varchar(3000) DEFAULT NULL COMMENT 'url de los productos',
  `prod_desc` varchar(11) DEFAULT NULL COMMENT 'producto descontinuado'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos_fam`
--

CREATE TABLE `productos_fam` (
  `id_fam` int(11) NOT NULL,
  `familia` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos_unids`
--

CREATE TABLE `productos_unids` (
  `id_uni` int(11) NOT NULL COMMENT 'Id de unidad',
  `unidad` varchar(50) NOT NULL COMMENT 'Unidad'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `productos_view`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `productos_view` (
`cod_pro` int(11)
,`cod_ref` mediumtext
,`nom_pro` varchar(1400)
,`img_pro` varchar(1160)
,`und_emp` varchar(10)
,`can_emp` int(11)
);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reg_llam`
--

CREATE TABLE `reg_llam` (
  `id_llama` int(11) NOT NULL COMMENT 'llamada ',
  `id_usu` varchar(45) NOT NULL COMMENT 'id quien registra la llamada',
  `id_rem` varchar(45) NOT NULL COMMENT 'id del remitente',
  `ema_llamada` int(11) NOT NULL COMMENT 'confirmacion de email ',
  `ob_llam` varchar(500) NOT NULL COMMENT 'observacion de la llamada',
  `fec_llam` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'fecha de llamada'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `seg_bodeg`
--

CREATE TABLE `seg_bodeg` (
  `id_bodeg` int(11) NOT NULL,
  `nom_bodega` varchar(30) DEFAULT NULL COMMENT 'nombre de la bodega '
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `seg_caja`
--

CREATE TABLE `seg_caja` (
  `id_seg` int(11) NOT NULL,
  `id_usu` varchar(45) NOT NULL,
  `id_prove` int(60) DEFAULT NULL COMMENT 'id del proveedor',
  `nom_pro` varchar(100) DEFAULT NULL COMMENT 'nombre del proveedor ',
  `dig_ver` varchar(30) DEFAULT NULL,
  `num_facR` varchar(300) NOT NULL COMMENT 'numero de la factura',
  `valor_tota` varchar(300) NOT NULL COMMENT 'valor total',
  `justifica` varchar(300) NOT NULL COMMENT 'justificación de la caja',
  `docu_caj` varchar(500) NOT NULL COMMENT 'documento soporte de caja '
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `seg_estado`
--

CREATE TABLE `seg_estado` (
  `id_estSeg` int(11) NOT NULL,
  `nom_estS` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `seg_ingre_x_movi`
--

CREATE TABLE `seg_ingre_x_movi` (
  `id_seg` int(11) DEFAULT NULL,
  `id_usu` varchar(45) CHARACTER SET utf8 DEFAULT NULL,
  `id_estSeg` int(11) DEFAULT NULL,
  `fech_cre` datetime DEFAULT NULL COMMENT 'Fecha de Creación',
  `fecha_hora` datetime DEFAULT NULL,
  `id_are` int(11) DEFAULT NULL,
  `per_encarga` varchar(30) DEFAULT NULL COMMENT 'Persona a la que se remite ',
  `id_reg` int(11) DEFAULT NULL COMMENT 'Regional',
  `id_nom` int(11) DEFAULT NULL,
  `id_prove` int(60) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `seg_nomdoc`
--

CREATE TABLE `seg_nomdoc` (
  `id_nom` int(11) NOT NULL,
  `nom_doc` varchar(30) NOT NULL COMMENT 'nombre del documento '
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_clientes`
--

CREATE TABLE `tipo_clientes` (
  `id_tipo` int(11) NOT NULL COMMENT 'Identificador',
  `tipo` varchar(11) DEFAULT NULL COMMENT 'Tipo de cliente'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_negocio`
--

CREATE TABLE `tipo_negocio` (
  `id_tipo` int(11) NOT NULL COMMENT 'Identificador',
  `nom_tipo` varchar(50) DEFAULT NULL COMMENT 'Nombre del tipo'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tip_dlg`
--

CREATE TABLE `tip_dlg` (
  `id_tip_dlg` int(11) NOT NULL,
  `nom_tip_dlg` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `transacciones_view`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `transacciones_view` (
`id_tra` int(11)
,`fec_crea` datetime
,`id_tipo` int(11)
,`id_neg` int(11)
,`id_cli` int(11)
,`id_usu` varchar(45)
,`nom_usu` varchar(10000)
,`tipo` varchar(15)
,`corr_destino` varchar(45)
,`corr_asunto` varchar(60)
,`corr_cuerpo` varchar(400)
,`nota_titulo` varchar(20)
,`nota_contenido` varchar(280)
,`rec_fecha` datetime
,`rec_asunto` varchar(45)
,`lla_destino` varchar(20)
,`lla_agendar` varchar(2)
,`lla_observacion` varchar(100)
);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `users_view`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `users_view` (
`id_usu` varchar(45)
,`nom_usu` varchar(10000)
,`usuario` varchar(450)
,`fec_crea` datetime
,`usu_upt` varchar(45)
,`eml_usu` varchar(100)
,`id_are` varchar(11)
,`usu_elim` varchar(45)
,`num_perfil` int(5)
,`nom_are` varchar(45)
,`id_reg` varchar(11)
,`nom_reg` varchar(45)
);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usu_per`
--

CREATE TABLE `usu_per` (
  `id_usu` varchar(45) NOT NULL,
  `id_per` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `view_correspondencia_4`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `view_correspondencia_4` (
`id_seg` int(11)
,`id_estSeg` int(11)
,`id_usu` varchar(45)
,`nom_usu` varchar(10000)
,`nom_doc` varchar(30)
,`fech_ini` date
,`nom_are` varchar(45)
,`nom_per_encarga` varchar(10000)
,`per_encarga` varchar(30)
,`nom_estS` varchar(30)
,`id_nom` int(11)
,`id_prove` int(60)
,`fec_ven` date
,`nom_cli` varchar(100)
,`id_cli` int(11)
,`num_facR` varchar(300)
,`fech_cre` date
);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `visitas_view`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `visitas_view` (
`id_vis` int(11)
,`id_per` int(11)
,`nom_per` varchar(50)
,`emp_per` varchar(100)
,`fec_vis` datetime
,`fec_sal` varchar(20)
,`nom_are` varchar(45)
,`fot_vis` varchar(100)
,`doc_induccion` varchar(200)
);

-- --------------------------------------------------------

--
-- Estructura para la vista `capacitaciones_view`
--
DROP TABLE IF EXISTS `capacitaciones_view`;

CREATE ALGORITHM=UNDEFINED DEFINER=`masterqu`@`%.%.%.%` SQL SECURITY DEFINER VIEW `capacitaciones_view`  AS SELECT `c`.`id_cap` AS `id_cap`, `c`.`fue_cap` AS `fue_cap`, `c`.`lug_cap` AS `lug_cap`, `tc`.`tip_cap` AS `tip_cap`, `c`.`obj_cap` AS `obj_cap`, `c`.`tem_cap` AS `tem_cap`, `c`.`resp_cap` AS `resp_cap`, `a`.`nom_are` AS `nom_are`, `c`.`fec_cap` AS `fec_cap`, `c`.`eva_cap` AS `eva_cap`, `c`.`met_cap` AS `met_cap`, `c`.`real_cap` AS `real_cap`, `u`.`nom_usu` AS `nom_usu` FROM (((`ind_cap` `c` join `ind_tipcap` `tc` on((`c`.`id_tipcap` = `tc`.`id_tipcap`))) join `mq_are` `a` on((`c`.`id_are` = `a`.`id_are`))) join `mq_usu` `u` on((`c`.`id_usu` = `u`.`id_usu`))) ;

-- --------------------------------------------------------

--
-- Estructura para la vista `certificados_view`
--
DROP TABLE IF EXISTS `certificados_view`;

CREATE ALGORITHM=UNDEFINED DEFINER=`masterqu`@`%.%.%.%` SQL SECURITY DEFINER VIEW `certificados_view`  AS SELECT `cer`.`id_cert` AS `id_cert`, `us`.`id_usu` AS `id_usu`, `cer`.`id_carg` AS `id_carg`, `us`.`nom_usu` AS `nom_usu`, `cer`.`fec_creacion` AS `fec_creacion`, `cer`.`cer_salario` AS `cer_salario`, `cer`.`cer_varia` AS `cer_varia`, `cer`.`cer_rodam` AS `cer_rodam`, `cer`.`cer_sinsal` AS `cer_sinsal`, `cer`.`lugar_remi` AS `lugar_remi` FROM ((`ind_cert_x_usu` `cer` join `mq_usu` `us`) join `ind_cargos` `car`) WHERE ((`cer`.`id_carg` = `car`.`id_carg`) AND (`cer`.`id_usu` = `us`.`id_usu`)) ;

-- --------------------------------------------------------

--
-- Estructura para la vista `certiPersonal_view`
--
DROP TABLE IF EXISTS `certiPersonal_view`;

CREATE ALGORITHM=UNDEFINED DEFINER=`masterqu`@`%.%.%.%` SQL SECURITY DEFINER VIEW `certiPersonal_view`  AS SELECT `us`.`id_usu` AS `id_usu`, `us`.`nom_usu` AS `nom_usu`, `car`.`nom_carg` AS `nom_carg`, `us`.`fec_firm` AS `fec_firm`, `us`.`fec_ret` AS `fec_ret`, `us`.`tip_contrato` AS `tip_contrato` FROM (`mq_usu` `us` join `ind_cargos` `car`) WHERE (`us`.`id_carg` = `car`.`id_carg`) ;

-- --------------------------------------------------------

--
-- Estructura para la vista `clientes_view`
--
DROP TABLE IF EXISTS `clientes_view`;

CREATE ALGORITHM=UNDEFINED DEFINER=`masterqu`@`190.25.239.162` SQL SECURITY DEFINER VIEW `clientes_view`  AS SELECT `a`.`id_cli` AS `id_cli`, `a`.`tip_doc` AS `tip_doc`, `a`.`num_doc` AS `num_doc`, `a`.`nom_cli` AS `nom_cli`, `a`.`tel_cli` AS `tel_cli`, `a`.`eml_cli` AS `eml_cli`, `a`.`dir_cli` AS `dir_cli`, `a`.`web_cli` AS `web_cli`, `a`.`id_tipo` AS `id_tipo`, `a`.`fec_crea` AS `fec_crea`, `a`.`id_ciu` AS `id_ciu`, `b`.`nom_usu` AS `nom_usu`, `c`.`nom_usu` AS `nom_ase`, `d`.`nom_usu` AS `nom_sac` FROM (((`mq_clientes` `a` left join `mq_usu` `b` on((`a`.`id_usu` = `b`.`id_usu`))) left join `mq_usu` `c` on((`a`.`ase_com` = `c`.`id_usu`))) left join `mq_usu` `d` on((`a`.`rep_sac` = `d`.`id_usu`))) GROUP BY `a`.`id_cli` ;

-- --------------------------------------------------------

--
-- Estructura para la vista `contactos_view`
--
DROP TABLE IF EXISTS `contactos_view`;

CREATE ALGORITHM=UNDEFINED DEFINER=`masterqu_admin`@`%.%.%.%` SQL SECURITY DEFINER VIEW `contactos_view`  AS SELECT `con`.`id_cont` AS `id_cont`, `con`.`id_cli` AS `id_cli`, `con`.`nom_cont` AS `nom_cont`, `con`.`eml_cont` AS `eml_cont`, `con`.`car_cont` AS `car_cont`, `con`.`tel_cont` AS `tel_cont`, `con`.`tel_con2` AS `tel_con2`, `con`.`cont_desh` AS `cont_desh`, `con`.`id_usu` AS `id_usu`, `con`.`fec_crea` AS `fec_crea`, `cli`.`nom_cli` AS `nom_cli`, `cli`.`num_doc` AS `num_doc` FROM (`contactos` `con` join `mq_clientes` `cli` on((`con`.`id_cli` = `cli`.`id_cli`))) ;

-- --------------------------------------------------------

--
-- Estructura para la vista `cot_crm_view`
--
DROP TABLE IF EXISTS `cot_crm_view`;

CREATE ALGORITHM=UNDEFINED DEFINER=`masterqu_admin`@`%.%.%.%` SQL SECURITY DEFINER VIEW `cot_crm_view`  AS SELECT `cot`.`id_coti` AS `id_coti`, `cot`.`doc_coti` AS `doc_coti`, `cot`.`fec_coti` AS `fec_coti`, `cot`.`id_cli` AS `id_cli`, `cot`.`id_usu` AS `id_usu`, `cot`.`id_ema` AS `id_ema`, `cot`.`ced_ase` AS `ced_ase`, `cot`.`ced_sac` AS `ced_sac`, `cot`.`dia_ent` AS `dia_ent`, `cot`.`for_pag` AS `for_pag`, `cot`.`id_tip_cot` AS `id_tip_cot`, `cot`.`cost_cot` AS `cost_cot`, `cot`.`id_cont` AS `id_cont`, `cot`.`val_cot` AS `val_cot`, `cot`.`id_ciu` AS `id_ciu`, `cot`.`cns_coti` AS `cns_coti`, `cot`.`cot_iva` AS `cot_iva`, `cot`.`sol_cot` AS `sol_cot`, `cot`.`sol_upd` AS `sol_upd`, `cot`.`prec_cot` AS `prec_cot`, `cot`.`prec_upd` AS `prec_upd`, `cot`.`prc_cot` AS `prc_cot`, `cot`.`prc_upd` AS `prc_upd`, `cot`.`env_cot` AS `env_cot`, `cot`.`dif_diasEn` AS `dif_diasEn`, `cot`.`env_upd` AS `env_upd`, `cot`.`est_cot` AS `est_cot`, `cot`.`est_upd` AS `est_upd`, `cot`.`com_cot` AS `com_cot`, `cot`.`com_upd` AS `com_upd`, `cot`.`mot_cot` AS `mot_cot`, `cot`.`mot_upd` AS `mot_upd`, `cot`.`llam_cot` AS `llam_cot`, `cot`.`llam_upd` AS `llam_upd`, `cot`.`rem_ciu` AS `rem_ciu`, `cot`.`com_ema` AS `com_ema`, `cot`.`conf_cotiz` AS `conf_cotiz`, `cot`.`envio_masiv` AS `envio_masiv`, `cot`.`com_cotOnl` AS `com_cotOnl`, `cot`.`id_tip_pedi` AS `id_tip_pedi`, `cot`.`id_pag` AS `id_pag`, `cot`.`direccion_1` AS `direccion_1`, `cot`.`direccion_2` AS `direccion_2`, `cot`.`date_mypro` AS `date_mypro`, `cot`.`post_code` AS `post_code`, `cot`.`pedi_rev` AS `pedi_rev`, `usu`.`nom_cns` AS `nom_cns`, `est`.`nom_est` AS `nom_est`, `con`.`nom_cont` AS `nom_cont` FROM (((`cot_cotizaciones` `cot` join `mq_usu` `usu` on((`cot`.`id_usu` = `usu`.`id_usu`))) join `cot_estados_cot` `est` on((`cot`.`est_cot` = `est`.`id_est`))) join `contactos` `con` on((`cot`.`id_cont` = `con`.`id_cont`))) ;

-- --------------------------------------------------------

--
-- Estructura para la vista `cot_historial_view`
--
DROP TABLE IF EXISTS `cot_historial_view`;

CREATE ALGORITHM=UNDEFINED DEFINER=`masterqu_admin`@`%.%.%.%` SQL SECURITY DEFINER VIEW `cot_historial_view`  AS SELECT `cot`.`id_coti` AS `id_coti`, `cot`.`doc_coti` AS `doc_coti`, `cot`.`fec_coti` AS `fec_coti`, `cot`.`id_cli` AS `id_cli`, `cot`.`id_usu` AS `id_usu`, `cot`.`id_ema` AS `id_ema`, `cot`.`ced_ase` AS `ced_ase`, `cot`.`ced_sac` AS `ced_sac`, `cot`.`dia_ent` AS `dia_ent`, `cot`.`for_pag` AS `for_pag`, `cot`.`id_tip_cot` AS `id_tip_cot`, `cot`.`cost_cot` AS `cost_cot`, `cot`.`id_cont` AS `id_cont`, `cot`.`val_cot` AS `val_cot`, `cot`.`id_ciu` AS `id_ciu`, `cot`.`cns_coti` AS `cns_coti`, `cot`.`cot_iva` AS `cot_iva`, `cot`.`sol_cot` AS `sol_cot`, `cot`.`sol_upd` AS `sol_upd`, `cot`.`prec_cot` AS `prec_cot`, `cot`.`prec_upd` AS `prec_upd`, `cot`.`prc_cot` AS `prc_cot`, `cot`.`prc_upd` AS `prc_upd`, `cot`.`env_cot` AS `env_cot`, `cot`.`dif_diasEn` AS `dif_diasEn`, `cot`.`env_upd` AS `env_upd`, `cot`.`est_cot` AS `est_cot`, `cot`.`est_upd` AS `est_upd`, `cot`.`com_cot` AS `com_cot`, `cot`.`com_upd` AS `com_upd`, `cot`.`mot_cot` AS `mot_cot`, `cot`.`mot_upd` AS `mot_upd`, `cot`.`llam_cot` AS `llam_cot`, `cot`.`llam_upd` AS `llam_upd`, `cot`.`rem_ciu` AS `rem_ciu`, `cot`.`com_ema` AS `com_ema`, `cot`.`conf_cotiz` AS `conf_cotiz`, `cot`.`envio_masiv` AS `envio_masiv`, `cot`.`com_cotOnl` AS `com_cotOnl`, `cot`.`id_tip_pedi` AS `id_tip_pedi`, `cot`.`id_pag` AS `id_pag`, `cot`.`direccion_1` AS `direccion_1`, `cot`.`direccion_2` AS `direccion_2`, `cot`.`date_mypro` AS `date_mypro`, `cot`.`post_code` AS `post_code`, `cot`.`pedi_rev` AS `pedi_rev`, `us`.`nom_cns` AS `nom_cns`, `cli`.`nom_cli` AS `nom_cli`, `tip`.`nom_tip_cot` AS `nom_tip_cot` FROM (((`cot_cotizaciones` `cot` left join `mq_usu` `us` on((`cot`.`id_usu` = `us`.`id_usu`))) left join `mq_clientes` `cli` on((`cot`.`id_cli` = `cli`.`id_cli`))) left join `cot_tip_cotizacion` `tip` on((`cot`.`id_tip_cot` = `tip`.`id_tip_cot`))) ;

-- --------------------------------------------------------

--
-- Estructura para la vista `creditos_view1`
--
DROP TABLE IF EXISTS `creditos_view1`;

CREATE ALGORITHM=UNDEFINED DEFINER=`masterqu`@`190.25.239.162` SQL SECURITY DEFINER VIEW `creditos_view1`  AS SELECT `us`.`id_reg` AS `id_reg`, `sl`.`id_sol` AS `id_sol`, `cl`.`nom_cli` AS `nom_cli`, `cont`.`nom_cont` AS `nom_cont`, `sl`.`fec_sol` AS `fec_sol`, `sl`.`ase_com` AS `ase_com`, `cl`.`id_cli` AS `id_cli`, `es`.`nom_est` AS `nom_est`, `sl`.`id_est` AS `id_est`, `actsol`.`nom_act` AS `nom_act`, `cl`.`rep_sac` AS `rep_sac`, `us`.`nom_usu` AS `nom_usu`, `sl`.`fecha_crea` AS `fecha_crea`, `sl`.`nom_atc` AS `nom_atc`, `sl`.`eml_enviado` AS `eml_enviado` FROM (((((`mq_clientes` `cl` join `cre_solicitud` `sl`) join `cre_estadosol` `es`) join `mq_usu` `us`) join `contactos` `cont`) join `credit_actSol` `actsol`) WHERE ((`cl`.`id_cli` = `sl`.`id_cli`) AND (`sl`.`activ_solicitada` = `actsol`.`id_act`) AND (`sl`.`id_cont` = `cont`.`id_cont`) AND (`es`.`id_est` = `sl`.`id_est`) AND (`sl`.`id_usu` = `us`.`id_usu`)) GROUP BY `sl`.`id_sol` ;

-- --------------------------------------------------------

--
-- Estructura para la vista `creditos_view2`
--
DROP TABLE IF EXISTS `creditos_view2`;

CREATE ALGORITHM=UNDEFINED DEFINER=`masterqu`@`190.25.239.162` SQL SECURITY DEFINER VIEW `creditos_view2`  AS SELECT `sl`.`id_usu` AS `id_usu`, `us`.`id_reg` AS `id_reg`, `sl`.`id_sol` AS `id_sol`, `cl`.`nom_cli` AS `nom_cli`, `sl`.`id_cont` AS `id_cont`, `cont`.`nom_cont` AS `nom_cont`, `sl`.`fec_sol` AS `fec_sol`, `sl`.`ase_com` AS `ase_com`, `sl`.`nom_atc` AS `nom_atc`, `cl`.`id_cli` AS `id_cli`, `sl`.`fecha_crea` AS `fecha_crea`, `es`.`nom_est` AS `nom_est`, `sl`.`id_est` AS `id_est`, `us`.`nom_usu` AS `nom_usu`, `actsol`.`nom_act` AS `nom_act`, `sl`.`eml_enviado` AS `eml_enviado` FROM (((((`mq_clientes` `cl` join `cre_solicitud` `sl` on((`cl`.`id_cli` = `sl`.`id_cli`))) left join `credit_actSol` `actsol` on((`sl`.`activ_solicitada` = `actsol`.`id_act`))) left join `contactos` `cont` on((`cont`.`id_cont` = `sl`.`id_cont`))) join `cre_estadosol` `es` on((`es`.`id_est` = `sl`.`id_est`))) join `mq_usu` `us` on((`sl`.`id_usu` = `us`.`id_usu`))) ;

-- --------------------------------------------------------

--
-- Estructura para la vista `diligencias_view`
--
DROP TABLE IF EXISTS `diligencias_view`;

CREATE ALGORITHM=UNDEFINED DEFINER=`masterqu`@`%.%.%.%` SQL SECURITY DEFINER VIEW `diligencias_view`  AS SELECT `dl`.`num_dlg` AS `num_dlg`, `cl`.`nom_cli` AS `nom_cli`, `dl`.`con_dlg` AS `con_dlg`, `dl`.`dia_dlg` AS `dia_dlg`, `dl`.`dir_dlg` AS `dir_dlg`, `tp`.`nom_tip_dlg` AS `nom_tip_dlg`, `dl`.`dil_des` AS `dil_des`, `dl`.`tel_dlg` AS `tel_dlg`, `es`.`nom_est_dlg` AS `nom_est_dlg`, `dl`.`est_dlg` AS `est_dlg`, `cl`.`id_cli` AS `id_cli`, `reg`.`id_reg` AS `id_reg`, `reg`.`nom_reg` AS `nom_reg`, `dl`.`nom_res` AS `nom_res` FROM ((((`mq_diligencias` `dl` join `mq_clientes` `cl`) join `tip_dlg` `tp`) join `mq_est_dlg` `es`) join `mq_reg` `reg`) WHERE ((`dl`.`id_cli` = `cl`.`id_cli`) AND (`dl`.`id_tip_dlg` = `tp`.`id_tip_dlg`) AND (`dl`.`est_dlg` = `es`.`id_est_dlg`) AND (`dl`.`id_reg` = `reg`.`id_reg`)) ;

-- --------------------------------------------------------

--
-- Estructura para la vista `enrutamientos_view`
--
DROP TABLE IF EXISTS `enrutamientos_view`;

CREATE ALGORITHM=UNDEFINED DEFINER=`masterqu`@`%.%.%.%` SQL SECURITY DEFINER VIEW `enrutamientos_view`  AS SELECT `a`.`num_enr` AS `num_enr`, `a`.`fec_enr` AS `fec_enr`, `a`.`fec_crea` AS `fec_crea`, `a`.`usu_upt` AS `usu_upt`, `a`.`lst_upt` AS `lst_upt`, `a`.`est_enr` AS `est_enr`, `a`.`cos_enr` AS `cos_enr`, `a`.`id_reg` AS `id_reg`, `b`.`nom_reg` AS `nom_reg` FROM (`mq_enrt` `a` join `mq_reg` `b`) WHERE ((`a`.`id_reg` = `b`.`id_reg`) AND (`a`.`num_enr` <> 9999)) ;

-- --------------------------------------------------------

--
-- Estructura para la vista `errornomina_view`
--
DROP TABLE IF EXISTS `errornomina_view`;

CREATE ALGORITHM=UNDEFINED DEFINER=`masterqu`@`%.%.%.%` SQL SECURITY DEFINER VIEW `errornomina_view`  AS SELECT `er`.`id_error` AS `id_error`, `er`.`fech_sis` AS `fech_sis`, `er`.`fech_error` AS `fech_error`, `er`.`id_pag` AS `id_pag`, `er`.`col_error` AS `col_error`, `er`.`erro_obser` AS `erro_obser`, `er`.`error_per` AS `error_per`, `er`.`id_estaErr` AS `id_estaErr`, `er`.`mes_err` AS `mes_err`, `nom`.`nom_pag` AS `nom_pag`, `es`.`nom_estaErro` AS `nom_estaErro` FROM (`ind_estad_error` `es` join (`ind_errores` `er` left join `ind_nompag` `nom` on((`er`.`id_pag` = `nom`.`id_pag`)))) WHERE (`er`.`id_estaErr` = `es`.`id_estaErr`) ORDER BY `er`.`id_error` ASC ;

-- --------------------------------------------------------

--
-- Estructura para la vista `eventos_view`
--
DROP TABLE IF EXISTS `eventos_view`;

CREATE ALGORITHM=UNDEFINED DEFINER=`masterqu`@`%.%.%.%` SQL SECURITY DEFINER VIEW `eventos_view`  AS SELECT `a`.`id_act` AS `id_act`, `a`.`mes_act` AS `mes_act`, `a`.`nom_act` AS `nom_act`, `a`.`cum_act` AS `cum_act`, `u`.`nom_usu` AS `nom_usu` FROM (`ind_act` `a` join `mq_usu` `u` on((`u`.`id_usu` = `a`.`id_usu`))) ;

-- --------------------------------------------------------

--
-- Estructura para la vista `inv_inventario_view`
--
DROP TABLE IF EXISTS `inv_inventario_view`;

CREATE ALGORITHM=UNDEFINED DEFINER=`masterqu`@`%.%.%.%` SQL SECURITY DEFINER VIEW `inv_inventario_view`  AS SELECT `inv`.`id_inv` AS `id_inv`, `inv`.`id_prod` AS `id_prod`, `prod`.`nom_prod` AS `nom_prod`, `prod`.`img_prod` AS `img_prod`, `inv`.`cantidad` AS `cantidad`, `inv`.`id_reg` AS `id_reg` FROM (`inv_inventario` `inv` join `inv_product` `prod` on((`inv`.`id_prod` = `prod`.`id_prod`))) ;

-- --------------------------------------------------------

--
-- Estructura para la vista `inv_inventario_x_area_view`
--
DROP TABLE IF EXISTS `inv_inventario_x_area_view`;

CREATE ALGORITHM=UNDEFINED DEFINER=`masterqu`@`%.%.%.%` SQL SECURITY DEFINER VIEW `inv_inventario_x_area_view`  AS SELECT `inv`.`id_inv` AS `id_inv`, `inv`.`id_prod` AS `id_prod`, `prod`.`nom_prod` AS `nom_prod`, `prod`.`img_prod` AS `img_prod`, `inv`.`cantidad` AS `cantidad`, `area`.`can_max` AS `can_max`, `inv`.`id_reg` AS `id_reg`, `area`.`id_are` AS `id_are` FROM ((`inv_inventario` `inv` join `inv_product` `prod` on((`inv`.`id_prod` = `prod`.`id_prod`))) join `inv_prod_x_are` `area` on((`area`.`id_prod` = `prod`.`id_prod`))) ;

-- --------------------------------------------------------

--
-- Estructura para la vista `inv_mov_inventario_view`
--
DROP TABLE IF EXISTS `inv_mov_inventario_view`;

CREATE ALGORITHM=UNDEFINED DEFINER=`masterqu`@`%.%.%.%` SQL SECURITY DEFINER VIEW `inv_mov_inventario_view`  AS SELECT `mov`.`id_mov` AS `id_mov`, `mov`.`id_prod` AS `id_prod`, `prod`.`nom_prod` AS `nom_prod`, `prod`.`img_prod` AS `img_prod`, `mov`.`razon` AS `razon`, `mov`.`razon_det` AS `razon_det`, `mov`.`cant_ant` AS `cant_ant`, `mov`.`new_cant` AS `new_cant`, `mov`.`fec_mov` AS `fec_mov`, `mov`.`usu_mov` AS `usu_mov`, `usu`.`nom_usu` AS `nom_usu` FROM (((`inv_mov_inventario` `mov` join `inv_product` `prod` on((`mov`.`id_prod` = `prod`.`id_prod`))) join `mq_reg` `reg` on((`mov`.`id_reg` = `reg`.`id_reg`))) join `mq_usu` `usu` on((`mov`.`usu_mov` = `usu`.`id_usu`))) ;

-- --------------------------------------------------------

--
-- Estructura para la vista `inv_prod_x_are_view`
--
DROP TABLE IF EXISTS `inv_prod_x_are_view`;

CREATE ALGORITHM=UNDEFINED DEFINER=`masterqu`@`%.%.%.%` SQL SECURITY DEFINER VIEW `inv_prod_x_are_view`  AS SELECT group_concat(`prod_are`.`id` separator ', ') AS `id`, group_concat(`prod_are`.`id_prod` separator ', ') AS `id_products`, `prod_are`.`id_are` AS `id_are`, group_concat(`prod_are`.`can_max` separator ', ') AS `cant_max`, `are`.`nom_are` AS `nom_are`, group_concat(`prod`.`nom_prod` separator ', ') AS `nombre_products`, group_concat(`prod`.`img_prod` separator ', ') AS `img_products` FROM ((`inv_prod_x_are` `prod_are` join `mq_are` `are` on((`prod_are`.`id_are` = `are`.`id_are`))) join `inv_product` `prod` on((`prod_are`.`id_prod` = `prod`.`id_prod`))) GROUP BY `prod_are`.`id_are` ;

-- --------------------------------------------------------

--
-- Estructura para la vista `inv_solicitud_view`
--
DROP TABLE IF EXISTS `inv_solicitud_view`;

CREATE ALGORITHM=UNDEFINED DEFINER=`masterqu`@`%.%.%.%` SQL SECURITY DEFINER VIEW `inv_solicitud_view`  AS SELECT `sol`.`id_sol` AS `id_sol`, `sol`.`id_usu` AS `id_usu`, `usu`.`nom_usu` AS `nom_usu`, `sol`.`est_sol` AS `est_sol`, `sol`.`fec_sol` AS `fec_sol`, `sol`.`sol_elim` AS `sol_elim`, group_concat(`sol_prod`.`id_prod` separator ', ') AS `id_products`, group_concat(`prod`.`img_prod` separator ', ') AS `img_products`, group_concat(`prod`.`nom_prod` separator ', ') AS `nom_products`, group_concat(`sol_prod`.`cant_sol` separator ', ') AS `cant_sol_products`, `est`.`nom_est_sol` AS `nom_est_sol`, `est`.`color_est` AS `color_est` FROM ((((`inv_solicitud` `sol` join `inv_sol_x_prod` `sol_prod` on((`sol`.`id_sol` = `sol_prod`.`id_sol`))) join `inv_product` `prod` on((`sol_prod`.`id_prod` = `prod`.`id_prod`))) join `inv_est_sol` `est` on((`sol`.`est_sol` = `est`.`id_est_sol`))) join `mq_usu` `usu` on((`sol`.`id_usu` = `usu`.`id_usu`))) GROUP BY `sol`.`id_sol` ;

-- --------------------------------------------------------

--
-- Estructura para la vista `inv_sol_detallada_view`
--
DROP TABLE IF EXISTS `inv_sol_detallada_view`;

CREATE ALGORITHM=UNDEFINED DEFINER=`masterqu`@`%.%.%.%` SQL SECURITY DEFINER VIEW `inv_sol_detallada_view`  AS SELECT `sol`.`id_sol` AS `id_sol`, `sol`.`id_usu` AS `id_usu`, `sol`.`est_sol` AS `est_sol`, `sol`.`fec_sol` AS `fec_sol`, `sol`.`sol_elim` AS `sol_elim`, `sol_prod`.`id_prod` AS `id_prod`, `prod`.`img_prod` AS `img_prod`, `prod`.`nom_prod` AS `nom_prod`, `sol_prod`.`cant_sol` AS `cant_sol`, `sol_prod`.`entregado` AS `entregado`, `sol_prod`.`fec_ent` AS `fec_ent`, `sol_prod`.`usu_ent` AS `usu_ent`, `usu`.`nom_usu` AS `nom_usu`, `sol_prod`.`aprob_prod` AS `aprob_prod`, `est`.`nom_est_sol` AS `nom_est_sol`, `est`.`color_est` AS `color_est` FROM ((((`inv_solicitud` `sol` join `inv_sol_x_prod` `sol_prod` on((`sol`.`id_sol` = `sol_prod`.`id_sol`))) join `inv_product` `prod` on((`sol_prod`.`id_prod` = `prod`.`id_prod`))) join `inv_est_sol` `est` on((`sol`.`est_sol` = `est`.`id_est_sol`))) left join `mq_usu` `usu` on((`sol_prod`.`usu_ent` = `usu`.`id_usu`))) WHERE (`sol`.`sol_elim` = 0) ;

-- --------------------------------------------------------

--
-- Estructura para la vista `liquidacion_view`
--
DROP TABLE IF EXISTS `liquidacion_view`;

CREATE ALGORITHM=UNDEFINED DEFINER=`masterqu`@`%.%.%.%` SQL SECURITY DEFINER VIEW `liquidacion_view`  AS SELECT `us`.`nom_usu` AS `nom_usu`, `li`.`nom_liqui` AS `nom_liqui`, `ar`.`nom_are` AS `nom_are`, `inf`.`id_liqui` AS `id_liqui`, `inf`.`id_are` AS `id_are`, `inf`.`id_usu` AS `id_usu`, `inf`.`id_liquiInf` AS `id_liquiInf`, `inf`.`obs_info` AS `obs_info`, `inf`.`fech_pag` AS `fech_pag`, `inf`.`fech_ref` AS `fech_ref`, `inf`.`dias_habiles` AS `dias_habiles`, `inf`.`fec_ret` AS `fec_ret`, `inf`.`fech_sis` AS `fech_sis` FROM (((`ind_infoli` `inf` join `mq_usu` `us` on((`inf`.`id_usu` = `us`.`id_usu`))) join `ind_liqui` `li` on((`inf`.`id_liquiInf` = `li`.`id_liquiInf`))) join `mq_are` `ar` on((`inf`.`id_are` = `ar`.`id_are`))) ORDER BY `inf`.`id_liqui` ASC ;

-- --------------------------------------------------------

--
-- Estructura para la vista `negocios_view`
--
DROP TABLE IF EXISTS `negocios_view`;

CREATE ALGORITHM=UNDEFINED DEFINER=`masterqu_admin`@`%.%.%.%` SQL SECURITY DEFINER VIEW `negocios_view`  AS SELECT `nego`.`id_neg` AS `id_neg`, `nego`.`nom_neg` AS `nom_neg`, `nego`.`des_neg` AS `des_neg`, `nego`.`obs_neg` AS `obs_neg`, `nego`.`val_neg` AS `val_neg`, `nego`.`pot_crea` AS `pot_crea`, `nego`.`cont_rea` AS `cont_rea`, `nego`.`visi_rea` AS `visi_rea`, `nego`.`cot_soli` AS `cot_soli`, `nego`.`ped_rea` AS `ped_rea`, `est`.`id_est` AS `id_est`, `est`.`estado` AS `estado`, `tip`.`id_tipo` AS `id_tipo`, `tip`.`nom_tipo` AS `nom_tipo`, `usu`.`id_usu` AS `id_usu`, `usu`.`nom_usu` AS `nom_usu`, (select `mq_usu`.`nom_usu` from `mq_usu` where (`mq_usu`.`id_usu` = `nego`.`ase_com`)) AS `ase_com`, `nego`.`fec_ini` AS `fec_ini`, `nego`.`fec_fin` AS `fec_fin`, `nego`.`fec_crea` AS `fec_crea`, `cli`.`id_cli` AS `id_cli`, `cli`.`nom_cli` AS `nom_cli`, (select group_concat(distinct `cot_categoria`.`nom_cat` order by `cot_categoria`.`nom_cat` ASC separator ', ') from (`cat_x_neg` join `cot_categoria` on((`cat_x_neg`.`id_cat` = `cot_categoria`.`id_cat`))) where (`cat_x_neg`.`id_neg` = `nego`.`id_neg`)) AS `neg_cat` FROM ((((`negocios` `nego` join `neg_est` `est` on((`nego`.`id_est` = `est`.`id_est`))) join `tipo_negocio` `tip` on((`nego`.`id_tipo` = `tip`.`id_tipo`))) join `mq_usu` `usu` on((`nego`.`id_usu` = `usu`.`id_usu`))) join `mq_clientes` `cli` on((`nego`.`id_cli` = `cli`.`id_cli`))) ;

-- --------------------------------------------------------

--
-- Estructura para la vista `permisos_view`
--
DROP TABLE IF EXISTS `permisos_view`;

CREATE ALGORITHM=UNDEFINED DEFINER=`masterqu`@`%.%.%.%` SQL SECURITY DEFINER VIEW `permisos_view`  AS SELECT `a`.`id_per` AS `id_per`, `b`.`id_usu` AS `id_usu`, `b`.`nom_usu` AS `nom_usu`, `b`.`id_lider` AS `id_lider`, `a`.`fech_sis` AS `fech_sis`, `a`.`fech_aus` AS `fech_aus`, `c`.`nom_are` AS `nom_are`, `a`.`fech_ini` AS `fech_ini`, `a`.`fech_fin` AS `fech_fin`, `d`.`mot_per` AS `mot_per`, `a`.`obser_perm` AS `obser_perm`, `d`.`descrip_per` AS `descrip_per`, `e`.`id_estPer` AS `id_estPer`, `e`.`nom_estPer` AS `nom_estPer`, `a`.`doc_perm` AS `doc_perm`, `a`.`crea_rec` AS `crea_rec`, `a`.`revi_rec` AS `revi_rec`, `a`.`id_are` AS `id_are` FROM ((((`per_ingreso` `a` join `mq_usu` `b`) join `mq_are` `c`) join `per_motivo` `d`) join `per_estado` `e`) WHERE ((`a`.`id_usu` = `b`.`id_usu`) AND (`a`.`id_are` = `c`.`id_are`) AND (`a`.`mot_per` = `d`.`mot_per`) AND (`a`.`id_estPer` = `e`.`id_estPer`)) ORDER BY `a`.`id_per` ASC ;

-- --------------------------------------------------------

--
-- Estructura para la vista `productos_view`
--
DROP TABLE IF EXISTS `productos_view`;

CREATE ALGORITHM=UNDEFINED DEFINER=`masterqu`@`190.25.239.162` SQL SECURITY DEFINER VIEW `productos_view`  AS SELECT `pro`.`cod_pro` AS `cod_pro`, `pro`.`cod_ref` AS `cod_ref`, `pro`.`nom_pro` AS `nom_pro`, `pro`.`img_pro` AS `img_pro`, `pro`.`und_emp` AS `und_emp`, `pro`.`can_emp` AS `can_emp` FROM `cot_productos` AS `pro` ;

-- --------------------------------------------------------

--
-- Estructura para la vista `transacciones_view`
--
DROP TABLE IF EXISTS `transacciones_view`;

CREATE ALGORITHM=UNDEFINED DEFINER=`masterqu_admin`@`%.%.%.%` SQL SECURITY DEFINER VIEW `transacciones_view`  AS SELECT `tra`.`id_tra` AS `id_tra`, `tra`.`fec_crea` AS `fec_crea`, `tra`.`id_tipo` AS `id_tipo`, `tra`.`id_neg` AS `id_neg`, `tra`.`id_cli` AS `id_cli`, `usu`.`id_usu` AS `id_usu`, `usu`.`nom_usu` AS `nom_usu`, `tip`.`tipo` AS `tipo`, `corr`.`destino` AS `corr_destino`, `corr`.`asunto` AS `corr_asunto`, `corr`.`cuerpo` AS `corr_cuerpo`, `note`.`titulo` AS `nota_titulo`, `note`.`contenido` AS `nota_contenido`, `rec`.`fecha_recorda` AS `rec_fecha`, `rec`.`asunto` AS `rec_asunto`, `llam`.`destino` AS `lla_destino`, `llam`.`agendar` AS `lla_agendar`, `llam`.`observacion` AS `lla_observacion` FROM ((((((`crm_transaccion` `tra` join `mq_usu` `usu` on((`tra`.`id_usu` = `usu`.`id_usu`))) join `crm_tipo_tran` `tip` on((`tra`.`id_tipo` = `tip`.`id_tipo`))) left join `crm_correos` `corr` on((`tra`.`id_tra` = `corr`.`id_tra`))) left join `crm_notas` `note` on((`tra`.`id_tra` = `note`.`id_tra`))) left join `crm_recordatorios` `rec` on((`tra`.`id_tra` = `rec`.`id_tra`))) left join `crm_llamadas` `llam` on((`tra`.`id_tra` = `llam`.`id_tra`))) ;

-- --------------------------------------------------------

--
-- Estructura para la vista `users_view`
--
DROP TABLE IF EXISTS `users_view`;

CREATE ALGORITHM=UNDEFINED DEFINER=`masterqu`@`%.%.%.%` SQL SECURITY DEFINER VIEW `users_view`  AS SELECT `a`.`id_usu` AS `id_usu`, `a`.`nom_usu` AS `nom_usu`, `a`.`usuario` AS `usuario`, `a`.`fec_crea` AS `fec_crea`, `a`.`usu_upt` AS `usu_upt`, `a`.`eml_usu` AS `eml_usu`, `a`.`id_are` AS `id_are`, `a`.`usu_elim` AS `usu_elim`, `a`.`num_perfil` AS `num_perfil`, `b`.`nom_are` AS `nom_are`, `a`.`id_reg` AS `id_reg`, `c`.`nom_reg` AS `nom_reg` FROM ((`mq_usu` `a` join `mq_are` `b`) join `mq_reg` `c`) WHERE ((`a`.`id_are` = `b`.`id_are`) AND (`a`.`id_reg` = `c`.`id_reg`)) ORDER BY `a`.`nom_usu` ASC ;

-- --------------------------------------------------------

--
-- Estructura para la vista `view_correspondencia_4`
--
DROP TABLE IF EXISTS `view_correspondencia_4`;

CREATE ALGORITHM=UNDEFINED DEFINER=`masterqu`@`%.%.%.%` SQL SECURITY DEFINER VIEW `view_correspondencia_4`  AS SELECT `corr`.`id_seg` AS `id_seg`, `corr`.`id_estSeg` AS `id_estSeg`, `corr`.`id_usu` AS `id_usu`, `us`.`nom_usu` AS `nom_usu`, `nom`.`nom_doc` AS `nom_doc`, `corr`.`fech_ini` AS `fech_ini`, `ar`.`nom_are` AS `nom_are`, `us1`.`nom_usu` AS `nom_per_encarga`, `corr`.`per_encarga` AS `per_encarga`, `es`.`nom_estS` AS `nom_estS`, `corr`.`id_nom` AS `id_nom`, `corr`.`id_prove` AS `id_prove`, `corr`.`fec_ven` AS `fec_ven`, `cli`.`nom_cli` AS `nom_cli`, `cli`.`id_cli` AS `id_cli`, `corr`.`num_facR` AS `num_facR`, `corr`.`fech_cre` AS `fech_cre` FROM (((((((`correspondencias` `corr` join `mq_usu` `us` on((`corr`.`id_usu` = `us`.`id_usu`))) join `seg_nomdoc` `nom` on((`corr`.`id_nom` = `nom`.`id_nom`))) join `mq_are` `ar` on((`corr`.`area_remit` = `ar`.`id_are`))) join `seg_estado` `es` on((`corr`.`id_estSeg` = `es`.`id_estSeg`))) join `mq_reg` `reg` on((`corr`.`id_reg` = `reg`.`id_reg`))) join `mq_clientes` `cli` on((`corr`.`id_prove` = `cli`.`id_cli`))) join `mq_usu` `us1` on((`corr`.`per_encarga` = `us1`.`id_usu`))) WHERE (`corr`.`id_seg` <> '') GROUP BY `corr`.`id_seg` ;

-- --------------------------------------------------------

--
-- Estructura para la vista `visitas_view`
--
DROP TABLE IF EXISTS `visitas_view`;

CREATE ALGORITHM=UNDEFINED DEFINER=`masterqu`@`%.%.%.%` SQL SECURITY DEFINER VIEW `visitas_view`  AS SELECT `vis`.`id_vis` AS `id_vis`, `per`.`id_per` AS `id_per`, `per`.`nom_per` AS `nom_per`, `per`.`emp_per` AS `emp_per`, `vis`.`fec_vis` AS `fec_vis`, `vis`.`fec_sal` AS `fec_sal`, `are`.`nom_are` AS `nom_are`, `vis`.`fot_vis` AS `fot_vis`, `vis`.`doc_induccion` AS `doc_induccion` FROM ((`mq_pers` `per` join `mq_vis` `vis` on((`per`.`id_per` = `vis`.`id_per`))) join `mq_are` `are` on((`vis`.`id_are` = `are`.`id_are`))) ;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `act_economica`
--
ALTER TABLE `act_economica`
  ADD PRIMARY KEY (`id_act`);

--
-- Indices de la tabla `agen_comerciales`
--
ALTER TABLE `agen_comerciales`
  ADD PRIMARY KEY (`id_agen`);

--
-- Indices de la tabla `agen_est`
--
ALTER TABLE `agen_est`
  ADD PRIMARY KEY (`id_est`);

--
-- Indices de la tabla `agen_perfil`
--
ALTER TABLE `agen_perfil`
  ADD PRIMARY KEY (`id_perf`);

--
-- Indices de la tabla `agen_raz`
--
ALTER TABLE `agen_raz`
  ADD PRIMARY KEY (`id_raz`);

--
-- Indices de la tabla `agen_tipclie`
--
ALTER TABLE `agen_tipclie`
  ADD PRIMARY KEY (`id_tipcli`);

--
-- Indices de la tabla `agen_tip_llamada`
--
ALTER TABLE `agen_tip_llamada`
  ADD PRIMARY KEY (`id_llam`);

--
-- Indices de la tabla `cat_clientes`
--
ALTER TABLE `cat_clientes`
  ADD PRIMARY KEY (`id_cat`);

--
-- Indices de la tabla `ciudades`
--
ALTER TABLE `ciudades`
  ADD PRIMARY KEY (`id_ciu`);

--
-- Indices de la tabla `contactos`
--
ALTER TABLE `contactos`
  ADD PRIMARY KEY (`id_cont`);

--
-- Indices de la tabla `contactos1`
--
ALTER TABLE `contactos1`
  ADD PRIMARY KEY (`id_cont`);

--
-- Indices de la tabla `contactos_andi`
--
ALTER TABLE `contactos_andi`
  ADD PRIMARY KEY (`id_cont`);

--
-- Indices de la tabla `correspondencias`
--
ALTER TABLE `correspondencias`
  ADD PRIMARY KEY (`id_seg`);

--
-- Indices de la tabla `cotizadores`
--
ALTER TABLE `cotizadores`
  ADD PRIMARY KEY (`ced_cotz`),
  ADD KEY `id_car` (`id_car`);

--
-- Indices de la tabla `cot_ACA_ubi_x_cot`
--
ALTER TABLE `cot_ACA_ubi_x_cot`
  ADD PRIMARY KEY (`id_ubica`);

--
-- Indices de la tabla `cot_categoria`
--
ALTER TABLE `cot_categoria`
  ADD UNIQUE KEY `id_cat_2` (`id_cat`),
  ADD KEY `id_cat` (`id_cat`);

--
-- Indices de la tabla `cot_cat_dlg`
--
ALTER TABLE `cot_cat_dlg`
  ADD KEY `id_cat` (`id_cat`),
  ADD KEY `id_coti` (`id_coti`);

--
-- Indices de la tabla `cot_cotizaciones`
--
ALTER TABLE `cot_cotizaciones`
  ADD PRIMARY KEY (`id_coti`);

--
-- Indices de la tabla `cot_cotizaciones1`
--
ALTER TABLE `cot_cotizaciones1`
  ADD PRIMARY KEY (`id_coti`);

--
-- Indices de la tabla `cot_descrip_rech`
--
ALTER TABLE `cot_descrip_rech`
  ADD PRIMARY KEY (`id_rechazo`);

--
-- Indices de la tabla `cot_ema_est`
--
ALTER TABLE `cot_ema_est`
  ADD PRIMARY KEY (`id_ema`);

--
-- Indices de la tabla `cot_est_margen`
--
ALTER TABLE `cot_est_margen`
  ADD PRIMARY KEY (`id_estmarg`);

--
-- Indices de la tabla `cot_form_pag_mypro`
--
ALTER TABLE `cot_form_pag_mypro`
  ADD PRIMARY KEY (`id_pag`);

--
-- Indices de la tabla `cot_margen`
--
ALTER TABLE `cot_margen`
  ADD PRIMARY KEY (`id_margen`);

--
-- Indices de la tabla `cot_precios`
--
ALTER TABLE `cot_precios`
  ADD PRIMARY KEY (`id_pre`),
  ADD KEY `cod_pro` (`cod_pro`),
  ADD KEY `nit_cli` (`nit_cli`);

--
-- Indices de la tabla `cot_productos`
--
ALTER TABLE `cot_productos`
  ADD PRIMARY KEY (`cod_pro`);

--
-- Indices de la tabla `cot_pro_x_cot`
--
ALTER TABLE `cot_pro_x_cot`
  ADD KEY `id_coti` (`id_coti`),
  ADD KEY `cod_pro` (`cod_pro`);

--
-- Indices de la tabla `cot_tap_tip_logo`
--
ALTER TABLE `cot_tap_tip_logo`
  ADD PRIMARY KEY (`id_tip_log`);

--
-- Indices de la tabla `cot_tap_tip_tapete`
--
ALTER TABLE `cot_tap_tip_tapete`
  ADD PRIMARY KEY (`id_tap`);

--
-- Indices de la tabla `cot_tip_cotizacion_ACA`
--
ALTER TABLE `cot_tip_cotizacion_ACA`
  ADD PRIMARY KEY (`id_tip_cotA`);

--
-- Indices de la tabla `cot_tip_pedido`
--
ALTER TABLE `cot_tip_pedido`
  ADD PRIMARY KEY (`id_tip_pedi`);

--
-- Indices de la tabla `credit_actSol`
--
ALTER TABLE `credit_actSol`
  ADD PRIMARY KEY (`id_act`);

--
-- Indices de la tabla `credit_concepAt`
--
ALTER TABLE `credit_concepAt`
  ADD PRIMARY KEY (`id_conAt`);

--
-- Indices de la tabla `credit_concept`
--
ALTER TABLE `credit_concept`
  ADD PRIMARY KEY (`id_concept`);

--
-- Indices de la tabla `credit_docum`
--
ALTER TABLE `credit_docum`
  ADD PRIMARY KEY (`id_docum`);

--
-- Indices de la tabla `credit_env_mercancia`
--
ALTER TABLE `credit_env_mercancia`
  ADD PRIMARY KEY (`id_mer`);

--
-- Indices de la tabla `credit_regimen`
--
ALTER TABLE `credit_regimen`
  ADD PRIMARY KEY (`id_regimen`);

--
-- Indices de la tabla `credit_segmento`
--
ALTER TABLE `credit_segmento`
  ADD PRIMARY KEY (`id_segmento`);

--
-- Indices de la tabla `credit_sol`
--
ALTER TABLE `credit_sol`
  ADD PRIMARY KEY (`id_sol`);

--
-- Indices de la tabla `cre_contactos`
--
ALTER TABLE `cre_contactos`
  ADD PRIMARY KEY (`id_cont`),
  ADD KEY `id_sol` (`id_sol`),
  ADD KEY `id_cli` (`id_cli`),
  ADD KEY `id_usu` (`id_usu`);

--
-- Indices de la tabla `cre_env_mercancia`
--
ALTER TABLE `cre_env_mercancia`
  ADD PRIMARY KEY (`id_mer`);

--
-- Indices de la tabla `cre_estadosol`
--
ALTER TABLE `cre_estadosol`
  ADD PRIMARY KEY (`id_est`);

--
-- Indices de la tabla `cre_eva_clie`
--
ALTER TABLE `cre_eva_clie`
  ADD PRIMARY KEY (`id_evaCl`),
  ADD KEY `id_sol` (`id_sol`);

--
-- Indices de la tabla `cre_factura`
--
ALTER TABLE `cre_factura`
  ADD PRIMARY KEY (`id_factura`),
  ADD KEY `id_cli` (`id_cli`),
  ADD KEY `id_sol` (`id_sol`);

--
-- Indices de la tabla `cre_solicitud`
--
ALTER TABLE `cre_solicitud`
  ADD PRIMARY KEY (`id_sol`),
  ADD KEY `id_cli` (`id_cli`),
  ADD KEY `id_est` (`id_est`);

--
-- Indices de la tabla `cre_solicitud2`
--
ALTER TABLE `cre_solicitud2`
  ADD PRIMARY KEY (`id_sol`),
  ADD KEY `id_cli` (`id_cli`),
  ADD KEY `id_est` (`id_est`);

--
-- Indices de la tabla `cre_x_mov`
--
ALTER TABLE `cre_x_mov`
  ADD KEY `id_sol` (`id_sol`);

--
-- Indices de la tabla `crm_correos`
--
ALTER TABLE `crm_correos`
  ADD PRIMARY KEY (`id_correo`);

--
-- Indices de la tabla `crm_llamadas`
--
ALTER TABLE `crm_llamadas`
  ADD PRIMARY KEY (`id_llamada`);

--
-- Indices de la tabla `crm_notas`
--
ALTER TABLE `crm_notas`
  ADD PRIMARY KEY (`id_nota`);

--
-- Indices de la tabla `crm_recordatorios`
--
ALTER TABLE `crm_recordatorios`
  ADD PRIMARY KEY (`id_recordatorio`);

--
-- Indices de la tabla `crm_tipo_tran`
--
ALTER TABLE `crm_tipo_tran`
  ADD PRIMARY KEY (`id_tipo`);

--
-- Indices de la tabla `crm_transaccion`
--
ALTER TABLE `crm_transaccion`
  ADD PRIMARY KEY (`id_tra`);

--
-- Indices de la tabla `encu_covid`
--
ALTER TABLE `encu_covid`
  ADD PRIMARY KEY (`id_cov`);

--
-- Indices de la tabla `ind_act`
--
ALTER TABLE `ind_act`
  ADD PRIMARY KEY (`id_act`),
  ADD KEY `id_usu` (`id_usu`);

--
-- Indices de la tabla `ind_cap`
--
ALTER TABLE `ind_cap`
  ADD PRIMARY KEY (`id_cap`),
  ADD KEY `id_tipcap` (`id_tipcap`),
  ADD KEY `id_are` (`id_are`),
  ADD KEY `id_usu` (`id_usu`);

--
-- Indices de la tabla `ind_cargos`
--
ALTER TABLE `ind_cargos`
  ADD PRIMARY KEY (`id_carg`);

--
-- Indices de la tabla `ind_carg_x_are`
--
ALTER TABLE `ind_carg_x_are`
  ADD KEY `id_carg` (`id_carg`),
  ADD KEY `id_are` (`id_are`);

--
-- Indices de la tabla `ind_cert_x_usu`
--
ALTER TABLE `ind_cert_x_usu`
  ADD PRIMARY KEY (`id_cert`);

--
-- Indices de la tabla `ind_clim`
--
ALTER TABLE `ind_clim`
  ADD PRIMARY KEY (`id_clim`);

--
-- Indices de la tabla `ind_desc`
--
ALTER TABLE `ind_desc`
  ADD PRIMARY KEY (`id_desc`),
  ADD KEY `id_usu` (`id_usu`),
  ADD KEY `id_are` (`id_are`),
  ADD KEY `id_estado` (`id_estado`),
  ADD KEY `id_tip_desc` (`id_tip_desc`),
  ADD KEY `id_reg` (`id_reg`);

--
-- Indices de la tabla `ind_desc_esta`
--
ALTER TABLE `ind_desc_esta`
  ADD PRIMARY KEY (`id_estado`);

--
-- Indices de la tabla `ind_desc_tip`
--
ALTER TABLE `ind_desc_tip`
  ADD PRIMARY KEY (`id_tip_desc`);

--
-- Indices de la tabla `ind_edad`
--
ALTER TABLE `ind_edad`
  ADD PRIMARY KEY (`id_edad`);

--
-- Indices de la tabla `ind_errores`
--
ALTER TABLE `ind_errores`
  ADD PRIMARY KEY (`id_error`),
  ADD KEY `id_pag` (`id_pag`);

--
-- Indices de la tabla `ind_estados`
--
ALTER TABLE `ind_estados`
  ADD PRIMARY KEY (`id_estaSol`);

--
-- Indices de la tabla `ind_fechas`
--
ALTER TABLE `ind_fechas`
  ADD PRIMARY KEY (`id_relPag`);

--
-- Indices de la tabla `ind_infoli`
--
ALTER TABLE `ind_infoli`
  ADD PRIMARY KEY (`id_liqui`),
  ADD KEY `id_are` (`id_are`),
  ADD KEY `id_usu` (`id_usu`);

--
-- Indices de la tabla `ind_liqui`
--
ALTER TABLE `ind_liqui`
  ADD PRIMARY KEY (`id_liquiInf`);

--
-- Indices de la tabla `ind_mes`
--
ALTER TABLE `ind_mes`
  ADD PRIMARY KEY (`id_mes`);

--
-- Indices de la tabla `ind_nompag`
--
ALTER TABLE `ind_nompag`
  ADD PRIMARY KEY (`id_pag`);

--
-- Indices de la tabla `ind_select_per`
--
ALTER TABLE `ind_select_per`
  ADD PRIMARY KEY (`id_sel`);

--
-- Indices de la tabla `ind_solcarg`
--
ALTER TABLE `ind_solcarg`
  ADD PRIMARY KEY (`id_solC`),
  ADD UNIQUE KEY `id_edad_2` (`id_edad`),
  ADD KEY `id_edad` (`id_edad`),
  ADD KEY `id_estaSol` (`id_estaSol`),
  ADD KEY `id_usu` (`id_usu`),
  ADD KEY `id_edad_3` (`id_edad`);

--
-- Indices de la tabla `ind_tipcap`
--
ALTER TABLE `ind_tipcap`
  ADD PRIMARY KEY (`id_tipcap`);

--
-- Indices de la tabla `ind_tipcontrato`
--
ALTER TABLE `ind_tipcontrato`
  ADD PRIMARY KEY (`id_tipcont`);

--
-- Indices de la tabla `inv_config`
--
ALTER TABLE `inv_config`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `inv_est_sol`
--
ALTER TABLE `inv_est_sol`
  ADD PRIMARY KEY (`id_est_sol`);

--
-- Indices de la tabla `inv_inventario`
--
ALTER TABLE `inv_inventario`
  ADD PRIMARY KEY (`id_inv`),
  ADD KEY `id_prod` (`id_prod`),
  ADD KEY `id_reg` (`id_reg`);

--
-- Indices de la tabla `inv_mov_inventario`
--
ALTER TABLE `inv_mov_inventario`
  ADD PRIMARY KEY (`id_mov`),
  ADD KEY `FK_id_prod1` (`id_prod`),
  ADD KEY `FK_id_reg1` (`id_reg`);

--
-- Indices de la tabla `inv_product`
--
ALTER TABLE `inv_product`
  ADD PRIMARY KEY (`id_prod`);

--
-- Indices de la tabla `inv_prod_x_are`
--
ALTER TABLE `inv_prod_x_are`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `inv_solicitud`
--
ALTER TABLE `inv_solicitud`
  ADD PRIMARY KEY (`id_sol`),
  ADD KEY `est_sol` (`est_sol`);

--
-- Indices de la tabla `inv_sol_x_mov`
--
ALTER TABLE `inv_sol_x_mov`
  ADD KEY `id_sol` (`id_sol`),
  ADD KEY `est_sol` (`est_sol`);

--
-- Indices de la tabla `inv_sol_x_prod`
--
ALTER TABLE `inv_sol_x_prod`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_id_sol` (`id_sol`),
  ADD KEY `FK_id_product` (`id_prod`);

--
-- Indices de la tabla `mq_are`
--
ALTER TABLE `mq_are`
  ADD PRIMARY KEY (`id_are`);

--
-- Indices de la tabla `mq_clie`
--
ALTER TABLE `mq_clie`
  ADD PRIMARY KEY (`id_cli`);

--
-- Indices de la tabla `mq_clientes`
--
ALTER TABLE `mq_clientes`
  ADD PRIMARY KEY (`id_cli`),
  ADD UNIQUE KEY `id_cli` (`id_cli`);

--
-- Indices de la tabla `mq_clientesTEMP`
--
ALTER TABLE `mq_clientesTEMP`
  ADD PRIMARY KEY (`id_cli`),
  ADD UNIQUE KEY `id_cli` (`id_cli`);

--
-- Indices de la tabla `mq_diligencias`
--
ALTER TABLE `mq_diligencias`
  ADD PRIMARY KEY (`num_dlg`);

--
-- Indices de la tabla `mq_diligencias1`
--
ALTER TABLE `mq_diligencias1`
  ADD PRIMARY KEY (`num_dlg`);

--
-- Indices de la tabla `mq_enrt`
--
ALTER TABLE `mq_enrt`
  ADD PRIMARY KEY (`num_enr`);

--
-- Indices de la tabla `mq_est_dlg`
--
ALTER TABLE `mq_est_dlg`
  ADD PRIMARY KEY (`id_est_dlg`);

--
-- Indices de la tabla `mq_inventarios`
--
ALTER TABLE `mq_inventarios`
  ADD PRIMARY KEY (`id_rolinv`);

--
-- Indices de la tabla `mq_log`
--
ALTER TABLE `mq_log`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `mq_per`
--
ALTER TABLE `mq_per`
  ADD PRIMARY KEY (`id_per`);

--
-- Indices de la tabla `mq_pers`
--
ALTER TABLE `mq_pers`
  ADD PRIMARY KEY (`id_per`);

--
-- Indices de la tabla `mq_prove`
--
ALTER TABLE `mq_prove`
  ADD PRIMARY KEY (`id_prove`);

--
-- Indices de la tabla `mq_reg`
--
ALTER TABLE `mq_reg`
  ADD PRIMARY KEY (`id_reg`);

--
-- Indices de la tabla `mq_rol`
--
ALTER TABLE `mq_rol`
  ADD PRIMARY KEY (`id_rol`);

--
-- Indices de la tabla `mq_rolinv`
--
ALTER TABLE `mq_rolinv`
  ADD PRIMARY KEY (`id_rolinv`);

--
-- Indices de la tabla `mq_rol_inv`
--
ALTER TABLE `mq_rol_inv`
  ADD PRIMARY KEY (`id_rol_inv`);

--
-- Indices de la tabla `mq_tip_usu`
--
ALTER TABLE `mq_tip_usu`
  ADD PRIMARY KEY (`id_tipumq`);

--
-- Indices de la tabla `mq_usu`
--
ALTER TABLE `mq_usu`
  ADD PRIMARY KEY (`id_usu`),
  ADD UNIQUE KEY `eml_usu` (`eml_usu`),
  ADD KEY `id_are` (`id_are`),
  ADD KEY `id_reg` (`id_reg`);

--
-- Indices de la tabla `mq_usu1`
--
ALTER TABLE `mq_usu1`
  ADD PRIMARY KEY (`id_usu`),
  ADD UNIQUE KEY `eml_usu` (`eml_usu`),
  ADD KEY `id_are` (`id_are`),
  ADD KEY `id_reg` (`id_reg`);

--
-- Indices de la tabla `mq_vis`
--
ALTER TABLE `mq_vis`
  ADD PRIMARY KEY (`id_vis`),
  ADD KEY `id_per` (`id_per`),
  ADD KEY `id_are` (`id_are`),
  ADD KEY `id_usu` (`id_usu`);

--
-- Indices de la tabla `negocios`
--
ALTER TABLE `negocios`
  ADD PRIMARY KEY (`id_neg`);

--
-- Indices de la tabla `neg_est`
--
ALTER TABLE `neg_est`
  ADD PRIMARY KEY (`id_est`);

--
-- Indices de la tabla `per_estado`
--
ALTER TABLE `per_estado`
  ADD PRIMARY KEY (`id_estPer`);

--
-- Indices de la tabla `per_ingreso`
--
ALTER TABLE `per_ingreso`
  ADD PRIMARY KEY (`id_per`),
  ADD KEY `id_are` (`id_are`),
  ADD KEY `id_usu` (`id_usu`),
  ADD KEY `usu_perm` (`usu_perm`),
  ADD KEY `id_estPer` (`id_estPer`);

--
-- Indices de la tabla `per_motivo`
--
ALTER TABLE `per_motivo`
  ADD PRIMARY KEY (`mot_per`);

--
-- Indices de la tabla `precios`
--
ALTER TABLE `precios`
  ADD PRIMARY KEY (`id_pre`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`id_prod`);

--
-- Indices de la tabla `productos_fam`
--
ALTER TABLE `productos_fam`
  ADD PRIMARY KEY (`id_fam`);

--
-- Indices de la tabla `productos_unids`
--
ALTER TABLE `productos_unids`
  ADD PRIMARY KEY (`id_uni`);

--
-- Indices de la tabla `reg_llam`
--
ALTER TABLE `reg_llam`
  ADD PRIMARY KEY (`id_llama`);

--
-- Indices de la tabla `seg_bodeg`
--
ALTER TABLE `seg_bodeg`
  ADD PRIMARY KEY (`id_bodeg`);

--
-- Indices de la tabla `seg_estado`
--
ALTER TABLE `seg_estado`
  ADD PRIMARY KEY (`id_estSeg`);

--
-- Indices de la tabla `seg_nomdoc`
--
ALTER TABLE `seg_nomdoc`
  ADD PRIMARY KEY (`id_nom`);

--
-- Indices de la tabla `tipo_clientes`
--
ALTER TABLE `tipo_clientes`
  ADD PRIMARY KEY (`id_tipo`);

--
-- Indices de la tabla `tipo_negocio`
--
ALTER TABLE `tipo_negocio`
  ADD PRIMARY KEY (`id_tipo`);

--
-- Indices de la tabla `tip_dlg`
--
ALTER TABLE `tip_dlg`
  ADD PRIMARY KEY (`id_tip_dlg`);

--
-- Indices de la tabla `usu_per`
--
ALTER TABLE `usu_per`
  ADD PRIMARY KEY (`id_usu`,`id_per`),
  ADD KEY `id_per` (`id_per`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `act_economica`
--
ALTER TABLE `act_economica`
  MODIFY `id_act` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `agen_comerciales`
--
ALTER TABLE `agen_comerciales`
  MODIFY `id_agen` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `agen_est`
--
ALTER TABLE `agen_est`
  MODIFY `id_est` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `agen_perfil`
--
ALTER TABLE `agen_perfil`
  MODIFY `id_perf` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `agen_raz`
--
ALTER TABLE `agen_raz`
  MODIFY `id_raz` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `agen_tipclie`
--
ALTER TABLE `agen_tipclie`
  MODIFY `id_tipcli` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `agen_tip_llamada`
--
ALTER TABLE `agen_tip_llamada`
  MODIFY `id_llam` int(11) NOT NULL AUTO_INCREMENT COMMENT 'id llamada';

--
-- AUTO_INCREMENT de la tabla `cat_clientes`
--
ALTER TABLE `cat_clientes`
  MODIFY `id_cat` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `ciudades`
--
ALTER TABLE `ciudades`
  MODIFY `id_ciu` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Identificador';

--
-- AUTO_INCREMENT de la tabla `contactos`
--
ALTER TABLE `contactos`
  MODIFY `id_cont` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Identificador';

--
-- AUTO_INCREMENT de la tabla `contactos1`
--
ALTER TABLE `contactos1`
  MODIFY `id_cont` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Identificador';

--
-- AUTO_INCREMENT de la tabla `contactos_andi`
--
ALTER TABLE `contactos_andi`
  MODIFY `id_cont` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Id contacto andi';

--
-- AUTO_INCREMENT de la tabla `correspondencias`
--
ALTER TABLE `correspondencias`
  MODIFY `id_seg` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `cot_ACA_ubi_x_cot`
--
ALTER TABLE `cot_ACA_ubi_x_cot`
  MODIFY `id_ubica` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `cot_categoria`
--
ALTER TABLE `cot_categoria`
  MODIFY `id_cat` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Id Categoría';

--
-- AUTO_INCREMENT de la tabla `cot_cotizaciones`
--
ALTER TABLE `cot_cotizaciones`
  MODIFY `id_coti` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `cot_cotizaciones1`
--
ALTER TABLE `cot_cotizaciones1`
  MODIFY `id_coti` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `cot_descrip_rech`
--
ALTER TABLE `cot_descrip_rech`
  MODIFY `id_rechazo` int(15) NOT NULL AUTO_INCREMENT COMMENT 'id ';

--
-- AUTO_INCREMENT de la tabla `cot_ema_est`
--
ALTER TABLE `cot_ema_est`
  MODIFY `id_ema` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `cot_est_margen`
--
ALTER TABLE `cot_est_margen`
  MODIFY `id_estmarg` int(11) NOT NULL AUTO_INCREMENT COMMENT 'id del estado de margen';

--
-- AUTO_INCREMENT de la tabla `cot_form_pag_mypro`
--
ALTER TABLE `cot_form_pag_mypro`
  MODIFY `id_pag` int(15) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `cot_margen`
--
ALTER TABLE `cot_margen`
  MODIFY `id_margen` int(11) NOT NULL AUTO_INCREMENT COMMENT 'id del margen';

--
-- AUTO_INCREMENT de la tabla `cot_precios`
--
ALTER TABLE `cot_precios`
  MODIFY `id_pre` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `cot_productos`
--
ALTER TABLE `cot_productos`
  MODIFY `cod_pro` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `cot_tap_tip_logo`
--
ALTER TABLE `cot_tap_tip_logo`
  MODIFY `id_tip_log` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `cot_tap_tip_tapete`
--
ALTER TABLE `cot_tap_tip_tapete`
  MODIFY `id_tap` int(11) NOT NULL AUTO_INCREMENT COMMENT 'id tipo de tapete';

--
-- AUTO_INCREMENT de la tabla `cot_tip_cotizacion_ACA`
--
ALTER TABLE `cot_tip_cotizacion_ACA`
  MODIFY `id_tip_cotA` int(11) NOT NULL AUTO_INCREMENT COMMENT 'id tip cotizacion Aca';

--
-- AUTO_INCREMENT de la tabla `cot_tip_pedido`
--
ALTER TABLE `cot_tip_pedido`
  MODIFY `id_tip_pedi` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `credit_actSol`
--
ALTER TABLE `credit_actSol`
  MODIFY `id_act` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `credit_concepAt`
--
ALTER TABLE `credit_concepAt`
  MODIFY `id_conAt` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `credit_concept`
--
ALTER TABLE `credit_concept`
  MODIFY `id_concept` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `credit_docum`
--
ALTER TABLE `credit_docum`
  MODIFY `id_docum` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `credit_env_mercancia`
--
ALTER TABLE `credit_env_mercancia`
  MODIFY `id_mer` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `credit_regimen`
--
ALTER TABLE `credit_regimen`
  MODIFY `id_regimen` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `credit_segmento`
--
ALTER TABLE `credit_segmento`
  MODIFY `id_segmento` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `credit_sol`
--
ALTER TABLE `credit_sol`
  MODIFY `id_sol` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `cre_contactos`
--
ALTER TABLE `cre_contactos`
  MODIFY `id_cont` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `cre_env_mercancia`
--
ALTER TABLE `cre_env_mercancia`
  MODIFY `id_mer` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `cre_estadosol`
--
ALTER TABLE `cre_estadosol`
  MODIFY `id_est` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `cre_eva_clie`
--
ALTER TABLE `cre_eva_clie`
  MODIFY `id_evaCl` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `cre_factura`
--
ALTER TABLE `cre_factura`
  MODIFY `id_factura` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `cre_solicitud`
--
ALTER TABLE `cre_solicitud`
  MODIFY `id_sol` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `cre_solicitud2`
--
ALTER TABLE `cre_solicitud2`
  MODIFY `id_sol` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `crm_correos`
--
ALTER TABLE `crm_correos`
  MODIFY `id_correo` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `crm_llamadas`
--
ALTER TABLE `crm_llamadas`
  MODIFY `id_llamada` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `crm_notas`
--
ALTER TABLE `crm_notas`
  MODIFY `id_nota` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `crm_recordatorios`
--
ALTER TABLE `crm_recordatorios`
  MODIFY `id_recordatorio` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `crm_tipo_tran`
--
ALTER TABLE `crm_tipo_tran`
  MODIFY `id_tipo` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `crm_transaccion`
--
ALTER TABLE `crm_transaccion`
  MODIFY `id_tra` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `encu_covid`
--
ALTER TABLE `encu_covid`
  MODIFY `id_cov` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `ind_act`
--
ALTER TABLE `ind_act`
  MODIFY `id_act` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `ind_cap`
--
ALTER TABLE `ind_cap`
  MODIFY `id_cap` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `ind_cert_x_usu`
--
ALTER TABLE `ind_cert_x_usu`
  MODIFY `id_cert` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `ind_clim`
--
ALTER TABLE `ind_clim`
  MODIFY `id_clim` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `ind_desc`
--
ALTER TABLE `ind_desc`
  MODIFY `id_desc` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `ind_desc_esta`
--
ALTER TABLE `ind_desc_esta`
  MODIFY `id_estado` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `ind_desc_tip`
--
ALTER TABLE `ind_desc_tip`
  MODIFY `id_tip_desc` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `ind_edad`
--
ALTER TABLE `ind_edad`
  MODIFY `id_edad` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `ind_errores`
--
ALTER TABLE `ind_errores`
  MODIFY `id_error` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `ind_estados`
--
ALTER TABLE `ind_estados`
  MODIFY `id_estaSol` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `ind_fechas`
--
ALTER TABLE `ind_fechas`
  MODIFY `id_relPag` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `ind_infoli`
--
ALTER TABLE `ind_infoli`
  MODIFY `id_liqui` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `ind_liqui`
--
ALTER TABLE `ind_liqui`
  MODIFY `id_liquiInf` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `ind_mes`
--
ALTER TABLE `ind_mes`
  MODIFY `id_mes` int(11) NOT NULL AUTO_INCREMENT COMMENT 'id mes indicador ';

--
-- AUTO_INCREMENT de la tabla `ind_nompag`
--
ALTER TABLE `ind_nompag`
  MODIFY `id_pag` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `ind_select_per`
--
ALTER TABLE `ind_select_per`
  MODIFY `id_sel` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `ind_solcarg`
--
ALTER TABLE `ind_solcarg`
  MODIFY `id_solC` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `ind_tipcap`
--
ALTER TABLE `ind_tipcap`
  MODIFY `id_tipcap` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `ind_tipcontrato`
--
ALTER TABLE `ind_tipcontrato`
  MODIFY `id_tipcont` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `inv_config`
--
ALTER TABLE `inv_config`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Id de la configuración';

--
-- AUTO_INCREMENT de la tabla `inv_est_sol`
--
ALTER TABLE `inv_est_sol`
  MODIFY `id_est_sol` int(4) NOT NULL AUTO_INCREMENT COMMENT 'Id autoincrementable estado solicitud';

--
-- AUTO_INCREMENT de la tabla `inv_inventario`
--
ALTER TABLE `inv_inventario`
  MODIFY `id_inv` int(12) NOT NULL AUTO_INCREMENT COMMENT 'Id autoincrementable inventario';

--
-- AUTO_INCREMENT de la tabla `inv_mov_inventario`
--
ALTER TABLE `inv_mov_inventario`
  MODIFY `id_mov` int(5) NOT NULL AUTO_INCREMENT COMMENT 'Id movimiento Inventario MQ';

--
-- AUTO_INCREMENT de la tabla `inv_product`
--
ALTER TABLE `inv_product`
  MODIFY `id_prod` int(10) NOT NULL AUTO_INCREMENT COMMENT 'Id del producto autoincrementable Inventarios';

--
-- AUTO_INCREMENT de la tabla `inv_prod_x_are`
--
ALTER TABLE `inv_prod_x_are`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `inv_solicitud`
--
ALTER TABLE `inv_solicitud`
  MODIFY `id_sol` int(12) NOT NULL AUTO_INCREMENT COMMENT 'Id autoincrementable solicitud';

--
-- AUTO_INCREMENT de la tabla `inv_sol_x_prod`
--
ALTER TABLE `inv_sol_x_prod`
  MODIFY `id` int(12) NOT NULL AUTO_INCREMENT COMMENT 'Id autoincrementable productos relacionados a la solicitud';

--
-- AUTO_INCREMENT de la tabla `mq_are`
--
ALTER TABLE `mq_are`
  MODIFY `id_are` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `mq_clientes`
--
ALTER TABLE `mq_clientes`
  MODIFY `id_cli` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Identificador';

--
-- AUTO_INCREMENT de la tabla `mq_clientesTEMP`
--
ALTER TABLE `mq_clientesTEMP`
  MODIFY `id_cli` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Identificador';

--
-- AUTO_INCREMENT de la tabla `mq_diligencias`
--
ALTER TABLE `mq_diligencias`
  MODIFY `num_dlg` int(11) NOT NULL AUTO_INCREMENT COMMENT 'numero de la diligencia';

--
-- AUTO_INCREMENT de la tabla `mq_diligencias1`
--
ALTER TABLE `mq_diligencias1`
  MODIFY `num_dlg` int(11) NOT NULL AUTO_INCREMENT COMMENT 'numero de la diligencia';

--
-- AUTO_INCREMENT de la tabla `mq_enrt`
--
ALTER TABLE `mq_enrt`
  MODIFY `num_enr` int(11) NOT NULL AUTO_INCREMENT COMMENT 'numero de enrutamiento';

--
-- AUTO_INCREMENT de la tabla `mq_inventarios`
--
ALTER TABLE `mq_inventarios`
  MODIFY `id_rolinv` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `mq_log`
--
ALTER TABLE `mq_log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `mq_per`
--
ALTER TABLE `mq_per`
  MODIFY `id_per` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Id del permiso';

--
-- AUTO_INCREMENT de la tabla `mq_reg`
--
ALTER TABLE `mq_reg`
  MODIFY `id_reg` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `mq_rolinv`
--
ALTER TABLE `mq_rolinv`
  MODIFY `id_rolinv` int(11) NOT NULL AUTO_INCREMENT COMMENT 'id rol inv';

--
-- AUTO_INCREMENT de la tabla `mq_rol_inv`
--
ALTER TABLE `mq_rol_inv`
  MODIFY `id_rol_inv` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Id rol del aplicativo de Inventarios';

--
-- AUTO_INCREMENT de la tabla `mq_tip_usu`
--
ALTER TABLE `mq_tip_usu`
  MODIFY `id_tipumq` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `mq_vis`
--
ALTER TABLE `mq_vis`
  MODIFY `id_vis` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `negocios`
--
ALTER TABLE `negocios`
  MODIFY `id_neg` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Identificador';

--
-- AUTO_INCREMENT de la tabla `neg_est`
--
ALTER TABLE `neg_est`
  MODIFY `id_est` int(15) NOT NULL AUTO_INCREMENT COMMENT 'Identificador';

--
-- AUTO_INCREMENT de la tabla `per_estado`
--
ALTER TABLE `per_estado`
  MODIFY `id_estPer` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `per_ingreso`
--
ALTER TABLE `per_ingreso`
  MODIFY `id_per` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `per_motivo`
--
ALTER TABLE `per_motivo`
  MODIFY `mot_per` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `precios`
--
ALTER TABLE `precios`
  MODIFY `id_pre` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `id_prod` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `reg_llam`
--
ALTER TABLE `reg_llam`
  MODIFY `id_llama` int(11) NOT NULL AUTO_INCREMENT COMMENT 'llamada ';

--
-- AUTO_INCREMENT de la tabla `seg_bodeg`
--
ALTER TABLE `seg_bodeg`
  MODIFY `id_bodeg` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `seg_estado`
--
ALTER TABLE `seg_estado`
  MODIFY `id_estSeg` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `seg_nomdoc`
--
ALTER TABLE `seg_nomdoc`
  MODIFY `id_nom` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tipo_clientes`
--
ALTER TABLE `tipo_clientes`
  MODIFY `id_tipo` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Identificador';

--
-- AUTO_INCREMENT de la tabla `tipo_negocio`
--
ALTER TABLE `tipo_negocio`
  MODIFY `id_tipo` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Identificador';

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `ind_desc`
--
ALTER TABLE `ind_desc`
  ADD CONSTRAINT `ind_desc_ibfk_1` FOREIGN KEY (`id_tip_desc`) REFERENCES `ind_desc_tip` (`id_tip_desc`),
  ADD CONSTRAINT `ind_desc_ibfk_2` FOREIGN KEY (`id_reg`) REFERENCES `mq_reg` (`id_reg`);

--
-- Filtros para la tabla `ind_infoli`
--
ALTER TABLE `ind_infoli`
  ADD CONSTRAINT `ind_infoli_ibfk_1` FOREIGN KEY (`id_are`) REFERENCES `mq_are` (`id_are`),
  ADD CONSTRAINT `ind_infoli_ibfk_2` FOREIGN KEY (`id_usu`) REFERENCES `mq_usu` (`id_usu`);

--
-- Filtros para la tabla `ind_solcarg`
--
ALTER TABLE `ind_solcarg`
  ADD CONSTRAINT `ind_solcarg_ibfk_1` FOREIGN KEY (`id_edad`) REFERENCES `ind_edad` (`id_edad`),
  ADD CONSTRAINT `ind_solcarg_ibfk_2` FOREIGN KEY (`id_estaSol`) REFERENCES `ind_estados` (`id_estaSol`),
  ADD CONSTRAINT `ind_solcarg_ibfk_3` FOREIGN KEY (`id_usu`) REFERENCES `mq_usu` (`id_usu`);

--
-- Filtros para la tabla `inv_inventario`
--
ALTER TABLE `inv_inventario`
  ADD CONSTRAINT `inv_inventario_ibfk_1` FOREIGN KEY (`id_prod`) REFERENCES `inv_product` (`id_prod`),
  ADD CONSTRAINT `inv_inventario_ibfk_2` FOREIGN KEY (`id_reg`) REFERENCES `mq_reg` (`id_reg`);

--
-- Filtros para la tabla `inv_mov_inventario`
--
ALTER TABLE `inv_mov_inventario`
  ADD CONSTRAINT `FK_id_prod1` FOREIGN KEY (`id_prod`) REFERENCES `inv_product` (`id_prod`),
  ADD CONSTRAINT `FK_id_reg1` FOREIGN KEY (`id_reg`) REFERENCES `mq_reg` (`id_reg`);

--
-- Filtros para la tabla `inv_solicitud`
--
ALTER TABLE `inv_solicitud`
  ADD CONSTRAINT `inv_solicitud_ibfk_1` FOREIGN KEY (`est_sol`) REFERENCES `inv_est_sol` (`id_est_sol`);

--
-- Filtros para la tabla `inv_sol_x_mov`
--
ALTER TABLE `inv_sol_x_mov`
  ADD CONSTRAINT `inv_sol_x_mov_ibfk_1` FOREIGN KEY (`id_sol`) REFERENCES `inv_solicitud` (`id_sol`),
  ADD CONSTRAINT `inv_sol_x_mov_ibfk_2` FOREIGN KEY (`est_sol`) REFERENCES `inv_est_sol` (`id_est_sol`);

--
-- Filtros para la tabla `inv_sol_x_prod`
--
ALTER TABLE `inv_sol_x_prod`
  ADD CONSTRAINT `FK_id_product` FOREIGN KEY (`id_prod`) REFERENCES `inv_product` (`id_prod`),
  ADD CONSTRAINT `FK_id_sol` FOREIGN KEY (`id_sol`) REFERENCES `inv_solicitud` (`id_sol`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;



