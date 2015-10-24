<?php

	class savelist {
		private $page_model;
		public function __construct($page_model){
			$this->page_model = $page_model;
			$xml_object = new xml();
			//check if editing list or new list
			if($this->page_model->new_checklist){
				// if creating new list, check if file exists or not
				if($xml_object->check_list_exists($_POST['checklist'])){
					$status = 1;
				} else {
					$xml_object->create_list_file($_POST);
					$status = 2;
				}
			} else {
				// if editing list only
				if($xml_object->save_to_list($_POST)){
					$status = 2;
				} else {
					$status = 0;
				}
			}
			$this->page_model->save_status = $status;
		}
	}
