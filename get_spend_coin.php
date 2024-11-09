<?php  
session_start();
error_reporting(0);

require "database/connMySQLClass.php";
require "database/spendCoinTableClass.php";


$spendCoinTableClass = new spendCoinTableClass();

$usrID = $_SESSION['userId'];
$data = $spendCoinTableClass->selectSpendCoin(
    fields: "SUM(spend_coin_total) AS total",
    key: "spend_coin_id_user = '$usrID'"
);

if($data['data'][0]['total'] != null){
    $total = $data['data'][0]['total'];
}else{
    $total = 0;
}

// Kembalikan data dalam format JSON
header('Content-Type: application/json');
echo json_encode(
    [
        'total' => $total
    ]
);
