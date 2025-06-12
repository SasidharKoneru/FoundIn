<?php 
if (!isset($_SESSION['jobseeker_id'])) {
    // If not logged in, redirect to login page
    header("Location: index.php?rt=login/logout");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jobseeker Portal</title>
    <link rel="stylesheet" href="css/styles.css">
    <style>
        
    </style>
</head>
<body>
    <!-- Header -->
    <div class="header">
        <h1>Jobseeker Portal</h1>
        <div class="nav-links">
            <a href="index.php?rt=index/home">Home</a>
            <a href="index.php?rt=index/yourapplications">Your Applications</a>
            <a href="index.php?rt=login/logout">Logout</a>
        </div>
    </div>
     <section id="yourapplications">
    <div class="application-status">
        <h2>Your Job Applications</h2>
        <table class="status-table">
            <thead>
                <tr>
                    <th>Job Title</th>
                    <th>Company</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
            <?php 
            $applications = $this->registry->jobController->getJobsApplicationsofJobseeker();
            if ($applications): ?>
                <?php foreach ($applications as $application): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($application['job_title']); ?></td>
                        <td><?php echo htmlspecialchars($application['company_name']); ?></td>
                        <td><?php echo htmlspecialchars($application['status']); ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="3">No applications found.</td>
                </tr>
            <?php endif; ?>
            </tbody>
        </table>
    </div>
     </section>

    <!-- Generate Report Section -->
    <div class="generate-report">
        <a href="index.php?rt=report/generateApplicationsReport&id=<?php echo $_SESSION['jobseeker_id']; ?>"><button>Export Application Report Excel</button></a>
        <a href="index.php?rt=report/generateApplicationsReportXML&id=<?php echo $_SESSION['jobseeker_id']; ?>"><button>Export Application Report XML</button></a>
    </div>

    <!-- Footer -->
    <div class="footer">
        <p>&copy; 2025 Jobseeker Portal. All rights reserved.</p>
        <p><a href="#">Privacy Policy</a> | <a href="#">Terms & Conditions</a></p>
    </div>

    <script>
        function generateReport() {
            // In a real application, this would generate a PDF or download data
            alert("Generating report of job applications...");
            // Logic for generating report can be added here, like downloading a PDF of job applications
        }
    </script>
 <?php 
    
 ?>
</body>
</html>
