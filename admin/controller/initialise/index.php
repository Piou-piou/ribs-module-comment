<?php
	$comment = new \modules\comment\admin\controller\AdminComment();
	
	$comment->getAllTable();
	
	$arr = $comment->getValues();