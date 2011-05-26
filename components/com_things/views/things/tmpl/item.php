<?php
/**
 * @version     $id: default.php
 * @package     Molajo
 * @subpackage  Default
 * @copyright   Copyright (C) 2011 Individual Molajo Contributors. All rights reserved.
 * @license     GNU General Public License Version 2, or later http://www.gnu.org/licenses/gpl.html
 */
defined('MOLAJO') or die;
$this->layoutHelper = new MolajoLayoutHelper();
$this->layoutHelper->setLayoutDriver ('item');
$this->layoutHelper->setLayout ('item');
require $this->layoutHelper->getPath ('driver.php');