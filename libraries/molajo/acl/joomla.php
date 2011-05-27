<?php
/**
 * @version     $id: core.php
 * @package     Molajo
 * @subpackage  Joomla ACL
 * @copyright   Copyright (C) 2011 Klas Berlič and Amy Stephen. All rights reserved.
 * @license     GNU General Public License Version 2, or later http://www.gnu.org/licenses/gpl.html
 */
defined('MOLAJO') or die;

/**
 * Joomla Core ACL
 *
 * @package	Joomla
 * @subpackage	ACL
 * @since	1.6
 */
class JoomlaACL extends ACL
{
    /**
     *  Joomla ACL - Called by the ACL Class
     *
     *  TYPE 0 --> No check needed (Cancel, Close, Help, Separator, etc.)
     *  TYPE 1 --> ACL::authoriseTask -> JoomlaACL:checkXYZAuthorisation -> direct back into one of three sub-types, below
     *  TYPE 2 --> ACL::getQueryParts -> Build query to filter rows Users are authorised to see and/or relates to the filter selected
     *  TYPE 3 --> ACL::getList -> Retrieves list of ACL-related data
     *  TYPE 4 --> ACL::getUserFormAuthorisations -> JoomlaACL::checkFormAuthorisations
     *  TYPE 5 --> ACL::getValue -> Retrieves specific value of ACL data (not yet)
     */

    /**
     *  TYPE 0 No check needed
     *
     *  @return boolean true
     */
    public function checkCancelAuthorisation ($option, $entity, $task, $catid, $id, $item)
    {
        return true;
    }
    public function checkCopyAuthorisation ($option, $entity, $task, $catid, $id, $item)
    {
        return true;
    }
    public function checkCloseAuthorisation ($option, $entity, $task, $catid, $id, $item)
    {
        return true;
    }
    public function checkMoveAuthorisation ($option, $entity, $task, $catid, $id, $item)
    {
        return true;
    }
    public function checkOpenAuthorisation ($option, $entity, $task, $catid, $id, $item)
    {
        return true;
    }
    public function checkHelpAuthorisation ($option, $entity, $task, $catid, $id, $item)
    {
        return true;
    }
    public function checkSeparatorAuthorisation ($option, $entity, $task, $catid, $id, $item)
    {
        return true;
    }

    /**
     *  TYPE 1:A Controller -> authoriseTask -> JoomlaACL::checkXYZAuthorisation --> JoomlaACL::checkTaskManage
     *
     *  Management tasks, such as accessing the Administrator area, updating configuration, and checking in content
     *
     *  Method below calls checkTask Manage and is called by ACL::authoriseTask which is called by a controller
     *
     *  checkAdminAuthorisation - Can User update the configuration data for the Component
     *  checkCheckInAuthorisation - Can User check-in Content for the Component
     *  checkManageAuthorisation - Can User access the Component from within the Administrator
     *
     *  @param string $option_value_literal ex. core.admin or core.manage.com_articles
     *  @param string $option ex. com_articles
     *
     *  @return boolean
     */
    public function checkTaskManage ($option, $entity, $task, $catid, $id, $item)
    {
        /** Molajo_Note: Can handle more than one test per task **/
        $molajoConfig = new MolajoModelConfiguration ();
        $taskTests = $molajoConfig->getOptionValueLiteral (MOLAJO_CONFIG_OPTION_ID_TASK_ACL_METHODS, $task);

        if (is_array($taskTests)) {
        } else {
            $taskTests = array($taskTests);
        }
        
        foreach ( $taskTests as $item )   {
            $authorised = JFactory::getUser()->authorise($item, $option);
            if ($authorised) {
                break;
            }
        }
        return $authorised;
    }
    /** members **/
    public function checkAdminAuthorisation ($option, $entity, $task, $catid, $id, $item)
    {
        return $this->checkTaskManage ($option, $entity, $task, $catid, $id, $item);
    }
    public function checkCheckinAuthorisation ($option, $entity, $task, $catid, $id, $item)
    {
        return $this->checkTaskManage ($option='com_checkin', $entity, $task, $catid, $id, $item);
    }
    public function checkManageAuthorisation ($option, $entity, $task, $catid, $id, $item)
    {
        return $this->checkTaskManage ($option, $entity, $task, $catid, $id, $item);
    }
    public function checkOptionsAuthorisation ($option, $entity, $task, $catid, $id, $item)
    {
        return $this->checkTaskManage ($option, $entity, 'admin', $catid, $id, $item);
    }

