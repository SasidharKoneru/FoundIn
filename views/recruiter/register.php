<?php 
    //session_start();  // Start session to store error messages
    if (isset($_SESSION['error'])) {
        $error_message = $_SESSION['error'];
        unset($_SESSION['error']);  // Clear error message after displaying
    } else {
        $error_message = '';
    }

    if (isset($_SESSION['success'])) {
        $success_message = $_SESSION['success'];
        unset($_SESSION['success']);
    } else {
        $success_message = '';
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recruiter Registration</title>
    <!-- Add Bootstrap 3 CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        /* Error message styles */
        .error-message {
            color: red;
            margin-top: 10px;
        }
        
        .success-message {
            color: green;
            margin-top: 10px;
        }
    </style>
</head>
<body>

<div class="container">
    <div class="col-md-6 col-md-offset-3">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h2 class="text-center">Register as Recruiter</h2>
            </div>
            <div class="panel-body">
                <form action="index.php?rt=register/recruiter_action" method="POST">
                    <div class="form-group">
                        <input type="text" name="company_name" class="form-control" placeholder="Company Name" required>
                    </div>
                    <div class="form-group">
                        <input type="email" name="email" class="form-control" placeholder="Email" required>
                    </div>
                    <div class="form-group">
                        <input type="password" name="password" class="form-control" placeholder="Password" required>
                    </div>
                    <?php if (!empty($error_message)): ?>
                        <span class="error-message"><?php echo $error_message; ?></span>
                    <?php endif; ?>
                    <?php if (!empty($success_message)): ?>
                        <span class="success-message"><?php echo $success_message; ?></span>
                    <?php endif; ?>
                    <button type="submit" class="btn btn-success btn-block">Register</button>
                </form>
            </div>
            <div class="panel-footer text-center">
                <p>Already have an account? <a href="index.php?rt=login/recruiter">Login as Recruiter</a></p>
            </div>
        </div>
    </div>
</div>

<!-- Add Bootstrap 3 JS and jQuery -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

</body>
</html>
