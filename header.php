<?php
    include 'login-checker.php';
    ob_start();
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
		
		<link rel="stylesheet" href="main.css">

		<style type="text/css">
			.navbar {
			    -webkit-border-radius: 0;
			    -moz-border-radius: 0;
			    border-radius: 0;
			}
			.navbar .container-fluid, .navbar-collapse {
			    padding-left:0;
			}
			.navbar-collapse.in {
				padding-left:0;
			}
		</style>
	</head>
	<body style="font-family: Lato">
		
		<!-- Header -->
		<header>
			<div id="myCarousel" class="carousel slide" data-ride="carousel">
				<!-- Indicators -->
				<ol class="carousel-indicators">
					<li data-target="#myCarousel" data-slide-to="0" class="active"></li>
					<li data-target="#myCarousel" data-slide-to="1"></li>
					<li data-target="#myCarousel" data-slide-to="2"></li>
				</ol>
				<!-- Wrapper for slides -->
				<div class="carousel-inner">
					<div class="item active">
						<img src="img/banner.png">
					</div>
					<div class="item">
						<img src="img/banner2.png">
					</div>
					<div class="item">
						<img src="img/banner3.png">
					</div>
				</div>
			</div>
		</header>
		<!-- Nav -->
		<?php
		if ($_SESSION['status'] == 1) {
		?>
		<div class="nav-wrapper">
		<nav class="navbar navbar-inverse" id="menu-wrapper" data-spy="affix" data-offset-top="350">
		  <div class="container-fluid">
		    <ul class="nav navbar-nav">
		      <li><a href="index.php"><i class="fa fa-home"></i> HOME</a></li>
		      <li class="dropdown">
		        <a class="dropdown-toggle" data-toggle="dropdown" href="#"><i class="fa fa-plus-circle"></i> ADD
		        <span class="caret"></span></a>
		        <ul class="dropdown-menu">
		          <li><a href="addequip.php">ADD EQUIPMENT</a></li>
		          <li><a href="addborrow.php">ADD BORROWERS</a></li>
		        </ul>
		      </li>
		      <li class="dropdown">
		        <a class="dropdown-toggle" data-toggle="dropdown" href="#"><i class="fa fa-list"></i> VIEW
		        <span class="caret"></span></a>
		        <ul class="dropdown-menu">
		          <li><a href="viewequip.php">VIEW EQUIPMENT</a></li>
		          <li><a href="viewborrow.php">VIEW BORROWERS</a></li>
		          <li><a href="viewunreturn.php">VIEW UNRETURNED</a></li>
		        </ul>
		      </li>
		      <li class="dropdown">
		        <a class="dropdown-toggle" data-toggle="dropdown" href="#"><i class="fa fa-cube"></i> BORROW
		        <span class="caret"></span></a>
		        <ul class="dropdown-menu">
		          <li><a href="borrowequip.php">BORROW EQUIPMENT</a></li>
		          <li><a href="borrowedequip.php">VIEW BORROWED EQUIPMENT</a></li>
		        </ul>
		      </li>
		      <li><a href="return.php"><i class="fa fa-share-square-o"></i> RETURN</a></li>
		    </ul>
		    <ul class="nav navbar-nav navbar-right">
		      <li><a href="user.php"><i class="fa fa-user"></i> USER</a></li>
		      <li><a href="logout.php"><i class="fa fa-sign-out"></i> LOGOUT</a></li>
		    </ul>
		  </div>
		</nav>
		</div>

	<?php } else if($_SESSION['status'] == 2){?> 
		<div class="nav-wrapper">
		<nav class="navbar navbar-inverse" id="menu-wrapper" data-spy="affix" data-offset-top="350">
		  <div class="container-fluid">
		    <ul class="nav navbar-nav">
		      <li><a href="index.php"><i class="fa fa-home"></i> HOME</a></li>
		      <li class="dropdown">
		        <a class="dropdown-toggle" data-toggle="dropdown" href="#"><i class="fa fa-list"></i> VIEW
		        <span class="caret"></span></a>
		        <ul class="dropdown-menu">
		          <li><a href="viewequip.php">VIEW EQUIPMENT</a></li>
		          <li><a href="viewborrow.php">VIEW BORROWERS</a></li>
		          <li><a href="viewunreturn.php">VIEW UNRETURNED</a></li>
		        </ul>
		      </li>
		      <li class="dropdown">
		        <a class="dropdown-toggle" data-toggle="dropdown" href="#"><i class="fa fa-cube"></i> BORROW
		        <span class="caret"></span></a>
		        <ul class="dropdown-menu">
		          <li><a href="borrowequip.php">BORROW EQUIPMENT</a></li>
		          <li><a href="borrowedequip.php">VIEW BORROWED EQUIPMENT</a></li>
		        </ul>
		      </li>
		      <!-- <li><a href="return.php"><i class="fa fa-share-square-o"></i> RETURN</a></li> -->
		    </ul>
		    <ul class="nav navbar-nav navbar-right">
		    	<li><a href="logout.php"><i class="fa fa-sign-out"></i> LOGOUT</a></li>
		    </ul>
		  </div>
		</nav>
		</div>
<?php } ?>
		
	</body>
</html>
<script type="text/javascript">
    $(document).ready(function () {
        var url = window.location;
        $('ul.nav a[href="'+ url +'"]').parent().addClass('active');
        $('ul.nav a').filter(function() {
             return this.href == url;
        }).parent().addClass('active');
    });
</script> 

<script type="text/javascript">
	$(document).ready(function(){
    // activate left navigation based on current link
    var current_url = window.location;
    $('ul.dropdown-menu li a').filter(function () {
        return this.href == current_url;
    }).last().parents('li').addClass('active');
});
</script>