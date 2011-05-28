<?php
/**
 * @version     $id: layout
 * @package     Molajo
 * @subpackage  Multiple View
 * @copyright   Copyright (C) 2011 Amy Stephen. All rights reserved.
 * @license     GNU General Public License Version 2, or later http://www.gnu.org/licenses/gpl.html
 */
defined('MOLAJO') or die;
?>
<th width="10%">
        <?php echo JHtml::_('grid.sort',  'MOLAJO_FIELD_ORDERING_LABEL', 'a.ordering', $this->listDirn, $this->listOrder); ?>
        <?php if ($this->saveOrder) :?>
                <?php echo JHtml::_('grid.order',  $this->items, 'filesave.png', JRequest::getVar('default_view').'.saveorder'); ?>
        <?php endif; ?>
</th>