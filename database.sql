/*
    __________________________________________________________________________
   |                                                                          |
   |                     MY WHEATHER STATION - DATABASE                         |
   |                                                                          |
   |    Author            :   M. JALES, P. GARREAU                            |
   |    Status            :   Under Development                               |
   |    Last Modification :   16/09/2022                                      |
   |    Project           :   EMBEDDED LINUX PROJECT                          |
   |                                                                          |
   |__________________________________________________________________________|
   
*/

/* ----------------------------------------------------------------------------
                                     INIT
---------------------------------------------------------------------------- */

DROP TABLE IF EXISTS `data`;
CREATE TABLE `data` (
  `id` INT(10) unsigned PRIMARY KEY NOT NULL AUTO_INCREMENT,
  `time` DATETIME NOT NULL,
  `temperature` DOUBLE(2,2) NOT NULL,
  `humidity` DOUBLE(2,2) NOT NULL,
  `pressure` DOUBLE(2,2) NOT NULL
);

LOCK TABLES `data` WRITE;
ALTER TABLE `data` DISABLE KEYS;
INSERT INTO `data` VALUES ;
ALTER TABLE `data` ENABLE KEYS;
UNLOCK TABLES;