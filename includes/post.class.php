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
		$list_array = array('creation' => $list_creation, 'items' => array());
		$lead_up = 'checklist_item_';
		for($i=0;isset($post_array[$lead_up.$i.'_description']);$i++){
			$list_array['items'][$i] = array();
			if(isset($post_array[$lead_up.$i.'_completed'])){
				$list_array['items'][$i]['completed'] = $post_array[$lead_up.$i.'_completed'];
			} else {
				$list_array['items'][$i]['completed'] = '';
			}
			$list_array['items'][$i]['description'] = $post_array[$lead_up.$i.'_description'];
		}
		return $list_array;
	}
}
?>
