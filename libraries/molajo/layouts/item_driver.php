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
 *  1. Load Language Files
 */
// do that here

/**
 *  2. Process Document Head
 */
if ($this->options->get('component_format')) == 'html' && ($thisisreallyacomponent) {
//  $documentHelper = new MolajoDocumentHelper ();
//  $documentHelper->prepareDocument($this->params, $this->item, $this->document, JRequest::getCmd('option'), JRequest::getCmd('view'));
}

/**
 *  3. Toolbar and Submenu
 */
if ($this->options->get('component_layout')) == 'modal' || (!$this->options->get('component_format') == 'html')) {
} else {

    /** component level user permissions **/
    $aclClass = ucfirst($this->options->get('component_default_view')).'ACL';
    $this->userToolbarButtonPermissions = $aclClass::getUserToolbarButtonPermissions ($this->options->get('component_option'), $this->options->get('component_single_view'), $this->options->get('component_task'));

    $toolbar = new MolajoToolbarHelper ();
    $toolbar->addButtonsDefaultLayout ($this->options->get('filter.options'), $this->userToolbarButtonPermissions);

    MolajoSubmenuHelper::add();
}

/**
 * 3. Load CSS and JS
 *
 * Automatically includes the following files (if existing)
 *
 * 1. Standard site-wide CSS and JS in => media/site/css[js]/site.css[js]
 * 2. Component specific CSS and JS in => media/site/css[js]/component_option.css[js]
 * 3. Any CSS file in the CSS sub-folder => css/filenames.css
 * 4. Any JS file in the JS sub-folder => js/filenames.js
 *
 * Note: Right-to-left css files should begin with rtl_
 */
if ($this->option->get('layout_loadSiteCSS', true) === true) {
    /** standard site-wide css and js - media/site/css[js]/viewname.css[js] **/
    if (JFile::exists(JPATH_BASE.'/media/site/css/site.css')) {
        $this->document->addStyleSheet(JURI::base().'/site/css/site.css');
    }
    if ($this->document->direction == 'rtl') {
        if (JFile::exists(JPATH_BASE.'/media/site/css/site_rtl.css')) {
            $this->document->addStyleSheet(JURI::base().'/media/site/css/site_rtl.css');
        }
    }
}

if ($this->option->get('layout_loadSiteJS', true) === true) {
    if (JFile::exists(JPATH_BASE.'/media/site/js/site.js')) {
        $this->document->addScript(JURI::base().'/media/site/js/site.js');
    }
}

/** component specific css and js - media/site/css[js]/component_option.css[js] **/
if ($this->option->get('layout_loadComponentCSS', true) === true) {
    if (JFile::exists(JPATH_BASE.'/media/site/css/'.$this->options->get('component_option').'.css')) {
        $this->document->addStyleSheet(JURI::base().'/media/site/css/'.$this->options->get('component_option').'.css');
    }
}
    
if ($this->option->get('layout_loadComponentJS', true) === true) {
    if (JFile::exists(JPATH_BASE.'/media/site/js/'.$this->options->get('component_option').'.js')) {
        $this->document->addScript(JURI::base().'media/site/js/'.$this->options->get('component_option').'.js');
    }
}
    
/** Load Layout CSS (if exists in layout CSS folder) */
if ($this->option->get('layout_loadLayoutCSS', true) === true) {
    $files = JFolder::files($this->layoutFolder.'/css', '\.css', false, false);
    foreach ($files as $file) {
        if (substr(strtolower($file), 0, 4) == 'rtl_' && $this->document->direction = 'rtl') {
            $this->document->addStyleSheet($this->layoutFolder.'/css/'.$file);
        } else {
            $this->document->addStyleSheet($this->layoutFolder.'/css/'.$file);
        }
    }
}
    
/** Load Layout JS (if exists in layout JS folder) */
if ($this->option->get('layout_loadLayoutJS', true) === true) {
    $files = JFolder::files($this->layoutFolder.'/js', '\.js', false, false);
    foreach ($files as $file) {
        if (substr(strtolower($file), 0, 4) == 'rtl_' && $this->document->direction = 'rtl') {
            $this->document->addStyleSheet($this->layoutFolder.'/js/'.$file);
        } else {
            $this->document->addStyleSheet($this->layoutFolder.'/js/'.$file);
        }
    }
}

/**
 * 4. Process the Recordset 
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