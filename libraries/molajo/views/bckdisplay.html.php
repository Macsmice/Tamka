<?php
/**
 * @version     $id: multiple.html.php
 * @package     Molajo
 * @subpackage  Display View
 * @copyright   Copyright (C) 2011 Amy Stephen. All rights reserved.
 * @license     GNU General Public License Version 2, or later http://www.gnu.org/licenses/gpl.html
 */
defined('MOLAJO') or die;

/**
 * View to Display All Layouts, except the Editor Layout
 *
 * @package	Molajo
 * @subpackage	Display View
 * @since	1.0
 */
class MolajoViewDisplay extends MolajoView
{
    /**
     * @var $options object
     *
     * Contains all options which can be retrieved as this->state->get('option_name')
     *
     * 1. Filters and filtered values (for Administrator) - ex. $this->state->get('filter.category')
     *
     * 2. Merged Component Parameters (Global Options, Menu Item, Item)
     *    A. Including those used as selection criteria - ex. $this->state->get('filter.category')
     *    B. And those parameters needed by the layout - ex. $this->option->get('layout.show_title')
     *
     * 3. Component Request Variables
     *    $this->state->get('request.option'), and 'component_' + model, view, layout, default_view, single_view and task
     *
     * 4. 
     *
     */

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

    /** used in manager */

    /**
     * @var $render object
     */
    protected $render;

    /**
     * @var s$aveOrder string
     */
    protected $saveOrder;

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

    /** blog variables
     move variables into $options
     retrieve variables here in view - and split int rowset if needed
     */
	protected $category;
	protected $children;
	protected $lead_items = array();
	protected $intro_items = array();
	protected $link_items = array();
	protected $columns = 1;

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

        /** @var $state */
        $this->state      = $this->get('State');

        /** @var $rowset */
        $this->rowset     = $this->get('Items');

        /** @var $pagination */
        $this->pagination = $this->get('Pagination');

        /** @var $params */
        if (JFactory::getApplication()->getName() == 'site') {
           $this->params = JFactory::getApplication()->getParams();
   //         $this->_mergeParams ();
//		$this->getState('request.option')->get('page_class_suffix', '') = htmlspecialchars($this->params->get('pageclass_sfx'));
        } else {
           $this->params = JComponentHelper::getParams(JRequest::getCmd('option'));
        }


//Navigation
//$this->navigation->get('form_return_to_link')
//$this->navigation->get('previous')
//$this->navigation->get('next')
//
// Pagination
//$this->navigation->get('pagination_start')
//$this->navigation->get('pagination_limit')
//$this->navigation->get('pagination_links')
//$this->navigation->get('pagination_ordering')
//$this->navigation->get('pagination_direction')
//$this->breadcrumbs
//$total = $this->getTotal();
        /**
$this->configuration

Parameters (Includes Global Options, Menu Item, Item)
$this->params->get('layout_show_page_heading', 1)
$this->params->get('layout_page_class_suffix', '')
 */


//		$this->category	            = $this->get('Category');
//		$this->categoryAncestors    = $this->get('Ancestors');
//		$this->categoryParent       = $this->get('Parent');
//		$this->categoryPeers	    = $this->get('Peers');
//		$this->categoryChildren	    = $this->get('Children');

//      $this->authorProfile        = $this->get('Author');

//      $this->tags (tag cloud)
//      $this->tagCategories (menu)
//      $this->calendar

        /** process model errors */
        if (count($errors = $this->get('Errors'))) {
            JError::raiseError(500, implode("\n", $errors));
            return false;
        }

        /**
         * Navigation
         */


        if (JFactory::getApplication()->getName() == 'site') {

        }

        $this->layoutFolder = $this->findPath($this->state->get('request.layout'));
$this->layoutFolder = $this->findPath('manager');



        if ($this->layoutFolder === false) {
            parent::display($tpl);
        } else {
            echo $this->renderMolajoLayout ();
        }
    }

    /**
     * getColumns
     *
     * Can be used in Layouts to retrieve column and column values from objects
     *
     * @param  $type
     * @return void
     */
    public function getColumns ($type, $layout='system')
    {
        /** @var $this->tempArray */
        $this->tempArray = array();

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
        echo $this->renderMolajoLayout ();

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
    function getColumnsJSONArray ($type, $options)
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
    function getColumnsFormatting ($type, $column, $value)
    {
        $this->tempArray[$this->tempIndex]['column'] = $column;

        if (is_array($value)) {
            $this->tempArray[$this->tempIndex]['syntax'] = '$list = $this->'.$type."->get('".$column."');<br />";
            $this->tempArray[$this->tempIndex]['syntax'] .= 'foreach ($list as $item=>$itemValue) { <br />';
            $this->tempArray[$this->tempIndex]['syntax'] .= '&nbsp;&nbsp;&nbsp;&nbsp;echo $item.'."': '".'.$itemValue;';
            $this->tempArray[$this->tempIndex]['syntax'] .= '<br />'.'}';
            $temp = '';
            $list = $this->$type->get($column);
            foreach ($list as $item=>$itemValue) {
                $temp .= $item.': '.$itemValue.'<br />';
            }
            $this->tempArray[$this->tempIndex]['value'] = $temp;
        } else {
            $this->tempArray[$this->tempIndex]['syntax'] = 'echo $this->'.$type."->get('".$column."');  ";
            $this->tempArray[$this->tempIndex]['value'] = $value;
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
    public function findPath ($layout)
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
    private function renderMolajoLayout ()
    {
        /** @var $rowcount */
        $rowcount = 0;

        /** start collecting the output */
        ob_start();

        /** load Language, Document Head, Toolbar/Submenu, JS/CSS (Site, Component, and Layout) */
        include MOLAJO_LAYOUTS.'/include/head.php';

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

            $this->row->rowCount = $rowcount++;
 
            /** layout: top */
            if ($rowcount == 1) {
                if (file_exists($this->layoutFolder.'/layouts/top.php')) {
                    include $this->layoutFolder.'/layouts/top.php';
                }
            }

            /** item: header */
            if (file_exists($this->layoutFolder.'/layouts/header.php')) {
                include $this->layoutFolder.'/layouts/header.php';
            }

            /** event: After Display of Title */
            echo $this->row->event->afterDisplayTitle;

            /** event: Before Content Display */
            echo $this->row->event->beforeDisplayContent;

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
        echo $this->row->event->afterDisplayContent;

        /** collect output */
        $output = ob_get_contents();
        ob_end_clean();

        return $output;
    }
}