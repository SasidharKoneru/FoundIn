 <?php
/*** 
 /*** include the controller class ***/
 include __SITE_PATH . '/application/' . 'controller_base.class.php';

 /*** include the registry class ***/
 include __SITE_PATH . '/application/' . 'registry.class.php';

 /*** include the router class ***/
 include __SITE_PATH . '/application/' . 'router.class.php';

 /*** include the template class ***/
 include __SITE_PATH . '/application/' . 'template.class.php';
//  echo __SITE_PATH;

include __SITE_PATH.'/controller/'. 'userController.php';

require_once __SITE_PATH. '/controller/'. 'jobController.php';

 /*** auto load model classes ***/
    function spl_autoload_register($class_name) {
    $filename = strtolower($class_name) . '.class.php';
    $file = __SITE_PATH . '/model/' . $filename;

    if (file_exists($file) == false)
    {
        // return false;
        include ($file);
    }
  }

spl_autoload_register('User');

 /*** a new registry object ***/
$registry = new registry;

 /*** create the database registry object ***/
$registry->db = db::getInstance();

$registry->user = new User();

$registry->job = new Job();

$registry->userController = new UserController($registry);

$registry->jobController = new jobController($registry);

$registry->report = new Report();

$registry->import = new Import();
***/
?> 
<?php

/*** include the controller class ***/
include __SITE_PATH . '/application/' . 'controller_base.class.php';

/*** include the registry class ***/
include __SITE_PATH . '/application/' . 'registry.class.php';

/*** include the router class ***/
include __SITE_PATH . '/application/' . 'router.class.php';

/*** include the template class ***/
include __SITE_PATH . '/application/' . 'template.class.php';
//  echo __SITE_PATH;

include __SITE_PATH.'/controller/'. 'userController.php';

require_once __SITE_PATH. '/controller/'. 'jobController.php';

/*** auto load model classes ***/
   function autoloader($class_name) {
   $filename = strtolower($class_name) . '.class.php';
   $file = __SITE_PATH . '/model/' . $filename;

   if (file_exists($file))
   {
     include ($file);
   }

}

spl_autoload_register('autoloader');

/*** a new registry object ***/
$registry = new registry;

/*** create the database registry object ***/
$registry->db = db::getInstance();

$registry->user = new User();

$registry->job = new Job();

$registry->userController = new UserController($registry);

$registry->jobController = new jobController($registry);

$registry->report = new Report();

?>
