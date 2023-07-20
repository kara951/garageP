--
-- Database: `garage`
--
CREATE DATABASE `garage` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;


--
-- Table structure for table `comments`
--
CREATE TABLE IF NOT EXISTS `comments` (
  `id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `author` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `created_at` datetime NOT NULL,
  `car_id` int(11) NOT NULL,
  KEY `FK_CAR` (`car_id`)
) ENGINE=INNODB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci COMMENT="Table comments";


--
-- Table structure for table `users`
--
CREATE TABLE IF NOT EXISTS `users`(
  `id` INT(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `email` VARCHAR (255) NOT NULL,
  `password` VARCHAR (255) NOT NULL,
  `first_name` VARCHAR (255) NOT NULL,
  `last_name` VARCHAR (255) NOT NULL,
  `role` VARCHAR (255) NOT NULL
) ENGINE=INNODB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci COMMENT="Table users";


--
-- Table structure for table `compte`
--
CREATE TABLE IF NOT EXISTS `comptes`(
  `id` INT(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `email` VARCHAR (255) NOT NULL,
  `password` VARCHAR (255) NOT NULL,
  `role` VARCHAR (255) NOT NULL,
  `user_id`INT(11),
  KEY `FK_USER` (`user_id`)
) ENGINE=INNODB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci COMMENT="Table comptes";


--
-- Table structure for table `admin`
--
CREATE TABLE IF NOT EXISTS `admin`(
  `id` INT(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `information` VARCHAR (255) NOT NULL,
  `user_id`INT(11),
  KEY `FK_USER` (`user_id`)
) ENGINE=INNODB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci COMMENT="Table admin";


--
-- Table structure for table `emplye`
--
CREATE TABLE IF NOT EXISTS `employe`(
  `id` INT(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `information` VARCHAR (255) NOT NULL,
  `user_id`INT(11),
  KEY `FK_USER` (`user_id`)
) ENGINE=INNODB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci COMMENT="Table employe";


--
-- Table structure for table `services`
--
CREATE TABLE IF NOT EXISTS `services`(
  `id` INT(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `title` VARCHAR (255) NOT NULL,
  `content` text,
  `image` VARCHAR (255) NOT NULL,
) ENGINE=INNODB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci COMMENT="Table services";


--
-- Table structure for table `categories`
--
CREATE TABLE IF NOT EXISTS `categories`(
  `id` INT(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `annee` VARCHAR (255) NOT NULL
) ENGINE=INNODB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci COMMENT="Table categories";


--
-- Table structure for table `car`
--
CREATE TABLE IF NOT EXISTS `car`(
  `id` INT(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `category_id` INT(11),
  `title` VARCHAR (255) NOT NULL,
  `content` text,
  `image` VARCHAR (255) NOT NULL,
  `modele` VARCHAR (255) NOT NULL,
  `annee` VARCHAR (255) NOT NULL,
  `kilometre` VARCHAR (255) NOT NULL,
  `vitesse` VARCHAR (255) NOT NULL,
  `color` VARCHAR (255) NOT NULL,
  `place` VARCHAR (255) NOT NULL,
  `porte` VARCHAR (255) NOT NULL,
  `puissance` VARCHAR (255) NOT NULL,
  `carburant` VARCHAR (255) NOT NULL,
  `prix` VARCHAR (255) NOT NULL
) ENGINE=INNODB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci COMMENT="Table car";


--
-- Table structure for table `horaire`
--
CREATE TABLE IF NOT EXISTS `horaires`(
  `id` INT(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `title` VARCHAR (255) NOT NULL,
  `opening_time` TIME,
  `closing_time` TIME
) ENGINE=INNODB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci COMMENT="Table horaire";


--
-- Table structure for table `clients`
--
CREATE TABLE IF NOT EXISTS `clients`(
  `id` INT(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `information` VARCHAR (255) NOT NULL
) ENGINE=INNODB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci COMMENT="Table clients";


--
-- Table structure for table `garage`
--
CREATE TABLE IF NOT EXISTS `garage`(
  `id` INT(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `name` VARCHAR (255) NOT NULL
) ENGINE=INNODB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci COMMENT="Table garage";