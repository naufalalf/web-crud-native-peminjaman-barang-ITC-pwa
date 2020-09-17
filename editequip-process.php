 <?php
    include 'db.php';
    include 'header.php';

    $propertynumber = $_POST['property_number'];
    $itemname = $_POST['item_name'];
    $description = $_POST['description'];
    $date_acquired = $_POST['date_acquired'];
    $accountable_employee = $_POST['accountable_employee'];

   if (!empty($propertynumber) and !empty($itemname) and !empty($description) and !empty($date_acquired) and !empty($accountable_employee)) {
        $query = "UPDATE equipment SET item_name = '$itemname', description = '$description', date_acquired = '$date_acquired', accountable_employee = '$accountable_employee' WHERE property_number = '$propertynumber'";
        $hasil = mysqli_query($conn, $query);
   }

   if ($hasil) { ?>
    <div class="col-12" style="padding-top: 40px; padding-bottom: 40px">
        <div class="col-3">&nbsp;</div>
        <div class="col-6">
            <div class="alert alert-success">
                <strong>Success!</strong> Edit Data Success.
            </div>
            <div class="progress-bar progress-bar-striped active" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width:100%">Redirecting...</div>
            </div>
    </div>
    <?php
    header( "Refresh:5; url='viewequip.php'");

    } else {

        ?>
        <div class="col-12" style="padding-top: 40px; padding-bottom: 40px">
            <div class="col-3">&nbsp;</div>
            <div class="col-6">        
                <div class="alert alert-danger">
                    <strong>Error!</strong> Edit Data Failed.
                </div>
                <div class="progress-bar progress-bar-striped active" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width:100%">Redirecting...</div>
                </div>
        </div>
        <?php
        $url = "editequip.php?id=".$propertynumber;
        header( "Refresh:5; url=$url");
    }

    include 'footer.php';
    ?>