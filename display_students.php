<!-- display_students.php -->
<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "student_db";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the script is accessed via a GET request
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    // CSS Styling
    echo "
    <style>
        .student-table {
            width: 100%;
            border-collapse: collapse;
        }

        .student-table th,
        .student-table td {
            padding: 8px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        .student-table th {
            background-color: #000; 
            color: #fff;
        }

        .student-table tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        .student-table tr:hover {
            background-color: #e6e6e6;
        }
        .header-text {
            color: #45a049;
            text-align: center; 
        } 
        .back-button {
            text-align: center;
            margin-top: 20px; 
            color: #fff;
        }
        .back-button a{ 
            color: #45a049; 
        }
    </style>
    ";
    
    if (isset($_GET['delete_id'])) {
        $delete_id = $_GET['delete_id'];
        
        // Delete the student from the database
        $delete_sql = "DELETE FROM student WHERE id = '$delete_id'";
        if ($conn->query($delete_sql) === TRUE) {
            echo "Student deleted successfully.";
        } else {
            echo "Error deleting student: " . $conn->error;
        }
    }

    $sql = "SELECT id, name, department, email, supervisor FROM student";
    $result = $conn->query($sql);

    if ($result === false) {
        trigger_error('Error: ' . $conn->error, E_USER_ERROR);
    }

    echo "<h2 class='header-text'>All Students</h2>";

    if ($result->num_rows > 0) {
        echo "<table class='student-table'>";
        echo "<tr><th>Name</th><th>Email</th><th>Department</th><th>Supervisor</th><th>Action</th></tr>";
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>{$row["name"]}</td>";
            echo "<td>{$row["email"]}</td>";
            echo "<td>{$row["department"]}</td>";
            echo "<td>{$row["supervisor"]}</td>";
            echo "<td>
                    <a href='edit_student.php?id=".$row['id']."'>Edit</a> |
                    <a href='display_students.php?delete_id=".$row['id']."'>Delete</a> |
                    <a href='show_individual_student.php?id=".$row['id']."'>Show</a>
                </td>";

            echo "</tr>";
        }
        echo "</table>";
        echo "<div class='back-button'>";
        echo "<a href='index.html'>Add Student</a>";
        echo "</div>";
    } else {
        echo "0 results";
        echo "<div class='back-button'>";
        echo "<a href='index.html'>Add Student</a>";
        echo "</div>";
    }
}

$conn->close();
?>