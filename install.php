<?php
	$requete = "
		DROP TABLE IF EXISTS _comment_all ;
		CREATE TABLE _comment_all (ID_comment INT AUTO_INCREMENT NOT NULL,
		comment TEXT,
		date DATETIME,
		first_name VARCHAR(50),
		last_name VARCHAR(50),
		ID_identite INT,
		nom_table VARCHAR(255),
		nom_id_table VARCHAR(255),
		ID_in_table INT,
		PRIMARY KEY (ID_comment)) ENGINE=InnoDB;
	";