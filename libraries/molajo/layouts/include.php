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

/** standard site-wide css and js - media/site/css[js]/viewname.css[js] **/
if (JFile::exists(JPATH_BASE.'/media/site/css/site.css')) {
    $document->addStyleSheet(JURI::base().'/site/css/site.css');
}
if ($document->direction == 'rtl') {
    if (JFile::exists(JPATH_BASE.'/media/site/css/site_rtl.css')) {
        $document->addStyleSheet(JURI::base().'/media/site/css/site_rtl.css');
    }
}
if (JFile::exists(JPATH_BASE.'/media/site/js/site.js')) {
    $document->addScript(JURI::base().'/media/site/js/site.js');
}

/** component specific css and js - media/site/css[js]/component_option.css[js] **/
if (JFile::exists(JPATH_BASE.'/media/site/css/'.$this->options->get('component_option').'.css')) {
    $document->addStyleSheet(JURI::base().'/media/site/css/'.$this->options->get('component_option').'.css');
}
if (JFile::exists(JPATH_BASE.'/media/site/js/'.$this->options->get('component_option').'.js')) {
    $document->addScript(JURI::base().'media/site/js/'.$this->options->get('component_option').'.js');
}