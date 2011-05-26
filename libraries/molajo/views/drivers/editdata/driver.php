<?php
/**
 * @version     $id: edit.php
 * @package     Molajo
 * @subpackage  Single View
 * @copyright   Copyright (C) 2011 Amy Stephen. All rights reserved.
 * @license     GNU General Public License Version 2, or later http://www.gnu.org/licenses/gpl.html
 */
defined('MOLAJO') or die;

/** custom icons, button bar items, grid icons **/
$document =& JFactory::getDocument();
if (JFactory::getApplication()->getName() == 'site') {
}
$document->addStyleSheet('media/molajo/css/template.css');
if ($document->direction == 'rtl') {
    $document->addStyleSheet('media/molajo/css/template_rtl.css');
}

/** mt **/
JHtml::_('behavior.framework', true);
JHtml::_('behavior.tooltip');
JHtml::_('behavior.formvalidation');
JHtml::_('behavior.keepalive');
JHtml::_('script','system/multiselect.js', false, true);

/** toolbar */
if (JFactory::getApplication()->getName() == 'site') {
    include $this->layoutHelper->getPath ('form_toolbar.php');
}

/** form begin **/
include $this->layoutHelper->getPath ('form_begin.php');

/** form validation **/
// js problems include $this->layoutHelper->getPath ('form_validation.php');

/**
 *  LEFT COLUMN
 */
/** begin **/
include $this->layoutHelper->getPath ('left_column_begin.php');

/** top **/
$this->section = 'config_manager_editor_left_top_column';
include $this->layoutHelper->getPath ('driver_section.php');

/** primary **/
$this->section = 'config_manager_editor_primary_column';
include $this->layoutHelper->getPath ('driver_section.php');

/** bottom **/
$this->section = 'config_manager_editor_left_bottom_column';
include $this->layoutHelper->getPath ('driver_section.php');

/** end **/
include $this->layoutHelper->getPath ('left_column_end.php');

/**
 *  RIGHT COLUMN
 */

/** begin **/
include $this->layoutHelper->getPath ('right_column_begin.php');
/** publishing **/
include $this->layoutHelper->getPath ('right_column_publishing_top.php');
$this->section = 'config_manager_editor_right_publishing_column';
include $this->layoutHelper->getPath ('driver_section.php');
include $this->layoutHelper->getPath ('right_column_publishing_bottom.php');
/** attribs **/
include $this->layoutHelper->getPath ('driver_fieldset.php');
/** right column end **/
include $this->layoutHelper->getPath ('right_column_end.php');

/**
 *  FULL WIDTH BOTTOM
 */

/** begin **/
include $this->layoutHelper->getPath ('bottom_begin.php');
/** acl **/
include $this->layoutHelper->getPath ('bottom_acl.php');
/** hidden **/
include $this->layoutHelper->getPath ('bottom_hidden.php');
/** form end **/
include $this->layoutHelper->getPath ('form_end.php');
/** end **/
include $this->layoutHelper->getPath ('bottom_end.php');