<?php
/**
 * @version     $id: single.html.php
 * @package     Molajo
 * @subpackage  Single View
 * @copyright   Copyright (C) 2011 Amy Stephen. All rights reserved.
 * @license     GNU General Public License Version 2, or later http://www.gnu.org/licenses/gpl.html
 */
defined('MOLAJO') or die;

/**
 *  MolajoViewEdit
 *
 *  Single Content Item
 *
 * @package	Molajo
 * @subpackage	Single View
 * @since	1.6
 */
class MolajoViewEdit extends JView
{
    /** data */
    protected $state;
    protected $item;

    /** editor variables  **/
    protected $section;
    protected $form;
    protected $toolbar;
    protected $slider_id;
    protected $fieldsetName;
    protected $userToolbarButtonPermissions;
    protected $isNew;

    /** common */
    protected $params;
    protected $layoutHelper;
    protected $print;
    protected $user;
    protected $pageclass_sfx;

    /**
     * display
     *
     * retrieves data from the model and displays the form
     *
     * @param null $tpl
     * @return bool
     */
    public function display($tpl = null)
    {
        $this->form   = $this->get('Form');
        $this->item   = $this->get('Item');
        $this->state  = $this->get('State');

        if (count($errors = $this->get('Errors'))) {
            JError::raiseError(500, implode("\n", $errors));
            return false;
        }

        /** parameters */
        if (JFactory::getApplication()->getName() == 'site') {
            $this->params = JFactory::getApplication()->getParams();
            //$this->_mergeParams ($this->item, $this->params, JRequest::getVar('option'));
        } else {
            $this->params = JComponentHelper::getParams(JRequest::getVar('option'));
        }

        $this->user = JFactory::getUser();

        /** id */
        if ($this->item->id == null) {
            $this->isNew = true;
            $this->slider_id = 0;
            $this->item->id = 0;
            $this->item->catid = 0;
            $this->item->state = 0;
        } else {
            $this->isNew = false;
            $this->slider_id = $this->item->id;
        }

        /** ACL: form field authorisations **/
        $aclClass = ucfirst(JRequest::getCmd('default_view')).'ACL';
        $aclClass::getUserFormAuthorisations (JRequest::getVar('option'), JRequest::getVar('single_view'), JRequest::getVar('task'), $this->item->id, $this->form, $this->item);

        /** ACL: component level authorisations **/
        $this->userToolbarButtonPermissions = $aclClass::getUserToolbarButtonPermissions (JRequest::getVar('option'), JRequest::getVar('single_view'), JRequest::getVar('task'));

        /** page heading, toolbar buttons and submenu **/
        if (($this->getLayout() == 'modal') || (!JRequest::getCmd('format') == 'html')) {
//        } else if (JFactory::getApplication()->getName() == 'site') {
        } else {
            $molajoToolbar = new MolajoToolbarHelper ();
            $molajoToolbar->addButtonsEditLayout ($this->item->state, $this->userToolbarButtonPermissions, $this->item->id, $this->item);
        }

		//Escape strings for HTML output
		$this->pageclass_sfx = htmlspecialchars($this->params->get('pageclass_sfx'));

        if (JFactory::getApplication()->getName() == 'site') {
            $documentHelper = new MolajoDocumentHelper ();
            $documentHelper->prepareDocument($this->params, $this->item, $this->document, JRequest::getCmd('option'), JRequest::getCmd('view'));
        }

        /** layout **/
        parent::display($tpl);
    }
}
