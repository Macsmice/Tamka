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
 * @since	1.6
 */
class MolajoViewDisplay extends JView
{
    /**
     * @var $options object
     *
     * Contains all options which can be retrieved as $this->options->get('option_name')
     *
     * 1. Filters and filtered values (for Administrator) - ex. $this->options->get('filter.category')
     *
     * 2. Merged Component Parameters (Global Options, Menu Item, Item)
     *    A. Including those used as selection criteria - ex. $this->options->get('filter.category')
     *    B. And those parameters needed by the layout - ex. $this->option->get('layout.show_title')
     *
     * 3. Component Request Variables
     *    $this->options->get('request.option'), and 'component_' + model, view, layout, default_view, single_view and task
     *
     * 4. 
     *
     */
    protected $state;
    protected $params;
    protected $recordset;

    /** toolbar - layout? */
    protected $userToolbarButtonPermissions;
    protected $row;
    protected $rowCount;

/*  navigation object */
    protected $listOrder;
    protected $listDirn;
    protected $saveOrder;
    protected $ordering;

    /** blog variables
     move variables into $options
     retrieve variables here in view - and split int recordset if needed
     */
	protected $category;
	protected $children;
	protected $lead_items = array();
	protected $intro_items = array();
	protected $link_items = array();
	protected $columns = 1;

    /** layout variables  **/
    protected $layoutHelper;
    protected $layoutFolder;

    /** layout working fields */
    protected $tempArray;
    protected $tempSelected;
    protected $tempCount;
    protected $tempColumnCount;

    /**
     * __construct
     *
     * Constructor.
     *
     * @param array $config
     */
    public function __construct($config = array())
    {
        parent::__construct($config);
    }

    /**
     * display
     *
     * View for Display View that uses no forms
     *
     * @param null $tpl
     * @return void
     */
    public function display($tpl = null)
    {
//        $this->setState('filter_amy', 'stephen');

        /** retrieve model data */
        $this->state         = $this->get('State');
        $this->params        = $this->get('Params');
        $this->recordset     = $this->get('Items');

/**
MOLAJO_LAYOUT_DRIVERS
$this->document
$this->configuration
$this->user


$this->options
Parameters (Includes Filters, Global Options, Menu Item, Item)
$this->state->get('filter.category')                        state
$this->params->get('layout_show_page_heading', 1)           parameters = layout_options?
$this->options->get('layout_page_class_suffix', '')
 */
        // $this->row is one item
        //  $this->row->xxx->event->eventName
        
        $this->rowCount = 0;

        /**
         * Navigation
         */
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

        $this->pagination    = $this->get('Pagination');

        // Related
//		$this->category	    = $this->get('Category');
//      $this->tags (tag cloud)
//      $this->calendar
//		$this->children	    = $this->get('Children');
//		$this->parent		= $this->get('Parent');
//      $this->author

        /** error handling **/
        if (count($errors = $this->get('Errors'))) {
            JError::raiseError(500, implode("\n", $errors));
            return false;
        }

        /** user object */
        $this->user = JFactory::getUser();


        if (JFactory::getApplication()->getName() == 'site') {

        } 

        $this->tempCount = 0;
        $path = $this->findPath($this->state->get('request.layout'));
        if ($path === false) {
          parent::display($tpl);
        } else {
          if ($this->get('request.id' == 0)) {
            echo $this->renderOutputItem ($path, 'driver_item.php');
          } else {
            echo $this->renderOutputList ($path, 'driver_list.php');
          }
        }
    }

    /**
     * Looks for path of $tpl as a layout folder, in this order:
     *
     * - CurrentTemplate/html/layouts/$tpl/
     * - components/com_thiscomponent/views/this_view/tmpl/$tpl/
     * - MOLAJO_LAYOUTS/$tpl/
     *
     * - defaults to normal Joomla View processing
     *
     * @param  $tpl
     * @return string
     */
    public function findPath ($tpl)
    {
        /** path: template **/
        $template = JFactory::getApplication()->getTemplate();
        $templatePath = JPATH_THEMES.'/'.$template.'/html/layouts/';

        /** path: component **/
        if (MOLAJO_APPLICATION == 'site') {
            $componentPath = JPATH_ROOT.'/components/'.$this->state->get('request.option').'/views/'.$this->state->get('request.view').'/tmpl/';
        } else {
            $componentPath = JPATH_ROOT.'/'.MOLAJO_APPLICATION.'/components/'.$this->state->get('request.option').'/views/'.$this->state->get('request.view').'/tmpl/';
        }

        /** path: core **/
        $corePath = MOLAJO_LAYOUTS.'/';

        /** template **/
        if (is_dir($templatePath.$tpl)) {
            return $templatePath.$tpl;

        /** component **/
        } else if (is_dir($componentPath.$tpl)) {
            return $componentPath.$tpl;

        /** molajao library **/
        } else if (is_dir($corePath.$tpl)) {
            return $corePath.$tpl;
        }

        return false;
    }

