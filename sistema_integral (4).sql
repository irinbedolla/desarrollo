-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 08-10-2024 a las 18:23:41
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
-- Base de datos: `sistema_integral`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `abogados`
--

CREATE TABLE `abogados` (
  `idAbogado` int(11) NOT NULL,
  `nombres` varchar(60) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NOT NULL,
  `primer_apellido` varchar(60) NOT NULL,
  `segundo_apellido` varchar(60) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NOT NULL,
  `telefono` varchar(10) NOT NULL,
  `email` varchar(40) NOT NULL,
  `ine` varchar(60) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NOT NULL,
  `cedula` varchar(60) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci DEFAULT NULL COMMENT 'Anexo 2',
  `anexo` varchar(60) DEFAULT NULL,
  `representacion` varchar(60) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NOT NULL,
  `fechaRegistro` date NOT NULL,
  `fechaVigencia` date NOT NULL,
  `empresa` varchar(60) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NOT NULL,
  `eliminado` bit(1) NOT NULL DEFAULT b'0',
  `curp` varchar(18) NOT NULL,
  `domicilio` varchar(80) NOT NULL,
  `rfc` varchar(13) DEFAULT NULL,
  `industria` varchar(50) NOT NULL,
  `poder` text NOT NULL,
  `regionMorelia` enum('Si','No') NOT NULL COMMENT '0 para si  No para NO',
  `regionUruapan` enum('Si','No') NOT NULL,
  `regionZamora` enum('Si','No') NOT NULL,
  `estatus` enum('Pendiente','Validado') NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `abogados`
--

INSERT INTO `abogados` (`idAbogado`, `nombres`, `primer_apellido`, `segundo_apellido`, `telefono`, `email`, `ine`, `cedula`, `anexo`, `representacion`, `fechaRegistro`, `fechaVigencia`, `empresa`, `eliminado`, `curp`, `domicilio`, `rfc`, `industria`, `poder`, `regionMorelia`, `regionUruapan`, `regionZamora`, `estatus`, `updated_at`, `created_at`) VALUES
(6, 'IRVIN SAMUEL', 'BEDOLLA', 'MOTA', '4445545454', 'irvinsbm@gmail.com', 'IRVIN SAMUELBEDOLLAMOTA-CCL211231BE8_IDENTIFICACION.pdf', 'asdasdas', 'Sin anexo', 'IRVIN SAMUELBEDOLLAMOTA-CCL211231BE8_IDENTIFICACION.pdf', '2024-10-03', '2025-12-31', 'CCL211231BE8', b'0', 'BEMI890329HMNDTR02', 'CALLE: PRIMO TAPIA #208 COLONIA: L OMAS DEL  DURAZNO', NULL, 'computadoras', 'asdasdas', 'No', 'Si', 'Si', 'Pendiente', '2024-10-04 00:31:32', '2024-09-24 04:11:18');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `capacitaciones`
--

CREATE TABLE `capacitaciones` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `modulos` int(11) NOT NULL,
  `inicio` date NOT NULL,
  `fin` date NOT NULL,
  `estatus` enum('En curso','Cerrado','Cancelado') NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `capacitaciones`
--

INSERT INTO `capacitaciones` (`id`, `nombre`, `modulos`, `inicio`, `fin`, `estatus`, `created_at`, `updated_at`) VALUES
(8, 'NAYELI', 2, '2024-07-01', '2024-07-08', 'En curso', '2024-07-09 04:43:46', '2024-07-09 04:43:46'),
(9, 'Lenjuage y resolucion de conflicto', 4, '2024-07-01', '2024-09-01', 'En curso', '2024-07-09 04:59:22', '2024-07-09 04:59:22');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `capacitaciones_calificacion`
--

CREATE TABLE `capacitaciones_calificacion` (
  `id` int(11) NOT NULL,
  `capacitacion` int(11) NOT NULL,
  `persona` int(11) NOT NULL,
  `calificacion` float NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `capacitaciones_calificacion`
--

INSERT INTO `capacitaciones_calificacion` (`id`, `capacitacion`, `persona`, `calificacion`, `created_at`, `updated_at`) VALUES
(9, 9, 11, 0, '2024-07-09 05:09:18', '2024-07-09 05:09:18'),
(10, 9, 15, 50, '2024-09-02 22:34:37', '2024-09-02 22:38:22');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `capacitaciones_encuesta`
--

CREATE TABLE `capacitaciones_encuesta` (
  `id` int(11) NOT NULL,
  `id_cap` int(11) NOT NULL,
  `id_modulo` int(11) NOT NULL,
  `pregunta` varchar(50) NOT NULL,
  `respuesta1` varchar(50) NOT NULL,
  `respuesta2` varchar(50) NOT NULL,
  `respuesta3` varchar(50) NOT NULL,
  `respuesta4` varchar(50) NOT NULL,
  `correcta` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `capacitaciones_encuesta`
--

INSERT INTO `capacitaciones_encuesta` (`id`, `id_cap`, `id_modulo`, `pregunta`, `respuesta1`, `respuesta2`, `respuesta3`, `respuesta4`, `correcta`, `created_at`, `updated_at`) VALUES
(24, 5, 1, '1.	¿Qué cambios ha generado la globalización?', 'Apoyos sociales.', 'Modificación en instituciones económico-financiera', 'Un fortalecimiento de las instituciones.', 'Emociones', 2, '2024-06-21 00:15:13', '2024-06-21 00:15:13'),
(25, 5, 1, '2.	¿De acuerdo con el autor, la reducción de carác', 'Apoyos sociales.', 'Desregularización de la economía, privatización y ', 'Un fortalecimiento de las instituciones.', 'El conflicto', 2, '2024-06-21 00:15:13', '2024-06-21 00:15:13'),
(26, 8, 1, 'Que opinas de la pregunta 1', 'res 1', 'rews 2', 'res 3', 'res 4', 2, '2024-07-09 04:44:13', '2024-07-09 04:44:13'),
(27, 9, 1, 'pregunta 1', 'res 13', 'asdasd', 'sdasd', 'asdas', 2, '2024-07-09 05:01:34', '2024-07-09 05:01:34'),
(28, 9, 1, 'Que opinas de la pregunta 1', 'la respuesta es 1', 'rews 2', 'sdasd', 'la respuesta 4', 2, '2024-07-09 05:01:34', '2024-07-09 05:01:34'),
(29, 8, 2, 'Que opinas de la pregunta 1', 'la respuesta es 1', 'rews 2', 'res 3', 'la respuesta 4', 1, '2024-07-13 04:15:15', '2024-07-13 04:15:15');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `capacitaciones_modulo`
--

CREATE TABLE `capacitaciones_modulo` (
  `id` int(11) NOT NULL,
  `id_cap` int(11) NOT NULL,
  `id_modulo` int(11) NOT NULL,
  `nombre` text NOT NULL,
  `introduccion` text NOT NULL,
  `desarrollo` text NOT NULL,
  `estatus` enum('Pendiente','Termiando','Activo') NOT NULL DEFAULT 'Pendiente',
  `anexo1` text DEFAULT NULL,
  `anexo2` text DEFAULT NULL,
  `anexo3` text DEFAULT NULL,
  `anexo4` text DEFAULT NULL,
  `anexo5` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `capacitaciones_modulo`
--

INSERT INTO `capacitaciones_modulo` (`id`, `id_cap`, `id_modulo`, `nombre`, `introduccion`, `desarrollo`, `estatus`, `anexo1`, `anexo2`, `anexo3`, `anexo4`, `anexo5`, `created_at`, `updated_at`) VALUES
(13, 5, 1, 'Módulo I: Antecedentes y Generalidades de la Reforma al Sistema de Justicia Laboral', 'La justicia cotidiana es la justicia más cercana a las personas. La que vivimos día a día en nuestras interacciones ordinarias, la que facilita la convivencia armónica y la paz social. Es la que reclaman vecinos, trabajadores, padres de familia y la que se vive en las escuelas. Por décadas, la justicia cotidiana ha estado lejos de ser una prioridad en nuestro país. Nos hemos concentrado en la justicia penal que, aunque sin duda importante, atiende conflictos menos frecuentes. A uno de los próceres de la patria, José María Morelos y Pavón, se le atribuye una frase que por más de dos siglos ha sido una aspiración para los mexicanos: “Que todo el que se queje con justicia tenga un tribunal que lo escuche, lo ampare y lo defienda contra el fuerte y el arbitrario.” Hoy, tener acceso a un tribunal para resolver los conflictos más comunes no es suficiente en México. Estos Diálogos por la Justicia Cotidiana ilustran bien que aún hay más por hacer. Actualmente, las injusticias se asoman en lo ordinario. Requerimos no sólo que los tribunales protejan al indefenso, sino que lo hagan de manera expedita y, principalmente, que nuestros conflictos se resuelvan de fondo y todos tengan certeza sobre sus derechos.', 'Desde hace más de tres décadas, la globalización ha generado cambios significativos en las estructuras e instituciones económico-financieras, sociales, laborales, educativas y políticas; transformaciones marcadas, al menos, por tres fenómenos:\r\n1.	La reducción del carácter social del Estado que implicó la desregulación de la economía, el redimensionamiento del sector público, la privatización y la “extranjerización” de las empresas estatales y los recursos naturales.\r\n2.	La apertura e integración de los aparatos productivos y los mercados a instancias multinacionales de diversa dimensión; y\r\n3.	La recomposición de los procesos de trabajo y la flexibilización de las relaciones laborales asociadas a la intensa innovación tecnológica.', 'Pendiente', 'Módulo I: Antecedentes y Generalidades de la Reforma al Sistema de Justicia Laboral_Anexo1.pdf', NULL, NULL, NULL, NULL, '2024-06-21 00:08:55', '2024-06-21 00:08:55'),
(14, 8, 1, 'NAYELI', 'erg', 'gergerg', 'Pendiente', 'NAYELI_Anexo1.pdf', NULL, NULL, NULL, NULL, '2024-07-09 04:44:13', '2024-07-09 04:44:13'),
(15, 9, 1, 'Modulo 1', 'Introduccion', 'Desarrollo', 'Pendiente', 'Modulo 1_Anexo1.pdf', 'Modulo 1_Anexo2.pdf', NULL, NULL, NULL, '2024-07-09 05:01:34', '2024-07-09 05:01:34'),
(16, 8, 2, 'Modulo 2', 'aqui va la introduccion', 'el desarrollo del modulo va aqui', 'Pendiente', 'Modulo 2_Anexo1.pdf', NULL, NULL, NULL, NULL, '2024-07-13 04:15:15', '2024-07-13 04:15:15');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `capacitaciones_persona`
--

CREATE TABLE `capacitaciones_persona` (
  `id` int(11) NOT NULL,
  `capacitacion` int(11) NOT NULL,
  `persona` int(11) NOT NULL,
  `modulo` int(11) NOT NULL,
  `estatus` enum('En curso','Terminado','Cancelado','En prueba') NOT NULL DEFAULT 'En curso',
  `calificacion` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `capacitaciones_persona`
--

INSERT INTO `capacitaciones_persona` (`id`, `capacitacion`, `persona`, `modulo`, `estatus`, `calificacion`, `created_at`, `updated_at`) VALUES
(71, 9, 11, 1, 'Terminado', 0, '2024-07-09 05:04:34', '2024-07-09 05:04:34'),
(72, 9, 12, 1, 'En curso', NULL, '2024-07-09 05:04:35', '2024-07-09 05:04:35'),
(73, 9, 13, 1, 'En curso', NULL, '2024-07-09 05:04:36', '2024-07-09 05:04:36'),
(74, 10, 11, 1, 'En curso', NULL, '2024-08-31 01:07:39', '2024-08-31 01:07:39'),
(79, 10, 12, 1, 'En curso', NULL, '2024-09-02 22:09:36', '2024-09-02 22:09:36'),
(80, 9, 15, 1, 'Terminado', 50, '2024-09-02 22:13:55', '2024-09-02 22:13:55');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `documentacion_persona`
--

CREATE TABLE `documentacion_persona` (
  `id` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `nivel_estudios` text NOT NULL,
  `titulo` text NOT NULL,
  `especialidad` text DEFAULT NULL,
  `diplomado` text DEFAULT NULL,
  `seminario` text DEFAULT NULL,
  `cursos` text DEFAULT NULL,
  `desarrollo` text DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `documentacion_persona`
--

INSERT INTO `documentacion_persona` (`id`, `id_usuario`, `nivel_estudios`, `titulo`, `especialidad`, `diplomado`, `seminario`, `cursos`, `desarrollo`, `updated_at`, `created_at`) VALUES
(7, 4, 'auxiliar_Estudios.pdf', 'auxiliar_Titulo.pdf', 'usuario axxiliar_Especialidades.pdf', NULL, NULL, NULL, NULL, '2024-06-26 00:46:17', '2024-06-19 02:50:27'),
(10, 5, 'auxiliar 1_Estudios.pdf', 'auxiliar 1_Titulo.pdf', NULL, NULL, NULL, NULL, NULL, '2024-06-26 01:35:05', '2024-06-26 01:35:05'),
(12, 1, 'Irvin Bedola_Estudios.pdf', 'Irvin Bedola_Titulo.pdf', 'Irvin Bedola_Especialidades.pdf', 'Irvin Bedola_Diplomados.pdf', 'Irvin Bedola_Diplomados.pdf', 'Irvin Bedola_Cursos.pdf', 'Irvin Bedola_Desarrollo.pdf', '2024-09-02 22:58:04', '2024-07-18 20:51:09');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estadisticas_auxiliares`
--

CREATE TABLE `estadisticas_auxiliares` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `solicitudes` int(11) NOT NULL,
  `ratificaciones` int(11) NOT NULL,
  `asesorias` int(11) NOT NULL,
  `expediente_consulta` int(11) NOT NULL,
  `expediente_escaneo` int(11) NOT NULL,
  `expediente_foliar` int(11) NOT NULL,
  `cuantificacion` float NOT NULL,
  `exhortos` int(11) NOT NULL,
  `audiencias_celebradas` int(11) NOT NULL,
  `cumplimientos` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `delegacion` varchar(20) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `estadisticas_auxiliares`
--

INSERT INTO `estadisticas_auxiliares` (`id`, `user_id`, `solicitudes`, `ratificaciones`, `asesorias`, `expediente_consulta`, `expediente_escaneo`, `expediente_foliar`, `cuantificacion`, `exhortos`, `audiencias_celebradas`, `cumplimientos`, `fecha`, `delegacion`, `created_at`, `updated_at`) VALUES
(9, 4, 2, 3, 5, 15, 15, 1, 51, 51, 51, 5, '2024-09-17', '', '2024-09-17 23:26:13', '2024-09-17 23:26:13'),
(10, 4, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, '2024-09-17', '', '2024-09-17 23:34:13', '2024-09-17 23:34:13');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estadisticas_conciliadores`
--

CREATE TABLE `estadisticas_conciliadores` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `solicitues_atendidas` int(11) NOT NULL,
  `audiencia_programada` int(11) NOT NULL,
  `audiencia_celebradas` int(11) NOT NULL,
  `convenios_conciliatorios` int(11) NOT NULL,
  `ratificaciones_convenio` int(11) NOT NULL,
  `contancias_no_conciliacion` int(11) NOT NULL,
  `cuantificaciones` float NOT NULL,
  `asesorias` int(11) NOT NULL,
  `integracion_expediente` int(11) NOT NULL,
  `colectivas` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `delegacion` varchar(20) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `estadisticas_conciliadores`
--

INSERT INTO `estadisticas_conciliadores` (`id`, `user_id`, `solicitues_atendidas`, `audiencia_programada`, `audiencia_celebradas`, `convenios_conciliatorios`, `ratificaciones_convenio`, `contancias_no_conciliacion`, `cuantificaciones`, `asesorias`, `integracion_expediente`, `colectivas`, `fecha`, `delegacion`, `created_at`, `updated_at`) VALUES
(11, 8, 1, 2, 3, 4, 5, 0, 7, 8, 9, 10, '2024-09-17', 'Morelia', '2024-09-18 01:27:20', '2024-09-18 01:27:20'),
(12, 8, 10, 9, 8, 7, 6, 5, 4, 3, 2, 1, '2024-09-17', 'Morelia', '2024-09-18 01:28:33', '2024-09-18 01:28:33');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estadisticas_delegados`
--

CREATE TABLE `estadisticas_delegados` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `personas_atendidas` int(11) NOT NULL,
  `asesorias` int(11) NOT NULL,
  `solicitudes_inicio` int(11) NOT NULL,
  `audiencias_programadas` int(11) NOT NULL,
  `audiencias_celebradas` int(11) NOT NULL,
  `solicitudes_incopetencia` int(11) NOT NULL,
  `convenio_audiencia` float NOT NULL,
  `ratificacion_convenios` int(11) NOT NULL,
  `monto_convenios` int(11) NOT NULL,
  `notificaciones` int(11) NOT NULL,
  `contancia_no_conciliacion` int(11) NOT NULL,
  `contancia_no_conciliacion_patron` int(11) NOT NULL,
  `contancia_no_conciliacion_notificacion` int(11) NOT NULL,
  `solicitudes_archivadas` int(11) NOT NULL,
  `colectivas` int(11) NOT NULL,
  `mujeres` int(11) NOT NULL,
  `hombres` int(11) NOT NULL,
  `despido_injitificado` int(11) NOT NULL,
  `finiquito` int(11) NOT NULL,
  `derecho_preferencia` int(11) NOT NULL,
  `pago_prestaciones` int(11) NOT NULL,
  `terminacion_volintaria` int(11) NOT NULL,
  `supuesto_excepciones` int(11) NOT NULL,
  `otros` int(11) NOT NULL,
  `multas` int(11) NOT NULL,
  `cincuenta_umas` int(11) NOT NULL,
  `cien_umas` int(11) NOT NULL,
  `otro_monto` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `delegacion` varchar(20) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `estadisticas_delegados`
--

INSERT INTO `estadisticas_delegados` (`id`, `user_id`, `personas_atendidas`, `asesorias`, `solicitudes_inicio`, `audiencias_programadas`, `audiencias_celebradas`, `solicitudes_incopetencia`, `convenio_audiencia`, `ratificacion_convenios`, `monto_convenios`, `notificaciones`, `contancia_no_conciliacion`, `contancia_no_conciliacion_patron`, `contancia_no_conciliacion_notificacion`, `solicitudes_archivadas`, `colectivas`, `mujeres`, `hombres`, `despido_injitificado`, `finiquito`, `derecho_preferencia`, `pago_prestaciones`, `terminacion_volintaria`, `supuesto_excepciones`, `otros`, `multas`, `cincuenta_umas`, `cien_umas`, `otro_monto`, `fecha`, `delegacion`, `created_at`, `updated_at`) VALUES
(11, 8, 1, 2, 3, 4, 5, 0, 7, 8, 9, 10, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2024-09-17', 'Morelia', '2024-09-18 01:27:20', '2024-09-18 01:27:20'),
(12, 8, 10, 9, 8, 7, 6, 5, 4, 3, 2, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2024-09-17', 'Morelia', '2024-09-18 01:28:33', '2024-09-18 01:28:33'),
(13, 10, 4454, 5, 45, 465, 4654, 654, 654, 654, 545, 4, 545, 45, 45, 45, 45, 45, 4, 54, 54, 5, 45, 4, 54, 5, 45, 54, 54, 54, '2024-09-23', '', '2024-09-23 23:40:15', '2024-09-23 23:40:15');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estadisticas_notificadores`
--

CREATE TABLE `estadisticas_notificadores` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `citatorios` int(11) NOT NULL,
  `asesorias_notificador` int(11) NOT NULL,
  `solicitudes_levantadas` int(11) NOT NULL,
  `ratificaciones_notificador` int(11) NOT NULL,
  `razon_registrada` int(11) NOT NULL,
  `multas_notificador` int(11) NOT NULL,
  `informe_diario` int(11) NOT NULL,
  `informe_foraneo` int(11) NOT NULL,
  `integrar_expediente` int(11) NOT NULL,
  `escaneo_documentos` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `delegacion` varchar(20) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `estadisticas_notificadores`
--

INSERT INTO `estadisticas_notificadores` (`id`, `user_id`, `citatorios`, `asesorias_notificador`, `solicitudes_levantadas`, `ratificaciones_notificador`, `razon_registrada`, `multas_notificador`, `informe_diario`, `informe_foraneo`, `integrar_expediente`, `escaneo_documentos`, `fecha`, `delegacion`, `created_at`, `updated_at`) VALUES
(9, 9, 2, 3, 4, 5, 0, 3, 5, 3, 4, 5, '2024-09-12', 'Morelia', '2024-09-13 00:55:15', '2024-09-13 00:55:15');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(191) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2023_03_15_042622_create_permission_tables', 1),
(6, '2023_03_15_044104_create_distfederal_table', 1),
(7, '2023_03_15_045215_create_distlocal_table', 1),
(8, '2023_03_29_195142_create_municipio_table', 1),
(9, '2023_03_29_195942_create_persona_table', 1),
(10, '2023_03_31_043624_create_seccion_electoral_table', 1),
(11, '2024_09_06_000000_create_blogs_table', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(191) NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `model_has_permissions`
--

INSERT INTO `model_has_permissions` (`permission_id`, `model_type`, `model_id`) VALUES
(1, 'web', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(191) NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `model_has_roles`
--

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
(16, 'App\\Models\\User', 1),
(18, 'App\\Models\\User', 3),
(20, 'App\\Models\\User', 4),
(20, 'App\\Models\\User', 6),
(20, 'App\\Models\\User', 17),
(21, 'App\\Models\\User', 8),
(22, 'App\\Models\\User', 9),
(23, 'App\\Models\\User', 10),
(27, 'App\\Models\\User', 16);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) NOT NULL,
  `token` varchar(191) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) NOT NULL,
  `guard_name` varchar(191) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'ver-rol', 'web', '2023-05-10 14:28:26', '2023-05-10 14:28:26'),
(2, 'crear-rol', 'web', '2023-05-10 14:28:26', '2023-05-10 14:28:26'),
(3, 'editar-rol', 'web', '2023-05-10 14:28:26', '2023-05-10 14:28:26'),
(4, 'borrar-rol', 'web', '2023-05-10 14:28:26', '2023-05-10 14:28:26'),
(5, 'ver-abogado', 'web', '2023-05-10 14:28:26', '2023-05-10 14:28:26'),
(6, 'crear-abogado', 'web', '2023-05-10 14:28:26', '2023-05-10 14:28:26'),
(7, 'editar-abogado', 'web', '2023-05-10 14:28:26', '2023-05-10 14:28:26'),
(8, 'borrar-abogado', 'web', '2023-05-10 14:28:26', '2023-05-10 14:28:26'),
(9, 'ver-usuario', 'web', '2023-05-10 14:28:26', '2023-05-10 14:28:26'),
(10, 'crear-usuario', 'web', '2023-05-10 14:28:26', '2023-05-10 14:28:26'),
(11, 'editar-usuario', 'web', '2023-05-10 14:28:26', '2023-05-10 14:28:26'),
(12, 'borrar-usuario', 'web', '2023-05-10 14:28:26', '2023-05-10 14:28:26'),
(13, 'ver-curso', 'web', '2024-06-05 21:38:07', '2024-06-05 21:38:11'),
(14, 'crear-curso', 'web', '2024-06-05 21:38:24', '2024-06-05 21:38:24'),
(15, 'editar-curso', 'web', '2024-06-05 21:38:24', '2024-06-05 21:38:24'),
(16, 'borrar-curso', 'web', '2024-06-05 21:38:24', '2024-06-05 21:38:24'),
(17, 'aceptar-persona', 'web', '2024-06-05 21:38:24', '2024-06-05 21:38:24'),
(18, 'ver-miscapacitaciones', 'web', '2024-06-12 16:42:28', '2024-06-12 16:42:29'),
(19, 'crear-miscapacitaciones', 'web', '2024-06-12 16:43:03', '2024-06-12 16:43:03'),
(20, 'ver-seer', 'web', '2024-08-29 16:53:14', '2024-08-29 16:53:21'),
(21, 'crear-seer', 'web', '2024-08-29 16:53:26', '2024-08-29 16:53:26'),
(22, 'editar-seer', 'web', '2024-08-29 16:53:48', '2024-08-29 16:53:48'),
(23, 'ver-estaditica', 'web', '2024-09-02 16:46:16', '2024-09-23 18:46:24'),
(24, 'crear-turnos', 'web', '2024-10-04 21:22:36', '2024-10-04 21:22:36'),
(25, 'ver-turno', 'web', '2024-10-04 21:22:36', '2024-10-04 21:22:36');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `persona`
--

CREATE TABLE `persona` (
  `id` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `email` varchar(25) NOT NULL,
  `cargo` varchar(50) NOT NULL,
  `area_adcripcion` varchar(50) NOT NULL,
  `telefono` varchar(10) NOT NULL,
  `estudio_maximo` text NOT NULL,
  `tilulo_universitario` text NOT NULL,
  `especialidades` text DEFAULT NULL,
  `diplomados` text DEFAULT NULL,
  `seminarios` text DEFAULT NULL,
  `cursos` text DEFAULT NULL,
  `acciones_desarrollo` text DEFAULT NULL,
  `estatus` enum('Aceptado','Rechazado','Pendiente') NOT NULL DEFAULT 'Pendiente',
  `observaciones` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `persona`
--

INSERT INTO `persona` (`id`, `id_usuario`, `nombre`, `email`, `cargo`, `area_adcripcion`, `telefono`, `estudio_maximo`, `tilulo_universitario`, `especialidades`, `diplomados`, `seminarios`, `cursos`, `acciones_desarrollo`, `estatus`, `observaciones`, `created_at`, `updated_at`) VALUES
(11, 4, 'auxiliar', 'auxiliar@gmail.com', 'Auxuliar', 'Personal', '4433132692', 'Licenciatura', 'auxiliar', 'Redes', NULL, NULL, NULL, NULL, 'Aceptado', NULL, '2024-06-21 00:01:25', '2024-06-26 00:46:17'),
(12, 6, 'auxiliar', 'auxiliar@gmail.com', 'Auxuliar', 'Personal', '4433132692', 'Licenciatura', 'auxiliar', 'Redes', NULL, NULL, NULL, NULL, 'Aceptado', NULL, '2024-06-26 00:39:25', '2024-07-09 04:43:19'),
(13, 5, 'auxiliar 1', 'auxiliar1@gmail.com', 'Auxiliar 2', 'Personal', '4431324324', 'Licenciatura', 'Licensiatura ne derecho', NULL, NULL, NULL, NULL, NULL, 'Aceptado', NULL, '2024-06-26 01:35:05', '2024-06-26 01:35:05'),
(15, 1, 'Irvin Bedola', 'irvinsbm@gmail.com', 'Jefe de departamento', 'Personal', '7676710596', 'Licenciatura', 'Ingenieria en computacion', NULL, NULL, NULL, NULL, NULL, 'Aceptado', NULL, '2024-07-18 20:51:09', '2024-07-18 20:51:09');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(191) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) NOT NULL,
  `guard_name` varchar(191) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `roles`
--

INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(16, 'Super Usuario', 'web', '2024-06-04 01:08:30', '2024-06-04 01:08:30'),
(17, 'Administrador', 'web', '2024-06-04 01:31:03', '2024-06-04 01:31:03'),
(18, 'Capacitacion Admin', 'web', '2024-06-06 03:40:13', '2024-06-06 03:40:13'),
(19, 'Capacitacion Usuario', 'web', '2024-06-06 03:40:31', '2024-06-06 03:40:31'),
(20, 'Auxiliar', 'web', '2024-06-06 04:36:06', '2024-06-06 04:36:06'),
(21, 'Conciliador', 'web', '2024-08-29 22:55:33', '2024-08-29 23:07:33'),
(22, 'Notificador', 'web', '2024-08-29 23:12:23', '2024-08-29 23:12:23'),
(23, 'Delegado', 'web', '2024-08-29 23:17:22', '2024-08-29 23:17:22'),
(27, 'Estadistica', 'web', '2024-09-03 00:46:57', '2024-09-03 00:46:57');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `role_has_permissions`
--

CREATE TABLE `role_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `role_has_permissions`
--

INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES
(1, 16),
(1, 17),
(2, 16),
(2, 17),
(3, 16),
(4, 16),
(5, 16),
(5, 17),
(5, 20),
(6, 16),
(6, 17),
(6, 20),
(7, 16),
(7, 20),
(8, 16),
(8, 20),
(9, 16),
(9, 17),
(10, 16),
(10, 17),
(11, 16),
(12, 16),
(13, 16),
(13, 18),
(13, 19),
(13, 20),
(14, 16),
(14, 18),
(15, 16),
(15, 18),
(16, 16),
(16, 18),
(17, 16),
(17, 18),
(18, 16),
(18, 18),
(18, 20),
(19, 16),
(19, 18),
(19, 20),
(20, 16),
(20, 20),
(20, 21),
(20, 22),
(20, 23),
(21, 16),
(21, 20),
(21, 21),
(21, 22),
(21, 23),
(22, 16),
(22, 20),
(22, 21),
(22, 22),
(22, 23),
(23, 16),
(23, 27),
(24, 16),
(25, 16);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sedes`
--

CREATE TABLE `sedes` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `create_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `update_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `sedes`
--

INSERT INTO `sedes` (`id`, `nombre`, `create_at`, `update_at`) VALUES
(1, 'Morelia', '2024-09-02 19:22:28', '2024-09-02 19:22:28'),
(2, 'Zitácuaro', '2024-09-02 19:22:28', '2024-09-02 19:22:28'),
(3, 'Uruapan', '2024-09-02 20:06:48', '2024-09-02 20:06:48'),
(4, 'Lázaro Cárdenas', '2024-09-02 20:06:48', '2024-09-02 20:06:48'),
(5, 'Zamora', '2024-09-02 20:07:20', '2024-09-02 20:07:20'),
(6, 'Sahuayo', '2024-09-02 20:07:20', '2024-09-02 20:07:20');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `turnos`
--

CREATE TABLE `turnos` (
  `id` int(11) NOT NULL,
  `consecutivo` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `hora` time NOT NULL,
  `auxiliar` int(11) NOT NULL,
  `solicitante` char(100) NOT NULL,
  `estatus` enum('atendido','no atendido') NOT NULL DEFAULT 'no atendido',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `turnos`
--

INSERT INTO `turnos` (`id`, `consecutivo`, `fecha`, `hora`, `auxiliar`, `solicitante`, `estatus`, `created_at`, `updated_at`) VALUES
(3, 1, '2024-10-07', '22:53:22', 4, 'LIZBETH ALEJANDRA', 'no atendido', '2024-10-08 04:53:22', '2024-10-08 04:53:22'),
(4, 1, '2024-10-07', '23:00:05', 17, 'LIZBETH ALEJANDRA', 'no atendido', '2024-10-08 05:00:05', '2024-10-08 05:00:05');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `turno_disponible`
--

CREATE TABLE `turno_disponible` (
  `id` int(11) NOT NULL,
  `id_auxiliar` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `hora` time NOT NULL,
  `estatus` enum('Disponible','Ocupado') NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `turno_disponible`
--

INSERT INTO `turno_disponible` (`id`, `id_auxiliar`, `fecha`, `hora`, `estatus`, `created_at`, `updated_at`) VALUES
(3, 4, '2024-10-07', '22:53:22', 'Ocupado', '2024-10-08 04:53:22', '2024-10-08 04:53:22'),
(4, 17, '2024-10-07', '23:00:05', 'Ocupado', '2024-10-08 05:00:05', '2024-10-08 05:00:05');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) NOT NULL,
  `email` varchar(191) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) NOT NULL,
  `type` enum('Seer','Si concilio','Ambos') NOT NULL,
  `delegacion` enum('Morelia','Uruapan','Zamora') NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `type`, `delegacion`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Irvin Bedola', 'irvinsbm@gmail.com', NULL, '$2y$10$w/8byPhDUHsYhuMT1regv.NaQ6HaX5M7aK0a.VBGuasEdhZb8vo1y', 'Seer', 'Morelia', NULL, '2023-05-10 14:23:04', '2024-06-03 23:18:08'),
(3, 'Usuario Capacitaciones', 'usuario@gmail.com', NULL, '$2y$10$MWD95RpR0wG9TwUBqXeaQ.2Uu0c0g1AF9zTuH1AnwhAe1uPh8gHhK', '', '', NULL, '2024-06-04 01:44:56', '2024-06-12 21:10:06'),
(4, 'auxiliar', 'auxiliar@gmail.com', NULL, '$2y$10$rCkFeLBeLY/FJYyJTWneK.p/tABh9EJc4mDlprp.WOFBD0LdSYoEy', '', 'Morelia', NULL, '2024-06-12 22:38:39', '2024-07-18 02:18:23'),
(8, 'conciliador', 'conciliador@gmail.com', NULL, '$2y$10$mYBnYARhQywTf/fJ8Meq2ukvc1J19rsSRyV09kaBt4yTAhFdRadyC', '', 'Morelia', NULL, '2024-08-29 23:07:12', '2024-08-29 23:07:12'),
(9, 'Notificador', 'notificador@gmail.com', NULL, '$2y$10$vYVHiVAiuRjm5Si8vHFThO0Z4amlRg0tYalsH9VvptsbFKH2Lwy3C', '', 'Morelia', NULL, '2024-08-29 23:12:52', '2024-08-29 23:12:52'),
(10, 'delegado', 'delegado@gmail.com', NULL, '$2y$10$u/dZGbk7FJhQxO/2UaCeweHK8/7DrnZbBqE.OcZkUg.tx8/ZfZoWC', '', '', NULL, '2024-08-29 23:20:28', '2024-08-29 23:20:28'),
(16, 'Estadistica', 'estadistica@gmail.com', NULL, '$2y$10$FoFbAobdLHr.bCPNt5uY4u6rhR7nOehVKErW5wijPmmf/Bzu/Gw8W', '', '', NULL, '2024-09-03 00:47:28', '2024-09-03 00:47:28'),
(17, 'conciliaror 2', 'conciliador1@gmail.com', NULL, '$2y$10$7zSPkiTRZ1pe.VvmdbGg2eAlS5XOaqFjfuCQqbwNGp9vWc0O.pzk6', 'Seer', 'Morelia', NULL, '2024-09-03 03:45:27', '2024-10-08 00:27:42');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `abogados`
--
ALTER TABLE `abogados`
  ADD PRIMARY KEY (`idAbogado`);

--
-- Indices de la tabla `capacitaciones`
--
ALTER TABLE `capacitaciones`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `capacitaciones_calificacion`
--
ALTER TABLE `capacitaciones_calificacion`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `llave` (`capacitacion`,`persona`);

--
-- Indices de la tabla `capacitaciones_encuesta`
--
ALTER TABLE `capacitaciones_encuesta`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `capacitaciones_modulo`
--
ALTER TABLE `capacitaciones_modulo`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `capacitaciones_persona`
--
ALTER TABLE `capacitaciones_persona`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `llave` (`capacitacion`,`persona`,`modulo`);

--
-- Indices de la tabla `documentacion_persona`
--
ALTER TABLE `documentacion_persona`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `estadisticas_auxiliares`
--
ALTER TABLE `estadisticas_auxiliares`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `estadisticas_conciliadores`
--
ALTER TABLE `estadisticas_conciliadores`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `estadisticas_delegados`
--
ALTER TABLE `estadisticas_delegados`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `estadisticas_notificadores`
--
ALTER TABLE `estadisticas_notificadores`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indices de la tabla `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  ADD KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indices de la tabla `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  ADD KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indices de la tabla `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indices de la tabla `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indices de la tabla `persona`
--
ALTER TABLE `persona`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indices de la tabla `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indices de la tabla `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `role_has_permissions_role_id_foreign` (`role_id`);

--
-- Indices de la tabla `sedes`
--
ALTER TABLE `sedes`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `turnos`
--
ALTER TABLE `turnos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `turno_disponible`
--
ALTER TABLE `turno_disponible`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `abogados`
--
ALTER TABLE `abogados`
  MODIFY `idAbogado` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `capacitaciones`
--
ALTER TABLE `capacitaciones`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `capacitaciones_calificacion`
--
ALTER TABLE `capacitaciones_calificacion`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `capacitaciones_encuesta`
--
ALTER TABLE `capacitaciones_encuesta`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT de la tabla `capacitaciones_modulo`
--
ALTER TABLE `capacitaciones_modulo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT de la tabla `capacitaciones_persona`
--
ALTER TABLE `capacitaciones_persona`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=81;

--
-- AUTO_INCREMENT de la tabla `documentacion_persona`
--
ALTER TABLE `documentacion_persona`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `estadisticas_auxiliares`
--
ALTER TABLE `estadisticas_auxiliares`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `estadisticas_conciliadores`
--
ALTER TABLE `estadisticas_conciliadores`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `estadisticas_delegados`
--
ALTER TABLE `estadisticas_delegados`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de la tabla `estadisticas_notificadores`
--
ALTER TABLE `estadisticas_notificadores`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT de la tabla `persona`
--
ALTER TABLE `persona`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de la tabla `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT de la tabla `sedes`
--
ALTER TABLE `sedes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `turnos`
--
ALTER TABLE `turnos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `turno_disponible`
--
ALTER TABLE `turno_disponible`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
