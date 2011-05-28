<?php
/**
 * @version     $this->itemCountd: layout
 * @package     Molajo
 * @subpackage  Multiple View
 * @copyright   Copyright (C) 2011 Amy Stephen. All rights reserved.
 * @license     GNU General Public License Version 2, or later http://www.gnu.org/licenses/gpl.html
 */
defined('MOLAJO') or die; 
$defaultView = JRequest::getVar('default_view'); ?>

<td class="order">
<?php if ($this->item->canEditstate) : ?>
    <?php if ($this->saveOrder) :?>
        <?php if ($this->listDirn == 'asc') : ?>
                <span><?php echo $this->pagination->orderUpIcon($this->itemCount, ($this->items->catid == @$this->item[$this->itemCount-1]->catid), JRequest::getVar('default_view').'.orderup', 'JLIB_HTML_MOVE_UP', $this->ordering); ?></span>
                <span><?php echo $this->pagination->orderDownIcon($this->itemCount, $this->pagination->total, ($this->item->catid == @$this->item[$this->itemCount+1]->catid), JRequest::getVar('default_view').'.orderdown', 'JLIB_HTML_MOVE_DOWN', $this->ordering); ?></span>
        <?php elseif ($this->listDirn == 'desc') : ?>
                <span><?php echo $this->pagination->orderUpIcon($this->itemCount, ($this->items->catid == @$this->item[$this->itemCount-1]->catid), JRequest::getVar('default_view').'.orderdown', 'JLIB_HTML_MOVE_UP', $this->ordering); ?></span>
                <span><?php echo $this->pagination->orderDownIcon($this->itemCount, $this->pagination->total, ($this->item->catid == @$this->item[$this->itemCount+1]->catid), JRequest::getVar('default_view').'.orderup', 'JLIB_HTML_MOVE_DOWN', $this->ordering); ?></span>
        <?php endif; ?>
    <?php endif; ?>
    <?php $disabled = $this->saveOrder ?  '' : 'disabled="disabled"'; ?>
    <input type="text" name="order[]" size="5" value="<?php echo $this->item->ordering; ?>" <?php echo $disabled ?> class="text-area-order" />
<?php else : ?>
        <?php echo $this->item->ordering; ?>
<?php endif; ?>
</td>