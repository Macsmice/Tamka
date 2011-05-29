<?php
/**
 * @version     $id: layout
 * @package     Molajo
 * @subpackage  Multiple View
 * @copyright   Copyright (C) 2011 Amy Stephen. All rights reserved.
 * @license     GNU General Public License Version 2, or later http://www.gnu.org/licenses/gpl.html
 */
defined('MOLAJO') or die; ?>
<input type="hidden" name="task" value="" />
<input type="hidden" name="boxchecked" value="0" />
<input type="hidden" name="filterFieldName" value="config_manager_list_filters" />
<input type="hidden" name="format" value="<?php echo $this->options->get('component_format'); ?>" />
<input type="hidden" name="filter_order" value="<?php echo $this->listOrder; ?>" />
<input type="hidden" name="filter_order_Dir" value="<?php echo $this->listDirn; ?>" />
<?php echo JHtml::_('form.token'); ?>