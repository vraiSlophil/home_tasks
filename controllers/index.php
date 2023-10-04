<?php
require_once "../models/utils/Database.php";
require_once "../models/utils/database_infos.php";
require_once "../models/utils/User.php";
require_once "../models/utils/Locations.php";

session_start();


if (!isset($_SESSION["user"])) {
    header(Locations::LOGIN->getValue());
    exit();
}

if (!isset($_COOKIE["tokenCookie"])) {

    header(Locations::LOGIN->getValue());
    exit();
}


$database = new Database(DatabaseInfo::DB_HOST->getValue(), DatabaseInfo::DB_USERNAME->getValue(), DatabaseInfo::DB_PASSWORD->getValue(), DatabaseInfo::DB_DATABASE->getValue());

$user = $_SESSION["user"];

$token = $_COOKIE["tokenCookie"];

$homes = $database->executeQuery("SELECT DISTINCT homes.* FROM homes JOIN users ON homes.creator = users.id LEFT JOIN home_access ON homes.id = home_access.id_home WHERE users.id IN (SELECT id FROM tokenlink WHERE token = :token);",
    [":token" => $token]
);

if ($homes instanceof PDOException) {
    $homes = [];
}
require "../views/index_view.php";