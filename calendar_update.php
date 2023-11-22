<?php

/*
This is just a part of the code. The aim of this code is to describe (also qualitatively) how the update process is achieved. 
Author: Ermanno Lo Cascio 
08.2023


*/


use function PHPSTORM_META\type;

// Include database procedural 
include_once '../config/database_procedural.php';


if(isset($_POST['user_id']) && isset($_POST['vetrina']) && isset($_POST['bookshopId']) && isset($_POST['startDay']) && isset($_POST['startMonth']) 
&& isset($_POST['startYear']) && isset($_POST['endDay']) && isset($_POST['endMonth']) && isset($_POST['endYear']) && isset($_POST['sector']) && isset($_POST['RadioSelection']) ){
    
    $vetrina_id = $_POST['vetrina']; 
    $session_id = $_POST['user_id'];
    $bookshopId = $_POST['bookshopId'];
    $startDay = $_POST['startDay'];
    $startMonth = $_POST['startMonth'];
    $startYear = $_POST['startYear'];
    $endDay = $_POST['endDay'];
    $endMonth = $_POST['endMonth'];
    $endYear = $_POST['endYear'];
    $sector = $_POST['sector'];
    $selection = $_POST['RadioSelection'];
    


// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

// Sanitize to prevent SQL injection   
$session_id=mysqli_real_escape_string($conn, $session_id);
$vetrina_id=mysqli_real_escape_string($conn, $vetrina_id);
$bookshopId=mysqli_real_escape_string($conn, $bookshopId);

$startDay=mysqli_real_escape_string($conn, $startDay);
$startMonth=mysqli_real_escape_string($conn, $startMonth);
$startYear=mysqli_real_escape_string($conn, $startYear);

$endDay=mysqli_real_escape_string($conn, $endDay);
$endMonth=mysqli_real_escape_string($conn, $endMonth);
$endYear=mysqli_real_escape_string($conn, $endYear);
$sector=mysqli_real_escape_string($conn, $sector);


$startDay=mysqli_real_escape_string($conn, $startDay);
$endDay=mysqli_real_escape_string($conn, $endDay);

// NB name of the table deleted by purpose 
$sql = "SELECT * FROM XXXXX WHERE   
bookshop_id = '$bookshopId' 
AND vetrina_id = '$vetrina_id' 
AND booking_start_year = '$startYear'
AND booking_start_month = '$startMonth'
AND expositor_name = '$sector'
AND booking_end_year = '$endYear'
AND booking_end_month = '$endMonth'";

$result = $conn->query($sql);

$dataset_main_whole = []; // Initialize an empty array

// Check if any row exists
if ($result->num_rows > 0) {
    // Rows exist, do something

    while ($row = $result->fetch_assoc()) {
        // Process each row here

    $expositor_name = $row['expositor_name'];
    $booking_start_day = $row['booking_start_day'];
    $booking_end_day = $row['booking_end_day'];
    $product_title = $row['product_title'];
    $rows_id = $row['id'];

    // Calculate the number of days between the start and end day (inclusive)
    $num_days = $booking_end_day - $booking_start_day + 1;


/* 
.
0. We check which is the user selected case (set as available or set as not available)
.
1. Then, the $dataset_main_whole associative array will contain the key and values pairs describing the name of the sector (first element) and the status of each slot for the selected time range.    
.

2. based on the selected case we loop though the array in order to check what is contained into each slot of the selected period. If there is at least 1 booking, the code will drop an error. 
.
.
3. If everything is empty and the update is possible then we generate a new associative array containing the updates requested for the period requested.  
.
.
4. The rows in the SQL table containing the booking information for the selected period are deleted.
.
.
5. A new row is added into the MySQL table. 
5bis. In case the request forsees setting a slot as 'available' while the previous and the next slot are 'not available' (split case) then multiple rows are inserted into the MySQL table. 
.
.
6. The feedback ofthe AJAX call is sent back to the main page and, if it was a successful update, the page is refreshed via JavaScript to update the table.
*/ 


