-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3307
-- Tiempo de generación: 22-08-2024 a las 00:33:02
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
-- Base de datos: `sg_cine_2024`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `audios`
--

CREATE TABLE `audios` (
  `id` int(10) UNSIGNED NOT NULL,
  `nombre` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `audios`
--

INSERT INTO `audios` (`id`, `nombre`) VALUES
(2, 'Doblada'),
(1, 'Subtitulada');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `calificaciones`
--

CREATE TABLE `calificaciones` (
  `id` int(10) UNSIGNED NOT NULL,
  `nombre` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `calificaciones`
--

INSERT INTO `calificaciones` (`id`, `nombre`) VALUES
(1, 'G – General Audiences'),
(2, 'PG – Parental Guidance Suggested'),
(3, 'PG-13 – Parents Strongly Cautioned'),
(4, 'R – Restricted'),
(5, 'NC-17 – Adults Only');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comentarios`
--

CREATE TABLE `comentarios` (
  `id` int(10) UNSIGNED NOT NULL,
  `usuarioId` int(10) UNSIGNED NOT NULL,
  `peliculaId` int(10) UNSIGNED NOT NULL,
  `comentario` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `entradas`
--

CREATE TABLE `entradas` (
  `id` int(10) UNSIGNED NOT NULL,
  `horarioFuncion` datetime NOT NULL,
  `horarioVenta` datetime NOT NULL,
  `precio` double NOT NULL,
  `numeroTicket` int(11) NOT NULL,
  `estado` tinyint(1) NOT NULL,
  `funcionId` int(10) UNSIGNED NOT NULL,
  `usuarioId` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `funciones`
--

CREATE TABLE `funciones` (
  `id` int(10) UNSIGNED NOT NULL,
  `fecha` date NOT NULL,
  `horaInicio` time NOT NULL,
  `duracion` int(11) NOT NULL,
  `numeroFuncion` int(11) NOT NULL,
  `peliculaId` int(10) UNSIGNED NOT NULL,
  `salaId` int(10) UNSIGNED NOT NULL,
  `programacionId` int(10) UNSIGNED NOT NULL,
  `precio` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `funciones`
--

INSERT INTO `funciones` (`id`, `fecha`, `horaInicio`, `duracion`, `numeroFuncion`, `peliculaId`, `salaId`, `programacionId`, `precio`) VALUES
(4, '2024-08-22', '00:21:00', 300, 200, 1, 14, 12, 2000),
(6, '2024-08-07', '00:19:00', 300, 2000, 2, 8, 6, 100);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `generos`
--

CREATE TABLE `generos` (
  `id` int(10) UNSIGNED NOT NULL,
  `nombre` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `generos`
--

INSERT INTO `generos` (`id`, `nombre`) VALUES
(1, 'Acción'),
(2, 'Aventura'),
(3, 'Terror'),
(4, 'Suspenso'),
(5, 'Drama'),
(6, 'Comedia'),
(7, 'Romance'),
(8, 'Documental');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `idiomas`
--

CREATE TABLE `idiomas` (
  `id` int(10) UNSIGNED NOT NULL,
  `nombre` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `idiomas`
--

INSERT INTO `idiomas` (`id`, `nombre`) VALUES
(1, 'Inglés'),
(2, 'Francés'),
(3, 'Español');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `imagenes`
--

CREATE TABLE `imagenes` (
  `id` int(10) UNSIGNED NOT NULL,
  `peliculaId` int(10) UNSIGNED NOT NULL,
  `imagen` blob NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `paises`
--

CREATE TABLE `paises` (
  `id` int(10) UNSIGNED NOT NULL,
  `nombre` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `paises`
--

INSERT INTO `paises` (`id`, `nombre`) VALUES
(1, 'Argentina'),
(2, 'Estados Unidos'),
(3, 'España'),
(4, 'Francia'),
(5, 'Inglaterra'),
(6, 'Canadá'),
(7, 'China'),
(8, 'Corea del Sur');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `peliculas`
--

CREATE TABLE `peliculas` (
  `id` int(10) UNSIGNED NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `tituloOriginal` varchar(255) NOT NULL,
  `duracion` int(11) NOT NULL,
  `anoEstreno` int(11) NOT NULL,
  `disponibilidad` tinyint(1) NOT NULL,
  `fechaIngreso` date NOT NULL,
  `sitioWebOficial` varchar(255) NOT NULL,
  `sinopsis` varchar(255) NOT NULL,
  `actores` varchar(255) NOT NULL,
  `generoId` int(10) UNSIGNED NOT NULL,
  `paisId` int(10) UNSIGNED NOT NULL,
  `idiomaId` int(10) UNSIGNED NOT NULL,
  `calificacionId` int(10) UNSIGNED NOT NULL,
  `tipoId` int(10) UNSIGNED NOT NULL,
  `audioId` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `peliculas`
--

INSERT INTO `peliculas` (`id`, `nombre`, `tituloOriginal`, `duracion`, `anoEstreno`, `disponibilidad`, `fechaIngreso`, `sitioWebOficial`, `sinopsis`, `actores`, `generoId`, `paisId`, `idiomaId`, `calificacionId`, `tipoId`, `audioId`) VALUES
(1, 'La travesía en el Desierto', 'La travesía en el Desierto 1', 300, 2024, 0, '2024-08-03', 'dasdsadas', 'dasdsadasd', 'asdasdadsa', 1, 6, 2, 5, 3, 2),
(2, 'Las Locuras de Mbappé', 'Las Locuras de Mbappé la venganza', 200, 2024, 0, '2024-08-20', 'https://mbappe.com', 'La película trata sobre las avneturas de Kilyan Mbappé', 'Juan Castro Kiki carlitos', 2, 5, 1, 5, 2, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `perfiles`
--

CREATE TABLE `perfiles` (
  `id` int(10) UNSIGNED NOT NULL,
  `nombre` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `perfiles`
--

INSERT INTO `perfiles` (`id`, `nombre`) VALUES
(2, 'Externos'),
(3, 'Operador'),
(4, 'Administrador');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `programaciones`
--

CREATE TABLE `programaciones` (
  `id` int(10) UNSIGNED NOT NULL,
  `fechaInicio` date NOT NULL,
  `fechaFin` date NOT NULL,
  `vigente` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `programaciones`
--

INSERT INTO `programaciones` (`id`, `fechaInicio`, `fechaFin`, `vigente`) VALUES
(2, '2024-08-09', '2024-08-23', 1),
(3, '2024-08-03', '2024-08-24', 0),
(6, '2024-08-02', '2024-08-30', 0),
(11, '2024-08-17', '2024-08-28', 0),
(12, '2024-08-08', '2024-08-29', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `salas`
--

CREATE TABLE `salas` (
  `id` int(10) UNSIGNED NOT NULL,
  `capacidad` int(11) NOT NULL,
  `estado` tinyint(1) NOT NULL,
  `numeroSala` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `salas`
--

INSERT INTO `salas` (`id`, `capacidad`, `estado`, `numeroSala`) VALUES
(6, 50, 1, 200),
(8, 210, 1, 1001),
(13, 100, 0, 20000),
(14, 100, 0, 10055);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipos`
--

CREATE TABLE `tipos` (
  `id` int(10) UNSIGNED NOT NULL,
  `nombre` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `tipos`
--

INSERT INTO `tipos` (`id`, `nombre`) VALUES
(3, '2D'),
(2, '3D');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(10) UNSIGNED NOT NULL,
  `cuenta` varchar(255) NOT NULL,
  `nombres` varchar(255) NOT NULL,
  `clave` varchar(255) NOT NULL,
  `correo` varchar(255) NOT NULL,
  `perfilId` int(10) UNSIGNED NOT NULL,
  `apellido` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `cuenta`, `nombres`, `clave`, `correo`, `perfilId`, `apellido`) VALUES
(3, 'Joel2004', 'joeles', '$2y$10$WZ0/zfWIisJdxMaPj4ss8ex.IJ6y8XCfakmDurj/rAIDyfI3orci2', 'Joel2004@gmail.com.ar', 3, 'mercadoses'),
(4, 'JuanLocuras', 'Junatio', '$2y$10$A/RV5NfTWuCSkbzCkDrqceK86y3UPl20r18We9eHrdvQUN/c7hZSe', 'Joe@gmail.com', 2, 'Perecho'),
(5, 'Jorgito2002', 'Jorgito', '$2y$10$Hqf7AG20Yj5DVUG0N5BdC.raUgQ.5cZdwR9GavyEiiicdGw8nls62', 'joel@gmail.com.ar', 2, 'Mercados'),
(8, 'Javo1001', 'Marcos', '$2y$10$mCeNsmdvIpogK1ITEIJ/YegV0/6qU.QPi6as1LXmQV5ym0cKz8Egm', 'joesl@gmail.com.ar', 3, 'Messi');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `audios`
--
ALTER TABLE `audios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nombre_UNIQUE` (`nombre`);

--
-- Indices de la tabla `calificaciones`
--
ALTER TABLE `calificaciones`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `comentarios`
--
ALTER TABLE `comentarios`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_comentario_peliculaId_idx` (`peliculaId`),
  ADD KEY `fk_comentario_usuarioId_idx` (`usuarioId`);

--
-- Indices de la tabla `entradas`
--
ALTER TABLE `entradas`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `numero_ticket_UNIQUE` (`numeroTicket`),
  ADD KEY `fk_entrada_funcionId_idx` (`funcionId`),
  ADD KEY `fk_entrada_usuarioId_idx` (`usuarioId`);

--
-- Indices de la tabla `funciones`
--
ALTER TABLE `funciones`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `numero_funcion_UNIQUE` (`numeroFuncion`),
  ADD KEY `fk_funcion_programacionId_idx` (`programacionId`),
  ADD KEY `fk_funcion_peliculaId_idx` (`peliculaId`),
  ADD KEY `fk_funcion_salaId_idx` (`salaId`);

--
-- Indices de la tabla `generos`
--
ALTER TABLE `generos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `idiomas`
--
ALTER TABLE `idiomas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `imagenes`
--
ALTER TABLE `imagenes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_imagen_peliculaId_idx` (`peliculaId`);

--
-- Indices de la tabla `paises`
--
ALTER TABLE `paises`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `peliculas`
--
ALTER TABLE `peliculas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_pelicula_generoId_idx` (`generoId`),
  ADD KEY `fk_pelicula_paisId_idx` (`paisId`),
  ADD KEY `fk_pelicula_idiomaId_idx` (`idiomaId`),
  ADD KEY `fk_pelicula_calificacionId_idx` (`calificacionId`),
  ADD KEY `fk_pelicula_tipoId_idx` (`tipoId`),
  ADD KEY `fk_pelicula_audioId_idx` (`audioId`);

--
-- Indices de la tabla `perfiles`
--
ALTER TABLE `perfiles`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `programaciones`
--
ALTER TABLE `programaciones`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `fecha_inicio_UNIQUE` (`fechaInicio`),
  ADD UNIQUE KEY `fecha_fin_UNIQUE` (`fechaFin`);

--
-- Indices de la tabla `salas`
--
ALTER TABLE `salas`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `numero_sala_UNIQUE` (`numeroSala`);

--
-- Indices de la tabla `tipos`
--
ALTER TABLE `tipos`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nombre_UNIQUE` (`nombre`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `cuenta_UNIQUE` (`cuenta`),
  ADD UNIQUE KEY `correo_UNIQUE` (`correo`),
  ADD KEY `fk_usuario_perfilId_idx` (`perfilId`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `audios`
--
ALTER TABLE `audios`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `calificaciones`
--
ALTER TABLE `calificaciones`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `comentarios`
--
ALTER TABLE `comentarios`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `entradas`
--
ALTER TABLE `entradas`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `funciones`
--
ALTER TABLE `funciones`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `generos`
--
ALTER TABLE `generos`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `idiomas`
--
ALTER TABLE `idiomas`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `paises`
--
ALTER TABLE `paises`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `peliculas`
--
ALTER TABLE `peliculas`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `perfiles`
--
ALTER TABLE `perfiles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `programaciones`
--
ALTER TABLE `programaciones`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de la tabla `salas`
--
ALTER TABLE `salas`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de la tabla `tipos`
--
ALTER TABLE `tipos`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `comentarios`
--
ALTER TABLE `comentarios`
  ADD CONSTRAINT `fk_comentario_peliculaId` FOREIGN KEY (`peliculaId`) REFERENCES `peliculas` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_comentario_usuarioId` FOREIGN KEY (`usuarioId`) REFERENCES `usuarios` (`id`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `entradas`
--
ALTER TABLE `entradas`
  ADD CONSTRAINT `fk_entrada_funcionId` FOREIGN KEY (`funcionId`) REFERENCES `funciones` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_entrada_usuarioId` FOREIGN KEY (`usuarioId`) REFERENCES `usuarios` (`id`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `funciones`
--
ALTER TABLE `funciones`
  ADD CONSTRAINT `fk_funcion_peliculaId` FOREIGN KEY (`peliculaId`) REFERENCES `peliculas` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_funcion_programacionId` FOREIGN KEY (`programacionId`) REFERENCES `programaciones` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_funcion_salaId` FOREIGN KEY (`salaId`) REFERENCES `salas` (`id`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `imagenes`
--
ALTER TABLE `imagenes`
  ADD CONSTRAINT `fk_imagen_peliculaId` FOREIGN KEY (`peliculaId`) REFERENCES `peliculas` (`id`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `peliculas`
--
ALTER TABLE `peliculas`
  ADD CONSTRAINT `fk_pelicula_audioId` FOREIGN KEY (`audioId`) REFERENCES `audios` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_pelicula_calificacionId` FOREIGN KEY (`calificacionId`) REFERENCES `calificaciones` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_pelicula_generoId` FOREIGN KEY (`generoId`) REFERENCES `generos` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_pelicula_idiomaId` FOREIGN KEY (`idiomaId`) REFERENCES `idiomas` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_pelicula_paisId` FOREIGN KEY (`paisId`) REFERENCES `paises` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_pelicula_tipoId` FOREIGN KEY (`tipoId`) REFERENCES `tipos` (`id`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `fk_usuario_perfilId` FOREIGN KEY (`perfilId`) REFERENCES `perfiles` (`id`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
