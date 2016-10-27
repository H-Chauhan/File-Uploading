<?php
$target_dir = "uploads/";
$target_file = $target_dir . basename($_FILES["csvfile"]["name"]);
$uploadOk = 1;
$FileType = pathinfo($target_file,PATHINFO_EXTENSION);


// Check if file already exists
if (file_exists($target_file)) {
    $lastDot = strrpos($target_file, '.');
    $base = substr($target_file, 0, $lastDot);
    $ext = substr($target_file, $lastDot);
    $target_file = $base . time() . $ext;
    $uploadOk = 1;
}
// Check file size
if ($_FILES["csvfile"]["size"] > 500000) {
    echo '{Error:"Sorry, there was an error uploading your file."}';
    $uploadOk = 0;
}
// Allow certain file formats
if($FileType != "csv") {
    echo '{Error:"Sorry, there was an error uploading your file."}';
    $uploadOk = 0;
}
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
// if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["csvfile"]["tmp_name"], $target_file)) {
        echo '{"Success":"File uploaded successfully"}';
    } else {
        echo '{Error:"Sorry, there was an error uploading your file."}';
    }
}

//Reading CSV File and storing in database.
$file = fopen($target_file, 'r');
$firstline = true;

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "lr";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

$subjects = array();

while (($line = fgetcsv($file)) !== FALSE) {
    $i = 0;
    for($i = 0; $i < sizeof($line); $i++) {
        if($line[$i] !== "") break;
    }
    if($i < sizeof($line)) {
        if($firstline) {
            $firstline = false;
            $i++;
            for(; $i < sizeof($line); $i++) {
                $tilde = strpos($line[$i], "~");
                $name = substr($line[$i], 0, $tilde);
                $max_marks = substr($line[$i], $tilde + 1);
                $subject = array($name, $max_marks);
                array_push($subjects, $subject);
                $sql = "INSERT INTO subject (name, max_marks) VALUES (\"".$name."\", $max_marks)";
                $conn->query($sql);
            }    
        } else {
            $student_name = $line[$i];
            $i++;
            $j = 0;
            $sql = "INSERT INTO student (name) VALUES (\"".$student_name."\")";
            $conn->query($sql);
            for(; $i < sizeof($line); $i++) {
                $sub_name = $subjects[$j][0];
                $marks = $line[$i] * 100.0 / $subjects[$j][1];
                $j++;
                $sql = "INSERT INTO result (student_name, subject_name, marks) VALUES (\"".$student_name."\",\"".$sub_name."\",$marks)";
                $conn->query($sql);
            }  
        }
    }
}
fclose($file);

$conn->close();
?>