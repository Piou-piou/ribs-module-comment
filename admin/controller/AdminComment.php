<?php
	namespace modules\comment\admin\controller;
	
	use core\App;
	use modules\comment\app\controller\Comment;
	
	class AdminComment extends Comment {
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
		public function getAllTableComment() {
			$dbc = App::getDb();
			
			$query = $dbc->select("table_name")->from("_comment_all")->groupBy("table_name")->get();
			
			if ((is_array($query)) && (count($query) > 0)) {
				$values = [];
				foreach ($query as $obj) {
					$values[] = [
						"table_name" => str_replace("_", " ", $obj->table_name),
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
		//-------------------------- END GETTER ----------------------------------------------------------------------------//
		
		
		//-------------------------- SETTER ----------------------------------------------------------------------------//
		/**
		 * @param $values
		 * function to set all values and sort it in future
		 */
		public function setValues($values) {
			$this->values = array_merge($this->values, $values);
		}
		//-------------------------- END SETTER ----------------------------------------------------------------------------//    
	}