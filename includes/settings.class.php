<?php
	class settings {
		public static $page_arrays;
		public static $includes_folder;
		public static $site_title;
		public static $xml_folder;
		public static $status_array;
		public static $db_information;
		public static $css_folder;
		public static $js_folder;
		public static $default_css;
		public static $default_js;
		public function __construct(){
			self::$page_arrays = array(
				'editlistpage' => 'Lists',
				//'reportspage' => 'Reports',
				//'optionspage' => 'Options'
				'homepage' => 'About',
			);
			self::$includes_folder = 'includes';	// just realized that i forgot to add the / and it's lke throughout the entire project now
			self::$site_title = 'Checklist Editor';
			self::$xml_folder = 'checklists';
			self::$status_array = array('save failed!','that checklist already exists!','checklist saved!','checklist deleted!');
			self::$db_information = array(
				'DB_HOST' => 'localhost',
				'DB_USER' => 'root',
				'DB_PSWD' => 'R0ckspac3R0cks',		// please please remember to change this from the page when you upload to git
				'DB_NAME' => 'checklist_editor'
			);
			self::$css_folder = 'css/';
			self::$js_folder = 'misc/js/';
			self::$default_js = array('https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js');
			self::$default_css = array(self::$css_folder.'style.css');
		}
	}
?>
