<?php
/**
 * @version     $id: layout.php
 * @package     Molajo
 * @subpackage  Layout Helper
 * @copyright   Copyright (C) 2011 Amy Stephen. All rights reserved.
 * @license     GNU General Public License Version 2, or later http://www.gnu.org/licenses/gpl.html
 */
defined('MOLAJO') or die;

/**
 * Molajo Layout Helper
 *
 * The Component View Layout File (ex. com_component/view/viewname/tmpl/default.php)
 *      calls to retrieve the path of the Layout Folder searching in this order:
 *      a. current template
 *      b. component
 *      c. core
 *
 * @package	Molajo
 * @subpackage	Helper
 * @since	1.6
 */
class MolajoLayoutHelper
{
    /**
     * driver
     * @param  $folder
     * @param  $option
     * @param  $view
     * @return bool|string
     */
    public function driver ($folder, $option, $view, $driver='/driver.php')
    {
        /** driver must have a slash */
        if (substr($driver, 0, 1) == '/') {
        } else {
            $driver = '/'.$driver;
        }
        
        /** path: template **/
        $template = JFactory::getApplication()->getTemplate();
        $templatePath = JPATH_THEMES.'/'.$template.'/html/layouts/';

        /** path: component **/
        if (MOLAJO_CLIENT == 'site') {
            $componentPath = JPATH_ROOT.'/components/'.$option.'/views/'.$view.'/tmpl/';
        } else {
            $componentPath = JPATH_ROOT.'/'.MOLAJO_CLIENT.'/components/'.$option.'/views/'.$view.'/tmpl/';
        }

        /** path: core **/
        $corePath = MOLAJO_LAYOUTS.'/';

        $folderPath = '';

        /** template **/
        if (file_exists($templatePath.$folder.$driver)) {
            return $templatePath.$folder.$driver;

        /** component **/
        } else if (file_exists($componentPath.$folder)) {
            return $componentPath.$folder.$driver;

        /** molajao library **/
        } else if (file_exists($corePath.$folder)) {
            return $corePath.$folder.$driver;

        /** error: layout not available **/
        } else if ($error == true) {
            JFactory::getApplication()->enqueueMessage(JText::_(strtoupper($option).'_INVALID_LAYOUT_FILENAME').': '.$corePath.$folder, 'error');
            $this->errorMessage = JText::_(strtoupper($option).'_INVALID_LAYOUT_FILENAME').': '.$corePath.$folder;
            $folderPath = $corePath.'notfound.php';

        } else {
            return false;
        }

        return $folderPath;
    }
}