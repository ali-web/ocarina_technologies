-- MySQL dump 10.13  Distrib 5.5.43, for debian-linux-gnu (x86_64)
--
-- Host: 0.0.0.0    Database: c9
-- ------------------------------------------------------
-- Server version	5.5.43-0ubuntu0.14.04.1

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Current Database: `c9`
--

CREATE DATABASE /*!32312 IF NOT EXISTS*/ `c9` /*!40100 DEFAULT CHARACTER SET utf8 */;

USE `c9`;

--
-- Table structure for table `story`
--

DROP TABLE IF EXISTS `story`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `story` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `uri` varchar(40) NOT NULL DEFAULT '',
  `title` varchar(255) NOT NULL,
  `body` text NOT NULL,
  `started_at` datetime NOT NULL,
  `ended_at` datetime DEFAULT NULL,
  `max_turns` int(11) NOT NULL,
  `current_turn` int(11) NOT NULL DEFAULT '0',
  `time_limit` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `story_user`
--

DROP TABLE IF EXISTS `story_user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `story_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `FK_user_id` int(11) unsigned NOT NULL,
  `FK_story_id` int(11) unsigned NOT NULL,
  `turn_order` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_user_id` (`FK_user_id`),
  KEY `FK_story_id` (`FK_story_id`),
  CONSTRAINT `story_user_ibfk_1` FOREIGN KEY (`FK_user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `story_user_ibfk_2` FOREIGN KEY (`FK_story_id`) REFERENCES `story` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `turn`
--

DROP TABLE IF EXISTS `turn`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `turn` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `FK_story_id` int(10) unsigned NOT NULL,
  `FK_user_id` int(10) unsigned NOT NULL,
  `timestamp` datetime NOT NULL,
  `words` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=47 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `fb_id` varchar(20) NOT NULL COMMENT 'facebook currently stores these as a 64bit unsigned int',
  `access_token` varchar(255) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `fb_id` (`fb_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping routines for database 'c9'
--
/*!50003 DROP PROCEDURE IF EXISTS `MOVESTORIESFORWARD` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = '' */ ;
DELIMITER ;;
CREATE DEFINER=`someone9999`@`%` PROCEDURE `MOVESTORIESFORWARD`()
    NO SQL
BEGIN

DECLARE now DATETIME;
DECLARE done INT;

DECLARE v_id INT;
DECLARE v_turns_over INT;
DECLARE v_current_turn INT;
DECLARE v_max_turns INT;

DECLARE skip_turns INT;
DECLARE should_end INT;

DECLARE end_date DATETIME;

DECLARE cur CURSOR FOR 
 SELECT
        t.`id`,
        FLOOR(TIMESTAMPDIFF(SECOND, turn_start, NOW()) / t.`time_limit`) AS turns_over,
        t.`current_turn` AS current_turn,
        t.`max_turns` AS max_turns
    FROM
        (SELECT 
            `story`.`id` AS id,
            (CASE
                WHEN `story`.`current_turn` > 0 THEN
                    (SELECT MAX(`turn`.`timestamp`) FROM `turn` WHERE `turn`.`FK_story_id` = `story`.`id`)
                ELSE
                    `story`.`started_at`
            END) AS turn_start,
            `story`.`time_limit` as time_limit,
            `story`.`current_turn` as current_turn,
            `story`.`max_turns` as max_turns
        FROM 
            `story`) AS t
    WHERE
        TIMESTAMPDIFF(SECOND, turn_start, NOW()) >= t.`time_limit`;
DECLARE CONTINUE HANDLER FOR NOT FOUND SET done = 1;
OPEN cur;

SET done = 0;

WHILE done = 0 DO
	FETCH cur INTO v_id, v_turns_over, v_current_turn, v_max_turns;
	IF done = 0 THEN
		SET skip_turns = LEAST(v_max_turns, v_current_turn + v_turns_over) - v_current_turn;
		SET v_current_turn = v_current_turn + skip_turns;
		SET end_date = NULL;
		IF v_current_turn = v_max_turns THEN
			SET end_date = NOW();
		END IF;
		WHILE skip_turns > 0 DO
			SET skip_turns = skip_turns - 1;
			INSERT INTO `turn` (`words`, `FK_story_id`, `FK_user_id`, `timestamp`) VALUES ('', v_id, 0, NOW());
		END WHILE;

		UPDATE `story` SET `story`.`ended_at` = end_date, `story`.`current_turn` = v_current_turn WHERE `story`.`id` = v_id;
		
	END IF;
END WHILE;

END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2015-11-24  7:37:34
