<?php

	class Acceso_datos {
		
		// Propiedades
		private $_tabla;
		private $_obj_tabla;
		
		public function __construct($nombre_tabla) {
			$this->_tabla = $nombre_tabla;
			// Iniciamos el objeto modelo relacionado con la tabla
			$class = $this->_tabla;
			
			if (class_exists($class)) {
				$this->_obj_tabla = new $class;
			}
			else {
				$this->_obj_tabla = false;
			}
				
		}
		
		private function class_exist() {
			return $this->_obj_tabla;
		}
		
		/**
		 * Obtine las columnas de la tabla
		 */ 
		public function columnas_tabla() {
			
			if (!$this->class_exist())
				return false;
			
			$columnas = array();
			
			// Componemos la sentencia
			$sentencia = "show columns from {$this->_tabla}";
			
			foreach (ORM::for_table($this->_tabla)
								->raw_query($sentencia)->find_array() as $key => $value) {
				$columnas[] = $value['Field'];
			}		
			return $columnas;
		}
		
		/**
		 * Obtiene las columnas de la tabla y añade mediante una array indexado de cadenas las
		 *  columnas que queremos añadirles para que salgan por ejemplo en una tabla de html5
		 */
		public function add_optionsTocolumnas_tabla(Array $array) {
			
			if (!$this->class_exist())
				return false;
			
			$columnas = $this->columnas_tabla();
			foreach ($array as $key => $value) {
				$columnas[] = $value;	
			}
			return $columnas;
		}
		
		/**
		 * Obtemeos todos los registros de la tabla
		 */
		 public function all_dates() {
		 	
			if (!$this->class_exist())
				return false;
		 	
		 	return $this->_obj_tabla->factory()
							 ->find_array();
		 }
		 
		 public function getById($id) {
		 	return $this->_obj_tabla->factory()
						->find_one($id);
		 }
	}
