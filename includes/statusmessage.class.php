<?php

	class statusmessage {
		private $page_model;
		public function __construct($page_model){
			$this->page_model = $page_model;
			if($this->page_model->save_status!=0){
				$status_message = settings::$status_array[$this->page_model->save_status];
			} else {
				$status_message = '';
			}
			$this->page_model->page_status .= '('.$status_message.')';
		}
	}
