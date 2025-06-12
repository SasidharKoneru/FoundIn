<?php 

class error404Controller extends baseController {

    public function index() {
        $this->registry->template->errorMsg = "Page Not Found!";
        $this->registry->template->show('error404');
    }
}

?>