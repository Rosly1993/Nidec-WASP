<?php
ob_start(); // Start output buffering

$host = "localhost";
$username = "root";
$password = "";
$database = "db_dapwas"; 

$conn = new mysqli($host, $username, $password, $database);
if(!$conn)
{
    echo "Database connection failed. Error:".$conn->error;
}
else
{
    // echo "connected"; 

}

require_once('TCPDF/tcpdf.php');


   


      $query_control_no = mysqli_query($conn, "SELECT * from tbl_request where status='Level4 Approved' and file_name_column is null  ");
    //   $query_control_no = mysqli_query($conn, "SELECT * from tbl_sdtftest where stdf_number='SDTF-NCFL-2024-01-0003'  ");
    while ($row = mysqli_fetch_array($query_control_no)) {
        
        $control_number = $row['control_number'];
        $requested_by = $row['requested_by'];
        $date_add = $row['date_add'];
        $formatted_date = date("M d, Y", strtotime($date_add));
        $division = $row['division'];
        $area = $row['area'];
        $location = $row['location'];
        $purpose = $row['purpose'];
        $category = $row['category'];
        $date_ot = $row['date_ot'];
        $formatted_date_ot = date("M d, Y", strtotime($date_ot));
        $level1_approver = $row['level1_approver'];
        $level1_date = $row['level1_date'];
        $level2_approver = $row['level2_approver'];
        $level2_date = $row['level2_date'];
        $level3_approver = $row['level3_approver'];
        $level3_date = $row['level3_date'];
        
        
        
    }

    // $sdtf_number = 'SDTF-NCFL-2024-01-0006'; 

    // Convert the date to a DateTime object
    $dateObject = new DateTime();

    // Format the date as 'Ym'
    $formattedDate = $dateObject->format('MYmdHi');

    $orderQuery = "SELECT *,  ROUND(TIME_TO_SEC(TIMEDIFF(time_to, time_from)) / 3600, 2) AS hour_difference FROM tbl_request WHERE control_number = '$control_number'";

    $orderResult = mysqli_query($conn, $orderQuery) or die("database error:". mysqli_error($conn));
    $filterOrders = array();
    $rowNumber = 1;
    while( $order = mysqli_fetch_assoc($orderResult) ) {
        $filterOrders[] = $order;
    }

    if (count($filterOrders)) {
        // Create a new PDF document
        $pdf = new TCPDF('P', 'mm', 'A4', true, 'UTF-8', false); //Landscape View

        // $pdf = new TCPDF('P', 'mm', array(210/2, 297/2), true, 'UTF-8', false); // A4 page size divided by 2

        // $pdf->SetMargins(0, 0, 0); // Set all margins to zero
        $pdf->SetAutoPageBreak(true, 0); // Disable auto page break
        
        // $pdf = new TCPDF('P', 'mm', 'A4', true, 'UTF-8', false); Portrait View
        $pdf->setPrintHeader(false);
        $pdf->setPrintFooter(true); 
        // Set document information
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor('Rosly B. Rapada');
        $pdf->SetTitle('Nidec Work Authority System Portal');
        $pdf->SetCellPadding(5, 5, 5, 5);
        // Add a page
        $pdf->AddPage();

        // Set some content to display in the PDF
        $content  = '<html><head></head><body>';
        $content .= '<table>';
        $content .= '<tr style="border: none">';
        $content .= '<td style="border: none;font-size:12px;text-align: left"><img src="/var/www/html/Nidec-WASP/uploads/ncfl_logo.png" width="100px" style="border: none"></td>';
        $content .= '</tr>';
        $content .= '</table>';

        $content .= '<table>';
        $content .= '<tr style="border: none">';
        $content .= '<td style="border: none;font-size:12px;text-align: center"><b>Nidec Philippines Corporation</b></td>';
        $content .= '</tr>';
        $content .= '</table>';

        $content .= '<table>';
        $content .= '<tr style="border: none"><br>';
        $content .= '<td style="border: none;font-size:9px; width: 20%"><b>Date Filed:</b>&nbsp;&nbsp;</td><td style="border: none;font-size:9px; width: 80%">' . $formatted_date . '</td>';
        $content .= '</tr>';
        $content .= '<tr style="border: none">';
        $content .= '<td style="border: none;font-size:9px"><b>Division:</b>&nbsp;&nbsp;</td><td style="border: none;font-size:9px">' . $division . '</td>';
        $content .= '</tr>';
        $content .= '<tr style="border: none">';
        $content .= '<td style="border: none;font-size:9px"><b>Department:</b>&nbsp;&nbsp;</td><td style="border: none;font-size:9px">' . $area . '</td>';
        $content .= '</tr>';
        $content .= '<tr style="border: none">';
        $content .= '<td style="border: none;font-size:9px"><b>Section:</b>&nbsp;&nbsp;</td><td style="border: none;font-size:9px">' . $location . '</td>';
        $content .= '</tr>';
        $content .= '<tr style="border: none">';
        $content .= '<td style="border: none;font-size:9px"><b>Date Covered:</b>&nbsp;&nbsp;</td><td style="border: none;font-size:9px">' . $formatted_date_ot . '</td>';
        $content .= '</tr>';
        $content .= '<tr style="border: none">';
        $content .= '<td style="border: none;font-size:9px"><b>Category:</b>&nbsp;&nbsp;</td><td style="border: none;font-size:9px">' . $category . '</td>';
        $content .= '</tr>';
        $content .= '<tr style="border: none">';
        $content .= '<td style="border: none;font-size:9px"><b>Purpose:</b>&nbsp;&nbsp;</td><td style="border: none;font-size:9px">' . $purpose . '</td>';
        $content .= '</tr>';
        
        $content .= '</table><br><br>';


        
        $content .= '<table border="1"><tr style="font-size: 8px; text-align: center; background-color: #451952;color: white "><th>Count</th><th>Employee ID</th><th>Full Name</th><th>Date</th><th>Time From</th><th>Time TO</th><th>Number of OT Hours</th></tr>';

        foreach ($filterOrders as $order) {
        $content .= '<tr style="font-size: 8px; text-align: center;height: 50px">';
        $content .= '<td>' . $rowNumber . '</td>';
        $content .= '<td>' . strtoupper($order["id_number"]) . '</td>';
        $content .= '<td>' . strtoupper($order["fullname"]) . '</td>';
        $content .= '<td>' . strtoupper($order["date_ot"]) . '</td>';
        $content .= '<td>' . strtoupper($order["time_from"]) . '</td>';
        $content .= '<td>' . strtoupper($order["time_to"]) . '</td>';
        $content .= '<td>' . strtoupper($order["hour_difference"]) . '</td>';
            
        $content .= '</tr>';
        $rowNumber++;
        }

        $content .= '</table>';

        $content .= '<table>';
        $content .= '<tr style="border: none"><br>';
        $content .= '<td style="border: none;font-size:9px"><b>Prepared By:</b><br><b style="color: blue; text-align: center">OK</b><br><b style="text-align: center">' . strtoupper($requested_by) . '</b><br style="text-align: center">Staff<br style="text-align: center"> Date: ' . strtoupper($date_add) . '</td><td style="border: none;font-size:9px"><b>Recomending Approval:</b><br><b style="color: blue; text-align: center">OK</b><br><b style="text-align: center">' . strtoupper($level1_approver) . '</b><br style="text-align: center">PIC<br style="text-align: center">Date: ' . strtoupper($level1_date) . '</td><td style="border: none;font-size:9px"><b>Approved By:</b><br><b style="color: blue; text-align: center">OK</b><br style="text-align: center"> <b>' . strtoupper($level2_approver) . '</b><br style="text-align: center">Department Manager<br style="text-align: center">Date: ' . strtoupper($level2_date) . '</td><td style="border: none;font-size:9px"><b>Approved By:</b><br><b style="color: blue; text-align: center">OK</b><br style="text-align: center"> <b>' . strtoupper($level3_approver) . '</b><br style="text-align: center">Department Manager<br style="text-align: center">Date: ' . strtoupper($level3_date) . '</td>';
        $content .= '</tr>';
       
        $content .= '</table>';

        $content .= '<footer><br><br><br><br>';
     
        $content .= '<tr style="border: none">';
        $content .= '<td style="border: none;font-size:7px;text-align: center" colspan="5">When printed, this document is uncontrolled unless properly identified as controlled. </td>';
        $content .= '</tr>';
        $content .= '<tr style="border: none">';
        $content .= '<td style="border: none;font-size:6px;text-align: center" colspan="5"><i>This form is system generated.</i> </td>';
        $content .= '</tr>';

        $content .= '</footer>';
        $content .= '</body></html>';

       

        // Output the HTML content as PDF
        $pdf->writeHTML($content, true, false, true, false, '');

        // Set the file name for download
        $fileName = $formattedDate . ".pdf";

        // Path to where the PDF will be saved locally  

        // $localFilePath = "/var/www/html/Nidec-WASP/uploads/" . $fileName; change this file path

        $localFilePath = "C:/xampp/htdocs/Nidec-WASP/uploads/" . $fileName; // to this
        

        // Save the PDF file locally
        $pdf->Output($localFilePath, 'F');

        // Check if the file is saved before reading its content
        if (file_exists($localFilePath)) {
        // Read the PDF content to store in the database
        $pdfContent = file_get_contents($localFilePath); 

        // $pdf->SetProtection(['print', 'copy'], '12345');
        // Save the PDF content to the database
        // Update the table with the file name
        $update1 = $conn->query("UPDATE `tbl_request` SET `file_name_column` = '$fileName' WHERE control_number='$control_number'");

        // if ($update1) {
            
            // Output the PDF file to the browser for download
            // header('Content-Description: File Transfer');
            // header('Content-Type: application/octet-stream');
            // header('Content-Disposition: attachment; filename=' . basename($fileName));
            // header('Expires: 0');
            // header('Cache-Control: must-revalidate');
            // header('Pragma: public');
            // header('Content-Length: ' . filesize($localFilePath));
            // readfile($localFilePath);

            // Stop further execution
        //     exit;
        // } else {
        //     echo "Failed to update database.";
        // }
        // } else {
        //     echo "Failed to save the PDF file.";
        // }
        }
    }

        // Clean the output buffer
        ob_end_clean();
        ?>
