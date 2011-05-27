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
 * ArticlesBuildRoute
 *
 * Build the route for the com_articles component
 *
 * @param  $query
 * @return array
 */
function ArticlesBuildRoute(&$query)
{
    return MolajoBuildRoute(&$query, 'com_articles', 'article', 'articles', 'Article', '#__articles');
}

/**
 * ArticlesParseRoute
 *
 * Parse the segments of a URL.
 *
 * called out of JRouterSite::_parseSefRoute()
 *
 * @param  $query
 * @return array
 */
function ArticlesParseRoute ($segments)
{
    return MolajoParseRoute($segments, 'com_articles', 'article', 'articles', 'Article', '#__articles');
}