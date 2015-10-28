<?php
	class homepage {
		public $page_call;
		public $page_title;
		public $page_menu;
		public $page_content;
		public $dependencies;
		public $view;
		public $controllers;		
		public $page_css;
		public $page_js;
		public $page_status;
		function __construct(){
			$this->page_call = 'homepage';
			$this->page_title = settings::$page_arrays[$this->page_call];
			$this->page_content = '<div id="load_form"><div id="about" class="content_filler">
			<div id="content_title">Hello and welcome to Checklist Editor - <i>Edward Muller - October 2015</i></div>
			<div id="checklist_items">Included features:<ul id="list_items">
			<li><u>Checklist Creation:</u><br /> User is able to create a checklist (provided that the name chosen is not already taken) and add items to that list directly from the front-page.</li>
			<li><u>Checklist Loading:</u><br /> User is able to load any created checklists via the [Load Checklists] section at the top of every page. </li>
			<li><u>Checklist Deletion:</ul><br />User is able to make use of the [Delete Checklist] button (to the right of the [Save Checklist] button) which will remove the checklist from the listing upon confirmation.</li>
			<li><u>Checklist Item Completion:</u><br /> User is able to check off items in checklists.*</li>
			<li><u>Checklist Editing:</u><br /> User is able to edit the contents of each list item by clicking on the text (which will change color when hovered over) and clicking [&check;done] when finished.*</li>
			<li><u>Checklist Order Modification:</u><br /> User is able to adjust the order of the list items in each checklist by clicking on either of the arrows provided. CLicking [&#8613] will flip the item with the one above it, and [&#8615] will flip the item with the one below it.*</li>
			<li><u>Adding Items:</u><br /> User is able to add as many items as desired to a checklist by clicking [Add Item] at the bottom of the checklist.*</li>
			</ul></p><p><i>* The [Save Checklist] button must be pressed after any modifications to make changes permanent.</i></p></div></div></div>';
			$this->view = 'page';
			$this->controllers = array('menu');
			$this->page_js = settings::$default_js;
			$this->page_css = settings::$default_css;
		}
	}
?>
