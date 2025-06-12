<?php 

Abstract class baseClass {
  
    protected $registry;

function __construct($registry) {
	$this->registry = $registry;
}

abstract public function index();
}

?>