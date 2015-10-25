<?php

	class savelist {
		private $page_model;
		public function __construct($page_model){
			$this->page_model = $page_model;
			$db_object = new db();
			//check if editing list or new list
			if($this->page_model->new_checklist){
				// if creating new list, check if list exists or not
				if($db_object->check_list_exists($_POST['checklist'])){
					$status = 1;
				}
				// list does not yet exist
				else {
					$db_object->create_list($_POST);
					$status = 2;
				}
			} else {
				// if editing list only
				if($db_object->save_to_list($_POST)){
					$status = 2;
				} else {
					$status = 0;
				}
			}
			$this->page_model->save_status = $status;
		}
	}
