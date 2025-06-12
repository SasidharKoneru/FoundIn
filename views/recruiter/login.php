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
    <title>Login Form</title>
    <!-- Bootstrap 3 CSS -->
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
    </style>
</head>
<body>

    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h2 class="text-center">Recruiter Login</h2>
                    </div>
                    <div class="panel-body">
                        <form action="index.php?rt=login/recruiter_action" method="POST">
                            <div class="form-group">
                                <label for="email">Email:</label>
                                <input type="email" class="form-control" id="email" name="email" required>
                            </div>
                            <div class="form-group">
                                <label for="password">Password:</label>
                                <input type="password" class="form-control" id="password" name="password" required>
                            </div>
                            <?php if (!empty($error_message)): ?>
                                <span class="error-message"><?php echo $error_message; ?></span>
                            <?php endif; ?>
                            <button type="submit" class="btn btn-success btn-block">Login</button> 
                        </form>
                    </div>
                    <div class="panel-footer text-center">
                        <a href="#">Forgot Password?</a>
                        <p>Don't have an account? <a href="#">Sign up</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap 3 JS and dependencies -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</body>
</html>
