<?php

$servername = "localhost";

$username = "nirmal";

$password = "nirmal1989";

$dbname = "narrative_bias";

// Create connection
$conn = mysqli_connect($servername, $username, $password,$dbname);

// Check connection
if (!$conn) {

    die("Connection failed: " . mysqli_connect_error());

}
?>
