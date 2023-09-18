<?php
//$currentPage = $_SERVER['SCRIPT_NAME'];

$mediaPath = "../views/media/";

if (isset($_POST["login_username"]) && isset($_POST["login_password"])) {

    if($_POST["login_username"] == "") {
        $error = "Veuillez entrer un nom d'utilisateur.";
    } else if($_POST["login_password"] == "") {
        $error = "Veuillez entrer un mot de passe.";
    } else {
        $user = new User($_POST["login_username"], $_POST["login_password"]);
        $result = $database->executeQuery("SELECT * FROM users WHERE username = :username AND password = :password", [
            "username" => $user->getUsername(),
            "password" => $user->getPassword()
        ]);

        if (is_array($result) && count($result) > 0) {
            $_SESSION["user"] = $user;
            header("Location: index.php");
            exit();
        } else {
            $error = "Nom d'utilisateur ou mot de passe incorrect.";
        }
    }
    header("Location: login.php");
    exit();
}


require "../views/login_view.php";