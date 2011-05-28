<?php
/**
 * @version		$Id: Parameters.php 21007 2011-03-22 13:23:21Z infograf768 $
 * @package		Joomla.Framework
 * @subpackage	Form
 * @copyright	Copyright (C) 2005 - 2011 Open Source Matters, Inc. All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */
defined('JPATH_BASE') or die;

/**
 * Form Field class for the Joomla Framework.
 *
 * @package		Joomla.Framework
 * @subpackage	Form
 * @since		1.6
 */
class JFormFieldParameters extends JFormField
{
	/**
	 * The form field type.
	 *
	 * @var		string
	 * @since	1.6
	 */
	public $type = 'Parameters';

	/**
	 * Method to get the field input markup.
	 *
	 * TODO: Add access check.
	 *
	 * @return	string	The field input markup.
	 * @since	1.6
	 */
	protected function getInput()
	{
        /** language **/
        JFactory::getLanguage()->load('plg_system_create_molajosamples', JPATH_SITE.'/media/plg_system_create/components/', JFactory::getLanguage()->getDefault(), true, true);

        /** $parameter_type **/
        $parameter_type	= (string) $this->element['parameter_type'];
        $path = (string) $this->element['path'];

		return $this->getParameterSet($parameter_type, $path);
	}

	/**
	 * Get a list of the parameter sets
	 *
	 * @return	array
	 * @since	1.6
	 */
	protected function getParameterSet($parameter_type, $path)
	{
        if ($path == '' || $path == null) {
            $path = MOLAJO_PARAMETERS;
        }

        JFile::makeSafe($parameter_type);
        JFilterOutput::stringURLSafe($parameter_type);

		return simplexml_load_file($parameter_type);

		return JForm::loadFile($parameter_type, false);
	}
}

