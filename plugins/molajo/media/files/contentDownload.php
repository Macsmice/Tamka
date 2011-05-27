<?php
/**
 * @package     Molajo
 * @subpackage  Molajo Content Download Plugin
 * @copyright   Copyright (C) 2011 Amy Stephen. All rights reserved.
 * @license     GNU General Public License Version 2, or later http://www.gnu.org/licenses/gpl.html
 */
defined('MOLAJO') or die();

jimport( 'joomla.plugin.plugin' );

class plgMolajoContentLinktype extends JPlugin
{

	function onAfterDisplayContent( &$article, &$params, $limitstart )
	{
		//	Exit if post has no tags
		if ($article->metakey) {
		} else {
			return;
		}

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
		if ($print == true) {
			return;
		}
		
	/**
	 * Make certain Tamka Library is ready to load
	 */
		if (!file_exists(JPATH_PLUGINS . DS . 'system' . DS . 'tamka.php')) {
			JError::raiseWarning( '700', JText::_('The Tamka Library is required for this extension.' ));
			return NULL;
		}
		if (!function_exists('tamkaimport')) {
			JError::raiseWarning( '725', JText::_('The Tamka Library must be enabled for this extension.' ));
			return NULL;
		}
		if (!version_compare('0.1', 'TAMKA')) {
			JError::raiseWarning( '750', JText::_('The Tamka Library Version is outdated.' ));
			return NULL;
		}
		tamkaimport('tamka.routehelper.content');
		
		//	Add CSS
		$document =& JFactory::getDocument();
		$document->addStyleSheet( JURI::base() . 'plugins/content/tamka_article_tags/tamkatags.css' );

		$formatOutput = "";

		//	Retrieve Blog Home URL
		$blogHomeURL = TamkaContentHelperRoute::getBlogHomeURLforArticle ($article->id);
		
		//	Retrieve Plugin Parameters for Router
		$routerPlugin 	=& JPluginHelper::getPlugin( 'system', 'tamka_router');
		$routerParams 	= new JParameter($routerPlugin->params);

		//	Database call
		$db		= &JFactory::getDBO();
		$config	= &JFactory::getConfig();

		$query	= 'SELECT tag, alias FROM ' . $db->nameQuote('#__tamka_tags') .
			' WHERE ' . $db->nameQuote('component') . ' = "com_articles" ' .
			'   AND ' . $db->nameQuote('component_item_id') . ' = ' . $article->id .
			'   ORDER BY ' . $db->nameQuote('tag') ;

        $db->setQuery($query);
		$rows = $db->loadObjectList();

		if (count($rows)) {
			$formatOutput = '<div class="tamka_article_tags"><p>' . JText::_(' Tags: ') ;
			$comma = ' ';

			foreach ( $rows as $row )	{
				$formatOutput .= $comma . '<span class="tamka-post-tag"><a href="' . $blogHomeURL . '/' . $routerParams->def('tagbase', 'tag') . '/' . $row->alias . '">' . $row->tag . '</a></span>';
				$comma = ', ';
			}
		$formatOutput .= '</p></div>';
		}
		$article->text .= $formatOutput;
	}

	function onAfterContentSave( &$article, $isNew )
	{

	/**
	 * 	Initialization
	 */
		$db		= &JFactory::getDBO();
		$config	= &JFactory::getConfig();

	/**
	 * 	Delete Existing Tags
	 */
		$query	= 'DELETE FROM ' . $db->nameQuote('#__tamka_tags') .
			' WHERE ' . $db->nameQuote('component') . ' = "com_articles" ' .
			'   AND ' . $db->nameQuote('component_item_id') . ' = ' . $article->id;

            $db->setQuery($query);
            if (!$db->query()) {
            	$mainframe->enqueueMessage($db->getErrorMsg());
                $this->setError($db->getErrorMsg());
                return false;
            }

	/**
	 * 	Extract Tags
	 */
		$postTags = explode (',', $article->metakey);

	/**
	 * 	Insert New Tags
	 */
		foreach ( $postTags as $tag) {
			$tagAlias = JFilterOutput::stringURLSafe(trim($tag));
			if(trim(str_replace('-','',$tag)) == '') {
			} else {

				$query	= 'INSERT INTO #__tamka_tags										' .
					' (component, component_item_id, tag, alias, tag_type )				' .
					' SELECT "com_articles", ' . $article->id . ', "' . $tag . '", "' . $tagAlias . '", "post"';

	            $db->setQuery($query);
	            if (!$db->query()) {
	            	$mainframe->enqueueMessage($db->getErrorMsg());
	                $this->setError($db->getErrorMsg());
	                return false;
	            }
            }
		}
		return;
	}
}