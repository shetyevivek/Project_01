<!DOCTYPE html>
<html>
<head>
  <title>Pie Chart</title>
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
$year = $_POST['year'];
$stateco = $_POST['stateco'];

$dataPoints = array();

$sql = "SELECT * FROM ptelect WHERE year=$year AND state_po='$stateco' ORDER BY candidatevotes DESC LIMIT 6";
$result = mysqli_query($con, $sql) or die('Error ' . mysqli_error($con));

$count = 0;

while($row = mysqli_fetch_array($result))
{
  $v1 = $row['candidatevotes'];
	$v2 = $row['totalvotes'];
	$name = $row['candidate'];
  $party = $row['party_simplified'];
	$votes = ($v1/$v2)*100;

  $dataPoints[$count]["y"] = $votes;
  $dataPoints[$count]["label"] = $name;
  $dataPoints[$count]["party"] = $party;
  $count++;
}

?>

<!DOCTYPE HTML>
<html>
<head>
<link rel="stylesheet" href="removeWatermark.css">
<script>
window.onload = function() {
 
var chart = new CanvasJS.Chart("chartContainer", {
  animationEnabled: true,
  title: {
    text: "Presidential Elections"
  },
  data: [{
    type: "pie",
    yValueFormatString: "#,##0.00\"%\"",
    indexLabel: "({y})",
    indexLabelPlacement: "inside",
    indexLabelFontColor: "#000000",
    indexLabelFontSize: 10,
    indexLabelFontWeight: "bolder",
    showInLegend: true,
    legendText: "{party}",
    dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
  }]
});
chart.render();
 
}
</script>
</head>
<body>
<div id="chartContainer" style="height: 100%; width: 80%;"></div>
<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
</body>
</html>