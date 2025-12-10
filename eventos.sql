-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 27-10-2025 a las 20:26:49
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
-- Base de datos: `digipass`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `eventos`
--

CREATE TABLE `eventos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `titulo` varchar(255) NOT NULL,
  `img` varchar(255) DEFAULT NULL,
  `descripcion` text DEFAULT NULL,
  `fecha` datetime NOT NULL,
  `direccion` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `eventos`
--

INSERT INTO `eventos` (`id`, `user_id`, `titulo`, `img`, `descripcion`, `fecha`, `direccion`, `created_at`, `updated_at`) VALUES
(1, 1, 'Concierto de Formosa', 'img/eventos/1761497663_rock-concert-free-psd-poster-template-81424.jpg', 'Prepárate para una noche inolvidable en el Concierto de Formosa, un evento que reunirá a artistas locales e invitados especiales en un escenario espectacular. La velada promete una experiencia musical única, con una mezcla de géneros que van desde el pop y rock hasta ritmos tradicionales de la región. Además de la música en vivo, habrá opciones gastronómicas, espacios para disfrutar con amigos y actividades interactivas para los asistentes. Este concierto es perfecto tanto para fanáticos de la música como para quienes buscan pasar un rato emocionante y lleno de energía. ¡No te lo pierdas!', '2025-10-07 15:05:00', 'Av. Colón 123', '2025-09-26 02:05:20', '2025-10-27 22:10:19'),
(2, 1, 'Boliche Perene', 'img/eventos/1761497674_music-concert-poster-template-design-5c50b8921755840f78fab781bd1b0095_screen.jpg', 'Boliche Perene te invita a vivir una noche llena de ritmo y diversión sin fin. Este evento combina lo mejor de la música electrónica y los hits más populares del momento, creando un ambiente ideal para bailar y socializar. Con luces, sonido de alta calidad y un espacio cuidadosamente ambientado, cada rincón está pensado para que vivas la experiencia al máximo. Además, el boliche ofrece áreas VIP, barras con tragos exclusivos y promociones especiales para grupos. Es el lugar perfecto para quienes buscan una salida nocturna distinta, cargada de energía y momentos inolvidables con amigos.', '2025-09-26 20:26:00', 'Barrio Juan Domingo', '2025-09-26 02:26:58', '2025-10-27 22:10:03'),
(3, 1, 'Panel del Rio', 'img/eventos/1761497685_canva-póster-para-eventos-musicales-minimalista-neón-QJ1M1WDSWu0.jpg', 'Panel del Río es un evento cultural que busca conectar a la comunidad con charlas, exposiciones y actividades interactivas a lo largo del río. Ideal para quienes disfrutan del conocimiento, la reflexión y el intercambio de ideas, este encuentro reúne expertos en diferentes áreas, talleres creativos y presentaciones artísticas. Los asistentes podrán disfrutar de un entorno natural privilegiado, con espacios para relajarse, compartir y aprender. Además, habrá puestos de comida y artesanías locales, creando un ambiente familiar y enriquecedor. Panel del Río es una oportunidad única para conocer gente, inspirarte y disfrutar de la cultura en un marco excepcional.', '2025-12-04 16:30:00', 'Av. Colón 123', '2025-10-26 19:26:50', '2025-10-27 22:11:27');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `eventos`
--
ALTER TABLE `eventos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `eventos_user_id_foreign` (`user_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `eventos`
--
ALTER TABLE `eventos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `eventos`
--
ALTER TABLE `eventos`
  ADD CONSTRAINT `eventos_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
