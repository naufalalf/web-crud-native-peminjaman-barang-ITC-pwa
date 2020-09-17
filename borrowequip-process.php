<?php
include "header.php";
include "db.php";

            if (isset($_POST['submit'])){

                foreach ($_POST['rb'] as $rb) :
                    $q=mysqli_query($conn,"SELECT * from borrowers where employee_id='$rb'");
                    $selected=mysqli_fetch_array($q);
                    //echo $selected['employee_id']." ".$selected['employee_first_name'].", ".$selected['employee_last_name']." ".$selected['employee_middle_name'].". "."         ||";
                    $tanggal= date("Y-m-d");
                    $employee_id=$selected['employee_id'];
                    $query="INSERT INTO borrowed_equipment (employee_id,property_number,date_borrowed,date_returned, status) VALUES ('$employee_id','$property_number','$tanggal','$null','$null')";

                    $hasil = mysqli_query($conn, $query);
                    
                endforeach;


                foreach ($_POST['id'] as $id):
                    $sq=mysqli_query($conn,"SELECT * from equipment where property_number='$id'");
                    $sdata=mysqli_fetch_array($sq);
                     // echo "||".$sdata['property_number']." ".$sdata['item_name']." (".$sdata['description'].") ". " ";
                    $tanggal= date("Y-m-d");
                    $property_number=$sdata['property_number'];
                    $query="INSERT INTO borrowed_equipment (employee_id,property_number,date_borrowed,date_returned, status) VALUES ('$employee_id','$property_number','$tanggal','$null','$null')";
             
                    $hasil = mysqli_query($conn, $query);
                endforeach;

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
        header( "Refresh:5; url='borrowequip.php'");
    }
    include 'footer.php';
?>