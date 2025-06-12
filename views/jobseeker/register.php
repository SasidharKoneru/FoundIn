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
    <title>Jobseeker Registration</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f4f4f9;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2 class="text-center">Jobseeker Registration Form</h2>
        <?php if (!empty($success_message)): ?>
            <span class="alert alert-success" role="alert"><?php echo $success_message; ?></span>
        <?php endif; ?>
        <?php if (!empty($error_message)): ?>
            <span class="alert alert-danger"><?php echo $error_message; ?></span>
        <?php endif; ?>
        <form action="index.php?rt=register/jobseeker_action" method="POST">
            <!-- Full Name -->
            <div class="form-group">
                <label for="full_name">Full Name:</label>
                <input type="text" id="full_name" name="full_name" class="form-control" required>
            </div>

            <!-- Email -->
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" class="form-control" required>
            </div>

            <!-- Password -->
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" name="password" id="password" class="form-control" required>
            </div>

            <!-- Phone Number -->
            <div class="form-group">
                <label for="phone_number">Phone Number:</label>
                <input type="tel" id="phone_number" name="phone_number" class="form-control" pattern="[0-9]{10}" 
                        placeholder="12345 67890" 
           title="Please enter a valid 10 digit phone number" required>
            </div>

            <!-- Date of Birth -->
            <div class="form-group">
                <label for="date_of_birth">Date of Birth:</label>
                <input type="date" id="date_of_birth" name="date_of_birth" class="form-control" required>
            </div>

            <!-- Gender -->
            <div class="form-group">
                <label>Gender:</label><br>
                <label class="radio-inline">
                    <input type="radio" name="gender" value="Male" required> Male
                </label>
                <label class="radio-inline">
                    <input type="radio" name="gender" value="Female" required> Female
                </label>
                <label class="radio-inline">
                    <input type="radio" name="gender" value="Other" required> Other
                </label>
            </div>

            <!-- Education -->
            <div class="form-group">
                <label for="education">Education:</label>
                <select id="education" name="education" class="form-control" required>
                    <option value="" disabled selected>Select Education Level</option>
                    <option value="High School">High School</option>
                    <option value="Diploma">Diploma</option>
                    <option value="Bachelor's Degree">Bachelor's Degree</option>
                    <option value="Master's Degree">Master's Degree</option>
                </select>
            </div>

            <!-- Skills -->
            <div class="form-group">
                <label for="skills">Skills:</label>
                <textarea id="skills" name="skills" class="form-control" rows="4" placeholder="List your skills (comma-separated)" required></textarea>
            </div>
            <div class="form-group">
            <label for="termsCheckbox">
      <input type="checkbox" id="termsCheckbox" name="terms" required>
      I agree to the <a href="index.php?rt=index/terms" target="_blank">Terms and Conditions</a>.
    </label>
            </div>

            <!-- Submit Button -->
            <button type="submit" class="btn btn-success btn-block">Register</button>
            <p>Already have an account? <a href="index.php?rt=login/jobseeker">Login as Jobseeker</a></p>
        </form>
    </div>

    <!-- Bootstrap JS (Optional for functionality such as modal, dropdown, etc.) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</body>
</html>
