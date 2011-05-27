<?php
/**
 * @version     $id: multiple.php
 * @package     Molajo
 * @subpackage  Multiple Model
 * @copyright   Copyright (C) 2011 Amy Stephen. All rights reserved.
 * @license     GNU General Public License Version 2, or later http://www.gnu.org/licenses/gpl.html
 */
defined('MOLAJO') or die;

/**
 * Component Model Multiple Items
 *
 * MolajoModelDisplay extends JModel extends JObject
 *
 * @package	Molajo
 * @subpackage	Model
 * @since 1.6
 */
class MolajoModelDisplay extends JModel
{
    /**
     * $params
     *
     * @var		string
     * @since	1.6
     */
    protected $params = null;

    /**
     * $query
     *
     * @var		string
     * @since	1.6
     */
    protected $query = null;

    /**
     * $parameterFilterFieldName
     *
     * @var		string
     * @since	1.6
     */
    protected $parameterFilterFieldName = null;

    /**
     * Internal memory based cache array of data.
     *
     * @var		array
     * @since	1.6
     */
    protected $cache = array();

    /**
     * Context string for the model type.  This is used to handle uniqueness
     * when dealing with the getStoreId() method and caching data structures.
     *
     * @var		string
     * @since	1.6
     */
    protected $context = null;

    /**
     * Valid filter fields or ordering.
     *
     * @var		array
     * @since	1.6
     */
    protected $filter_fields = array();

    /**
     * Valid fields in table for verifying to select list and ordering values
     *
     * @var		array
     * @since	1.6
     */
    protected $tableFieldList = array();
  
    /**
     * Model Object for Molajo configuration 
     *
     * @var		array
     * @since	1.6
     */
    protected $molajoConfig = array();  
    
    /**
     * Molajo Field Class 
     *
     * @var		array
     * @since	1.6
     */
    protected $molajoField = array(); 

    /**
     * __construct
     *
     * Constructor.
     *
     * @param	array	An optional associative array of configuration settings.
     * @since	1.6
     */
    public function __construct($config = array())
    {
        parent::__construct($config);

        $this->context = strtolower(JRequest::getVar('option').'.'.$this->getName());
        $this->params = JComponentHelper::getParams(JRequest::getVar('option'));
        $this->parameterFieldName = JRequest::getCmd('filterFieldName', 'config_manager_list_filters');
        $this->molajoConfig = new MolajoModelConfiguration();
        $this->molajoField  = new MolajoField();
    }

    /**
     * getState
     *
     * Do _not_ override getState - JModel::getState
     *
     * JModel::getState checks if the state has been set, if it hasn't then _it_ calls populateState
     * ...unless $config['ignore_request'] is true, in which case it will not populateState
     *
     */

    /**
     * populateState
     * Method to auto-populate the model state.
     *
     * @return	void
     * @since	1.6
     */
    protected function populateState ($ordering = 'ordering', $direction = 'ASC')
    {
        if (JRequest::getInt('id') == 0) {
            $this->populateStateMultiple ($ordering, $direction);
        } else {
            $this->populateItemState ();
        }

        /** layout **/
        $this->setState('layout', JRequest::getCmd('layout'));
        if (trim(JRequest::getVar('layout', '')) == '') {
        } else {
            $this->context .= '.'.JRequest::getVar('layout');
        }
        /** extract actual column names from table for use verifying select list (below) and ordering values **/
        $table	= $this->getTable();
        $fields = $table->getProperties();

        $this->tableFieldList = array();
        foreach ($fields as $fieldname => $value) {
            $this->tableFieldList[] = $fieldname;
        }
    }

