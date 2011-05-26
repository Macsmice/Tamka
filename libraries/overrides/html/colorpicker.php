<?php
/**
 * @version	$Id: colorpicker.php 19298 2010-10-30 17:17:54Z infograf768 $
 * @package	Joomla.Framework
 * @subpackage	HTML
 * @copyright	Copyright (C) 2005 - 2010 Open Source Matters, Inc. All rights reserved.
 * @license	GNU General Public License version 2 or later; see LICENSE.txt
 */

/**
 * Utility class for javascript behaviors
 *
 * @package	Joomla.Framework
 * @subpackage	HTML
 * @version	1.6
 */
abstract class JHtmlColorpicker
{

	/**
	 * Add unobtrusive javascript support for color picker
	 *
	 * @return	void
	 * @since	1.6
	 */
	public static function options()
	{
                $document =& JFactory::getDocument();
                $document->addScript('../media/molajo/js/jscolor.js' );
	}
}
