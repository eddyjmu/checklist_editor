<?php

	class menu {
		private $page_model;
		public function __construct($page_model){
			$this->page_model = $page_model;
			$this->page_model->page_menu .= $this->add_menu();
		}
		function add_menu(){
			$menu = '';
			foreach(settings::$page_arrays as $page_get => $page_title){
				$menu .= '<a href="?page='.$page_get.'">';
				if($page_get == $this->page_model->page_call){
					$menu .= '['.$page_title.']';
				} else {
					$menu .= $page_title;
				}
				$menu .= '</a> ';
			}
			$menu .= '';
			return $menu;
		}
	}
