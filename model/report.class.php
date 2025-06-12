<?php 
class Report {

    public function generateReport($db, $jobseeker_id) {
        try {

            $query = "
                SELECT 
                    jp.job_title, 
                    jp.company_name,
                    ja.status,
                    ja.applied_at,
                    jp.salary_range
                FROM 
                    job_applications ja
                INNER JOIN 
                    job_posts jp ON ja.job_id = jp.job_id
                WHERE 
                    ja.jobseeker_id = :jobseeker_id
            ";
            $stmt = $db->prepare($query);
            $stmt->bindparam(':jobseeker_id', $jobseeker_id);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

            $filename = $jobseeker_id."_jobseeker_applications_report_" . date("Y-m-d_H-i-s") . ".csv";

            // Set headers to prompt file download
            header('Content-Type: text/csv');
            header('Content-Disposition: attachment;filename="' . $filename . '"');

            // Open the PHP output stream
            $output = fopen('php://output', 'w');

            // Add the column headers to the CSV
            $headers = ['Job Title', 'Company Name', 'Status', 'Appliled Date', 'Salary'];
            fputcsv($output, $headers);

            // Add each row of data to the CSV
            foreach ($result as $application) {
                fputcsv($output, $application);
            }

            // Close the output stream
            fclose($output);
            exit;

        } catch(PDOException $e) {
            echo $e;
        }
    }

    public function generateReportXML($db, $jobseeker_id) {
        try {

            $query = "
                SELECT 
                    jp.job_title, 
                    jp.company_name,
                    ja.status,
                    ja.applied_at,
                    jp.salary_range
                FROM 
                    job_applications ja
                INNER JOIN 
                    job_posts jp ON ja.job_id = jp.job_id
                WHERE 
                    ja.jobseeker_id = :jobseeker_id
            ";
            $stmt = $db->prepare($query);
            $stmt->bindparam(':jobseeker_id', $jobseeker_id);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

            $filename = "_applicants_report_".$jobseeker_id."_". date("Y-m-d_H-i-s") . ".xml";
            $doc = new DOMDocument('1.0', 'UTF-8'); // Create root element 
            $root = $doc->createElement('applications'); 
            $doc->appendChild($root); // Fetch data and create XML elements 
            foreach ($result as $row) { 
                $applicationElement = $doc->createElement("application"); 
                foreach ($row as $key => $value) { 
                    $element = $doc->createElement(strtolower(str_replace(' ', '_', $key)), htmlspecialchars($value)); 
                    $applicationElement->appendChild($element); } $root->appendChild($applicationElement); } 
                    // Save the XML document as a string 
                    $xmlContent = $doc->saveXML(); 
                    // Set headers to prompt file download 
                    ob_clean();
                    header('Content-Description: File Transfer'); 
                    header('Content-Type: application/octet-stream'); 
                    header('Content-Disposition: attachment; filename='.$filename); 
                    header('Expires: 0'); 
                    header('Cache-Control: must-revalidate'); 
                    header('Pragma: public'); 
                    header('Content-Length: ' . strlen($xmlContent)); 
            // Output the XML content 
            echo $xmlContent;
            exit();

        } catch(PDOException $e) {
            echo $e;
        }
    }

