<?php
    include 'login-checked.php';
?>

<!DOCTYPE html>
<html>
<head>
    <title>Inventory System for IT Center</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato">
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>

    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">

    <link rel="stylesheet" href="login.css">    
   <!--  <style>
        body{
       width:100%;
       height: 100%;
       background-color: #000;
        }
    </style> -->
</head>
<body style="font-family: Lato; background-image: url('img/tau2.jpg'); background-size:cover; height: 770px; width: 100%;" >
    <?php
        if (isset($_GET['error'])) { ?>
            <div class="alert alert-danger">
                <strong>Error!</strong> Check Username and Password.
            </div>
    <?php
        }
    ?>
    <div class="container">
        <div class="card card-container" style="opacity: 100%; ">
            <!-- <img class="profile-img-card" src="//lh3.googleusercontent.com/-6V8xOA6M7BA/AAAAAAAAAAI/AAAAAAAAAAA/rzlHcD0KYwo/photo.jpg?sz=120" alt="" /> -->
            <img id="profile-img" class="profile-img-card" src="//ssl.gstatic.com/accounts/ui/avatar_2x.png" />
            <h2 class="profile-name-card">Welcome back!</h2>
            <form method="post">
              <div class="input-group">
                <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                <input type="text" class="form-control" name="username" placeholder="Username" required="">
              </div>
              <br>
              <div class="input-group">
                <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                <input  type="password" class="form-control" name="password" placeholder="Password" required="">
              </div>
              <br>
              <button class="btn btn-lg btn-primary btn-block btn-signin" type="submit" name="signin">Sign in</button>
            </form>
        </div><!-- /card-container -->
    </div><!-- /container -->
</body>
</html>

<?php
include 'db.php';

session_start();


if (isset($_POST['signin'])) {

    $username = $_POST['username'];
    $password = md5($_POST['password']);

    $query = "SELECT * FROM admin WHERE admin_user = '$username'";
    $hasil = mysqli_query($conn, $query);
    $data = mysqli_fetch_array($hasil);
    
    $query1 = "SELECT * FROM user WHERE user_user = '$username'";
    $hasil1 = mysqli_query($conn, $query1);
    $data1 = mysqli_fetch_array($hasil1);

    if ($hasil) {
        if ($password == $data['admin_pass']) {
            $_SESSION['login'] = true;
            $_SESSION['status'] = 1;
            header( "Location: index.php");
        }
    }
    if ($hasil1) {
        if ($password == $data1['user_pass']) {
            $_SESSION['login'] = true;
            $_SESSION['status'] = 2;
            header( "Location: index.php");
        }
        else {
            header( "Location: login.php?error=true");
        }
    }
}
?>