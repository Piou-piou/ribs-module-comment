<?php
	$comment = new \modules\comment\admin\controller\AdminComment();
	
	$comment->setChangeCheck($_POST['id_comment'], $_POST['checked']);
	
	echo \core\HTML\flashmessage\FlashMessage::getFlash();