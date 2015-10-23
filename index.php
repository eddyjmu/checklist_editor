<?php 
/* 

	Rackspace Interview Coding Test: Edward Muller, October 2015
	------------------------------------------------------------
	Success criteria (minimum requirements):
		Application meets all system requirements
		Hand-written, well formed, semantic code
		Project is available for review on public GitHub account
		Consistent across latest versions of Firefox/Chrome/IE
	Bonus criteria:
		Next browser technologies: HTML5/CSS3
		Grid frameworks or hand-coded responsive layout
		Usage of JS libraries
		Commented code where applicable
		User interaction animations/behaviors
		Provide concepts/wireframes/mockups
	Option 1: Design/build a web-based checklist
		System requirements — the application will allow the user to:
			Create list items
			Check list items as complete
		Bonus requirements — the application will allow the user to:
			Edit/update/delete list items
			Re-order list items
	Option 2: Rebuild Rackspace home page with Bootstrap
		System requirements — the page will:
			Contain existing internal functionality (excludes third-party functions like chat/search/analytics)
			Utilize Bootstrap elements for various interactions/patterns
		Bonus requirements — the page will:
			Include improvements to user design/experience as you see fit

*/
//grabbing all settings
require('includes/settings.class.php');
$settings = new settings();
//checking if $_GET is occupied and null
if (isset($_GET['page'])&&($_GET['page']<>'')) {
	$page_sought = $_GET['page'];
	// assigning a page if sought page does not exist in array
	if(!array_key_exists($page_sought,$settings->page_arrays)){
		$page_sought = 'home';
	}
} else {
	$page_sought = 'home';
}
// grabbing page components
foreach($settings->page_arrays as $page_name => $page_comps){
	if($page_sought == $page_name){
		$model = $page_comps['model'];
		$view = $page_comps['view'];
		$controller = $page_comps['controller'];
		require($settings->includes_folder.'/'.$model.'.class.php');
		require($settings->includes_folder.'/'.$view.'.class.php');
		require($settings->includes_folder.'/'.$controller.'.class.php');
	}
}
// filling page components
// model = intro
// controller = layout
// view = page
$page_model = new $model();
$page_controller = new $controller($model);
$page_view = new $view($model);
echo $page_view->output();
?>