    /**
     * renderOutput
     *
     * @param  $path
     * @param  $driver
     * @return string
     */
    private function renderOutputItem ($path)
    {
        /** start collecting the output */
        ob_start();

        /**
         * Single Item Recordset
         *
         * Automatically includes the following files (if existing)
         *
         * A. Before first row => layoutFolder/layouts/header.php
         * B. For each row in the recordset => layoutFolder/layouts/body.php
         * C. After the last row in the recordset => layoutFolder/layouts/footer.php
         *
         */
        foreach ($this->recordset as $this->row) {

            $this->rowCount++;

            /** header - beginning of layout */
            if ($this->rowCount == 1) {
                if (file_exists($path.'/layouts/header.php')) {
                    include $path.'/layouts/header.php';
                }

                /** event: After Display of Title */
                echo $this->row->event->afterDisplayTitle;

                /** event: Before Content Display */
                echo $this->row->event->beforeDisplayContent;
            }

            /** body - once for each row in the recordset */
            if (file_exists($path.'/layouts/body.php')) {
                include $path.'/layouts/body.php';
            }
        }

        /** footer - end of layout */
        if (file_exists($path.'/layouts/footer.php')) {
            include $path.'/layouts/footer.php';
        }

        /** event: After Layout is finished */
        echo $this->row->event->afterDisplayContent;
                   
        /** collect output */
        $output = ob_get_contents();
        ob_end_clean();

        return $output;
    }

    /**
     * renderOutputPath
     *
     * @param  $path
     *
     * @return string
     */
    private function renderOutputList ($path)
    {
        /** start collecting the output */
        ob_start();

        /**
         * List Recordset
         *
         * Automatically includes the following files (if existing)
         *
         * A. Before first row => layoutFolder/layouts/header.php
         * B. For each row in the recordset => layoutFolder/layouts/body.php
         * C. After the last row in the recordset => layoutFolder/layouts/footer.php
         *
         */
        foreach ($this->recordset as $this->row) {

            $this->rowCount++;

            /** header - beginning of layout */
            if ($this->rowCount == 1) {
                if (file_exists($path.'/layouts/header.php')) {
                    include $path.'/layouts/header.php';
                }
            }

            if (file_exists($path.'/layouts/item_header.php')) {
                include $path.'/layouts/item_header.php';
            }

            /** event: After Display of Title */
            echo $this->row->event->afterDisplayTitle;

            /** event: Before Content Display */
            echo $this->row->event->beforeDisplayContent;

            /** body - once for each row in the recordset */
            if (file_exists($path.'/layouts/item_body.php')) {
                include $path.'/layouts/item_body.php';
            }

            if (file_exists($path.'/layouts/item_footer.php')) {
                include $path.'/layouts/item_footer.php';
            }
        }

        /** footer - end of layout */
        if (file_exists($path.'/layouts/footer.php')) {
            include $path.'/layouts/footer.php';
        }

        /** event: After Layout is finished */
        echo $this->row->event->afterDisplayContent;

        /** collect output */
        $output = ob_get_contents();
        ob_end_clean();

        return $output;
    }

    /**
     * _mergeParams - move this into the model for crying out loud
     *
     * @param  $this->recordset
     * @return void
     */
    private function _mergeParams ()
    {
		$active	= JFactory::getApplication()->getMenu()->getActive();
		$temp	= clone ($this->params);

		// Check to see which parameters should take priority
		if ($active) {
			$currentLink = $active->link;
			// If the current view is the active item and an article view for this article, then the menu item params take priority
			if ((int) $this->recordset->id == 0) {
				// Menu item params take priority over content params
				$this->params->merge($temp);

				// Load layout from active query (in case it is an alternative menu item)
				if (isset($active->query['layout'])) {
					$this->setLayout($active->query['layout']);
				}

			} else {
				// Current view is not a single article, so the article params take priority here
				// Merge the menu item params with the article params so that the article params take priority
				$temp->merge($this->params);
				$this->params = $temp;
			}

		} else {
			// Merge so that item params take priority
			$temp->merge($this->params);
			$this->params = $temp;
		}
    }

    /**
     * _triggerEvents
     *
     * @param  $context
     * @param  $this->recordset
     * @param  $params
     * @param  $offset
     * @param string $pluginType
     * @return void
     */
    private function _triggerEvents ()
    {
		$dispatcher	= JDispatcher::getInstance();
		JPluginHelper::importPlugin('content');

        $context = $this->options->get('request.option').'.'.$this->options->get('request.single_view');

		$results = $dispatcher->trigger('onContentPrepare', array ($context, $this->recordset, $this->params, $this->offset));
        $this->recordset->event = new stdClass();

		$results = $dispatcher->trigger('onContentAfterTitle', array($context, $this->recordset, $this->params, $this->offset));
		$this->recordset->event->afterDisplayTitle = trim(implode("\n", $results));

		$results = $dispatcher->trigger('onContentBeforeDisplay', array($context, $this->recordset, $this->params, $this->offset));
		$this->recordset->event->beforeDisplayContent = trim(implode("\n", $results));

		$results = $dispatcher->trigger('onContentAfterDisplay', array($context, $this->recordset, $this->params, $this->offset));
		$this->recordset->event->afterDisplayContent = trim(implode("\n", $results));

        return;
    }
}