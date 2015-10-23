<?php
	class page {
		public $model;
		private $settings;
		public function __construct($model){
			$this->model = $model;
		}
		public function menu(){
			$menu = '';
			foreach(settings::$page_arrays as $page_get => $page_array){
				$menu .= ''.$page_get.''.$page_array['title'].'';
			}
			$menu .= '';
			return $menu;
		}
		public function output(){
			$page_content = '<html><head><title>'.$this->model->page_title.'</title><head><body>';
			$page_content .= '';
			$page_content .= $this->menu();
			$page_content .= '';
			return $page_content;
		}
	}
?>
