<?php
/**
 * @version     id: single.php
 * @package     Molajo
 * @subpackage  Single Controller
 * @copyright   Copyright (C) 2011 Amy Stephen. All rights reserved.
 * @license     GNU General Public License Version 2, or later http://www.gnu.org/licenses/gpl.html
 */
defined('MOLAJO') or die;

/**
 * Edit Controller
 *
 * Handles the standard single-item save, delete, and cancel tasks
 *
 * Cancel: cancel and close
 * Save: apply, create, save, save2copy, save2new, restore
 * Delete: delete
 *
 * Called from the Multiple Controller for batch (copy, move) and delete
 *
 * @package	Molajo
 * @subpackage	Controller
 * @since	1.6
 */
class MolajoControllerEdit extends MolajoController
{
    /**
     * cancelItem
     *
     * Method to cancel an edit.
     *
     * Tasks: cancel and close
     *
     * @return	Boolean
     * @since	1.6
     */
    public function cancel ()
    {
        return $this->cancelItem ();
    }
    public function close ()
    {
        return $this->cancelItem ();
    }
    public function cancelItem()
    {
        /** security token **/
        JRequest::checkToken() or jexit(JText::_('JINVALID_TOKEN'));

        /** initialisation */
        parent::initialise('cancel');

        /** Check In Item **/
        if ($this->id == 0) {
        } else {
            $results = parent::checkInItem();
        }

        /** success message **/
        $this->redirectClass->setRedirectMessage(JText::_('MOLAJO_CANCEL_SUCCESSFUL'));
        $this->redirectClass->setSuccessIndicator(true);
    }

    /**
    * restore
    *
    * Method to restore a version history record to the current version.
    *
    * uses saveItem to process save after preparing the data
    *
    * @return	Boolean
    * @since	1.6
    */
    public function restore ()
    {
        parent::initialise('save');

        if ($this->params->def('config_component_version_management', 1) == 1) {
        } else {
            $this->redirectClass->setRedirectMessage(JText::_('MOLAJO_RESTORE_DISABLED_IN_CONFIGURATION'));
            $this->redirectClass->setRedirectMessageType(JText::_('error'));
            return $this->redirectClass->setSuccessIndicator(false);
        }

        /** Model: Get Data for Restore ID **/
        $data = $this->model->restore($this->id);

        /** Version_History: reset ids to point to current row **/
        JRequest::setVar('from_id', $this->id);
        JRequest::setVar('id', $data->id);
        $this->id = $data->id;
        $this->table->reset();

        return $this->saveItem ($data, 'save');
    }

    /**
    * saveItemBatch
    *
    * Called from MolajoControllerMultiple::processItem to obtain a current row and prepare data for a new item
    *
    * uses saveItem to process save after preparing the data
    *
    * @return	Boolean
    * @since	1.6
    */
    public function saveItemBatch($task)
    {
        /** initialisation */
        $results = parent::initialise('save');

        /** Model: Get Data for Copy ID **/
        if ($task == 'copy') {
            $data = $this->model->copy($this->id, $this->batch_catid);

            /** reset ids to point to current row **/
            JRequest::setVar('from_id', $this->id);
            JRequest::setVar('id', 0);

            $this->id = 0;
            $this->table->reset();
        } else {
            $data = $this->model->move($this->id, $this->batch_catid);
        }

        return $this->saveItem ($data, 'save');
    }

    /**
    * apply, create, save, save2copy, save2new
    *
    * Methods used to save a record with different redirect results.
    *
    * Tasks: apply, create, save, save2copy, save2new all processed by saveItemForm to prepare data
    * and then SaveItem to actually save the data
    *
    * @return	Boolean
    * @since	1.6
    */
    public function apply ()
    {
        return $this->saveItemForm ('apply');
    }
    public function create ()
    {
        return $this->saveItemForm ('create');
    }
    public function save ()
    {
        return $this->saveItemForm ('save');
    }
    public function save2copy ()
    {
        return $this->saveItemForm ('save2copy');
    }
    public function save2new ()
    {
        return $this->saveItemForm ('save2new');
    }

    /**
    * saveItemForm
    *
    * Used to obtain form data and send to saveItem for save processing
    *
    * Method called by apply, create, save, save2copy and save2new tasks
    *
    * @return	Boolean
    * @since	1.6
    */
    public function saveItemForm($task)
    {
        /** security token **/
        JRequest::checkToken() or jexit(JText::_('JINVALID_TOKEN'));

        $results = parent::initialise('save');

        $data = JRequest::getVar('jform', array(), 'post', 'array');

        /** Preparation: save as copy id and task cleanup **/
        if ($task == 'save2copy') {
            $this->id = 0;
            $data['id'] = 0;
            $task = 'apply';
            JRequest::setVar('id', 0);
        }
        return $this->saveItem ($data, $task);
    }

