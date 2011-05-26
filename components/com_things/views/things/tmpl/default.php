<?php
/**
 * @version     $id: layout
 * @package     Molajo
 * @subpackage  Default Layout
 * @copyright   Copyright (C) 2011 Individual Molajo Contributors. All rights reserved.
 * @license     GNU General Public License Version 2, or later http://www.gnu.org/licenses/gpl.html
 */
defined('MOLAJO') or die;

$this->layoutHelper = new MolajoLayoutHelper();
$this->layoutHelper->setLayoutDriver ('list');
$this->layoutHelper->setLayout ('list');
require $this->layoutHelper->getPath ('driver.php');