<?php
	class optionspage {
		public $page_call;
		public $page_title;
		public $page_menu;
		public $page_content;
		public $dependencies;
		public $view;
		public $controllers;
		function __construct(){
			$this->page_call = 'optionspage';
			$this->page_title = 'Options';
			$this->page_content = '';
			$this->view = 'optionspagelayout';
			$this->controllers = array('menu');
		}
	}
?>
