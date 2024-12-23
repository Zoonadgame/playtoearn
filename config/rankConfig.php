<?php  
session_start();
error_reporting(0);

if(!$_SESSION['login_zoo']){
    header('Location: index');
    exit();
}
if(!isset($_GET['level']) || $_GET['level'] == ""){
    header('Location: home');
    exit();
}


require "database/connMySQLClass.php";
require "database/userTableClass.php";
require "database/levelTableClass.php";

$userTableClass = new userTableClass();
$levelTableClass = new levelTableClass();

$level = $_GET['level'];

function getDataUser(){
    global $userTableClass;
    global $level;
    $data = $userTableClass->selectUser(
        fields: "
                user_username AS name,
                user_profit_per_our AS profit
            ",
        key: "user_lvl = '$level' ORDER BY user_profit_per_our DESC, user_username ASC LIMIT 10"
    );

    return $data['data'];
}

function dataLvl(){
    global $levelTableClass;
    global $level;

    $data = $levelTableClass->selectLevel(
        fields: "id AS num, level_name AS name",
        key: "1 ORDER BY id ASC"
    );

    $total = $data['row'];

    $before = "";
    $next = "";
    $number = "";
    foreach($data['data'] as $rows){
        if($rows['name'] == $level){
            $before = $rows['name'] == "Sproutling" ? "none" : $data['data'][$rows['num']-2]['name'];
            $next = $rows['num'] == $total ? "none" : $data['data'][$rows['num']]['name'];
            $number = $rows['num'];
            break;
        }else{
            continue;
        }
    }

    return [
        "total" => $total,
        "before" => $before,
        "number" => $number,
        "next" => $next
    ];
}

function formatAngka($angka){
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