    /**
     * populateStateMultiple
     * Method to auto-populate the model state.
     *
     * @return	void
     * @since	1.6
     */
    protected function populateStateMultiple ($ordering = 'ordering', $direction = 'ASC')
    {
        /** search **/
        $this->processFilter ('search');

        /** filters **/
        $loadFilterArray = array();

        /** always do state filter **/
        $loadFilterArray[] = 'state';
        $this->processFilter('state');

        /** force title filter for restore list **/
        if ($this->state->get('filter.state') == MOLAJO_STATE_VERSION) {
            $loadFilterArray[] = 'title';
            $this->processFilter('title');
        }

        /** selected filters **/
        for ($i=1; $i < 1000; $i++) {

            $filterName = $this->params->def($this->parameterFieldName.$i);

            /** end of filter processing **/
            if ($filterName == null) { break; }

            /** state already processed **/
            if ($filterName == 'state') {

            /** configuration option not selected **/
            } else if ($filterName == '0') {

            /** no filter was selected for configuration option **/
            } else if (in_array($filterName, $loadFilterArray)) {

            /** process selected filter **/
            } else {
                $loadFilterArray[] = $filterName;
                $this->processFilter($filterName);
            }
        }

        /** layout **/
        $this->setState('layout', JRequest::getCmd('layout'));
        if (trim(JRequest::getVar('layout', '')) == '') {
        } else {
            $this->context .= '.'.JRequest::getVar('layout');
        }

        /** extract actual column names from table for use verifying select list (below) and ordering values **/
        $table	= $this->getTable();
        $fields = $table->getProperties();

        $this->tableFieldList = array();
        foreach ($fields as $fieldname => $value) {
            $this->tableFieldList[] = $fieldname;
        }

        /** list limit **/
        $value = (int) JFactory::getApplication()->getUserStateFromRequest('global.list.limit', 'limit', JFactory::getApplication()->getCfg('list_limit'));
        $limit = $value;
        $this->setState('list.limit', (int) $limit);

        /** list start **/
        $value = JFactory::getApplication()->getUserStateFromRequest($this->context.'.limitstart', 'limitstart', 0);
        $limitstart = ($limit != 0 ? (floor($value / $limit) * $limit) : 0);
        $this->setState('list.start', (int) $limitstart);

        /** ordering by field **/
        $ordering = 'a.title';
        $value = JFactory::getApplication()->getUserStateFromRequest($this->context.'.ordercol', 'filter_order', $ordering);
        if (strpos($value, 'a.')) {
            $searchValue = substr($value, (strpos($value, 'a.') + 1), strlen($value) - strpos($value, 'a.'));
        } else {
            $searchValue = $value;
        }
        if (in_array($searchValue, $this->tableFieldList)) {
            $ordering = $value;
        } else {
            $ordering = 'a.title';
        }
        JFactory::getApplication()->setUserState($this->context.'.ordercol', $ordering);
        
        $this->setState('list.ordering', $value);

        if (in_array($value, $this->tableFieldList)) {
            $ordering = $value;
        } else {
            $ordering = 'a.title';
        }

        /** ordering direction **/
        $direction = 'ASC';
        $value = JFactory::getApplication()->getUserStateFromRequest($this->context.'.orderdirn', 'filter_order_Dir', $direction);
        if (in_array(strtoupper($value), array('ASC', 'DESC', ''))) {
        } else {
            $value = $direction;
            JFactory::getApplication()->setUserState($this->context.'.orderdirn', $value);
        }
        $this->setState('list.direction', $value);

        return;
    }

    /**
     * populateItemState
     * Method to populate state values needed for Item Layout
     *
     * @return	void
     * @since	1.6
     */
    protected function populateItemState ()
    {
        JRequest::setVar('filter_Id', (int) JRequest::getInt('id'));
        $loadFilterArray[] = 'id';
        $this->processFilter('id');
    }

