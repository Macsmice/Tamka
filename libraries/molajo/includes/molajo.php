<?php
/**
 * @version     $id: include.php
 * @package     Molajo
 * @subpackage  Defines
 * @copyright   Copyright (C) 2011 Amy Stephen. All rights reserved.
 * @license     GNU General Public License Version 2, or later http://www.gnu.org/licenses/gpl.html
 */
defined('MOLAJO') or die;

/** file helper */
if (class_exists('MolajoFileHelper')) {
} else {
    if (file_exists(MOLAJO_LIBRARY.'/helpers/file.php')) {
        JLoader::register('MolajoFileHelper', MOLAJO_LIBRARY.'/helpers/file.php');
    } else {
        JError::raiseNotice(500, JText::_('MOLAJO_OVERRIDE_CREATE_MISSING_CLASS_FILE'.' '.'MolajoFileHelper'));
        return;
    }
}
$filehelper = new MolajoFileHelper();

/** ACL */
$files = JFolder::files(MOLAJO_LIBRARY.'/acl', '\.php$', false, false);
foreach ($files as $file) {
    if ($file == 'acl.php') {
        $filehelper->requireClassFile(MOLAJO_LIBRARY.'/acl/acl.php', 'ACL');
    } else {
        $filehelper->requireClassFile(MOLAJO_LIBRARY.'/acl/'.$file, ucfirst(substr($file, 0, strpos($file, '.'))).'ACL');
    }
}

/** Controller */
$files = JFolder::files(MOLAJO_LIBRARY.'/controllers', '\.php$', false, false);
foreach ($files as $file) {
    if ($file == 'controller.php') {
        $filehelper->requireClassFile(MOLAJO_LIBRARY.'/controllers/controller.php', 'MolajoController');
    } else {
        $filehelper->requireClassFile(MOLAJO_LIBRARY.'/controllers/'.$file, 'MolajoController'.ucfirst(substr($file, 0, strpos($file, '.'))));
    }
}

/** Fields */
$files = JFolder::files(MOLAJO_LIBRARY.'/fields', '\.php$', false, false);
foreach ($files as $file) {
    if ($file == 'field.php') {
        $filehelper->requireClassFile(MOLAJO_LIBRARY.'/fields/field.php', 'MolajoField');
    } else {
        $filehelper->requireClassFile(MOLAJO_LIBRARY.'/fields/'.$file, 'MolajoField'.ucfirst(substr($file, 0, strpos($file, '.'))));
    }
}

/** Helpers */
$files = JFolder::files(MOLAJO_LIBRARY.'/helpers', '\.php$', false, false);
foreach ($files as $file) {
    $filehelper->requireClassFile(MOLAJO_LIBRARY.'/helpers/'.$file, 'Molajo'.ucfirst(substr($file, 0, strpos($file, '.'))).'Helper');
}

/** Models */
$files = JFolder::files(MOLAJO_LIBRARY.'/models', '\.php$', false, false);
foreach ($files as $file) {
    $filehelper->requireClassFile(MOLAJO_LIBRARY.'/models/'.$file, 'MolajoModel'.ucfirst(substr($file, 0, strpos($file, '.'))));
}
/** Model-Elements */
$files = JFolder::files(MOLAJO_LIBRARY.'/models/elements', '\.php$', false, false);
foreach ($files as $file) {
    $filehelper->requireClassFile(MOLAJO_LIBRARY.'/models/elements/'.$file, 'MolajoElement'.ucfirst(substr($file, 0, strpos($file, '.'))));
}

/** Route */
require_once MOLAJO_LIBRARY.'/route/build.php';
require_once MOLAJO_LIBRARY.'/route/parse.php';

/** Tables */
$files = JFolder::files(MOLAJO_LIBRARY.'/tables', '\.php$', false, false);
foreach ($files as $file) {
    if ($file == 'table.php') {
        $filehelper->requireClassFile(MOLAJO_LIBRARY.'/tables/table.php', 'MolajoTable');
    } else {
        $filehelper->requireClassFile(MOLAJO_LIBRARY.'/tables/'.$file, 'MolajoTable'.ucfirst(substr($file, 0, strpos($file, '.'))));
    }
}

/** Views */
$files = JFolder::files(MOLAJO_LIBRARY.'/views', '\.php$', false, false);
$format = JRequest::getCmd('format', 'html');
if ($format == 'html' || $format == 'feed' || $format == 'raw') {
} else {
    $format == 'raw';
}
foreach ($files as $file) {
    if (strpos($file, $format)) {
        $filehelper->requireClassFile(MOLAJO_LIBRARY.'/views/'.$file, 'MolajoView'.ucfirst(substr($file, 0, strpos($file, '.'))));
    }
}