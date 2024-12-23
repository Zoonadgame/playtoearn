<?php  
session_start();
error_reporting(0);

require "database/connMySQLClass.php";
require "database/userTableClass.php";
require "database/tapTableClass.php";
require "database/getCoinTableClass.php";

$userTableClass = new userTableClass();
$tapTableClass = new tapTableClass();
$getCoinTableClass = new getCoinTableClass();

function isMobileDevice() {
    $userAgent = strtolower($_SERVER['HTTP_USER_AGENT']);
    $mobileAgents = ['iphone', 'ipod', 'android', 'blackberry', 'webos', 'windows phone', 'symbian', 'opera mini', 'opera mobi'];

    foreach ($mobileAgents as $agent) {
        if (strpos($userAgent, $agent) !== false) {
            return true;
        }
    }
    return false;
}

if (strpos(strtolower($_SERVER['HTTP_USER_AGENT']), 'windows') !== false) {
    header('Location: index');
    exit();
} else {
    $key_bot = "bot token";
    $user_balance = 0;
    $last_coin = 0;
    
    if(isset($_GET["key"]) && isset($_GET["user_id"])){
        if($key_bot == $_GET["key"]){
            $userId = trim(htmlspecialchars($_GET["user_id"], ENT_QUOTES));
            $username = $_GET["username"] == "" ? "none" :  preg_replace('/\s+/', '',$_GET["username"]);
    
            // check data
            $dataUser = $userTableClass->loginMember($userId);
            if($dataUser['num'] > 0){
                $_SESSION["userId"] = $userId;
                $_SESSION["usernameDB"] = $dataUser['username'];
                $_SESSION["codeReff"] = $dataUser['code_reff'];
                $user_balance = $dataUser['user_balance'];
                $userprofitperHour = $dataUser['user_profit_per_our'];
                $user_last_date = $dataUser['user_last_date'];
                $user_max_date_offline = $dataUser['user_max_date_offline'];
                $dateMilisNow = round(microtime(true) * 1000);
                $rangeOffline = $dateMilisNow - $user_last_date;
                if($userprofitperHour > 0){
                    if($rangeOffline > $user_max_date_offline){
                        $rangeOffline = $user_max_date_offline;
                    }
                    $profitPerMiliSecond = $userprofitperHour / 3600000;
                    $totalProfitOffline = $profitPerMiliSecond * $rangeOffline;
                    $descGetCoin = "Get Coin from Mining";
                    $insertGetCoin = $getCoinTableClass->insertGetCoin(
                        fields: "get_coin_id_user, get_coin_desc, get_coin_total, get_coin_date",
                        value: "'$userId', '$descGetCoin', '$totalProfitOffline', '$dateMilisNow'"
                    );
                }
                // update username
                if($_SESSION['usernameDB'] != $username){
                    $updateUsername = $userTableClass->updateUser(
                        dataSet: "user_username = '$username'",
                        key: "user_id = '$userId'"
                    );
                    if($updateUsername){
                        $_SESSION["usernameDB"] = $username;
                    }
                }
                $getLastCoin = $tapTableClass->selectTap(
                    fields: "tap_max, tap_last",
                    key: "tap_id_user = '$userId'"
                );
                $max_tap_coin = $getLastCoin['data']['0']['tap_max'];
                $regenEnergyPerMilis = 0.001;
                $totalEnergy = floor($getLastCoin['data']['0']['tap_last'] + ($regenEnergyPerMilis * $rangeOffline));
                $last_coin = $totalEnergy;
                if($totalEnergy > $max_tap_coin){
                    $last_coin = $max_tap_coin;
                }
                sleep(1);
                $_SESSION['login_zoo'] = true;
            }else{
                $upline_reff = isset($_GET["ref"]) ? $_GET["ref"] : "NONE";
                $dateNow = round(microtime(true) * 1000);
                $refferalUser = createRefferalCode();
                $register = $userTableClass->insertUser(
                    fields: "user_id, user_username, user_code_refferal, user_upline, user_date",
                    value: "'$userId', '$username', '$refferalUser', '$upline_reff', '$dateNow'"
                );
                if($register){
                    $regisTap = $tapTableClass->insertTap(
                        fields: "tap_id_user",
                        value: "'$userId'"
                    );
                    if($regisTap){
                        $getLastCoin = $tapTableClass->selectTap(
                            fields: "tap_last",
                            key: "tap_id_user = '$userId'"
                        );
                        $last_coin = $getLastCoin['data']['0']['tap_last'];
                    }
                    if($upline_reff != "NONE"){
                        $dataUplineMember = $userTableClass->selectUser(
                            fields: "user_id",
                            key: "user_code_refferal = '$upline_reff'"
                        );
                        if($dataUplineMember['row'] > 0){
                            $idUpline = $dataUplineMember['data'][0]['user_id'];
                            $descGetCoinUpline = "Get Coin from inv friend (" . $username . ")";
                            $insertGetCoinUpline = $getCoinTableClass->insertGetCoin(
                                fields: "get_coin_id_user, get_coin_desc, get_coin_total, get_coin_date",
                                value: "'$idUpline', '$descGetCoinUpline', '50000', '$dateNow'"
                            );
                            $$descGetCoin = "Get Coin from referral code";
                            $insertGetCoin = $getCoinTableClass->insertGetCoin(
                                fields: "get_coin_id_user, get_coin_desc, get_coin_total, get_coin_date",
                                value: "'$userId', '$descGetCoin', '20000', '$dateNow'"
                            );
                        }
                    }
                    $_SESSION["userId"] = $userId;
                    $_SESSION["usernameDB"] = $username;
                    $_SESSION["codeReff"] = $refferalUser;
                    $_SESSION['login_zoo'] = true;
                }else{
                    header('Location: index');
                    exit();
                }
            }
        }else{
            header('Location: index');
            exit();
        }
    }else{
        header('Location: index');
        exit();
    }    
}




// Fungsi untuk membuat kode refferal unik
function createRefferalCode() {
    global $userTableClass;

    $referal = substr(md5(uniqid(rand(), true)), 0, 11);

    $check = $userTableClass->selectUser(
        fields: "user_code_refferal",
        key: "user_code_refferal = '$referal' LIMIT 1"
    );

    if($check['row'] > 0){
        return createRefferalCode();
    }else{
        return $referal;
    }
}

?>