<?php
	require(settings::$includes_folder.'/checklist.class.php');
	class newlist {
		public $page_title;
		public $page_content;
		function __construct(){
			$this->page_title = 'New List';
			$checklist = new checklist(true);
			$this->page_content = checklist::$checklist_contents;
		}
	}
?>
