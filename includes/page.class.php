<?php
	class page {
		private $page_model;
		public function __construct($page_model){
			$this->page_model = $page_model;
		}
		public function output(){
			$page_content = '<!DOCTYPE html><html><head>';
			$page_content .= '<title>'.$this->page_model->page_title.' | '.settings::$site_title.'</title>';
			if(count($this->page_model->page_js)!=0){
				foreach($this->page_model->page_js as $script_src){
					$page_content .= '<script src="'.$script_src.'"></script>';				
				}
			}
			if(count($this->page_model->page_css)!=0){
				foreach($this->page_model->page_css as $style_src){
					$page_content .= '<link rel="stylesheet" href="'.$style_src.'">';
				}
			}
			$page_content .= '<head><body><div id="wrapper">';
			$page_content .= '<div id="header_box" class="full_width">';
			$page_content .= '<div id="title_box" class="full_width"><a id="site_title">'.settings::$site_title.'</a>';
			$page_content .= '<span id="page_status">'.$this->page_model->page_status.'</span>';
			$page_content .= '</div>';
			$page_content .= '<div id="menu_box" class="full_width">'.$this->page_model->page_menu.'</div>';
			$page_content .= '</div><div id="content">';
			$page_content .= $this->page_model->page_content;
			$page_content .= '</div></div></body></html>';
			return $page_content;
		}
	}
?>
