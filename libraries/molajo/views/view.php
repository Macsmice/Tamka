<?php
/**
 * @version     $id: view.html.php
 * @package     Molajo
 * @subpackage  View
 * @copyright   Copyright (C) 2011 Amy Stephen. All rights reserved.
 * @license     GNU General Public License Version 2, or later http://www.gnu.org/licenses/gpl.html
 */
defined('MOLAJO') or die;

/**
 * Molajo View 
 *
 * @package	Molajo
 * @subpackage	View
 * @since	1.0
 */
class MolajoView extends JView
{
    /**
     * @var $system object
     */
    protected $system;

    /**
     * @var $document object
     */
    protected $document;

    /**
     * @var $user object
     */
    protected $user;

    /**
     * @var $layoutFolder string
     */
    protected $layoutFolder;

    /** layout working fields */
    protected $tempArray;
    protected $tempSection;
    protected $tempSelected;
    protected $tempColumnCount;
    protected $tempColumnName;

    /** ?? */
    /** toolbar - layout? */
    protected $userToolbarButtonPermissions;

    /**
     * @var $state object
     */
    protected $state;

    /**
     * @var $params object
     */
    protected $params;

    /**
     * @var $rowset object
     */
    protected $rowset;

    /**
     * @var $row array
     */
    protected $row;

    /**
     * display
     *
     * View for Display View that uses no forms
     *
     * @param null $tpl
     * @return bool
     */
    public function display($tpl = null)
    {
        /** @var $system */
        $this->system = JFactory::getConfig();

        /** @var $document */
        $this->document = JFactory::getDocument();

        /** @var $user */
        $this->user = JFactory::getUser();
    }

    /**
     * getColumns
     *
     * Can be used in Layouts to retrieve column and column values from objects
     *
     * Usage from Layouts:
     *
     * $this->getColumns ('system');
     *
     * @param  $type
     * @return void
     */
    protected function getColumns ($type, $layout='system')
    {
        /** @var $this->rowset */
        $this->rowset = array();

        /** @var $registry */
        $registry = new JRegistry();

        /** @var $tempIndex */
        $this->tempIndex =0;

        if ($type == 'user') {
            foreach ($this->$type as $column=>$value) {
                if ($column == 'params') {
                    $registry->loadJSON($value);
                    $options = $registry->toArray();
                    $this->getColumnsJSONArray ($type, $options);
                } else {
                    $this->getColumnsFormatting ($type, $column, $value);
                }
            }
            
        } else if ($type == 'system') {
                $registry->loadJSON($this->$type);
                $options = $registry->toArray();
                $this->getColumnsJSONArray ($type, $options);
            
        } else {
            return false;
        }

        /**
         *  Display Results
         */
        $this->layoutFolder = $this->findPath($layout);
        echo $this->renderMolajoLayout ('system');
        
        return;

    }

    /**
     * getColumnsJSONArray
     * 
     * Process Array from converted JSON Object
     * 
     * @param  $type
     * @param  $options
     * @return void
     */
    private function getColumnsJSONArray ($type, $options)
    {
        foreach ($options as $column=>$value) {
            $this->getColumnsFormatting ($type, $column, $value);
        }
    }

    /**
     * getColumnsFormatting
     *
     * Process Columns from Object
     *
     * @param  $type
     * @param  $column
     * @param  $value
     * @return void
     */
    private function getColumnsFormatting ($type, $column, $value)
    {
        $this->rowset[$this->tempIndex]['column'] = $column;

        if (is_array($value)) {
            $this->rowset[$this->tempIndex]['syntax'] = '$list = $this->'.$type."->get('".$column."');<br />";
            $this->rowset[$this->tempIndex]['syntax'] .= 'foreach ($list as $item=>$itemValue) { <br />';
            $this->rowset[$this->tempIndex]['syntax'] .= '&nbsp;&nbsp;&nbsp;&nbsp;echo $item.'."': '".'.$itemValue;';
            $this->rowset[$this->tempIndex]['syntax'] .= '<br />'.'}';
            $temp = '';
            $list = $this->$type->get($column);
            foreach ($list as $item=>$itemValue) {
                $temp .= $item.': '.$itemValue.'<br />';
            }
            $this->rowset[$this->tempIndex]['value'] = $temp;
        } else {
            $this->rowset[$this->tempIndex]['syntax'] = 'echo $this->'.$type."->get('".$column."');  ";
            $this->rowset[$this->tempIndex]['value'] = $value;
        }

        $this->tempIndex++;
    }

