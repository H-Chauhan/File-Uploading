<?php
$servername = "mysql5005.smarterasp.net";
$username = "a12401_lr";
$password = "hs4336243362";
$dbname = "db_a12401_lr";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$subject_name = $_GET["subject_name"];

$sql = "SELECT * FROM result WHERE subject_name = \"".$subject_name."\";";
$result = $conn->query($sql);

$grades = array();

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $student_name = $row["student_name"];
        $marks = $row["marks"];
        $grade = array($student_name, $marks);
        array_push($grades, $grade);
    }
}

echo json_encode($grades);

$conn->close();
?>