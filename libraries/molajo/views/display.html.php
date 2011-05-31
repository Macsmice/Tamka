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

        $this->state         = $this->get('State');
        $this->params        = $this->get('Params');
        $this->recordset     = $this->get('Items');

/**
$this->document
$this->configuration
$this->user

$this->options
Parameters (Includes Filters, Global Options, Menu Item, Item)
$this->state->get('filter.category')
$this->params->get('layout_show_page_heading', 1)
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
//JText::_('MOLAJO_PUBLISHED_DATE')
//JHtml::_('form.token')
//echo JHtml::_('icon.edit', $this->row, $this->options);
//$this->options->get('css_page_class_suffix', '')
//JForm
// echo a custom field
// insert a content plugin
//
        $this->tempCount = 0;

        /** layout **/
        $this->layoutHelper = new MolajoLayoutHelper();

        parent::display($tpl);
    }

    /**
     * _mergeParams - move this into the model for crying out loud
     *
     * @param  $this->recordset
     * @return void
     */
    private function _mergeParams ()
    {
		// Merge article params. If this is single-article view, menu params override article params
		// Otherwise, article params override menu item params
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