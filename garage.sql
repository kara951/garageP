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