    /**
     * processFilter
     *
     * Retrieves filter value
     *
     * @param string $filterName
     * @return boolean
     */
    protected function processFilter ($filterName)
    {
        /** class name **/
        $fieldClassName = 'MolajoField'.ucfirst($filterName);

        /** class file **/
        $this->molajoField->requireFieldClassFile ($filterName);

        /** class instantiation **/
        if (class_exists($fieldClassName)) {
            $molajoSpecificFieldClass = new $fieldClassName();
        } else {
            JFactory::getApplication()->enqueueMessage(JText::_('MOLAJO_INVALID_FIELD_CLASS').' '.$fieldClassName, 'error');
            return false;
        }

        /** retrieve filtered, validated value **/
        $filterValue = $molajoSpecificFieldClass->getSelectedValue();

        /** set state **/
        $this->setState('filter.'.$filterName, $filterValue);

        return true;
    }

    /**
     * getItems
     *
     * Method to get a list of content and convert JSON fields to arrays
     *
     * @return	mixed	An array of objects on success, false on failure.
     * @since	1.6
     */
    public function getItems()
    {
$debug = false;

if ($debug) {
    echo 'in getItems';
}
        /** session key for caching resultset **/
        $store = $this->getStoreId();
        if (empty($this->cache[$store])) {
        } else {
            return $this->cache[$store];
        }

        /** query **/
        $query	= $this->getListQueryCache();

        /** query results **/
        $items = $this->_getList($query, $this->getStart(), $this->getState('list.limit'));

        if ($this->_db->getErrorNum()) {
            $this->setError($this->_db->getErrorMsg());
            return false;
        }

        /** publish dates **/
        $nullDate = $this->_db->Quote($this->_db->getNullDate());
        $nowDate = $this->_db->Quote(JFactory::getDate()->toMySQL());

        /** retrieve names of json fields for this type of content **/
        $jsonFields = $this->molajoConfig->getOptionList (MOLAJO_CONFIG_OPTION_ID_JSON_FIELDS);
if ($debug) {
    var_dump($jsonFields);
}
        /** ACL **/
        $aclClass = ucfirst(JRequest::getCmd('default_view')).'ACL';

        /** process query results **/
        if (count($items) > 0) {

            for ($i=0; $i < count($items); $i++) {

                $remove = false;

                /** category is archived, so item should be too **/
                if ($items[$i]->minimum_state_category < $items[$i]->state && $items[$i]->state > MOLAJO_STATE_VERSION) {
                    $items[$i]->state = $items[$i]->minimum_state_category;
                    /** recheck the new status against query filter **/
                    if ($this->getState('filter.state') > $items[$i]->state) {
                        $remove = true;
                    }
                }

                /** category is unpublished, spammed, or trashed, so item should be too **/
                if ($items[$i]->archived_category == 1 && $items[$i]->state < MOLAJO_STATE_ARCHIVED) {
                    $items[$i]->state = MOLAJO_STATE_ARCHIVED;
                    /** recheck the new status against query filter **/
                    if ($this->getState('filter.state') == MOLAJO_STATE_ARCHIVED || $this->getState('filter.state') =='*') {
                    } else {
                        $remove = true;
                    }
                }

                /** check publish dates **/
//        $query->where('(a.publish_up = ' . $nullDate . ' OR a.publish_up <= ' . $nowDate . ')');
//        $query->where('(a.publish_down = ' . $nullDate . ' OR a.publish_down >= ' . $nowDate . ')');

                /** remove item overridden by category and no longer valid for criteria **/
                if ($remove === true) {
                    unset($items[$i]);
                } else {

                    /** split into intro text and full text */
                    $pattern = '#<hr\s+id=("|\')system-readmore("|\')\s*\/*>#i';
                    $tagPos	= preg_match($pattern, $items[$i]->content_text);

                    if ($tagPos == 0) {
                        $introtext = $items[$i]->content_text;
                        $fulltext  = '';
                    } else {
                        list($introtext, $fulltext) = preg_split($pattern, $items[$i]->content_text, 2);
                    }

                    $items[$i]->introtext = $introtext;
                    $items[$i]->fulltext = $fulltext;

                    /** some content plugins expect column named text */
                    if ($this->params->get('show_intro','1') == '1') {
                        $items[$i]->text = $items[$i]->introtext.' '.$items[$i]->fulltext;
                    } else if ($items[$i]->fulltext) {
                        $items[$i]->text = $items[$i]->fulltext;
                    } else {
                        $items[$i]->text = $items[$i]->introtext;
                    }

                    if ($items[$i]->created_by_alias == '') {
                        $items[$i]->display_author_name = $items[$i]->author_name;
                    } else {
                        $items[$i]->display_author_name = $items[$i]->created_by_alias;
                    }

                    /** Perform JSON to array conversion... **/
                    foreach ($jsonFields as $field) {
                        $attribute = $field->value;
                        if (property_exists($items[$i], $attribute)) {
                            $registry = new JRegistry;
                            $registry->loadJSON($items[$i]->$attribute);
                            $items[$i]->$attribute = $registry->toArray();
                        }
                    }
//Event OnContentQueryItem
     
                    /** acl-append item-specific task permissions **/
                    $results = $aclClass::getUserItemPermissions (JRequest::getCmd('option'), JRequest::getCmd('single_view'), JRequest::getVar('task'), $items[$i]->id, $items[$i]->category_id, $items[$i]);
                    if ($results === false) {
                        JFactory::getApplication()->enqueueMessage(JText::_('MOLAJO_ACL_ERROR_ACTION_NOT_PERMITTED').' '.$this->getTask(), 'warning');
                        return false;
                    }
                }
            }
        }

        /** place query results in cache **/
        $this->cache[$store] = $items;

        /** return from cache **/
        return $this->cache[$store];
    }

