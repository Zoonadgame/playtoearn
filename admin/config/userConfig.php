<?php  
session_start();
error_reporting(0);
if(!$_SESSION['login_zoo_admin']){
    header('Location: index');
    exit();
}

require "database/connMySQLClass.php";
require "database/userTableClass.php";
require "database/spendCoinTableClass.php";
require "database/getCoinTableClass.php";

$userTableClass = new userTableClass();
$spendCoinTableClass = new spendCoinTableClass();
$getCoinTableClass = new getCoinTableClass();

$page = isset($_GET['page']) ? $_GET['page'] : '1'; // number page

$dataTable = dataTable($page);

function dataTable($page){
    global $userTableClass;
    $start = 10 * ($page - 1);

    $data = $userTableClass->selectUser(
        fields: "user_id AS id, user_username AS name, user_balance AS balance, user_lvl AS lvl",
        key: "1 ORDER BY user_date DESC LIMIT $start, 10"
    );

    return $data;
}

function countDataUser(){
    global $userTableClass;

    $data = $userTableClass->selectUser(
        fields: "COUNT(id) AS total",
        key: "1"
    );

    return $data['data'][0]['total'];

}

function totalBalance($usr, $bl){
    global $getCoinTableClass;
    $coinGet = $getCoinTableClass->selectGetCoin(
        fields: "SUM(get_coin_total) AS total",
        key: "get_coin_id_user = '$usr'"
    );
    
    $plusCoin = $coinGet['data'][0]['total'];
    if($plusCoin == null){
       $plusCoin = 0;
    }

    global $spendCoinTableClass;
    $coinSpen = $spendCoinTableClass->selectSpendCoin(
        fields: "SUM(spend_coin_total) AS total",
        key: "spend_coin_id_user = '$usr'"
    );

    $minusCoin = $coinSpen['data'][0]['total'];
    if($minusCoin == null){
       $minusCoin = 0;
    }

    $result = ($bl + $plusCoin) - $minusCoin;

    return $result;
}

function getDataUser($usrID){
    global $userTableClass;
    $data = $userTableClass->selectUser(
        fields: "user_code_refferal AS reff",
        key: "user_id = '$usrID'"
    );

    return $data['data'][0];
}




?>