<?php
	class page {
		public $model;
		public $page_sought;
		public function __construct($page_sought,$model){
			$this->model = $model;
			$this->page_sought = $page_sought;
		}
		public function menu(){
			$menu = '';
			foreach(settings::$page_arrays as $page_get => $page_array){
				$menu .= '<a href="?page='.$page_get.'">';
				if($page_get == $this->page_sought){
					$menu .= '['.$page_array['title'].']';
				} else {
					$menu .= $page_array['title'];
				}
				$menu .= '</a> ';
			}
			$menu .= '';
			return $menu;
		}
		public function output(){
			$page_content = '<html><head><title>'.$this->model->page_title.' | '.settings::$site_title.'</title><head><body>';
			$page_content .= '<h3>'.settings::$site_title.'</h3>';
			$page_content .= $this->menu().'</br></br>';
			$page_content .= $this->model->page_content;
			return $page_content;
		}
	}
?>
