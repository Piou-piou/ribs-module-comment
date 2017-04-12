<?php
	namespace modules\comment\admin\controller;
	
	use core\App;
	use core\HTML\flashmessage\FlashMessage;
	use modules\comment\app\controller\Comment;
	
	class AdminComment extends Comment {
		public static $router_parameter;
		private $values = [];
		
		//-------------------------- BUILDER ----------------------------------------------------------------------------//
		//-------------------------- END BUILDER ----------------------------------------------------------------------------//
		
		
		//-------------------------- GETTER ----------------------------------------------------------------------------//
		/**
		 * @return array
		 * function to get values out of the class
		 */
		public function getValues(){
			return ["comment" => $this->values];
		}
		
		/**
		 * function that get a list of all table_name wich are in comment module
		 */
		public function getAllTable() {
			$dbc = App::getDb();
			
			$query = $dbc->select("table_name, ID_in_table")->from("_comment_all")->groupBy("ID_in_table, table_name")->get();
			
			if ((is_array($query)) && (count($query) > 0)) {
				$values = [];
				foreach ($query as $obj) {
					$values[] = [
						"table" => $obj->table_name,
						"table_name" => str_replace("_", " ", $obj->table_name),
						"id_in_table" => $obj->ID_in_table,
						"nb_checked_comment" => $this->getNbCheckedComment($obj->table_name, 1),
						"nb_unchecked_comment" => $this->getNbCheckedComment($obj->table_name, 0),
					];
				}
				
				$this->setValues($values);
			}
		}
		
		/**
		 * @param $table_name
		 * @param $checked
		 * @return int
		 * function that get number of checked or unchecked comment for a table_name
		 */
		private function getNbCheckedComment($table_name, $checked) {
			$dbc = App::getDb();
			
			$query = $dbc->select("ID_comment")->from("_comment_all")->where("table_name", "=", $table_name, "AND")
				->where("checked", "=", $checked)->get();
			
			return count($query);
		}
		
		/**
		 * @param $id_in_table
		 * function wich get all comments of an other module like a article of a blog
		 * after all coments was getted it will call getRender to use twig to render them
		 */
		public function getComments($id_in_table) {
			$dbc = App::getDb();
			
			$query = $dbc->select()->from("_comment_all")->where("table_name", "=", self::$router_parameter, "AND")
				->where("ID_in_table", "=", $id_in_table)->get();
			
			$values = [];
			if (count($query) > 0) {
				foreach ($query as $obj) {
					$values[] = [
						"id_comment" => $obj->ID_comment,
						"comment" => $obj->comment,
						"checked" => $obj->checked,
						"date" => $obj->date,
						"pseudo" => $obj->pseudo,
						"id_identite" => $obj->ID_identite,
					];
				}
			}
			
			$this->setValues($values);
		}
		//-------------------------- END GETTER ----------------------------------------------------------------------------//
		
		
		//-------------------------- SETTER ----------------------------------------------------------------------------//
		/**
		 * @param $values
		 * function to set all values and sort it in future
		 */
		public function setValues($values) {
			$this->values = array_merge($this->values, $values);
		}
		
		/**
		 * @param $id_comment
		 * @param $checked
		 * function that it is used to change if a comment is changed or not
		 */
		public function setChangeCheck($id_comment, $checked) {
			$dbc = App::getDb();
			
			$dbc->update("checked", $checked)->from("_comment_all")->where("ID_comment", "=", $id_comment)->set();
			FlashMessage::setFlash("The status of the comment was correctly changed", "success");
		}
		
		/**
		 * @param $id_comment
		 * @param $table
		 * function that is used to delete a comment
		 */
		public function setDeleteComment($id_comment, $table) {
			$dbc = App::getDb();
			$explode = explode("/", $table);
			$table = end($explode);
			
			$dbc->delete()->from("_comment_all")->where("ID_comment", "=", $id_comment, "AND")
				->where("table_name", "=", $table)->del();
			
			FlashMessage::setFlash("Comment was correctly deleted", "success");
		}
		//-------------------------- END SETTER ----------------------------------------------------------------------------//    
	}