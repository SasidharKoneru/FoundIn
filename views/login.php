<!-- /app/views/welcome.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to Job Portal</title>
    <link rel="stylesheet" href="/job-portal/app/css/style.css">
    <style>
        /* /app/css/style.css */

/* Global styles */
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

body {
    font-family: Arial, sans-serif;
    background-color: #f4f7fa;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
}

/* Welcome page styling */
.welcome-container {
    background-color: #fff;
    text-align: center;
    padding: 40px;
    border-radius: 10px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    width: 400px;
}

h1 {
    font-size: 2.5rem;
    margin-bottom: 20px;
    color: #333;
}

p {
    font-size: 1rem;
    color: #666;
    margin-bottom: 30px;
}

.button-container {
    margin-bottom: 30px;
}

.btn {
    display: inline-block;
    padding: 12px 30px;
    font-size: 1rem;
    color: #fff;
    background-color: #007bff;
    border-radius: 5px;
    text-decoration: none;
    margin: 10px;
    transition: background-color 0.3s ease;
}

.btn:hover {
    background-color: #0056b3;
}

.recruiter-btn {
    background-color: #28a745;
}

.recruiter-btn:hover {
    background-color: #218838;
}

.jobseeker-btn {
    background-color: #17a2b8;
}

.jobseeker-btn:hover {
    background-color: #138496;
}

.register-container {
    margin-top: 20px;
}

.register-container p {
    font-size: 1rem;
    color: #444;
}

.register-container a {
    display: inline-block;
    margin: 10px;
    text-decoration: none;
    color: #fff;
    background-color: #ff6347;
    padding: 10px 25px;
    border-radius: 5px;
    transition: background-color 0.3s ease;
}

.register-container a:hover {
    background-color: #e03d26;
}

    </style>
</head>
<body>
<?php if(isset($_SESSION['user'])) {
//    header("Location: views/home.php");
//    exit();
}
?>
    <div class="welcome-container">
        <h1>Welcome to the Job Portal</h1>
        <p>Your gateway to finding the best job opportunities and connecting with top talent.</p>

        <div class="button-container">
            <a href="index.php?rt=login/recruiter" class="btn recruiter-btn">Login as Recruiter</a>
            <a href="index.php?rt=login/jobseeker" class="btn jobseeker-btn">Login as Job Seeker</a>
        </div>

        <div class="register-container">
            <p>New to the portal? Register Now!</p>
            <a href="index.php?rt=register/recruiter" class="btn recruiter-btn">Register as Recruiter</a>
            <a href="index.php?rt=register/jobseeker" class="btn jobseeker-btn">Register as Job Seeker</a>
        </div>
    </div>

</body>
</html>
