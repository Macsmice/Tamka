<?php
/**
 * @version     $id: filterChecked_out_time.php
 * @package     Molajo
 * @subpackage  Filter
 * @copyright   Copyright (C) 2011 Amy Stephen. All rights reserved.
 * @license     GNU General Public License Version 2, or later http://www.gnu.org/licenses/gpl.html
 */
defined('MOLAJO') or die;

/**
 *  MolajoFieldChecked_out_time
 *
 *  Checked_out_time Filter Field Handling
 *
 *  @package    Molajo
 *  @subpackage Filter
 *  @since      1.6
 */
class MolajoFieldChecked_out_time extends MolajoField
{
    /**
     *  __construct
     *
     *  Set Fieldname and Filter with parent
     */
    public function __construct() {
        parent::__construct();
        parent::setFieldname ('checked_out_time');
        parent::setRequestFilter ('date');
    }

    /**
     *  getOptions
     *
     *  Returns Option Values
     */
    public function getOptions () {}
    /**
     *  getSelectedValue
     *
     *  Returns Selected Value
     */
    public function getSelectedValue () {}

    /**
     *  validateRequestValue
     *
     *  Returns Selected Value
     */
    public function validateRequestValue () {}

    /**
    *  getQueryParts
    *
    *  Returns Formatted Where clause for Query
    */
    public function getQueryParts ($query, $value, $selectedState, $onlyWhereClause=false)
    {
        $query->select('a.checked_out_time');
    }

    /**
     *  render
     *
     *  sets formatting and content parameters
     */
    public function render ($layout, $item, $itemCount)
    {
        if ($layout == 'admin') {
            $render = array();
            $render['link_value'] = false;
            $render['class'] = 'nowrap';
            $render['valign'] = 'top';
            $render['align'] = 'left';
            $render['sortable'] = true;
            $render['checkbox'] = false;
            $render['data_type'] = 'date';
            $render['column_name'] = 'checked_out_time';
            if ($item->checked_out_time == 0) {
                $render['print_value'] = '';
            } else {
                $render['print_value'] = JHTML::_('date', $item->checked_out_time, JText::_('DATE_FORMAT_LC4'));
            }

            return $render;
        }
    }
}