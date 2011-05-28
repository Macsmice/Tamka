<?php
/**
 * @version     $id: component.php
 * @package     Molajo
 * @subpackage  MVC Abstraction
 * @copyright   Copyright (C) 2011 Individual Molajo Contributors. All rights reserved.
 * @license     GNU General Public License Version 2, or later http://www.gnu.org/licenses/gpl.html
 */
defined('MOLAJO') or die;

/** defines and includes  **/
require_once JPATH_COMPONENT.'/includes/include.php';

JLoader::register('ArticlesControllerArticle', JPATH_COMPONENT.'/controller.php');
JLoader::register('ArticlesControllerArticles', JPATH_COMPONENT.'/controller.php');
JLoader::register('ArticlesController', JPATH_COMPONENT.'/controller.php');

/** validate option **/
if (JRequest::getCmd('option') == $current_folder) {
} else {
    JError::raiseError(500, JText::_('MOLAJO_INVALID_OPTION'));
    return false;
}

/** validate request parameters **/
$results = MolajoValidateHelper::checkRequest();

/** establish controller **/
$defaultController = substr(JRequest::getCmd('option'), (strpos(JRequest::getCmd('option'), '_') + 1), strlen(JRequest::getCmd('option')) - strpos(JRequest::getCmd('option'), '_'));
$controller = JController::getInstance(ucfirst($defaultController));

/** initialise **/
$results = $controller->execute('initialise');

/** task **/
$controller->execute(JRequest::getCmd('task'));