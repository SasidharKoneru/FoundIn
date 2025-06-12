<?php 

class Job {

    public function createJob($db, $recruiter_id, $job_title, $job_description, 
    $salary_range, $company_location, $company_name, $company_website, 
    $job_type, $job_category, $required_experience, $education_level, $expiration_date) {
        //$_SESSION['import_msg'] = "inside create job from XML";
        try {
            // echo " inside the try block";
            // Prepare the SQL statement with placeholders
            $query = "SELECT count(*) FROM job_posts WHERE job_title = :job_title AND recruiter_id = :recruiter_id AND company_location = :company_location";
            $stmt = $db->prepare($query);
            $stmt->bindparam(':job_title', $job_title);
            $stmt ->bindparam(':recruiter_id', $recruiter_id);
            $stmt->bindparam(':company_location', $company_location);
            $stmt->execute();
            $count = $stmt->fetchColumn();
            if($count > 0) {
                $_SESSION['post_error'] = "Job already exists with the same details!";
                header("Location: index.php?rt=index/postJob");
            } else {
            $stmt = $db->prepare("
                INSERT INTO job_posts(
                recruiter_id, 
                job_title, 
                job_description, 
                salary_range, 
                company_location, 
                company_name, 
                company_website, 
                job_type, 
                job_category, 
                required_experience, 
                education_level, 
                expiration_date) 
                VALUES(
                :recruiter_id, 
                :job_title, 
                :job_description, 
                :salary_range, 
                :company_location, 
                :company_name, 
                :company_website, 
                :job_type, 
                :job_category, 
                :required_experience, 
                :education_level,  
                :expiration_date)
            ");

            // Bind the form values to the statement
            $stmt->bindparam(':recruiter_id', $recruiter_id);
            $stmt->bindParam(':job_title', $job_title);
            $stmt->bindParam(':job_description', $job_description);
            $stmt->bindParam(':salary_range', $salary_range);
            $stmt->bindParam(':company_location', $company_location);
            $stmt->bindParam(':company_name', $company_name);
            $stmt->bindParam(':company_website', $company_website);
            $stmt->bindParam(':job_type', $job_type);
            $stmt->bindParam(':job_category', $job_category);
            $stmt->bindParam(':required_experience', $required_experience);
            $stmt->bindParam(':education_level', $education_level);
            $stmt->bindParam(':expiration_date', $expiration_date);
            $stmt->execute();
            // echo " stmt executed";
            $_SESSION['post_msg'] = 'Job Posted successfully';
        header("Location: index.php?rt=index/postJob");
        exit();
            }
        } catch(PDOException $e) {
            $_SESSION['post_error'] = "Failed to Post the Job(s).";
            header("Location: index.php?rt=index/postJob");
            exit();
            //echo $e;
        }
        // echo " before the header ";
        // header("Location: index.php?rt=index/admin");
        // exit();
    }

    public function updateJob($db, $job_id, $job_title, $job_description, 
    $salary_range, $company_location, $company_name, $company_website, 
    $job_type, $job_category, $required_experience, $education_level,
    $expiration_date) {
        try {
        $query = "
    UPDATE job_posts
    SET 
        job_title = :job_title,
        job_description = :job_description, 
        salary_range = :salary_range, 
        company_location = :company_location, 
        company_name = :company_name, 
        company_website = :company_website, 
        job_type = :job_type, 
        job_category = :job_category, 
        required_experience = :required_experience, 
        education_level = :education_level, 
        expiration_date = :expiration_date 
    WHERE job_id = :job_id";

    $stmt = $db->prepare($query);
    $stmt->bindparam(':job_title', $job_title);
    $stmt->bindparam(':job_description', $job_description);
    $stmt->bindparam(':salary_range', $salary_range);
    $stmt->bindparam(':company_location', $company_location);
    $stmt->bindparam(':company_name', $company_name);
    $stmt->bindparam(':company_website', $company_website);
    $stmt->bindparam(':job_type', $job_type);
    $stmt->bindparam(':job_category', $job_category);
    $stmt->bindparam(':required_experience', $required_experience);
    $stmt->bindparam(':education_level', $education_level);
    $stmt->bindparam(':expiration_date', $expiration_date);
    $stmt->bindparam(':job_id',$job_id);

    $stmt->execute();

    }catch(PDOException $e) {
        echo $e;
    }
    } 

    public function deleteJob($db, $job_id) {
        try {
            $query = "DELETE FROM job_posts WHERE job_id = :job_id";
            $stmt = $db->prepare($query);
            $stmt->bindparam(':job_id', $job_id);
            $stmt->execute();
        } catch(PDOException $e) {
            echo $e;
        }
    }

    public function getAllJobs($db, $jobseeker_id) {
        try{
            $query = "
            SELECT 
                j.job_id, 
                j.job_title, 
                j.company_location, 
                j.company_name, 
                j.salary_range, 
                j.job_description, 
                j.expiration_date,
            CASE 
                WHEN j.expiration_date >= CURDATE() THEN 'Available to Apply'
                ELSE 'Expired'
            END AS application_status
            FROM 
                job_posts j
            LEFT JOIN 
                job_applications ja ON j.job_id = ja.job_id AND ja.jobseeker_id = :jobseeker_id
            WHERE 
                j.expiration_date >= CURDATE() AND ja.jobseeker_id IS NULL";

            $stmt = $db->prepare($query);
            $stmt->bindparam(':jobseeker_id', $jobseeker_id);
            $stmt->execute();
            $jobs = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $jobs;

        } catch(PDOException $e) {
            echo $e;
        }
    }

    public function getJobsByRecruiter($db, $recruiter_id) {
        try {
            $query = "SELECT j.*,
            CASE 
                WHEN j.expiration_date >= CURDATE() THEN 'Active'  -- Job is still available for applications
                ELSE 'Expired'  -- Job has expired
            END AS expiration_status
            FROM job_posts j where j.recruiter_id = :recruiter_id";
            $stmt = $db->prepare($query);
            $stmt->bindparam(':recruiter_id', $recruiter_id);
            $stmt->execute();
            $jobs = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $jobs;
        } catch(PDOException $e) {
            echo $e;
            return false;
        }
        return false;
    }

    public function getJobById($db, $job_id) {
        try {
            $query = "
            SELECT 
                ja.application_id, 
                ja.status, 
                ja.applied_at, 
                js.jobseeker_id, 
                js.full_name, 
                js.email, 
                js.phone_number
            FROM 
                job_applications ja
            INNER JOIN 
                jobseekers js ON ja.jobseeker_id = js.jobseeker_id
            WHERE 
                ja.job_id = :job_id
            ORDER BY 
                ja.applied_at DESC
            ";
            $stmt = $db->prepare($query);
            $stmt->bindparam(':job_id', $job_id);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        } catch(PDOException $e) {
            echo $e;
            return false;
        }
        return false;
    }

    public function applyJob($db, $jobseeker_id, $job_id, $recruiter_id) {
        try{
            $query = "INSERT INTO job_applications (jobseeker_id, job_id, recruiter_id) VALUES(:jobseeker_id, :job_id, :recruiter_id)";
            $stmt = $db->prepare($query);
            $stmt->bindparam(':jobseeker_id', $jobseeker_id);
            $stmt->bindparam(':job_id', $job_id);
            $stmt->bindparam(':recruiter_id', $recruiter_id);
            $stmt->execute();
            return true;
        } catch(PDOException $e) {
            echo $e;
            return false;
        }
        return false;
    }

    public function getApplications($db, $jobseeker_id) {
        try {
            $query = "
                SELECT 
                    ja.jobseeker_id, 
                    ja.job_id, 
                    ja.status, 
                    jp.job_title, 
                    jp.company_name
                FROM 
                    job_applications ja
                INNER JOIN 
                    job_posts jp ON ja.job_id = jp.job_id
                WHERE 
                    ja.jobseeker_id = :jobseeker_id
            ";
            $stmt = $db->prepare($query);
            $stmt->bindparam('jobseeker_id', $jobseeker_id);
            $stmt->execute();
            $applications = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $applications;
        } catch(PDOException $e){
            echo $e;
            return false;
        }
        return false;
    }

    public function updateApplicationStatus($db, $application_id, $status) {
        echo "inside the class";
        try {
            $query = "
                    UPDATE job_applications
                    SET status = :status
                    WHERE application_id = :application_id";
            $stmt = $db->prepare($query);
            $stmt->bindparam(':status', $status);
            $stmt->bindparam(':application_id', $application_id);
            $stmt->execute();
            // return true;
        } catch(PDOException $e) {
            echo $e;
        }
    }

}

?>