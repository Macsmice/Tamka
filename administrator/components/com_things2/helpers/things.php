<?php
/**
 * @version     $id: com_things
 * @package     Molajo
 * @subpackage  Things Component
 * @copyright   Copyright (C) 2011 Individual Molajo Contributors. All rights reserved.
 * @license     GNU General Public License Version 2, or later http://www.gnu.org/licenses/gpl.html
 */
defined('JPATH_PLATFORM') or die;

/**
 * ThingsHelper
 *
 * Category Submenu Helper
 *
 * @package	Molajo
 * @subpackage	com_things
 * @since	1.6
 */
class ThingsHelper
{
    public static $extension = 'com_things';

    /**
     * Configure the Linkbar.
     *
     * @param	string	$vName	The name of the active view.
     *
     * @return	void
     * @since	1.6
     */
    public static function addSubmenu($vName)
    {
        JSubMenuHelper::addEntry(
                JText::_('COM_THINGS_THINGS'),
                'index.php?option=com_things&view=things',
                $vName == 'things'
        );
        JSubMenuHelper::addEntry(
                JText::_('COM_THINGS_SUBMENU_CATEGORIES'),
                'index.php?option=com_categories&extension=com_things',
                $vName == 'categories'
        );
    }
}