<?php

	class loadform {
		private $page_model;
		public function __construct($page_model){
			$this->page_model = $page_model;
			$this->page_model->page_content .= $this->build_load_form();
		}
		function build_load_form(){
			// declare new xml object
			$db_object = new db();
			$lists_available = $db_object->check_for_any_lists();
			if($lists_available){
				$form_string = '<form method="post" action="index.php?page=editlistpage">';
				// to find all xmls available
				$list_array = $db_object->grab_all_lists();
				$form_string .= '<select name="checklist">';
				foreach($list_array as $checklist_name => $checklist_array){
					$form_string .= '<option value="'.$checklist_name.'">'.$checklist_name.'</option>';
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
