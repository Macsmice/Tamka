DROP TABLE IF EXISTS `#__things`;
DELETE FROM `#__assets` WHERE `name` LIKE 'com_things%';
DELETE FROM `#__molajo_configuration` WHERE `component_option` = 'com_things';
DELETE FROM `#__categories` WHERE `extension` = 'com_things';