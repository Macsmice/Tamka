<?php
/**
 * @version     $id: item.php
 * @package     Molajo
 * @subpackage  Standard Driver
 * @copyright   Copyright (C) 2011 Amy Stephen. All rights reserved.
 * @license     GNU General Public License Version 2, or later http://www.gnu.org/licenses/gpl.html
 */
defined('MOLAJO') or die;

/**
 * Toolbar
 */
$aclClass = ucfirst($this->options->get('component_default_view')).'ACL';
$this->userToolbarButtonPermissions = $aclClass::getUserToolbarButtonPermissions ($this->options->get('component_option'), $this->options->get('component_single_view'), $this->options->get('component_task'));

$toolbar = new MolajoToolbarHelper ();
$toolbar->addButtonsDefaultLayout ($this->options->get('filter.options'), $this->userToolbarButtonPermissions);