    /**
     * getListQueryCache
     *
     * Method to cache the last query constructed.
     *
     * This method ensures that the query is constructed only once for a given state of the model.
     *
     * @return	JDatabaseQuery
     * @since	1.6
     */
    private function getListQueryCache()
    {
        static $lastStoreId;
        $currentStoreId = $this->getStoreId();

        if ($lastStoreId != $currentStoreId || empty($this->query)) {
            $lastStoreId = $currentStoreId;
            $this->query = $this->getListQuery();
        }

        //OnContentBeforeQuery

        return $this->query;
    }

    /**
     * getStoreId
     *
     * Method to get a unique store id based on model configuration state.
     *
     * @param	string		$id	A prefix for the store id.
     *
     * @return	string		A store id.
     * @since	1.6
     */
    protected function getStoreId ($id = '')
    {
        $id = ':'.$this->getState('filter.search');

        for ($i=1; $i < 1000; $i++) {
            $temp = $this->params->def($this->parameterFieldName.$i);
            $filterName = substr($temp, 0, stripos($temp, ';'));
            $filterDataType = substr($temp, stripos($temp, ';') + 1, 1);
            if ($filterName == null) {
                break;
            } else {
                $id .= ':'.$this->getState('filter.'.$filterName);
            }
        }

        $id .= ':'.$this->getState('filter.layout');

        $id .= ':'.$this->getState('list.start');
        $id .= ':'.$this->getState('list.limit');
        $id .= ':'.$this->getState('list.ordering');
        $id .= ':'.$this->getState('list.direction');

        return md5($this->context.':'.$id);
    }

