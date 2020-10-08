<?php 
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "menunagisa07";


// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: <br>" . $conn->connect_error);
}

//echo "Connected successfully to the database <b> MenuNagisa</b> <br>";

mysqli_query($conn, "SET NAMES 'UTF8'") or die("ERROR: ". mysqli_error($con));

?>