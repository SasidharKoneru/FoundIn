<?php
if (!isset($_SESSION['recruiter_id'])) {
    // If not logged in, redirect to login page
    header("Location: index.php?rt=login/logout");
    exit();
}

if(isset($_SESSION['update_msg'])) {
    $update_msg = $_SESSION['update_msg'];
    unset($_SESSION['update_msg']);
} else {
    $update_msg = "";
}
// Get the current URL
$protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
$host = $_SERVER['HTTP_HOST'];
$requestUri = $_SERVER['REQUEST_URI'];
$currentUrl = $protocol . $host . $requestUri;
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Recruiter Dashboard - Job Portal</title>
        <link rel="stylesheet" href="css/style.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    </head>
    <body>
    <header>
        <nav>
            <ul>
                <li><a href="index.php?rt=index/admin" class="btn">Home</a></li>
                <li><a href="index.php?rt=index/postJob" class="btn">Post New Job</a></li>
                <li><a href="index.php?rt=index/viewPostedJobs" class="btn">View Posted Jobs</a></li>
                <li><a href="index.php?rt=index/trackApplications" class="btn">Track Applications</a></li>
                <li><a href="index.php?rt=index/charts" class="btn">Charts</a></li>
                <li><a href="index.php?rt=login/logout_recruiter" class="btn">Logout</a></li>
            </ul>
        </nav>
    </header>
        <main>
            
        <section id="applicants">
            <?php if(!empty($update_msg)): ?>
                <span class="alert alert-info" role="alert"><?php echo $update_msg; ?></span>
            <?php endif; ?>
                <h2>Track Applicants</h2>
                <!-- <form action="" method=""> -->
                <div class="form-group d-flex">
                        <h4><label for="job_title" class="mr-3" style="flex-grow: 1;">Select Job Title</label></h4>
                        <select name="job_id" id="jobTitle" class="form-control mr-3" required style="flex-grow: 1;" required>
                            <option value="">Select a Job Title</option>
                            <?php
                            // Check if there are job titles fetched from the database
                            if ($jobs) {
                                $selectedJobId = isset($_GET['job_id']) ? $_GET['job_id'] : '';
                                foreach ($jobs as $job) {
                                    $selected = ($job['job_id'] == $selectedJobId) ? 'selected' : '';
                                    echo "<option value=\"" . htmlspecialchars($job['job_id']) . "\" $selected>" . htmlspecialchars($job['job_title']) . "</option>";
                                }
                            } else {
                                echo "<option value=\"\">No job titles available</option>";
                            }
                            ?>
                        </select> <br>
                        <button onclick="passValueToURL()" class="btn btn-success" style="flex-shrink: 0;">Get Apllications</button>
                    </div>

                    
                <!-- </form> -->
                <!-- <p>Click on the "Track Applicants" link next to each job to see the list of applicants for that job.</p> -->
    <table class="applicants-table">
        <thead>
            <tr>
                <th>Application Id</th>
                <th>Applicant Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Application Status</th>
                <th>Applied On</th>
                <th>Actions</th>
                <th>Submit</th>

            </tr>
        </thead>
        <tbody>
            <?php if (!empty($applicants)): ?>
                <h2>Applicants for Job ID: <?php echo htmlspecialchars($job_id); ?> </h2>
                <?php foreach ($applicants as $applicant): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($applicant['application_id']); ?></td>
                        <td><?php echo htmlspecialchars($applicant['full_name']); ?></td>
                        <td><?php echo htmlspecialchars($applicant['email']); ?></td>
                        <td><?php echo htmlspecialchars($applicant['phone_number']); ?></td>
                        <td><?php echo htmlspecialchars($applicant['status']); ?></td>
                        <td><?php echo htmlspecialchars($applicant['applied_at']); ?></td>
                        <form method="POST" style="display:inline;" action="index.php?rt=job/updateStatus">
                        <td>
                            <!-- Action buttons to change the application status -->
                                <input type="hidden" name="application_id" value="<?php echo $applicant['application_id']; ?>">
                                <select name="status">
                                    <option value="Pending" <?php if ($applicant['status'] === 'Pending') echo 'selected'; ?>>Pending</option>
                                    <option value="Reviewed" <?php if ($applicant['status'] === 'Reviewed') echo 'selected'; ?>>Reviewed</option>
                                    <option value="Interviewed" <?php if ($applicant['status'] === 'Interviewed') echo 'selected'; ?>>Interviewed</option>
                                    <option value="Accepted" <?php if ($applicant['status'] === 'Accepted') echo 'selected'; ?>>Accepted</option>
                                    <option value="Rejected" <?php if ($applicant['status'] === 'Rejected') echo 'selected'; ?>>Rejected</option>
                                </select>
                        </td> 
                        <td cellspacing= "3px">
                            <input type="hidden" name="job_id" id="" value="<?php echo $job_id; ?>">
                            <input type="hidden" name="current_url" value="<?php echo $currentUrl; ?>">
                            <button type="submit" class="update-btn">Update Status</button>
                        </td>
                        </form>
                    </tr>
                <?php endforeach; ?>
                <tr>
                    <td colspan="6"></td>
                    <form action="index.php?rt=report/trackapplicationsByJob" method="POST" class="">
                    <td>
                        <input type="hidden" value=<?php echo $_SESSION['recruiter_id']; ?> name="recruiter_id" >
                        <input type="hidden" value=<?php echo $job_id; ?> name="job_id" >
                        <button type="submit" class="update-btn" name="format" value="excel" >Download Excel Report</button> 
                    </td>
                    <td>
                        <button type="submit" class="update-btn" name="format" value="xml" >Download XML Report</button>
                    </td>
                    </form>
                </tr>
            <?php else: ?>
                <tr>
                    <td colspan="7">No applicants found for this job.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
            </section>

        </main>    

    </body>
    <script>
        function passValueToURL() {
            // Get the selected value from the select element
            var selectedValue = document.getElementById("jobTitle").value;
            
            // Construct the URL with the selected value as a query parameter
            var url = "index.php?rt=job/trackApplicants&job_id=" + selectedValue;
            
            // Redirect to the new URL with the query parameter
            window.location.href = url;
        }
    </script>
</html>