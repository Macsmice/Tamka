<?php
/**
 * @version     $id: footnote_footer.php
 * @package     Molajo
 * @subpackage  Footnotes
 * @copyright   Copyright (C) 2011 Amy Stephen. All rights reserved.
 * @license     GNU General Public License Version 2, or later http://www.gnu.org/licenses/gpl.html
 */
defined('MOLAJO') or die();

$document =& JFactory::getDocument();
$document->addScript(JURI::base().'media/molajo/js/footnotes.js' );
$document->addStyleSheet(JURI::base().'media/molajo/css/footnotes.css' );

$js = "window.addEvent('domready', function() { "."\n";
$js .= "formatFootnotes('data_".$this->id."','footnotes_".$this->id."');"."\n";
$js .= '  });'."\n";
$document->addScriptDeclaration($js);

if ($evenodd == 'even') { $evenodd = 'odd'; } else { $evenodd = 'even'; } ?>

<div id="data_<?php echo $this->id; ?>"><?php echo $this->worktext; ?></div>

<h6><?php echo $this->title.JText::_(' links'); ?></h6>
<div id="footnotes_<?php echo $this->id; ?>" class="footnoteholder <?php echo 'fn'.$evenodd; ?>"></div>
