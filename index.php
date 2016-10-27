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

$sql = "TRUNCATE TABLE subject";
$result = $conn->query($sql);
$sql = "TRUNCATE TABLE student";
$result = $conn->query($sql);
$sql = "TRUNCATE TABLE result";
$result = $conn->query($sql);
?>
    <!DOCTYPE html>
    <html>

    <head>
        <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">
        <link href="css/fileinput.min.css" media="all" rel="stylesheet" type="text/css" /> </head>

    <body>
        <div class="container">
            <h1>Select CSV File</h1>
            <div class="col-md-6">
                <form id="myForm" enctype="multipart/form-data" action="charts.php">
                    <label class="control-label">Select File</label>
                    <input name="csvfile" id="input-1a" type="file" class="file" data-allowed-file-extensions='["csv"]' data-upload-url="upload.php">
                    <br>
                    <input type="submit" name="submit" value="View Charts" class="btn btn-default"> </form>
            </div>
        </div>
        <script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
        <!-- canvas-to-blob.min.js is only needed if you wish to resize images before upload.
     This must be loaded before fileinput.min.js -->
        <script src="js/plugins/canvas-to-blob.min.js" type="text/javascript"></script>
        <!-- sortable.min.js is only needed if you wish to sort / rearrange files in initial preview.
     This must be loaded before fileinput.min.js -->
        <script src="js/plugins/sortable.min.js" type="text/javascript"></script>
        <!-- purify.min.js is only needed if you wish to purify HTML content in your preview for HTML files.
     This must be loaded before fileinput.min.js -->
        <script src="js/plugins/purify.min.js" type="text/javascript"></script>
        <!-- the main fileinput plugin file -->
        <script src="js/fileinput.min.js"></script>
        <!-- bootstrap.js below is needed if you wish to zoom and view file content 
     in a larger detailed modal dialog -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" type="text/javascript"></script>
    </body>

    </html>