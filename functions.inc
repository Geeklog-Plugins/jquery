<?php

/* Reminder: always indent with 4 spaces (no tabs). */
// +---------------------------------------------------------------------------+
// | jQuery Plugin 1.4.1                                                       |
// +---------------------------------------------------------------------------+
// | functions.inc                                                             |
// |                                                                           |
// | This file does two things: 1) it implements the necessary Geeklog Plugin  |
// | API methods and 2) implements all the common code needed by this plugin.  |
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

if (strpos(strtolower($_SERVER['PHP_SELF']), 'functions.inc') !== false) {
    die ('This file can not be used on its own.');
}

/**
* Language file include
*/
$plugin_path = $_CONF['path'] . 'plugins/jquery/';
$langfile = $plugin_path . 'language/' . $_CONF['language'] . '.php';

if (file_exists($langfile)) {
    require_once $langfile;
} else {
    require_once $plugin_path . 'language/english.php';
}

/**
* Load our config
*/
require_once $_CONF['path_system'].'classes/config.class.php';
$c = config::get_instance();
$_JQ_CONF = $c->get_config('jquery');

// +---------------------------------------------------------------------------+
// | Geeklog Plugin API Implementation                                         |
// +---------------------------------------------------------------------------+

if (!COM_isAnonUser()) {
    $_SESSION['UseCKFinder'] = true;
}

function plugin_getheadercode_jquery()
{
    global $_CONF, $_JQ_CONF, $LANG_JQUERY_FEEDBACK, $_SCRIPTS, $_PLUGINS, $LANG_JQUERY_1;
    
    $_SCRIPTS->setJavaScriptLibrary('jquery');
    
    //migrate plugin
    $_SCRIPTS->setJavaScriptFile('migrate', '/jquery/js/jquery-migrate-1.2.1.js');
    
    $str = LB . LB . '<!-- Begin jquery plugin -->' . LB;

    //Define the blogurl
    $str .= '    var theblogurl ="'. $_CONF['site_url'] .'";' . LB;
    // Lightbox
    if($_JQ_CONF['use_lightbox'] == true){
        $strext = '/jquery/js/jquery.lightbox-0.5.1.js';
        $_SCRIPTS->setJavaScriptFile('jquery_lightbox', $strext);
        $css = '/jquery/css/jquery.lightbox-0.5.css';
        $_SCRIPTS->setCSSFile('jquery_lightbox_css', $css, true);
        $str .= '    jQuery(document).ready(function() {' . LB;
        $str .= '    jQuery(\'a.lightbox\').lightBox()' . LB;
        $str .= '    });' . LB;
    }

    // Feedback
    if($_JQ_CONF['use_feedback'] == true){
        $strext = '/jquery/feedback/jquery.validate.pack.js';
        $_SCRIPTS->setJavaScriptFile('jquery_validate', $strext);
        $strext = '/jquery/feedback/jquery.contactable.php';
        $_SCRIPTS->setJavaScriptFile('jquery_contactable', $strext);
        $css = '/jquery/feedback/contactable.css';
        $_SCRIPTS->setCSSFile('jquery_contactable_css', $css, true);
        $str .= '   jQuery(function(){' . LB;
        $str .= '       jQuery(\'#contact\').contactable({' . LB;
        $str .= '	    subject: \'' . $LANG_JQUERY_FEEDBACK['feedback'] . '\'' . LB;
        $str .= '       });' . LB;
        $str .= '   });' . LB;
    }
    
    //mg browser for forum
    if(in_array('mediagallery', $_PLUGINS) && in_array('forum', $_PLUGINS) && stripos(COM_getCurrentURL(), 'createtopic.php') !== FALSE){
        //Forum 2.9.1
        $str .= '    jQuery(document).ready(function() {' . LB;
        $str .= '        jQuery(\'#form-forum-text\').after(\'<p>&nbsp;<a id="mg_browser" href="#">' . $LANG_JQUERY_1['add_mg_tag'] . '</a></p>\');' . LB;
        $str .= '    });' . LB;
        
        $str .= 'jQuery(function () {' . LB;
        $str .= '    jQuery(\'a#mg_browser\').click(function(){' . LB;
        $str .= '        window.open(\'' . $_CONF['site_url'] . '/jquery/mgbrowser/mediagallery.php\', \'mediagallery\', \'width=600,height=650,resizable=yes,scrollbars=yes,scrolling=yes,location=no,toolbar=no\');' . LB;
        $str .= '        return false;' . LB;
        $str .= '    });' . LB;
        $str .= '});' . LB;
        
    }
    
    $str .= '<!-- End jquery plugin includes -->' . LB;
    
    $_SCRIPTS->setJavaScript($str, true);
    
    return;
}

