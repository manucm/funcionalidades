<?php

	class BaseModel extends Model {
		
		public static function factory($class="") {
			if (!$class) {
				$class = get_called_class();
				return parent::factory($class);
			} else {
				return parent::factory($class);
			}
		}
	}
 