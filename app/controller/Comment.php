<?php
	namespace modules\comment\app\controller;
	
	
	use core\App;
	use core\auth\Membre;
	use core\HTML\flashmessage\FlashMessage;
	
	class Comment {
		private $required_connection;
		private $check_comment;
		private $table;
		private $name_id_table;
		private $id_in_table;
		
		
		
		//-------------------------- BUILDER ----------------------------------------------------------------------------//
		public function __construct() {
			$dbc = App::getDb();
			
			$query = $dbc->select()->from("_comment_configuration")->where("ID_configuration", "=", 1)->get();
			
			if ((is_array($query)) && (count($query) > 0)) {
				foreach ($query as $obj) {
					$this->required_connection = $obj->required_connection;
					$this->check_comment = $obj->check_comment_publish;
				}
			}
			else {
				$this->required_connection = 0;
				$this->check_comment = 0;
			}
		}
		//-------------------------- END BUILDER ----------------------------------------------------------------------------//
		
		
		
		//-------------------------- GETTER ----------------------------------------------------------------------------//
		public function getRequiredConnection() {
		    return $this->required_connection;
		}
		public function getCheckComment() {
		    return $this->check_comment;
		}
		
		/**
		 * @param $values
		 * @return string
		 * this function will get the view of list comments and form to write a comment
		 */
		private function getRender($values) {
			ob_start();
			foreach ($values as $value) {
				require(MODULEROOT."comment/app/views/list-comment.php");
			}
			require(MODULEROOT."comment/app/views/write-comment.php");
			$comments = ob_get_clean();
			
			return $comments;
		}
		
		/**
		 * @param $table
		 * @param $name_id_table
		 * @param $id_in_table
		 * function wich get all comments of an other module like a article of a blog
		 * after all coments was getted it will call getRender to use twig to render them
		 */
		public function getComments($table, $name_id_table, $id_in_table) {
			$dbc = App::getDb();
			
			$query = $dbc->select()->from("_comment_all")->where("table_name", "=", $table, "AND")
				->where("name_id_table", "=", $name_id_table, "AND")->where("ID_in_table", "=", $id_in_table)->get();
			
			$values = [];
			if (count($query) > 0) {
				foreach ($query as $obj) {
					$values[] = [
						"comment" => $obj->comment,
						"date" => $obj->date,
						"pseudo" => $obj->pseudo,
						"id_identite" => $obj->ID_identite,
					];
				}
			}
			
			$this->table = $table;
			$this->name_id_table = $name_id_table;
			$this->id_in_table = $id_in_table;
			
			return $this->getRender($values);
		}
		//-------------------------- END GETTER ----------------------------------------------------------------------------//
		
		
		
		//-------------------------- SETTER ----------------------------------------------------------------------------//
		/**
		 * @param $table
		 * @param $name_id_table
		 * @param $id_in_table
		 * @param $comment
		 * @param $pseudo
		 * @return bool
		 * function to add a comment if pseudo and comment != ""
		 */
		public function setComment($table, $name_id_table, $id_in_table, $comment, $pseudo) {
			$dbc = App::getDb();
			
			if (is_int($pseudo)) {
				$member = new Membre($pseudo);
				$pseudo = $member->getPseudo();
			}
			
			if (($pseudo != "") && ($comment != "")) {
				$dbc->insert("table_name", $table)
					->insert("name_id_table", $name_id_table)
					->insert("ID_in_table", $id_in_table)
					->insert("date", date("Y-m-d H:i:s"))
					->insert("pseudo", $pseudo)
					->insert("comment", $comment)
					->into("_comment_all")
					->set();
				
				FlashMessage::setFlash("Your comment was correctly added", "success");
				return true;
			}
			
			FlashMessage::setFlash("You must enter a pseudo and a comment to publish a comment");
			return false;
		}
		//-------------------------- END SETTER ----------------------------------------------------------------------------//
		
	}