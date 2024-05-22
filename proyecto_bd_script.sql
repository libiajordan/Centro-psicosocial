  -- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 22-11-2023 a las 00:29:21
-- Versión del servidor: 10.4.28-MariaDB
-- Versión de PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `proyecto`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `antecedente_f`
--

CREATE TABLE `antecedente_f` (
  `antecedente_f_id` int(11) NOT NULL,
  `persona_id` int(11) NOT NULL,
  `patologicos` varchar(100) DEFAULT NULL,
  `quirurgicos` varchar(100) DEFAULT NULL,
  `psicopatologicos` varchar(100) DEFAULT NULL,
  `traumaticos` varchar(100) DEFAULT NULL,
  `consumo_sustancias` varchar(100) DEFAULT NULL,
  `otros` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `antecedente_f`
--

INSERT INTO `antecedente_f` (`antecedente_f_id`, `persona_id`, `patologicos`, `quirurgicos`, `psicopatologicos`, `traumaticos`, `consumo_sustancias`, `otros`) VALUES
(2, 15, 'Datos de prueba', 'Datos de prueba', 'Datos de prueba', 'Datos de prueba', 'Datos de prueba', 'Datos de prueba');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `antecedente_p`
--

CREATE TABLE `antecedente_p` (
  `antecedente_p_id` int(11) NOT NULL,
  `persona_id` int(11) NOT NULL,
  `patologicos` varchar(100) DEFAULT NULL,
  `quirurgicos` varchar(100) DEFAULT NULL,
  `psicopatologicos` varchar(100) DEFAULT NULL,
  `traumaticos` varchar(100) DEFAULT NULL,
  `consumo_sustancias` varchar(100) DEFAULT NULL,
  `otros` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `evolucion`
--

CREATE TABLE `evolucion` (
  `evolucion_id` int(11) NOT NULL,
  `persona_id` int(11) NOT NULL,
  `id_medico` int(11) NOT NULL,
  `id_practicante` int(11) NOT NULL,
  `evolucion` varchar(200) NOT NULL,
  `fecha_evolucion` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `evolucion`
--

INSERT INTO `evolucion` (`evolucion_id`, `persona_id`, `id_medico`, `id_practicante`, `evolucion`, `fecha_evolucion`) VALUES
(7, 15, 7, 2, 'no tuvo evolución en cuanto a las fobias sociales', '2023-11-14'),
(8, 15, 7, 2, 'Datos de prueba', '2023-11-16');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `medico`
--

CREATE TABLE `medico` (
  `id_medico` int(11) NOT NULL,
  `nombre_medico` varchar(30) NOT NULL,
  `telefono` int(12) NOT NULL,
  `email` varchar(100) NOT NULL,
  `tarjeta_profesional` int(7) NOT NULL,
  `persona_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `medico`
--

INSERT INTO `medico` (`id_medico`, `nombre_medico`, `telefono`, `email`, `tarjeta_profesional`, `persona_id`) VALUES
(7, 'Maria Chavez', 2147483647, 'chavez-m@gmail.com', 112233, 15),
(8, 'Libia Jordán', 0, 'lia@hotmail.com', 9999, 15);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `persona`
--

CREATE TABLE `persona` (
  `persona_id` int(11) NOT NULL,
  `nombre` varchar(70) NOT NULL,
  `fecha_nacimiento` date NOT NULL,
  `tipo_identificacion` int(11) NOT NULL,
  `numero_identificacion` int(20) NOT NULL,
  `ocupacion` varchar(30) DEFAULT NULL,
  `religion` varchar(30) DEFAULT NULL,
  `telefono` int(10) DEFAULT NULL,
  `email` varchar(30) DEFAULT NULL,
  `remitido_por` varchar(40) DEFAULT NULL,
  `motivo_consulta` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `persona`
--

INSERT INTO `persona` (`persona_id`, `nombre`, `fecha_nacimiento`, `tipo_identificacion`, `numero_identificacion`, `ocupacion`, `religion`, `telefono`, `email`, `remitido_por`, `motivo_consulta`) VALUES
(15, 'Exlendy Jordán', '2002-05-11', 2, 1193419260, 'Estudiante', 'Catolica', 2147483647, 'exlendyj@gmail.com', 'Bienestar universitario', 'Depresión y fobias sociales');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `practicantes`
--

CREATE TABLE `practicantes` (
  `id_practicante` int(11) NOT NULL,
  `nombre_practicante` varchar(100) NOT NULL,
  `telefono` int(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `id_medico` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `practicantes`
--

INSERT INTO `practicantes` (`id_practicante`, `nombre_practicante`, `telefono`, `email`, `id_medico`) VALUES
(2, 'Luisa Hernandez', 2147483647, 'hernandez.luisa@practicante.com', 7);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rol`
--

CREATE TABLE `rol` (
  `id` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `rol`
--

INSERT INTO `rol` (`id`, `nombre`) VALUES
(1, 'admin'),
(2, 'psicologo'),
(3, 'practicante');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sesiones`
--

CREATE TABLE `sesiones` (
  `id_sesion` int(11) NOT NULL,
  `fecha_sesion` date NOT NULL,
  `objetivos` varchar(800) NOT NULL,
  `estado_paciente` varchar(500) NOT NULL,
  `tareas` varchar(800) NOT NULL,
  `id_paciente` int(11) NOT NULL,
  `id_medico` int(11) NOT NULL,
  `id_practicante` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipos_identificacion`
--

CREATE TABLE `tipos_identificacion` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tipos_identificacion`
--

INSERT INTO `tipos_identificacion` (`id`, `nombre`) VALUES
(1, 'DNI'),
(2, 'Cedula'),
(3, 'Pasaporte'),
(4, 'Tarjeta de identidad'),
(5, 'Registro Civil');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `contrasena` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `id_rol` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombre`, `contrasena`, `email`, `id_rol`) VALUES
(10, 'Prueba', '$2y$10$DUmAQqVlVRPIBCfy5BEJxeGvUN2o8XVkP.nopxLdwPmjgOqHcIkoO', 'prueba@practicante.com', 3),
(11, 'Admin', '$2y$10$DRk8n5dtg5pQ5m.ZFXB2gudH.MF4AlKMa6gWiofpNpDQ5b2JJKy02', 'admin@admin.com', 1),
(12, 'Psicologo', '$2y$10$gKbPLGucLlm9sxrpK1UFAOiMnR.C0biPdmzwltSjbMmXtbhL8hFye', 'prueba@psicologo.com', 2);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `antecedente_f`
--
ALTER TABLE `antecedente_f`
  ADD PRIMARY KEY (`antecedente_f_id`,`persona_id`),
  ADD KEY `persona_id` (`persona_id`);

--
-- Indices de la tabla `antecedente_p`
--
ALTER TABLE `antecedente_p`
  ADD PRIMARY KEY (`antecedente_p_id`,`persona_id`),
  ADD KEY `persona_id` (`persona_id`);

--
-- Indices de la tabla `evolucion`
--
ALTER TABLE `evolucion`
  ADD PRIMARY KEY (`evolucion_id`,`persona_id`) USING BTREE,
  ADD KEY `persona_id` (`persona_id`),
  ADD KEY `id_medico` (`id_medico`),
  ADD KEY `id_practicante` (`id_practicante`);

--
-- Indices de la tabla `medico`
--
ALTER TABLE `medico`
  ADD PRIMARY KEY (`id_medico`) USING BTREE,
  ADD KEY `persona_id` (`persona_id`);

--
-- Indices de la tabla `persona`
--
ALTER TABLE `persona`
  ADD PRIMARY KEY (`persona_id`),
  ADD KEY `tipo_identificacion` (`tipo_identificacion`);

--
-- Indices de la tabla `practicantes`
--
ALTER TABLE `practicantes`
  ADD PRIMARY KEY (`id_practicante`),
  ADD KEY `id_medico` (`id_medico`);

--
-- Indices de la tabla `rol`
--
ALTER TABLE `rol`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `sesiones`
--
ALTER TABLE `sesiones`
  ADD PRIMARY KEY (`id_sesion`),
  ADD KEY `id_paciente` (`id_paciente`,`id_medico`,`id_practicante`),
  ADD KEY `id_medico` (`id_medico`),
  ADD KEY `id_practicante` (`id_practicante`);

--
-- Indices de la tabla `tipos_identificacion`
--
ALTER TABLE `tipos_identificacion`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD KEY `rol` (`id_rol`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `antecedente_f`
--
ALTER TABLE `antecedente_f`
  MODIFY `antecedente_f_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `antecedente_p`
--
ALTER TABLE `antecedente_p`
  MODIFY `antecedente_p_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `evolucion`
--
ALTER TABLE `evolucion`
  MODIFY `evolucion_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `medico`
--
ALTER TABLE `medico`
  MODIFY `id_medico` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `persona`
--
ALTER TABLE `persona`
  MODIFY `persona_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT de la tabla `practicantes`
--
ALTER TABLE `practicantes`
  MODIFY `id_practicante` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `rol`
--
ALTER TABLE `rol`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `sesiones`
--
ALTER TABLE `sesiones`
  MODIFY `id_sesion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `antecedente_f`
--
ALTER TABLE `antecedente_f`
  ADD CONSTRAINT `antecedente_f_ibfk_1` FOREIGN KEY (`persona_id`) REFERENCES `persona` (`persona_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `antecedente_p`
--
ALTER TABLE `antecedente_p`
  ADD CONSTRAINT `antecedente_p_ibfk_1` FOREIGN KEY (`persona_id`) REFERENCES `persona` (`persona_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `evolucion`
--
ALTER TABLE `evolucion`
  ADD CONSTRAINT `evolucion_ibfk_1` FOREIGN KEY (`persona_id`) REFERENCES `persona` (`persona_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `evolucion_ibfk_2` FOREIGN KEY (`id_medico`) REFERENCES `medico` (`id_medico`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `evolucion_ibfk_3` FOREIGN KEY (`id_practicante`) REFERENCES `practicantes` (`id_practicante`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `medico`
--
ALTER TABLE `medico`
  ADD CONSTRAINT `medico_ibfk_1` FOREIGN KEY (`persona_id`) REFERENCES `persona` (`persona_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `persona`
--
ALTER TABLE `persona`
  ADD CONSTRAINT `persona_ibfk_1` FOREIGN KEY (`tipo_identificacion`) REFERENCES `tipos_identificacion` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `practicantes`
--
ALTER TABLE `practicantes`
  ADD CONSTRAINT `practicantes_ibfk_1` FOREIGN KEY (`id_medico`) REFERENCES `medico` (`id_medico`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `sesiones`
--
ALTER TABLE `sesiones`
  ADD CONSTRAINT `sesiones_ibfk_1` FOREIGN KEY (`id_paciente`) REFERENCES `persona` (`persona_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `sesiones_ibfk_2` FOREIGN KEY (`id_medico`) REFERENCES `medico` (`id_medico`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `sesiones_ibfk_3` FOREIGN KEY (`id_practicante`) REFERENCES `practicantes` (`id_practicante`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `usuarios_ibfk_1` FOREIGN KEY (`id_rol`) REFERENCES `rol` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
