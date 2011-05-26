<?php
/**
 * @version     $id: parse.php
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
 * Parse the segments of a URL.
 *		
 * @param	array	The segments of the URL to parse.
 *
 * @return	array	The URL attributes to be used by the application.
 * @since	1.5
 */

/**
 * MolajoParseRoute
 * @param  $segments
 * @param  $componentParam ex com_content
 * @param  $singleParam ex. thing
 * @param  $multipleParam ex. things
 * @param  $typeParam ex. Thing
 * @param  $tableParam ex. #__things
 * @return array
 */
    function MolajoParseRoute($segments, $componentParam, $singleParam, $multipleParam, $typeParam, $tableParam)
    {
        $vars = array();

        /** Count route segments */
        $count = count($segments);

        /** 1. pull off the 'reserved' parameters to the right of the url */

        /** tag/value1,value2 or tag=value1,value2 */
        /** date/ccyymmdd or date/ccyymm or date/ccyy */
        /** author/id */

        /** 2. Determine type of urls selected for configuration */
        $urlType = 1;

        /** 3. Process for Extension*/
        if ($urlType == 1) {
            $results = MolajoParseDateURLs($segments, $componentParam, $singleParam, $typeParam, $tableParam);
        }

        /** 4. Return if no match */
        if ($results === false) {
            return $segments;
        }

        /** 5. For match, set vars */
        $vars['id'] = $results;
        $vars['option'] = $componentParam;
        $vars['view'] = $multipleParam;
        $vars['layout'] = 'item';       /** amy - make this a component parameter */

        return $vars;
    }

    /**
     * MolajoParseDateURLs
     *
     * @param  $segments
     * @param  $componentParam
     * @param  $singleParam
     * @param  $typeParam
     * @param  $tableParam
     * @return array
     */
    function MolajoParseDateURLs ($segments, $componentParam, $singleParam, $typeParam, $tableParam)
    {

        /** provide for hackable URLs (default for component) */

        /** ccyy/mm/dd, ccyy/mm, ccyy */

        /** ccyy */
        if((int) ($segments[0]) > 1980 && $segments[0] < 2060) {
            $ccyy = $segments[0];
        } else {
            return false;
        }

        /** mm */
        if((int) ($segments[1]) > 0 && $segments[1] < 32) {
            $mm = (int) $segments[1];
            if ($mm < 10) {
                $mm = '0'.$mm;
            }
        } else {
            return false;
        }

        /** dd */
        if((int) ($segments[2]) > 0 && $segments[2] < 32) {
            $dd = (int) $segments[2];
            if ($dd < 10) {
                $dd = '0'.$dd;
            }
        } else {
            return false;
        }

        /** alias */
        $alias = trim(substr($segments[3], 0, 2).'-'.substr($segments[3], 3, strlen($segments[3])-3));

        /** run query */
        if (count($segments) > 3) {
            $id = MolajoParseDateURLsFull($ccyy, $mm, $dd, $alias, $tableParam);
        }

        if ($id === false) {
            return false;
        } else {
            return $id;
        }

    }

    /**
     * MolajoParseDateURLs
     *
     * @param  $segments
     * @param  $componentParam
     * @param  $singleParam
     * @param  $typeParam
     * @param  $tableParam
     * @return array
     */
    function MolajoParseDateURLsFull ($ccyy, $mm, $dd, $alias, $tableParam)
    {
        $db = JFactory::getDBO();

        $query = $db->getQuery(true);
        $query->select('MIN(id)');
        $query->from($tableParam);
        $query->where('publish_up like "'.$ccyy.'-'.$mm.'-'.$dd.'%"');
        $query->where('alias = '.$db->Quote($alias));
        $query->where('state > -10');

        $db->setQuery($query);

        return $db->loadResult();
    }
