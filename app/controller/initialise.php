<?php
	$comment = new \modules\comment\app\controller\Comment();
	
	//test a render solution
	$comment = new \modules\comment\app\controller\Comment();
	echo $comment->getComments("_blog_article", "ID_article", 1);