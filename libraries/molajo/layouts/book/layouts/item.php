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
<div class="item-page<?php echo $this->pageclass_sfx?>">

<h2>
<?php echo $this->escape($this->item->title); ?>
</h2>

<?php if ($this->item->canEdit) : ?>
<ul class="actions">
    <li class="edit-icon">
        <?php echo JHtml::_('icon.edit', $this->item, $this->params); ?>
    </li>
</ul>
<?php endif; ?>

<ul class="subheading">

    <dd class="published">
        <?php echo JText::sprintf('MOLAJO_PUBLISHED_DATE', JHtml::_('date',$this->item->publish_up, JText::_('DATE_FORMAT_LC2'))); ?>
    </dd>

    <dd class="author">
        <?php echo JText::sprintf('MOLAJO_WRITTEN_BY', $this->item->display_author_name); ?>
    </dd>

</ul>

<?php /** Recommend omitting afterDisplayTitle */
echo $this->item->event->afterDisplayTitle; ?>

<?php /** Recommend omitting beforeDisplayContent */
echo $this->item->event->beforeDisplayContent; ?>

<?php if (isset ($this->item->toc)) : ?>
	<?php echo $this->item->toc; ?>
<?php endif; ?>
        
<?php echo $this->item->text; ?>

</div>
