<?php
	
	$comment = new \modules\comment\app\controller\Comment();
	$required_connection = $comment->getRequiredConnection();
	
	if (($required_connection == 1) && (!isset($_SESSION["idlogin".CLEF_SITE]))) {
		\core\HTML\flashmessage\FlashMessage::setFlash("You must be connected to add a comment");
	}
	else {
		$comment->setComment($_POST["table"], $_POST["id_in_table"], $_POST["comment"], $_POST["pseudo"]);
	}
	
	header("location:".$_POST['return_page']);