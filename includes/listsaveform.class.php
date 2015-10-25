<?php

	class listsaveform {
		// listsaveform controller builds form from specific or non-specific content
		private $page_model;
		public $empty_form_array;
		public $free_item_id;
		public function __construct($page_model){
			$this->page_model = $page_model;
			$this->empty_form_array = array(
				'creation' => time(),
				'items' => array(
					array('completed' => '','description' => '')
				)
			);
			$db_object = new db();
			$this->free_item_id = $db_object->free_item_id();
			// if the post came from a new list
			if($this->page_model->new_checklist){
				if(($this->page_model->save_status == 1)||($this->page_model->save_status == 2)){
					//echo 'checklist from post to put back into form:<br />';
					$post_object = new post();
					$list_name = $_POST['checklist'];
					$form_array = $post_object->post_to_form($_POST);
				} else {
					// 'here actually';
					$list_name = '';
					$form_array = $this->empty_form_array;
				}
			} else {
				//echo 'here instead';
				$list_name = $_POST['checklist'];
				$form_array = $db_object->grab_specific_list($list_name);
			}
			$this->page_model->page_content .= $this->build_form_string($form_array, $list_name, $this->page_model->new_checklist);
		}
		function build_form_string($form_array, $list_name, $new_checklist){
			$form_string = '<form method="post" action="index.php?page=';
				$form_string .= 'editlistpage';
			$form_string .= '">';
			if (($list_name<>'')&&($this->page_model->save_status!=1)) {
				settings::$page_arrays[$this->page_model->page_call] = 'New List';
				$form_string .= 'Editing checklist "'.$list_name.'"<input type="hidden" name="checklist" value="'.$list_name.'">';
			} else {
				$form_string .= 'New checklist: <input type"text" placeholder="checklist name" name="checklist">';
			}
			$form_string .= '<input type="hidden" value="'.$form_array['creation'].'" name="checklist_uts">';
			$form_string .= '<ul>';
			$i=0;
			foreach($form_array['items'] as $item_id => $item){
				if(!isset($item['completed'])){
					$completed_value = '';
					$checked = '';
					$completion = '';
				} elseif ($item['completed']!=0){
					$completed_value = $item['completed'];
					$checked = 'checked';
					$completion = ' <i>completion: '.date('M jS, o @ g:i a', $item['completion']).'</i>';
				} else {
					$completed_value = '';
					$checked = '';
					$completion = '';
				}
				if($item['description']!=null){
					$form_string .= '<li><input type="checkbox" name="checklist_item_'.$item_id.'_completed" '.$checked.' value="'.$completed_value.'">';
					$form_string .= '<input type="text" name="checklist_item_'.$item_id.'_description" value="'.$item['description'].'"> ';
				}
				if(!$new_checklist){
					$form_string .= $this->modifiers('-');
				}
				$form_string .= $completion.'</li>';
				$i++;
			}
			if($i>0){
				$form_string .= '<li><input type="checkbox" name="checklist_item_'.$this->free_item_id.'_completed">';
				$form_string .= '<input type="text" name="checklist_item_'.$this->free_item_id.'_description" placeholder="new list item">';
				$form_string .= $this->modifiers('+');
			}
			$form_string .= '</ul><input type="submit" value="Save Checklist" name="commit_';
			if($new_checklist){
				$form_string .= 'new_';
			}
			$form_string .= 'save">     ';
			if(!$new_checklist){
				//$form_string .= '<input type="submit" value="Delete Checklist" name="commit_delete">';
			}
			$form_string .= '</form>';
			return $form_string;
		}
		function modifiers($type){
			$up_down = '<a href="#" class="">[up]</a><a href="#" class="">[down]</a>';
			if($type=='+'){
				return '<a href="#" class="">[+]</a>'.$up_down;
			} else {
				return '<a href="#" class="">[-]</a>'.$up_down;
			}
		}
	}
