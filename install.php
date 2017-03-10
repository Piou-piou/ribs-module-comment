<?php
	$requete = "
		DROP TABLE IF EXISTS _comment_all ;
		CREATE TABLE _comment_all (ID_comment__comment_all INT AUTO_INCREMENT NOT NULL,
		comment__comment_all TEXT,
		date__comment_all DATETIME,
		first_name__comment_all VARCHAR(50),
		last_name__comment_all VARCHAR(50),
		ID_identite__comment_all INT,
		ID_module__comment_all INT,
		ID_in_module__comment_all INT,
		PRIMARY KEY (ID_comment__comment_all)) ENGINE=InnoDB;
	";