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
<td class="center nowrap" width="2%" valign="top">
    <?php if (($this->item->canEdit && ((int) $this->item->state < 2))
                || $this->item->canCheckin || $this->item->canEditState || $this->item->canDelete ) {
            echo JHtml::_('grid.id', $this->itemCount, $this->item->id);
    } ?>
</td>