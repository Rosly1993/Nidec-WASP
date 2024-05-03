
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

$today=date('M-d-Y');

// Get Posted Data from Modal
$id= $_POST['id'];
$userdata1= $_POST['userdata1'];
$level2_status= $_POST['level2_status'];

if($level2_status=='Accept'){

    $status = 'Accepted';

}else{

    $status = 'Rejected';

}

//get requestor
$query_requestor=mysqli_query($conn, "SELECT
tbl_main.id,
tbl_main.type,
tbl_main.level2_pic,
tbl_main.activity,
tbl_main.details,
tbl_main.impact_type,
tbl_main.before,
tbl_main.after,
tbl_main.target_date,
set_areas.area,
set_areas.location
FROM
tbl_main 

inner JOIN set_areas on tbl_main.area_id = set_areas.id

WHERE

tbl_main.id ='$id' ");

 while($rows=mysqli_fetch_array($query_requestor)){
$requestor=$rows['level2_pic'];
$type=$rows['type'];
$activity=$rows['activity'];
$details=$rows['details'];
$impact_type=$rows['impact_type'];
$before=$rows['before'];
$after=$rows['after'];
$target_date=$rows['target_date'];
$area=$rows['area'];
$location=$rows['location'];

 }




//get email
$query_mail=mysqli_query($conn, "SELECT
set_users.email,
 set_areas.area,
 set_areas.location
FROM
 set_users 
 
 inner JOIN set_areas on set_users.area_id = set_areas.id
 
 where  fullname ='$requestor' ");

 while($rows2=mysqli_fetch_array($query_mail)){


$mail[]=$rows2['email'];

 }


       // EMAIL SETUP
       $headers =  'MIME-Version: 1.0' . "\r\n";
     
      //  $receiver =  'rosly.rapada@nidec.com';
       $receiver =  implode(", ", $mail);
       
       
       $headers .= 'From: WENDS <wends@nidec.com>' . "\r\n";
       // $headers .= 'Cc: ' . $row['emailcc'] . "\r\n";
       $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
       $headers .= "X-Priority: 1 (Highest)\n";
       $headers .= "X-MSMail-Priority: High\n";
       $headers .= "Importance: High\n";

       $subject = "WENDS $type has been $status";
       $body    = "";

       //starts the table tag
       $body .= "
 <!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Transitional//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd'>
<html dir='ltr' xmlns='http://www.w3.org/1999/xhtml' xmlns:o='urn:schemas-microsoft-com:office:office'>

<head>
    <meta charset='UTF-8'>
    <meta content='width=device-width, initial-scale=1' name='viewport'>
    <meta name='x-apple-disable-message-reformatting'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <meta content='telephone=no' name='format-detection'>
    <title></title>
    <!--[if (mso 16)]>
    <style type='text/css'>
    a {text-decoration: none;}
    </style>
    <![endif]-->
    <!--[if gte mso 9]><style>sup { font-size: 100% !important; }</style><![endif]-->
    <!--[if gte mso 9]>
<xml>
    <o:OfficeDocumentSettings>
    <o:AllowPNG></o:AllowPNG>
    <o:PixelsPerInch>96</o:PixelsPerInch>
    </o:OfficeDocumentSettings>
</xml>
<![endif]-->
</head>

<body>
    <div dir='ltr' class='es-wrapper-color'>
        <!--[if gte mso 9]>
			<v:background xmlns:v='urn:schemas-microsoft-com:vml' fill='t'>
				<v:fill type='tile' color='#fafafa'></v:fill>
			</v:background>
		<![endif]-->
        <table class='es-wrapper' width='100%' cellspacing='0' cellpadding='0'>
            <tbody>
                <tr>
                    <td class='esd-email-paddings' valign='top'>
                        <table cellpadding='0' cellspacing='0' class='es-content esd-header-popover' align='center'>
                            <tbody>
                                <tr>
                                    <td class='esd-stripe esd-synchronizable-module' align='center'>
                                        <table class='es-content-body' align='center' cellpadding='0' cellspacing='0' width='600' style='background-color: transparent;' bgcolor='rgba(0, 0, 0, 0)'>
                                            <tbody>
                                                <tr>
                                                    <td class='esd-structure es-p20' align='left'>
                                                        <table cellpadding='0' cellspacing='0' width='100%'>
                                                            <tbody>
                                                                <tr>
                                                                    <td width='560' class='esd-container-frame' align='center' valign='top'>
                                                                        <table cellpadding='0' cellspacing='0' width='100%'>
                                                                            <tbody>
                                                                                <tr>
                                                                                    <td align='center' class='esd-block-text es-infoblock'>
                                                                                        
                                                                                    </td>
                                                                                </tr>
                                                                            </tbody>
                                                                        </table>
                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <table cellpadding='0' cellspacing='0' class='es-header' align='center'>
                            <tbody>
                                <tr>
                                    <td class='esd-stripe' align='center'>
                                        <table bgcolor='#ffffff' class='es-header-body' align='center' cellpadding='0' cellspacing='0' width='600'>
                                            <tbody>
                                                <tr>
                                                    <td class='esd-structure es-p20' align='left'>
                                                        <table cellpadding='0' cellspacing='0' width='100%'>
                                                            <tbody>
                                                                <tr>
                                                                    <td width='560' class='es-m-p0r esd-container-frame' valign='top' align='center'>
                                                                        <table cellpadding='0' cellspacing='0' width='100%'>
                                                                            <tbody>
                                                                                <tr>
                                                                                   
                                                                                </tr>
                                                                            </tbody>
                                                                        </table>
                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <table cellpadding='0' cellspacing='0' class='es-content' align='center'>
                            <tbody>
                                <tr>
                                    <td class='esd-stripe' align='center'>
                                        <table bgcolor='#ffffff' class='es-content-body' align='center' cellpadding='0' cellspacing='0' width='600'>
                                            <tbody>
                                                <tr>
                                                    <td class='esd-structure es-p15t es-p20r es-p20l' align='left'>
                                                        <table cellpadding='0' cellspacing='0' width='100%'>
                                                            <tbody>
                                                                <tr>
                                                                    <td width='560' class='esd-container-frame' align='center' valign='top'>
                                                                        <table cellpadding='0' cellspacing='0' width='100%'>
                                                                            <tbody>
                                                                                <tr>
                                                                                    <td align='center' class='esd-block-image es-p10t es-p10b' style='font-size: 0px;'><a target='_blank'><img src='https://qvlkhe.stripocdn.email/content/guids/CABINET_3d0df4c18b0cea2cd3d10f772261e0b3/images/90511617967234268.png' alt style='display: block;' width='100'></a></td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td align='center' class='esd-block-text es-p10b es-m-txt-c'>
                                                                                        <h1 style='font-size: 30px; line-height: 100%;'>W.E.N.D.S Activity Confirmation</h1>
                                                                                    </td>
                                                                                </tr>
                                                                            </tbody>
                                                                        </table>
                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <table cellpadding='0' cellspacing='0' class='es-content' align='center'>
                            <tbody>
                                <tr>
                                    <td class='esd-stripe' align='center'>
                                        <table bgcolor='#ffffff' class='es-content-body' align='center' cellpadding='0' cellspacing='0' width='600'>
                                            <tbody>
                                                <tr>
                                                    <td class='esd-structure es-p20' align='left'>
                                                        <table cellpadding='0' cellspacing='0' width='100%'>
                                                            <tbody>
                                                                <tr>
                                                                    <td width='560' class='esd-container-frame' align='center' valign='top'>
                                                                        <table cellpadding='0' cellspacing='0' width='100%'>
                                                                            <tbody>
                                                                                <tr>
                                                                                    <td align='center' class='esd-block-text es-m-txt-c'>
                                                                                        <h2>Activity Type&nbsp;<a target='_blank'>$type</a></h2>
                                                                                    </td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td align='center' class='esd-block-text es-p5t es-p5b es-p40r es-p40l es-m-p0r es-m-p0l'>
                                                                                        <p>$today</p>
                                                                                    </td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td align='center' class='esd-block-text es-p5t es-p15b es-p40r es-p40l es-m-p0r es-m-p0l'>
                                                                                        <p>Hi $requestor, this is to inform that your created activity has been $status by $userdata1.  </p>
                                                                                    </td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td align='center' class='esd-block-button'><span class='es-button-border' style='font-size: 20px; border-radius: 6px; border-color: #5c68e2; color: #FEFBF3; border-width: 2px; background: #5c68e2'><a href class='es-button' target='_blank' style='padding-left: 30px; padding-right: 30px; border-radius: 6px;color: #FEFBF3;'>Activity Details</a></span></td>
                                                                                </tr>
                                                                            </tbody>
                                                                        </table>
                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class='esd-structure es-p10t es-p10b es-p20r es-p20l esdev-adapt-off' align='center' 'width='100%>
                                                        <table 'width='100% cellpadding='0' cellspacing='0' class='esdev-mso-table'>
                                                            <tbody>
                                                                <tr>
                                                                    <td class='esdev-mso-td' valign='top'>
                                                                        <table cellpadding='0' cellspacing='0' class='es-left' align='center' width='100%'>
                                                                            <tbody>
                                                                                <tr>
                                                                                    <td width='100%' class='es-m-p0r esd-container-frame' align='center'>
                                                                                        <table cellpadding='0' cellspacing='0' width='100%'>
                                                                                            <tbody>
                                                                                                <tr>
                                                                                                <tr>
                                                                                                <td align='center' class='esd-block-text'>
                                                                                                    <p><strong>1. Type: $type</strong></p>
                                                                                                   
                                                                                                </td>
                                                                                                
                                                                                                </tr>
                                                                                                <tr>
                                                                                                <td align='center' class='esd-block-text'>
                                                                                                    <p><strong>2. Activiy: $activity</strong></p>
                                                                                                   
                                                                                                </td>
                                                                                               
                                                                                                </tr>
                                                                                                <tr>
                                                                                                <td align='center' class='esd-block-text'>
                                                                                                    <p><strong>3. Details: $details</strong></p>
                                                                                                   
                                                                                                </td>
                                                                                               
                                                                                                </tr>

                                                                                                </tr>
                                                                                            </tbody>
                                                                                        </table>
                                                                                    </td>
                                                                                </tr>
                                                                            </tbody>
                                                                        </table>
                                                                    </td>
                                                                    
                                                </tr>
                                                
                                                <tr>
                                                    <td class='esd-structure es-p15t es-p10b es-p20r es-p20l' align='left'>
                                                        <table cellpadding='0' cellspacing='0' width='100%'>
                                                            <tbody>
                                                                <tr>
                                                                    <td width='560' align='left' class='esd-container-frame'>
                                                                        <table cellpadding='0' cellspacing='0' width='100%'>
                                                                            <tbody>
                                                                                <tr>
                                                                                    <td align='center' class='esd-block-text es-p10t es-p10b'>
                                                                                        <p>Got a question?&nbsp;Email us at&nbsp;<a target='_blank' href='mailto:'>NCFL-ISD@nidec.com</a>&nbsp;or give us a call at&nbsp;<a target='_blank' href='tel:'>local 118</a>.</p>
                                                                                    </td>
                                                                                </tr>
                                                                            </tbody>
                                                                        </table>
                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <table cellpadding='0' cellspacing='0' class='es-footer' align='center'>
                            <tbody>
                                <tr>
                                    <td class='esd-stripe esd-synchronizable-module' align='center'>
                                        <table class='es-footer-body' align='center' cellpadding='0' cellspacing='0' width='640' style='background-color: transparent;'>
                                            <tbody>
                                                <tr>
                                                    <td class='esd-structure es-p20t es-p20b es-p20r es-p20l' align='left'>
                                                        <table cellpadding='0' cellspacing='0' width='100%'>
                                                            <tbody>
                                                                <tr>
                                                                    <td width='600' class='esd-container-frame' align='left'>
                                                                        <table cellpadding='0' cellspacing='0' width='100%'>
                                                                            <tbody>
                                                                               
                                                                                    <td align='center' class='esd-block-text es-p35b'>
                                                                                        <p>W.E.N.D.S&nbsp;© 2024 Information System Department. All Rights Reserved.</p>
                                                                                        
                                                                                    </td>
                                                                                </tr>
                                                                                
                                                                            </tbody>
                                                                        </table>
                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <table cellpadding='0' cellspacing='0' class='es-content esd-footer-popover' align='center'>
                            <tbody>
                                <tr>
                                    <td class='esd-stripe esd-synchronizable-module' align='center'>
                                        <table class='es-content-body' align='center' cellpadding='0' cellspacing='0' width='600' style='background-color: transparent;' bgcolor='rgba(0, 0, 0, 0)'>
                                            <tbody>
                                                <tr>
                                                    <td class='esd-structure es-p20' align='left'>
                                                        <table cellpadding='0' cellspacing='0' width='100%'>
                                                            <tbody>
                                                                <tr>
                                                                    <td width='560' class='esd-container-frame' align='center' valign='top'>
                                                                        <table cellpadding='0' cellspacing='0' width='100%'>
                                                                            <tbody>
                                                                                <tr>
                                                                                    <td align='center' class='esd-block-text es-infoblock'>
                                                                                        <p><a target='_blank'></a>This is an automated email.&nbsp;<a href target='_blank'>Please do not reply.</a>.<a target='_blank'></a></p>
                                                                                    </td>
                                                                                </tr>
                                                                                <tr>
                                                                                <td align='center' class='esd-block-text es-infoblock'>
                                                                                    <p><a href='http://10.216.128.114/WENDS'>visit here</a></p>
                                                                                </td>
                                                                            </tr>
                                                                            </tbody>
                                                                        </table>
                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</body>

</html>
       
       ";
       


       // MAIL SENDING
    //    if($count >0){
         (mail($receiver, $subject, $body, $headers));


?>

