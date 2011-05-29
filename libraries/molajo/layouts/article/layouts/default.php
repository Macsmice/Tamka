<?php
/**
 * @version		$Id: default.php 21321 2011-05-11 01:05:59Z dextercowley $
 * @package		Joomla.Site
 * @subpackage	com_content
 * @copyright	Copyright (C) 2005 - 2011 Open Source Matters, Inc. All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */

// no direct access
defined('_JEXEC') or die;

JHtml::addIncludePath(JPATH_COMPONENT.DS.'helpers');

// Create shortcuts to some parameters.
$params		= $this->options;
$canEdit	= $this->options->get('access-edit');
$user		= JFactory::getUser();
?>
<div class="item-page<?php echo $this->options->get('page_class_suffix', ''); ?>">
<?php if ($this->options->get('show_page_heading', 1)) : ?>
	<h1>
	<?php echo $this->escape($this->options->get('page_heading')); ?>
	</h1>
<?php endif; ?>
<?php if ($params->get('show_title')) : ?>
	<h2>
	<?php if ($params->get('link_titles') && !empty($this->row->readmore_link)) : ?>
		<a href="<?php echo $this->row->readmore_link; ?>">
		<?php echo $this->escape($this->row->title); ?></a>
	<?php else : ?>
		<?php echo $this->escape($this->row->title); ?>
	<?php endif; ?>
	</h2>
<?php endif; ?>

<?php if ($canEdit ||  $params->get('show_print_icon') || $params->get('show_email_icon')) : ?>
	<ul class="actions">
	<?php if (!$this->print) : ?>
		<?php if ($params->get('show_print_icon')) : ?>
			<li class="print-icon">
			<?php echo JHtml::_('icon.print_popup',  $this->row, $params); ?>
			</li>
		<?php endif; ?>

		<?php if ($params->get('show_email_icon')) : ?>
			<li class="email-icon">
			<?php echo JHtml::_('icon.email',  $this->row, $params); ?>
			</li>
		<?php endif; ?>

		<?php if ($canEdit) : ?>
			<li class="edit-icon">
			<?php echo JHtml::_('icon.edit', $this->row, $params); ?>
			</li>
		<?php endif; ?>

	<?php else : ?>
		<li>
		<?php echo JHtml::_('icon.print_screen',  $this->row, $params); ?>
		</li>
	<?php endif; ?>

	</ul>
<?php endif; ?>

<?php  if (!$params->get('show_intro')) :
	echo $this->row->event->afterDisplayTitle;
endif; ?>

<?php echo $this->row->event->beforeDisplayContent; ?>

<?php $useDefList = (($params->get('show_author')) OR ($params->get('show_category')) OR ($params->get('show_parent_category'))
	OR ($params->get('show_create_date')) OR ($params->get('show_modify_date')) OR ($params->get('show_publish_date'))
	OR ($params->get('show_hits'))); ?>

<?php if ($useDefList) : ?>
	<dl class="article-info">
	<dt class="article-info-term"><?php  echo JText::_('COM_CONTENT_ARTICLE_INFO'); ?></dt>
<?php endif; ?>
<?php if ($params->get('show_parent_category') && $this->row->parent_slug != '1:root') : ?>
	<dd class="parent-category-name">
	<?php	$title = $this->escape($this->row->parent_title);
	$url = '<a href="'.JRoute::_(ContentHelperRoute::getCategoryRoute($this->row->parent_slug)).'">'.$title.'</a>';?>
	<?php if ($params->get('link_parent_category') AND $this->row->parent_slug) : ?>
		<?php echo JText::sprintf('COM_CONTENT_PARENT', $url); ?>
	<?php else : ?>
		<?php echo JText::sprintf('COM_CONTENT_PARENT', $title); ?>
	<?php endif; ?>
	</dd>
