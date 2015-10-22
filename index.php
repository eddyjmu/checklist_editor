<?php 

//grabbing all settings
require('classes/settings.php');
$settings = new settings();
//grabbing all classes files
require('classes/page.php');
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
foreach($settings->page_arrays as $page_name => $page_comps){
	if($page_sought == $page_name){
		$model = $page_comps['model'];
		$view = $page_comps['view'];
		$controller = $page_comps['controller'];
	}
}
$page_model = new $model($page_sought);
$page_controller = new $controller($model);
$page_view = new $view($model);
echo $page_view->output();
?>
