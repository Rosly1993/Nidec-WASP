
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

$query = mysqli_query($conn, "SELECT * FROM tbl_graph WHERE status='0' "); 
while($row = mysqli_fetch_array($query)) { 
    $over_all = $row['over_all'];
}

// EMAIL SETUP
$to = 'rosly.rapada@nidec.com';
$subject = 'WENDS';

// Sender Info
$from = 'rosly.rapada@nidec.com';
$fromName = 'WENDS Form';

// Boundary 
$boundary = md5(time());

// Headers
$headers = "MIME-Version: 1.0\r\n";
$headers .= "From: {$fromName} <{$from}>\r\n";
$headers .= "Content-Type: multipart/mixed; boundary=\"{$boundary}\"\r\n";
$headers .= "X-Priority: 1 (Highest)\n";
$headers .= "X-MSMail-Priority: High\n";
$headers .= "Importance: High\n";

// Message Body
$body = "--{$boundary}\r\n";
$body .= "Content-Type: text/html; charset=iso-8859-1\r\n\r\n";
$body .= "<html><body><p>Hello, please find the chart below:</p>";
$body .= "<img src='data:image/jpeg;base64," . base64_encode(file_get_contents("./graph_photos/chart_2024-04-04_10-46-49.jpeg")) . "' alt='Chart Image' />";
$body .= "</body></html>\r\n";

$body .= "--{$boundary}--";

// MAIL SENDING
if(mail($to, $subject, $body, $headers)) {
    echo 'Email has been sent with embedded image.';
} else {
    echo 'Email sending failed.';
}
?>