    /**
     * getListQuery
     *
     * Get the master query for retrieving a list of items subject to the model state.
     *
     * @return	JDatabaseQuery
     * @since	1.6
     */
    function getListQuery()
    {
        $db = $this->getDbo();
        $this->query = $db->getQuery(true);
        
        /** Process each field that is 1) required 2) selected for display and 3) selected as a filter **/
        $fieldArray = array();

        /** load all available columns into select list and check for filters **/
        foreach ($this->tableFieldList as $fieldName) {
            $this->setQueryParts ($fieldName, false);
        }
        $this->setQueryParts ('search', false);

        /** primary table **/
        $this->query->from('#'.JRequest::getCmd('component_table').' AS a');

        /** parent category **/
        $this->query->select('c.id AS category_id, c.title AS category_title, c.path AS category_route, c.alias AS category_alias');
        $this->query->join('LEFT', '#__categories AS c ON c.id = a.catid');

        /** sins of the parent checking **/

        /** spammed or trashed or unpublished ancestor = same for descendents **/
        $this->query->select(' minimumState.published AS minimum_state_category');
            $subQuery = ' SELECT parent.id, MIN(parent.published) AS published ';
            $subQuery .= ' FROM #__categories AS cat ';
            $subQuery .= ' JOIN #__categories AS parent ON cat.lft BETWEEN parent.lft AND parent.rgt ';
            $subQuery .= ' WHERE parent.extension = '.$db->quote(JRequest::getVar('option'));
            $subQuery .= '   AND cat.published > '.MOLAJO_STATE_VERSION;
            $subQuery .= '   AND parent.published > '.MOLAJO_STATE_VERSION;
            $subQuery .= ' GROUP BY parent.id ';
        $this->query->join(' LEFT OUTER', '('.$subQuery.') AS minimumState ON minimumState.id = c.id ');

        /** archived ancestor = archived descendents **/
        $this->query->select(' CASE WHEN maximumState.published > '.MOLAJO_STATE_PUBLISHED.' THEN 1 ELSE 0 END AS archived_category');
            $subQuery = ' SELECT parent.id, MAX(parent.published) AS published ';
            $subQuery .= ' FROM #__categories AS cat ';
            $subQuery .= ' JOIN #__categories AS parent ON cat.lft BETWEEN parent.lft AND parent.rgt ';
            $subQuery .= ' WHERE parent.extension = '.$db->quote(JRequest::getVar('option'));
            $subQuery .= ' GROUP BY parent.id ';
        $this->query->join(' LEFT OUTER', '('.$subQuery.') AS maximumState ON maximumState.id = c.id ');
 
        /** view access for user **/
        $aclClass = ucfirst(strtolower(JRequest::getVar('default_view'))).'ACL';
        $aclClass::getQueryParts ($this->query, 'user', '');

        /** ordering and direction **/
        $orderCol	= $this->state->get('list.ordering', 'a.title');
        $orderDirn	= $this->state->get('list.direction', 'asc');
        if ($orderCol == 'a.ordering' || $orderCol == 'category_title') {
            $orderCol = 'category_title '.$orderDirn.', a.ordering';
        }
        $this->query->order($db->getEscaped($orderCol.' '.$orderDirn));

        return $this->query;
    }

    /**
     * getPagination
     *
     * Method to get a JPagination object for the data set.
     *
     * @return	object	A JPagination object for the data set.
     * @since	1.6
     */
    public function getPagination()
    {
        /** get pagination id **/
        $store = $this->getStoreId('getPagination');

        /** if available, load from cache **/
        if (empty($this->cache[$store])) {
        } else {
            return $this->cache[$store];
        }

        /** pagination object **/
        $limit = (int) $this->getState('list.limit') - (int) $this->getState('list.links');
        $page = new JPagination($this->getTotal(), $this->getStart(), $limit);

        /** load cache **/
        $this->cache[$store] = $page;

        /** return from cache **/
        return $this->cache[$store];
    }

    /**
     * getTotal
     *
     * Method to get the total number of items for the data set.
     *
     * @return	integer	The total number of items available in the data set.
     * @since	1.6
     */
    public function getTotal()
    {
        /** get total id **/
        $store = $this->getStoreId('getTotal');

        /** if available, load from cache **/
        if (empty($this->cache[$store])) {
        } else {
            return $this->cache[$store];
        }

        /** get total of items **/
        $query = $this->getListQueryCache();
        $total = (int) $this->_getListCount((string) $query);
        if ($this->_db->getErrorNum()) {
            $this->setError($this->_db->getErrorMsg());
            return false;
        }

        /** load cache **/
        $this->cache[$store] = $total;

        /** return from cache **/
        return $this->cache[$store];
    }

