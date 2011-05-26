<?php
/**
 * @version     $id: layout
 * @package     Molajo
 * @subpackage  Multiple View
 * @copyright   Copyright (C) 2011 Amy Stephen. All rights reserved.
 * @license     GNU General Public License Version 2, or later http://www.gnu.org/licenses/gpl.html
 */
defined('MOLAJO') or die; 
$defaultView = JRequest::getVar('default_view');
if ($this->render['column_name'] == 'title' && $this->params->def('config_manager_grid_column_display_alias', 1)) {
    $printAlias = '<br />'.$this->escape($this->item->alias);
} else {
    $printAlias = '';
}
?>

<td>
<?php if ($this->item->checked_out) : ?>
        <?php echo JHtml::_('jgrid.checkedout', $this->itemCount, $this->item->editor, $this->item->checked_out_time, $defaultView.'.', $this->item->canCheckin); ?>
<?php endif; ?>
<?php if ($this->item->canEdit || $this->item->canEditOwn) : ?>
        <a href="<?php echo JRoute::_('index.php?option='.JRequest::getVar('option').'&task=edit&id='.$this->item->id);?>">
                <?php echo $this->escape($this->item->title); ?></a>
<?php else : ?>
        <?php echo $this->escape($this->item->title); ?>
<?php endif; ?>

<?php if ($this->params->def('config_manager_grid_column_display_alias', 1))  : ?>
        <p class="smallsub"><?php echo JText::sprintf('JGLOBAL_LIST_ALIAS', $this->escape($this->item->alias));?></p>
<?php endif; ?>
</td>