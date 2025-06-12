<?php
if (!isset($_SESSION['recruiter_id'])) {
    // If not logged in, redirect to login page
    header("Location: index.php?rt=login/logout");
    exit();
}

if (isset($_SESSION['edit_msg'])) {
    $editmsg = $_SESSION['edit_msg'];
    unset($_SESSION['edit_msg']);
} else {
    $editmsg = "";
}

if (isset($_SESSION['delete_msg'])) {
    $msg = $_SESSION['delete_msg'];
    unset($_SESSION['delete_msg']);
} else {
    $msg = "";
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
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <link rel="stylesheet" href="css/style.css">
        <link rel="script" href="scripts/script.js">
        <style>
            header{
                z-index: 100;
                position: fixed;
                width: 100%;
            }
            section {
                margin-top: 80px;
            }
        </style>
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

    <section id="postedJobs">
    <h2 class="col-xs-6">Your Posted Jobs</h2>
    <div class="row">
    <!-- Left-aligned Heading -->
    <?php if(!empty($msg)): ?>
        <span class="alert alert-danger" role="alert" ><?php echo $msg; ?></span>
    <?php endif; ?>
    <?php if(!empty($editmsg)): ?>
        <span class="alert alert-success" role="alert" ><?php echo $editmsg; ?></span>
    <?php endif; ?>
    
    <!-- Right-aligned Links -->
    <div class="col-xs-6 text-right">
        <a href="index.php?rt=export/jobpostsexcel" class="btn btn-primary">Export to Excel</a>
        <a href="index.php?rt=export/jobpostsxml" class="btn btn-primary">Export to XML</a>
    </div>
</div>
        <div class="table-responsive table-container">
                <table class="table table-bordered table-striped">
                    <thead class="thead-light">
                        <tr>
                            <th>Job Id</th>
                            <th>Job Title</th>
                            <th>Location</th>
                            <th>Salary</th>
                            <th>Status</th>
                            <!-- <th>Applicants</th> -->
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        // ehco "Fetch posted jobs from the database";
                        //$jobs = $this->registry->jobController->getJobsRecruiter($_SESSION['recruiter_id']);
                        foreach ($jobs as $job) {
                            $jsonJob = htmlspecialchars(json_encode($job,JSON_PRETTY_PRINT), ENT_QUOTES, 'UTF-8');
                            //echo $jsonJob;
                            echo "<tr>
                                    <td>{$job['job_id']}</td>
                                    <td>{$job['job_title']}</td>
                                    <td>{$job['company_location']}</td>
                                    <td>{$job['salary_range']}</td>
                                    <td>{$job['expiration_status']}</td>
                                    <td><a href='javascript:void(0)' onclick='openModal({$jsonJob})' >Edit Job</a>| <a href='index.php?rt=job/delete&job_id={$job['job_id']}' onclick='return confirmDelete({$job['job_id']}, \"" . addslashes($job['job_title']) . "\");'>Delete</a></td>
                                    </tr>";
                            //echo $jsonJob;
                        }
                        //echo $jsonJob;
                        ?>
                    </tbody>
                </table>
            </div>
            </section>
    </main>
    <div id="editJobModal" class="modal">
    <div class="modal-content">
        <span class="close" onclick="closeModal()">&times;</span>
        <h2>Edit Job</h2>

        <!-- Edit Form -->
        <form action="" method="POST" id="editJobForm">
            <div class="form-group">
                <label for="job_title">Job Title:</label>
                <input type="text" id="job_title" name="job_title" required>
            </div>

            <div class="form-group">
                <label for="job_description">Job Description:</label>
                <textarea id="job_description" name="job_description" rows="4" required></textarea>
            </div>

            <div class="form-group">
                <label for="salary_range">Salary Range:</label>
                <input type="text" id="salary_range" name="salary_range"  required>
            </div>

            <div class="form-group">
                <label for="company_location">Company Location:</label>
                <input type="text" id="company_location" name="company_location"  required>
            </div>

            <div class="form-group">
                <label for="company_name">Company Name:</label>
                <input type="text" id="company_name" name="company_name" required>
            </div>

            <div class="form-group">
                <label for="company_website">Company Website:</label>
                <input type="text" id="company_website" name="company_website" required>
            </div>

            <div class="form-group">
                <label for="job_type">Job Type:</label>
                <select id="job_type" name="job_type" required>
                    <option value="Full-time" >Full-time</option>
                    <option value="Part-time" >Part-time</option>
                    <option value="Contract" >Contract</option>
                </select>
            </div>

            <div class="form-group">
                <label for="job_category">Job Category:</label>
                <select id="job_category" name="job_category" required>
                    <option value="Engineering" >Engineering</option>
                    <option value="Marketing" >Marketing</option>
                    <option value="Design" >Design</option>
                    <option value="Sales" >Sales</option>
                </select>
            </div>

            <div class="form-group">
                <label for="required_experience">Required Experience (years):</label>
                <input type="number" id="required_experience" name="required_experience"  required>
            </div>

            <div class="form-group">
                <label for="education_level">Education Level:</label>
                <select id="education_level" name="education_level" required>
                    <option value="Bachelor's Degree" >Bachelor's Degree</option>
                    <option value="Master's Degree" >Master's Degree</option>
                    <option value="PhD" >PhD</option>
                </select>
            </div>

            <div class="form-group">
                <label for="expiration_date">Expiration Date:</label>
                <input type="date" id="expiration_date" name="expiration_date" required>
            </div>

            <button type="submit">Update Job</button>
        </form>
    </div>
</div>
<script src="scripts/script.js">
    
</script>
    </body>
    
    

</html>