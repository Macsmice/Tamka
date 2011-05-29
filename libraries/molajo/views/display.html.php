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
    protected $queryResults;
    protected $queryItem;
    protected $queryParameters;

    /** toolbar */
    protected $userToolbarButtonPermissions;

    /** blog variables */
	protected $category;
	protected $children;
	protected $lead_items = array();
	protected $intro_items = array();
	protected $link_items = array();
	protected $columns = 1;

    /** layout variables  **/
    protected $layoutHelper;
    protected $item;

    protected $listOrder;
    protected $listDirn;
    protected $saveOrder;
    protected $ordering;

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
        $this->state            = $this->get('State');
        $this->queryResults     = $this->get('Items');
        $this->pagination       = $this->get('Pagination');

        $this->option    = $this->state->get('request.option');
        var_dump($this->state);
        echo 'is this option? '.$this->option;

        die();
//		$this->category	    = $this->get('Category');
//		$this->children	    = $this->get('Children');
//		$this->parent		= $this->get('Parent');

        /** error handling **/
        if (count($errors = $this->get('Errors'))) {
            JError::raiseError(500, implode("\n", $errors));
            return false;
        }


        /** parameters */
        if (JFactory::getApplication()->getName() == 'site') {
            $this->params = JFactory::getApplication()->getParams();
//            $this->_mergeParams ();
        } else {
            $this->params = JComponentHelper::getParams(JRequest::getCmd('option'));
        }

        /** user object */
        $this->user = JFactory::getUser();

		/** Escape Pageclass Suffix */
		$this->options->get('page_class_suffix', '') = htmlspecialchars($this->params->get('pageclass_sfx'));

        if (JFactory::getApplication()->getName() == 'site') {
//            $documentHelper = new MolajoDocumentHelper ();
//            $documentHelper->prepareDocument($this->params, $this->item, $this->document, JRequest::getCmd('option'), JRequest::getCmd('view'));
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

        $this->tempCount = 0;

        /** layout **/
        $this->layoutHelper = new MolajoLayoutHelper();
        parent::display($tpl);
    }

    /**
     * _mergeParams
     *
     * @param  $this->queryResults
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
			if ((int) $this->queryResults->id == 0) {
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
     * _createLink
     *
     * @param  $this->queryResults
     * @return The
     */
    private function _createLink ()
    {
        $class = ucfirst(JRequest::getCmd('default_view')).'RouteHelper';
        $routerHelper = new $class ();
        $method = 'get'.ucfirst(JRequest::getCmd('single_view')).'Route';
        return JRoute::_($routerHelper->$method ($this->item->id, $this->item->catid, $this->item));
    }

    /**
     * _triggerEvents
     *
     * @param  $context
     * @param  $this->queryResults
     * @param  $params
     * @param  $offset
     * @param string $pluginType
     * @return void
     */
    private function _triggerEvents ()
    {

		$dispatcher	= JDispatcher::getInstance();
		JPluginHelper::importPlugin('content');

        $context = JRequest::getCmd('option').'.'.JRequest::getCmd('single_view');

		$results = $dispatcher->trigger('onContentPrepare', array ($context, $this->queryResults, $this->params, $this->offset));
        $this->queryResults->event = new stdClass();

		$results = $dispatcher->trigger('onContentAfterTitle', array($context, $this->queryResults, $this->params, $this->offset));
		$this->queryResults->event->afterDisplayTitle = trim(implode("\n", $results));

		$results = $dispatcher->trigger('onContentBeforeDisplay', array($context, $this->queryResults, $this->params, $this->offset));
		$this->queryResults->event->beforeDisplayContent = trim(implode("\n", $results));

		$results = $dispatcher->trigger('onContentAfterDisplay', array($context, $this->queryResults, $this->params, $this->offset));
		$this->queryResults->event->afterDisplayContent = trim(implode("\n", $results));

        return;
    }
}