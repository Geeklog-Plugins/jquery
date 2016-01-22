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
			name: 'Name',
			email: 'Email',
			message : 'Message',
			subject : 'A contactable message',
			recievedMsg : 'Thankyou for your message',
			notRecievedMsg : 'Sorry but your message could not be sent, try again later',
			disclaimer: 'Please feel free to get in touch, we value your feedback',
			hideOnSubmit: true
		};

		//call in the default otions
		var options = jQuery.extend(defaults, options);
		//act upon the element that is passed into the design    
		return this.each(function(options) {
			//construct the form
			jQuery(this).html('<div id="contactable"></div><form id="contactForm" method="" action=""><div id="loading"></div><div id="callback"></div><div class="holder"><p><label for="name">Name <span class="red"> * </span></label><br /><input id="name" class="contact" name="name" /></p><p><label for="email">E-Mail <span class="red"> * </span></label><br /><input id="email" class="contact" name="email" /></p><p><label for="comment">Your Feedback <span class="red"> * </span></label><br /><textarea id="comment" name="comment" class="comment" rows="4" cols="30" ></textarea></p><p><input class="submit" type="submit" value="Send"/></p><p class="disclaimer">'+defaults.disclaimer+'</p></div></form>');
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
						if( data == 'success') {
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

