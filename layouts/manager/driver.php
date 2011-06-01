<?php
/**
 * @version     $id: layout
 * @package     Molajo
 * @subpackage  Multiple View
 * @copyright   Copyright (C) 2011 Amy Stephen. All rights reserved.
 * @license     GNU General Public License Version 2, or later http://www.gnu.org/licenses/gpl.html
 */
defined('MOLAJO') or die;

/** JS **/
JHtml::_('behavior.framework', true);
JHtml::_('behavior.tooltip');
JHtml::_('script','system/multiselect.js', false, true);

/** custom icons, button bar items, grid icons, css **/
$document =& JFactory::getDocument();
$document->addStyleSheet('../media/'.$this->state->get('request.option').'/css/administrator.css');

/** list variables **/
$this->saveOrder = $this->state->get('list.ordering');

/** generate output **/
include dirname(__FILE__).'/layouts/form_begin.php';
include dirname(__FILE__).'/layouts/driver_form_filters.php';
include dirname(__FILE__).'/layouts/table_begin.php';
include dirname(__FILE__).'/layouts/driver_table_head.php';
include dirname(__FILE__).'/layouts/driver_table_body.php';
//include dirname(__FILE__).'/layouts/table_footer_pagination.php';
include dirname(__FILE__).'/layouts/form_hidden.php';
include dirname(__FILE__).'/layouts/table_end.php';
include dirname(__FILE__).'/layouts/batch.php';
include dirname(__FILE__).'/layouts/form_end.php';