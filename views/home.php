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
        /* General Styles */
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f1f3f6;
        }
        .header{
            top: 0;
            z-index: 100;
            position: fixed;
            width: 100%;
        }

        h1 {
            color: #4CAF50;
            margin: 0;
        }

        h2, h3, h4 {
            color: #333666;
            margin: 0;
        }

        /* Header */
        .header {
            background-color: #232F3E;
            color: white;
            padding: 20px 0;
            text-align: center;
            font-size: 24px;
            font-weight: bold;
        }

        .nav-links {
            display: flex;
            justify-content: center;
            gap: 30px;
            padding: 10px;
        }

        .nav-links a {
            color: white;
            text-decoration: none;
            font-weight: 500;
            font-size: 18px;
            padding: 10px;
            transition: background-color 0.3s ease;
        }

        .nav-links a:hover {
            background-color: #4CAF50;
            border-radius: 5px;
        }

        /* Job Listings Section */
        .job-listings {
            background-color: #ffffff;
            padding: 40px 20px;
            margin-top: 150px;
        }

        .job-listings h2 {
            font-size: 36px;
            text-align: center;
            margin-bottom: 30px;
        }

        .job-card {
            background-color: white;
            padding: 20px;
            width: 300px;
            /* height: auto; */
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(7, 7, 7, 0.5);
            margin-bottom: 20px;
            text-align: left;
            display: inline-block;
            transition: transform 0.3s ease;
        }

        .job-card:hover {
            transform: translateY(-5px);
        }

        .job-card h3 {
            font-size: 24px;
            margin-bottom: 15px;
        }

        .job-card p {
            font-size: 16px;
            font-weight: bold;
            color: #555;
        }

        .job-card p .h{
            font-size: 16px;
            color: red;
        }

        .job-card .apply-btn {
            display: block;
            margin-top: 10px;
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            text-align: center;
            border-radius: 5px;
            text-decoration: none;
            font-weight: bold;
        }

        .job-card .apply-btn:hover {
            background-color: #45a049;
        }

        /* Application Status Section */
        .application-status {
            padding: 40px 20px;
            background-color: #f9f9f9;
            text-align: center;
        }

        .application-status h2 {
            font-size: 36px;
            margin-bottom: 30px;
        }

        .status-table {
            width: 100%;
            border-collapse: collapse;
            margin: 0 auto;
        }

        .status-table th, .status-table td {
            padding: 12px;
            border: 1px solid #ddd;
            text-align: center;
        }

        .status-table th {
            background-color: #4CAF50;
            color: white;
        }

        .status-table td {
            background-color: white;
        }

        /* Generate Report Section */
        .generate-report {
            text-align: center;
            padding: 20px;
        }

        .generate-report button {
            padding: 12px 25px;
            background-color: #232F3E;
            color: white;
            font-size: 16px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .generate-report button:hover {
            background-color: #45a049;
        }

        /* Footer */
        .footer {
            background-color: #232F3E;
            color: white;
            text-align: center;
            padding: 20px;
        }

        .footer p {
            margin: 0;
        }

        .footer a {
            color: #4CAF50;
            font-weight: bold;
            text-decoration: none;
        }
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
    <!-- Job Listings Section -->
    <?php include 'views/jobs.php';?> 
    <!-- Application Status Section -->
     <!-- <section id="yourapplications">
    <div class="application-status">
        <h2>Your Job Applications</h2>
        <table class="status-table">
            <thead>
                <tr>
                    <th>Job Title</th>
                    <th>Company</th>
                    <th>Status-</th>
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
     </section> -->

    <!-- Generate Report Section -->
    <div class="generate-report">
        <a href="index.php?rt=report/generateApplicationsReport&id=<?php echo $_SESSION['jobseeker_id']; ?>"><button>Export Application Report Excel</button></a>
        <a href="index.php?rt=report/generateApplicationsReportXML&id=<?php echo $_SESSION['jobseeker_id']; ?>"><button>Export Application Report XML</button></a>
    </div>

    <!-- Footer -->
    <div class="footer">
        <p>&copy; 2025 Jobseeker Portal. All rights reserved.</p>
        <p><a href="index.php?rt=index/terms" target="_blank">Privacy Policy</a> | <a href="index.php?rt=index/terms" target="_blank">Terms & Conditions</a></p>
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
