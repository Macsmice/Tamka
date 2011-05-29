<?php
/**
 * @version     $id: standard.php
 * @package     Molajo
 * @subpackage  Standard Include Code
 * @copyright   Copyright (C) 2011 Amy Stephen. All rights reserved.
 * @license     GNU General Public License Version 2, or later http://www.gnu.org/licenses/gpl.html
 */
defined('MOLAJO') or die;

/** document **/
$document =& JFactory::getDocument();

/** standard site-wide layout css and js */
if (JFile::exists(JPATH_BASE.'/media/css/template.css')) {
    $document->addStyleSheet(JURI::base().'/media/css/template.css');
}
if ($document->direction == 'rtl') {
    if (JFile::exists(JPATH_BASE.'/media/css/template_rtl.css')) {
        $document->addStyleSheet(JURI::base().'/media/css/template_rtl.css');
    }
}
if (JFile::exists(JPATH_BASE.'/media/js/template.js')) {
    $document->addScript(JURI::base().'/media/js/template.js');
}

/** component specific css and js - media/com_componentname/css[js]/viewname.css[js] **/
if (JFile::exists(JPATH_BASE.'/media/'.$this->options->get('component_option').'/css/'.$this->options->get('component_view').'.css')) {
    $document->addStyleSheet(JURI::base().'media/'.$this->options->get('component_option').'/css/'.$this->options->get('component_view').'.css');
}
if (JFile::exists(JPATH_BASE.'/media/'.$this->options->get('component_option').'/js/'.$this->options->get('component_view').'.js')) {
    $document->addScript(JURI::base().'media/'.$this->options->get('component_option').'/js/'.$this->options->get('component_view').'.js');
}