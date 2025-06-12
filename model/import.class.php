<?php 

class Import {

    public function processCSV($filePath, $recruiter_id, $registry) {
        $csvFile = fopen($filePath, 'r');
        fgetcsv($csvFile); // Skip header row
        //$_SESSION['import_msg'] = " inside processCSV function";
        $_SESSION['import_msg'] = "Excel data not supported.";
        while (($row = fgetcsv($csvFile)) !== false) {
            unset($_SESSION['import_msg']);
            $db = $registry->db;
            $job_title = $row[0];
            $job_description = $row[1];
            $salary_range = $row[2];
            $company_location = $row[3];
            $company_name = $row[4];
            $company_website = $row[5];
            $job_type = $row[6];
            $job_category = $row[7];
            $required_experience = $row[8];
            $education_level = $row[9];
            $expiration_date = $row[11];
            //print_r($row);
            // echo "<br>";
            $registry->job->createJob($db, $recruiter_id, $job_title, $job_description, 
            $salary_range, $company_location, $company_name, $company_website, 
            $job_type, $job_category, $required_experience, $education_level, $expiration_date);
            $_SESSION['import_msg_success'] = "EXCEL Import success.";
        }
        
        
        fclose($csvFile);
    }

    public function processXML($xml,$recruiter_id, $registry) {
                // Load the XML file
                //$_SESSION['import_msg'] = "inside processXML";
                // Iterate through each <job> in the XML
                $_SESSION['import_msg'] = "XML Tree not supported.";
                foreach ($xml->job as $job) {
                    unset($_SESSION['import_msg']);
                    //$_SESSION['import_msg'] = "inside foreach proceessXML";
                    //print_r($job);
                    $db = $registry->db;
                    // Extract data from the XML
                    $job_id = (int)$job->job_id;
                    //$recruiter_id = (int)$job->recruiter_id;
                    $job_title = (string)$job->job_title;
                    $job_description = (string)$job->job_description;
                    $salary_range = (string)$job->salary_range;
                    $company_location = (string)$job->company_location;
                    $company_name = (string)$job->company_name;
                    $company_website = (string)$job->company_website;
                    $job_type = (string)$job->job_type;
                    $job_category = (string)$job->job_category;
                    $required_experience = (int)$job->required_experience;
                    $education_level = (string)$job->education_level;
                    $post_date = (string)$job->post_date;
                    $expiration_date = (string)$job->expiration_date;
                    $status = (string)$job->status;
                    $registry->job->createJob($db, $recruiter_id, $job_title, $job_description, 
                    $salary_range, $company_location, $company_name, $company_website, 
                    $job_type, $job_category, $required_experience, $education_level, $expiration_date);
                    $_SESSION['import_msg_success'] = "XML Import success."; 
                }
                
            }
        }

?>