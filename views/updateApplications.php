<?php
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
                <li><a href="index.php?rt=login/logout_recruiter" class="btn">Logout</a></li>
            </ul>
        </nav>
    </header>
        <main>
        <section id="applicants">
                <h2>Track Applicants</h2>
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
                            <input type="hidden" name="job_id" id="" value="<?php echo $job_id; ?>">
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

        </main>    

    </body>
</html>