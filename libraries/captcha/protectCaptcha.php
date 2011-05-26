<?php
/**
* @package		Tamka
* @subpackage	Library - Spam Protect
* @copyright	Copyright (C) 2009 Tämkä Teäm and individual contributors. All rights reserved. See http://tamka.org/copyright
* @license		http://www.gnu.org/licenses/licenses.html#GPL GPL v 2, or later
*/
defined( '_JEXEC' ) or die( 'Restricted access' );
	
class protectCaptcha
{


/**
 * 	Function: checkBan
 * 		Check if User's IP, Email, or URL has been banned
 */
	function checkProxyServer ($userip)
	{
            IF(ISSET($_SERVER['HTTP_X_FORWARDED_FOR']) || ($_SERVER['HTTP_USER_AGENT']=='') || ($_SERVER['HTTP_VIA']!='')){
        DIE("Proxy servers not allowed.");
}

$proxy_headers = ARRAY(
     'HTTP_VIA',
     'HTTP_X_FORWARDED_FOR',
     'HTTP_FORWARDED_FOR',
     'HTTP_X_FORWARDED',
     'HTTP_FORWARDED',
     'HTTP_CLIENT_IP',
     'HTTP_FORWARDED_FOR_IP',
     'VIA',
     'X_FORWARDED_FOR',
     'FORWARDED_FOR',
     'X_FORWARDED',
     'FORWARDED',
     'CLIENT_IP',
     'FORWARDED_FOR_IP',
     'HTTP_PROXY_CONNECTION'
        );
FOREACH($proxy_headers AS $x){
     IF (ISSET($_SERVER[$x])) DIE("You are using a proxy.");
        EXIT;
}

        }
}	