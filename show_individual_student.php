<!-- show_individual_student.php -->
<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "student_db";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    if (isset($_GET['id'])) {
        $student_id = $_GET['id'];

        $sql = "SELECT * FROM student WHERE id = '$student_id'";
        $result = $conn->query($sql);

        if ($result === false) {
            trigger_error('Error: ' . $conn->error, E_USER_ERROR);
        }

        if ($result->num_rows > 0) {
            $student = $result->fetch_assoc();
            $name = $student['name'];
            $email = $student['email'];
            $department = $student['department'];
            $supervisor = $student['supervisor'];

            echo "
            <style>
                .student-details {
                    width: 50%;
                    margin: 0 auto;
                    border: 1px solid #ddd;
                    padding: 20px;
                    background-color: #f9f9f9;
                }

                .student-details h2 {
                    text-align: center;
                    color: #45a049;
                }

                .student-details p {
                    font-weight: bold;
                }

                .back-button {
                    text-align: center;
                    margin-top: 20px;
                }
            </style>
            ";

            echo "<div class='student-details'>";
            echo "<h2>Student Details</h2>";
            echo "<p><strong>Name:</strong> $name</p>";
            echo "<p><strong>Email:</strong> $email</p>";
            echo "<p><strong>Department:</strong> $department</p>";
            echo "<p><strong>Supervisor:</strong> $supervisor</p>";
            echo "</div>";

            echo "<div class='back-button'>";
            echo "<a href='display_students.php'>&larr; Back to List</a>";
            echo "</div>";
        } else {
            echo "Student not found.";
        }
    } else {
        echo "Invalid student ID.";
    }
}

$conn->close();
?>