/**
* Implements a [lightbox:] autotag.
*
* @param    string  $op         operation to perform
* @param    string  $content    item (e.g. story text), including the autotag
* @param    array   $autotag    parameters used in the autotag
* @param    mixed               tag names (for $op='tagname') or formatted content
*
*/

function plugin_autotags_jquery($op, $content = '', $autotag = '')
{
    global $_CONF, $LANG_JQUERY_1;
    
    $lightbox = '';

    if ($op == 'tagname') {
        return 'lightbox';
        break;
    } else if ($op == 'description') {
        return array (
        'lightbox' => $LANG_JQUERY_1['autotag_desc_lightbox']
        );
    } elseif ($op == 'parse') {
        $picture_url = COM_applyFilter($autotag['parm1']);
        //Thumbnail dimension idea from Ivy and Hiroron
        $width = '75'; 
        $height = '75';   

        if (!empty ($autotag['parm2'])) {
            $skip = 0;
            $px = explode (' ', trim ($autotag['parm2']));
            if (is_array ($px)) {
                foreach ($px as $part) {
                    if (substr ($part, 0, 6) == 'width:') {
                        $a = explode (':', $part);
                        $a = strtolower ($a[1]);
                        $width = $a;
                        $skip++;
                    } else if (substr ($part, 0, 7) == 'height:') {
                        $b = explode (':', $part);
                        $b = strtolower ($b[1]);
                        $height = $b;
                        $skip++;
                    } else {
                        break;
                    }
                }
                if ($skip == 0) {
                    $title = trim ($autotag['parm2']);
                } else {
                    if (count ($px) > $skip) {
                        for ($i = 0; $i < $skip; $i++) {
                            array_shift ($px);
                        }
                        $title = trim (implode (' ', $px));
                    }
                }
            } else {
                $title = trim ($autotag['parm2']);
            }
        }

        // <20110830> hiroron  my Site Image file Check
        $picture_exists = FALSE;

        // check outsite url
        if (strpos($autotag['parm1'], 'http')===0 && strpos($autotag['parm1'], $_CONF['site_url']) === FALSE ) {
            // outsite url
            $picture_exists = TRUE;

        } else {
            // my site url
            $temp_path = $autotag['parm1'];
            if (strpos($autotag['parm1'], $_CONF['site_url']) !== FALSE) {
                // cut my site url
                $temp_path = str_replace($_CONF['site_url'], '', $autotag['parm1']);
            }
            $picture_path = $_CONF['path_html'] . $temp_path;
            if (is_file($picture_path)) {
                $picture_exists = TRUE;
                $size = 1;
            }
        }
        if (!empty($picture_url) && $picture_exists) {
            // </20110830> hiroron  my Site Image file Check
            if ($width == 'auto' ) {
                $imgwidth = '';
            } else {
                $imgwidth = '&amp;w=' . $width;
            }
            if ($height == 'auto') {
                $imgheight = '';
            } else {
                $imgheight = '&amp;h=' . $height;
            }

            if ($title != '') {
                $lightbox .= LB . '<a class="lightbox" href="'. $autotag['parm1'] . '" alt="' . $title . '"><img style="width:0px; height:0px; margin:0; padding:0" alt="" />' . $title . '</a>';
            } else {
                $lightbox .= LB . '<a class="lightbox" href="'. $autotag['parm1'] . '" alt="' . $title . '"><img class="lightbox" style="background:#FFFFFF; padding:5px; border:1px solid #CCC;" src="' . $_CONF['site_url'] . '/jquery/timthumb.php?src=' . $autotag['parm1'] . $imgwidth . $imgheight . '&amp;zc=1&amp;q=100" alt="' . $title . '" title="' . $title . '" /></a>';
            }
        }
        $content = str_replace($autotag['tagstr'], $lightbox, $content);
    }

    return $content;
}


/**
* Return plugin entry for "Command and Control" (moderation.php)
*
* @return  array  Array containing (plugin name, admin url, url of plugin icon)
*
*/
function plugin_cclabel_jquery()
{
    global $_CONF, $LANG_JQUERY_1;

    $retval = array();
    if (SEC_hasRights('jquery.admin')) {
        $retval = array($LANG_JQUERY_1['plugin_name'],
        $_CONF['site_admin_url'] . '/plugins/jquery/index.php',
        plugin_geticon_jquery());
    }

    return $retval;
}

/**
* Return plugin entry for the Admins Only block
*
* @return array Array containing (plugin name, plugin admin url, # of plugin items or '')
*/
function plugin_getadminoption_jquery()
{
    global $_CONF, $LANG_JQUERY_1;

    if (SEC_hasRights('jquery.admin')) {
        return array($LANG_JQUERY_1['plugin_name'],
        $_CONF['site_admin_url'] . '/plugins/jquery/index.php', 0);
    }
}

