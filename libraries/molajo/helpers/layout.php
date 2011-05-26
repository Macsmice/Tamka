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
 * Step 1. The Component View Layout File (ex. com_component/view/viewname/tmpl/default.php)
 *      Calls the Molajo Layout Helper to:
 *
 *   1. Set the name of the Driver Folder using the method setLayoutDriver
 *
 *   2. Set the name of the Layout Folder using the method setLayout
 *
 *   3. Retrieve the Path of the Driver File which is determined by
 *      searching for the driver.php file in this order:
 *      a. current template
 *      b. component
 *      c. core
 *   4. Using the path, issues a require_once for the driver.php file
 *
 * Step 2. The Driver file includes the Layout File(s).
 *
 * Warning: The Template Layout File cannot be named the same as the Driver Layout File
 *   due to the sequence of inclusion checking (template, component, core) will result in loop
 *
 */
/**
 * Molajo Layout Helper
 *
 * @package	Molajo
 * @subpackage	Helper
 * @since	1.6
 */
class MolajoLayoutHelper
{
   /**
     * $layoutDriverFolderName
     * @var string
     */
    public $layoutDriverFolderName;

    /**
     * $layoutFolderName
     * @var string
     */
    public $layoutFolderName;

    /**
     * setLayoutDriver
     *
     * Location of the Folder containing the Layout Driver Files
     *
     * @param string $option
     */
    public function setLayoutDriver ($option) {
        $this->layoutDriverFolderName = $option;
    }

    /**
     * setLayout
     *
     * Location of the Folder containing the Layout Files
     *
     * @param string $option
     */
    public function setLayout ($option) {
        $this->layoutFolderName = $option;
    }

    /**
     * getPath
     *
     * looks for file in paths
     *
     * @param  $layout
     * @param bool $error
     * @return bool|string
     */
    public function getPath ($layout, $error=true)
    {
        /** template **/
        $template = JFactory::getApplication()->getTemplate();

        /** layout **/
        if ($layout == '') {
            $layout = JRequest::getVar('layout').'.php';
        }
        if ($layout == '') {
            $layout = 'default.php';
        }

        /** path: component **/
        if (MOLAJO_CLIENT == 'site') {
            $bPath = JPATH_ROOT.'/components/'.JRequest::getVar('option').'/views/'.JRequest::getVar('view').'/tmpl/';
        } else {
            $bPath = JPATH_ROOT.'/'.MOLAJO_CLIENT.'/components/'.JRequest::getVar('option').'/views/'.JRequest::getVar('view').'/tmpl/';
        }

        /** path: template **/
        $tPath = JPATH_THEMES.'/'.$template.'/html/'.JRequest::getVar('view').'/'.JRequest::getVar('view').'/';

        /** path: driver or layout **/
        if (substr($layout, 0, 6) == 'driver') {
            $mPath = MOLAJO_LAYOUT_DRIVERS.$this->layoutDriverFolderName.'/';
        } else {
            $mPath = MOLAJO_LAYOUTS.$this->layoutFolderName.'/';
        }

        $layoutPath = '';

        /** template **/
        if (file_exists($tPath.$layout)) {
            $layoutPath = $tPath.$layout;

        /** component **/
        } else if (file_exists($bPath.$layout)) {
            $layoutPath =$bPath.$layout;

        /** molajao library **/
        } else if (file_exists($mPath.$layout)) {
            $layoutPath = $mPath.$layout;

        /** error: layout not available **/
        } else if ($error == true) {
            JFactory::getApplication()->enqueueMessage(JText::_(strtoupper(JRequest::getVar('option')).'_INVALID_LAYOUT_FILENAME').': '.$mPath.$layout, 'error');
            $this->errorMessage = JText::_(strtoupper(JRequest::getVar('option')).'_INVALID_LAYOUT_FILENAME').': '.$mPath.$layout;
            $layoutPath = $mPath.'notfound.php';

        } else {
            return false;
        }

        return $layoutPath;
    }
}