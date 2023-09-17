<?php
//$currentPage = $_SERVER['SCRIPT_NAME'];

$mediaPath = "../views/media/";

if (isset($_POST["login_username"]) && isset($_POST["login_password"])) {

//    header("Location: index.php");
    header("Location: login.php");
    exit();
}


require "../views/login_view.php";