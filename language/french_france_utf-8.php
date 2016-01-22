<?php

/* Reminder: always indent with 4 spaces (no tabs). */
// +---------------------------------------------------------------------------+
// | jQuery Plugin 1.4.2                                                         |
// +---------------------------------------------------------------------------+
// | french_france_utf-8.php                                                   |
// |                                                                           |
// | French language file                                                      |
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
    'hello' => 'Hello, world!', // this is an example only - feel free to remove
	'plugin_doc'  => 'Install, upgrade and usage documentation is',
	'online'      => 'online',
	'plugin_conf' => 'The jQuery plugin configuration is now also',
	'autotag_desc_lightbox' => '<p>[lightbox: url width:x height:y title] - Affiche une vignette si l\'image est hébergé sur ce site ou sur les sites suivants: flickr.com, staticflickr.com, picasa.com, img.youtube.com, upload.wikimedia.org, photobucket.com, imgur.com, imageshack.us, tinypic.com. Cette vignette est liée à l\'image qui sera affichée dans une lightbox.</p><p><strong>Options</strong>: Largeur (width) et hauteur (height) où x et y sont exprimés en pixels. Vous pouvez aussi utiliser \'auto\' pour x ou y. Si un titre (title) est défini, la vignette est remplacée par votre titre.</p>',
	'add_mg_tag'            => "Ajouter un document",
);

$LANG_JQUERY_FEEDBACK = array(
    'feedback'            => " Retour d\'information ",
    'name'                => 'Nom',
    'email'               => 'Email',
    'message'             => 'Message',
    'contactable'         => 'Un message',
    'thanks'              => 'Merci pour votre message',
    'message_not_sent'    => "Désolé mais votre message n\'a pas pu être envoyé. Merci d\'essayer un peu plus tard.",
    'disclaimer'          => "N\'hésitez pas à nous faire part de vos commentaires",
    'your_feedback'       => 'Votre message',
    'success'             => 'Succes',
    'invalid_email'       => "L\'adresse email ne semble pas être valide.",
    'not_abuse'           => 'Merci de ne pas abuser du sytème.',
    'log_in'              => 'Vous devez être connecté pour pouvoir envoyer le message.',
    'from'                => 'De',
    'reply_to'            => 'Répondre à',
    'send'                => 'Envoyer',

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
	'lightbox_height'     => 'Lightbox height in px (without px)'
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
