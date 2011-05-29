<?php
/**
 * @version     $id: layout
 * @package     Molajo
 * @subpackage  Multiple View
 * @copyright   Copyright (C) 2011 Amy Stephen. All rights reserved.
 * @license     GNU General Public License Version 2, or later http://www.gnu.org/licenses/gpl.html
 */
defined('MOLAJO') or die;

echo 'haaaaa';
die();

/** JS **/
JHtml::_('behavior.framework', true);
JHTML::_('behavior.tooltip');
JHTML::_('script','system/multiselect.js', false, true);

/** custom icons, button bar items, grid icons, css **/
$document =& JFactory::getDocument();
$document->addStyleSheet('../media/'.$this->options->get('component_option').'/css/administrator.css');

/** Parameters **/
$this->options = JComponentHelper::getParams($this->options->get('component_option'));

/** list variables **/
$this->listOrder = $this->queryState->get('list.ordering');
$this->listDirn = $this->queryState->get('list.direction');
$listOrder = $this->escape($this->queryState->get('list.ordering'));
$listDirn = $this->escape($this->queryState->get('list.direction'));
$this->saveOrder    = $this->listOrder == 'a.ordering';

/** generate output **/
require $this->layoutHelper->getPath ('form_begin.php');
require $this->layoutHelper->getPath ('driver_form_filters.php');
require $this->layoutHelper->getPath ('table_begin.php');
require $this->layoutHelper->getPath ('driver_table_head.php');
require $this->layoutHelper->getPath ('driver_table_body.php');
//require $this->layoutHelper->getPath ('table_footer_pagination.php');
require $this->layoutHelper->getPath ('form_hidden.php');
require $this->layoutHelper->getPath ('table_end.php');
require $this->layoutHelper->getPath ('batch.php');
require $this->layoutHelper->getPath ('form_end.php');