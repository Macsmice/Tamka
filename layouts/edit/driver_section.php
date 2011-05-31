<?php
/**
 * @version     $id: layout
 * @package     Molajo
 * @subpackage  Single View
 * @copyright   Copyright (C) 2011 Amy Stephen. All rights reserved.
 * @license     GNU General Public License Version 2, or later http://www.gnu.org/licenses/gpl.html
 */
defined('MOLAJO') or die;

/** loop through columns **/
$count = 0;
for ($i=1; $i < 1000; $i++) {
    $this->columnName = $this->options->def($this->section.$i);
    if ($this->columnName == null) {
        break;
    } else if ($this->columnName == '0') {
    } else {
        if ($count == 0) {
            include $this->layoutHelper->getPath ('section_begin.php');
        }
        $count++;
        /** see if column exists, if not use default handler **/
        $results = $this->layoutHelper->getPath (strtolower('edit_'.$this->columnName.'.php'), 0);
        if ($results == false) {
            if ($this->section == 'config_manager_editor_primary_column') {
                include $this->layoutHelper->getPath ('primary.php');
            } else {
                include $this->layoutHelper->getPath ('standard_list_item.php');
            }
        } else {
            include $results;
        }
    }
}
if ($count > 0) {
    include $this->layoutHelper->getPath ('section_end.php');
}