    /**
    * saveItem
    *
    * Method to save a record from a form, as a copy of another record, or using a version history restore.
    *
    * Calling methods include: saveItemForm, saveItemBatch,
    *
    * Also batch-copy uses SaveItem, as well
    *
    * @return	Boolean
    * @since	1.6
    */
    public function saveItem ($data, $task=null)
    {
        /** security token **/
        JRequest::checkToken() or jexit(JText::_('JINVALID_TOKEN'));

        /** task **/
        if ($task == null) {
            $task = $this->getTask();
        }

        /** Edit: Must have data from form input, copy or restore task **/
        if (empty($data)) {
            $this->redirectClass->setRedirectMessage(JText::_('MOLAJO_SAVE_ITEM_TASK_HAS_NO_DATA_TO_SAVE'));
            $this->redirectClass->setRedirectMessageType(JText::_('warning'));
            return $this->redirectClass->setSuccessIndicator(false);
        }

        /** Edit: check for valid state **/
        if ($this->table->state == MOLAJO_STATE_ARCHIVED) {
            $this->redirectClass->setRedirectMessage(JText::_('MOLAJO_ARCHIVED_ROW_CANNOT_BE_CHANGED'));
            $this->redirectClass->setRedirectMessageType(JText::_('error'));
            return $this->redirectClass->setSuccessIndicator(false);            
        }
        if ($this->table->state == MOLAJO_STATE_TRASHED) {
            $this->redirectClass->setRedirectMessage(JText::_('MOLAJO_TRASHED_ROW_CANNOT_BE_CHANGED'));
            $this->redirectClass->setRedirectMessageType(JText::_('error'));
            return $this->redirectClass->setSuccessIndicator(false); 
        }
        if ($this->table->state == MOLAJO_STATE_VERSION) {
            $this->redirectClass->setRedirectMessage(JText::_('MOLAJO_VERSION_ROW_CANNOT_BE_CHANGED'));
            $this->redirectClass->setRedirectMessageType(JText::_('error'));
            return $this->redirectClass->setSuccessIndicator(false);             
        }

        /** Preparation: Save form or version data **/
        JFactory::getApplication()->setUserState(JRequest::getInt('datakey'), $data);
        $context = JRequest::getVar('option').'.'.JRequest::getCmd('view').'.'.JRequest::getCmd('layout').'.'.$task.'.'.JRequest::getInt('datakey');

        /** Edit: verify checkout **/
        if ((int) $this->id) {
            $results = $this->verifyCheckout ($this->id);
            if ($results === false) {
                return $this->redirectClass->setSuccessIndicator(false);
            }
        }

        /** Model: Get Form **/
        /** Model Trigger_Event: onContentPrepareData **/
        /** Model Trigger_Event: onContentPrepareForm **/
        /** Molajo_Note: Forms are named with the concatenated values of option, single_view, layout, task, id, datakey separated by '.' **/
        $form = $this->model->getForm($data, false);
        if ($form === false) {
            return $this->redirectClass->setSuccessIndicator(false);
        }

        /** Model: Validate and Filter **/
        $validData = $this->model->validate($form, $data);

        if ($validData === false) {

            $errors = $this->model->getErrors();
            for ($e=0; $e < count($errors); $e++) {
                if (JError::isError($errors[$e])) {
                    JFactory::getApplication()->enqueueMessage($errors[$e]->getMessage(), 'warning');
                } else {
                    JFactory::getApplication()->enqueueMessage($errors[$e], 'warning');
                }
            }
            JFactory::getApplication()->setUserState(JRequest::getInt('datakey'), $data);
            return $this->redirectClass->setSuccessIndicator(false);
        }

        JFactory::getApplication()->setUserState(JRequest::getInt('datakey'), $validData);

        /** Trigger_Event: onContentValidateForm **/
        /** Molajo_Note: onContentValidateForm is a new event that follows the primary source validation **/
        $results = $this->dispatcher->trigger('onContentValidateForm', array($form, $validData));
        if ($results === false) {
            return $this->redirectClass->setSuccessIndicator(false);
        }

        /** ACL **/
        $results = $this->checkTaskAuthorisation($checkTask=$task);
        if ($results === false) {
            return $this->redirectClass->setSuccessIndicator(false);
        }

    /**
     * Pre-Save Database Processing
     */

        /** Check In Item **/
        $results = parent::checkInItem();
        if ($results === false) {
            return $this->redirectClass->setSuccessIndicator(false);
        }

        /** Version_history: create **/
        $results = $this->createVersion ($context);
        if ($results === false) {
            return $this->redirectClass->setSuccessIndicator(false);
        }

        /** Trigger_Event: onContentBeforeSave **/
        $results = $this->dispatcher->trigger('onContentBeforeSave', array($context, $validData, $this->isNew));
        if (in_array(false, $results, true)) {
            $this->setError($this->dispatcher->getError());
            return $this->redirectClass->setSuccessIndicator(false);
        }

        /**             **/
        /** Model: Save **/
        /**             **/
        $results = $this->model->save($validData);
        if ($results === false) {
            return $this->redirectClass->setSuccessIndicator(false);
        }

        $this->id = $results;
        $validData->id = $this->id;

        /** Event: onContentSaveForm **/
        /** Molajo_Note: New Event onContentSaveForm follows primary content save to keep data insync **/
        $results = $this->dispatcher->trigger('onContentSaveForm', array($form, $validData));
        if ($results === false) {
            return $this->redirectClass->setSuccessIndicator(false);
        }

        /** clear session data **/
        JFactory::getApplication()->setUserState(JRequest::getInt('datakey'), null);

        /** Molajo_Note: Testing added to ensure state change before onContentChangeState event is triggered  **/
        if ($this->existingState == $validData->state || $this->isNew) {
        } else {
            /** Event: onContentChangeState **/
            $this->dispatcher->trigger('onContentChangeState', array($context, $this->id, $validData->state));
        }

        /** Version_History: maintain count **/
        $results = $this->maintainVersionCount ($context);
        if ($results === false) {
            return $this->redirectClass->setSuccessIndicator(false);
        }

        /** Trigger_Event: onContentAfterSave **/
        $this->dispatcher->trigger('onContentAfterSave', array($context, $validData, $this->isNew));

        /** Model: postSaveHook **/
        $this->postSaveHook($this->model, $validData);

        /** Cache: clear cache **/
        $results = $this->cleanCache ();

        /** success **/
        if ($this->getTask() == 'copy' || $this->getTask() == 'move') {
            return true;
        }

        if ($task == 'restore') {
            $this->redirectClass->setRedirectMessage(JText::_('MOLAJO_RESTORE_SUCCESSFUL'));
        } else {
            $this->redirectClass->setRedirectMessage(JText::_('MOLAJO_SAVE_SUCCESSFUL'));
        }

        JRequest::setVar('id', $this->id);
        $this->redirectClass->setRedirectMessageType('message');
        return $this->redirectClass->setSuccessIndicator(true);
    }

