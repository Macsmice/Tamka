<?php
/**
 * @version     $id: driver.php
 * @package     Molajo
 * @subpackage  Item View
 * @copyright   Copyright (C) 2011 Amy Stephen. All rights reserved.
 * @license     GNU General Public License Version 2, or later http://www.gnu.org/licenses/gpl.html
 */
defined('MOLAJO') or die;

/** component parameters **/
$this->params = JComponentHelper::getParams(JRequest::getVar('option'));

/** document **/
$document =& JFactory::getDocument();

/** standard layout css and js */
$document->addStyleSheet(JURI::base().'media/molajo/css/template.css');
if ($document->direction == 'rtl') {
    $document->addStyleSheet(JURI::base().'media/molajo/css/template_rtl.css');
}

/** component css and js - media/com_componentname/css[js]/viewname.css[js] **/
if (JFile::exists(JPATH_BASE.'/media/'.JRequest::getCmd('option').'/css/'.JRequest::getCmd('view').'.css')) {
    $document->addStyleSheet(JURI::base().'media/'.JRequest::getCmd('option').'/css/'.JRequest::getCmd('view').'.css');
}
if (JFile::exists(JPATH_BASE.'/media/'.JRequest::getCmd('option').'/js/'.JRequest::getCmd('view').'.js')) {
    $document->addScript(JURI::base().'media/'.JRequest::getCmd('option').'/js/'.JRequest::getCmd('view').'.js');
}

/** output **/
include $this->layoutHelper->getPath ('item.php');
