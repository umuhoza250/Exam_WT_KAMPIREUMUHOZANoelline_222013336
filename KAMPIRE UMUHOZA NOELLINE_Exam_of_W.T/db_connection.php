<?php
// Connection details
$host = "localhost";
$user = "KAMPIRE";
$pass = "UMUHOZA$07.";
$database = "online_entrepreneurship_workshops_platform";

// Creating connection
$connection = new mysqli($host, $user, $pass, $database);

// Check connection
if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}
?>