    /**
     *  TYPE 1:B Controller -> authoriseTask -> JoomlaACL::getDisplayAuthorisation --> JoomlaACL::checkTaskView
     *
     *  Display Task or View Access
     *
     *  Method below calls checkTaskView and is called by ACL::authoriseTask which is called by a controller
     *
     *  getDisplayAuthorisation - Can User view specific content for the Component
     *
     *  @param string $option - ex. com_articles
     *  @param string $entity - name of item, ex. 'article'
     *  @param string $task - ex save
     *  @param int $id - primary key of item
     *  @param array $item - array of item elements
     *  @param string $option_value_literal - ex core.save.article
     *
     *  @return boolean
     */
    public function checkTaskView ($option, $entity, $task, $catid, $id, $item)
    {
        return true; // for now

        $viewGroups = $this->getUsergroupsView();
        if (in_array($item->access, $viewGroups)) {
            return true;
        }
    }
    /** members **/
    public function checkDisplayAuthorisation ($option, $entity, $task, $catid, $id, $item)
    {
        return $this->checkTaskManage ($option, $entity, $task, $catid, $id, $item);
    }

    /**
     *  TYPE 1:C Controller -> authoriseTask -> JoomlaACL::getXZYAuthorisation --> JoomlaACL::checkTaskUpdate
     *
     *  Called from Controller to verify user authorisation for a specific Task
     *
     *  ACL authoriseTask Method calls one of below which calls JoomlaACL::checkTaskUpdate
     *
     *  checkAddAuthorisation - test before presenting the editor for a create
     *  checkApplyAuthorisation - create or save (check id)
     *  checkCreateAuthorisation - create
     *  checkDeleteAuthorisation - delete
     *  checkEditAuthorisation - test before presenting the editor for an update
     *  checkEditownAuthorisation - test before presenting the editor for an update
     *  checkEditstateAuthorisation - can update fields identified as 002 MOLAJO_CONFIG_OPTION_ID_EDITSTATE_FIELDS
     *  checkSaveAuthorisation - save
     *  checkSave2copyAuthorisation - view existing item and create new
     *  checkSave2newAuthorisation - view existing item and create new
     *  checkTrashAuthorisation - trash
     *  checkRestoreAuthorisation - restore
     *
     *  Access to Content Item and Primary Key, Category, Component and Global
     *  Matching TaskOwn methods checked before advancing to the next level
     *
     *  @param string $option - ex. com_articles
     *  @param string $entity - name of item, ex. 'article'
     *  @param string $task - ex save
     *  @param int $id - primary key of item
     *  @param array $item - array of item elements
     *  @param string $option_value_literal - ex core.save.article
     *
     *  @return boolean
     */
    public function checkTaskUpdate ($option, $entity, $task, $catid, $id, $item)
    {
        $molajoConfig = new MolajoModelConfiguration ();
        $taskTests = $molajoConfig->getOptionValueLiteral (MOLAJO_CONFIG_OPTION_ID_TASK_ACL_METHODS, $task);
        if (is_array($taskTests)) {
        } else {
            $taskTests = array($taskTests);
        }
        if (count($taskTests) == 0) {
            JError::raiseError(500, JText::_('MOLAJO_ACL_NOT_IDENTIFIED_TASK_ACL_METHOD'). ' '.$task);
            return false;
        }
        
        /** loop thru tests **/
        foreach ( $taskTests as $option_value_literal )   {
            if ($option_value_literal == '') {
                $authorised = true;
            } else {
                $authorised = $this->testAuthorisation ($option, $entity, $task, $catid, $id, $item, $option_value_literal);
            }
        }

        return $authorised;
    }

