<?php
/**
 * @version     $id: driver.php
 * @package     Molajo
 * @subpackage  Layout Driver
 * @copyright   Copyright (C) 2011 Amy Stephen. All rights reserved.
 * @license     GNU General Public License Version 2, or later http://www.gnu.org/licenses/gpl.html
 */
defined('MOLAJO') or die;

/** custom css/js **/
$document =& JFactory::getDocument();
$document->addStyleSheet('../media/'.JRequest::getCmd('option').'/css/administrator.css');

/** component parameters **/
$this->params = JComponentHelper::getParams(JRequest::getVar('option'));

/** output **/
include $this->layoutHelper->getPath ('modal_item.php');
