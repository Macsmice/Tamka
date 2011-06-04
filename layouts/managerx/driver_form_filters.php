<?php
/**
 * @version     $id: driver
 * @package     Molajo
 * @subpackage  Multiple View
 * @copyright   Copyright (C) 2011 Amy Stephen. All rights reserved.
 * @license     GNU General Public License Version 2, or later http://www.gnu.org/licenses/gpl.html
 */
defined('MOLAJO') or die; 

/** $anyFilters used to prevent rendering the filter row if neither the search filter or any of the list filters are specified **/
$anyFilters = false;

/** search **/
if ($this->params->def('config_manager_list_search', 1) == '1') {
    if ($anyFilters == false) {
        $anyFilters = true;
        require $this->layoutHelper->getPath ('form_filter_begin.php');
    }
    require $this->layoutHelper->getPath ('form_filter_search.php');
}

/** $fieldFilters used to prevent list filters column if no list filters are specified **/
$fieldFilters = false;

/** do not load filters twice **/
$loadFilterArray = array();

/** loop thru filter options **/
for ($i=1; $i < 1000; $i++) {
    $this->tempColumnName = $this->params->def('config_manager_list_filters'.$i);

    /** encountered end of filters **/
    if ($this->tempColumnName == null) {

        $this->tempColumnName = 'title';
        if (in_array($this->tempColumnName, $loadFilterArray)) {
            break;
        } else if ($this->queryState->get('filter.state') == MOLAJO_STATE_VERSION) {
            // forces in the title list for the version restore layout
        } else {
            break;
        }
    }
    /** no filter was selected for configuration option **/
    if (in_array($this->tempColumnName, $loadFilterArray)) {

    /** no filter was selected for configuration option **/
    } else if ($this->tempColumnName == '0') {

    /** configuration option set for filter list **/
    } else {
        /** save so it does not get added multiple times **/
        $loadFilterArray[] = $this->tempColumnName;

        /** first one - build row and column **/
        if ($i == 1) {
            $fieldFilters = true;
            if ($anyFilters == false) {
                $anyFilters = true;
                require $this->layoutHelper->getPath ('form_filter_begin.php');
            }
            require $this->layoutHelper->getPath ('form_filter_fields_begin.php');
        }

        /** class name **/
        $fieldClassName = 'MolajoField'.ucfirst($this->tempColumnName);

        /** class file **/
        MolajoField::requireFieldClassFile ($this->tempColumnName);

        /** class instantiation **/
        if (class_exists($fieldClassName)) {
            $MolajoField = new $fieldClassName();
        } else {
            JFactory::getApplication()->enqueueMessage(JText::_('MOLAJO_INVALID_FIELD_CLASS').' '.$fieldClassName, 'error');
            return false;
        }

        /** option array values **/
        $this->tempArray = $MolajoField->getOptions();

        /** selected value **/
        $this->tempSelected = $this->queryState->get('filter.'.$this->tempColumnName);

        /** render field filter **/
        require $this->layoutHelper->getPath ('form_filter_field.php');
    }
}

if ($fieldFilters == true) {
    require $this->layoutHelper->getPath ('form_filter_fields_end.php');
}

if ($anyFilters == true) {
    require $this->layoutHelper->getPath ('form_filter_end.php');
}