    /**
     * testAuthorisation
     *
     * called from checkTaskUpdate to look through (possibly) multiple ACL checks for a single task
     * @return <boolean>
     */
    public function testAuthorisation ($option, $entity, $task, $catid, $id, $item, $option_value_literal)
    {
        $authorised = false;

        if ((int) $id > 0) {
            $authorised = JFactory::getUser()->authorise($option_value_literal, $option.'.'.$entity.'.'.$id);

            if ($authorised === false) {
                $authorised = JFactory::getUser()->authorise($option_value_literal.'.own', $option.'.'.$entity.'.'.$id);

                if ($authorised === true) {
                    if ($item->created_by == JFactory::getUser()->get('id')) {
                        $authorised = true;
                    }
                }
            }
        }
        if ($authorised === false && (int) $catid > 0) {
            $authorised = JFactory::getUser()->authorise($option_value_literal, $option.'.'.'category'.'.'.$catid);
        } else if ($authorised === false) {
            $authorised = JFactory::getUser()->authorise($option_value_literal, $option);
        }

        return $authorised;
    }

    /** members **/
    public function checkAddAuthorisation ($option, $entity, $task, $catid, $id, $item)
    {
        return $this->checkTaskUpdate ($option, $entity, $task, $catid, $id, $item);
    }
    public function checkApplyAuthorisation ($option, $entity, $task, $catid, $id, $item)
    {
        return $this->checkTaskUpdate ($option, $entity, $task, $catid, $id, $item);
    }
    public function checkArchiveAuthorisation ($option, $entity, $task, $catid, $id, $item)
    {
        return $this->checkTaskUpdate ($option, $entity, $task, $catid, $id, $item);
    }
    public function checkCreateAuthorisation ($option, $entity, $task, $catid, $id, $item)
    {
        return $this->checkTaskUpdate ($option, $entity, $task, $catid, $id, $item);
    }
    public function checkDeleteAuthorisation ($option, $entity, $task, $catid, $id, $item)
    {
        return $this->checkTaskUpdate ($option, $entity, $task, $catid, $id, $item);
    }
    public function checkEditAuthorisation ($option, $entity, $task, $catid, $id, $item)
    {
        return $this->checkTaskUpdate ($option, $entity, $task, $catid, $id, $item);
    }
    public function checkEditownAuthorisation ($option, $entity, $task, $catid, $id, $item)
    {
        return $this->checkTaskUpdate ($option, $entity, $task, $catid, $id, $item);
    }
    public function checkEditstateAuthorisation ($option, $entity, $task, $catid, $id, $item)
    {
        return $this->checkTaskUpdate ($option, $entity, $task, $catid, $id, $item);
    }
    public function checkFeatureAuthorisation ($option, $entity, $task, $catid, $id, $item)
    {
        return $this->checkTaskUpdate ($option, $entity, $task, $catid, $id, $item);
    }
    public function checkNewAuthorisation ($option, $entity, $task, $catid, $id, $item)
    {
        return $this->checkTaskUpdate ($option, $entity, $task, $catid, $id, $item);
    }
    public function checkOrderupAuthorisation ($option, $entity, $task, $catid, $id, $item)
    {
        return $this->checkTaskUpdate ($option, $entity, $task, $catid, $id, $item);
    }
    public function checkOrderdownAuthorisation ($option, $entity, $task, $catid, $id, $item)
    {
        return $this->checkTaskUpdate ($option, $entity, $task, $catid, $id, $item);
    }
    public function checkPublishAuthorisation ($option, $entity, $task, $catid, $id, $item)
    {
        return $this->checkTaskUpdate ($option, $entity, $task, $catid, $id, $item);
    }
    public function checkReorderAuthorisation ($option, $entity, $task, $catid, $id, $item)
    {
        return $this->checkTaskUpdate ($option, $entity, $task, $catid, $id, $item);
    }
    public function checkRestoreAuthorisation ($option, $entity, $task, $catid, $id, $item)
    {
        return $this->checkTaskUpdate ($option, $entity, $task, $catid, $id, $item);
    }
    public function checkSaveAuthorisation ($option, $entity, $task, $catid, $id, $item)
    {
        return $this->checkTaskUpdate ($option, $entity, $task, $catid, $id, $item);
    }
    public function checkSave2copyAuthorisation ($option, $entity, $task, $catid, $id, $item)
    {
        return $this->checkTaskUpdate ($option, $entity, $task, $catid, $id, $item);
    }
    public function checkSave2newAuthorisation ($option, $entity, $task, $catid, $id, $item)
    {
        return $this->checkTaskUpdate ($option, $entity, $task, $catid, $id, $item);
    }
    public function checkSaveorderAuthorisation ($option, $entity, $task, $catid, $id, $item)
    {
        return $this->checkTaskUpdate ($option, $entity, $task, $catid, $id, $item);
    }
    public function checkSearchAuthorisation ($option, $entity, $task, $catid, $id, $item)
    {
        return $this->checkTaskUpdate ($option, $entity, $task, $catid, $id, $item);
    }
    public function checkSpamAuthorisation ($option, $entity, $task, $catid, $id, $item)
    {
        return $this->checkTaskUpdate ($option, $entity, $task, $catid, $id, $item);
    }
    public function checkStateAuthorisation ($option, $entity, $task, $catid, $id, $item)
    {
        return $this->checkTaskUpdate ($option, $entity, $task, $catid, $id, $item);
    }
    public function checkStickyAuthorisation ($option, $entity, $task, $catid, $id, $item)
    {
        return $this->checkTaskUpdate ($option, $entity, $task, $catid, $id, $item);
    }
    public function checkTrashAuthorisation ($option, $entity, $task, $catid, $id, $item)
    {
        return $this->checkTaskUpdate ($option, $entity, $task, $catid, $id, $item);
    }
    public function checkUnfeatureAuthorisation ($option, $entity, $task, $catid, $id, $item)
    {
        return $this->checkTaskUpdate ($option, $entity, $task, $catid, $id, $item);
    }
    public function checkUnpublishAuthorisation ($option, $entity, $task, $catid, $id, $item)
    {
        return $this->checkTaskUpdate ($option, $entity, $task, $catid, $id, $item);
    }
    public function checkUnstickyAuthorisation ($option, $entity, $task, $catid, $id, $item)
    {
        return $this->checkTaskUpdate ($option, $entity, $task, $catid, $id, $item);
    }

