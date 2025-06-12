<?php
// Database connection and query to get job title counts using PDO
$servername = "localhost";
$username = "root";
$password = "junnu123";
$dbname = "job_portal"; // Replace with your actual database name

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    $sql = "SELECT job_title, COUNT(*) as job_count FROM job_posts WHERE recruiter_id = :recruiter_id GROUP BY job_title";
    $stmt = $conn->prepare($sql);
    $stmt->bindparam(':recruiter_id', $_SESSION['recruiter_id']);
    $stmt->execute();
    
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $query = "SELECT COUNT(*) as total_count FROM job_posts WHERE recruiter_id = :recruiter_id";  
    $stmt = $conn->prepare($query);
    $stmt->bindparam(':recruiter_id', $_SESSION['recruiter_id']);
    $stmt->execute();

    $count = $stmt->fetchColumn();
    
    $labels = [];
    $data = [];

    foreach ($results as $row) {
        $labels[] = $row['job_title'];
        $data[] = $row['job_count'];
    }
} catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}

$conn = null; // Close connection
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recruiter Dashboard</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <style>
        #jobTitleChart{
            max-width: 50vw;
            max-height: 50vh;
        }
        #pillarChart{
            max-width: 50vw;
            max-height: 50vh;
        }
        
        header{
            margin-top: 0px;
        }
        #charts {
            display: flex; 
            justify-content: space-between; 
            gap: 20px; 
            padding: 20px; 
            flex-wrap: wrap;
        }
        #charts > div {
            flex: 1; 
            min-width: 300px; 
            text-align: center; 
            padding: 10px;
            border: solid black 2px;
            border-radius: 5px;
        }
    </style>
</head>
<body>
<header>
    <nav>
        <ul>
            <li><a href="index.php?rt=index/admin" class="btn">Home</a></li>
            <li><a href="index.php?rt=index/postJob" class="btn">Post New Job</a></li>
            <li><a href="index.php?rt=index/viewPostedJobs" class="btn">View Posted Jobs</a></li>
            <li><a href="index.php?rt=index/trackApplications" class="btn">Track Applications</a></li>
            <li><a href="index.php?rt=index/charts" class="btn">Charts</a></li>
            <li><a href="index.php?rt=login/logout_recruiter" class="btn">Logout</a></li>
        </ul>
     </nav>
</header>
<main>
    
    <section id="charts">
        <div>
        <h1>Job Titles Count - Pie Chart</h1>
        <h4>Total Jobs <?php echo " ".$count; ?></h4>
        <canvas id="jobTitleChart"></canvas>
        </div>
        <div>
        <h2>Job Titles Count - Pillar Chart  </h2>
        <h4>Total Jobs <?php echo " ".$count; ?></h4>
        <canvas id="pillarChart"></canvas>
        </div>


    </section>
</main>

    <script>
        // Function to generate a random color in rgba format
        // function getRandomColor() {
        //     var r = Math.floor(Math.random() * 256);
        //     var g = Math.floor(Math.random() * 256);
        //     var b = Math.floor(Math.random() * 256);
        //     return 'rgba(' + r + ',' + g + ',' + b + ', 0.5)';
        // }

        var ctx = document.getElementById('jobTitleChart').getContext('2d');
        
        var jobTitleChart = new Chart(ctx, {
            type: 'pie',
            data: {
                labels: <?php echo json_encode($labels); ?>, // PHP array of job titles
                datasets: [{
                    label: 'Job Titles Count',
                    data: <?php echo json_encode($data); ?>, // PHP array of counts
                    backgroundColor:
                    <?php
                                // Generate unique random colors for each slice
                                $colors = [];
                                foreach ($labels as $label) {
                                    $r = rand(0, 255);
                                    $g = rand(0, 255);
                                    $b = rand(0, 255);
                                    $colors[] = "rgba($r, $g, $b, 0.7)"; // Adding transparency to color
                                }
                                echo json_encode($colors);
                    ?>,
                    borderColor: <?php
                                // Generate unique random colors for each slice
                                $bordercolors = [];
                                foreach ($labels as $label) {
                                    $r = rand(0, 255);
                                    $g = rand(0, 255);
                                    $b = rand(0, 255);
                                    $colors[] = "rgba($r, $g, $b, 0.7)"; // Adding transparency to color
                                }
                                echo json_encode($bordercolors);
                    ?>,
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top',
                    },
                    tooltip: {
                        callbacks: {
                            label: function(tooltipItem) {
                                return tooltipItem.label + ': ' + tooltipItem.raw + ' posts';
                            }
                        }
                    }
                }
            }
        });

        var ctx = document.getElementById('pillarChart').getContext('2d');

        var pillarChart = new Chart(ctx, {
        type: 'bar', // Define the chart type as bar (pillar chart is just a vertical bar chart)
        data: {
            labels: <?php echo json_encode($labels); ?>, // Labels from the PHP variable (job titles)
            datasets: [{
                label: 'Job Title Count', // Label for the dataset
                data: <?php echo json_encode($data); ?>,// Data from the PHP variable (job counts)
                backgroundColor: <?php
                        // Generate unique random colors for each slice
                        $colors = [];
                        foreach ($labels as $label) {
                            $r = rand(0, 255);
                            $g = rand(0, 255);
                            $b = rand(0, 255);
                            $colors[] = "rgba($r, $g, $b, 0.8)"; // Adding transparency to color
                        }
                        echo json_encode($colors);
                    ?>,
                    borderColor: <?php
                        // Generate unique border colors (darker version of the background color)
                        $borderColors = [];
                        foreach ($labels as $label) {
                            $r = rand(0, 255);
                            $g = rand(0, 255);
                            $b = rand(0, 255);
                            $borderColors[] = "rgba($r, $g, $b, 1)"; // Solid border color
                        }
                        echo json_encode($borderColors);
                    ?>,
                borderWidth: 1 // Border width
            }]
        },
        options: {
            responsive: true,
                plugins: {
                    legend: {
                        position: 'top',
                    }
                },
            scales: {
                y: {
                    beginAtZero: true // Ensure the Y-axis starts from 0
                }
            }
        }
    });
    </script>

</body>
</html>
