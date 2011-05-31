<?php
/**
 * @version     $id: layout
 * @package     Molajo
 * @subpackage  Batch Copy
 * @copyright   Copyright (C) 2011 Amy Stephen. All rights reserved.
 * @license     GNU General Public License Version 2, or later http://www.gnu.org/licenses/gpl.html
 */
defined('MOLAJO') or die; ?>
<fieldset class="batch">
	
    <legend><?php echo JText::_('MOLAJO_BATCH_OPTIONS');?></legend>

        <fieldset id="batch-choose-action" class="combo">
            <select name="batch_catid" class="inputbox" id="batch-category-id">
                <option value=""><?php echo JText::_('MOLAJO_BATCH_CATEGORY_LABEL') ?></option>
                    <?php if ($this->options->get('request.option') == 'com_categories') { ?>
                        <?php echo JHtml::_('select.options', JHtml::_('category.categories', $this->options->get('request.option'), array('published' => 1)));?>
                    <?php } else { ?>
                        <?php echo JHtml::_('select.options', JHtml::_('category.options', $this->options->get('request.option')), 'value', 'text', $this->queryState->get('filter.batch_category_id'));?>
                    <?php } ?>
            </select>

            <button type="submit" onclick="submitbutton('<?php echo $this->options->get('request.default_view'); ?>.copy');">
                    <?php echo JText::_('MOLAJO_BATCH_COPY_PROCESS'); ?>
            </button>

            <button type="submit" onclick="submitbutton('<?php echo $this->options->get('request.default_view'); ?>.move');">
                    <?php echo JText::_('MOLAJO_BATCH_MOVE_PROCESS'); ?>
            </button>
        </fieldset>
</fieldset>