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
}?>
<?php
// Your PHP code to fetch data
$overall_rpa = mysqli_query($conn, "SELECT * FROM tbl_main  where type='RPA'")->num_rows;
$overall_plan_rpa = mysqli_query($conn, "SELECT * FROM tbl_main  where type='RPA' and level2_status ='Plan' ")->num_rows;
$overall_ongoing_rpa = mysqli_query($conn, "SELECT * FROM tbl_main  where type='RPA' and level2_status ='Ongoing' ")->num_rows;
$overall_done_rpa = mysqli_query($conn, "SELECT * FROM tbl_main  where type='RPA' and level2_status ='Done' ")->num_rows;
?>

<!DOCTYPE html>
<html>
<head>
    <title>Donut Chart Display</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
<table class="table" width="20%">
    <!-- Your table structure -->
    <tr>
        <td><canvas id="myChart" width="400" height="40"></canvas></td>
    </tr>
    <button onclick="saveChartAsImage()">Save Chart as Image</button>
</table>



<script>
// Passing PHP variables to JavaScript
var data = {
   
    planRPA: <?php echo $overall_plan_rpa; ?>,
    ongoingRPA: <?php echo $overall_ongoing_rpa; ?>,
    doneRPA: <?php echo $overall_done_rpa; ?>
};

// Chart.js code to render the donut chart
var ctx = document.getElementById('myChart').getContext('2d');
var myChart = new Chart(ctx, {
    type: 'doughnut',
    data: {
        labels: [ 'Plan', 'Ongoing', 'Done'],
        datasets: [{
            label: '# of Votes',
            data: [data.planRPA, data.ongoingRPA, data.doneRPA],
            backgroundColor: [
               
                '#008DDA', // Plan - HEX color
                    '#FFC700', // Ongoing - HEX color
                    '#008000'  // Accept - HEX color
            ],
            borderColor: [
               
                '#008DDA', // Plan - HEX color
                    '#FFC700', // Ongoing - HEX color
                    '#008000'  // Accept - HEX color
            ],
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            y: {
                beginAtZero: true
            }
        }
    }
});

function saveChartAsImage() {
    // Convert chart to data URL (image)
    var url_base64jp = document.getElementById("myChart").toDataURL("image/jpeg");
    // Call the function to save the image on the server
    saveImage(url_base64jp);
}

function saveImage(imageData) {
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "save_image.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.onreadystatechange = function() {
        if (this.readyState === XMLHttpRequest.DONE && this.status === 200) {
            // Optional: Alert or log the server's response or indicate success in the UI
            alert(this.responseText);
        }
    }
    xhr.send("imageData=" + encodeURIComponent(imageData));
}
// Automatically save the chart when the page loads
window.onload = function() {
    setTimeout(function() {
        saveChartAsImage();
    }, 1000); // Adjust delay as needed
};

</script>
</body>
</html>








