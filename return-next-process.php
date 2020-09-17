<?php
include 'header.php';
include 'db.php';
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <script src="js/script.js"></script>
    <link rel="stylesheet"  href="select.css">
    <style type="text/css">
    .dlk-radio input[type="radio"],
    .dlk-radio input[type="checkbox"]
    {
    margin-left:-99999px;
    display:none;
    }
    .dlk-radio input[type="radio"] + .fa ,
    .dlk-radio input[type="checkbox"] + .fa {
    opacity:0.15
    }
    .dlk-radio input[type="radio"]:checked + .fa,
    .dlk-radio input[type="checkbox"]:checked + .fa{
    opacity:1
    }
    </style>
  </head>
  <body>

<?php
$rb = $_GET['rb']; 
$id = $_GET['id'];

if (isset($_GET['id']) and isset($_GET['rb'])) {
  $query = "UPDATE borrowed_equipment SET date_returned = now(), status = 'returned' WHERE property_number = '$id' AND employee_id = '$rb'";
  $sqlq = mysqli_query($conn, $query);
}
  
  if ($sqlq) {
    ?>
    <div class="col-12" style="padding-top: 40px; padding-bottom: 40px">
        <div class="col-3">&nbsp;</div>
        <div class="col-6">
            <div class="alert alert-success">
                <strong>Success!</strong> Input Data Success.
            </div>
            <div class="progress-bar progress-bar-striped active" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width:100%">Redirecting...</div>
            </div>
    </div>
    <?php
    header( "Refresh:5; url='borrowedequip.php'");

    } else {

        ?>
        <div class="col-12" style="padding-top: 40px; padding-bottom: 40px">
            <div class="col-3">&nbsp;</div>
            <div class="col-6">        
                <div class="alert alert-danger">
                    <strong>Error!</strong> Input Data Failed.
                </div>
                <div class="progress-bar progress-bar-striped active" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width:100%">Redirecting...</div>
                </div>
        </div>
        <?php
        header( "Refresh:5; url='return.php'");
}
include 'footer.php';
?>

<!-- <div style="padding-bottom: 20px">
	<center><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">Submit</button></center>
</div>
-->