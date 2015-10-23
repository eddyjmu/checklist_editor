<?php
	class settings {
		public static $page_arrays;
		public static $includes_folder;
		public static $site_title;
		public function __construct(){
			self::$page_arrays = array(
				'home' => array('title' => 'Home','model' => 'intro','view' => 'page','controller' => 'layout'),
				'new' => array('title' => 'New List','model' => 'newlist','view' => 'page','controller' => 'layout'),
				'edit' => array('title' => 'Edit Lists','model' => 'editlist','view' => 'page','controller' => 'layout'),
				'options' => array('title' => 'Options','model' => 'optionspage','view' => 'page','controller' => 'layout'),
				'reports' => array('title' => 'Reports','model' => 'reportspage','view' => 'page','controller' => 'layout'),
			);
			self::$includes_folder = 'includes';
			self::$site_title = 'Checklist Editor';
		}

	}
?>
