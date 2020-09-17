<?php

ini_set('display_errors', 0);
ini_set('log_errors', 1);

$dbHost = "localhost";
$dbUser = "root";
$dbPass = "";
$dbName = "inventory_itc";

$conn = mysqli_connect($dbHost, $dbUser, $dbPass, $dbName);

if (!$conn) { ?>

	<div>
		<p>Error</p>
	</div>

	<?php
	exit();
}
?>