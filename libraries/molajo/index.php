<?php
/**
 * @version     $id: index.php
 * @package     Molajo Library
 * @subpackage  Index.php
 * @copyright   Copyright (C) 2011 Amy Stephen. All rights reserved.
 * @license     GNU General Public License Version 2, or later http://www.gnu.org/licenses/gpl.html
 */
defined('MOLAJO') or die;

/** defines */
require_once MOLAJO_LIBRARY.'/includes/defines.php';

/** load frameworks */
require_once MOLAJO_LIBRARY.'/includes/joomla.php';
require_once MOLAJO_LIBRARY.'/includes/molajo.php';
JDEBUG ? $_PROFILER->mark('afterLoad') : null;

/** application */
$app = JFactory::getApplication(MOLAJO_CLIENT);
$app->initialise(array(
	'language' => $app->getUserState('application.lang', 'lang')
));
JDEBUG ? $_PROFILER->mark('afterInitialise') : null;

/** route */
$app->route();
JDEBUG ? $_PROFILER->mark('afterRoute') : null;

/** dispatch */
$app->dispatch();
JDEBUG ? $_PROFILER->mark('afterDispatch') : null;

/** render */
$app->render();
JDEBUG ? $_PROFILER->mark('afterRender') : null;

/** complete */
echo $app;