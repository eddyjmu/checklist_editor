<?php
	class editlistpage {
		public $page_call;
		public $page_title;
		public $page_menu;
		public $page_content;
		public $dependencies;
		public $view;
		public $controllers;
		public $new_checklist;
		public $save_status;
		function __construct(){
			$this->page_call = 'editlistpage';
			$this->page_title = 'Lists';
			//	the dependencies listed below are for the xml version. for database version, please enter 'db_post' and 'db' respectively.  See db.class.php for notes.
			$this->dependencies = array('post','xml');
			$this->view = 'page';
			// controllers are entirely dependent on whether there is a list posted so, check for posted list
			if (isset($_POST['checklist'])&&($_POST['checklist']<>'')) {
				// if saving from edit
				if(isset($_POST['commit_save'])&&($_POST['commit_save']<>'')){
					$this->new_checklist = false;
					$this->controllers = array('savelist','menu','statusmessage','listsaveform','jquerymod');
				}
				// if saving from new
				elseif(isset($_POST['commit_new_save'])&&($_POST['commit_new_save']<>'')){
					$this->new_checklist = true;
					$this->controllers = array('savelist','menu','statusmessage','listsaveform','jquerymod');
				}
				// if deleting
				elseif(isset($_POST['commit_delete'])&&($_POST['commit_delete']<>'')){
					$this->new_checklist = false;
					$this->controllers = array('deletelist','menu','statusmessage','loadform','jquerymod');
				}
				// edit view when loaded checklist
				else {
					$this->new_checklist = false;
					$this->controllers = array('menu','listsaveform','jquerymod');
				}
			}
			// edit view when no checklist loaded
			else {
				$this->new_checklist = true;
				$this->controllers = array('menu','listsaveform','loadform');
			}
		}
	}
?>
