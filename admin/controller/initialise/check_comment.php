<?php
	$comment = new \modules\comment\admin\controller\AdminComment();
	$comment->getComments($_GET['id']);
	
	$arr = $comment->getValues();
	
	echo("<pre>");
	print_r($arr);
	echo("</pre>");