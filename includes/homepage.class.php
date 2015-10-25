<?php
	class homepage {
		public $page_call;
		public $page_title;
		public $page_menu;
		public $page_content;
		public $dependencies;
		public $view;
		public $controllers;		
		public $page_css;
		public $page_js;
		function __construct(){
			$this->page_call = 'homepage';
			$this->page_title = settings::$page_arrays[$this->page_call];
			$this->page_content = 'Hello and welcome to Checklist Editor.</br><i>Edward Muller - October 2015</i>';
			$this->view = 'page';
			$this->controllers = array('menu');
			$this->page_js = settings::$default_js;
			$this->page_css = settings::$default_css;
		}
	}
?>
