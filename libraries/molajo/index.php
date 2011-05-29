<?php
/**
 * @version     $id: index.php
 * @package     Molajo Library
 * @subpackage  Index.php
 * @copyright   Copyright (C) 2011 Amy Stephen. All rights reserved.
 * @license     GNU General Public License Version 2, or later http://www.gnu.org/licenses/gpl.html
 */
defined('MOLAJO') or die;

/** php version check */
if (version_compare(PHP_VERSION, '5.3', '<')) {
	die('Your host needs to use PHP 5.3 or higher to run Molajo.');
}

/** defines */
require_once MOLAJO_LIBRARY.'/includes/defines.php';

/** load frameworks */
require_once MOLAJO_LIBRARY.'/includes/joomla.php';
require_once MOLAJO_LIBRARY.'/includes/molajo.php';
require_once MOLAJO_LIBRARY.'/includes/other.php';
JDEBUG ? $_PROFILER->mark('afterLoad') : null;

/** initialize */
$app = JFactory::getApplication(MOLAJO_APPLICATION);

if (MOLAJO_APPLICATION == 'administrator') {
    $app->initialise(array(
        'language' => $app->getUserState('application.lang', 'lang')
    ));
} else {
    $app->initialise();
}
JDEBUG ? $_PROFILER->mark('afterInitialise') : null;

/** route application */
if (MOLAJO_APPLICATION == 'installation') {
} else {
    $app->route();
    JDEBUG ? $_PROFILER->mark('afterRoute') : null;
}

/** dispatch application */
if (MOLAJO_APPLICATION == 'installation') {
} else {
    $app->dispatch();
    JDEBUG ? $_PROFILER->mark('afterDispatch') : null;
}

/** render application */
$app->render();
JDEBUG ? $_PROFILER->mark('afterRender') : null;

/** complete */
echo $app;
