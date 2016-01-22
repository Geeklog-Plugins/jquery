<?php

/* Reminder: always indent with 4 spaces (no tabs). */
// +---------------------------------------------------------------------------+
// | jQuery Plugin 1.4.2                                                         |
// +---------------------------------------------------------------------------+
// | index.php                                                                 |
// |                                                                           |
// | Plugin administration page                                                |
// +---------------------------------------------------------------------------+
// | Copyright (C) 2010 by the following authors:                              |
// |                                                                           |
// | Authors: ::Ben - cordiste AT free DOT fr                                  |
// +---------------------------------------------------------------------------+
// | Created with the Geeklog Plugin Toolkit.                                  |
// +---------------------------------------------------------------------------+
// |                                                                           |
// | This program is free software; you can redistribute it and/or             |
// | modify it under the terms of the GNU General Public License               |
// | as published by the Free Software Foundation; either version 2            |
// | of the License, or (at your option) any later version.                    |
// |                                                                           |
// | This program is distributed in the hope that it will be useful,           |
// | but WITHOUT ANY WARRANTY; without even the implied warranty of            |
// | MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the             |
// | GNU General Public License for more details.                              |
// |                                                                           |
// | You should have received a copy of the GNU General Public License         |
// | along with this program; if not, write to the Free Software Foundation,   |
// | Inc., 59 Temple Place - Suite 330, Boston, MA  02111-1307, USA.           |
// |                                                                           |
// +---------------------------------------------------------------------------+

/**
* @package jQuery
*/

require_once '../../../lib-common.php';
require_once '../../auth.inc.php';

$display = '';

// Ensure user even has the rights to access this page
if (! SEC_hasRights('jquery.admin')) {
    $display .= COM_siteHeader('menu', $MESSAGE[30])
             . COM_showMessageText($MESSAGE[29], $MESSAGE[30])
             . COM_siteFooter();

    // Log attempt to access.log
    COM_accessLog("User {$_USER['username']} tried to illegally access the jQuery plugin administration screen.");

    echo $display;
    exit;
}

// MAIN

$display .= COM_startBlock($LANG_JQUERY_1['plugin_name']);
$display .= '<p><img src="' . $_CONF['site_admin_url'] . '/plugins/jquery/images/jquery.png" style="vertical-align:middle; margin:10px;" alt="">' 
		 . $LANG_JQUERY_1['plugin_doc'] . ' <a href="http://geeklog.fr/downloads/index.php/jquery" target="_blank">'. $LANG_JQUERY_1['online']
		 . '</a>. '
		 . $LANG_JQUERY_1['plugin_conf'] . " <a style='text-decoration: none;' href='#' onclick=\"document.jquery_conf_link.submit()\">" . $LANG_JQUERY_1['online'] . '</a>.</p>'
         . "<form name='jquery_conf_link' action='{$_CONF['site_admin_url']}/configuration.php' method='POST'>"
         . "<input type='hidden' name='conf_group' value='jquery'></form>";
         
$display .= COM_endBlock();


if (function_exists('COM_createHTMLDocument')) {
    COM_output( COM_createHTMLDocument($display, array('pagetitle' =>  $LANG_JQUERY_1['plugin_name'])) );
} else {
    COM_output( COM_siteHeader('menu', $LANG_JQUERY_1['plugin_name']) . $display . COM_siteFooter() );
}


?>
