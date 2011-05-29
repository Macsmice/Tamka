<?php
/**
 * @version     $id: driver.php
 * @package     Molajo
 * @subpackage  Item Layout
 * @copyright   Copyright (C) 2011 Amy Stephen. All rights reserved.
 * @license     GNU General Public License Version 2, or later http://www.gnu.org/licenses/gpl.html
 */
defined('MOLAJO') or die;

/**
 * The following file automatically includes the following CSS and JS Files
 *
 * 1. Standard site-wide CSS and JS in -> media/site/css[js]/site.css[js]
 * 2. Component specific CSS and JS in -> media/site/css[js]/component_option.css[js]
 * 3. Any CSS file in the CSS sub-folder
 * 4. Any JS file in the JS sub-folder
 *
 * Note: rtl files
 */
require_once MOLAJO_LAYOUTS.'/include.php';

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