<?php
/**
 * @version     $id: layout
 * @package     Molajo
 * @subpackage  Multiple View
 * @copyright   Copyright (C) 2011 Amy Stephen. All rights reserved.
 * @license     GNU General Public License Version 2, or later http://www.gnu.org/licenses/gpl.html
 */
defined('MOLAJO') or die; 

/** table body begin **/
require $this->layoutHelper->getPath ('table_body_begin.php');

/** table body row **/
foreach ($this->recordset as $this->row) {
    $this->tempCount++;
    require $this->layoutHelper->getPath ('driver_table_body_row.php');
}

/** table body end **/
require $this->layoutHelper->getPath ('table_body_end.php');