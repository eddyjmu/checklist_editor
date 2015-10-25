<?php
	class settings {
		public static $page_arrays;
		public static $includes_folder;
		public static $site_title;
		public static $xml_folder;
		public static $status_array;
		public static $db_information;
		public function __construct(){
			self::$page_arrays = array(
				'editlistpage' => 'Lists',
				//'reportspage' => 'Reports',
				//'optionspage' => 'Options'
				'homepage' => 'About',
			);
			self::$includes_folder = 'includes';
			self::$site_title = 'Checklist Editor';
			self::$xml_folder = 'checklists';
			self::$status_array = array('Save failed!','That checklist already exists!','Checklist saved!','Checklist deleted!');
			self::$db_information = array(
				'DB_HOST' => 'localhost',
				'DB_USER' => 'root',
				'DB_PSWD' => 'RACKSPACEISAWESOME',		// please please remember to change this from the page when you upload to git
				'DB_NAME' => 'checklist_editor'
			);
		}
	}
?>
