<?php

$host = "10.216.128.71";
$username = "root";
$password = "Ncfldbuser21!";
$database = "db_wends"; 

$conn = new mysqli($host, $username, $password, $database);
if(!$conn)
{
    echo "Database connection failed. Error:".$conn->error;
}
else
{
    // echo "connected"; 
}

$date= date('Y-m-d_H-i-s');
$date_add= date('Y-m-d');



// Ensure this script is in the same directory as your HTML/JS, or adjust the path accordingly.
if (isset($_POST['imageData'])) {


    $encoded_image = explode(",", $_POST['imageData'])[1];
    $decoded_image = base64_decode($encoded_image);
    $imagePath = './graph_photos/chart_' . $date . '.jpeg';
    file_put_contents($imagePath, $decoded_image);
    // echo "Image saved successfully at: " . $imagePath;
    $attachment = "chart_$date.jpeg";
   
    $query = $conn->query("INSERT INTO `tbl_graph` (`over_all`,`status`,`date`) VALUE ('$attachment','0','$date_add')");
   
} else {
    echo "No image data received.";
}
?>
