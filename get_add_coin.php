<?php  
session_start();
error_reporting(0);

require "database/connMySQLClass.php";
require "database/tapTableClass.php";


$tapTableClass = new tapTableClass();

$usrID = $_SESSION['userId'];
$data = $tapTableClass->selectTap(
    fields: "tap_max, tap_last, tap_total",
    key: "tap_id_user = '$usrID'"
)['data'][0];


// Kembalikan data dalam format JSON
header('Content-Type: application/json');
echo json_encode(
    [
        'add_coin' => $data['tap_total'],
        'max_coin' => $data['tap_max'],
        'last_coin' => $data['tap_last']
    ]
);
