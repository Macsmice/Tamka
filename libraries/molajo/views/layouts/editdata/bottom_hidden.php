<?php
/**
 * @version     $id: layout
 * @package     Molajo
 * @subpackage  Single View
 * @copyright   Copyright (C) 2011 Amy Stephen. All rights reserved.
 * @license     GNU General Public License Version 2, or later http://www.gnu.org/licenses/gpl.html
 */
defined('MOLAJO') or die;
?>
<input type="hidden" name="task" value="" />
<input type="hidden" name="return" value="<?php echo JRequest::getCmd('return');?>" />
<input type="hidden" name="id" value="<?php echo JRequest::getInt('id');?>" />
<?php echo JHtml::_('form.token'); ?>