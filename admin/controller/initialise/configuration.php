<?php
	$comment = new \modules\comment\admin\controller\AdminComment();
	
	$arr = [
		"required_connection" => $comment->getRequiredConnection(),
		"check_comment" => $comment->getCheckComment()
	];