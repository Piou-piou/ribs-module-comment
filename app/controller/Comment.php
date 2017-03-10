<?php
	namespace modules\comment\app\controller;
	
	
	use core\App;
	
	class Comment {
		//-------------------------- BUILDER ----------------------------------------------------------------------------//
		//-------------------------- END BUILDER ----------------------------------------------------------------------------//
		
		
		
		//-------------------------- GETTER ----------------------------------------------------------------------------//
		private function getRender($values) {
			
		}
		
		/**
		 * @param $table
		 * @param $nom_id_table
		 * @param $id_in_table
		 * function wich get all comments of an other module like a article of a blog
		 * after all coments was getted it will call getRender to use twig to render them
		 */
		public function getComments($table, $nom_id_table, $id_in_table) {
			$dbc = App::getDb();
			
			$query = $dbc->select()->from("_comment_all")->where("nom_table", "=", $table, "AND")
				->where("nom_id_table", "=", $nom_id_table, "AND")->where("ID_in_table", "=", $id_in_table)->get();
			
			if (count($query) > 0) {
				$values = [];
				
				foreach ($query as $obj) {
					$values[] = [
						"comment" => $obj->comment,
						"date" => $obj->date,
						"first_name" => $obj->first_name,
						"last_name" => $obj->last_name,
						"ID_identite" => $obj->ID_identite,
					];
				}
				
				$this->getRender($values);
			}
		}
		//-------------------------- END GETTER ----------------------------------------------------------------------------//
		
		
		
		//-------------------------- SETTER ----------------------------------------------------------------------------//
		//-------------------------- END SETTER ----------------------------------------------------------------------------//
		
	}