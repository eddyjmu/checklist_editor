<?php
	class settings {
		public $page_arrays = array(
			'home' => array('title' => 'Home','model' => 'intro','view' => 'page','controller' => 'home'),
			'new' => array('title' => 'New List','model' => '','view' => 'class_page','controller' => 'class_new_list'),
			'edit' => array('title' => 'Edit Lists','model' => '','view' => 'class_page','controller' => 'class_edit'),
			'options' => array('title' => 'Options','model' => '','view' => 'class_page','controller' => 'class_options'),
			'reports' => array('title' => 'Reports','model' => '','view' => 'class_page','controller' => 'class_report'),
		);
	}
