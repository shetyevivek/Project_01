<!DOCTYPE html>
<html>
<head>
	<title>Answer 12</title>
</head>
<body>
  <div>
    <h2>Student ID : 1001821620<br>Name : Vivek Vishwanath Shetye</h2><br><br><br>
  </div>
</body>
</html>

<?php
include_once 'connection.php';

$name = $_POST['name'];
$descrip = $_POST['descrip'];

// Retrieve the data
$sql = "UPDATE description SET Description = '$descrip' WHERE Name = '$name'";
$result = mysqli_query($con, $sql) or die('Error ' . mysqli_error($con));

if(mysqli_affected_rows($con) > 0)
{
    echo "Description of " .$name. " has been successfully updated to \"" .$descrip. "\"";
    echo "<br><br><br>";
}

$sql2 = "SELECT pics.Photo, pics.Name, priceclass.Price, description.Description, priceclass.Classify FROM pics LEFT JOIN description ON pics.Name=description.Name LEFT JOIN priceclass ON pics.Name=priceclass.Name WHERE pics.Name='$name'";

$result2 = mysqli_query($con, $sql2) or die('Error ' . mysqli_error($con));

while ($row = mysqli_fetch_array($result2))
{
    echo '<img src="data:image/jpeg;base64,'.base64_encode($row['Photo']).'" width="300px"; height="300px"; />';
    echo '<br>';
    echo "Name: " .$row['Name'];
    echo '<br>';
    echo "Price: $" .$row['Price'];
    echo '<br>';
    echo "Description: " .$row['Description'];
    echo '<br>';
    echo "Category: " .$row['Classify'];
    echo '<br><br><br><br>';
}

?>