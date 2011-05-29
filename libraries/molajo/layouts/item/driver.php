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
 * MOLAJO_LAYOUTS.'/include.php' automatically:
 *
 * 1. Loads Language files:
 *
 * A. layout/current-language/etc
 * B. layout/this-layout-folder/current-language/etc
 *
 * 2. Processes the Document Head (for the primary component layout)
 *
 * 3. Includes CSS and JS (unless the switches are off, below)
 *
 * A. Standard site-wide CSS and JS in => media/site/css[js]/site.css[js]
 * B. Component specific CSS and JS in => media/site/css[js]/component_option.css[js]
 * C. Any CSS file in the CSS sub-folder => css/filenames.css
 * D. Any JS file in the JS sub-folder => js/filenames.js
 *
 * Note: Right-to-left css files should begin with rtl_
 *
 * 4. Processes the recordset by including the following files (if existing):
 *
 * A. Before first row => layoutFolder/layouts/header.php
 * B. Displays the Event afterDisplayTitle results
 * C. Displays the Event beforeDisplayContent results
 * D. For each row in the recordset => layoutFolder/layouts/body.php
 * E. After the last row in the recordset => layoutFolder/Layouts/footer.php
 * F.
 *
 */
$this->option->get('layout_loadSiteCSS') = true;
$this->option->get('layout_loadSiteJS') = true;
$this->option->get('layout_loadComponentCSS') = true;
$this->option->get('layout_loadComponentJS') = true;
$this->option->get('layout_loadLayoutCSS') = true;
$this->option->get('layout_loadLayoutJS') = true;

require_once MOLAJO_LAYOUTS.'/item_driver.php';
