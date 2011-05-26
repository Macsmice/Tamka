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
    /** model query results */
    protected $state;
    protected $items;
    protected $userToolbarButtonPermissions;
    protected $pagination;

    /** blog variables */
	protected $category;
	protected $children;
	protected $lead_items = array();
	protected $intro_items = array();
	protected $link_items = array();
	protected $columns = 1;

    /** layout variables  **/
    protected $print;
    protected $layoutHelper;
    protected $renderedOutput;
    protected $item;
    protected $params;
    protected $filterName;
    protected $filterValue;
    protected $optionsArray;
    protected $selectedValue;
    protected $itemCount;
    protected $listOrder;
    protected $listDirn;
    protected $saveOrder;
    protected $ordering;
    protected $columnspan;
    protected $results;

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
     * View for Display View, no Task
     *
     * @param null $tpl
     * @return void
     */
    public function display($tpl = null)
    {
        /** parameters */
        if (JFactory::getApplication()->getName() == 'site') {
            $this->params = JFactory::getApplication()->getParams();
            $this->_mergeParams ($this->item, $this->params, JRequest::getCmd('view'));
        } else {
            $this->params = JComponentHelper::getParams(JRequest::getCmd('option'));
        }

        /** user object */
        $this->user = JFactory::getUser();

        /** prepare data */
        if (JRequest::getVar('id') == 0) {
            $this->listView ();
        } else {
            $this->itemView ();
        }
        
		/** Escape Pageclass Suffix */
		$this->pageclass_sfx = htmlspecialchars($this->params->get('pageclass_sfx'));

        if (JFactory::getApplication()->getName() == 'site') {
            $documentHelper = new MolajoDocumentHelper ();
            $documentHelper->prepareDocument($this->params, $this->item, $this->document, JRequest::getCmd('option'), JRequest::getCmd('view'));
        } 

        /** layout **/
        parent::display($tpl);
    }

    /**
     * itemView
     *
     * Layout for a Single Content Item
     *
     * @return bool
     */
    public function itemView()
    {
        $this->state    = $this->get('State');
        $this->items     = $this->get('Items');

        /** turn $this->items into $this->item for single item layout */
        foreach ($this->items as $count=>$this->item) {}

        /** link */
        $this->item->readmore_link = $this->_createLink($this->item);

        /** trigger events */
        $this->_triggerEvents (JRequest::getCmd('option').'.'.JRequest::getCmd('single_view'), $this->item, $this->params, $offset, $pluginType='content');

        $this->print = JRequest::getBool('print');

//        $offset = $this->state->get('list.offset');

        // Check the view access to the article (the model has already computed the values).
//        if ($this->params->get('access-view') != true
//            && (($this->params->get('show_noauth') != true
//                 &&  $user->get('guest') ))) {
//                JError::raiseWarning(403, JText::_('JERROR_ALERTNOAUTHOR'));
//                return;
//        }
        return;
    }

    /**
     * listView
     *
     * @param null $tpl
     * @return bool
     */
    public function listView ()
    {
//		$this->category	    = $this->get('Category');
//		$this->children	    = $this->get('Children');
//		$this->parent		= $this->get('Parent');

        $this->state        = $this->get('State');
        $this->items        = $this->get('Items');
        $this->pagination   = $this->get('Pagination');

        /** error handling **/
        if (count($errors = $this->get('Errors'))) {
            JError::raiseError(500, implode("\n", $errors));
            return false;
        }

        /** page heading, toolbar buttons and submenu **/
        if (($this->getLayout() == 'modal') || (!JRequest::getCmd('format') == 'html')) {

        /** amy - make buttons a menu item/layout option - do not hardcode for specific layouts */
        } else {

            /** component level user permissions **/
            $aclClass = ucfirst(JRequest::getCmd('default_view')).'ACL';
            $this->userToolbarButtonPermissions = $aclClass::getUserToolbarButtonPermissions (JRequest::getCmd('option'), JRequest::getCmd('single_view'), JRequest::getCmd('task'));

            $toolbar = new MolajoToolbarHelper ();
            $toolbar->addButtonsDefaultLayout ($this->state->get('filter.state'), $this->userToolbarButtonPermissions);

            MolajoSubmenuHelper::add();
        }

        $this->itemCount = 0;
    }

    /**
     * _mergeParams
     *
     * @param  $item
     * @return void
     */
    private function _mergeParams ($item, $params, $viewName)
    {
		// Merge article params. If this is single-article view, menu params override article params
		// Otherwise, article params override menu item params
		$active	= JFactory::getApplication()->getMenu()->getActive();
		$temp	= clone ($params);

		// Check to see which parameters should take priority
		if ($active) {
			$currentLink = $active->link;
			// If the current view is the active item and an article view for this article, then the menu item params take priority
			if (strpos($currentLink, 'view='.$viewName) && (strpos($currentLink, '&id='.(string) $item->id))) {
				// Menu item params take priority over content params
				$params->merge($temp);

				// Load layout from active query (in case it is an alternative menu item)
				if (isset($active->query['layout'])) {
					$this->setLayout($active->query['layout']);
				}

			} else {
				// Current view is not a single article, so the article params take priority here
				// Merge the menu item params with the article params so that the article params take priority
				$temp->merge($params);
				$params = $temp;
			}

		} else {
			// Merge so that item params take priority
			$temp->merge($params);
			$params = $temp;
		}
    }

    /**
     * _createLink
     *
     * @param  $item
     * @return The
     */
    private function _createLink ($item)
    {
        $class = ucfirst(JRequest::getCmd('default_view')).'RouteHelper';
        $routerHelper = new $class ();
        $method = 'get'.ucfirst(JRequest::getCmd('single_view')).'Route';
        return JRoute::_($routerHelper->$method ($item->id, $item->catid, $item));
    }

    /**
     * _triggerEvents
     *
     * @param  $context
     * @param  $item
     * @param  $params
     * @param  $offset
     * @param string $pluginType
     * @return void
     */
    private function _triggerEvents ($context, $item, $params, $offset, $pluginType='content')
    {
		$dispatcher	= JDispatcher::getInstance();
		JPluginHelper::importPlugin('content');

		$results = $dispatcher->trigger('onContentPrepare', array (JRequest::getCmd('option').'.'.JRequest::getCmd('single_view'), $item, $params, $offset));

        $item->event = new stdClass();

		$results = $dispatcher->trigger('onContentAfterTitle', array($context, $item, $params, $offset));
		$item->event->afterDisplayTitle = trim(implode("\n", $results));

		$results = $dispatcher->trigger('onContentBeforeDisplay', array($context, $item, $params, $offset));
		$item->event->beforeDisplayContent = trim(implode("\n", $results));

		$results = $dispatcher->trigger('onContentAfterDisplay', array($context, $item, $params, $offset));
		$item->event->afterDisplayContent = trim(implode("\n", $results));

        return;
    }
}