    public function generateJobApplicationsReport($db, $recruiter_id, $format) {
        try {
            $query = "
                SELECT 
                    p.job_id,
                    p.job_title,
                    j.jobseeker_id, 
                    j.full_name, 
                    j.email, 
                    j.phone_number,
                    a.applied_at,
                    a.status
                FROM 
                    job_applications a
                JOIN 
                    jobseekers j ON a.jobseeker_id = j.jobseeker_id
                JOIN
                    job_posts p ON a.job_id = p.job_id
                WHERE 
                a.recruiter_id = :recruiter_id";
            $stmt = $db->prepare($query);
            $stmt->bindparam(':recruiter_id', $recruiter_id);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

            if($format == "excel") {
            $filename = "_applicants_report_".$recruiter_id. date("Y-m-d_H-i-s") . ".csv";

            // Set headers to prompt file download
            header('Content-Type: text/csv');
            header('Content-Disposition: attachment;filename="' . $filename . '"');

            // Open the PHP output stream
            $output = fopen('php://output', 'w');

            // Add the column headers to the CSV
            $headers = ['Job ID', 'Job Title','ID', 'Applicant Name','Applicant Email','Applicant Phone Number', 'Applied Date','Status'];
            fputcsv($output, $headers);

            // Add each row of data to the CSV
            foreach ($result as $application) {
                fputcsv($output, $application);
            }

            // Close the output stream
            fclose($output);
            exit;
        }
        if($format == "xml") {
            $filename = "_applicants_report_".$recruiter_id."_". date("Y-m-d_H-i-s") . ".xml";
            $doc = new DOMDocument('1.0', 'UTF-8'); // Create root element 
            $root = $doc->createElement('applications'); 
            $doc->appendChild($root); // Fetch data and create XML elements 
            foreach ($result as $row) { 
                $applicationElement = $doc->createElement("application"); 
                foreach ($row as $key => $value) { 
                    $element = $doc->createElement(strtolower(str_replace(' ', '_', $key)), htmlspecialchars($value)); 
                    $applicationElement->appendChild($element); } $root->appendChild($applicationElement); } 
                    // Save the XML document as a string 
                    $xmlContent = $doc->saveXML(); 
                    // Set headers to prompt file download 
                    ob_clean();
                    header('Content-Description: File Transfer'); 
                    header('Content-Type: application/octet-stream'); 
                    header('Content-Disposition: attachment; filename='.$filename); 
                    header('Expires: 0'); 
                    header('Cache-Control: must-revalidate'); 
                    header('Pragma: public'); 
                    header('Content-Length: ' . strlen($xmlContent)); 
            // Output the XML content 
            echo $xmlContent;
            exit();
        }


        } catch(PDOException $e) {
            echo $e;
        }
    }

    public function generateJobPostsReport($db, $recruiter_id, $format) {
        try {
            $query = "
            SELECT 
                jp.job_id,
                jp.job_title,
                COUNT(ja.job_id) AS total_applications,
                COUNT(CASE WHEN ja.status = 'pending' THEN 1 END) AS pending_count,
                COUNT(CASE WHEN ja.status = 'reviewed' THEN 1 END) AS reviewed_count,
                COUNT(CASE WHEN ja.status = 'interviewed' THEN 1 END) AS interviewed_count,
                COUNT(CASE WHEN ja.status = 'accepted' THEN 1 END) AS accepted_count,
                COUNT(CASE WHEN ja.status = 'rejected' THEN 1 END) AS rejected_count
            FROM 
                job_posts jp
            LEFT JOIN 
                job_applications ja ON jp.job_id = ja.job_id
            WHERE
                ja.recruiter_id = :recruiter_id
            GROUP BY 
                jp.job_id, jp.job_title";
            
            $stmt = $db->prepare($query);
            $stmt->bindparam(':recruiter_id', $recruiter_id);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            
            if($format === "excel") {

            $filename = "_recruiter_job_posts_report_".$recruiter_id."_". date("Y-m-d_H-i-s") . ".csv";

            

            // Set headers to prompt file download
            header('Content-Type: text/csv');
            header('Content-Disposition: attachment;filename="' . $filename . '"');

            // Open the PHP output stream
            $output = fopen('php://output', 'w');

            // Add the column headers to the CSV
            $headers = ['Job Id', 'Job Title', 'Total Applicants', 'Action Pending', 'Reviewed Applicants', 'Interviewed Applicatants', 'Accepted Applicants', 'Rejected Applicatants'];
            fputcsv($output, $headers);

            // Add each row of data to the CSV
            foreach ($result as $application) {
                fputcsv($output, $application);
            }

            // Close the output stream
            fclose($output);
            exit;
        }

        if($format === "xml") {
            $filename = "_recruiter_job_posts_report_".$recruiter_id."_". date("Y-m-d_H-i-s") . ".xml";
            echo "xml ";
            $doc = new DOMDocument('1.0', 'UTF-8'); // Create root element 
            $root = $doc->createElement('jobs'); 
            $doc->appendChild($root); // Fetch data and create XML elements 
            foreach ($result as $row) { 
                $applicationElement = $doc->createElement("job"); 
                foreach ($row as $key => $value) { 
                    $element = $doc->createElement(strtolower(str_replace(' ', '_', $key)), htmlspecialchars($value)); 
                    $applicationElement->appendChild($element); } $root->appendChild($applicationElement); } 
                    // Save the XML document as a string 
                    $xmlContent = $doc->saveXML(); 
                    // Set headers to prompt file download 
                    ob_clean();
                    header('Content-Description: File Transfer'); 
                    header('Content-Type: application/octet-stream'); 
                    header('Content-Disposition: attachment; filename='.$filename); 
                    header('Expires: 0'); 
                    header('Cache-Control: must-revalidate'); 
                    header('Pragma: public'); 
                    header('Content-Length: ' . strlen($xmlContent)); 
            // Output the XML content 
            echo $xmlContent;
        }

        } catch(PDOException $e) {
            echo $e;
        }
    }


