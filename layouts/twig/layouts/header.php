<?php
/**
 * @version     $id: item_header.php
 * @package     Molajo
 * @subpackage  Latest News Layout
 * @copyright   Copyright (C) 2011 Amy Stephen. All rights reserved.
 * @license     GNU General Public License Version 2, or later http://www.gnu.org/licenses/gpl.html
 */
defined('MOLAJO') or die;

$template = $this->twig->loadTemplate('/twig/layouts/twigtest.php');

$template->display(array('title' => $this->row->title,
                            'content' => $this->row->text,
                            'footer' => $this->row->author_name));

?>