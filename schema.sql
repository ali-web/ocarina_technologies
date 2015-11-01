# Dump of table story
# ------------------------------------------------------------

DROP TABLE IF EXISTS `story`;

CREATE TABLE `story` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `uri` varchar(40) NOT NULL DEFAULT '',
  `title` varchar(255) NOT NULL,
  `body` text NOT NULL,
  `started_at` datetime NOT NULL,
  `ended_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

LOCK TABLES `story` WRITE;
/*!40000 ALTER TABLE `story` DISABLE KEYS */;

INSERT INTO `story` (`id`, `uri`, `title`, `body`, `started_at`, `ended_at`)
VALUES
	(1,'asdfghjkl','The pumpkin smasher','Hi. I am a pumpkin smasher!! Come on the coward pumpkin!','2015-10-31 12:49:53',NULL),
	(3,'tfb99c76722c51e747ec32c429940e52','The potato eater','Once upon a time, somebody went to potato store to','2015-10-31 12:49:53',NULL),
	(7,'e6cd68df65206adad499b459437d30dd','The car salad maker',' Dirin Dirin','2015-10-31 12:49:53',NULL);

/*!40000 ALTER TABLE `story` ENABLE KEYS */;
UNLOCK TABLES;



/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
