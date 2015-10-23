<?php
	class settings {
		public static $page_arrays;
		public static $includes_folder;
		public function __construct(){
			self::$page_arrays = array(
				'home' => array('title' => 'Home','model' => 'intro','view' => 'page','controller' => 'layout'),
				'new' => array('title' => 'New List','model' => '','view' => 'class_page','controller' => 'class_new_list'),
				'edit' => array('title' => 'Edit Lists','model' => '','view' => 'class_page','controller' => 'class_edit'),
				'options' => array('title' => 'Options','model' => '','view' => 'class_page','controller' => 'class_options'),
				'reports' => array('title' => 'Reports','model' => '','view' => 'class_page','controller' => 'class_report'),
			);
			self::$includes_folder = 'includes';
		}

	}
?>
