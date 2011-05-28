<?php
/**
 * @version     $id: driver.php
 * @package     Molajo
 * @subpackage  Item Layout
 * @copyright   Copyright (C) 2011 Amy Stephen. All rights reserved.
 * @license     GNU General Public License Version 2, or later http://www.gnu.org/licenses/gpl.html
 */
defined('MOLAJO') or die;

/** document **/
$document =& JFactory::getDocument();

/** standard site-wide layout css and js */
if (JFile::exists(JPATH_BASE.'/media/molajo/css/template.css')) {
    $document->addStyleSheet(JURI::base().'/media/molajo/css/template.css');
}
if ($document->direction == 'rtl') {
    if (JFile::exists(JPATH_BASE.'/media/molajo/css/template_rtl.css')) {
        $document->addStyleSheet(JURI::base().'/media/molajo/css/template_rtl.css');
    }
}
if (JFile::exists(JPATH_BASE.'/media/molajo/js/template.js')) {
    $document->addScript(JURI::base().'/media/molajo/js/template.js');
}

/** component specific css and js - media/com_componentname/css[js]/viewname.css[js] **/
if (JFile::exists(JPATH_BASE.'/media/'.JRequest::getCmd('option').'/css/'.JRequest::getCmd('view').'.css')) {
    $document->addStyleSheet(JURI::base().'media/'.JRequest::getCmd('option').'/css/'.JRequest::getCmd('view').'.css');
}
if (JFile::exists(JPATH_BASE.'/media/'.JRequest::getCmd('option').'/js/'.JRequest::getCmd('view').'.js')) {
    $document->addScript(JURI::base().'media/'.JRequest::getCmd('option').'/js/'.JRequest::getCmd('view').'.js');
}
/** layout header **/

/** table body row **/
foreach ($this->queryResults as $this->item) {
    $this->itemCount++;    
    if ($this->itemCount == 1) {
        include $this->layoutHelper->getPath ('defaults.php');
    }
    include $this->layoutHelper->getPath ('defaults.php');
}

/** layout footer **/

echo $this->queryResults->event->afterDisplayContent;