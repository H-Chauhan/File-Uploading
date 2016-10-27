<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "lr";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$student_name = $_GET["student_name"];

$sql = "SELECT * FROM result WHERE student_name = \"".$student_name."\";";
$result = $conn->query($sql);

$grades = array();

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $subject_name = $row["subject_name"];
        $marks = $row["marks"];
        $grade = array($subject_name, $marks);
        array_push($grades, $grade);
    }
}

echo json_encode($grades);

$conn->close();
?>