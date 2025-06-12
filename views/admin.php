<?php
// Assuming you have a session started and the recruiter is logged in
// Include your database connection or any class for fetching data
// include('conf/db.php'); 

// // Fetch the recruiter data (for example, their name and ID)
// $recruiter_id = $_SESSION['recruiter_id']; // Assuming the recruiter ID is stored in session

if (!isset($_SESSION['recruiter_id'])) {
    // If not logged in, redirect to login page
    header("Location: index.php?rt=login/logout");
    exit();
}


// Get the current URL
$protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
$host = $_SERVER['HTTP_HOST'];
$requestUri = $_SERVER['REQUEST_URI'];
$currentUrl = $protocol . $host . $requestUri;
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recruiter Dashboard - Job Portal</title>
    <link rel="stylesheet" href="styles.css">
    <!-- You can include other styles or libraries like Bootstrap here -->
     <style>
        /* General Body and Layout */
body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
    background-color: #f4f4f9;
    color: #333;
    
}

header {
    background-color: #007bff;
    color: white;
    padding: 20px 0;
    text-align: center;
}

header nav ul {
    list-style-type: none;
    padding: 0;
}

header nav ul li {
    display: inline;
    margin: 0 15px;
}

header nav ul li a {
    color: white;
    text-decoration: none;
    font-size: 18px;
}

header nav ul li a:hover {
    text-decoration: underline;
}

/* Main Section */
main {
    padding: 30px;
}

.dashboard-container {
    max-width: 1200px;
    margin: 0 auto;
}

.dashboard-container h1 {
    font-size: 32px;
    margin-bottom: 20px;
}

.dashboard-options {
    display: flex;
    justify-content: space-between;
    margin-bottom: 40px;
}

.dashboard-options .btn {
    background-color: #007bff;
    color: white;
    padding: 12px 20px;
    text-decoration: none;
    border-radius: 5px;
    font-size: 18px;
}

.dashboard-options .btn:hover {
    background-color: #0056b3;
}

/* Forms Styling */
form {
    background-color: #ffffff;
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
    margin-bottom: 40px;
}

form label {
    font-size: 16px;
    font-weight: bold;
    margin-bottom: 8px;
    display: block;
}

form input[type="text"],
form input[type="number"],
form input[type="file"],
form textarea,
form select, 
td select {
    width: 95%;
    padding: 12px;
    margin-bottom: 15px;
    border-radius: 5px;
    border: 1px solid #ddd;
    font-size: 16px;
}

form textarea {
    resize: vertical;
    min-height: 100px;
}
form input[type="date"] { 
    padding: 10px; 
    border: 2px solid #ccc; 
    border-radius: 5px; 
    font-size: 16px; 
    color: #333; 
    background-color: #f9f9f9; 
    width: 30%; 
    box-sizing: border-box;
} 
/* Styling when the date input is focused */ 
form input[type="date"]:focus { 
    border-color: #66afe9; 
    outline: none; 
    box-shadow: 0 0 5px rgba(102, 175, 233, 0.6); 
}
form button {
    background-color: #28a745;
    color: white;
    padding: 12px 20px;
    border: none;
    border-radius: 5px;
    font-size: 18px;
    cursor: pointer;
}

form button:hover {
    background-color: #218838;
}

.update-btn {
    background-color: #28a745;
    color: white;
    padding: 12px 20px;
    border: none;
    border-radius: 5px;
    font-size: 12px;
    cursor: pointer;
    left: 10px;
   
}

.update-btn:hover {
    background-color: #218838;
}

/* Table Styling for Posted Jobs */
table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 30px;
}

table th,
table td {
    padding: 15px;
    text-align: left;
    border-bottom: 1px solid #ddd;
}

table th {
    background-color: #007bff;
    color: white;
}

table td a {
    color: #007bff;
    text-decoration: none;
}

table td a:hover {
    text-decoration: underline;
}

