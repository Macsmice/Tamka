DROP TABLE IF EXISTS `#__articles`;
DELETE FROM `#__assets` WHERE `name` LIKE 'com_articles%';
DELETE FROM `#__molajo_configuration` WHERE `component_option` = 'com_articles';
DELETE FROM `#__categories` WHERE `extension` = 'com_articleings';