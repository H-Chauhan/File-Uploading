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

$sql = "SELECT * FROM subject";
$result = $conn->query($sql);

$subjects = array();

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $name = $row["name"];
        $max_marks = $row["max_marks"];
        $subject = array($name, $max_marks);
        array_push($subjects, $subject);
    }
} else {
    echo "0 subjects";
}

$sql = "SELECT * FROM student";
$result = $conn->query($sql);

$students = array();

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $name = $row["name"];
        array_push($students, $name);
    }
} else {
    echo "0 students";
}
$conn->close();
?>
    <!DOCTYPE html>
    <html>

    <head>
        <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">
        <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet"> </head>

    <body>
        <div class="container">
            <h1>Results</h1>
            <div class="row">
                <div class="col-sm-4">
                    <h4><i class="fa fa-bars"></i> Choices</h4>
                    <div class="panel-group" role="tablist">
                        <div class="panel panel-default">
                            <div class="panel-heading" role="tab" id="collapseListGroupHeading1">
                                <h4 class="panel-title"> <a href="#collapseListGroup1" class="collapsed" role="button" data-toggle="collapse" aria-expanded="false" aria-controls="collapseListGroup1"> <i class="fa fa-filter"></i> Student Wise </a> </h4> </div>
                            <div class="panel-collapse collapse" role="tabpanel" id="collapseListGroup1" aria-labelledby="collapseListGroupHeading1" aria-expanded="false" style="height: 0px;">
                                <ul class="list-group">
                                    <?php 
                                        for($i = 0; $i < sizeof($students); $i++) {
                                            echo "<li class='list-group-item student-wise'>$students[$i]</li>";
                                        }
                                    ?>
                                </ul>
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading" role="tab" id="collapseListGroupHeading2">
                                <h4 class="panel-title"> <a href="#collapseListGroup2" class="collapsed" role="button" data-toggle="collapse" aria-expanded="false" aria-controls="collapseListGroup2"> <i class="fa fa-filter"></i> Subject Wise  </a> </h4> </div>
                            <div class="panel-collapse collapse" role="tabpanel" id="collapseListGroup2" aria-labelledby="collapseListGroupHeading2" aria-expanded="false" style="height: 0px;">
                                <ul class="list-group">
                                    <?php 
                                        for($i = 0; $i < sizeof($subjects); $i++) {
                                            $subname = $subjects[$i][0];
                                            echo "<li class='list-group-item subject-wise'>$subname</li>";
                                        }
                                    ?>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-8">
                    <div id="chart_div"></div>
                </div>
            </div>
        </div>
        <script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
        <!-- bootstrap.js below is needed if you wish to zoom and view file content 
 in a larger detailed modal dialog -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" type="text/javascript"></script>
        <!--Load the AJAX API-->
        <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
        <script type="text/javascript" src="drawchart.js"></script>
    </body>

    </html>