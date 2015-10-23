<?php
	require(settings::$includes_folder.'/checklist.class.php');
	class editlist {
		public $page_title;
		public $page_content;
		function __construct(){
			$this->page_title = 'Edit List';
			$checklist = new checklist(false);
			$this->page_content = checklist::$checklist_contents;
		}
	}
?>
