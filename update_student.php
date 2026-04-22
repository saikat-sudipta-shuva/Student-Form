<!-- update_student.php -->
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
    $student_id = $_POST['id'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $department = $_POST['department'];
    $supervisor = $_POST['supervisor'];

    $sql = "UPDATE student SET name='$name', email='$email', department='$department', supervisor='$supervisor' WHERE id='$student_id'";

    if ($conn->query($sql) === TRUE) {
        header("Location: display_students.php");
        exit();
    } else {
        echo "Error updating student: " . $conn->error;
    }
}

$conn->close();
?> 