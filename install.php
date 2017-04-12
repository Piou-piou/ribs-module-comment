<?php
	$requete = "
		DROP TABLE IF EXISTS _comment_all ;
		CREATE TABLE _comment_all (ID_comment INT AUTO_INCREMENT NOT NULL,
		comment TEXT,
		date DATETIME,
		pseudo VARCHAR(50),
		checked INT DEFAULT NULL,
		ID_identite INT DEFAULT NULL,
		nom_table VARCHAR(255),
		ID_in_table INT,
		PRIMARY KEY (ID_comment)) ENGINE=InnoDB;
		
		DROP TABLE IF EXISTS _comment_configuration ;
		CREATE TABLE _comment_configuration (
		  ID_configuration INT AUTO_INCREMENT NOT NULL,
		  required_connection int(11) DEFAULT NULL,
		  check_comment_publish int(11) DEFAULT NULL,
		  PRIMARY KEY (ID_configuration)
		) ENGINE=InnoDB;
		
		INSERT INTO _comment_configuration (required_connection, check_comment_publish) VALUES (0, 0);
	";