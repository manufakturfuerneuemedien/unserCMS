-- phpMyAdmin SQL Dump
-- version 4.0.2
-- http://www.phpmyadmin.net
--
-- Hoszt: localhost
-- Létrehozás ideje: 2018. Feb 09. 15:08
-- Szerver verzió: 5.6.14
-- PHP verzió: 5.5.38

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Adatbázis: `template`
--
CREATE DATABASE IF NOT EXISTS `template` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `template`;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `ci_sessions`
--

CREATE TABLE IF NOT EXISTS `ci_sessions` (
  `id` varchar(40) NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `timestamp` int(10) unsigned NOT NULL DEFAULT '0',
  `data` blob NOT NULL,
  PRIMARY KEY (`id`),
  KEY `ci_sessions_timestamp` (`timestamp`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `items`
--

CREATE TABLE IF NOT EXISTS `items` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `description` text,
  `img` varchar(255) DEFAULT NULL,
  `visible` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `module_headline`
--

CREATE TABLE IF NOT EXISTS `module_headline` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `parent` int(255) DEFAULT NULL,
  `item_id` int(255) DEFAULT NULL,
  `ordering` int(255) DEFAULT NULL,
  `content` text,
  `headline_type` varchar(255) NOT NULL,
  `section` varchar(255) DEFAULT NULL,
  `display_text` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `module_image`
--

CREATE TABLE IF NOT EXISTS `module_image` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `item_id` int(11) NOT NULL,
  `parent` int(11) NOT NULL,
  `filepath` varchar(255) NOT NULL,
  `ordering` int(11) NOT NULL,
  `stretch` int(11) NOT NULL DEFAULT '1',
  `align` varchar(10) NOT NULL DEFAULT 'left',
  `caption` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  KEY `item_id` (`item_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `module_pdf`
--

CREATE TABLE IF NOT EXISTS `module_pdf` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `parent` int(255) DEFAULT NULL,
  `item_id` int(255) DEFAULT NULL,
  `ordering` int(255) DEFAULT NULL,
  `fname` varchar(255) DEFAULT NULL,
  `align` varchar(255) NOT NULL DEFAULT 'left',
  `text` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `module_text`
--

CREATE TABLE IF NOT EXISTS `module_text` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `parent` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `ordering` int(11) NOT NULL DEFAULT '999',
  `content` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `item_id` (`item_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `module_video`
--

CREATE TABLE IF NOT EXISTS `module_video` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `item_id` int(11) NOT NULL,
  `order` int(11) NOT NULL,
  `code` varchar(30) NOT NULL,
  `start` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `item_id` (`item_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `client_id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL DEFAULT '',
  `pword` varchar(255) DEFAULT '$2a$08$u3pqXwqsNcOukI5Xaulzpu1HkX8lmjgaU/sQWwlVHZME59QpwXdh6',
  `is_admin` int(11) NOT NULL DEFAULT '0',
  `active_lang` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- A tábla adatainak kiíratása `user`
--

INSERT INTO `user` (`id`, `username`, `firstname`, `lastname`, `client_id`, `email`, `pword`, `is_admin`, `active_lang`) VALUES
(1, 'admin', 'admin', 'admin', 1, 'admin@admin.com', '$2a$08$u3pqXwqsNcOukI5Xaulzpu1HkX8lmjgaU/sQWwlVHZME59QpwXdh6', 1, 1);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
