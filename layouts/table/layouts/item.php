<?php
/**
 * @version     $id: default.php
 * @package     Molajo
 * @subpackage  Item Layout
 * @copyright   Copyright (C) 2011 Individual Molajo Contributors. All rights reserved.
 * @license     GNU General Public License Version 2, or later http://www.gnu.org/licenses/gpl.html
 */
defined('MOLAJO') or die;
?>
<div class="item-page<?php echo $this->state->get('page_class_suffix', ''); ?>">

<h2>
<?php echo $this->escape($this->row->title); ?>
</h2>

<?php if ($this->row->canEdit) : ?>
<ul class="actions">
    <li class="edit-icon">
        <?php echo JHtml::_('icon.edit', $this->row, $this->state); ?>
    </li>
</ul>
<?php endif; ?>

<ul class="subheading">

    <dd class="published">
        <?php echo JText::sprintf('MOLAJO_PUBLISHED_DATE', JHtml::_('date',$this->row->publish_up, JText::_('DATE_FORMAT_LC2'))); ?>
    </dd>

    <dd class="author">
        <?php echo JText::sprintf('MOLAJO_WRITTEN_BY', $this->row->display_author_name); ?>
    </dd>

</ul>

<?php /** Recommend omitting afterDisplayTitle */
echo $this->row->event->afterDisplayTitle; ?>

<?php /** Recommend omitting beforeDisplayContent */
echo $this->row->event->beforeDisplayContent; ?>

<?php if (isset ($this->row->toc)) : ?>
	<?php echo $this->row->toc; ?>
<?php endif; ?>
        
<?php echo $this->row->text; ?>

</div>
