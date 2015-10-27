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
			$checkmark = '<a class="done_editing hidden">&check;done</a>';
			$form_string = '<div id="list_save_form" class="content_filler"><form method="post" action="index.php?page=';
				$form_string .= 'editlistpage';
			$form_string .= '"><a id="content_title">';
			if (($list_name<>'')&&($this->page_model->save_status!=1)) {
				settings::$page_arrays[$this->page_model->page_call] = '(New List)';
				$form_string .= 'Editing checklist <span id="list_name">'.$list_name.'</span><input type="hidden" name="checklist" value="'.$list_name.'">';
			} else {
				$form_string .= 'New checklist<input class="new_list" type"text" placeholder="checklist name" name="checklist" size="40">';
			}
			$form_string .= '</a>';
			$form_string .= '<div id="checklist_items"><a id="items_title">Checklist items:</a>';
			$form_string .= '<input type="hidden" value="'.$form_array['creation'].'" name="checklist_uts">';
			$form_string .= '<ul id="list_items">';
			$i=0;
			foreach($form_array['items'] as $item_id => $item){
				if(!isset($item['completed'])){
					$completed_value = '';
					$checked = '';
					$completion = '';
				} elseif ($item['completed']!=0){
					$completed_value = $item['completed'];
					$checked = 'checked';
					//$completion = '(completed '.date('M jS, o @ g:i a', $item['completion']).')';
					$completion = ' completed';
				} else {
					$completed_value = '';
					$checked = '';
					$completion = '';
				}
				if($item['description']!=null){
					$form_string .= '<li class="occupied'.$completion.'" id="list_item_'.$item_id.'" data-id="'.$item_id.'">';
					$form_string .= '<input class="checkbox" type="checkbox" name="checklist_item_'.$item_id.'_completed" '.$checked.' value="'.$completed_value.'">';
					$form_string .= '<div class="move">';
					if($i==0){
						$form_string .= '<a class="darkmove up">&#8613;</a><a class="move dn" data-direction="dn">&#8615</a>';
					} elseif(($i+1) == count($form_array['items'])){
						$form_string .= '<a class="move up" data-direction="up">&#8613</a><a class="darkmove dn" >&#8615;</a>';
					} else {
						$form_string .= '<a class="move up" data-direction="up">&#8613</a><a class="move dn" data-direction="dn">&#8615;</a>';
					}
					$form_string .= '</div>';
					$form_string .= '<div class="list_item_content">';
					$form_string .= '<span class="list_item_text block">'.$item['description'].'</span>';
					$form_string .= '<textarea class="item_box hidden" name="checklist_item_'.$item_id.'_description">'.$item['description'].'</textarea>'.$checkmark;
					$form_string .= '</div>';
				} else {
				}
				//$form_string .= '<span class="completion_date">'.$completion.'</span></li>'; // forgot to pass the old completion values through the form and then into db, so completion date is always when the list is saved -_-
				$form_string .= '</li>';
				$i++;
			}
			if($i>0){
				$form_string .= '<li class="new" id="list_item_'.$this->free_item_id.'" data-id="'.$this->free_item_id.'"><input class="checkbox" type="checkbox" name="checklist_item_'.$this->free_item_id.'_completed">';
				$form_string .= '<div class="list_item_content"><textarea class="item_box" name="checklist_item_'.$this->free_item_id.'_description" placeholder="new list item"></textarea></div></li>';
			}
			$form_string .= '</ul>';
			$form_string .='<a id="addrow">Add Item</a>';
			$form_string .= '</div>';
			$form_string .= '<div id="commits">';
			if($new_checklist){
				$form_string .= '<input type="submit" value="Save new checklist" name="commit_new_save">';
			} else {
				$form_string .= '<input type="submit" value="Save checklist" name="commit_save">';
			}
			$form_string .= '</div>';
			if(!$new_checklist){
				//$form_string .= '<input type="submit" value="Delete Checklist" name="commit_delete">';
			}
			$form_string .= '</form></div>';
			return $form_string;
		}
		function modifiers($type,$add_up_down){
			if($add_up_down){
				$up_down = '<a href="#" class="">[up]</a><a href="#" class="">[down]</a>';
			} else {
				$up_down = '';
			}
			
			if($type=='+'){
				return '<a href="#" class="">[+]</a>'.$up_down;
			} else {
				return '<a href="#" class="">[-]</a>'.$up_down;
			}
		}
	}
