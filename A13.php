<!DOCTYPE html>
<html>
<head>
	<title>Answer 13 - Bonus</title>
</head>
<body>
  <div>
    <h2>Student ID : 1001821620<br>Name : Vivek Vishwanath Shetye</h2><br><br><br>
  </div>
</body>
</html>

<?php
include_once 'connection.php';

$words = $_POST['words'];

// Retrieve the data
$sql = "SELECT pics.Photo, pics.Name, priceclass.Price, description.Description FROM pics, priceclass, description WHERE description.Description LIKE '%$words%' AND priceclass.Name = pics.Name AND priceclass.Name = description.Name";
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
    echo '<br><br><br><br>';
}

?>