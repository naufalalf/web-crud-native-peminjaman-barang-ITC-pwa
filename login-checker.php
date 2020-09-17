<?php
// script untuk mengecek keberadaan session pasca login

session_start();
if (!isset($_SESSION['login'])){
	// jika session login blm ada maka redirect ke page login
	header("Location: login.php");
}
?>
