<?php
session_start();
error_reporting(0);

require "database/connMySQLClass.php";
require "database/getCoinTableClass.php";
require "database/rewardDailyLoginTableClass.php";
require "database/dailyLoginUserTableClass.php";
require "database/historyTonTableClass.php";

$getCoinTableClass = new getCoinTableClass();
$rewardDailyLoginTableClass = new rewardDailyLoginTableClass();
$dailyLoginUserTableClass = new dailyLoginUserTableClass();
$historyTonTableClass = new historyTonTableClass();

$currentDate = round(microtime(true) * 1000);

$checkStreakLogin = checkStreakLogin();
$getReward = getReward();

function checkStreakLogin(){
    global $dailyLoginUserTableClass;
    global $currentDate;
    $usrID = $_SESSION['userId'];

    $data = $dailyLoginUserTableClass->selectDailyLogin(
        fields: "daily_login_streak, daily_login_last_date",
        key: "daily_login_id_user = '$usrID'"
    );

    $streakDays = 1;
    $lastLogin = 0;
    if($data['row'] > 0){
        $lastLogin = $data['data'][0]['daily_login_last_date'];
        $streakDays = $data['data'][0]['daily_login_streak'];

        $oneDayMillis = 86400000;
        
        // Cek selisih hari
        $dateDiff = $currentDate - $lastLogin;
        if($dateDiff <= $oneDayMillis){
           $streakDays += 1;
           if($streakDays > 15){
               $streakDays = 1;
               if($currentDate >= $lastLogin){
                   $lastLogin = 0;
                   $dailyLoginUserTableClass->deleteDailyLogin(
                       key: "daily_login_id_user = '$usrID'"
                   );
               }
            }
        }else{
            $streakDays = 1;
            $lastLogin = 0;
            $dailyLoginUserTableClass->deleteDailyLogin(
                key: "daily_login_id_user = '$usrID'"
            );
        }
    }

    return [
        "streakDays" => $streakDays,
        "lastLogin" => $lastLogin
    ];
}

function getReward(){
    global $rewardDailyLoginTableClass;
    global $checkStreakLogin;

    $day = $checkStreakLogin['streakDays'];

    $data = $rewardDailyLoginTableClass->selectDailyRewardLogin(
        fields: "reward_login_fee AS fee",
        key: "reward_login_day = '$day'"
    );

    return $data['data'][0]['fee'];
}

function saveTon($user, $total, $desc, $date){
    global $historyTonTableClass;

    $insert = $historyTonTableClass->insertGetTon(
        fields: "ton_id_user, ton_desc, ton_total, ton_date",
        value: "'$user', '$desc', '$total', '$date'"
    );
}

header('Content-Type: application/json');
$data = json_decode(file_get_contents('php://input'), true);
if($currentDate > $checkStreakLogin['lastLogin']){
    $usrID = $_SESSION['userId'];
    $descGetCoin = "Get Coin from daily login day " . $checkStreakLogin['streakDays'];
    $insertGetCoin = $getCoinTableClass->insertGetCoin(
        fields: "get_coin_id_user, get_coin_desc, get_coin_total, get_coin_date",
        value: "'$usrID', '$descGetCoin', '$getReward', '$currentDate'"
    );
    if($insertGetCoin){
        $dayss = $checkStreakLogin['streakDays'];
        if($checkStreakLogin['streakDays'] == 1){
            $dateNext = $currentDate + 86400000;
            $insertLogin = $dailyLoginUserTableClass->insertDailyLogin(
                fields: "daily_login_id_user, daily_login_streak, daily_login_last_date",
                value: "'$usrID', '$dayss', '$dateNext'"
            );
        }else{
            $dateNext = $checkStreakLogin['lastLogin'] + 86400000;
            $updateLogin = $dailyLoginUserTableClass->updateDailyLogin(
                dataSet: "daily_login_streak = '$dayss', daily_login_last_date = '$dateNext'",
                key: "daily_login_id_user = '$usrID'"
            );
        }
        saveTon($usrID, 0.007, "Daily Login", $currentDate);
        echo json_encode(['success' => true]); // atau ['success' => false]
    }
}else{
    echo json_encode(['success' => false]); // atau ['success' => false]

}

?>
