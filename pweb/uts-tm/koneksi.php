<?php
$servername = "localhost";
$username = "ariear";
$password = "12345";
$dbname = "serap_aspirasi";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
  die("<script>alert('Uppss, sepertinya sistem sedang bermasalah!!: " . $conn->connect_error . "');</script>");
}
