<!-- /app/views/welcome.php -->
<?php 
    //session_start();  // Start session to store error messages
    if (isset($_SESSION['error'])) {
        $error_message = $_SESSION['error'];
        unset($_SESSION['error']);  // Clear error message after displaying
    } else {
        $error_message = '';
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to Job Portal</title>
    <!-- Bootstrap 3 CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <style>
        /* Custom styles for the welcome page */
        * {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    }

/* body,html {
    font-family: Arial, sans-serif;
    background-color: #f4f7fa;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
} */

body, html {
            height: 100vh;
            /* margin: 0; */
            display: flex;
            justify-content: center;
            align-items: center;
            background-color: #f4f7fa;
        }
        .welcome-container {
            background-color: #fff;
            text-align: center;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            max-width: 400px;
            /* margin: 0 auto; */
        }

        .btn-custom {
            padding: 12px 30px;
            font-size: 1rem;
            color: #fff;
            border-radius: 5px;
            text-decoration: none;
            margin: 10px;
            transition: background-color 0.3s ease;
        }

        .btn-recruiter {
            background-color: #28a745;
        }

        .btn-recruiter:hover {
            background-color: #218838;
        }

        .btn-jobseeker {
            background-color: #17a2b8;
        }

        .btn-jobseeker:hover {
            background-color: #138496;
        }

        .btn-register {
            background-color: #ff6347;
        }

        .btn-register:hover {
            background-color: #e03d26;
        }

        /* Error message styles */
        .error-message {
            color: red;
            margin-top: 10px;
        }

    </style>
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-md-offset-3 welcome-container">
                <h1>Welcome to the Job Portal</h1>
                <p>Your gateway to finding the best job opportunities and connecting with top talent.</p>

                <?php if (!empty($error_message)): ?>
                    <div class="alert alert-danger error-message">
                        <?php echo $error_message; ?>
                    </div>
                <?php endif; ?>

                <div class="button-container">
                    <a href="index.php?rt=login/recruiter" class="btn btn-recruiter btn-custom">Login as Recruiter</a>
                    <a href="index.php?rt=login/jobseeker" class="btn btn-jobseeker btn-custom">Login as Job Seeker</a>
                </div>

                <div class="register-container">
                    <p>New to the portal? Register Now!</p>
                    <a href="index.php?rt=register/recruiter" class="btn btn-recruiter btn-custom">Register as Recruiter</a>
                    <a href="index.php?rt=register/jobseeker" class="btn btn-jobseeker btn-custom">Register as Job Seeker</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap 3 JS (Optional, for Bootstrap components like modals) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</body>
</html>
