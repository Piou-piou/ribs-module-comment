<?php
	$comment = new \modules\comment\admin\controller\AdminComment();
	
	$comment->getAllTableComment();
	
	$arr = $comment->getValues();