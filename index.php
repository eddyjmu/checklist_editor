<?php 
//	CHECKLIST EDITOR - Edward Muller - October 2015
//grabbing all settings
require('includes/settings.class.php');
$settings = new settings();
//checking if $_GET is occupied and null
if (isset($_GET['page'])&&($_GET['page']<>'')) {
	$page_sought = $_GET['page'];
	// assigning a page if sought page does not exist in array
	if(!array_key_exists($page_sought,settings::$page_arrays)){
		$page_sought = 'homepage';
	}
} else {
	$page_sought = 'homepage';
}
// grabbing page components and grabbing model class
foreach(settings::$page_arrays as $page_name => $page_title){
	if($page_sought == $page_name){
		$model = $page_name;
		require((settings::$includes_folder).'/'.$model.'.class.php');
	}
}
// creating page object
$page_model = new $model();
// grabbing dependencies based on page model
if(!empty($page_model->dependencies)){
	foreach($page_model->dependencies as $dependency){
		require((settings::$includes_folder).'/'.$dependency.'.class.php');
	}
}
// grabbing controller classes
foreach($page_model->controllers as $controller){
	require((settings::$includes_folder).'/'.$controller.'.class.php');
	$controller = new $controller($page_model);
}
$view = $page_model->view;
require((settings::$includes_folder).'/'.$view.'.class.php');
$page_view = new $view($page_model);
echo $page_view->output();
print_r(error_get_last());
?>
