<?php
session_start();
error_reporting(0);

require "database/connMySQLClass.php";
require "database/userTableClass.php";

$userTableClass = new userTableClass();

// Mendapatkan nilai lastTapCoins dari permintaan POST
$data = json_decode(file_get_contents('php://input'), true);
$coin = $data['coins'];
$dateMilis = round(microtime(true) * 1000);
$usrID = $_SESSION['userId'];
$update = $userTableClass->updateUser(
    dataSet: "user_balance = '$coin', user_last_date = '$dateMilis'",
    key: "user_id = '$usrID'"
);

if ($update) {
    echo json_encode(["success" => true]);
} else {
    echo json_encode(["success" => false, "error" => $stmt->error]);
}

