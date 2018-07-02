DROP TRIGGER IF EXISTS `sportisimo`.`news_BEFORE_INSERT`;

DELIMITER $$
USE `sportisimo`$$
CREATE TRIGGER `sportisimo`.`news_BEFORE_INSERT` BEFORE INSERT ON `news` FOR EACH ROW
BEGIN
set new.date_added=now();
set new.last_updated=now();
END$$
DELIMITER ;


DROP TRIGGER IF EXISTS `sportisimo`.`news_BEFORE_UPDATE`;

DELIMITER $$
USE `sportisimo`$$
CREATE TRIGGER `sportisimo`.`news_BEFORE_UPDATE` BEFORE UPDATE ON `news` FOR EACH ROW
BEGIN
set new.last_updated=now();
END$$
DELIMITER ;
