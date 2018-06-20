-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Creato il: Giu 19, 2018 alle 10:34
-- Versione del server: 5.7.21
-- Versione PHP: 7.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_blog_matteo`
--

-- --------------------------------------------------------

--
-- Struttura della tabella `articoli`
--

DROP TABLE IF EXISTS `articoli`;
CREATE TABLE IF NOT EXISTS `articoli` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `titolo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `contenuto` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `inserimento` datetime NOT NULL,
  `modifica` datetime NOT NULL,
  `utente` int(5) NOT NULL,
  `immagine` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=32 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dump dei dati per la tabella `articoli`
--

INSERT INTO `articoli` (`id`, `titolo`, `contenuto`, `inserimento`, `modifica`, `utente`, `immagine`) VALUES
(30, 'asdasdas', '<p>asdasdasdasd</p>', '2018-06-01 14:57:45', '2018-06-01 14:57:45', 4, 'upload/128.png'),
(31, 'qweqweqweqwe', 'qweqweqweqwe', '2018-06-13 08:27:11', '2018-06-13 08:27:11', 7, 'upload/128.png');

-- --------------------------------------------------------

--
-- Struttura della tabella `menu`
--

DROP TABLE IF EXISTS `menu`;
CREATE TABLE IF NOT EXISTS `menu` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `indice` int(5) DEFAULT NULL,
  `titolo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `link` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `visibile` tinyint(1) NOT NULL DEFAULT '0',
  `argomento` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `icona` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `parent` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dump dei dati per la tabella `menu`
--

INSERT INTO `menu` (`id`, `indice`, `titolo`, `link`, `visibile`, `argomento`, `icona`, `parent`) VALUES
(1, 0, 'Homepage', 'app/homepage/pagina.php', 1, 'index.php?app=home', '<i class=\"fa fa-fw fa-home\"></i>', NULL),
(2, 1, 'Gestione Articoli', 'app/gest_articoli/pagina.php', 1, 'index.php?app=gest_articoli', '<i class=\"fa fa-fw fa-home\"></i>', NULL),
(3, 0, 'Elenco Articoli', 'app/gest_articoli/pagina.php', 1, 'index.php?app=gest_articoli', '<i class=\"fa fa-newspaper-o\"></i>', 2),
(4, 1, 'Aggiungi nuovo articolo', 'app/gest_articoli/article/pagina.php', 1, 'index.php?app=article', '<i class=\"fa fa-plus\"></i>', 2),
(5, 2, 'Utenti', 'app/utenti/pagina.php', 1, 'index.php?app=utenti', '<i class=\"fa fa-user\"></i>', NULL),
(6, 0, 'Elenco Utenti', 'app/utenti/pagina.php', 1, 'index.php?app=utenti', '<i class=\"fa fa-user\"></i>', 5),
(7, 1, 'Aggiungi nuovo utente', 'app/utenti/utente/pagina.php', 1, 'index.php?app=utente', '<i class=\"fa fa-user-plus\"></i>', 5),
(8, 0, '404', 'app/404/pagina.php', 0, '404', '', NULL),
(9, 3, 'Gestione Pagine', 'app/gest_pagine/pagina.php', 1, 'index.php?app=gest_pagine', '<i class=\"fa fa-file\"></i>', NULL),
(10, 1, 'Elenco Pagine', 'app/gest_pagine/pagina.php', 1, 'index.php?app=gest_pagine', '<i class=\"fa fa-file\"></i>', 9);

-- --------------------------------------------------------

--
-- Struttura della tabella `utenti`
--

DROP TABLE IF EXISTS `utenti`;
CREATE TABLE IF NOT EXISTS `utenti` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ruolo` int(5) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dump dei dati per la tabella `utenti`
--

INSERT INTO `utenti` (`id`, `username`, `password`, `ruolo`) VALUES
(4, 'mzambon', '57d3defa08eec19b969ef2cb77e28df8', 0),
(7, 'teoz', '57d3defa08eec19b969ef2cb77e28df8', 1);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
