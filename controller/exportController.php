<?php 

class exportController extends baseController {
    
    public function index() {

    }

    public function jobpostsexcel() {
        $db = $this->registry->db;
        $recruiter_id = $_SESSION['recruiter_id'];
        $this->registry->report->generateJobPostsReport($db, $recruiter_id, 'excel');
    }

    public function jobpostsxml() {
        $db = $this->registry->db;
        $recruiter_id = $_SESSION['recruiter_id'];
        $this->registry->report->generateJobPostsReport($db, $recruiter_id, 'xml');
    }
}

?>