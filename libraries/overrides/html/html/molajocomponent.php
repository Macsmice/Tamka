<?php
/**
 * @version     $id: molajocomponent
 * @package     Molajo
 * @subpackage  HTML Class
 * @copyright   Copyright (C) 2011 Amy Stephen. All rights reserved.
 * @license     GNU General Public License Version 2, or later http://www.gnu.org/licenses/gpl.html
 */
defined('MOLAJO') or die();

/**
 * Molajo Components in a Select List
 *
 * @static
 * @package		Joomla.Framework
 * @subpackage	HTML
 * @since		1.5
 */
abstract class JHtmlMolajoComponent
{
	/**
	 * @var	array	Cached array of the component items.
	 */
	protected static $results = array();

	/**
	 * Returns an array of Molajo Components
	 *
	 * @param	string	The extension option.
	 * @param	array	An array of configuration options. 
	 *
	 * @return	array
	 */
	public function options()
	{
            $options = array();
            $db	= JFactory::getDbo();
            $query = $db->getQuery(true);

            $query->select('DISTINCT component_option as value, option_value_literal as text');
            $query->from('#__molajo_configuration');
            $query->where('option_id = 0');
            $query->where('component_option <> "com_molajo"');

            $db->setQuery($query);
            $results = $db->loadObjectList();
            if ($db->getErrorNum()) {
                JError::raiseWarning(500, $db->getErrorMsg());
                return;
            }

            if (count($results) > 0) {

                $translated = array();
                foreach($results as $item) {
                    $translated[$i]->value = JText::_($item->value);
                    $translated[$i]->text = $item->text;
                    $i++;
                }

                /** sort by translated value **/
                $translatedSorted = array();
                sort($translated);
                $translatedSorted = $translated;

                /** load into select list **/
                foreach ($translatedSorted as $item) {
                    $options[]	= JHtml::_('select.option', $item->value, JText::_($item->text));
                }
            }

            return $options;
	}
}