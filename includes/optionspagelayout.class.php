<?php
	class optionspagelayout {
		private $page_model;
		public function __construct($page_model){
			$this->page_model = $page_model;
		}
		public function output(){
			$page_content = '<html><head><title>'.$this->page_model->page_title.' | '.settings::$site_title.'</title><head><body>';
			$page_content .= '<h3>'.settings::$site_title.'</h3>';
			$page_content .= $this->page_model->page_menu.'</br></br>';
			$page_content .= $this->page_model->page_content;
			return $page_content;
		}
	}
?>
