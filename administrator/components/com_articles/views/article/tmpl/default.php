<?php
/**
 * @version     $id: layout.php
 * @package     Molajo
 * @subpackage  Layout Helper
 * @copyright   Copyright (C) 2011 Amy Stephen. All rights reserved.
 * @license     GNU General Public License Version 2, or later http://www.gnu.org/licenses/gpl.html
 */
defined('MOLAJO') or die;

$this->layoutHelper = new MolajoLayoutHelper();
$this->layoutFolder = $this->layoutHelper->driver ('edit', $this->option, $this->view, '/driver.php');
if ($this->layoutFolder === false) {
    return false;
} else {
    include $this->layoutFolder;
}