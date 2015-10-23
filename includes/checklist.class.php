<?php
	class checklist {
		public static $checklist_contents;
		function __construct($empty){
			if($empty){
				self::$checklist_contents = $this->new_checklist();
			} else {
				self::$checklist_contents = $this->edit_checklist();
			}
		}
		function new_checklist(){
			// provides build_checklist with empty array
			$checklist_array = array('empty item 1','empty item 2');
			return $this->build_checklist($checklist_array);
		}
		function edit_checklist(){
			// provides build_checklist with array of items
			// check if posted checklist is available
			if((isset($_POST['submit']))&&($_POST['checklist_name']<>'')){
				//load checklist based on checklist_name provided by post
				$checklist_array = $this->load_checklist($_POST['checklist_name']);
				return $this->build_checklist($checklist_array);
			} else {
				// bring up form to find checklist
				return $this->checklist_form();
			}
		}
		function load_checklist($checklist_name){
			// brings checklist out of xml
			return array('full item 1','full item 2');
		}
		function build_checklist($checklist_array){
			// actual list is built here
			$checklist_contents = '<ul>';
			foreach($checklist_array as $checklist_item){
				$checklist_contents .= '<li>'.$checklist_item.'</li>';
			}
			$checklist_contents .= '</ul>';
			return $checklist_contents;
		}
		function checklist_form(){
			// form to load if there is no posted checklist_name
			$checklists = $this->find_checklists();
			$form_content = '<form method="post" action="index.php?page=edit">';
			$form_content .= '<select name="checklist_name">';
			foreach($checklists as $checklist){
				$form_content .= '<option>'.$checklist.'</option>';
			}
			$form_content .= '</select><br /><br />';
			$form_content .= '<input type="submit" value="Load Checklist" name="submit">';
			$form_content .= '</form>';
			return $form_content;
		}
		function find_checklists(){
			// provides checklist_form and other functions with an array of the available checklists
			$available = array('checklist 1','checklist 2');
			return $available;
		}
	}
?>
