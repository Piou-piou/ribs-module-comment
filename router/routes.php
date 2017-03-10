<?php
	$pages_comment = [
		"index",
	];
	
	if (\core\modules\GestionModule::getModuleActiver("comment")) {
		if (!in_array($this->page, $pages_comment)) {
			\core\HTML\flashmessage\FlashMessage::setFlash("This page doesn't exist");
			header("location:".WEBROOT);
		}
		
		if ($this->page == "index") {
			$this->controller = "";
		}
	}
	else {
		\core\HTML\flashmessage\FlashMessage::setFlash("This module has an error in configuration, please contact your administrator to have access to it", "info");
		header("location:".WEBROOT);
	}