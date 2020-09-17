 <?php
    include 'db.php';
    include 'header.php';

    
    $username = $_POST['user_user'];
    $password = md5($_POST['user_pass']);

    if (!empty($username) && !empty($username && $password)) {
        $query = "INSERT INTO user (user_user, user_pass)
              VALUES ('$username','$password')";

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
    header( "Refresh:5; url='user.php'");

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
        header( "Refresh:5; url='adduser.php'");
    }

    include 'footer.php';
    ?>