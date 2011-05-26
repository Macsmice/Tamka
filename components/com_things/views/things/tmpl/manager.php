<?php
/**
 * @version     $id: layout
 * @package     Molajo
 * @subpackage  Manager Layout
 * @copyright   Copyright (C) 2011 Individual Molajo Contributors. All rights reserved.
 * @license     GNU General Public License Version 2, or later http://www.gnu.org/licenses/gpl.html
 */
defined('MOLAJO') or die;

$this->layoutHelper = new MolajoLayoutHelper();
$this->layoutHelper->setLayoutDriver ('manager');
$this->layoutHelper->setLayout ('manager');
require $this->layoutHelper->getPath ('driver.php');