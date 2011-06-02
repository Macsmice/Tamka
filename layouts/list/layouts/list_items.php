<?php
/**
 * @version		$Id: default_articles.php 21020 2011-03-27 06:52:01Z infograf768 $
 * @package		Joomla.Site
 * @subpackage	com_articles
 * @copyright	Copyright (C) 2005 - 2011 Open Source Matters, Inc. All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */

// no direct access
defined('JPATH_PLATFORM') or die;

JHtml::addIncludePath(JPATH_COMPONENT.'/helpers/html');
JHtml::_('behavior.tooltip');
JHtml::core();

// Create some shortcuts.
$params		= $this->row->params;
$n			= count($this->recordset);
?>

<?php if (empty($this->recordset)) : ?>

	<?php if ($this->state->get('show_no_articles',1)) : ?>
	<p><?php echo JText::_('COM_CONTENT_NO_ARTICLES'); ?></p>
	<?php endif; ?>

<?php else : ?>

<form action="<?php echo JFilterOutput::ampReplace(JFactory::getURI()->toString()); ?>" method="post" name="adminForm" id="adminForm">
	<?php if ($this->state->get('filter.field') != 'hide') :?>
	<fieldset class="filters">
		<legend class="hidelabeltxt">
			<?php echo JText::_('JGLOBAL_FILTER_LABEL'); ?>
		</legend>

		<div class="filter-search">
			<label class="filter-search-lbl" for="filter-search"><?php echo JText::_('COM_CONTENT_'.$this->state->get('filter.field').'_FILTER_LABEL').'&#160;'; ?></label>
			<input type="text" name="filter-search" id="filter-search" value="<?php echo $this->escape($this->queryState->get('list.filter')); ?>" class="inputbox" onchange="document.adminForm.submit();" title="<?php echo JText::_('COM_CONTENT_FILTER_SEARCH_DESC'); ?>" />
		</div>
		<?php endif; ?>

		<?php if ($this->state->get('show_pagination_limit')) : ?>
		<div class="display-limit">
			<?php echo JText::_('JGLOBAL_DISPLAY_NUM'); ?>&#160;
			<?php echo $this->pagination->getLimitBox(); ?>
		</div>
		<?php endif; ?>

	<?php if ($this->state->get('filter.field') != 'hide') :?>
	
		<!-- @TODO add hidden inputs -->
		<input type="hidden" name="filter_order" value="" />
		<input type="hidden" name="filter_order_Dir" value="" />
		<input type="hidden" name="limitstart" value="" />
	</fieldset>
	<?php endif; ?>

	<table class="category">
		<?php if ($this->state->get('show_headings')) :?>
		<thead>
			<tr>
				<th class="list-title" id="tableOrdering">
					<?php  echo JHtml::_('grid.sort', 'JGLOBAL_TITLE', 'a.title', $this->escape($this->state->get('list.direction')), $this->escape($this->state->get('list.ordering'))) ; ?>
				</th>

				<?php if ($date = $this->state->get('list_show_date')) : ?>
				<th class="list-date" id="tableOrdering2">
					<?php echo JHtml::_('grid.sort', 'COM_CONTENT_'.$date.'_DATE', 'a.created', $this->escape($this->state->get('list.direction')), $this->escape($this->state->get('list.ordering'))); ?>
				</th>
				<?php endif; ?>

				<?php if ($this->state->get('list_show_author',1)) : ?>
				<th class="list-author" id="tableOrdering3">
					<?php echo JHtml::_('grid.sort', 'JAUTHOR', 'author', $this->escape($this->state->get('list.direction')), $this->escape($this->state->get('list.ordering'))); ?>
				</th>
				<?php endif; ?>

				<?php if ($this->state->get('list_show_hits',1)) : ?>
				<th class="list-hits" id="tableOrdering4">
					<?php echo JHtml::_('grid.sort', 'JGLOBAL_HITS', 'a.hits', $this->escape($this->state->get('list.direction')), $this->escape($this->state->get('list.ordering'))); ?>
				</th>
				<?php endif; ?>
			</tr>
		</thead>
		<?php endif; ?>

		<tbody>

		<?php foreach ($this->recordset as $i => $article) : ?>
			<?php if ($this->recordset[$i]->state == 0) : ?>
				<tr class="system-unpublished cat-list-row<?php echo $i % 2; ?>">
			<?php else: ?>
				<tr class="cat-list-row<?php echo $i % 2; ?>" >
			<?php endif; ?>
				<?php if (in_array($article->access, $this->user->getAuthorisedViewLevels())) : ?>

					<td class="list-title">
						<a href="<?php echo JRoute::_(ContentHelperRoute::getArticleRoute($article->slug, $article->catid)); ?>">
							<?php echo $this->escape($article->title); ?></a>

						<?php if ($article->params->get('access-edit')) : ?>
						<ul class="actions">
							<li class="edit-icon">
								<?php echo JHtml::_('icon.edit',$article, $params); ?>
							</li>
						</ul>
						<?php endif; ?>
					</td>

					<?php if ($this->state->get('list_show_date')) : ?>
					<td class="list-date">
						<?php echo JHtml::_('date',$article->displayDate, $this->escape(
						$this->state->get('date_format', JText::_('DATE_FORMAT_LC3')))); ?>
					</td>
					<?php endif; ?>

					<?php if ($this->state->get('list_show_author',1) && !empty($article->author )) : ?>
					<td class="list-author">
						<?php $author =  $article->author ?>
						<?php $author = ($article->created_by_alias ? $article->created_by_alias : $author);?>

						<?php if (!empty($article->contactid ) &&  $this->state->get('link_author') == true):?>
							<?php echo JHtml::_(
									'link',
									JRoute::_('index.php?option=com_contact&view=contact&id='.$article->contactid),
									$author
							); ?>

						<?php else :?>
							<?php echo JText::sprintf('COM_CONTENT_WRITTEN_BY', $author); ?>
						<?php endif; ?>
					</td>
					<?php endif; ?>

					<?php if ($this->state->get('list_show_hits',1)) : ?>
					<td class="list-hits">
						<?php echo $article->hits; ?>
					</td>
					<?php endif; ?>

				<?php else : // Show unauth links. ?>
					<td>
						<?php
							echo $this->escape($article->title).' : ';
							$menu		= JFactory::getApplication()->getMenu();
							$active		= $menu->getActive();
							$itemId		= $active->id;
							$link = JRoute::_('index.php?option=com_users&view=login&Itemid='.$itemId);
							$returnURL = JRoute::_(ContentHelperRoute::getArticleRoute($article->slug));
							$fullURL = new JURI($link);
							$fullURL->setVar('return', base64_encode($returnURL));
						?>
						<a href="<?php echo $fullURL; ?>" class="register">
							<?php echo JText::_( 'COM_CONTENT_REGISTER_TO_READ_MORE' ); ?></a>
					</td>
				<?php endif; ?>
				</tr>
		<?php endforeach; ?>
		</tbody>
	</table>

<?php // Code to add a link to submit an article. ?>
<?php if ($this->category->getParams()->get('access-create')) : ?>
	<?php echo JHtml::_('icon.create', $article, $article->params); ?>
<?php  endif; ?>
	<?php if (($this->state->def('show_pagination', 2) == 1  || ($this->state->get('show_pagination') == 2)) && ($this->pagination->get('pages.total') > 1)) : ?>
	<div class="pagination">

		<?php if ($this->state->def('show_pagination_results', 1)) : ?>
		 	<p class="counter">
				<?php echo $this->pagination->getPagesCounter(); ?>
			</p>
		<?php endif; ?>

		<?php echo $this->pagination->getPagesLinks(); ?>
	</div>
	<?php endif; ?>
</form>
<?php endif; ?>