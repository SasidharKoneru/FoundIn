<?php
if (!isset($_SESSION['recruiter_id'])) {
    // If not logged in, redirect to login page
    header("Location: index.php?rt=login/logout");
    exit();
}

if(isset($_SESSION['import_msg'])) {
    $importMsg = $_SESSION['import_msg'];
    unset($_SESSION['import_msg']);
} else {
    $importMsg = "";
}

if (isset($_SESSION['post_error'])) {
    $posterror = $_SESSION['post_error'];
    unset($_SESSION['post_error']);
} else {
    $posterror = "";
}

if (isset($_SESSION['import_error'])){
    $msgError = $_SESSION['import_error'];
    unset($_SESSION['import_error']);
} else {
    $msgError = "";
}

if (isset($_SESSION['import_msg_success'])){
    $msgSuccess = $_SESSION['import_msg_success'];
    unset($_SESSION['import_msg_success']);
} else {
    $msgSuccess = "";
}

if (isset($_SESSION['post_msg'])) {
    $postmsg = $_SESSION['post_msg'];
    unset($_SESSION['post_msg']);
} else {
    $postmsg = "";
}

// Get the current URL
$protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
$host = $_SERVER['HTTP_HOST'];
$requestUri = $_SERVER['REQUEST_URI'];
$currentUrl = $protocol . $host . $requestUri;
?>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recruiter Dashboard - Job Portal</title>
    <link rel="stylesheet" href="css/style.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <style>
        header{
            z-index: 100;
            position: fixed;
            width: 100%;
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
            <!-- Post New Job Form -->
            <section id="postJobForm">
            <div class="container">
                <?php if (!empty($postmsg)): ?>
                    <span class="alert alert-success"><?php echo $postmsg; ?></span>
                <?php endif; ?>
                <?php if(!empty($msgSuccess)): ?>
                    <span class="alert alert-success" role="alert"><?php echo $msgSuccess; $msgSuccess="";?></span>
                <?php endif; ?>
                <?php if(!empty($msgError)): ?>
                    <span class="alert alert-danger" role="alert"><?php echo $msgError; ?></span>
                <?php endif; ?>
                <?php if (!empty($posterror)): ?>
                    <span class="alert alert-danger"><?php echo $posterror; ?></span>
                <?php endif; ?>
                <?php if (!empty($importMsg)): ?>
                    <span class="alert alert-danger"><?php echo $importMsg; ?></span>
                <?php endif; ?>
            <h2>Post a New Job</h2>
            <div> 
            
            <h4>Import Data (for Multiple positions)</h4>
            <table>
                <tr><form action="index.php?rt=import/importCSV" method="POST" enctype="multipart/form-data">
                    <td><input type="file" name="csv_file" id="csv_file" accept=".csv" required></td>
                    <td><button type="submit" name="upload" class="update-btn">Import from Excel</button> </td>
                    <td>     </td>
                    </form>
                    <form action="index.php?rt=import/importXML" method="POST" enctype="multipart/form-data">
                    <td><input type="file" name="xml_file" id="xml_file" accept=".xml" required></td>
                    <td><button type="submit" class="update-btn" name="upload">Import from XML</button></td>
                </tr>
                
            </table>
            </form>
        </div>

        <div class="form-container">
        
        <!-- Job Posting Form -->
        <form action="index.php?rt=job/postjob" method="POST">
        <h3>Enter Manually </h3>
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
                <input type="text" id="salary_range" name="salary_range" required>
            </div>

            <div class="form-group">
                <label for="company_location">Company Location:</label>
                <input type="text" id="company_location" name="company_location" required>
            </div>

            <div class="form-group">
                <label for="company_name">Company Name:</label>
                <input type="text" id="company_name" name="company_name" value="<?php echo $_SESSION['company_name'];?>"required>
            </div>

            <div class="form-group">
                <label for="company_website">Company Website:</label>
                <input type="url" id="company_website" name="company_website" required placeholder="https://example.com">
            </div>

            <div class="form-group">
                <label for="job_type">Job Type:</label>
                <select id="job_type" name="job_type" required>
                    <option value="Full-time">Full-time</option>
                    <option value="Part-time">Part-time</option>
                    <option value="Contract">Contract</option>
                </select>
            </div>

            <div class="form-group">
                <label for="job_category">Job Category:</label>
                <select id="job_category" name="job_category" required>
                    <option value="Engineering">Engineering</option>
                    <option value="Marketing">Marketing</option>
                    <option value="Design">Design</option>
                    <option value="Sales">Sales</option>
                </select>
            </div>

            <div class="form-group">
                <label for="required_experience">Required Experience (years):</label>
                <input type="number" id="required_experience" name="required_experience" required>
            </div>

            <div class="form-group">
                <label for="education_level">Education Level:</label>
                <select id="education_level" name="education_level" required>
                    <option value="Bachelor's Degree">Bachelor's Degree</option>
                    <option value="Master's Degree">Master's Degree</option>
                    <option value="PhD">PhD</option>
                </select>
            </div>

            <div class="form-group">
                <label for="expiration_date">Expiration Date:</label>
                <input type="date" id="expiration_date" name="expiration_date" required> 
                <br>
            </div>

            <div>
                <button type="submit">Post Job</button>
            </div>
        </form>
    </div>
    </section>
</body>
</html>