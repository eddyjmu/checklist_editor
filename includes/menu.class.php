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
				if($page_get == $this->page_model->page_call){
					$active_or_no = 'active_menu_item';
				} else {
					$active_or_no = '';
				}
				$menu .= '<a class="menu_item '.$active_or_no.'" id="menu_item_'.$page_get.'" href="?page='.$page_get.'">'.$page_title.'</a>';
			}
			$menu .= '';
			return $menu;
		}
	}
