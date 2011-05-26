<?php
/**
 * @version     $id: com_installer
 * @package     Molajo
 * @subpackage  Create
 * @copyright   Copyright (C) 2011 Amy Stephen. All rights reserved.
 * @license     GNU General Public License Version 2, or later http://www.gnu.org/licenses/gpl.html
 */
defined('MOLAJO') or die;
require_once JPATH_COMPONENT.'/views/default/view.php';

/**
 * Extension Manager Update View
 *
 * @package		Joomla.Administrator
 * @subpackage	com_installer
 * @since		1.6
 */
class InstallerViewCreate extends InstallerViewDefault
{
    /**
     * @since	1.6
     */
    function display($tpl=null)
    {
        $this->_addPath('template', COM_INSTALLER_OVERRIDES.'/com_installer/views/create/tmpl');
        $state	= $this->get('State');

        $showMessage	= false;
        if (is_object($state)) {
            $message1		= $state->get('message');
            $message2		= $state->get('extension_message');
            $showMessage	= ($message1 || $message2);
        }

        $this->assign('showMessage',	$showMessage);
        $this->assignRef('state', $state);
        JHtml::_('behavior.tooltip');

        parent::display($tpl);
    }

    /**
     * addToolbar
     *
     * Add the page title and toolbar.
     *
     * @since	1.6
     */
    protected function addToolbar()
    {
        $canDo	= InstallerHelper::getActions();
        JToolBarHelper::title(JText::_('PLG_SYSTEM_CREATE_HEADER_' . $this->getName()), 'install.png');

        if ($canDo->get('core.admin')) {
            JToolBarHelper::preferences('com_installer');
            JToolBarHelper::divider();
        }
        JToolBarHelper::help('JHELP_EXTENSIONS_EXTENSION_MANAGER_INSTALL');

        $document = JFactory::getDocument();
        $document->setTitle(JText::_('PLG_SYSTEM_CREATE_TITLE_' . $this->getName()));
    }
}