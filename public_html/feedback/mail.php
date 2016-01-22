<?php

    require_once('../../lib-common.php');

    //declare our assets 
	$name = stripcslashes($_POST['name']);
	$emailAddr = stripcslashes($_POST['email']);
	$comment = stripcslashes($_POST['comment']);
	$subject = stripcslashes($_POST['subject']);	
	$contactMessage = "{$LANG_JQUERY_FEEDBACK['message']}: $comment \r \n {$LANG_JQUERY_FEEDBACK['from']}: $name \r \n {$LANG_JQUERY_FEEDBACK['reply_to']}: $emailAddr";

	//validate the email address on the server side
	if(eregi("^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$", $emailAddr) ) {
		//if successful lets send the message

        // check for correct $_CONF permission
        if (COM_isAnonUser() && (($_CONF['loginrequired'] == 1) ||
                                 ($_CONF['emailuserloginrequired'] == 1))) {
            echo($LANG_JQUERY_FEEDBACK['log_in']);
            exit;
        }

        // check mail speedlimit
        COM_clearSpeedlimit ($_CONF['speedlimit'], 'mail');
        $last = COM_checkSpeedlimit ('mail');
        if ($last > 0) {
            echo($LANG_JQUERY_FEEDBACK['not_abuse']);
            exit;
        }

        // do a spam check with the unfiltered message text and subject
        $result = PLG_checkforSpam ($comment, $_CONF['spamx']);
        if ($result > 0) {
            echo($LANG_JQUERY_FEEDBACK['not_abuse']);
            exit;
        }
        COM_mail($_CONF['site_mail'], $subject, $contactMessage, $emailAddr);
        COM_updateSpeedlimit('mail');

		echo($LANG_JQUERY_FEEDBACK['success']); //return success callback
	} else {
		echo($LANG_JQUERY_FEEDBACK['invalid_email']); //email was not valid
	}
?>
