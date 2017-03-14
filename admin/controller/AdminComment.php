<?php
	namespace modules\comment\admin\controller;
	
	use core\App;
	use modules\comment\app\controller\Comment;
	
	class AdminComment extends Comment {
		
		
		//-------------------------- BUILDER ----------------------------------------------------------------------------//
		//-------------------------- END BUILDER ----------------------------------------------------------------------------//
		
		
		//-------------------------- GETTER ----------------------------------------------------------------------------//
		public function getAllTableComment() {
			$dbc = App::getDb();
			
			$query = $dbc->select("table_name")->from("_comment_all")->groupBy("table_name")->get();
			
			if ((is_array($query)) && (count($query) > 0)) {
				$values = [];
				foreach ($query as $obj) {
					$values[] = [
						"talbe_name" => str_replace("_", " ", $obj->table_name)
					];
				}
				
				print_r($values);
			}
		}
		//-------------------------- END GETTER ----------------------------------------------------------------------------//
		
		
		//-------------------------- SETTER ----------------------------------------------------------------------------//
		//-------------------------- END SETTER ----------------------------------------------------------------------------//    
	}