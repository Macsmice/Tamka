<?php
/**
 * @version     $id: editor.php
 * @package     Molajo
 * @subpackage  Editor
 * @copyright   Copyright (C) 2011 Individual Molajo Contributors. All rights reserved.
 * @license     GNU General Public License Version 2, or later http://www.gnu.org/licenses/gpl.html
 */
defined('MOLAJO') or die;

$this->layoutHelper = new MolajoLayoutHelper();
$this->layoutHelper->setLayoutDriver ('editdata');
$this->layoutHelper->setLayout ('editdata');

require $this->layoutHelper->getPath ('driver.php');