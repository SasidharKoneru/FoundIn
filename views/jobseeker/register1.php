<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jobseeker Registration</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }
        .container {
            width: 50%;
            margin: auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        h2 {
            text-align: center;
            margin-bottom: 20px;
        }
        label {
            display: block;
            margin: 10px 0 5px;
        }
        input, select, textarea {
            width: 100%;
            padding: 10px;
            margin: 5px 0 15px;
            border-radius: 4px;
            border: 1px solid #ccc;
        }
        button {
            width: 100%;
            padding: 10px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        button:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Jobseeker Registration Form</h2>
        <form action="index.php?rt=register/jobseeker_action" method="POST">
            <!-- Full Name -->
            <label for="full_name">Full Name:</label>
            <input type="text" id="full_name" name="full_name" required>

            <!-- Email -->
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>

            <!-- Password -->
            <label for="password">Password: </label>
            <input type="password" name="password" id="password" required>

            <!-- Phone Number -->
            <label for="phone_number">Phone Number:</label>
            <input type="tel" id="phone_number" name="phone_number" pattern="[0-9]{10}" placeholder="123-456-7890" required>

            <!-- Date of Birth -->
            <label for="date_of_birth">Date of Birth:</label>
            <input type="date" id="date_of_birth" name="date_of_birth" required>

            <!-- Gender -->
            <label for="gender">Gender:</label>
            <select id="gender" name="gender" required>
                <option value="" disabled selected>Select Gender</option>
                <option value="Male">Male</option>
                <option value="Female">Female</option>
                <option value="Other">Other</option>
            </select>

            <!-- Education -->
            <label for="education">Education:</label>
            <input type="text" id="education" name="education" placeholder="Enter your highest qualification" required>

            <!-- Skills -->
            <label for="skills">Skills:</label>
            <textarea id="skills" name="skills" rows="4" placeholder="List your skills (comma-separated)" required></textarea>

            <!-- Experience -->
            <!-- <label for="experience">Experience:</label>
            <textarea id="experience" name="experience" rows="4" placeholder="Describe your previous work experience. Mention Fresher if fresher." required></textarea> -->

            <!-- Submit Button -->
            <button type="submit">Register</button>
        </form>
    </div>
</body>
</html>
