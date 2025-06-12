<?php 

class reportController extends baseController {

    public function index() {

    }

    public function generateReports() {
        $db = $this->registry->db;
        $reportType = $_GET['report_type'];
        $recruiter_id = $_SESSION['recruiter_id'];
        $format = $_POST['format'];
        if($reportType === 'job_posts_reports') {
            
            $this->registry->report->generateJobPostsReport($db, $recruiter_id, $format);
        }
        if($reportType === 'applicants') {
            $this->registry->report->generateJobApplicationsReport($db, $recruiter_id, $format);
        }
        // header("Location: index.php?rt=index/admin");
        // exit();
    }

    public function trackapplicationsByJob() {
        $db = $this->registry->db;
        $recruiter_id = $_POST['recruiter_id'];
        $job_id = $_POST['job_id'];
        $format = $_POST['format'];
        $this->registry->report->trackApplications($db, $recruiter_id, $job_id, $format);
        // header("Location: index.php?rt=index/admin");
        // exit();
    }

    public function generateApplicationsReport() {
        $jobseeker_id = $_GET['id'];
        $db = $this->registry->db;
        $this->registry->report->generateReport($db, $jobseeker_id);
        header("Location: index.php?rt=index/home");
        exit();
    }

    public function generateApplicationsReportXML() {
        $jobseeker_id = $_GET['id'];
        $db = $this->registry->db;
        $this->registry->report->generateReportXML($db, $jobseeker_id);
        header("Location: index.php?rt=index/home");
        exit();
    }

    


}


?>