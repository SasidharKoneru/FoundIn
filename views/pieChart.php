<?php
// Database connection and query to get job title counts using PDO
$servername = "localhost";
$username = "root";
$password = "junnu123";
$dbname = "job_portal"; // Replace with your actual database name

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    $sql = "SELECT job_title, COUNT(*) as job_count FROM job_posts WHERE recruiter_id = '1' GROUP BY job_title";
    $stmt = $conn->prepare($sql);
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
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.amcharts.com/lib/4/core.js"></script>
    <script src="https://cdn.amcharts.com/lib/4/charts.js"></script>
    <script src="https://cdn.amcharts.com/lib/4/themes/animated.js"></script>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <style>
        #jobTitleChart, #pillarChart{
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
<main>
<section id="charts">
        <div>
            <h1>Job Titles Count - Pie Chart</h1>
            <h4>Total Jobs <?php echo " ".$count; ?></h4>
            <div id="jobTitleChart"></div>
        </div>
        <div>
            <h2>Job Titles Count - Pillar Chart</h2>
            <h4>Total Jobs <?php echo " ".$count; ?></h4>
            <div id="pillarChart"></div>
        </div>
    </section>
</main>

<script>
    // Pie Chart (Job Titles Count - Pie Chart)
    am4core.ready(function() {
        // Themes
        am4core.useTheme(am4themes_animated);

        var chart = am4core.create("jobTitleChart", am4charts.PieChart);
        
        // Set data
        chart.data = <?php echo json_encode(array_map(function($title, $count) {
            return ['category' => $title, 'value' => $count];
        }, $labels, $data)); ?>;

        // Add labels and tooltips
        chart.innerRadius = am4core.percent(40);
        var series = chart.series.push(new am4charts.PieSeries());
        series.dataFields.value = "value";
        series.dataFields.category = "category";

        series.slices.template.tooltipText = "{category}: {value} posts";
        
        // Random colors for each slice
        series.slices.template.fill = am4core.color("#fff");
        series.slices.template.propertyFields.fill = "fillColor";
        
        // Add random color for each slice
        chart.data.forEach(function(item, index) {
            item.fillColor = am4core.color("rgba(" + [Math.floor(Math.random() * 256), Math.floor(Math.random() * 256), Math.floor(Math.random() * 256)].join(",") + ", 0.7)");
        });
    });

    // Pillar Chart (Job Titles Count - Bar Chart)
    am4core.ready(function() {
        // Themes
        am4core.useTheme(am4themes_animated);

        var chart = am4core.create("pillarChart", am4charts.XYChart);

        // Set data
        chart.data = <?php echo json_encode(array_map(function($title, $count) {
            return ['category' => $title, 'value' => $count];
        }, $labels, $data)); ?>;

        // Create axes
        var categoryAxis = chart.xAxes.push(new am4charts.CategoryAxis());
        categoryAxis.dataFields.category = "category";
        categoryAxis.title.text = "Job Title";

        var valueAxis = chart.yAxes.push(new am4charts.ValueAxis());
        valueAxis.title.text = "Job Count";

        // Create series
        var series = chart.series.push(new am4charts.ColumnSeries());
        series.dataFields.valueY = "value";
        series.dataFields.categoryX = "category";
        series.name = "Job Count";

        // Add tooltips
        series.tooltipText = "{categoryX}: {valueY} posts";

        // Random colors for each column
        series.columns.template.fill = am4core.color("#fff");
        series.columns.template.propertyFields.fill = "fillColor";
        
        chart.data.forEach(function(item, index) {
            item.fillColor = am4core.color("rgba(" + [Math.floor(Math.random() * 256), Math.floor(Math.random() * 256), Math.floor(Math.random() * 256)].join(",") + ", 0.8)");
        });

        chart.cursor = new am4charts.XYCursor();
    });
</script>

</body>
</html>