    /**
     *  TYPE 2 --> ACL::getQueryParts -> getXYZQueryParts
     * 
     *  Called by ACL::getQueryParts - which is called from Models and Field Filters to prepare query information
     *
     *  getUserQueryParts - returns query parts filtering access for the View Action for user
     *  getQueryPartsFilter - returns query parts filtering access for the ACL Filter Object Access
     *  getXYZQueryParts - anything that follows that pattern
     *
     *  @param object $query - query updated by method
     *  @param string $type - specifies the type of method
     *  @param array $params set of parameters needed by method to build query
     *  @return boolean
     */

    /**
     *  TYPE 2 --> ACL::getQueryParts -> getUserQueryParts
     */
    public function getUserQueryParts ($query, $type, $params)
    {
        $query->select('a.access');
        $query->select('ag.title AS access_level');

        $aclClass = ucfirst(strtolower(JRequest::getVar('default_view'))).'ACL';
        $groupList = $aclClass::getAuthorisedViewLevels();

        $query->where('a.access in ('.$groupList.')');
        $query->join('LEFT', '#__viewlevels AS ag ON a.access = ag.id');

        /** Molajo_note: come back and deal with edit and edit state capabilities
         * the way this is currently coded in core, users would not be able to update their articles
         * from a blog or list view unless they have core edit or edit state for all of a component
         *
         * Find a better way to restrict published information that only restricts what is needed

        if (JFactory::getUser()->authorise('core.edit.state', 'com_articles')
            || JFactory::getUser()->authorise('core.edit', 'com_articles')) {
        } else {
            $query->where('a.state in ('.MOLAJO_STATE_ARCHIVED.','.MOLAJO_STATE_PUBLISHED.')');

            $nullDate = $this->getDbo()->Quote($this->getDbo()->getNullDate());
            $nowDate = $this->getDbo()->Quote(JFactory::getDate()->toMySQL());

            $query->where('(a.publish_up = ' . $nullDate . ' OR a.publish_up <= ' . $nowDate . ')');
            $query->where('(a.publish_down = ' . $nullDate . ' OR a.publish_down >= ' . $nowDate . ')');
        }
        */
        return;
    }

    /**
     *  TYPE 2 --> ACL::getQueryParts -> getFilterQueryParts
     */
    public function getFilterQueryParts ($query, $type, $filterValue)
    {
        if ((int) $filterValue == 0) {
        } else {
            $query->where('a.access = '. (int) $filterValue);
        }
    }

