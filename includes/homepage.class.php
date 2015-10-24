<?php
	class homepage {
		public $page_call;
		public $page_title;
		public $page_menu;
		public $page_content;
		public $dependencies;
		public $view;
		public $controllers;
		function __construct(){
			$this->page_call = 'homepage';
			$this->page_title = 'Home';
			$this->page_content = 'Hello and welcome to Checklist Editor.</br><i>Edward Muller - October 2015</i>';
			$this->view = 'page';
			$this->controllers = array('menu');
		}
	}
?>
