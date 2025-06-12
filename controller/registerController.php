<?php 

class registerController extends baseController {

    public function index() {

    }

    public function recruiter() {
        $this->registry->template->show('recruiter/register');
    }

    public function recruiter_action() {
        $db = $this->registry->db;
        $msg = $this->registry->user->register($db,'recruiters');
        header("Location: index.php?rt=index/login");
        exit();
    } 

    public function jobseeker() {
        $this->registry->template->show('jobseeker/register');
    }

    public function jobseeker_action() {
       $db = $this->registry->db;
       $this->registry->user->register_jobseeker($db,'jobseekers');
       header("Location: index.php?rt=register/jobseeker");
       exit();
    }
}

?>