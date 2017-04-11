<?php
	$comment = new \modules\comment\admin\controller\AdminComment();
	$comment->getComments($_GET['id']);
	
	$arr = $comment->getValues();