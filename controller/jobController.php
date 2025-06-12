<?php

class jobController extends baseController {

    public function index() {
        $this->registry->template->show('index');
    }

    public function jobs() {
        $this->registry->template->show('jobs');
    }

    public function postJob() {
        $db = $this->registry->db;
        $recruiter_id = $_SESSION['recruiter_id'];
        $job_title = $_POST['job_title'];
        $job_description = $_POST['job_description'];
        $salary_range = $_POST['salary_range'];
        $company_location = $_POST['company_location'];
        $company_name = $_POST['company_name'];
        $company_website = $_POST['company_website'];
        $job_type = $_POST['job_type'];
        $job_category = $_POST['job_category'];
        $required_experience = $_POST['required_experience'];
        $education_level = $_POST['education_level'];
        $expiration_date = $_POST['expiration_date'];
        $this->registry->job->createJob($db, $recruiter_id, $job_title, $job_description, 
        $salary_range, $company_location, $company_name, $company_website, 
        $job_type, $job_category, $required_experience, $education_level, $expiration_date);
    }

    public function getAllJobs() {
        $db = $this->registry->db;
        $jobseeker_id = $_SESSION['jobseeker_id'];
        $jobs = $this->registry->job->getAllJobs($db, $jobseeker_id);
        $this->registry->template->job_posts = $jobs;
        return $jobs;
    }

    public function applyJob() {
        $db = $this->registry->db;
        $jobseeker_id = $_SESSION['jobseeker_id'];
        $recruiter_id = 1;
        $job_id = $_GET['job_id'];
        $this->registry->job->applyJob($db,$jobseeker_id,$job_id,$recruiter_id);
        header("Location: index.php?rt=index/home");
        exit();
    }

    public function getJobsApplicationsofJobseeker() {
        $db = $this->registry->db;
        $jobseeker_id = $_SESSION['jobseeker_id'];
        $applications = $this->registry->job->getApplications($db, $jobseeker_id);
        return $applications;
    }

    public function getJobsRecruiter($recruiter_id) {
        $db = $this->registry->db;
        $jobs = $this->registry->job->getJobsByRecruiter($db, $recruiter_id);
        require_once 'views/viewPostedJobs.php';
        //require_once 'views/trackApplications.php';
        //return $jobs;
    }

    public function trackApplicants() {
        $db = $this->registry->db;
        $job_id = $_GET['job_id'];
        $applicants = $this->registry->job->getJobById($db, $job_id);
        $recruiter_id = $_SESSION['recruiter_id'];
        $jobs = $this->registry->job->getJobsByRecruiter($db, $recruiter_id);
        require 'views/trackApplications.php';
    }

    public function trackJobs() {
        $db = $this->registry->db;
        $recruiter_id = $_SESSION['recruiter_id'];
        $jobs = $this->registry->job->getJobsByRecruiter($db, $recruiter_id);
        require 'views/trackApplications.php';
    }

    public function updateStatus() {
        $db = $this->registry->db;
        $application_id = $_POST['application_id'];
        $status = $_POST['status'];
        $currentUrl = $_POST['current_url'];
        $this->registry->job->updateApplicationStatus($db, $application_id, $status);
        $_SESSION['update_msg'] = "Status Updated to ".$status." for application id ".$application_id;
        header("Location: ".$currentUrl);
        exit();
    }

    // public function editjob() {
    //     $this->registry->template->show('editjob');
    // }

    public function edit($job_id) {
        $db = $this->registry->db;
        $job_id = $_GET['job_id'];
        $job_title = $_POST['job_title'];
        $job_description = $_POST['job_description'];
        $salary_range = $_POST['salary_range'];
        $company_location = $_POST['company_location'];
        $company_name = $_POST['company_name'];
        $company_website = $_POST['company_website'];
        $job_type = $_POST['job_type'];
        $job_category = $_POST['job_category'];
        $required_experience = $_POST['required_experience'];
        $education_level = $_POST['education_level'];
        $expiration_date = $_POST['expiration_date'];

        $this->registry->job->updateJob($db, $job_id, $job_title, $job_description, 
        $salary_range, $company_location, $company_name, $company_website, 
        $job_type, $job_category, $required_experience, $education_level,
        $expiration_date);
        $_SESSION['edit_msg'] = "Edited the Job ID: ".$job_id;
        header("Location: index.php?rt=index/viewPostedJobs");
        exit();
    }

    public function delete() {
        $db = $this->registry->db;
        $job_id = $_GET['job_id'];
        $this->registry->job->deleteJob($db, $job_id);
        $_SESSION['delete_msg'] = "Deleted the Job Id: ".$job_id;
        header("Location: index.php?rt=index/viewPostedJobs");
        exit();
    }
}

?>