    /**
     *  TYPE 3 --> ACL::getList -> Retrieves list of ACL-related data
     *
     *  Called by ACL::getList
     *
     *  getUserviewgroupList - produces a list of View Access Level Groups for User
     *  getUsergroupList - produces an array of the authorised access levels for the user
     *  getUsercategoriesList - produces a list of all categories that a user has permission for a given action
     *  getXYZList - any such pattern
     *
     *  @param string $type directs to method needed
     *  @param array $params set of parameters needed to produce the list
     *
     *  @return object list requested
     *  @return boolean
     */

    /**
     *  TYPE 3 --> ACL::getList -> getUserviewgroups
     */
    public function getUserviewgroupsList ($option, $task, $params=array())
    {
        $groups	= JAccess::getAuthorisedViewLevels(JFactory::getUser()->get('id'));
        return implode(',', array_unique($groups));
    }

    /**
     *  TYPE 3 --> ACL::getList -> getUsergroupList
     */
    public function getUsergroupsList ($option, $task, $params=array())
    {
        $groups	= JFactory::getUser()->getAuthorisedGroups();
        return implode(',', array_unique($groups));
    }
    
    /**
     *  TYPE 3 --> ACL::getList -> getUsercategoriesList
     */
    public function getUsercategoriesList ($option, $task, $params=array())
    {
        $molajoConfig = new MolajoModelConfiguration ();
        $taskTests = $molajoConfig->getOptionValueLiteral (MOLAJO_CONFIG_OPTION_ID_TASK_ACL_METHODS, $task);
        if (is_array($taskTests)) {
        } else {
            $taskTests = array($taskTests);
        }
        $categories = array();
        foreach ( $taskTests as $action )   {
            $authorised =  JFactory::getUser()->getAuthorisedCategories($option, $action->option_value_literal);
            if (count($authorised) > 0 && is_array($authorised)) {
                $categories = array_merge($authorised, $categories);
            }
        }
        return implode(',', array_unique($categories));
    }

    /**
     * getAllUserGroups
     *
     * Get all defined groups
     * @return array
     */
    public function getAllusergroupsList ($option='', $task='', $params=array())
    {
		$db = JFactory::getDBO();
		$db->setQuery(
			'SELECT a.id AS value, a.title AS text, COUNT(DISTINCT b.id) AS level' .
			' FROM #__usergroups AS a' .
			' LEFT JOIN `#__usergroups` AS b ON a.lft > b.lft AND a.rgt < b.rgt' .
			' GROUP BY a.id' .
			' ORDER BY a.lft ASC'
		);
		$options = $db->loadObjectList();
		return $options;
	}
    /**
     *  TYPE 4 --> ACL::getUserFormAuthorisations -> JoomlaACL::checkFormAuthorisations
     *
     *  Disables form fields that required editstate for those without such authorisation
     *
     *  @param string $option 'com_articles', etc.
     *  @param string $entity 'article', or 'comment', etc.
     *  @param string $task 'add', 'delete', 'publish'
     *  @param integer $id - primary key for content
     *  @param object $form - form object fields
     *  @param object $item - item data
     *
     *  @return object list requested
     *  @return boolean
     */
    public function checkFormAuthorisations ($option, $entity, $task, $id, $form, $item)
    {
        if ($item->canEditstate === true) {
            return;
        }
        $molajoConfig = new MolajoModelConfiguration ();
        $fieldsEditState = $molajoConfig->getOptionList (MOLAJO_CONFIG_OPTION_ID_EDITSTATE_FIELDS);
        foreach ($fieldsEditState as $count => $editstateItem ) {
            $form->setFieldAttribute($editstateItem->value, 'disabled', 'true');
            $form->setFieldAttribute($editstateItem->value, 'filter', 'unset');
        }
    }
    
    /**
     * checkComponentTaskAuthorisation
     *
     * Method to return a list of all categories that a user has permission for a given ACL Action
     *
     *  @param      string      $component
     *  @param      string      $action
     *  @return     boolean
     */
    public function checkComponentTaskAuthorisation ($option, $option_value_literal)
    {
        return JFactory::getUser()->getAuthorisedCategories($option, $option_value_literal);
    }
}