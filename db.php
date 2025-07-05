<?php
$conn = new mysqli("localhost", "root", "", "collegeclub");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>