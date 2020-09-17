 <?php
    include 'db.php';
    include 'header.php';

    $employeeid = $_GET['id'];

   if (!empty($employeeid)) {
        $query = "DELETE FROM borrowers WHERE employee_id = '$employeeid'";
        $hasil = mysqli_query($conn, $query);
   }

   if ($hasil) { ?>
    <div class="col-12" style="padding-top: 40px; padding-bottom: 40px">
        <div class="col-3">&nbsp;</div>
        <div class="col-6">
            <div class="alert alert-success">
                <strong>Success!</strong> Delete Data Success.
            </div>
            <div class="progress-bar progress-bar-striped active" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width:100%">Redirecting...</div>
            </div>
    </div>
    <?php
    header( "Refresh:5; url='viewborrow.php'");

    } else {

        ?>
        <div class="col-12" style="padding-top: 40px; padding-bottom: 40px">
            <div class="col-3">&nbsp;</div>
            <div class="col-6">        
                <div class="alert alert-danger">
                    <strong>Error!</strong> Delete Data Failed.
                </div>
                <div class="progress-bar progress-bar-striped active" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width:100%">Redirecting...</div>
                </div>
        </div>
        <?php
        $url = "editborrow.php?id=".$employeeid;
        header( "Refresh:5; url=$url");
    }

    include 'footer.php';
    ?>