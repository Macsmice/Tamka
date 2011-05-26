<?php
/**
 * @version     $id: router.php
 * @package     Molajo
 * @subpackage  Router
 * @copyright   Copyright (C) 2011 Individual Molajo Contributors. All rights reserved.
 * @license     GNU General Public License Version 2, or later http://www.gnu.org/licenses/gpl.html
 */
defined('MOLAJO') or die;

/**
 * ThingsBuildRoute
 *
 * Build the route for the com_things component
 *
 * @param  $query
 * @return array
 */
function ThingsBuildRoute(&$query)
{
    return MolajoBuildRoute(&$query, 'com_things', 'thing', 'things', 'Thing', '#__things');
}

/**
 * ThingsParseRoute
 *
 * Parse the segments of a URL.
 *
 * called out of JRouterSite::_parseSefRoute()
 *
 * @param  $query
 * @return array
 */
function ThingsParseRoute ($segments)
{
    return MolajoParseRoute($segments, 'com_things', 'thing', 'things', 'Thing', '#__things');
}