<?php
	class db {
		public $db_information;
		public $checklists_available;
		function __construct(){
			$this->db_information = settings::$db_information;
			$this->checklists_available = array();
			$database = mysqli_connect($this->db_information['DB_HOST'], $this->db_information['DB_USER'], $this->db_information['DB_PSWD'], $this->db_information['DB_NAME']);
			if (mysqli_connect_errno()) {
			    printf("Connect failed: %s\n", mysqli_connect_error());
			    exit();
			}
			// finding all the checklist table information, including the 
			if($results = mysqli_query($database, 'SELECT items.id, checklists.name, checklists.creation, items.completed, items.completion, items.description FROM items LEFT JOIN checklists ON items.checklist=checklists.id ORDER BY checklists.name;')){
				while($row  = mysqli_fetch_array($results,MYSQLI_ASSOC)){
					if(!array_key_exists($row['name'], $this->checklists_available)){
						$this->checklists_available[$row['name']] = array(
							'creation' => $row['creation'],						
							'items' => array()
						);
					}
					$this->checklists_available[$row['name']]['items'][$row['id']] = array(
						'completed' => $row['completed'],
						'completion' => $row['completion'],						
						'description' => $row['description'],
					);
				}
			}	
			mysqli_close($database);
		}		
		function grab_specific_list($list_to_load){
			$list_array = $this->checklists_available[$list_to_load];
			return $list_array;
		}
		function check_for_any_lists(){
			$list_number = count($this->checklists_available);
			if($list_number == 0){
				return false;
			} else {
				return true;
			}
		}
		function free_item_id(){
			$free_item_id = 0;
			foreach($this->checklists_available as $checklist_name => $checklist_items_array){
				foreach($checklist_items_array['items'] as $item_id => $checklist_item){
					if($item_id>$free_item_id){
						$free_item_id = $item_id;
					}
				}
			}
			$free_item_id++;
			return $free_item_id;
		}
		function check_list_exists($checklist_name){
			return array_key_exists($checklist_name, $this->checklists_available);
		}		
		function grab_all_lists(){
			$list_array = $this->checklists_available;
			return $list_array;
		}
		function fetch_checklist_id($checklist){
			$database = mysqli_connect($this->db_information['DB_HOST'], $this->db_information['DB_USER'], $this->db_information['DB_PSWD'], $this->db_information['DB_NAME']);
			if (mysqli_connect_errno()) {
			    printf("Connect failed: %s\n", mysqli_connect_error());
			    exit();
			}
			if(array_key_exists($checklist, $this->checklists_available)){
				if($results = mysqli_query($database, 'SELECT id FROM checklists WHERE name="'.$checklist.'";')){
					while($row  = mysqli_fetch_assoc($results)){
						$checklist_id = $row['id'];
					}
				}
				mysqli_close($database);
			} else {
				if($results = mysqli_query($database, 'SELECT COUNT(*) as total FROM checklists;')){
					$checklist_id = sprintf(mysqli_num_rows($results))+1;
				}
				mysqli_close($database);
			}
			return $checklist_id;
		}
		function save_to_list($post_array){
			// when list file already exists, save contents to it
			$post_object = new post();
			$list_item_array = $post_object->post_to_array($post_array);
			// finding id of checklist to give new items
			$checklist_id = $this->fetch_checklist_id($post_array['checklist']);
			foreach($list_item_array as $list_item_id => $list_item_value_array){
				if(array_key_exists('completed', $list_item_value_array)){
					$completed_query = '1';
					$completion_query = ' completion="'.time().'", ';
				} else {
					$completed_query = '0';
					// for some reason this line isn't working properly
					$completion_query = ' completion="",';
				}
				if($this->free_item_id() == $list_item_id){
					// insert item in db if it has an id that is free
					$this->create_item($list_item_id,$checklist_id,$completed_query,$completion_query,$list_item_value_array['description']);
				} else {
					// update item in db
					$database = mysqli_connect($this->db_information['DB_HOST'], $this->db_information['DB_USER'], $this->db_information['DB_PSWD'], $this->db_information['DB_NAME']);
					if (mysqli_connect_errno()) {
					    printf("Connect failed: %s\n", mysqli_connect_error());
					    exit();
					}
					if($results = mysqli_query($database, 'UPDATE items SET completed="'.$completed_query.'", '.$completion_query.'description="'.$list_item_value_array['description'].'" WHERE id="'.$list_item_id.'";')){}
					mysqli_close($database);
				}
			}
			return true;
		}
		function create_list($post_array){
			$checklist_id = $this->fetch_checklist_id($post_array['checklist']);
			$database = mysqli_connect($this->db_information['DB_HOST'], $this->db_information['DB_USER'], $this->db_information['DB_PSWD'], $this->db_information['DB_NAME']);
			if (mysqli_connect_errno()) {
			    printf("Connect failed: %s\n", mysqli_connect_error());
			    exit();
			}
			if($results = mysqli_query($database, 'INSERT INTO checklists (id, name, creation) VALUES ("'.$checklist_id.'","'.$post_array['checklist'].'","'.time().'");')){}
			mysqli_close($database);
			$this->save_to_list($post_array);
		}
		function create_item($id,$checklist,$completed,$completion,$description){
			// insert item in db when it does not exist
			$database = mysqli_connect($this->db_information['DB_HOST'], $this->db_information['DB_USER'], $this->db_information['DB_PSWD'], $this->db_information['DB_NAME']);
			if (mysqli_connect_errno()) {
			    printf("Connect failed: %s\n", mysqli_connect_error());
			    exit();
			}
			if($results = mysqli_query($database, 'INSERT INTO items (id, checklist, completed, completion, description) VALUES ("'.$id.'","'.$checklist.'","'.$completed.'","'.$completion.'","'.$description.'");')){}
			mysqli_close($database);
		}
		/*function delete_list_file(){
			// self-explanatory
		}*/
	}
