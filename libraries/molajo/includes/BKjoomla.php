<?php
/**
 * @version     $id: framework.php
 * @package     Molajo
 * @subpackage  Defines
 * @copyright   Copyright (C) 2011 Amy Stephen. All rights reserved.
 * @license     GNU General Public License Version 2, or later http://www.gnu.org/licenses/gpl.html
 */

/**
 * Amy
 * Category and Module doesn't work with the overrides - figure out why
 */
defined('MOLAJO') or die;

/** php overrides */
@ini_set('magic_quotes_runtime', 0);
@ini_set('zend.ze1_compatibility_mode', '0');

/** installation check */
if (!file_exists(JPATH_CONFIGURATION.'/configuration.php') || (filesize(JPATH_CONFIGURATION.'/configuration.php') < 10) || file_exists(JPATH_INSTALLATION.'/index.php')) {
    if (file_exists(JPATH_INSTALLATION.'/index.php')) {
        header('Location: '.substr($_SERVER['REQUEST_URI'],0,strpos($_SERVER['REQUEST_URI'],'index.php')).'installation/index.php');
        exit();
    } else {
        echo 'No configuration file found and no installation code available. Exiting...';
        exit();
    }
}

/** import - from JPATH_PLATFORM.'/joomla/import.php' */
if (!class_exists('JLoader')) {
	require_once JPATH_PLATFORM.'/loader.php';
}

JLoader::import('joomla.base.object');
JLoader::import('joomla.base.observable');
JLoader::import('joomla.environment.request');
if (!defined('_JREQUEST_NO_CLEAN')) {
	JRequest::clean();
}
JLoader::import('joomla.environment.response');
JLoader::import('joomla.factory');
$os = strtoupper(substr(PHP_OS, 0, 3));
if (!defined('IS_WIN')) {
	define('IS_WIN', ($os === 'WIN') ? true : false);
}
if (!defined('IS_MAC')) {
	define('IS_MAC', ($os === 'MAC') ? true : false);
}
if (!defined('IS_UNIX')) {
	define('IS_UNIX', (($os !== 'MAC') && ($os !== 'WIN')) ? true : false);
}
if (!class_exists('JVersion')) {
    require_once JPATH_PLATFORM.'/version.php';
}
JLoader::import('joomla.error.error');
JLoader::import('joomla.error.exception');
JLoader::import('joomla.utilities.arrayhelper');
JLoader::import('joomla.filter.filterinput');
JLoader::import('joomla.filter.filteroutput');
JLoader::register('JText', JPATH_PLATFORM.'/joomla/methods.php');
JLoader::register('JRoute', JPATH_PLATFORM.'/joomla/methods.php');

/** configuration */
require_once JPATH_CONFIGURATION.'/configuration.php';

$CONFIG = new JConfig();
if (@$CONFIG->error_reporting === 0) {
	error_reporting(0);
} else if (@$CONFIG->error_reporting > 0) {
	error_reporting($CONFIG->error_reporting);
	ini_set('display_errors', 1);
}
define('JDEBUG', $CONFIG->debug);
unset($CONFIG);
if (JDEBUG) {
	jimport('joomla.error.profiler');
	$_PROFILER = JProfiler::getInstance('Application');
}

/** joomla library: core and overrides */
jimport('joomla.application.menu');
jimport('overrides.user.user');
jimport('joomla.environment.uri');
jimport('joomla.html.html');
jimport('joomla.utilities.utility');
jimport('joomla.event.event');
jimport('joomla.event.dispatcher');
jimport('joomla.language.language');
jimport('joomla.utilities.string');

/** access */
jimport('overrides.access.access');

/** application */
jimport('overrides.application.component.controller');
jimport('overrides.application.component.view');
jimport('overrides.application.component.model');
jimport('overrides.application.component.helper');
jimport('overrides.application.module.helper');
jimport('overrides.application.helper');
jimport('overrides.application.categories');
jimport('overrides.application.router');

/** database */
jimport('overrides.database.table');
jimport('overrides.database.table.user');
jimport('overrides.database.table.usergroup');
jimport('overrides.database.table.viewlevel');

/** HTML */
jimport('overrides.html.pagination');
jimport('overrides.html.toolbar');
jimport('overrides.html.editor');

/** Form */
jimport('joomla.form.form');
jimport('joomla.form.formfield');
jimport('joomla.form.helper');
jimport('joomla.form.formrule');

/** Utilities */
jimport('joomla.utilities.arrayhelper');
jimport('joomla.registry.registry');

/** Files and Folders */
jimport('joomla.filesystem.file');
jimport('joomla.filesystem.folder');

/** Plugins */
jimport('joomla.plugin.plugin');
jimport('overrides.plugin.helper');

/** User */
jimport('overrides.user.helper');
/** toolbar */
if (MOLAJO_CLIENT == 'administrator') {
    require_once JPATH_BASE.'/includes/helper.php';
}
require_once OVERRIDES_LIBRARY.'/includes/toolbar.php';