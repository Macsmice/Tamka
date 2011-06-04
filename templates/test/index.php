<?php defined( '_JEXEC' ) or die;
// Get the article ID
$articleId = JRequest::getInt('id');
// Get the current alias
$currentAlias = JSite::getMenu()->getActive()->alias;
// Get the name of the current component
$currentComponent = JRequest::getCmd('option');
// Returns a reference to the global document object
$doc		= JFactory::getDocument();
// Get the menu item ID
$itemId = JRequest::getInt('Itemid', 0);
// Is version 1.6 and later
$isOnward = (substr(JVERSION, 0, 3) >= '1.6');
// Is version 1.5
$isPresent = (substr(JVERSION, 0, 3) == '1.5');
// Get the current view
$view     	= Jrequest::getCmd('view');

// Joomla! 1.5 only
if ($isPresent) {	
	function getSection($iId) {
		  $database = &JFactory::getDBO();
		  if(Jrequest::getCmd('view', 0) == "section") {
				return JRequest::getInt('id');
			}
		  elseif(Jrequest::getCmd('view', 0) == "category") {
				$sql = "SELECT section FROM #__categories WHERE id = $iId ";
				$database->setQuery( $sql );
				$row=$database->loadResult();
				return $row;
			}
		  elseif(Jrequest::getCmd('view', 0) == "article") {
				$temp=explode(":",JRequest::getInt('id'));
				$sql = "SELECT sectionid FROM #__content WHERE id = ".$temp[0];
				$database->setQuery( $sql );
				$row=$database->loadResult();
				return $row;
			}		
		}
	$sectionId=getSection(JRequest::getInt('id'));
}

function getCategory($iId) {
	$database = &JFactory::getDBO();
	  if(Jrequest::getCmd('view', 0) == "section") {
			return null;
		}
	  elseif(Jrequest::getCmd('view', 0) == "category") {
			return JRequest::getInt('id');
		}		
	  elseif(Jrequest::getCmd('view', 0) == "article") {
			$temp=explode(":",JRequest::getInt('id'));
			$sql = "SELECT catid FROM #__content WHERE id = ".$temp[0];
			$database->setQuery( $sql );
			$row=$database->loadResult();
			return $row;
		}		
	}
$catId=getCategory(JRequest::getInt('id'));

function getParentCategory() {
	$database = &JFactory::getDBO();	
	$sql = "SELECT parent_id FROM #__categories WHERE id = ".getCategory(JRequest::getInt('id'));
	$database->setQuery( $sql );
	$row=$database->loadResult();
	return $row;	
}

$parentCategory = getParentCategory();

function getAncestorCategory() {
	$database = &JFactory::getDBO();	
	$sql = "SELECT b.id FROM #__categories a, #__categories b WHERE a.lft BETWEEN b.lft AND b.rgt AND b.lft > 0 and a.id = ".getCategory(JRequest::getInt('id'));
	$database->setQuery( $sql );
	$row=$database->loadResult();
	return $row;	
}

$ancestorCategory = getAncestorCategory();

function getAncestorCategories($id) {
	$database = &JFactory::getDBO();	
	$sql = "SELECT b.id AS id, b.lft, b.rgt, a.parent_id AS child_parent
	FROM #__categories a, #__categories b
	WHERE a.id =$id
	AND a.parent_id <> b.parent_id
	AND b.lft > 0 
	GROUP BY b.id, b.lft, b.rgt, a.parent_id 
	HAVING a.parent_id 
	BETWEEN b.lft 
	AND b.rgt 
	ORDER BY b.lft";
	$database->setQuery( $sql );
	return $database->loadObjectList();		
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?php echo $this->language; ?>" lang="<?php echo $this->language; ?>">
<head>
<jdoc:include type="head" />
<link rel="stylesheet" type="text/css" media="screen" href="<?php echo $this->baseurl ?>/templates/<?php echo $this->template ?>/css/screen.css" />
</head>

<body>

	<?php 
		
		if ($itemId)
		echo 'item '.$itemId.'<br/>';

		if ($view == 'article')
		echo 'article '.$articleId.'<br/>';

		/* breaks with SEF
		* $catId = JRequest::getInt('catid');
		*/
		if ($catId)
		echo 'category '.$catId.'<br/>';

		/* returns category ID if category view
		* $sectionId = JRequest::getInt('id');
		*/
		if ($sectionId)
		echo 'section '.$sectionId.'<br/>';

		if ($currentAlias)
		echo 'alias: '.$currentAlias.'<br/>';

		if ($currentComponent)
		echo 'component: '.$currentComponent.'<br/>';

		if ($view)
		echo 'View '.$view.'<br/>';

		echo 'Parent Category '.$parentCategory.'<br/>';

		echo 'Ancestor Category '.$ancestorCategory.'<br/>';

		echo 'Ancestor Categories:';
		$results = getAncestorCategories($catId);
		if (count($results) > 0) {
			echo '<ul>';
			foreach ($results as $item) {
				   echo '<li>'.$item->id.'</li>';
			}
			echo '</ul>';
		};	
		
	?>	
	<jdoc:include type="modules" name="nav" style="raw" />
	<jdoc:include type="modules" name="left" style="raw" />
	<jdoc:include type="component" />     
</body>
</html>