<?php 

class UserController extends baseController {

    public function index() {
        $this->registry->template->show('index');
    }

    public function login() {
        
        $this->registry->user->login();
    } 
    
    public function register($userType) {
        echo "register function for ". $userType;
    }
}
?>