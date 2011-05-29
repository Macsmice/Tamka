<?php
/**
 * @version     $id: item.php
 * @package     Molajo
 * @subpackage  Standard Driver
 * @copyright   Copyright (C) 2011 Amy Stephen. All rights reserved.
 * @license     GNU General Public License Version 2, or later http://www.gnu.org/licenses/gpl.html
 */
defined('MOLAJO') or die;
/**
 * Standard Layout Processing
 */
include 'include_standard.php';

/**
 * Single Item Recordset
 *
 * Automatically includes the following files (if existing)
 *
 * A. Before first row => layoutFolder/layouts/header.php
 * B. For each row in the recordset => layoutFolder/layouts/body.php
 * C. After the last row in the recordset => layoutFolder/layouts/footer.php
 * 
 */
foreach ($this->recordset as $this->row) {

    $this->rowCount++;

    /** header - beginning of layout */
    if ($this->rowCount == 1) {
        if (file_exists($this->layoutFolder.'/layouts/header.php')) {
            include $this->layoutFolder.'/layouts/header.php';
        }

        /** event: After Display of Title */
        echo $this->row->event->afterDisplayTitle;

        /** event: Before Content Display */
        echo $this->row->event->beforeDisplayContent;
    }

    /** body - once for each row in the recordset */
    if (file_exists($this->layoutFolder.'/layouts/body.php')) {
        include $this->layoutFolder.'/layouts/body.php';
    }
}

/** footer - end of layout */
if (file_exists($this->layoutFolder.'/layouts/footer.php')) {
    include $this->layoutFolder.'/layouts/footer.php';
}

/** event: After Layout is finished */
echo $this->row->event->afterDisplayContent;