<?php
	
	class Productos extends BaseModel {
		
		public static $_id_column = "id_producto";
		
		public function getById($id) {
			return $this->factory()
						->where('id_producto', $id)
						->find_one();
		}
	}
