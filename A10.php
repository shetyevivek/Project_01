<!DOCTYPE html>
<html>
<head>
	<title>Answer 10</title>
</head>
<body>
  <div>
    <h2>Student ID : 1001821620<br>Name : Vivek Vishwanath Shetye</h2><br><br><br>
  </div>
</body>
</html>

<?php
include_once 'connection.php';

$classify = $_POST['classify'];

// Retrieve the data
$sql = "SELECT pics.Photo, priceclass.Name, priceclass.Price, description.Description, priceclass.Classify FROM priceclass LEFT JOIN description ON priceclass.Name=description.Name LEFT JOIN pics ON priceclass.Name=pics.Name WHERE priceclass.Classify='$classify'";

$result = mysqli_query($con, $sql) or die('Error ' . mysqli_error($con));

while ($row = mysqli_fetch_array($result))
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