/* Section Headers */
h2 {
    color: #007bff;
    font-size: 24px;
    margin-bottom: 20px;
}

/* Modal Styles */
.modal {
    display: none; /* Hidden by default */
    position: fixed;
    z-index: 1;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    overflow: auto;
    background-color: rgba(0, 0, 0, 0.4); /* Black with opacity */
}

.modal-content {
    background-color: #fff;
    margin: 5% auto;
    padding: 20px;
    border: 1px solid #888;
    width: 80%;
    max-width: 600px;
    border-radius: 10px;
}

.close {
    color: #aaa;
    float: right;
    font-size: 28px;
    font-weight: bold;
}

.close:hover,
.close:focus {
    color: black;
    text-decoration: none;
    cursor: pointer;
}

/* Footer Styling */
footer {
    background-color: #f1f1f1;
    text-align: center;
    padding: 15px;
    margin-top: 40px;
}

footer p {
    margin: 0;
    font-size: 14px;
    color: #555;
}

/* Responsive Design for Smaller Screens */
@media (max-width: 768px) {
    .dashboard-options {
        flex-direction: column;
        align-items: center;
    }

    .dashboard-options .btn {
        margin-bottom: 15px;
    }

    /* table th, table td {
        padding: 10px;
        font-size: 14px;
    } */

    table { 
        width: 100%; 
        border-collapse: collapse;
    } 

    td { 
        padding: 8px; 
        text-align: left; 
        border-bottom: 1px solid #ddd; 
    }

    form input[type="text"],
    form input[type="number"],
    form textarea,
    form select {
        font-size: 14px;
    }

    form button {
        font-size: 16px;
    }
}

     </style>
