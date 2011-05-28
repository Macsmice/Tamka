<?php
/**
 * @version     $id: layout
 * @package     Molajo
 * @subpackage  Display View
 * @copyright   Copyright (C) 2011 Individual Molajo Contributors. All rights reserved.
 * @license     GNU General Public License Version 2, or later http://www.gnu.org/licenses/gpl.html
 */
defined('MOLAJO') or die;
echo $this->layoutHelper->driver ('manager', $this->option, $this->view, true);