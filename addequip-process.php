 <?php
    include 'db.php';
    include 'header.php';

    $propertyid = $_POST['propertyid'];
    $itemname = $_POST['itemname'];
    $itemdesc = $_POST['itemdesc'];
    $itemdate = $_POST['itemdate'];
    $itememploy = $_POST['itememploy'];

    if (!empty($itemname && $itemdesc && $itemdate && $itememploy)) {
        $query = "INSERT INTO equipment (property_number, item_name, description, date_acquired, accountable_employee)
              VALUES ('$propertyid', '$itemname', '$itemdesc', '$itemdate', '$itememploy')";

        $hasil = mysqli_query($conn, $query);
    }

    if ($hasil) {
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
    header( "Refresh:5; url='viewequip.php'");

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
        header( "Refresh:5; url='addequip.php'");
    }

    include 'footer.php';
    ?>