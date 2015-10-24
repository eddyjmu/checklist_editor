<?php
	class reportspage {
		public $page_call;
		public $page_title;
		public $page_menu;
		public $page_content;
		public $dependencies;
		public $view;
		public $controllers;
		function __construct(){
			$this->page_call = 'reportspage';
			$this->page_title = 'Reports';
			$this->page_content = '';
			$this->view = 'page';
			$this->controllers = array('menu');
		}
	}
?>
