<?php
/**
 * @version     $id: layout
 * @package     Molajo
 * @subpackage  Single View
 * @copyright   Copyright (C) 2011 Amy Stephen. All rights reserved.
 * @license     GNU General Public License Version 2, or later http://www.gnu.org/licenses/gpl.html
 */
defined('MOLAJO') or die;

if ($this->row->canEditstate === true) {
    echo '<div class="width-100 fltlft">';
    echo JHtml::_('sliders.start', 'permissions-sliders-'.$this->slider_id, array('useCookie'=>1));
    echo JHtml::_('sliders.panel', JText::_('MOLAJO_FIELDSET_RULES'), 'access-rules'); ?>

    <fieldset class="panelform">
            <?php echo $this->form->getLabel('rules'); ?>
            <?php echo $this->form->getInput('rules'); ?>
    </fieldset>

<?php
    echo JHtml::_('sliders.end');
    echo '</div>';
}