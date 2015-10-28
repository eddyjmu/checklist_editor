<?php

	class deletelist {
		private $page_model;
		public function __construct($page_model){
			$this->page_model = $page_model;
			$db_object = new db();
			$db_object->delete_list($_POST);
			$this->page_model->save_status = 3;
		}
	}
