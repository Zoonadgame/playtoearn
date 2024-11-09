<?php  
session_start();
error_reporting(0);

if(!$_SESSION['login_zoo']){
    header('Location: index');
    exit();
}

require "database/connMySQLClass.php";
require "database/getCoinTableClass.php";
require "database/rewardDailyLoginTableClass.php";
require "database/dailyLoginUserTableClass.php";
require "database/taskDataTableClass.php";
require "database/userDoneTaskTableClass.php";

$getCoinTableClass = new getCoinTableClass();
$rewardDailyLoginTableClass = new rewardDailyLoginTableClass();
$dailyLoginUserTableClass = new dailyLoginUserTableClass();
$taskDataTableClass = new taskDataTableClass();
$userDoneTaskTableClass = new userDoneTaskTableClass();

$currentDate = round(microtime(true) * 1000);

$checkStreakLogin = checkStreakLogin();
$getReward = getReward();

if(isset($_POST['visit'])){
    $usrID = $_SESSION['userId'];
    $idPost = $_POST['idDailyTasskk'];
    $dataPostDaily = $taskDataTableClass->selectTaskData(
        fields: "
            task_name,
            task_reward
        ",
        key: "task_id = '$idPost'"
    );
    if($dataPostDaily['row'] > 0){
        $taskReward = $dataPostDaily['data'][0]['task_reward'];
        $inserDoneTask = $userDoneTaskTableClass->insertTaskDoneData(
            fields: "task_id, user_id",
            value: "'$idPost', '$usrID'"
        );
        if($inserDoneTask){
            $descGetCoin = "Get Coin from daily - " . $dataPostDaily['data'][0]['task_name'];
            $inserCoinUser = $getCoinTableClass->insertGetCoin(
                fields: "get_coin_id_user, get_coin_desc, get_coin_total, get_coin_date",
                value: "'$usrID', '$descGetCoin', '$taskReward', '$currentDate'"
            );
            if($inserCoinUser){
                sleep(1);
                $_SESSION['alert_success'] = "Claim Success";
                header("Location: earn");
                exit();
            }
        }
    }else{
        sleep(1);
        $_SESSION['alert_error'] = "Error";
        header("Location: earn");
        exit();

    }
}

if(isset($_POST['claimDailyLogin'])){
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
            sleep(1);
            $_SESSION['alert_success'] = "Claim Success";
            header("Location: earn");
            exit();
        }
    }else{
        sleep(1);
        $_SESSION['alert_error'] = "Comeback Tomorrow";
        header("Location: earn");
        exit();
    }
}

function getDailyTask($kat){
    global $taskDataTableClass;

    $data = $taskDataTableClass->selectTaskData(
        fields: "
            task_id,
            task_name,
            task_icon,
            task_desk,
            task_type,
            task_condition,
            task_reward,
            task_date_create,
            task_date_expired
        ",
        key: "task_category = '$kat'"
    );
    $result = array();
    foreach($data['data'] as $val){
        if(checkDailyTask($val['task_id']) == 0){
            $result[] = $val;
        }
    }

    return $result;
}

function checkDailyTask($idTask){
    global $userDoneTaskTableClass;
    $usrID = $_SESSION['userId'];

    $data = $userDoneTaskTableClass->selectTaskDoneData(
        fields: "id",
        key: "task_id = '$idTask' AND user_id = '$usrID'"
    );

    return $data['row'];
}

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
               $lastLogin = 0;
               $dailyLoginUserTableClass->deleteDailyLogin(
                   key: "daily_login_id_user = '$usrID'"
               );
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
?>