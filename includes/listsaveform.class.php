<?php

	class listsaveform {
		// listsaveform controller builds form from specific or non-specific content
		private $page_model;
		public $empty_form_array;
		public function __construct($page_model){
			$this->page_model = $page_model;
			$this->empty_form_array = array(
				'creation' => time(),
				'items' => array(
					array('completed' => '','description' => '')
				)
			);
			if($this->page_model->new_checklist){
				if(($this->page_model->save_status == 1)||($this->page_model->save_status == 2)){
					$post_object = new post();
					$list_name = $_POST['checklist'];
					$form_array = $post_object->post_to_array($_POST);
				} else {
					$list_name = '';
					$form_array = $this->empty_form_array;
				}
			} else {
				$xml_object = new xml();
				$list_name = $_POST['checklist'];
				$form_array = $xml_object->grab_specific_list($list_name);
			}
			$this->page_model->page_content .= $this->build_form_string($form_array, $list_name, $this->page_model->new_checklist);
		}
		function build_form_string($form_array, $list_name, $new_checklist){
			$form_string = '<form method="post" action="index.php?page=';
				$form_string .= 'editlistpage';
			$form_string .= '">';
			if ($list_name<>'') {
				$form_string .= 'Editing Checklist: '.str_replace('.xml','',$list_name).'<input type="hidden" name="checklist" value="'.$list_name.'">';
			} else {
				$form_string .= 'New Checklist: <input type"text" placeholder="checklist name" name="checklist">';
			}
			$form_string .= '<input type="hidden" value="'.$form_array['creation'].'" name="checklist_uts">';
			$form_string .= '<ul>';
			$i=0;
			foreach($form_array['items'] as $item_id => $item){
				if($item['completed']!=null){
					$checked = 'checked';
					$completion = ' <i>completion: '.date('M jS, o @ g:i a', $item['completed']).'</i>';
				} else {
					$checked = '';
					$completion = '';
				}
				if($item['description']!=null){
					$form_string .= '<li><input type="checkbox" name="checklist_item_'.$item_id.'_completed" '.$checked.' value="'.$item['completed'].'">';
					$form_string .= '<input type="text" name="checklist_item_'.$item_id.'_description" value="'.$item['description'].'"> ';
				}
				if(!$new_checklist){
					$form_string .= '<a href="#" class="">[-]</a>';
				}
				$form_string .= $completion.'</li>';
				$i++;
			}
			if($i>0){
				$form_string .= '<li><input type="checkbox" name="checklist_item_'.$i.'_completed">';
				$form_string .= '<input type="text" name="checklist_item_'.$i.'_description" placeholder="new list item"> <a href="#" class="">[+]</a></li>';
			}
			$form_string .= '</ul><input type="submit" value="Save Checklist" name="commit_';
			if($new_checklist){
				$form_string .= 'new_';
			}
			$form_string .= 'save">     ';
			if(!$new_checklist){
				$form_string .= '<input type="submit" value="Delete Checklist" name="commit_delete">';
			}
			$form_string .= '</form>';
			return $form_string;
		}
	}