    /**
     * getStart
     *
     * Method to get the starting number of items for the data set.
     *
     * @return	integer	The starting number of items available in the data set.
     * @since	1.6
     */
    public function getStart()
    {
        /** get start id **/
        $store = $this->getStoreId('getStart');

        /** if available, load from cache **/
        if (empty($this->cache[$store])) {
        } else {
            return $this->cache[$store];
        }

        /** get list object **/
        $start = $this->getState('list.start');
        $limit = $this->getState('list.limit');
        $total = $this->getTotal();
        if ($start > $total - $limit) {
            $start = max(0, (int)(ceil($total / $limit) - 1) * $limit);
        }

        /** load cache **/
        $this->cache[$store] = $start;

        /** return from cache **/
        return $this->cache[$store];
    }

    /**
     * getAuthors
     *
     * Build a list of authors
     *
     * @return	JDatabaseQuery
     * @since	1.6
     */
    public function getAuthors()
    {
        $componentTable = '#'.JRequest::getCmd('component_table');
        $db = $this->getDbo();
        $this->query = $db->getQuery(true);

        $this->query->select('u.id AS value, u.name AS text');
        $this->query->from('#__users AS u');
        $this->query->join('INNER', $db->namequote($componentTable).' AS c ON c.created_by = u.id');
        $this->query->group('u.id');
        $this->query->order('u.name');

        $db->setQuery($this->query->__toString());

        return $db->loadObjectList();
    }

    /**
     * getMonthsCreate
     *
     * Build a list of created date months in content
     *
     * @return	JDatabaseQuery
     * @since	1.6
     */
    public function getMonthsCreate($table = null)
    {
        return $this->getMonths('created', $table);
    }

    /**
     * getMonthsModified
     *
     * Build a list of modified months in content
     *
     * @return	JDatabaseQuery
     * @since	1.6
     */
    public function getMonthsModified($table = null)
    {
        return $this->getMonths('modified', $table);
    }

    /**
     * getMonthsUpdate
     *
     * Build a list of publish months in content
     *
     * @return	JDatabaseQuery
     * @since	1.6
     */
    public function getMonthsUpdate($table = null)
    {
        return $this->getMonths('modified', $table);
    }

    /**
     * getMonthsPublish
     *
     * Build a list of publish months in content
     *
     * @return	JDatabaseQuery
     * @since	1.6
     */
    public function getMonthsPublish($table = null)
    {
        return $this->getMonths('publish_up', $table);
    }

