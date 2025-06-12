<!-- /app/views/register_recruiter.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recruiter Registration</title>
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

/* Register container styling */
.register-container {
    background-color: #fff;
    text-align: center;
    padding: 40px;
    border-radius: 10px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    width: 400px;
}

h2 {
    font-size: 2rem;
    color: #333;
    margin-bottom: 20px;
}

form {
    display: flex;
    flex-direction: column;
}

input {
    padding: 12px;
    margin: 10px 0;
    border: 1px solid #ddd;
    border-radius: 5px;
    font-size: 1rem;
}

input:focus {
    border-color: #007bff;
    outline: none;
}

button {
    padding: 12px 30px;
    font-size: 1rem;
    color: #fff;
    background-color: #28a745;
    border-radius: 5px;
    border: none;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

button:hover {
    background-color: #28a705;
}

p {
    font-size: 1rem;
    margin-top: 15px;
}

a {
    color: #007bff;
    text-decoration: none;
    font-weight: bold;
}

a:hover {
    text-decoration: underline;
}

/* Responsive design for smaller screens */
@media (max-width: 480px) {
    .register-container {
        width: 90%;
        padding: 20px;
    }

    h2 {
        font-size: 1.5rem;
    }

    input, button {
        font-size: 1rem;
    }
}

    </style>

</head>
<body>

<div class="register-container">
    <h2>Register as Recruiter</h2>
    <form action="index.php?rt=register/recruiter_action" method="POST">
        <input type="text" name="company_name" placeholder="Company Name" required>
        <input type="email" name="email" placeholder="Email" required>
        <input type="password" name="password" placeholder="Password" required>
        <button type="submit" class="btn recruiter-btn">Register</button>
    </form>
    <p>Already have an account? <a href="index.php?rt=login/recruiter">Login as Recruiter</a></p>
</div>

</body>
</html>
