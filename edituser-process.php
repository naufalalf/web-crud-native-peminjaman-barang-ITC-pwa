 <?php
    include 'db.php';
    include 'header.php';

    $user_id = $_POST['user_id'];
    $user_user = $_POST['user_user'];
    $user_pass = md5($_POST['user_pass']);
    
   if (!empty($user_id) and !empty($user_user) and !empty($user_pass)) {
        $query = "UPDATE user SET user_user = '$user_user', user_pass = '$user_pass' WHERE user_id = '$user_id'";
        $hasil = mysqli_query($conn, $query);
   }

   if ($hasil) { ?>
    <div class="col-12" style="padding-top: 40px; padding-bottom: 40px">
        <div class="col-3">&nbsp;</div>
        <div class="col-6">
            <div class="alert alert-success">
                <strong>Success!</strong>Edit Data Success.
            </div>
            <div class="progress-bar progress-bar-striped active" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width:100%">Redirecting...</div>
            </div>
    </div>
    <?php
    header( "Refresh:5; url='user.php'");

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
        $url = "edituser.php?id=".$user_id;
        header( "Refresh:5; url=$url");
    }

    include 'footer.php';
    ?>