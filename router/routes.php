<?php
	$pages_comment = [
		"index",
	];
	
	if (\core\modules\GestionModule::getModuleActiver("comment")) {
		if (!in_array($this->page, $pages_comment)) {
			header("location:".WEBROOT."404");
		}
		
		if ($this->page == "index") {
			$this->controller = "comment/app/controller/initialise.php";
		}
	}
	else {
		header("location:".WEBROOT."404");
	}