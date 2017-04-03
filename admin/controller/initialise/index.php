<?php
	$comment = new \modules\comment\admin\controller\AdminComment();
	
	$comment->getAllTable();
	
	$arr = $comment->getValues();
	
	echo("<pre>");
	print_r($arr);
	echo("</pre>");