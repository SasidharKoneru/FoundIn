<?php 

class indexController extends baseController {

    public function index() {
        header("Location: index.php?rt=index/login");
        exit();
    }

    public function login() {
        $this->registry->template->show('index');
    }

    public function home() {
        $this->registry->template->show('home');
    }

    public function admin() {
        $this->registry->template->show('dash');
    }

    public function postJob(){
        $this->registry->template->show('postJobs');
    }

    public function viewPostedJobs() {
        $this->registry->jobController->getJobsRecruiter($_SESSION['recruiter_id']);
        //$this->registry->template->show('viewPostedJobs');
    }

    public function trackApplications() {
        $recruiter_id = $_SESSION['recruiter_id'];
        $jobs = $this->registry->jobController->trackJobs();
        //$this->registry->template->show('trackApplications');
    }

    public function test() {
        $this->registry->template->show('admin');
    }
    public function yourapplications() {
        $this->registry->template->show('applications');
    }

    public function terms(){
        $this->registry->template->render('terms');
    }

    public function charts() {
        $this->registry->template->show('amcharts');
    }
}

?>