    public function trackApplications($db, $recruiter_id, $job_id, $format) {
        try {

            $query = "
                SELECT 
                ja.job_id,
                ja.application_id, 
                js.jobseeker_id, 
                js.full_name,
                js.email, 
                js.phone_number,
                ja.applied_at,
                ja.status
            FROM 
                job_applications ja
            INNER JOIN 
                jobseekers js ON ja.jobseeker_id = js.jobseeker_id
            WHERE 
                ja.job_id = :job_id
            ORDER BY 
                ja.applied_at DESC";
            $stmt = $db->prepare($query);
            //$stmt->bindparam(':recruiter_id', $recruiter_id);
            $stmt->bindparam(':job_id', $job_id);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            //print_r($result);

            if($format === "excel") {
            $filename = "_applicants_report_".$recruiter_id. date("Y-m-d_H-i-s") . ".csv";

            // Set headers to prompt file download
            header('Content-Type: text/csv');
            header('Content-Disposition: attachment;filename="' . $filename . '"');

            // Open the PHP output stream
            $output = fopen('php://output', 'w');

            // Add the column headers to the CSV
            $headers = ['Job ID','Application ID','Job Seeker ID', 'Applicant Name','Applicant Email','Applicant Phone Number', 'Applied Date','Status'];
            fputcsv($output, $headers);

            // Add each row of data to the CSV
            foreach ($result as $application) {
                fputcsv($output, $application);
            }

            // Close the output stream
            fclose($output);
            exit;
        }

        if($format == "xml") {
            $filename = "_applicants_report_".$recruiter_id."_". date("Y-m-d_H-i-s") . ".xml";
            $doc = new DOMDocument('1.0', 'UTF-8'); // Create root element 
            $root = $doc->createElement('applications'); 
            $doc->appendChild($root); // Fetch data and create XML elements 
            foreach ($result as $row) { 
                $applicationElement = $doc->createElement("application"); 
                foreach ($row as $key => $value) { 
                    $element = $doc->createElement(strtolower(str_replace(' ', '_', $key)), htmlspecialchars($value)); 
                    $applicationElement->appendChild($element); } $root->appendChild($applicationElement); } 
                    // Save the XML document as a string 
                    $xmlContent = $doc->saveXML(); 
                    // Set headers to prompt file download 
                    ob_clean();
                    header('Content-Description: File Transfer'); 
                    header('Content-Type: application/octet-stream'); 
                    header('Content-Disposition: attachment; filename='.$filename); 
                    header('Expires: 0'); 
                    header('Cache-Control: must-revalidate'); 
                    header('Pragma: public'); 
                    header('Content-Length: ' . strlen($xmlContent)); 
            // Output the XML content 
            echo $xmlContent;
        }


        } catch(PDOException $e) {
            echo $e;
        }
    }
}

?>