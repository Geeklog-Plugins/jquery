<?php

/* Reminder: always indent with 4 spaces (no tabs). */
// +---------------------------------------------------------------------------+
// | jQuery Plugin 1.4.2                                                         |
// +---------------------------------------------------------------------------+
// | english.php                                                               |
// |                                                                           |
// | English language file                                                     |
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

/**
* Import Geeklog plugin messages for reuse
*
* @global array $LANG32
*/
global $LANG32;

// +---------------------------------------------------------------------------+
// | Array Format:                                                             |
// | $LANGXX[YY]:  $LANG - variable name                                       |
// |               XX    - specific array name                                 |
// |               YY    - phrase id or number                                 |
// +---------------------------------------------------------------------------+

$LANG_JQUERY_1 = array(
    'plugin_name' => 'jQuery',
    'hello'                 => 'Hello, world!', // this is an example only - feel free to remove
	'plugin_doc'            => 'Install, upgrade and usage documentation is',
	'online'                => 'online',
	'plugin_conf'           => 'The jQuery plugin configuration is now also',
	'autotag_desc_lightbox' => '<p>[lightbox: url width:x height:y title] - Displays a thumbnail if picture is from this site or on allowed sites: flickr.com, staticflickr.com, picasa.com, img.youtube.com, upload.wikimedia.org, photobucket.com, imgur.com, imageshack.us, tinypic.com. This thumbnail links to the picture displayed in the lightbox.</p><p><strong>Options</strong>: thumbnail width and height where x and y are in pixels. You can also use \'auto\' for x or y. If a title is set, thumbnail is replace by title and you can also set any picture url.</p>',
	'add_mg_tag'            => 'Add a media from media gallery',
);

$LANG_JQUERY_FEEDBACK = array(
    'feedback'            => ' A Feeback Message ',
    'name'                => 'Name',
    'email'               => 'Email',
    'message'             => 'Message',
    'contactable'         => 'A contactable message',
    'thanks'              => 'Thankyou for your message',
    'message_not_sent'    => 'Sorry but your message could not be sent, try again later',
    'disclaimer'          => 'Please feel free to get in touch, we value your feedback',
    'your_feedback'       => 'Your feedback',
    'success'             => 'Success',
    'invalid_email'       => 'An invalid email address was entered',
    'not_abuse'           => 'Thanks to not abuse the system.',
    'log_in'              => 'Sorry but you must log in to send message.',
    'from'                => 'From',
    'reply_to'            => 'Reply to',
    'send'                => 'Send',

);

// Localization of the Admin Configuration UI
$LANG_configsections['jquery'] = array(
    'label' => 'jQuery',
    'title' => 'jQuery Configuration'
);

$LANG_confignames['jquery'] = array(
	'use_lightbox'        => 'Use lightbox plugin',
	'use_datepicker'      => 'Use date picker plugin',
	'use_colorpicker'     => 'Use color picker plugin',
    'use_feedback'        => 'Use Feedback plugin',
	'lightbox_width'      => 'Lightbox width in px (without px)',
	'lightbox_height'     => 'Lightbox height in px (without px)',
);

$LANG_configsubgroups['jquery'] = array(
    'sg_0' => 'Main'
);

$LANG_fs['jquery'] = array(
    'fs_02' => 'Plugins',
    'fs_03' => 'Lightbox'
);

// Note: entries 0, 1, and 12 are the same as in $LANG_configselects['Core']
$LANG_configselects['jquery'] = array(
    0  => array('True' => 1, 'False' => 0),
    1  => array('True' => TRUE, 'False' => FALSE),
	3 => array('Yes' => 1, 'No' => 0),
);

// Messages for the plugin upgrade
$PLG_jquery_MESSAGE3002 = $LANG32[9]; // "requires a newer version of Geeklog"

?>
