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
<form action="<?php echo JRoute::_('index.php?option='.$this->options->get('component_option').'&view='.JRequest::getVar('view')); ?>" method="post" name="adminForm" id="adminForm">