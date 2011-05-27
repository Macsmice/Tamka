<?php
/**
 * @package     Molajo
 * @subpackage  Molajo Responses Activity Log
 * @copyright   Copyright (C) 2011 Amy Stephen. All rights reserved.
 * @license     GNU General Public License Version 2, or later http://www.gnu.org/licenses/gpl.html
 */
defined('MOLAJO') or die();

jimport( 'joomla.plugin.plugin' );

class ResponsesActivityLog extends JPlugin
{
	function onAfterDisplayContent( &$article, &$params, $limitstart )
	{
	/**
	 * 		Get Print Parameter
	*/
		$uri =& JFactory::getURI();
		$query = $uri->getQuery(true);
		if(isset($query['print'])) {
			$print = $query['print'];
		} else {
			$print = false;
		}
		
		$option = JRequest::getVar('option');
		if($option == "com_articles") {
		} else {
			return;
		}		
		$model = JModel::getInstance(‘menu’, ‘MyGolfModel’);
	/**
	 * 	Parameters
	 */
		$plugin =& JPluginHelper::getPlugin('content', 'tamka_comments');
		$pluginParams = new JParameter( $plugin->params );
				
		$showCategoriesAll = false;
		$showCategories = explode(',', $pluginParams->get('categories'));
		if ($pluginParams->get('categories')) {
		} else {
			$showCategoriesAll = true;
		}
		$includeorexclude = $pluginParams->def('include_or_exclude', 'Include');

		// 	Is it the right Category?
		$show = false;
		if ($article->sectionid == 0 && $article->catid == 0) {
			$show = false;
			return;
		}
		if ($includeorexclude == 'Include' && (in_array($article->catid, $showCategories) || $showCategoriesAll)) {
			$show = true;
		}
		if ($includeorexclude == 'Exclude' && (in_array($article->catid, $showCategories) == false) && ($showCategoriesAll == false)) {
			$show = true;
		}
		if ($show == false) {
			return;
		}
 
		//	For Frontpage and Blog layouts, see if comment link is desired
		$frontpage = $pluginParams->def('frontpage', '0');	
		$bloglayout = $pluginParams->def('bloglayout', '0');
				
		$view = JRequest::getVar('view');
		if ((($view == "frontpage") || ($params->get('frontpage', 0) == 1)) && ($frontpage == 0) ) {
			return;
		}
		$view = JRequest::getVar('view');
		if (($view == "blog") && ($bloglayout == 0) ) {
			return;
		}
						
		//	Have comments been manually turned off? (no comments will be added or printed)
		$result = stristr($article->text, "{no comments}");
 		if ($result) {
			$article->text = str_replace( "{no comments}", "", $article->text );
			return;
 		}
		//	Are comments closed? (no new comments allowed, existing will be printed)
		$closeComments = false;
		$result = stristr($article->text, "{close comments}");
 		if ($result) {
			$article->text = str_replace( "{close comments}", "", $article->text );
			$commentsExpiredMessage = $pluginParams->def('closedmessage', JText::_( 'Comments are now closed.') );
			$closeComments = true;			
 		}
		 		 		
		//	Get an instance of the Tamka Comments Post Module
		$document =& JFactory::getDocument();
		$moduleRenderer	= $document->loadRenderer('module');
		$module	= JModuleHelper::getModule('mod_tamka_comments_post');
		$output = '';

		//	Print the # of comments (unless print view)
		if ($print == false) {
			$module->params	= "layout=commentcount\narticleid=".$article->id."\nclosecomments=".$closeComments;
			$output = $moduleRenderer->render($module, 'raw');
		}

		//	Only print comment count and link to comments for non-article page
		$view = JRequest::getVar('view','article');
		if ($view == 'article') {

			//	Print existing article comments
			$module	= JModuleHelper::getModule('mod_tamka_comments_post');
			$module->params	= "layout=default\narticleid=".$article->id;
			$output .= $moduleRenderer->render($module, 'raw');

			// 	Print the comment form - layout: form
			if ($closeComments) {
			} else if ($print == false) {
				$module	= JModuleHelper::getModule('mod_tamka_comments_post');
				$module->params	= "layout=form\narticleid=".$article->id;
				$output .= $moduleRenderer->render($module, 'raw');
			}
		}
		
		/**
		 * 	Write the comment output (Count, Existing Comments, Form) from the Module to the end of the Article Text
		 */
		$article->text .= $output;
		
		/**
		 * Follow with Close Message, if appropriate
		 */
 		if ($closeComments == true) {
			$article->text .= '<h3>' . $commentsExpiredMessage . '</h3>';
 		}
	}
}