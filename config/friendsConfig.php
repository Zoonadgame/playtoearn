<?php  
session_start();
error_reporting(0);

if(!$_SESSION['login_zoo']){
    header('Location: index');
    exit();
}

require "database/connMySQLClass.php";
require "database/userTableClass.php";

$userTableClass = new userTableClass();

$getDownline = getDownline();

function getDownline(){
    global $userTableClass;
    $reff = getDataUser()['reff'];

    $data = $userTableClass->selectUser(
        fields: "user_username AS name",
        key: "user_upline = '$reff'"
    );

    return $data;
}

function getDataUser(){
    global $userTableClass;
    $usrID = $_SESSION['userId'];
    $data = $userTableClass->selectUser(
        fields: "user_code_refferal AS reff",
        key: "user_id = '$usrID'"
    );

    return $data['data'][0];
}

?>