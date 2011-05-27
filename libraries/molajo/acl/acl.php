<?php
/**
 * @version     $id: acl.php
 * @package     Molajo
 * @subpackage  ACL 
 * @copyright   Copyright (C) 2011 Amy Stephen. All rights reserved.
 * @license     GNU General Public License Version 2, or later http://www.gnu.org/licenses/gpl.html
 */
defined('MOLAJO') or die;

class ACL
{
    /**
    *  Type 1 --> authoriseTask
    *
    *  Called from Controllers to verify user authorisation for a specific Task
    *
    *  authoriseTask determines the implemented ACL class and runs appropriate checkTASKAuthorisation method(s)
    *
    *  @param      string      $option - component ex. com_articles
    *  @param      string      $entity - singular form of component subject ex. article, comment
    *  @param      string      $task - all tasks handled in the code must be defined by member ex. display, add, delete
    *  @param      int         $id - primary key of the item or the value 0
    *  @param      array       $item - table row related to the id or an empty array
    *
    *  @return     boolean
    *  @since      1.6
    */
    public function authoriseTask ($option, $entity, $task, $catid = 0, $id = 0, $item = array())
    {
        $authoriseTaskMethod = 'check'.ucfirst(strtolower($task)).'Authorisation';
        $class = ACL::getMethodClass ($authoriseTaskMethod);
        if ($class == false) {
            return false;
        }

        $aclClass = new $class();
        if (method_exists($aclClass,$authoriseTaskMethod)) {
            return $aclClass->$authoriseTaskMethod ($option, $entity, $task, $catid, $id, $item);
        } else {
            JError::raiseError(403, JText::_('MOLAJO_ACL_CLASS_METHOD_NOT_FOUND'). ' '.$aclClass.'::'.$authoriseTaskMethod);
            return false;
        }
    }

    /**
     * getUserItemPermissions
     *
     * Evaluates set of tasks for current item for current users's authorisation and adds column for each task with results
     *
     * Note: No ACL Implementation needed as this uses the existing Task/ACL Permission processes
     *
     * @param string $option 'com_articles', etc.
     * @param string $entity 'article', or 'comment', etc.
     * @param string $task 'add', 'delete', 'publish'
     * @param integer $id - primary key for content
     * @param object $item - item columns and values
     * @return boolean
     */
    public function getUserItemPermissions ($option, $entity, $task, $catid, $id, $item)
    {
        $molajoConfig = new MolajoModelConfiguration ();
        $tasks = $molajoConfig->getOptionList (MOLAJO_CONFIG_OPTION_ID_ACL_ITEM_TESTS);

        foreach ( $tasks as $single )   {
            $taskName = strtolower($single->value);
            $aclResults = ACL::authoriseTask ($option, $entity, $taskName, $catid, $id, $item);
            $itemFieldname = 'can'.ucfirst(strtolower($taskName));
            $item->$itemFieldname = $aclResults;
        }
        return;
    }

    /**
     * getUserToolbarButtonPermissions
     *
     * Loops thru the list of buttons identified for current Toolbar Button Tasks, evaluates authorisation for current user,
     *      and passes back an array with results
     *
     * Note: No ACL Implementation needed as this uses the existing Task/ACL Permission processes
     *
     * @param string $option 'com_articles', etc.
     * @param string $entity 'article', or 'comment', etc.
     * @param string $task 'add', 'delete', 'publish'
     *
     * @return array
     */
    public function getUserToolbarButtonPermissions ($option, $entity, $task)
    {
        /** component parameters **/
        $params = JComponentHelper::getParams($option);
        if ($task == 'add') {
            $taskButtons = 'config_manager_editor_button_bar_new_option';
        } else if ($task == 'edit') {
            $taskButtons = 'config_manager_editor_button_bar_edit_option';
        } else {
            $taskButtons = 'config_manager_button_bar_option';
        }
        
        /** loop thru config options and add ToolBar buttons **/
        $count = 0;
        $loadedButtonArray = array();
        $userToolbarButtonPermissions = array();

        for ($i=1; $i < 99; $i++) {

            $buttonValue = $params->def($taskButtons.$i, null);

            if ($buttonValue == null) {
               break;
            }
            if ($buttonValue == '0') {

            } else if (in_array($buttonValue, $loadedButtonArray)) {

            } else {
                $loadedButtonArray[] = $buttonValue;
                $aclResults = ACL::authoriseTask ($option, $entity, $buttonValue, 0, 0, array());
                $userToolbarButtonPermissions[$buttonValue] = $aclResults;
            }
        }
        return $userToolbarButtonPermissions;
    }

