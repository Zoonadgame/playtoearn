<?php  
    error_reporting(0);
    session_start();
    session_unset();
    session_destroy();
    sleep(2);
    header('Location: ../index');
    exit();
?>