<?php defined('_JEXEC') or die;
/**
* @package		Template Framework for Joomla! 1.6
* @author		Joomla Engineering http://joomlaengineering.com
* @copyright	Copyright (C) 2010, 2011 Matt Thomas | Joomla Engineering. All rights reserved.
* @license		GNU/GPL v2 or later http://www.gnu.org/licenses/gpl-2.0.html
*/

// Load template logic
$logicFile 				= JPATH_THEMES.'/'.$this->template.'/logic.php';
if(file_exists($logicFile)) include $logicFile;

// Mobile device detection
$mTemplate				= JPATH_THEMES.'/'.$this->template.'/mobile-offline.php';
$alternatemTemplate		= JPATH_THEMES.'/'.$this->template.'/layouts/mobile-offline.php';

// Initialize mobile device detection
if(file_exists($mdetectFile)) include_once $mdetectFile;
$uagent_obj 			= new uagent_info();
$isMobile 				= $uagent_obj->DetectMobileLong();
$isTablet				= $uagent_obj->DetectTierTablet();
// Check if mobile device detecion is turned on and test if visitor is a mobile device. If so, load mobile sub-template
if (( $mdetect && $isMobile ) || ( $mdetect && $detectTablets && $isTablet )) {
	if(file_exists($mTemplate)) include_once $mTemplate;
}
else {
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?php echo $this->language; ?>" lang="<?php echo $this->language; ?>" dir="<?php echo $this->direction; ?>" >
<head>
<jdoc:include type="head" />
</head>

<body class="<?php echo $columnLayout; if($useStickyFooter) echo ' sticky-footer'; echo ' '.$currentComponent; if($articleId) echo ' article-'.$articleId; if ($itemId) echo ' item-'.$itemId; if($catId) echo ' category-'.$catId; ?>">

<?php if ($this->countModules('analytics')) : ?>
	<jdoc:include type="modules" name="analytics" />
<?php endif; ?>

	<div id="footer-push">
		<a id="page-top" name="page-top"></a>

		<?php if ($headerAboveCount) : ?>
			<div id="header-above" class="clearfix">						
				<?php if ($this->countModules('header-above-1')) : ?>
					<div id="header-above-1" class="<?php echo $headerAboveClass ?>">
						
					</div><!-- end header-above-1 -->								
				<?php endif; ?>		   
				<?php if ($this->countModules('header-above-2')) : ?>
					<div id="header-above-2" class="<?php echo $headerAboveClass ?>">
						
					</div><!-- end header-above-2 -->								
				<?php endif; ?>				
				<?php if ($this->countModules('header-above-3')) : ?>
					<div id="header-above-3" class="<?php echo $headerAboveClass ?>">
						
					</div><!-- end header-above-3 -->								
				<?php endif; ?>				
				<?php if ($this->countModules('header-above-4')) : ?>
					<div id="header-above-4" class="<?php echo $headerAboveClass ?>">
						
					</div><!-- end header-above-4 -->								
				<?php endif; ?>						
			</div><!-- end header-above -->
		<?php endif; ?>	
	
		<div id="header" class="clear clearfix">
			<div class="gutter clearfix">

				<div class="date-container">
					<span class="date-weekday"><?php	$now = &JFactory::getDate(); echo $now->toFormat('%A').','; ?></span>
					<span class="date-month"><?php 		$now = &JFactory::getDate(); echo $now->toFormat('%B'); ?></span>
					<span class="date-day"><?php 		$now = &JFactory::getDate(); echo $now->toFormat('%d').','; ?></span>
					<span class="date-year"><?php 		$now = &JFactory::getDate(); echo $now->toFormat('%Y'); ?></span>
				</div>
			
				<?php if ($showDiagnostics) : ?>
					<ul id="diagnostics">
						<li><?php echo $currentComponent; ?></li>
						<li><?php if($articleId)	echo 'article-'.$articleId; ?></li>
						<li><?php if($itemId)		echo 'item-'.$itemId; ?></li>
						<li><?php if($catId)		echo 'category-'.$catId; ?></li>
						<li><?php if($view)			echo $view.' view'; ?></li>
					</ul>
				<?php endif; ?>	

				<h1 id="logo"><a href="<?php echo $this->baseurl ?>/" title="<?php echo $app->getCfg('sitename');?>"><?php echo $app->getCfg('sitename');?></a></h1>
				
				<?php if ($this->countModules('header')) : ?>
					<jdoc:include type="modules" name="header" style="jexhtml" />	
				<?php endif; ?>											
						
				<ul id="access">
					<li>Jump to:</li>
					<li><a href="<?php $url->setFragment('content'); echo $url->toString();?>" class="to-content">Content</a></li>					
					<?php if ($this->countModules('nav')) : ?>
						<li><a href="<?php $url->setFragment('nav'); echo $url->toString();?>" class="to-nav">Navigation</a></li>
					<?php endif; ?>					
					<?php if ($contentBelowCount) : ?>
						<li><a href="<?php $url->setFragment('additional'); echo $url->toString();?>" class="to-additional">Additional Information</a></li>
					<?php endif; ?>
				</ul>				
				
				<?php if ($enableSwitcher) : ?>
					<ul id="style-switch">
						<li class="narrow"><a href="#" onclick="setActiveStyleSheet('diagnostic'); return false;" title="Diagnostic">Diagnostic Mode</a></li>
						<li class="wide"><a href="#" onclick="setActiveStyleSheet('normal'); return false;" title="Normal">Normal Mode</a></li>
					</ul>
				<?php endif; ?>	

			</div><!--end gutter -->
		</div><!-- end header-->
		   
		<div id="body-container">

			<?php if ($headerBelowCount) : ?>
				<div id="header-below" class="clearfix">						
					<?php if ($this->countModules('header-below-1')) : ?>
						<div id="header-below-1" class="<?php echo $headerBelowClass ?>">
							
						</div><!-- end head -->								
					<?php endif; ?>			   
					<?php if ($this->countModules('header-below-2')) : ?>
						<div id="header-below-2" class="<?php echo $headerBelowClass ?>">
							
						</div><!-- end header-below-2 -->
					<?php endif; ?>					
					<?php if ($this->countModules('header-below-3')) : ?>
						<div id="header-below-3" class="<?php echo $headerBelowClass ?>">
							
						</div><!-- end header-below-3 -->
					<?php endif; ?>					
					<?php if ($this->countModules('header-below-4')) : ?>
						<div id="header-below-4" class="<?php echo $headerBelowClass ?>">
							
						</div><!-- end header-below-4 -->
					<?php endif; ?>					
					<?php if ($this->countModules('header-below-5')) : ?>
						<div id="header-below-5" class="<?php echo $headerBelowClass ?>">
							
						</div><!-- end header-below-5 -->
					<?php endif; ?>					
					<?php if ($this->countModules('header-below-6')) : ?>
						<div id="header-below-6" class="<?php echo $headerBelowClass ?>">
							
						</div><!-- end header-below-6 -->
					<?php endif; ?>											
				</div><!-- end header-below -->
			<?php endif; ?>
		
			<?php if ($this->countModules('breadcrumbs')) : ?>		
				<div id="breadcrumbs">
					
				</div>				
			<?php endif; ?>		
			
			<?php if ($this->countModules('nav')) : ?>
				<div id="nav" class="clear clearfix">
					
				</div><!-- end nav-->
			<?php endif; ?>
	  
			<div id="content-container" class="clear clearfix">    

				<?php if ($navBelowCount) : ?>
					<div id="nav-below" class="clearfix">						
						<?php if ($this->countModules('nav-below-1')) : ?>
							<div id="nav-below-1" class="<?php echo $navBelowClass ?>">
								
							</div><!-- end nav-below-1 -->								
						<?php endif; ?>
				   
						<?php if ($this->countModules('nav-below-2')) : ?>
							<div id="nav-below-2" class="<?php echo $navBelowClass ?>">
								
							</div><!-- end nav-below-2 -->
						<?php endif; ?>
						
						<?php if ($this->countModules('nav-below-3')) : ?>
							<div id="nav-below-3" class="<?php echo $navBelowClass ?>">
								
							</div><!-- end nav-below-3 -->
						<?php endif; ?>
						
						<?php if ($this->countModules('nav-below-4')) : ?>
							<div id="nav-below-4" class="<?php echo $navBelowClass ?>">
								
							</div><!-- end nav-below-4 -->
						<?php endif; ?>						
					</div><!-- end nav-below -->
				<?php endif; ?>
			
				<div id="load-first" class="clearfix">
					<a id="content" name="content"></a>     
					<div id="content-main">
						<div class="gutter">
						
							<?php if ($contentAboveCount) : ?>
								<div id="content-above" class="clearfix">						
									<?php if ($this->countModules('content-above-1')) : ?>
										<div id="content-above" class="<?php echo $contentAboveClass ?>">
											
										</div><!-- end content-above-1 -->								
									<?php endif; ?>
							
									<?php if ($this->countModules('content-above-2')) : ?>
										<div id="content-above-2" class="<?php echo $contentAboveClass ?>">
											
										</div><!-- end content-above-2 -->
									<?php endif; ?>
									
									<?php if ($this->countModules('content-above-3')) : ?>
										<div id="content-above-3" class="<?php echo $contentAboveClass ?>">
											
										</div><!-- end content-above-3 -->
									<?php endif; ?>
									
									<?php if ($this->countModules('content-above-4')) : ?>
										<div id="content-above-4" class="<?php echo $contentAboveClass ?>">
											
										</div><!-- end content-above-4 -->
									<?php endif; ?>						
								</div><!-- end content-above -->
							<?php endif; ?>
							
							<div id="offline">
								<?php if ($this->countModules('offline')) : ?>								
										<jdoc:include type="modules" name="offline" style="jexhtml" />								
								<?php endif; ?>	
					  
							<?php if ($this->getBuffer('message')) : ?>
								<jdoc:include type="message" />
							<?php endif; ?>
							
							<h3><?php echo $app->getCfg('offline_message'); ?></h3>
							<form action="index.php" method="post" name="login" id="form-login">
								<fieldset class="input">
									<label id="form-login-username"  for="username"><?php echo JText::_('JGLOBAL_USERNAME') ?>
										<input name="username" id="username" type="text" class="inputbox" alt="<?php echo JText::_('JGLOBAL_USERNAME') ?>" size="18" />
									</label>
									<label id="form-login-password" for="passwd"><?php echo JText::_('JGLOBAL_PASSWORD') ?>
										<input type="password" name="password" class="inputbox" size="18" alt="<?php echo JText::_('JGLOBAL_PASSWORD') ?>" id="passwd" />
									</label>
									<label id="form-login-remember" for="remember"><?php echo JText::_('JGLOBAL_REMEMBER_ME') ?>
										<input type="checkbox" name="remember" class="inputbox" value="yes" alt="<?php echo JText::_('JGLOBAL_REMEMBER_ME') ?>" id="remember" />
									</label>						
									<input type="submit" name="Submit" class="button" value="<?php echo JText::_('JLOGIN') ?>" />
									<input type="hidden" name="option" value="com_users" />
									<input type="hidden" name="task" value="user.login" />
									<input type="hidden" name="return" value="<?php echo base64_encode(JURI::base()) ?>" />
									<?php echo JHtml::_('form.token'); ?>
								</fieldset>
							</form>
							</div><!--end offline-->
								
						<?php if ($contentBelowCount) : ?>
								<div id="content-below" class="clearfix">						
									<?php if ($this->countModules('content-below-1')) : ?>
										<div id="content-below-1" class="<?php echo $contentBelowClass ?>">
											
										</div><!-- end content-below-1 -->								
									<?php endif; ?>
						
									<?php if ($this->countModules('content-below-2')) : ?>
										<div id="content-below-2" class="<?php echo $contentBelowClass ?>">
											
										</div><!-- end content-below-2 -->
									<?php endif; ?>
									
									<?php if ($this->countModules('content-below-3')) : ?>
										<div id="content-below-3" class="<?php echo $contentBelowClass ?>">
											
										</div><!-- end content-below-3 -->
									<?php endif; ?>
									
									<?php if ($this->countModules('content-below-4')) : ?>
										<div id="content-below-4" class="<?php echo $contentBelowClass ?>">
											
										</div><!-- end content-below-4 -->
									<?php endif; ?>						
								</div><!-- end content-below -->
							<?php endif; ?>
						 
						</div><!--end gutter -->        
					</div><!-- end content-main -->
					
					<?php if ($columnGroupAlphaCount) : ?>
						<div id="column-group-alpha" class="clearfix">
							<div class="gutter clearfix">						
								<?php if ($this->countModules('column-1')) : ?>
									<div id="column-1" class="<?php echo $columnGroupAlphaClass ?>">
										
									</div><!-- end column-1 -->								
								<?php endif; ?>			   
								<?php if ($this->countModules('column-2')) : ?>
									<div id="column-2" class="<?php echo $columnGroupAlphaClass ?>">
										
									</div><!-- end column-2 -->
								<?php endif; ?>	
							</div><!--end gutter -->
						</div><!-- end column-group-alpha -->
					<?php endif; ?>

				</div><!-- end load-first -->
		
					<?php if ($columnGroupBetaCount) : ?>
						<div id="column-group-beta" class="clearfix">
							<div class="gutter clearfix">						
								<?php if ($this->countModules('column-3')) : ?>
									<div id="column-group-beta-1" class="<?php echo $columnGroupBetaClass ?>">
										
									</div><!-- end column-3 -->								
								<?php endif; ?>			   
								<?php if ($this->countModules('column-4')) : ?>
									<div id="column-4" class="<?php echo $columnGroupBetaClass ?>">
										
									</div><!-- end column-4 -->
								<?php endif; ?>	
							</div><!--end gutter -->
						</div><!-- end column-group-beta -->
					<?php endif; ?>
			
				<?php if ($footerAboveCount) : ?>
					<div id="footer-above" class="clearfix">						
						<?php if ($this->countModules('footer-above-1')) : ?>
							<div id="footer-above-1" class="<?php echo $footerAboveClass ?>">
								
							</div><!-- end footer-above-1 -->								
						<?php endif; ?>			   
						<?php if ($this->countModules('footer-above-2')) : ?>
							<div id="footer-above-2" class="<?php echo $footerAboveClass ?>">
								
							</div><!-- end footer-above-2 -->
						<?php endif; ?>					
						<?php if ($this->countModules('footer-above-3')) : ?>
							<div id="footer-above-3" class="<?php echo $footerAboveClass ?>">
								
							</div><!-- end footer-above-3 -->
						<?php endif; ?>					
						<?php if ($this->countModules('footer-above-4')) : ?>
							<div id="footer-above-4" class="<?php echo $footerAboveClass ?>">
								
							</div><!-- end footer-above-4 -->
						<?php endif; ?>					
						<?php if ($this->countModules('footer-above-5')) : ?>
							<div id="footer-above-5" class="<?php echo $footerAboveClass ?>">
								<jdoc:include type="modules" name="footer-above-5" style="jexhtml" module-class="gutter" />
							</div><!-- end footer-above-5 -->
						<?php endif; ?>						
						<?php if ($this->countModules('footer-above-6')) : ?>
							<div id="footer-above-6" class="<?php echo $footerAboveClass ?>">
								
							</div><!-- end footer-above-6 -->
						<?php endif; ?>											
					</div><!-- end footer-above -->
				<?php endif; ?>

			</div><!-- end content-container -->
		</div><!-- end body-container -->
	</div><!-- end footer-push -->
    
	<div id="footer" class="clear clearfix">
		<div class="gutter clearfix">			
	
			<a id="to-page-top" href="<?php $url->setFragment('page-top'); echo $url->toString();?>" class="to-additional">Back to Top</a>

			<?php if ($this->countModules('syndicate')) : ?>			
			<div id="syndicate">
				
			</div>
			<?php endif; ?>

			<?php if ($this->countModules('footer')) : ?>
				<jdoc:include type="modules" name="footer" style="jexhtml" />
			<?php endif; ?>

		</div><!--end gutter -->
	</div><!-- end footer -->

	<?php if ($this->countModules('debug')) : ?>
		<jdoc:include type="modules" name="debug" style="raw" />
	<?php endif; ?>
	
	<?php if ($this->countModules('analytics')) : ?>
		<jdoc:include type="modules" name="analytics" />
	<?php endif; ?>	  
	
	</body>
</html>
<?php }