   /**
     * getMonths
     *
     * Build a list of months in content
     *
     * @return	JDatabaseQuery
     * @since	1.6
     */
    public function getMonths($columnName, $table = null)
    {
        $db = $this->getDbo();
        $this->query = $db->getQuery(true);

        $this->query->select('DISTINCT CONCAT(SUBSTRING(a.'.$db->namequote($columnName).', 1, 4),
                                            SUBSTRING(a.'.$db->namequote($columnName).', 6, 2)) AS value,
                                            SUBSTRING(a.'.$db->namequote($columnName).', 1, 7) AS text');

        if ($table == null) {
            $this->queryTable = '#'.JRequest::getCmd('component_table');
        } else {
            $this->queryTable = $table;
        }
        $this->query->from($db->namequote($this->queryTable).' AS a');
        $this->query->group('SUBSTRING(a.'.$db->namequote($columnName).', 1, 4),
                                            SUBSTRING(a.'.$db->namequote($columnName).', 6, 2),
                                            SUBSTRING(a.'.$db->namequote($columnName).', 1, 7)');
        $this->query->order('SUBSTRING(a.'.$db->namequote($columnName).', 1, 7)');

        $db->setQuery($this->query->__toString());

        return $db->loadObjectList();
    }

    /**
     * getOptionList
     *
     * Return Query results for two fields
     *
     * @param string $field1
     * @param string $field2
     * @param boolean $showKey
     * @param boolean $showKeyFirst
     * @param string $table
     * @return object query results
     */
    public function getOptionList($field1, $field2, $showKey = false, $showKeyFirst = false, $table  = null)
    {
        $this->params = JComponentHelper::getParams(JRequest::getVar('option'));   
        $db = $this->getDbo();
        $this->query = $db->getQuery(true);

        /** select **/
        if ($showKey == true) {
            if ($showKeyFirst == true) {
                $fieldArray2 = 'CONCAT('.$db->namequote($field1).', ": ",'.$db->namequote($field2).' )';
            } else {
                $fieldArray2 = 'CONCAT('.$db->namequote($field2).', " (",'.$db->namequote($field1).', ")")';
            }
        } else {
             $fieldArray2 = $field2;
        }
        $this->query->select('DISTINCT '.$db->namequote($field1).' AS value, '.$fieldArray2.' as text');

        /** from **/
        if ($table == null) {
            $this->queryTable = '#'.JRequest::getCmd('component_table');
        } else {
            $this->queryTable = $table;
        }
        $this->query->from($db->namequote($this->queryTable).' AS a');

        /** where **/
        $this->parameterFieldName = JRequest::getCmd('filterFieldName', 'config_manager_list_filters').'_query_filters';

        for ($i=1; $i < 1000; $i++) {

            $filterName = $this->params->def($this->parameterFieldName.$i);

            /** end of filter processing **/
            if ($filterName == null) { break; }

            /** configuration option not selected **/
            if ($filterName == '0') {

            } else if ($filterName == $field2) {    

            /** process selected filter (only where clause) **/
            } else {
                $this->setQueryParts ($filterName,  true);
            }
        }

        /** group by **/
        $this->query->group($field1, $fieldArray2);

        /** order by **/
        if ($showKey == true && $showKeyFirst == true) {
            $this->query->order($field1);
        } else {
            $this->query->order($field2);
        }

        /** run query and return results **/
        $db->setQuery($this->query->__toString());
        return $db->loadObjectList();
    }

    /**
     * setQueryParts
     *
     * @param string $fieldName
     * @param boolean $onlyWhereClause - true - all query parts; false - only where clause
     * @return sets $query object
     */
    public function setQueryParts ($fieldname, $onlyWhereClause=false)
    {
        $selectedState = $this->getState('filter.state');
        $fieldClassName = 'MolajoField'.ucfirst($fieldname);
        $this->molajoField->requireFieldClassFile ($fieldname, false);

        if (class_exists($fieldClassName)) {
            $value = $this->getState('filter.'.$fieldname);
            $molajoSpecificFieldClass = new $fieldClassName();
            $molajoSpecificFieldClass->getQueryParts($this->query, $value, $selectedState, $onlyWhereClause);

        } else {
            if ($onlyWhereClause === true) {
                JFactory::getApplication()->enqueueMessage(JText::_('MOLAJO_INVALID_FIELD_CLASS').' '.$fieldClassName, 'error');
                return false;
            } else {
                $this->query->select('a.'.$fieldname);
                return true;
            }
        }
    }

    /**
     * validateValue
     *
     * @param string $columnName
     * @param string $value
     * @param string $valueType
     * @param string $table
     * @return mixed either false or the validated value
     */
    public function validateValue($columnName, $value, $valueType, $table = null)
    {
        $db = $this->getDbo();
        $this->query = $db->getQuery(true);

        $this->query->select('DISTINCT '.$db->namequote($columnName).' as value');

        if ($table == null) {
            $this->query->from($db->namequote('#'.JRequest::getCmd('component_table')));
        } else {
            $this->query->from($db->namequote($table));
        }

        if ($valueType == 'numeric') {
            $this->query->where($db->namequote($columnName).' = '.(int) $value);
        } else {
            $this->query->where($db->namequote($columnName).' = '.$db->quote($value));
        }

        $db->setQuery($this->query->__toString());

        if (!$results = $db->loadObjectList()) {
            JFactory::getApplication()->enqueueMessage($db->getErrorMsg(), 'error');
            return false;
        }

        if (count($results) > 0) {
            foreach ($results as $count => $item) {
                $singleValue = $item->value;
            }
            return true;
        }

        return false;
    }

    /**
     * checkCategories
     *
     * Verifies if one of the Category Values sent in matches a Category for the Component
     *
     * @param string $columnName
     * @param string $value
     * @return boolean
     * @since	1.6
     */
    public function checkCategories ($categoryArray)
    {
        $db = $this->getDbo();
        $this->query = $db->getQuery(true);

        $this->query->select('DISTINCT id');
        $this->query->from($db->namequote('#__categories'));

        /** category array **/
        JArrayHelper::toInteger($categoryArray);
        if (empty($categoryArray)) {
            return;
        }
        $this->query->where($db->namequote('id').' IN ('.$categoryArray.')');
        $this->query->where($db->namequote('extension').' = '.$db->quote(JRequest::getVar('option')));

        $db->setQuery($this->query->__toString());

        if (!$results = $db->loadObjectList()) {
            JFactory::getApplication()->enqueueMessage($db->getErrorMsg(), 'error');
            return false;
        }

        if (count($results) > 0) {
            return true;
        }

        return false;
    }

    /**
     * getTable
     *
     * Returns a Table object, always creating it.
     *
     * @param	type	The table type to instantiate
     * @param	string	A prefix for the table class name. Optional.
     * @param	array	Configuration array for model. Optional.
     *
     * @return	JTable	A database object
    */
    public function getTable($type='', $prefix='', $config = array())
    {
        return JTable::getInstance($type=ucfirst(JRequest::getCmd('single_view')), $prefix=ucfirst(JRequest::getVar('default_view').'Table'), $config);
    }

    /**
     * saveSelective
     *
     * Not using this right now, may choose to later
     *
     * This code restricts the select list to a required list, those items specified for the filter and for the specific layout
     *
     * Could help with speed (a bit)
     *
    */
    private function saveSelective ()
    {
        /** 1: required fields **/
        $fieldArray = array();
        $requireList = 'id,title,alias,state,catid,created_by,access,checked_out,checked_out_time,search';
        $requiredArray = explode(',', $requireList);

        foreach ($requiredArray as $required) {
            if (in_array($required, $fieldArray)) {
            } else {
                $fieldArray[] = $required;
            }
        }

        /** 2: selected for display **/
        $this->parameterFieldName = JRequest::getCmd('selectFieldName', 'config_manager_grid_column');

        for ($i=1; $i < 1000; $i++) {

            $fieldName = $this->params->get($this->parameterFieldName.$i);

            /** end of filter processing **/
            if ($fieldName == null) { break; }

            /** configuration option not selected **/
            if ($fieldName == '0') {

            /** selected twice by user in configuration **/
            } else if (in_array($fieldName, $fieldArray)) {

            /** store for filtering and then processing **/
            } else {
                $fieldArray[] = $fieldName;
            }
        }

        /** 3: selected as a filter **/
        $this->parameterFieldName = JRequest::getCmd('filterFieldName', 'config_manager_list_filters');

        for ($i=1; $i < 1000; $i++) {

            $fieldName = $this->params->def($this->parameterFieldName.$i);

            /** end of filter processing **/
            if ($fieldName == null) { break; }

            /** configuration option not selected **/
            if ($fieldName == '0') {

            /** listed twice, ignore after first use **/
            } else if (in_array($fieldName, $fieldArray)) {

            /** process selected field **/
            } else {
                $fieldArray[] = $fieldName;
            }
        }

        /** filter by known field names and append into query object **/
        foreach ($fieldArray as $fieldName) {
            if ((in_array($fieldName, $this->tableFieldList)) || $fieldName == 'search') {
                $this->setQueryParts ($fieldName, false);
            }
        }
    }
}