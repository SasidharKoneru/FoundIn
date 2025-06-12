<!-- <h2> <?php echo "Welcome to Job Portal"; ?> </h2> -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Form</title>
    <!-- <link rel="stylesheet" href="style.css"> -->
     <style>
        /* Reset some default styling */
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

/* Set body styles */
body {
    font-family: Arial, sans-serif;
    background-color: #f4f4f9;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
}

/* Styling the login container */
.login-container {
    background-color: #fff;
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    width: 300px;
    text-align: center;
}

h2 {
    margin-bottom: 20px;
    color: #333;
}

/* Styling the input fields */
.input-container {
    margin-bottom: 15px;
    text-align: left;
}

.input-container label {
    display: block;
    font-size: 14px;
    color: #333;
    margin-bottom: 5px;
}

.input-container input {
    width: 100%;
    padding: 10px;
    font-size: 14px;
    border: 1px solid #ccc;
    border-radius: 5px;
    outline: none;
    transition: border-color 0.3s ease;
}

.input-container input:focus {
    border-color: #007BFF;
}

/* Styling the submit button */
.submit-btn {
    width: 100%;
    padding: 10px;
    background-color: #28a745;
    color: #fff;
    font-size: 16px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

.submit-btn:hover {
    background-color: #28a745;
}

/* Footer links */
.footer {
    margin-top: 15px;
    font-size: 12px;
}

.footer a {
    color: #007BFF;
    text-decoration: none;
}

.footer a:hover {
    text-decoration: underline;
}

     </style>
</head>
<body>
    <div class="login-container">
        <h2>Recruiter Login</h2>
        <form action="index.php?rt=login/recruiter_action" method="POST">
            <div class="input-container">
                <label for="username">Email:</label>
                <input type="text" id="email" name="email" required>
            </div>
            <div class="input-container">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>
            </div>
            <button type="submit" class="submit-btn">Login</button> 
            <div class="footer">
                <a href="#">Forgot Password?</a>
                <p>Don't have an account? <a href="#">Sign up</a></p>
            </div>
        </form>
    </div>
</body>
</html>