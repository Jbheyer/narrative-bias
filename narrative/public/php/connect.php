<?php

$servername = "localhost";

$username = "oldamasc_vis";

$password = "visresearch@!UPU!";

$dbname = "oldamasc_narrative_bias";

// Create connection
$conn = mysqli_connect($servername, $username, $password,$dbname);

// Check connection
if (!$conn) {

    die("Connection failed: " . mysqli_connect_error());

}
?>
