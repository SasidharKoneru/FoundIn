<!-- Edit Job Modal -->
 <style>
    /* Modal Styles */
.modal {
    display: block; /* Hidden by default */
    position: fixed;
    z-index: 1;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    overflow: auto;
    background-color: rgba(0, 0, 0, 0.4); /* Black with opacity */
}

.modal-content {
    background-color: #fff;
    margin: 5% auto;
    padding: 20px;
    border: 1px solid #888;
    width: 80%;
    max-width: 600px;
    border-radius: 10px;
}

.close {
    color: #aaa;
    float: right;
    font-size: 28px;
    font-weight: bold;
}

.close:hover,
.close:focus {
    color: black;
    text-decoration: none;
    cursor: pointer;
}

form .form-group {
    margin-bottom: 1rem;
}

form label {
    display: block;
    margin-bottom: 0.5rem;
}

form input, form select, form textarea {
    width: 100%;
    padding: 0.5rem;
    border-radius: 4px;
    border: 1px solid #ddd;
}

form button {
    background-color: #4CAF50;
    color: white;
    padding: 10px 20px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
}

form button:hover {
    background-color: #45a049;
}

 </style>
<div id="editJobModal" class="modal">
    <div class="modal-content">
        <span class="close" onclick="closeModal()">&times;</span>
        <h2>Edit Job</h2>

        <!-- Edit Form -->
        <form action="index.php?rt=job/updateJob" method="POST">
            <div class="form-group">
                <label for="job_title">Job Title:</label>
                <input type="text" id="job_title" name="job_title" value="<?php echo $job['job_title']; ?>" required>
            </div>

            <div class="form-group">
                <label for="job_description">Job Description:</label>
                <textarea id="job_description" name="job_description" rows="4" required><?php echo $job['job_description']; ?></textarea>
            </div>

            <div class="form-group">
                <label for="salary_range">Salary Range:</label>
                <input type="text" id="salary_range" name="salary_range" value="<?php echo $job['salary_range']; ?>" required>
            </div>

            <div class="form-group">
                <label for="company_location">Company Location:</label>
                <input type="text" id="company_location" name="company_location" value="<?php echo $job['company_location']; ?>" required>
            </div>

            <div class="form-group">
                <label for="company_name">Company Name:</label>
                <input type="text" id="company_name" name="company_name" value="<?php echo $_SESSION['company_name']; ?>" required>
            </div>

            <div class="form-group">
                <label for="company_website">Company Website:</label>
                <input type="text" id="company_website" name="company_website" value="<?php echo $job['company_website']; ?>" required>
            </div>

            <div class="form-group">
                <label for="job_type">Job Type:</label>
                <select id="job_type" name="job_type" required>
                    <option value="Full-time" <?php echo ($job['job_type'] == 'Full-time' ? 'selected' : ''); ?>>Full-time</option>
                    <option value="Part-time" <?php echo ($job['job_type'] == 'Part-time' ? 'selected' : ''); ?>>Part-time</option>
                    <option value="Contract" <?php echo ($job['job_type'] == 'Contract' ? 'selected' : ''); ?>>Contract</option>
                </select>
            </div>

            <div class="form-group">
                <label for="job_category">Job Category:</label>
                <select id="job_category" name="job_category" required>
                    <option value="Engineering" <?php echo ($job['job_category'] == 'Engineering' ? 'selected' : ''); ?>>Engineering</option>
                    <option value="Marketing" <?php echo ($job['job_category'] == 'Marketing' ? 'selected' : ''); ?>>Marketing</option>
                    <option value="Design" <?php echo ($job['job_category'] == 'Design' ? 'selected' : ''); ?>>Design</option>
                    <option value="Sales" <?php echo ($job['job_category'] == 'Sales' ? 'selected' : ''); ?>>Sales</option>
                </select>
            </div>

            <div class="form-group">
                <label for="required_experience">Required Experience (years):</label>
                <input type="number" id="required_experience" name="required_experience" value="<?php echo $job['required_experience']; ?>" required>
            </div>

            <div class="form-group">
                <label for="education_level">Education Level:</label>
                <select id="education_level" name="education_level" required>
                    <option value="Bachelor's Degree" <?php echo ($job['education_level'] == "Bachelor's Degree" ? 'selected' : ''); ?>>Bachelor's Degree</option>
                    <option value="Master's Degree" <?php echo ($job['education_level'] == "Master's Degree" ? 'selected' : ''); ?>>Master's Degree</option>
                    <option value="PhD" <?php echo ($job['education_level'] == 'PhD' ? 'selected' : ''); ?>>PhD</option>
                </select>
            </div>

            <div class="form-group">
                <label for="expiration_date">Expiration Date:</label>
                <input type="date" id="expiration_date" name="expiration_date" value="<?php echo $job['expiration_date']; ?>" required>
            </div>

            <button type="submit">Update Job</button>
        </form>
    </div>
</div>

<!-- Link to trigger modal -->
<!-- <a href="javascript:void(0)" onclick="openModal()">Edit Job</a> -->
<script>
    // Function to open the modal
function openModal() {
    document.getElementById("editJobModal").style.display = "block";
}

// Function to close the modal
function closeModal() {
    document.getElementById("editJobModal").style.display = "none";
}

// Close the modal if the user clicks outside the modal content
window.onclick = function(event) {
    if (event.target == document.getElementById("editJobModal")) {
        closeModal();
    }
}

</script>
