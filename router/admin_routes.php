<?php
	$pages_comment = [
		"index",
	];
	
	if (\core\modules\GestionModule::getModuleActiver("comment")) {
		if (!in_array($this->page, $pages_comment)) {
			\core\HTML\flashmessage\FlashMessage::setFlash("This page doesn't exist");
			header("location:".ADMWEBROOT);
		}
		
		if ($this->page == "index") {
			$this->controller = "comment/admin/controller/initialise/index.php";
		}
	}
	else {
		\core\HTML\flashmessage\FlashMessage::setFlash("This module has an error in configuration, please contact your administrator to have access to it", "info");
		header("location:".ADMWEBROOT);
	}