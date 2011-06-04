<?php
/**
 * @version     $id: layout
 * @package     Molajo
 * @subpackage  Multiple View
 * @copyright   Copyright (C) 2011 Amy Stephen. All rights reserved.
 * @license     GNU General Public License Version 2, or later http://www.gnu.org/licenses/gpl.html
 */
defined('MOLAJO') or die;

/** loop through columns **/
for ($i=1; $i < 1000; $i++) {
    $this->columnName = $this->params->get('config_manager_grid_column'.$i);

    if ($this->columnName == null) {
        break;
    } else if ($this->columnName == '0') {
    } else {

        /** custom column file **/
        $filename = dirname(__FILE__).'/form/'.strtolower('table_body_row_column_'.$this->columnName).'.php';
        $fileExists = JFile::exists($filename);

        if ($fileExists === false) {

            /** custom field rendering **/
            $fieldClassName = 'MolajoField'.ucfirst($this->columnName);
            MolajoField::requireFieldClassFile ($this->columnName, false);

            if (class_exists($fieldClassName)) {
                $MolajoFieldClass = new $fieldClassName();
                if (method_exists($MolajoFieldClass, 'render')) {
                    $results = $MolajoFieldClass::render ($layout='admin', $this->row, $this->rowCount);
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
                $this->render['column_name'] = $this->columnName;
                $columnName = $this->columnName;
                $this->render['print_value'] = $this->row->$columnName;
                $this->render['link_value'] = false;
            }
            /** render **/
            include dirname(__FILE__).'/form/table_body_row_column_default.php';
        } else {
            /** custom column file **/
            include $filename;
        }
    }
}