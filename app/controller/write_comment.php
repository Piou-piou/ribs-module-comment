<?php
	
	$comment = new \modules\comment\app\controller\Comment();
	$required_connection = $comment->getRequiredConnection();
	
	if (($required_connection == 1) && (!isset($_SESSION["idlogin".CLEF_SITE]))) {
		\core\HTML\flashmessage\FlashMessage::setFlash("You must be connected to add a comment");
	}
	else {
		
		
		
		
		\core\HTML\flashmessage\FlashMessage::setFlash("You comment was added", "success");
	}
	
	header("location:".$_POST['return_page']);