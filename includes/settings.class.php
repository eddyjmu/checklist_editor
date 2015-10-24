<?php
	class settings {
		public static $page_arrays;
		public static $includes_folder;
		public static $site_title;
		public static $xml_folder;
		public static $status_array;
		public function __construct(){
			self::$page_arrays = array(
				'homepage' => 'Home',
				'editlistpage' => 'Lists',
				'reportspage' => 'Reports',
				'optionspage' => 'Options'
			);
			self::$includes_folder = 'includes';
			self::$site_title = 'Checklist Editor';
			self::$xml_folder = 'checklists';
			self::$status_array = array('Save Failed!','Checklist Name already exists!','Checklist Saved!','Checklist Deleted!');
		}
	}
?>
