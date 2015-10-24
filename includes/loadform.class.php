<?php

	class loadform {
		private $page_model;
		public function __construct($page_model){
			$this->page_model = $page_model;
			$this->page_model->page_content .= $this->build_load_form();
		}
		function build_load_form(){
			// declare new xml object
			$xml_object = new xml();
			$lists_available = $xml_object->check_for_any_lists();
			if($lists_available){
				$form_string = '<form method="post" action="index.php?page=editlistpage">';
				// to find all xmls available
				$xml_array = $xml_object->grab_all_lists();
				$form_string .= '<select name="checklist">';
				foreach($xml_array as $id => $checklist){
					$form_string .= '<option value="'.$checklist.'">'.$checklist.'</option>';
				}
				$form_string .= '</select>     ';
				$form_string .= '<input type="submit" name="submit" value="Load Checklist">';
				$form_string .= '</form>';
			}
			else {
				$form_string = 'NO LISTS CURRENTLY AVAILABLE FOR EDITING =[';
			}
			return $form_string;
		}
	}
