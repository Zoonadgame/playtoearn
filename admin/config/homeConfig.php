<?php  
    session_start();
    error_reporting(0);
    if(!$_SESSION['login_zoo_admin']){
        header('Location: index');
        exit();
    }

    require "database/connMySQLClass.php";
    require "database/historyTonTableClass.php";

    $historyTonTableClass = new historyTonTableClass();

    function totalTon(){
        global $historyTonTableClass;

        $data = $historyTonTableClass->selectGetTon(
            fields: "SUM(ton_total) AS total",
            key: "1"
        )['data'][0];

        return $data['total'];
    }
?>