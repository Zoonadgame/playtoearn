<?php  
session_start();
error_reporting(0);

require "database/connMySQLClass.php";
require "database/userTableClass.php";


$userTableClass = new userTableClass();

$usrID = $_SESSION['userId'];
$data = $userTableClass->selectUser(
    fields: "user_profit_per_our",
    key: "user_id = '$usrID'"
)['data'][0];


// Kembalikan data dalam format JSON
header('Content-Type: application/json');
echo json_encode(
    [
        'coin_per_our' => $data['user_profit_per_our']
    ]
);
