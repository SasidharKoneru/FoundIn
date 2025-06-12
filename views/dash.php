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
        <style>
            
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
        <section>
            <div class="dashboard-container">
                <h1>Welcome, Recruiter</h1>
                <h3>We're thrilled to have you on board. As a recruiter, you can easily post jobs, manage listings, and track job applications all in one place.</h3>
                <?php 
                    include 'views/pieChart.php';
                ?>
            </div>
        </section>

</main>
    </body>
</html>