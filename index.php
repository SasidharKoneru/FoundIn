
<?php

	/*** error reporting on ***/
	error_reporting(E_ALL);
	ini_set("display_errors",1);  
	/*** define the site path ***/
	 $site_path = realpath(dirname(__FILE__));
	 define ('__SITE_PATH', $site_path);
	 session_start();
	/*** include the init.php file ***/
	include 'conf/conf.php';
	require_once 'includes/init.php';
	//session_destroy();
	/*** load the router ***/
	$registry->router = new router($registry);
	
	// $registry->db= db ::getInstance();
	/*** set the controller path ***/
	$registry->router->setPath (__SITE_PATH . '/controller');

	/*** load up the template ***/
	$registry->template = new template($registry);

	/*** load the controller ***/
	$registry->router->loader();

	

?>
