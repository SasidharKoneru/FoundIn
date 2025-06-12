function openModal(data) {
    document.getElementById("editJobModal").style.display = "block";
    prefillForm(data);
   
}
function prefillForm(data) {
    const editform = document.getElementById('editJobForm');

    // Fill in the form fields with data
    editform.querySelector("#job_title").value = data.job_title;
    console.log(data.job_title);
    editform.querySelector("#job_description").value = data.job_description;
    editform.querySelector("#salary_range").value = data.salary_range;
    editform.querySelector("#company_location").value = data.company_location;
    editform.querySelector("#company_name").value = data.company_name;
    editform.querySelector("#company_website").value = data.company_website;
    editform.querySelector("#job_type").value = data.job_type;
    editform.querySelector("#job_category").value = data.job_category;
    editform.querySelector("#required_experience").value = data.required_experience;
    editform.querySelector("#education_level").value = data.education_level;
    editform.querySelector("#expiration_date").value = data.expiration_date;
    // Update the form action URL to include the job_id
    editform.action = "index.php?rt=job/edit&job_id=" + data.job_id;

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

function confirmDelete(job_id, job_title) {
    // Display confirmation dialog
    console.log('confirm delete...');
    return confirm("Are you sure you want to delete Job Id: " + job_id + " Job Title: " + job_title+ "? This action cannot be undone.");
    
}