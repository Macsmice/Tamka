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
if ($this->options->get('component_task') == 'add') {
    $set = 'config_manager_editor_button_bar_new_option';
} else if ($this->options->get('component_task') == 'edit') {
    $set = 'config_manager_editor_button_bar_edit_option';
} else {
    $set = 'config_manager_button_bar_option';
}
$aclClass = ucfirst($this->options->get('request.default_view')).'ACL';
$this->permissions = $aclClass::getUserPermissionSet ($this->options->get('request.option'),
                                                      $this->options->get('request.single_view'),
                                                      $set);

$toolbar = new MolajoToolbarHelper ();
$toolbar->addButtonsDefaultLayout ($this->options->get('filter.option'), $this->permissions);
