<?php

/* Reminder: always indent with 4 spaces (no tabs). */
// +---------------------------------------------------------------------------+
// | jQuery plugin 1.1                                                         |
// +---------------------------------------------------------------------------+
// | jquery.contactable.php                                                    |
// |                                                                           |
// +---------------------------------------------------------------------------+
// | Copyright (C) 2010 by the following authors:                              |
// |                                                                           |
// | Authors: ::Ben - cordiste AT free DOT fr                                  | 
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


// CONTINUE THE SESSION
session_start();

// OUTPUT PHP FILE AS JAVASCRIPT
header('content-type:application/x-javascript');

// PREVENT CACHING
header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
header("Expires: Sat, 26 Jul 1997 05:00:00 GMT"); // Date in the past

/**
 * require core geeklog code
 */
require_once '../../lib-common.php';

?>
/*
 * contactable 1.2.1 - jQuery Ajax contact form
 *
 * Copyright (c) 2009 Philip Beel (http://www.theodin.co.uk/)
 * Dual licensed under the MIT (http://www.opensource.org/licenses/mit-license.php) 
 * and GPL (http://www.opensource.org/licenses/gpl-license.php) licenses.
 *
 * Revision: jQueryId: jquery.contactable.js 2010-01-18 jQuery
 *
 */
 
//extend the plugin
(function(jQuery){

	//define the new for the plugin ans how to call it	
	jQuery.fn.contactable = function(options) {
		//set default options  
		var defaults = {
			name: '<?php echo $LANG_JQUERY_FEEDBACK['name'];?>',
			email: '<?php echo $LANG_JQUERY_FEEDBACK['email'];?>',
			message : '<?php echo $LANG_JQUERY_FEEDBACK['message'];?>',
			subject : '<?php echo $LANG_JQUERY_FEEDBACK['feedback'];?>',
			recievedMsg : '<?php echo $LANG_JQUERY_FEEDBACK['thanks'];?>',
			notRecievedMsg : '<?php echo $LANG_JQUERY_FEEDBACK['message_not_sent'];?>',
			disclaimer: '<?php echo $LANG_JQUERY_FEEDBACK['disclaimer'];?>',
			hideOnSubmit: true
		};

		//call in the default otions
		var options = jQuery.extend(defaults, options);
		//act upon the element that is passed into the design    
		return this.each(function(options) {
			//construct the form
			jQuery(this).html('<div id="contactable"></div><form id="contactForm" method="" action=""><div id="loading"></div><div id="callback"></div><div class="holder"><p><label for="name"><?php echo $LANG_JQUERY_FEEDBACK['name'];?> <span class="red"> * </span></label><br /><input id="name" class="contact" name="name" /></p><p><label for="email"><?php echo $LANG_JQUERY_FEEDBACK['email'];?> <span class="red"> * </span></label><br /><input id="email" class="contact" name="email" /></p><p><label for="comment"><?php echo $LANG_JQUERY_FEEDBACK['your_feedback'];?> <span class="red"> * </span></label><br /><textarea id="comment" name="comment-feedback" class="comment" rows="4" cols="30" ></textarea></p><p><input class="submit" type="submit" value="<?php echo $LANG_JQUERY_FEEDBACK['send'];?>"/></p><p class="disclaimer">'+defaults.disclaimer+'</p></div></form>');
			//show / hide function
			jQuery('div#contactable').toggle(function() {
				jQuery('#overlay').css({display: 'block'});
				jQuery(this).animate({"marginLeft": "-=5px"}, "fast"); 
				jQuery('#contactForm').animate({"marginLeft": "-=0px"}, "fast");
				jQuery(this).animate({"marginLeft": "+=387px"}, "slow"); 
				jQuery('#contactForm').animate({"marginLeft": "+=390px"}, "slow"); 
			}, 
			function() {
				jQuery('#contactForm').animate({"marginLeft": "-=390px"}, "slow");
				jQuery(this).animate({"marginLeft": "-=387px"}, "slow").animate({"marginLeft": "+=5px"}, "fast"); 
				jQuery('#overlay').css({display: 'none'});
			});
			
			//validate the form 
			jQuery("#contactForm").validate({
				//set the rules for the fild names
				rules: {
					name: {
						required: true,
						minlength: 2
					},
					email: {
						required: true,
						email: true
					},
					comment: {
						required: true
					}
				},
				//set messages to appear inline
					messages: {
						name: "",
						email: "",
						comment: ""
					},			

				submitHandler: function() {
					jQuery('.holder').hide();
					jQuery('#loading').show();
					jQuery.post(theblogurl+'/jquery/feedback/mail.php',{subject:defaults.subject, name:jQuery('#name').val(), email:jQuery('#email').val(), comment:jQuery('#comment').val()},
					function(data){
						jQuery('#loading').css({display:'none'}); 
						if( data == '<?php echo $LANG_JQUERY_FEEDBACK['success'];?>') {
							jQuery('#callback').show().append(defaults.recievedMsg);
							if(defaults.hideOnSubmit == true) {
								//hide the tab after successful submition if requested
								jQuery('#contactForm').animate({dummy:1}, 2000).animate({"marginLeft": "-=450px"}, "slow");
								jQuery('div#contactable').animate({dummy:1}, 2000).animate({"marginLeft": "-=447px"}, "slow").animate({"marginLeft": "+=5px"}, "fast"); 
								jQuery('#overlay').css({display: 'none'});	
							}
						} else {
							jQuery('#callback').show().append(defaults.notRecievedMsg);
						}
					});		
				}
			});
		});
	};
})(jQuery);

