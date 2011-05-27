<?php
/**
 * @version     $id: section.php
 * @package     Molajo
 * @subpackage  Section Layout
 * @copyright   Copyright (C) 2011 Individual Molajo Contributors. All rights reserved.
 * @license     GNU General Public License Version 2, or later http://www.gnu.org/licenses/gpl.html
 */
defined('MOLAJO') or die;

$this->layoutHelper = new MolajoLayoutHelper();
$this->layoutHelper->setLayoutDriver ('section');
$this->layoutHelper->setLayout ('section');

require $this->layoutHelper->getPath ('driver.php');