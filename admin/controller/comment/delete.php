<?php
	$comment = new \modules\comment\admin\controller\AdminComment();
	$comment->setDeleteComment($_GET['id_comment'], $_GET['return']);
	
	header("location:".ADMWEBROOT.$_GET["return"]."?id=".$_GET["id"]);