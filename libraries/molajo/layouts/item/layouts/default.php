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
        <?php edit //echo JHtml::_('icon.edit', $this->item, $this->params); ?>
    </li>
</ul>
<?php endif; ?>

<ul class="subheading">
    <dd class="published">
        <?php echo JText::_('MOLAJO_PUBLISHED_DATE').' '.$this->item->created_ccyymmdd; ?>
    </dd>
    <dd class="author">
        <?php echo JText::_('MOLAJO_WRITTEN_BY').' '.$this->item->display_author_name; ?>
    </dd>
</ul>

<?php echo $this->item->text; ?>
</div>