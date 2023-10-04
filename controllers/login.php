<?php
//$currentPage = $_SERVER['SCRIPT_NAME'];
//ini_set('display_errors', 1);
//ini_set('display_startup_errors', 1);
//error_reporting(E_ALL);

session_start();

if (isset($_SESSION["user"])) {
    unset($_SESSION["user"]);
}

if (isset($_COOKIE["tokenCookie"])) {
    require_once "../models/utils/database_infos.php";
    require_once "../models/utils/Database.php";

    $database = new Database(DatabaseInfo::DB_HOST->getValue(), DatabaseInfo::DB_USERNAME->getValue(), DatabaseInfo::DB_PASSWORD->getValue(), DatabaseInfo::DB_DATABASE->getValue());

    $result = $database->executeQuery("DELETE FROM tokenlink WHERE token = :token",
        ["token" => $_COOKIE["tokenCookie"]]
    );
    if ($result instanceof PDOException) {
        $error = $result->getMessage();
    }
    setcookie("tokenCookie", "", time() - 3600);
}

require "../models/utils/Locations.php";

if (isset($_POST["login_username"]) && isset($_POST["login_password"])) {

    if($_POST["login_username"] == "") {
        $error = "Veuillez entrer un nom d'utilisateur.";
    } else if($_POST["login_password"] == "") {
        $error = "Veuillez entrer un mot de passe.";
    } else {
        require_once "../models/utils/database_infos.php";
        require_once "../models/utils/User.php";
        require_once "../models/utils/Database.php";

        $database = new Database(DatabaseInfo::DB_HOST->getValue(), DatabaseInfo::DB_USERNAME->getValue(), DatabaseInfo::DB_PASSWORD->getValue(), DatabaseInfo::DB_DATABASE->getValue());

        $user = new User($_POST["login_username"], $_POST["login_password"]);
        $result = $database->executeQuery("SELECT * FROM users WHERE username = :username AND password = :password", [
            "username" => $user->getUsername(),
            "password" => $user->getPassword()
        ]);

        if (is_array($result) && count($result) > 0) {
            setcookie("tokenCookie", $user->getToken(), 0);
            $_SESSION["user"] = $user;
            $database->executeQuery("INSERT INTO tokenlink (id, token) VALUES (:id, :token)", [
                "id" => $result[0]["id"],
                "token" => $user->getToken()
            ]);
            header(Locations::INDEX->getValue());
            exit();
        } else if ($result instanceof PDOException) {
            $error = $result->getMessage();
        } else {
            $error = "Nom d'utilisateur ou mot de passe incorrect.";
        }
    }
} else if (isset($_POST["register_username"]) && isset($_POST["register_password"])) {
    if($_POST["register_username"] == "") {
        $error = "Veuillez entrer un nom d'utilisateur.";
    } else if($_POST["register_password"] == "") {
        $error = "Veuillez entrer un mot de passe.";
    } else {
        require_once "../models/utils/User.php";
        require_once "../models/utils/database_infos.php";
        require_once "../models/utils/Database.php";

        $database = new Database($host, $username, $password, $dtbase);

        $user = new User($_POST["register_username"], $_POST["register_password"]);

        $result = $database->executeQuery("INSERT INTO users (username, password) VALUES (:username, :password)", [
            "username" => $user->getUsername(),
            "password" => $user->getPassword()
        ]);
//        $lastInsertId = $database->executeQuery("SELECT LAST_INSERT_ID() AS id INTO users", [])["id"];
        $lastInsertId = $database->executeQuery("SELECT LAST_INSERT_ID() AS id", [])["id"];
        if ($result instanceof PDOException) {
            $error = "Ce nom d'utilisateur est déjà utilisé.";
        } else {
            setcookie("tokenCookie", $user->getToken(), 0);
            $_SESSION["user"] = $user;
            $database->executeQuery("INSERT INTO tokenlink (id, token) VALUES (:id, :token)", [
                "id" => $lastInsertId,
                "token" => $user->getToken()
            ]);
            header(Locations::INDEX->getValue());
            exit();
        }
    }
}
unset($_POST);


require "../views/login_view.php";