<?php endif; ?>
<?php if ($params->get('show_category')) : ?>
	<dd class="category-name">
	<?php 	$title = $this->escape($this->row->category_title);
	$url = '<a href="'.JRoute::_(ContentHelperRoute::getCategoryRoute($this->row->catslug)).'">'.$title.'</a>';?>
	<?php if ($params->get('link_category') AND $this->row->catslug) : ?>
		<?php echo JText::sprintf('COM_CONTENT_CATEGORY', $url); ?>
	<?php else : ?>
		<?php echo JText::sprintf('COM_CONTENT_CATEGORY', $title); ?>
	<?php endif; ?>
	</dd>
<?php endif; ?>
<?php if ($params->get('show_create_date')) : ?>
	<dd class="create">
	<?php echo JText::sprintf('COM_CONTENT_CREATED_DATE_ON', JHtml::_('date',$this->row->created, JText::_('DATE_FORMAT_LC2'))); ?>
	</dd>
<?php endif; ?>
<?php if ($params->get('show_modify_date')) : ?>
	<dd class="modified">
	<?php echo JText::sprintf('COM_CONTENT_LAST_UPDATED', JHtml::_('date',$this->row->modified, JText::_('DATE_FORMAT_LC2'))); ?>
	</dd>
<?php endif; ?>
<?php if ($params->get('show_publish_date')) : ?>
	<dd class="published">
	<?php echo JText::sprintf('COM_CONTENT_PUBLISHED_DATE', JHtml::_('date',$this->row->publish_up, JText::_('DATE_FORMAT_LC2'))); ?>
	</dd>
<?php endif; ?>
<?php if ($params->get('show_author') && !empty($this->row->author )) : ?>
	<dd class="createdby">
	<?php $author =  $this->row->author; ?>
	<?php $author = ($this->row->created_by_alias ? $this->row->created_by_alias : $author);?>

	<?php if (!empty($this->row->contactid ) &&  $params->get('link_author') == true):?>
		<?php 	echo JText::sprintf('COM_CONTENT_WRITTEN_BY' ,
		 JHtml::_('link',JRoute::_('index.php?option=com_contact&view=contact&id='.$this->row->contactid),$author)); ?>

	<?php else :?>
		<?php echo JText::sprintf('COM_CONTENT_WRITTEN_BY', $author); ?>
	<?php endif; ?>
	</dd>
<?php endif; ?>
<?php if ($params->get('show_hits')) : ?>
	<dd class="hits">
	<?php echo JText::sprintf('COM_CONTENT_ARTICLE_HITS', $this->row->hits); ?>
	</dd>
<?php endif; ?>
<?php if ($useDefList) : ?>
	</dl>
<?php endif; ?>

<?php if (isset ($this->row->toc)) : ?>
	<?php echo $this->row->toc; ?>
<?php endif; ?>
<?php if ($params->get('access-view')):?>
	<?php echo $this->row->text; ?>

	<?php //optional teaser intro text for guests ?>
<?php elseif ($params->get('show_noauth') == true AND  $user->get('guest') ) : ?>
	<?php echo $this->row->introtext; ?>
	<?php //Optional link to let them register to see the whole article. ?>
	<?php if ($params->get('show_readmore') && $this->row->fulltext != null) :
		$link1 = JRoute::_('index.php?option=com_users&view=login');
		$link = new JURI($link1);?>
		<p class="readmore">
		<a href="<?php echo $link; ?>">
		<?php $attribs = json_decode($this->row->attribs);  ?>
		<?php
		if ($attribs->alternative_readmore == null) :
			echo JText::_('COM_CONTENT_REGISTER_TO_READ_MORE');
		elseif ($readmore = $this->row->alternative_readmore) :
			echo $readmore;
			if ($params->get('show_readmore_title', 0) != 0) :
			    echo JHtml::_('string.truncate', ($this->row->title), $params->get('readmore_limit'));
			endif;
		elseif ($params->get('show_readmore_title', 0) == 0) :
			echo JText::sprintf('COM_CONTENT_READ_MORE_TITLE');
		else :
			echo JText::_('COM_CONTENT_READ_MORE');
			echo JHtml::_('string.truncate', ($this->row->title), $params->get('readmore_limit'));
		endif; ?></a>
		</p>
	<?php endif; ?>
<?php endif; ?>
<?php echo $this->row->event->afterDisplayContent; ?>
</div>