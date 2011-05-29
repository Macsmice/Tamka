<?php
/**
 * @version     $id: molajosample.php
 * @package     Molajo
 * @subpackage  Molajosample Plugin  
 * @copyright   Copyright (C) 2011 Amy Stephen. All rights reserved.
 * @license     GNU General Public License Version 2, or later http://www.gnu.org/licenses/gpl.html
 */
defined('MOLAJO') or die;

/**
 * Molajosample Query Plugin
 *
 * @package		Molajo
 * @subpackage	Query Plugin
 * @since		1.6
 */
class plgQueryMolajosample extends JPlugin
{
    
    /**
    * Query Events - Events in order of occurrence
    *
    * - onQueryPopulateState - passes in full filterset, can add or modify
    *
    * - create query (called from View)
    *      - triggers onQueryBeforeQuery event, passing in the Query object
    *
    * - run query
    *      - triggers onQueryAfterQuery event, passing in the full query resultset
    *
    * - loops through the recordset
    *
    *      - triggers onQueryBeforeItem event, passing in the new item in the recordset
    *
    *      - creates 'added value' fields, like author, permanent URL, etc.
    *
    *      - remove items due to post query examination
    *
    *      - triggers onQueryAfterItem event, passing in the current item with added value fields
    *
    * - loop complete
    *      - triggers onQueryComplete event, passing in the resultset, less items removed, with augmented data
    *
    *      - Returns resultset to the View
    * 
    */ 
    
	/**
	 * 1. onQueryPopulateState
     *
     * passes in full filter set, can add or modify 
     * 
	 * @param	string	$context    The component.view.layout context 
	 * @param	object	$filters    Filters for query object
	 * @param	object	$params     The content params
	 * 
	 * @since	1.6
	 */
	public function onQueryPopulateState ($context, &$filters, $params)
	{
        return true;
    }
    
	/**
	 * 2. onQueryBeforeQuery
     *
     * passes in query object to be modified, 
     * 
	 * @param	string	$context    The component.view.layout context 
	 * @param	object	$query      Model Query Object prior to executing the query
	 * @param	object	$params     The content params
	 * 
	 * @since	1.6
	 */    
    public function onQueryBeforeQuery ($context, &$query, $params)
    {
        return true;
    }
    
	/**
	 * 3. onQueryAfterQuery
     *
     * after query has been executed, full recordset passed into this event
     * 
	 * @param	string	$context    The component.view.layout context 
	 * @param	object	$results    Full query resultset
	 * @param	object	$params     The content params
	 * 
	 * @since	1.6
	 */    
    public function onQueryAfterQuery ($context, &$results, $params)
    {
        return true;
    }
    
	/**
	 * 4. onQueryBeforeItem
     *
     * single item from query resultset, can add columns or modify values 
	 *
	 * @param	string	$context    The component.view.layout context 
	 * @param	object	$item       Single resultset item
	 * @param	object	$params     The content params
	 * 
	 * @since	1.6
	 */    
    public function onQueryBeforeItem ($context, &$filters, $params)
    {
        return true;
    }    

	/**
	 * 5. onQueryAfterItem
     *
     * single item from query resultset, after processed by (possibly) adding values
     *  and determining if it should be passed to view, or not
	 *
	 * Method is called by the model
     * 
	 * @param	string	$context    The component.view.layout context 
	 * @param	object	$filters    Filters for query object
	 * @param	object	$params     The content params
	 * 
	 * @since	1.6
	 */    
    public function onQueryAfterItem ($context, &$filters, $params)
    {
        return true;
    }  
    
    
	/**
	 * 6. onQueryComplete
     *
     * passes in full filter set, can add or modify 
	 *
	 * Method is called by the model
     * 
	 * @param	string	$context    The component.view.layout context 
	 * @param	object	$filters    Filters for query object
	 * @param	object	$params     The content params
	 * 
	 * @since	1.6
	 */    
    public function onQueryComplete ($context, &$filters, $params)
    {
        return true;
    }      
}
