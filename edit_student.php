<!-- edit_student.php -->
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
                .edit-form {
                    width: 50%;
                    margin: 0 auto;
                    border: 1px solid #ddd;
                    padding: 20px;
                    background-color: #f9f9f9;
                }

                .edit-form h2 {
                    text-align: center;
                    color: #000;
                }

                .edit-form input[type='text'],
                .edit-form select {
                    width: 100%;
                    padding: 8px;
                    margin-bottom: 10px;
                    box-sizing: border-box;
                }

                .edit-form button {
                    background-color: #4CAF50;
                    color: white;
                    padding: 10px 15px;
                    border: none;
                    cursor: pointer;
                    display: block;
                    margin: 0 auto; /* Center the button horizontally */
                    text-align: center;
                }
            </style>
            ";

            echo "<div class='edit-form'>";
            echo "<h2>Edit Student</h2>";
            echo "<form method='POST' action='update_student.php'>";
            echo "<input type='hidden' name='id' value='$student_id'>";
            echo "<label for='name'>Name:</label>";
            echo "<input type='text' name='name' value='$name'>";
            echo "<label for='email'>Email:</label>";
            echo "<input type='text' name='email' value='$email'>";
            echo "<label for='department'>Department:</label>";
            echo "<select name='department'>";
            echo "<option value='CSE' " . ($department == 'CSE' ? 'selected' : '') . ">CSE</option>";
            echo "<option value='GEB' " . ($department == 'GEB' ? 'selected' : '') . ">GEB</option>";
            echo "<option value='English' " . ($department == 'English' ? 'selected' : '') . ">English</option>";
            echo "<option value='History' " . ($department == 'History' ? 'selected' : '') . ">History</option>";
            echo "<option value='BBA' " . ($department == 'BBA' ? 'selected' : '') . ">BBA</option>";
            echo "<option value='EEE' " . ($department == 'EEE' ? 'selected' : '') . ">EEE</option>";
            echo "</select>";
            echo "<label for='supervisor'>Supervisor:</label>";
            echo "<select name='supervisor'>";
            echo "<option value='Dr. Fernaz Narin Nur' " . ($supervisor == 'Dr. Fernaz Narin Nur' ? 'selected' : '') . ">Dr. Fernaz Narin Nur</option>";
            echo "<option value='Prof. DMRH' " . ($supervisor == 'Prof. DMRH' ? 'selected' : '') . ">Prof. DMRH</option>";
            echo "<option value='Dr. Azad' " . ($supervisor == 'Dr. Azad' ? 'selected' : '') . ">Dr. Azad</option>";
            echo "<option value='Prof. Yousuf Ali' " . ($supervisor == 'Prof. Yousuf Ali' ? 'selected' : '') . ">Prof. Yousuf Ali</option>";
            echo "<option value='Dr. NKS' " . ($supervisor == 'Dr. NKS' ? 'selected' : '') . ">Dr. NKS</option>";
            echo "</select>";
            echo "<button type='submit'>Update</button>";
            echo "</form>";
            echo "</div>";
        } else {
            echo "Student not found.";
        }
    }
}

$conn->close();
?>