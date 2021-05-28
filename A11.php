<!DOCTYPE html>
<html>
<head>
  <title>Point Chart</title>
</head>
<body>
  <div>
    <h2>Student ID : 1001821620<br>Name : Vivek Vishwanath Shetye</h2><br><br><br>
  </div>
  </div>
</body>
</html>

<?php
include_once 'connection.php';

// Input data
$year1 = $_POST['year1'];
$year2 = $_POST['year2'];
$stateco = $_POST['stateco'];

$dataPoints = array();

$sql = "SELECT year, totalvotes FROM ptelect WHERE year BETWEEN $year1 AND $year2 AND state_po='$stateco' GROUP BY year";
$result = mysqli_query($con, $sql) or die('Error ' . mysqli_error($con));

$count = 0;

while($row = mysqli_fetch_array($result))
{
    $dataPoints[$count]["label"] = $row['year'];
    $dataPoints[$count]["y"] = $row['totalvotes'];

    $count++;
}

?>

<!DOCTYPE HTML>
<html>
<head>
<link rel="stylesheet" href="removeWatermark.css">
<script>
window.onload = function () {
 
var chart = new CanvasJS.Chart("chartContainer", {
    animationEnabled: true,
    exportEnabled: true,
    theme: "light1", 
    title:{
        text: "Presidential Elections"
    },
    axisX:{
        title: "Year"
    },
    axisY:{
        title: "Total Votes"
    },
    data: [{
        type: "scatter",
        markerType: "square",
        markerSize: 10,
        toolTipContent: "Year: {label}<br>Total Votes: {y}",
        dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
    }]
});
chart.render();
 
}
</script>
</head>
<body>
<div id="chartContainer" style="height: 100%; width: 100%;"></div>
<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
</body>
</html>