<?php
/**
 * @version     $id: driver.php
 * @package     Molajo
 * @subpackage  Item Layout
 * @copyright   Copyright (C) 2011 Amy Stephen. All rights reserved.
 * @license     GNU General Public License Version 2, or later http://www.gnu.org/licenses/gpl.html
 */
defined('MOLAJO') or die;

/** css and js: */
/** component specific css and js - media/com_componentname/css[js]/viewname.css[js] **/
require_once MOLAJO_LAYOUTS.'/standard.php';

/** first content event **/
// echo JHtml::_('content.prepare', $this->category->description);
//echo $this->recordset->event->afterDisplayContent;

/** process recordset **/
foreach ($this->recordset as $this->row) {
    $this->tempCount++;

    /** header - beginning of layout */
    if ($this->tempCount == 1) {
        if (file_exists(dirname(__FILE__).'/layouts/header.php')) {
            include dirname(__FILE__).'/layouts/header.php';
        }

        echo $this->row->event->afterDisplayTitle;

        echo $this->row->event->beforeDisplayContent;
    }

    /** body - once for each row in the recordset */
    if (file_exists(dirname(__FILE__).'/layouts/body.php')) {
        include dirname(__FILE__).'/layouts/body.php';
    }
}

/** footer - end of layout */
if (file_exists(dirname(__FILE__).'/layouts/footer.php')) {
    include dirname(__FILE__).'/layouts/footer.php';
}

echo $this->row->event->afterDisplayContent;