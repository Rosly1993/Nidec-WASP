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

    
        $query=mysqli_query($conn, "SELECT * FROM tbl_graph  where status='0' "); 
        while($row=mysqli_fetch_array($query)){ 

        $over_all=  $row['over_all'];
                        
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
        $body .= "<html><body><p>Hello, please find the attached file.</p></body></html>\r\n";

        // Attachment
        $file = "./graph_photos/$over_all";
        if (file_exists($file)) {
            $fileName = basename($file);
            $fileSize = filesize($file);
            $handle = fopen($file, "r");
            $content = fread($handle, $fileSize);
            fclose($handle);
            $encodedContent = chunk_split(base64_encode($content));

            $body .= "--{$boundary}\r\n";
            $body .= "Content-Type: image/jpeg; name=\"{$fileName}\"\r\n";
            $body .= "Content-Description: {$fileName}\r\n";
            $body .= "Content-Disposition: attachment; filename=\"{$fileName}\"; size={$fileSize};\r\n";
            $body .= "Content-Transfer-Encoding: base64\r\n\r\n";
            $body .= $encodedContent."\r\n";
        }

        $body .= "--{$boundary}--";

        // MAIL SENDING
        if(mail($to, $subject, $body, $headers)) {
            $update = $conn->query("UPDATE `tbl_graph` SET `status` = '1' WHERE status='0'");
            // include_once('sent_mail.php');
            echo 'Email has been sent with attachment.';
           
        } else{
            echo 'Email sending failed.';
        }
        ?>