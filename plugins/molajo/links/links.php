<?php
/**
 * @package     Molajo
 * @subpackage  Molajo Content
 * @copyright   Copyright (C) 2011 Amy Stephen. All rights reserved.
 * @license     GNU General Public License Version 2, or later http://www.gnu.org/licenses/gpl.html
 */
defined('MOLAJO') or die();
jimport('joomla.plugin.plugin');

class plgMolajoLinks extends JPlugin	{

    /**
     * @var string	Stores name of data element containing text for content object
     * @since	1.6
     */
    protected $location;
    
    /**
     * plgMolajoLinks::MolajoOnContentPrepare
     *
     * Content Component Plugin that applies text and URL functions to content object
     *
     * @param	string		The context for the content passed to the plugin.
     * @param	object		The content object.
     * @param	object		The content params
     * @param	stromg		The 'page' number
     * @return	string
     * @since	1.6
     */
    function MolajoOnContentPrepare ($context, &$content, &$params, $page = 0)
    {
return;
        /** init **/
        if (!plgMolajoLinks::initialization ($context, $content)) {
            return;
        }

        /** parameters **/
        $molajoSystemPlugin =& JPluginHelper::getPlugin('system', 'molajo');
        $systemParams = new JParameter($molajoSystemPlugin->params);
        $loc = $this->location;

        /** add links for URLs **/
        if ($systemParams->def('enable_add_line_breaks', 0) == 1) {
//            $content->$loc = MolajoHelperURLs::addLinks ($content->$loc);
        }

        /** external link treatment **/
        if (isset($query['print']) && $query['print']) {
        } else {
            if ($systemParams->def('enable_external_links', 0) == 1) {
                require_once dirname(__FILE__) . '/externallinks/driver.php';
                MolajoLinksExternalLinks::driver ($context, &$content, &$params, $page = 0, $this->location);
            }
        }

        /** footnotes **/
        if ($systemParams->def('enable_footnotes', 0) == 1 && isset($query['print']) && $query['print']) {
            require_once dirname(__FILE__) . '/footnotes/driver.php';
            MolajoLinksFootnotes::driver ($context, &$content, &$params, $page = 0, $this->location);
        }

        return;
    }
    
    /**
     * initialization
     * @param string $context
     * @param object $content
     * @return binary
     */
    function initialization ($context, $content) {

        /** request values **/
        $option = JRequest::getVar('option');
        $view = JRequest::getVar('view');
        if (($view == 'archive') || ($view == 'featured') || ($view == 'category') || ($view == 'categories')) {
            $multiple = true;
        } else {
            $multiple = false;
        }

        /** text location **/
        $this->location = '';
        if ($multiple == true) {
            if (isset($content->introtext)) {
                $this->location = 'introtext';
            } elseif (isset($content->text)) {
                $this->location = 'text';
            }
        } else {
            if (isset($content->text)) {
                $this->location = 'text';
            }
        }
//$this->location = 'introtext';
        if ($this->location == '') {
            return false;
        }
        return true;
    }
}