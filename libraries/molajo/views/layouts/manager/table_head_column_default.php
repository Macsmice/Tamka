<?php
/**
 * @version     $id: layout
 * @package     Molajo
 * @subpackage  Multiple View
 * @copyright   Copyright (C) 2011 Amy Stephen. All rights reserved.
 * @license     GNU General Public License Version 2, or later http://www.gnu.org/licenses/gpl.html
 */
defined('MOLAJO') or die; ?>
<th>
        <?php echo JHtml::_('grid.sort', 'MOLAJO_FIELD_'.strtoupper($this->columnName).'_LABEL', 'a.'.$this->columnName, $this->listDirn, $this->listOrder); ?>
</th>