</head>
<body>
    <header>
        <nav>
            <ul>
                <li><a href="">Home</a></li>
                <li><a href="index.php?rt=login/logout_recruiter">Logout</a></li>
            </ul>
        </nav>
    </header>

    <main>
        <div class="dashboard-container">
            <h1>Welcome, Recruiter</h1>
            <!-- <div class="dashboard-options"> 
                <a href="index.php?rt=index/postJob" class="btn">Post New Job</a>
                <a href="#postedJobs" class="btn">View Posted Jobs</a>
                <a href="#applicants" class="btn">Track Applicants</a>
                <a href="#generateReport" class="btn">Generate Report</a>
            </div>

            <!-- Post New Job Form -->
            <section id="postJobForm">
                <div class="form-container">
        <h2>Post a New Job</h2>

        <!-- Job Posting Form -->
        <form action="index.php?rt=job/postjob" method="POST">
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
                <input type="text" id="company_website" name="company_website" required>
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
        <div> 
            <h2>Import Data</h2>
            <form action="index.php?rt=import/importXML" method="POST" enctype="multipart/form-data">
            <table>
                <tr>
                    <td><input type="file" name="csv_file" id="csv_file" accept=".csv"></td>
                    <td><button type="submit" name="upload" class="update-btn">Import from Excel</button> </td>
                    <td>                             </td>
                    <td><input type="file" name="xml_file" id="xml_file" accept=".xml"></td>
                    <td><button type="submit" class="update-btn" name="upload">Import from XML</button></td>
                </tr>
            </table>
            </form>
        </div>
    </div>
    </section>

        <!-- View Posted Jobs -->
        <section id="postedJobs">
                <h2>Your Posted Jobs</h2>
                <table>
                    <thead>
                        <tr>
                            <th>Job Id</th>
                            <th>Job Title</th>
                            <th>Location</th>
                            <th>Salary</th>
                            <th>Status</th>
                            <th>Applicants</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        // ehco "Fetch posted jobs from the database";
                        $jobs = $this->registry->jobController->getJobsRecruiter($_SESSION['recruiter_id']);
                        foreach ($jobs as $job) {
                            $jsonJob = htmlspecialchars(json_encode($job,JSON_PRETTY_PRINT), ENT_QUOTES, 'UTF-8');
                            //echo $jsonJob;
                            echo "<tr>
                                    <td>{$job['job_id']}</td>
                                    <td>{$job['job_title']}</td>
                                    <td>{$job['company_location']}</td>
                                    <td>{$job['salary_range']}</td>
                                    <td>{$job['expiration_status']}</td>
                                    <td><a href='index.php?rt=job/trackApplicants&job_id={$job['job_id']}#applicants'>Track Applicants</a></td>
                                    <td><a href='javascript:void(0)' onclick='openModal({$jsonJob})' >Edit Job</a>| <a href='index.php?rt=job/delete&job_id={$job['job_id']}'>Delete</a></td>
                                    </tr>";
                            //echo $jsonJob;
                        }
                        //echo $jsonJob;
                        ?>
                    </tbody>
                </table>
            </section>

            <!-- Track Applicants -->
            <section id="applicants">
                <h2>Track Applicants</h2>
                <p>Click on the "Track Applicants" link next to each job to see the list of applicants for that job.</p>
    <table class="applicants-table">
        <thead>
            <tr>
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
                <h2>Applicants for Job ID: <?php echo htmlspecialchars($job_id); ?></h2>
                <?php foreach ($applicants as $applicant): ?>
                    <tr>
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
                            <input type="hidden" name="current_url" value="<?php echo $currentUrl; ?>">
                            <button type="submit" class="update-btn">Update Status</button>
                        </td>
                        </form>
                    </tr>
                <?php endforeach; ?>
                <tr>
                    <td colspan="5"></td>
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

            <!-- Generate Report -->
            <section id="generateReport">
                <h2>Generate Report</h2>
                <form action="index.php?rt=report/generateReports" method="POST">
                    <input type="hidden" value=<?php echo $_SESSION['recruiter_id']; ?> name="recruiter_id" >
                    <label for="report_type">Select Report Type:</label>
                    <select name="report_type" id="report_type">
                        <option value="job_posts_reports">Job Postings Report</option>
                        <option value="applicants">Applicants Report</option> 
                    </select>

                    <button type="submit" name="format" value="excel">Generate Excel Report</button>
                    <button type="submit" name="format" value="xml">Generate XML Report</button>
                </form>
            </section>
        </div>
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

<!-- Link to trigger modal -->

<script>
    // Function to open the modal
    
function openModal(data) {
    document.getElementById("editJobModal").style.display = "block";
    prefillForm(data);
   
}
function prefillForm(data) {
    const editform = document.getElementById('editJobForm');

    // Fill in the form fields with data
    editform.querySelector("#job_title").value = data.job_title;
    console.log(data.job_title);
    editform.querySelector("#job_description").value = data.job_description;
    editform.querySelector("#salary_range").value = data.salary_range;
    editform.querySelector("#company_location").value = data.company_location;
    editform.querySelector("#company_name").value = data.company_name;
    editform.querySelector("#company_website").value = data.company_website;
    editform.querySelector("#job_type").value = data.job_type;
    editform.querySelector("#job_category").value = data.job_category;
    editform.querySelector("#required_experience").value = data.required_experience;
    editform.querySelector("#education_level").value = data.education_level;
    editform.querySelector("#expiration_date").value = data.expiration_date;
    // Update the form action URL to include the job_id
    editform.action = "index.php?rt=job/edit&job_id=" + data.job_id;

} 

// Function to close the modal
function closeModal() {
    document.getElementById("editJobModal").style.display = "none";
}

// Close the modal if the user clicks outside the modal content
window.onclick = function(event) {
    if (event.target == document.getElementById("editJobModal")) {
        closeModal();
    }
}

 </script>  -->

    <footer>
        <p>&copy; 2025 Job Portal. All rights reserved.</p>
    </footer>
    <!-- Edit Job Modal -->


</body>
</html>
