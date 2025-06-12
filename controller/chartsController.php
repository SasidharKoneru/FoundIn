<?php 

class chartsController extends baseController {

    public function index() {

    }

    public function pieChart(){
        $recruiter_id = $_SESSION['recruiter_id'];
        $label = $_GET['label'];
        //$this->registry->chart->pieChart($recruiter_id, $label);
    }
}

?>