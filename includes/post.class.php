<?php
class post {
	function __construct(){
	}
	function post_to_array($post_array){
		$list_creation = $post_array['checklist_uts'];
		unset($post_array['checklist']);
		unset($post_array['checklist_uts']);
		unset($post_array['commit_new_save']);
		unset($post_array['commit_save']);
		unset($post_array['commit_delete']);
		$lead_up = 'checklist_item_';
		$list_array = array();
		foreach($post_array as $post_id => $post_content){
			$item_id_specifier = str_replace($lead_up,'',$post_id);
			if(!strpos($item_id_specifier, '_completed')){
				$item_id_specifier = str_replace('_description','',$item_id_specifier);
				if(array_key_exists($item_id_specifier, $list_array)){
					$list_array[$item_id_specifier]['description'] = $post_content;
				} else {
					$list_array[$item_id_specifier] = array('description' => $post_content);
				}				
			} else {
				$item_id_specifier = str_replace('_completed','',$item_id_specifier);
				$list_array[$item_id_specifier] = array('completed' => $post_content);
			}
		}
		foreach ($list_array as $list_item_id => $list_item_value_array) {
				if($list_item_value_array['description']==''){
					unset($list_array[$list_item_id]);
				}
			}
		return $list_array;
	}
	function post_to_form($post_array){
		// find out what post looks like and grab everything from that, same as always
		$new_array = array(
			'creation' => $post_array['checklist_uts'],
			'items' => $this->post_to_array($post_array)
			);
		return $new_array;
	}
}
?>
