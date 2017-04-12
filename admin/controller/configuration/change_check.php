<?php
	$comment = new \modules\comment\admin\controller\AdminComment();
	
	$comment->setChangeConfiguration($_POST['parameter'], $_POST['checked']);
	
	echo \core\HTML\flashmessage\FlashMessage::getFlash();