    /**
     * findPath
     * 
     * Looks for path of Request Layout as a layout folder, in this order:
     *
     *  1. CurrentTemplate/html/$layout-folder/
     *  2. components/com_component/views/$view/tmpl/$layout-folder/
     *  3. MOLAJO_LAYOUTS/$layout-folder/
     * 
     *  4. If none of the above, use normal Joomla tmpl/layout.php
     *
     * @param  $tpl
     * @return bool|string
     */
    protected function findPath ($layout)
    {
        /** path: template **/
        $template = JFactory::getApplication()->getTemplate();
        $templatePath = JPATH_THEMES.'/'.$template.'/html/';

        /** path: component **/
        if (MOLAJO_APPLICATION == 'site') {
            $componentPath = JPATH_ROOT.'/components/'.$this->state->get('request.option').'/views/'.$this->state->get('request.view').'/tmpl/';
        } else {
            $componentPath = JPATH_ROOT.'/'.MOLAJO_APPLICATION.'/components/'.$this->state->get('request.option').'/views/'.$this->state->get('request.view').'/tmpl/';
        }

        /** path: core **/
        $corePath = MOLAJO_LAYOUTS.'/';

        /** template **/
        if (is_dir($templatePath.$layout)) {
            return $templatePath.$layout;

        /** component **/
        } else if (is_dir($componentPath.$layout)) {
            return $componentPath.$layout;

        /** molajao library **/
        } else if (is_dir($corePath.$layout)) {
            return $corePath.$layout;
        }

        return false;
    }

    /**
     * renderMolajoLayout
     *
     * Loads Language, Document Head, Toolbar/Submenu and CSS
     *
     * Loops through rowset, one row at a time, including top, header, body, footer, and bottom files
     *
     * @param  $this->layoutFolder
     * @return string
     */
    protected function renderMolajoLayout ($layout='')
    {
        /** @var $rowCount */
        $rowCount = 0;

        /** start collecting the output */
        ob_start();

        /** load Language, Document Head, Toolbar/Submenu, JS/CSS (Site, Component, and Layout) */
        if ($layout == 'system') {
        } else {
            include MOLAJO_LAYOUTS.'/include/head.php';
        }

        /**
         * List rowset
         *
         * Automatically includes the following files (if existing)
         *
         * A. Before first row => layoutFolder/header.php
         * B. For each row in the rowset => layoutFolder/item_header.php item_body.php and item_footer.php
         * C. After the last row in the rowset => layoutFolder/footer.php
         *
         */
        foreach ($this->rowset as $this->row) {

            /** layout: top */
            if ($rowCount == 1) {
                if (file_exists($this->layoutFolder.'/layouts/top.php')) {
                    include $this->layoutFolder.'/layouts/top.php';
                }
            }

            /** item: header */
            if (file_exists($this->layoutFolder.'/layouts/header.php')) {
                include $this->layoutFolder.'/layouts/header.php';
            }

            /** event: After Display of Title */
            if (isset($this->row->event->afterDisplayTitle)) {
                echo $this->row->event->afterDisplayTitle;
            }
            /** event: Before Content Display */
            if (isset($this->row->event->beforeDisplayContent)) {
                echo $this->row->event->beforeDisplayContent;
            }

            /** item: body */
            if (file_exists($this->layoutFolder.'/layouts/body.php')) {
                include $this->layoutFolder.'/layouts/body.php';
            }

            /** item: footer */
            if (file_exists($this->layoutFolder.'/layouts/footer.php')) {
                include $this->layoutFolder.'/layouts/footer.php';
            }
        }

        /** layout: bottom */
        if (file_exists($this->layoutFolder.'/layouts/bottom.php')) {
            include $this->layoutFolder.'/layouts/bottom.php';
        }

        /** event: After Layout is finished */
        if (isset($this->row->event->afterDisplayContent)) {
            echo $this->row->event->afterDisplayContent;
        }

        /** collect output */
        $output = ob_get_contents();
        ob_end_clean();

        return $output;
    }
}