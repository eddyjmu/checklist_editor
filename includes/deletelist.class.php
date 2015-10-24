<?php

	class deletelist {
		private $page_model;
		public function __construct($page_model){
			$this->page_model = $page_model;
			$xml_object = new xml();
			$xml_object->delete_list_file($_POST['checklist']);
			$this->page_model->save_status = 3;
		}
	}
