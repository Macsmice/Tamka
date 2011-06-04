<?php
/**
 * @version     $id: layout
 * @package     Molajo
 * @subpackage  Multiple View
 * @copyright   Copyright (C) 2011 Amy Stephen. All rights reserved.
 * @license     GNU General Public License Version 2, or later http://www.gnu.org/licenses/gpl.html
 */
defined('MOLAJO') or die; 

/** begin row **/
require $this->layoutHelper->getPath ('table_body_row_begin.php');
/** first column **/
require $this->layoutHelper->getPath ('table_body_row_column_first.php');

/** loop through columns **/
for ($i=1; $i < 1000; $i++) {
    $this->tempColumnName = $this->params->def('config_manager_grid_column'.$i);
    if ($this->tempColumnName == null) {
        break;
    } else if ($this->tempColumnName == '0') {
    } else {

        /** custom column file **/
        $results = $this->layoutHelper->getPath (strtolower('table_body_row_column_'.$this->tempColumnName.'.php'), 0);

        if ($results === false) {

            /** custom field rendering **/
            $fieldClassName = 'MolajoField'.ucfirst($this->tempColumnName);
            MolajoField::requireFieldClassFile ($this->tempColumnName, false);
            if (class_exists($fieldClassName)) {
                $MolajoFieldClass = new $fieldClassName();
                if (method_exists($MolajoFieldClass, 'render')) {
                    $results = $MolajoFieldClass::render ($layout='admin', $this->row, $this->row->rowCount);
                    if ($results == false) {
                    } else {
                        $this->render = $results;
                    }
                }
            }

            /** default field rendering **/
            if ($results == false) {
                $this->render['class'] = '';
                $this->render['valign'] = 'top';
                $this->render['align'] = 'left';
                $this->render['sortable'] = true;
                $this->render['checkbox'] = false;
                $this->render['data_type'] = true;
                $this->render['column_name'] = $this->tempColumnName;
                $columnName = $this->tempColumnName;
                $this->render['print_value'] = $this->escape($this->row->$columnName);
                $this->render['link_value'] = false;
            }
            /** render **/
            require $this->layoutHelper->getPath (strtolower('table_body_row_column_default.php'));
        } else {
            /** custom column file **/
            require $results;
        }
    }
}
/** end row **/
require $this->layoutHelper->getPath ('table_body_row_end.php');