    /**
     * deleteItem
     *
     * deletes individual items
     *
     * @return	void
     * @since	1.6
     */
    public function deleteItem ()
    {
        JRequest::checkToken() or jexit(JText::_('JINVALID_TOKEN'));

        /** initialisation */
        $results = parent::initialise('delete');
        if ($results === false) {
            return $this->redirectClass->setSuccessIndicator(false);
        }

        /** Preparation: Save form or version data **/
        $context = JRequest::getVar('option').'.'.JRequest::getCmd('view').'.'.JRequest::getCmd('layout').'.'.'delete';

        /** only trashed and version items can be deleted **/
        if ($this->table->state == MOLAJO_STATE_TRASHED|| $this->table->state == MOLAJO_STATE_VERSION) {
        } else {
            $this->redirectClass->setRedirectMessage(JText::sprintf('MOLAJO_ERROR_VERSION_SAVE_FAILED').' '.$this->id, 'error');
            $this->redirectClass->setRedirect(JRoute::_($this->redirectClass->redirectFailure, false));
            return false;
        }

        /** Version_history: see if version needed **/
        $results = $this->createVersion ($context);
        if ($results === false) {
            return $this->redirectClass->setSuccessIndicator(false);
        }

        /** Delete_Event: onContentBeforeDelete **/
        $results = $this->dispatcher->trigger('onContentBeforeDelete', array($context, $this->table));
        if (in_array(false, $results, true)) {
            return $this->redirectClass->setSuccessIndicator(false);
        }

        /** Model: delete **/
        $results = $this->model->delete($this->id);
        if ($results === false) {
            return $this->redirectClass->setSuccessIndicator(false);
        }

        /** Version_history: maintain versions **/
        $results = $this->maintainVersionCount ($context);
        if ($results === false) {
            return $this->redirectClass->setSuccessIndicator(false);
        }

        /** Delete_Event: onContentAfterDelete **/
        $results = $this->dispatcher->trigger('onContentAfterDelete', array($context, $this->table));
        if (in_array(false, $results, true)) {
            return $this->redirectClass->setSuccessIndicator(false);
        }

        /** clear cache **/
        $results = $this->cleanCache ();

        /** success **/
        return true;
    }
}