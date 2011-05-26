<?php
/**
 * @version     $id: filterPublish_down.php
 * @package     Molajo
 * @subpackage  Filter
 * @copyright   Copyright (C) 2011 Amy Stephen. All rights reserved.
 * @license     GNU General Public License Version 2, or later http://www.gnu.org/licenses/gpl.html
 */
defined('MOLAJO') or die;

/**
 *  MolajoFieldPublish_down
 *
 *  Publish_down Filter Field Handling
 *
 *  @package    Molajo
 *  @subpackage Filter
 *  @since      1.6
 */
class MolajoFieldPublish_down extends MolajoField
{
    /**
     *  __construct
     *
     *  Set Fieldname and Filter with parent
     */
    public function __construct() {
        parent::__construct();
        parent::setFieldname ('publish_down');
        parent::setRequestFilter ('integer');

        parent::setTableColumnSortable (true);
        parent::setTableColumnCheckbox (false);
        parent::setDisplayDataType ('date');
    }

    /**
     *  getOptions
     *
     *  Returns Option Values
     */
    public function getOptions ()
    {
        $publishDateModel = JModel::getInstance('Model'.ucfirst(JRequest::getCmd('default_view')), ucfirst(JRequest::getCmd('default_view')), array('ignore_request' => true));
        return $publishDateModel->getMonthsPublish();
    }

    /**
     *  getSelectedValue
     *
     *  Returns Selected Value
     */
    public function getSelectedValue ()
    {
        /** retrieve and filter selected value **/
        parent::getSelectedValue ();

        if ($this->requestValue == null) {
            return false;
        }

        /** validate to list **/
        $this->validateRequestValue();

        /** return filtered and validated value **/
        return $this->requestValue;
    }

    /**
     *  validateRequestValue
     *
     *  Returns Selected Value
     */
    public function validateRequestValue ()
    {
        if ( substr($this->requestValue, 0, 4) > '1900'
                && substr($this->requestValue, 0, 4) > '2100'
                && inarray(substr($this->requestValue, 5, 2), array('01', '02', '03', '04', '05', '06', '07', '08', '09', '10', '11', '12') ) ) {
            return $this->requestValue;
        } else {
            return false;
        }
    }

    /**
    *  getQueryParts
    *
    *  Returns Formatted Where clause for Query
    */
    public function getQueryParts ($query, $value, $selectedState, $onlyWhereClause=false)
    {
        if ($onlyWhereClause) {
        } else {
            $query->select('a.publish_down');
        }

        if (trim($value) == '') {
            return;
        }
        $db = $this->getDbo();
        $query->where('SUBSTRING(a.publish_down, 1, 7) = '.$db->quote(substr($value, 0, 4).'-'.substr($value, 4, 2)));
    }

    /**
     * render
     *
     * sets formatting and content parameters
     *
     * @param  $layout
     * @param  $item
     * @param  $itemCount
     * @return array
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
            $render['column_name'] = 'publish_down';
            if ($item->publish_down == 0) {
                $render['print_value'] = '-';
            } else {
                $render['print_value'] = JHTML::_('date', $item->publish_down, JText::_('DATE_FORMAT_LC4'));
            }

            return $render;
        }
    }
}