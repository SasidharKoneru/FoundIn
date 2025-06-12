
<div class="job-listings">
    <h2>Available Job Listings</h2>
    <?php
    $jobs = $this->registry->jobController->getAllJobs();
    if (!empty($jobs)): ?>
            <ul>
                <?php foreach ($jobs as $job): ?>
                     <div class="job-card">
                        <h3><?php echo $job['job_title']; ?></h3>
                        <p>Location: <?php echo $job['company_location']; ?></p>
                        <p>Company: <?php echo $job['company_name']; ?></p>
                        <p>Salary: <?php echo $job['salary_range']; ?></p>
                        <p class="h">Deadline: <?php echo $job['expiration_date']; ?> </p>
                        <P>Job Description:</P>
                        <p><?php echo $job['job_description']; ?></p>
                        <p><?php echo $job['application_status']; ?></p>
                        <a href="index.php?rt=job/applyJob&job_id=<?php echo $job['job_id']; ?>" class="apply-btn">Apply Now</a>
                    </div>
                <?php endforeach; ?>
            </ul>
        <?php else: ?>
            <p>No new job posts available at the moment. Try checking the your applications below.</p>
        <?php endif; ?>
    </div>