<?php
/**
 * @version     $this->row->rowCountd: layout
 * @package     Molajo
 * @subpackage  Multiple View
 * @copyright   Copyright (C) 2011 Amy Stephen. All rights reserved.
 * @license     GNU General Public License Version 2, or later http://www.gnu.org/licenses/gpl.html
 */
defined('MOLAJO') or die; 
$defaultView = $this->state->get('request.default_view'); ?>

<td class="order">
<?php if ($this->row->canEditstate) : ?>
    <?php if ($this->saveOrder) :?>
        <?php if ($this->getState('pagination.list_direction') == 'asc') : ?>
                <span><?php echo $this->pagination->orderUpIcon($this->row->rowCount, ($this->recordset->catid == @$this->row[$this->row->rowCount-1]->catid), $this->state->get('request.default_view').'.orderup', 'JLIB_HTML_MOVE_UP', $this->ordering); ?></span>
                <span><?php echo $this->pagination->orderDownIcon($this->row->rowCount, $this->pagination->total, ($this->row->catid == @$this->row[$this->row->rowCount+1]->catid), $this->state->get('request.default_view').'.orderdown', 'JLIB_HTML_MOVE_DOWN', $this->ordering); ?></span>
        <?php elseif ($this->getState('pagination.list_direction') == 'desc') : ?>
                <span><?php echo $this->pagination->orderUpIcon($this->row->rowCount, ($this->recordset->catid == @$this->row[$this->row->rowCount-1]->catid), $this->state->get('request.default_view').'.orderdown', 'JLIB_HTML_MOVE_UP', $this->ordering); ?></span>
                <span><?php echo $this->pagination->orderDownIcon($this->row->rowCount, $this->pagination->total, ($this->row->catid == @$this->row[$this->row->rowCount+1]->catid), $this->state->get('request.default_view').'.orderup', 'JLIB_HTML_MOVE_DOWN', $this->ordering); ?></span>
        <?php endif; ?>
    <?php endif; ?>
    <?php $disabled = $this->saveOrder ?  '' : 'disabled="disabled"'; ?>
    <input type="text" name="order[]" size="5" value="<?php echo $this->row->ordering; ?>" <?php echo $disabled ?> class="text-area-order" />
<?php else : ?>
        <?php echo $this->row->ordering; ?>
<?php endif; ?>
</td>