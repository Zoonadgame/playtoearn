<?php  
session_start();
error_reporting(0);

if(!$_SESSION['login_zoo']){
    header('Location: index');
    exit();
}

require "database/connMySQLClass.php";
require "database/userTableClass.php";
require "database/tapTableClass.php";
require "database/spendCoinTableClass.php";
require "database/getCoinTableClass.php";
require "database/levelTableClass.php";

$userTableClass = new userTableClass();
$tapTableClass = new tapTableClass();
$spendCoinTableClass = new spendCoinTableClass();
$getCoinTableClass = new getCoinTableClass();
$levelTableClass = new levelTableClass();

$getTap = getTap();
$getDataUser = getDataUser();
$priceBooster = priceBooster();
$autoUpLvl = autoUpLvl();

if(isset($_POST['tapUp'])){
    $totalBalanceNow = ($getDataUser['user_balance'] + getBonusCoinUser()) - getSpendCoinUser();
    $fee = $priceBooster['feeUpTap'];
    if($totalBalanceNow > $fee){
        $descBuyCoin = "Upgrade Tap";
        $usrID = $_SESSION['userId'];
        $dateNow = round(microtime(true) * 1000);
        if(saveSpend($usrID, $descBuyCoin, $fee, $dateNow)){
            $pertaps = $getTap['tap_total'] + 1;
            $updateTap = $tapTableClass->updateTap(
                dataSet: "tap_total = '$pertaps'",
                key: "tap_id_user = '$usrID'"
            );
            if($updateTap){
                sleep(1);
                $_SESSION['alert_success'] = "Success up multi tap!";
                header('Location: home');
                exit();
            }
        }
    }else{
        sleep(1);
        $_SESSION['alert_error'] = "Coin is not enough";
        header('Location: home');
        exit();

    }
}
if(isset($_POST['energyUp'])){
    $totalBalanceNow = ($getDataUser['user_balance'] + getBonusCoinUser()) - getSpendCoinUser();
    $fee = $priceBooster['feeUpEnergy'];
    if($totalBalanceNow > $fee){
        $descBuyCoin = "Upgrade Energy";
        $usrID = $_SESSION['userId'];
        $dateNow = round(microtime(true) * 1000);
        if(saveSpend($usrID, $descBuyCoin, $fee, $dateNow)){
            $energyss = $getTap['tap_max'] + 10;
            $updateTap = $tapTableClass->updateTap(
                dataSet: "tap_max = '$energyss'",
                key: "tap_id_user = '$usrID'"
            );
            if($updateTap){
                sleep(1);
                $_SESSION['alert_success'] = "Success up energy!";
                header('Location: home');
                exit();
            }
        }
    }else{
        sleep(1);
        $_SESSION['alert_error'] = "Coin is not enough";
        header('Location: home');
        exit();

    }
}

function autoUpLvl(){
    $progressLvl = progressLvl();
    $getLvlUser = getLvlUser();
    $numLvlNow = $getLvlUser['id'];
    $nameLvlNow = $getLvlUser['nameLvl'];
    $getNextLvlUser = getNextLvlUser($numLvlNow);
    $NameLvlNext = $getNextLvlUser['lvlName'];
    global $userTableClass;
    $usrID = $_SESSION['userId'];
    if($progressLvl >= 100){
        $updateLvl = $userTableClass->updateUser(
            dataSet: "user_lvl = '$NameLvlNext'",
            key: "user_id = '$usrID'"
        );
        if($updateLvl){
            if($progressLvl > 100){
                return autoUpLvl();
            }
        }
    }
    return [
        "numLvl" => $numLvlNow,
        "nameLvl" => $nameLvlNow,
        "progress" => $progressLvl
    ];

}

function getLvlUser(){
    global $levelTableClass;
    $getDataUser = getDataUser();

    $nameLvl = $getDataUser['user_lvl'];

    $data = $levelTableClass->selectLevel(
        fields: "id, level_name, level_coin",
        key: "level_name = '$nameLvl' LIMIT 1"
    )['data'];

    return [
        "id" => $data[0]['id'],
        "nameLvl" => $data[0]['level_name'],
        "startCoin" => $data[0]['level_coin']
    ];
}

