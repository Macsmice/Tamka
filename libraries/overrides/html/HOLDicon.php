<?php
/**
 * @version		$Id: icon.php 20484 2011-01-30 16:27:23Z dextercowley $
 * @package		Joomla.Site
 * @subpackage	com_dogs
 * @copyright	Copyright (C) 2005 - 2011 Open Source Matters, Inc. All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */

// no direct access
defined('JPATH_PLATFORM') or die;

/**
 * Dog Component HTML Helper
 *
 * @static
 * @package		Joomla.Site
 * @subpackage	com_dogs
 * @since 1.5
 */
class JHTMLIcon
{
	static function create($dog, $params)
	{
		$uri = JFactory::getURI();

		$url = 'index.php?option=com_dogs&task=dog.add&return='.base64_encode($uri).'&a_id=0';

		if ($params->get('show_icons')) {
			$text = JHTML::_('image','system/new.png', JText::_('JNEW'), NULL, true);
		} else {
			$text = JText::_('JNEW').'&#160;';
		}

		$button =  JHTML::_('link',JRoute::_($url), $text);

		$output = '<span class="hasTip" title="'.JText::_('COM_DOGS_CREATE_ARTICLE').'">'.$button.'</span>';
		return $output;
	}

	static function email($dog, $params, $attribs = array())
	{
		require_once(JPATH_SITE.DS.'components'.DS.'com_mailto'.DS.'helpers'.DS.'mailto.php');
		$uri	= JURI::getInstance();
		$base	= $uri->toString(array('scheme', 'host', 'port'));
		$template = JFactory::getApplication()->getTemplate();
		$link	= $base.JRoute::_(DogHelperRoute::getDogRoute($dog->slug, $dog->catid) , false);
		$url	= 'index.php?option=com_mailto&tmpl=component&template='.$template.'&link='.MailToHelper::addLink($link);

		$status = 'width=400,height=350,menubar=yes,resizable=yes';

		if ($params->get('show_icons')) {
			$text = JHTML::_('image','system/emailButton.png', JText::_('JGLOBAL_EMAIL'), NULL, true);
		} else {
			$text = '&#160;'.JText::_('JGLOBAL_EMAIL');
		}

		$attribs['title']	= JText::_('JGLOBAL_EMAIL');
		$attribs['onclick'] = "window.open(this.href,'win2','".$status."'); return false;";

		$output = JHTML::_('link',JRoute::_($url), $text, $attribs);
		return $output;
	}

	/**
	 * Display an edit icon for the dog.
	 *
	 * This icon will not display in a popup window, nor if the dog is trashed.
	 * Edit access checks must be performed in the calling code.
	 *
	 * @param	object	$dog	The dog in question.
	 * @param	object	$params		The dog parameters
	 * @param	array	$attribs	Not used??
	 *
	 * @return	string	The HTML for the dog edit icon.
	 * @since	1.6
	 */
	static function edit($dog, $params, $attribs = array())
	{
		// Initialise variables.
		$user	= JFactory::getUser();
		$userId	= $user->get('id');
		$uri	= JFactory::getURI();

		// Ignore if in a popup window.
		if ($params && $params->get('popup')) {
			return;
		}

		// Ignore if the state is negative (trashed).
		if ($dog->state < 0) {
			return;
		}

		JHtml::_('behavior.tooltip');

		$url	= 'index.php?task=dog.edit&a_id='.$dog->id.'&return='.base64_encode($uri);
		$icon	= $dog->state ? 'edit.png' : 'edit_unpublished.png';
		$text	= JHTML::_('image','system/'.$icon, JText::_('JGLOBAL_EDIT'), NULL, true);

		if ($dog->state == 0) {
			$overlib = JText::_('JUNPUBLISHED');
		}
		else {
			$overlib = JText::_('JPUBLISHED');
		}

		$date = JHTML::_('date',$dog->created);
		$author = $dog->created_by_alias ? $dog->created_by_alias : $dog->author;

		$overlib .= '&lt;br /&gt;';
		$overlib .= $date;
		$overlib .= '&lt;br /&gt;';
		$overlib .= JText::sprintf('COM_DOGS_WRITTEN_BY', htmlspecialchars($author, ENT_COMPAT, 'UTF-8'));

		$button = JHTML::_('link',JRoute::_($url), $text);

		$output = '<span class="hasTip" title="'.JText::_('COM_DOGS_EDIT_ITEM').' :: '.$overlib.'">'.$button.'</span>';

		return $output;
	}


	static function print_popup($dog, $params, $attribs = array())
	{
		$url  = DogHelperRoute::getDogRoute($dog->slug, $dog->catid);
		$url .= '&tmpl=component&print=1&layout=default&page='.@ $request->limitstart;

		$status = 'status=no,toolbar=no,scrollbars=yes,titlebar=no,menubar=no,resizable=yes,width=640,height=480,directories=no,location=no';

		// checks template image directory for image, if non found default are loaded
		if ($params->get('show_icons')) {
			$text = JHTML::_('image','system/printButton.png', JText::_('JGLOBAL_PRINT'), NULL, true);
		} else {
			$text = JText::_('JGLOBAL_ICON_SEP') .'&#160;'. JText::_('JGLOBAL_PRINT') .'&#160;'. JText::_('JGLOBAL_ICON_SEP');
		}

		$attribs['title']	= JText::_('JGLOBAL_PRINT');
		$attribs['onclick'] = "window.open(this.href,'win2','".$status."'); return false;";
		$attribs['rel']		= 'nofollow';

		return JHTML::_('link',JRoute::_($url), $text, $attribs);
	}

	static function print_screen($dog, $params, $attribs = array())
	{
		// checks template image directory for image, if non found default are loaded
		if ($params->get('show_icons')) {
			$text = JHTML::_('image','system/printButton.png', JText::_('JGLOBAL_PRINT'), NULL, true);
		} else {
			$text = JText::_('JGLOBAL_ICON_SEP') .'&#160;'. JText::_('JGLOBAL_PRINT') .'&#160;'. JText::_('JGLOBAL_ICON_SEP');
		}
		return '<a href="#" onclick="window.print();return false;">'.$text.'</a>';
	}

}