    /**
    *  Type 2 --> getQueryParts
    *
    *  Called from Models and Field Filters to prepare query information
    *
    *  ACL Implementations methods needed for:
    *
    *  getUserQueryParts - returns query parts filtering access for the View Action for user
    *  getQueryPartsFilter - returns query parts filtering access for the ACL Filter Object Access
    *  getXYZQueryParts - anything that follows that pattern
    *
    *  @return     boolean
    *  @since      1.6
    */
    public function getQueryParts ($query, $type, $filterValue=null)
    {
        $method = 'get'.ucfirst(strtolower($type)).'QueryParts';
        $aclClass = ACL::getMethodClass ($method);
        if ($aclClass == false) {
            return false;
        }
        return $aclClass::$method ($query, $type, $filterValue);
    }

    /**
     * TYPE 3 --> Retrieve lists for User
     *
     * Provides User and Filter View Action Query Select Information
     * 
     *  ACL Implementations methods needed for:
     *
     *  getUserviewgroupsList - produces a list of View Access Level Groups for User
     *  getUsergroupsList - produces an array of the authorised access levels for the user
     *  getUsercategoriesList - produces a list of all categories that a user has permission for a given action
     *  getXYZList - any such pattern
     */
    public function getList ($type, $option='', $task='', $params=array())
    {
        $method = 'get'.ucfirst(strtolower($type)).'List';
        $aclClass = ACL::getMethodClass ($method);
        if ($aclClass == false) {
            return false;
        }
        return $aclClass::$method ($option, $task, $params);
    }
    /**
     * @deprecated 1.6	Use the getList method instead.
     */
    public function getAuthorisedViewLevels ()
    {
        return ACL::getList ('Userviewgroups', $option='', $task='', $params=array());
    }
    /**
     * @deprecated 1.6	Use the getList method instead.
     */
    public function getAuthorisedGroups ()
    {
        return ACL::getList ('Usergroups', $option='', $task='', $params=array());
    }
    /**
     * @deprecated 1.6	Use the getList method instead.
     */
    public function getAuthorisedCategories ($option, $task)
    {
        return ACL::getList ('Usercategories', $option, $task, $params=array());
    }
    /**
     * @deprecated 1.6	Use the getList method instead.
     */
    public function getUserGroups ()
    {
        return ACL::getList ('AllUserGroups');
    }

    /**
    *  Type 4 --> getUserFormAuthorisations
    *
    *  checkFormAuthorisations
    *
    *  Evaluates set of form fields for current users's authorisation to hide or disable fields from update, if needed
    *
    *  @param string $option 'com_articles', etc.
    *  @param string $entity 'article', or 'comment', etc.
    *  @param string $task 'add', 'delete', 'publish'
    *  @param integer $id - primary key for content
    *  @param object $form - form object fields
    *  @return boolean
    */
    public function getUserFormAuthorisations ($option, $entity, $task, $id, $form, $item)
    {
        $method = 'checkFormAuthorisations';
        $class = ACL::getMethodClass ($method);
        if ($class == false) {
            return false;
        }

        $aclClass = new $class();
        if (method_exists($aclClass, $method)) {
            $aclClass->$method ($option, $entity, $task, $id, $form, $item);
        } else {
            JError::raiseError(403, JText::_('MOLAJO_ACL_CLASS_METHOD_FORM_AUTH_NOT_FOUND'). ' '.$aclClass.'::'.$method);
            return false;
        }
    }

    /**
    * getMethodClass
    *
    * Finds first class::method available in component, ACL Option implemented, then default ACL
    *
    * @param string $method
    * @return string $class
    */
    public function getMethodClass ($method)
    {
        $componentClass = ucfirst(strtolower(JRequest::getVar('default_view'))).'ACL';
        if (class_exists($componentClass)) {
            if (method_exists($componentClass,$method)) {
                return $componentClass;
            }
        }
        $implementedClass = ucfirst(strtolower(JRequest::getVar('aclImplementation', 'core'))).'ACL';
        if (class_exists($implementedClass)) {
            if (method_exists($implementedClass,$method)) {
                return $implementedClass;
            }
        }

        $default_class = 'JoomlaACL';
        if (class_exists($default_class)) {
            if (method_exists($default_class,$method)) {
                return $default_class;
            } else {
                JError::raiseError(403, JText::_('MOLAJO_ACL_CLASS_METHOD_NOT_FOUND'). ' '.$default_class.'::'.$method);
                return false;
            }
        } else {
            JError::raiseError(403, JText::_('MOLAJO_ACL_DEFAULT_CLASS_NOT_FOUND'). ' '.$default_class);
            return false;
        }
    }
}