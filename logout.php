<?php

session_start();

// hapus session
session_destroy();

// redirect ke page-login.php
header("Location: login.php");

?>