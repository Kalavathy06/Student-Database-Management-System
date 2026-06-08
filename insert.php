<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
if ($_SERVER["REQUEST_METHOD"] != "POST") {
    die("Please submit the form first.");
}
$conn = new mysqli('localhost', 'root', '', 'school_db');

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$name = $_POST['name'];
$age = $_POST['age'];
$email = $_POST['email'];
$course = $_POST['course'];

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    die("Invalid email format");
}

$sql = "INSERT INTO students (name, age, email, course)
        VALUES ('$name', '$age', '$email', '$course')";

if ($conn->query($sql) === TRUE) {
    echo "Record added successfully. <a href='display.php'>View Records</a>";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
