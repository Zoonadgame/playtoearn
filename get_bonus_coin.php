<?php  
session_start();
error_reporting(0);

require "database/connMySQLClass.php";
require "database/getCoinTableClass.php";


$getCoinTableClass = new getCoinTableClass();

$usrID = $_SESSION['userId'];
$data = $getCoinTableClass->selectGetCoin(
    fields: "SUM(get_coin_total) AS total",
    key: "get_coin_id_user = '$usrID'"
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
