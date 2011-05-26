<?php
/**
 * @version     $id: blog.php
 * @package     Molajo
 * @subpackage  List
 * @copyright   Copyright (C) 2011 Individual Molajo Contributors. All rights reserved.
 * @license     GNU General Public License Version 2, or later http://www.gnu.org/licenses/gpl.html
 */
defined('MOLAJO') or die;
$this->layoutHelper = new MolajoLayoutHelper();
$this->layoutHelper->setLayoutDriver ('blog');
$this->layoutHelper->setLayout ('blog');
require $this->layoutHelper->getPath ('driver.php');