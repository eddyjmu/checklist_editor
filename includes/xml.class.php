<?php
	class xml {
		public $xml_directory;
		public $items_in_directory;
		function __construct(){
			$this->xml_directory = settings::$xml_folder.'/';
			$this->items_in_directory = scandir($this->xml_directory, 1);
			foreach ($this->items_in_directory as $key => $item) {
				if(strpos($item,'.xml') == false){
					unset($this->items_in_directory[$key]);
				}
			}
		}		
		function grab_specific_list($xml_to_load){
			$xml_array = array();
			$xml_file = simplexml_load_file(settings::$xml_folder.'/'.$xml_to_load);
			//print_r($xml_file);
			// creation is creation date in UTS, should be present at all times in a file
			$xml_array['creation'] = sprintf($xml_file->creation);
			// if necessary, the xml array can have a last modified value
			//$xml_array['modified'] = sprintf($xml_file->modified);
			$xml_array['items'] = array();
			$i=0;
			foreach($xml_file->items->item as $item_id => $item_array){
				$xml_array['items'][$i] = array(
					'completed' => sprintf($item_array->completed),
					'description' => sprintf($item_array->description));
				$i++;
			}
			return $xml_array;
		}
		function check_for_any_lists(){
			return ((count($this->items_in_directory)==0)?false:true);
		}
		function check_list_exists($xml_to_find){
			return in_array($xml_to_find, $this->items_in_directory);
		}
		function grab_all_lists(){
			$xml_name_array = $this->items_in_directory;
			return $xml_name_array;
		}
		function array_to_xml($file_array){
			$string = '<?xml version="1.0" encoding="UTF-8"?><checklist>';
			$string .= '<creation>'.$file_array['creation'].'</creation>';
			$string .= '<items>';
			foreach($file_array['items'] as $item => $item_array){
				$string .= '<item><completed>'.$item_array['completed'].'</completed><description>'.$item_array['description'].'</description></item>';
			}
			$string .= '</items></checklist>';
			return $string;
		}
		function save_to_list($post_array){
			// when list file already exists, save contents to it
			$list_name = $post_array['checklist'];
			$post_object = new post();
			// changing array format from post to xml string
			$list_item_array = $post_object->post_to_array($post_array);
			$file_contents = $this->array_to_xml($list_item_array);
			try {
				// apparently this breaks on a perissions rule...ugh.
				file_put_contents(settings::$xml_folder.'/'.$list_name, $file_contents);
				return true;
			} catch (Exception $e) {
				return false;
			}
		}
		function create_list_file(){
			// when list file does not exist, create file, save contents to it
		}
		function delete_list_file(){
			// self-explanatory
		}
	}
