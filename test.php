<?php
session_start();
$_SESSION['GOOGLE_USER_INFO']->{"id"} = "10";
header('location: ./');
?>