/**
* Returns the URL of the plugin's icon
*
* @return   string      URL of the icon
*
*/
function plugin_geticon_jquery()
{
    global $_CONF;

    return $_CONF['site_admin_url'] . '/plugins/jquery/images/jquery.png';
}

/**
* Returns the current plugin code version
*
* @return string    plugin version
*/
function plugin_chkVersion_jquery()
{
    global $_CONF;

    require_once $_CONF['path'] . 'plugins/jquery/autoinstall.php';

    $inst_parms = plugin_autoinstall_jquery('jquery');

    return $inst_parms['info']['pi_version'];
}

/**
* Returns doc uri for Geeklog-1.6.0 or later
*/
function plugin_getdocumentationurl_jquery() {
    
    return 'http://geeklog.fr/downloads/index.php/jquery';
}

/**
* Update the plugin
*
* @return   int     Number of message to display or true for success
*
*/
function plugin_upgrade_jquery()
{
    global $_CONF, $_TABLES;

    $installed_version = DB_getItem($_TABLES['plugins'], 'pi_version',
    "pi_name = 'jquery'");
    $code_version = plugin_chkVersion_jquery();
    if ($installed_version == $code_version) {
        // nothing to do
        return true;
    }
    require_once $_CONF['path'] . 'plugins/jquery/install_defaults.php';
    require_once $_CONF['path_system'] . 'classes/config.class.php';
    require_once $_CONF['path'] . 'plugins/jquery/autoinstall.php';

    if (! plugin_compatible_with_this_version_jquery('jquery')) {
        return 3002;
    }

    // other update code goes here
    switch( $installed_version ) {
        
    case '1.0':
        $c = config::get_instance();
        $c->add('use_feedback', $_JQ_DEFAULT['use_feedback'],
        'select', 0, 1, 3, 60, true, 'jquery');
        $c->set('CND_url', 'http://ajax.googleapis.com/ajax/libs/jquery/1.4.4/jquery.min.js', 'jquery');

    case '1.1':
        $c = config::get_instance();
        $c->add('use_codehighlighter', $_JQ_DEFAULT['use_codehighlighter'],
        'select', 0, 1, 3, 70, true, 'jquery');

    case '1.1.1':
        $c = config::get_instance();
        $c->add('use_ckeditor', $_JQ_DEFAULT['use_ckeditor'],
        'select', 0, 1, 3, 80, true, 'jquery');
        
    case '1.2':
        $c = config::get_instance();
        
        $c->del('use_CND', 'jquery');
        $c->del('CND_url', 'jquery');
        $c->del('fs_01', 'jquery');
        $c->del('use_datepicker', 'jquery');
        $c->del('use_colorpicker', 'jquery');
        
        $c->add('fs_03', NULL, 'fieldset', 0, 2, NULL, 100, true, 'jquery');
        $c->add('lightbox_width', $_JQ_DEFAULT['lightbox_width'],
        'text', 0, 2, 0, 110, true, 'jquery');
        $c->add('lightbox_height', $_JQ_DEFAULT['lightbox_height'],
        'text', 0, 2, 0, 120, true, 'jquery');

    case '1.3.1':				
    case '1.3.0':
        $c = config::get_instance();
        $c->del('use_ckeditor', 'jquery');			
        $c->del('use_codehighlighter', 'jquery');
        
    case '1.4.0':
    case '1.4.1':		

        default :
        // update plugin version number
        $inst_parms = plugin_autoinstall_jquery('jquery');
        $pi_gl_version = $inst_parms['info']['pi_gl_version'];
        DB_query("UPDATE {$_TABLES['plugins']} SET pi_version = '$code_version', pi_gl_version = '$pi_gl_version' WHERE pi_name = 'jquery'");
        COM_errorLog( "Updated jQuery plugin from v$installed_version to v$code_version", 1 );
    }
    return true;
}

/**
* Automatic uninstall function for plugins
*
* This code is automatically uninstalling the plugin.
* It passes an array to the core code function that removes
* tables, groups, features and php blocks from the tables.
* Additionally, this code can perform special actions that cannot be
* foreseen by the core code (interactions with other plugins for example)
*
* @return   array   Plugin information
*
*/
function plugin_autouninstall_jquery()
{
    $out = array (
    /* give the name of the tables, without $_TABLES[] */
    'tables' => array(/* e.g. 'jquery' */),
    /* give the full name of the group, as in the db */
    'groups' => array('jQuery Admin'),
    /* give the full name of the feature, as in the db */
    'features' => array('jquery.admin'),
    /* give the full name of the block, including 'phpblock_', etc */
    'php_blocks' => array(),
    /* give all vars with their name */
    'vars' => array()
    );

    return $out;
}
?>
