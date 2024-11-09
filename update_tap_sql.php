<?php
session_start();
error_reporting(0);

require "database/connMySQLClass.php";
require "database/tapTableClass.php";

$tapTableClass = new tapTableClass();

// Mendapatkan nilai lastTapCoins dari permintaan POST
$data = json_decode(file_get_contents('php://input'), true);
$lastTapCoins = $data['lastTap'];

$usrID = $_SESSION['userId'];
$update = $tapTableClass->updateTap(
    dataSet: "tap_last = '$lastTapCoins'",
    key: "tap_id_user = '$usrID'"
);

if ($update) {
    echo json_encode(["success" => true]);
} else {
    echo json_encode(["success" => false, "error" => $stmt->error]);
}