function getNextLvlUser($lvlNow){
    global $levelTableClass;

    $nextLvl = $lvlNow + 1;

    $data = $levelTableClass->selectLevel(
        fields: "level_name, level_coin",
        key: "id = '$nextLvl' LIMIT 1"
    )['data'];

    return [
        "lvlName" => $data[0]['level_name'],
        "startCoin" => $data[0]['level_coin']
    ];
}

function progressLvl(){
    $getDataUser = getDataUser();
    $getLvlUser = getLvlUser();

    $numLvlNow = $getLvlUser['id'];
    $startCoinLvlNow = $getLvlUser['startCoin'];

    $getNextLvlUser = getNextLvlUser($numLvlNow);

    $startCoinLvlNext = $getNextLvlUser['startCoin'];

    $range = $startCoinLvlNext - $startCoinLvlNow;

    $totalBalanceNow = ($getDataUser['user_balance'] + getBonusCoinUser()) - getSpendCoinUser();
    $progressCoin = $totalBalanceNow - $startCoinLvlNow;

    $progressPercent = ($progressCoin / $range) * 100;

    return $progressPercent;
}

function getBonusCoinUser(){
    global $getCoinTableClass;
    $usrID = $_SESSION['userId'];
    $data = $getCoinTableClass->selectGetCoin(
        fields: "SUM(get_coin_total) AS total",
        key: "get_coin_id_user = '$usrID'"
    );
    
    if($data['data'][0]['total'] == null){
        return 0;
    }
    return $data['data'][0]['total'];
}

function getSpendCoinUser(){
    global $spendCoinTableClass;
    $usrID = $_SESSION['userId'];
    $data = $spendCoinTableClass->selectSpendCoin(
        fields: "SUM(spend_coin_total) AS total",
        key: "spend_coin_id_user = '$usrID'"
    );
    
    if($data['data'][0]['total'] == null){
        return 0;
    }
    return $data['data'][0]['total'];

}

function priceBooster(){
    global $getTap;
    $pertap = $getTap['tap_total'];
    $energy = $getTap['tap_max'];

    $feeUpTap = 100;
    $feeUpMaxTap = 1500;

    return [
        "feeUpTap" => $pertap * $feeUpTap,
        "feeUpEnergy" => $energy * $feeUpMaxTap
    ];
}

function saveSpend($usrID, $descBuyCoin, $fee, $dateNow){
    global $spendCoinTableClass;

    $reportBuyInsert = $spendCoinTableClass->insertSpendCoin(
        fields: "
            spend_coin_id_user,
            spend_coin_desc,
            spend_coin_total,
            spend_coin_date
        ",
        value: "
            '$usrID',
            '$descBuyCoin',
            '$fee',
            '$dateNow'
        "
    );

    return $reportBuyInsert;
}

function getTap(){
    global $tapTableClass;
    $usrID = $_SESSION['userId'];
    $data = $tapTableClass->selectTap(
        fields: "tap_max, tap_total",
        key: "tap_id_user = '$usrID'"
    );

    return $data['data'][0];
}

function getDataUser(){
    global $userTableClass;
    $usrID = $_SESSION['userId'];
    $data = $userTableClass->selectUser(
        fields: "user_balance, user_profit_per_our, user_lvl",
        key: "user_id = '$usrID'"
    );

    return $data['data'][0];
}

function formatAngka($angka) {
    $simbol = ['K', 'M', 'B'];
    $simbol_index = 0;

    // Jika angka kurang dari 1000, kembalikan angka aslinya tanpa desimal
    if ($angka < 1000) {
        return number_format($angka, 0);
    }

    // Selama angka lebih besar dari 1000, bagi dengan 1000 dan naikkan indeks simbol
    while ($angka >= 1000) {
        $angka /= 1000;
        $simbol_index++;
    }

    // Kurangi indeks simbol dengan 1
    $simbol_index--;

    // Format angka dengan 1 desimal, lalu hapus desimal jika bernilai 0
    $formatted = number_format($angka, 1);
    if (substr($formatted, -2) === '.0') {
        $formatted = substr($formatted, 0, -2);
    }

    return $formatted . $simbol[$simbol_index];
}

?>