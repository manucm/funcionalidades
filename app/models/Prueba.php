<?php
	
	class Prueba extends BaseModel {
		
		public static $_id_column = "id_prueba";
		
		public function getById($id) {
			return $this->factory()
						->where('id_prueba', $id)
						->find_one();
		}
	}
