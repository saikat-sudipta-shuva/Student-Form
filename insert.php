<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "student_db";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

if ($_SERVER["REQUEST_METHOD"] == "POST") { 
      
    $name = $_POST['name'];
    $email = $_POST['email'];
    $department = $_POST['department'];
    $supervisor = $_POST['supervisor'];

    $sql = "INSERT INTO student (name, email, department, supervisor) VALUES ('$name', '$email', '$department', '$supervisor')";
      
    if ($conn->query($sql) === TRUE) {
        header("Location: index.html");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>
