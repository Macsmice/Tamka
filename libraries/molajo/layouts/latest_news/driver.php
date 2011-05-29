<?php
/**
 * @version     $id: driver.php
 * @package     Molajo
 * @subpackage  Article Layout
 * @copyright   Copyright (C) 2011 Amy Stephen. All rights reserved.
 * @license     GNU General Public License Version 2, or later http://www.gnu.org/licenses/gpl.html
 */
defined('MOLAJO') or die;

/** custom css/js **/
$document =& JFactory::getDocument();
$document->addStyleSheet('../media/'.$this->options->get('component_option').'/css/administrator.css');

/** component parameters **/
$this->options = JComponentHelper::getParams($this->options->get('component_option'));

/** output **/
include $this->layoutHelper->getPath ('default.php');
