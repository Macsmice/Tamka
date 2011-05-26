<?php
/**
 * @version     $id: build.php
 * @package     Molajo
 * @subpackage  ACL
 *
 * @copyright	Copyright (C) 2005 - 2011 Open Source Matters, Inc. All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 *
 * @copyright   Copyright (C) 2011 Amy Stephen. All rights reserved.
 * @license     GNU General Public License Version 2, or later http://www.gnu.org/licenses/gpl.html
 */
defined('MOLAJO') or die;

/**
 * Build the route for the component
 *
 * @param	array	An array of URL arguments
 * @return	array	The URL arguments to use to assemble the subsequent URL.
 * @since	1.5
 */
function MolajoBuildRoute($query, $componentParam, $singleParam, $typeParam, $tableParam)
{
    if ($query['option'] == $componentParam) {
    } else {
        return;
    }

    if ($query['view']) {
        $view = $query['view'];
    }

    /** amy - create a parameter to select the layout */
    if ($query['layout'] == 'item') {
        $layout = $query['layout'];
    } else {
        return;
    }

    /** think about hackable urls */
    if ((int) $query['id'] == 0) {
        return;
    } else {
        $id = $query['id'];
    }

    if ($query['alias']) {
        $alias = $query['alias'];
        unset($query['alias']);
    } else {
        return;
    }

    if ($query['ts']) {
        $timestamp = $query['ts'];
    } else {
        return;
    }

// if i don't do this then the /component/ thing goes on
// but this URL includes the menu item which is bad. (dups)
//    unset($query['option']);
//    unset($query['Itemid']);
    unset($query['view']);
    unset($query['layout']);
    unset($query['id']);
    unset($query['alias']);
    unset($query['ts']);

    $path = strftime('/%Y/%m/%d/', $timestamp).$alias;
    $segments = explode('/', $path);

	return $segments;
}