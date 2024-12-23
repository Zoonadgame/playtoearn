<?php  
session_start();
error_reporting(0);
if($_SESSION['login_zoo_admin']){
    header('Location: home');
    exit();
}

$usernameAdmin = "123";
$passwordAmdin = password_hash("123", PASSWORD_DEFAULT);


if(isset($_POST['loginAdmin'])){
    $username = trim(htmlspecialchars($_POST['username']));
    $password = trim(htmlspecialchars($_POST['password']));
    if($username != "" && $password != ""){
        if($username == $usernameAdmin){
            if(password_verify($password, $passwordAmdin)){
                $_SESSION['login_zoo_admin'] = true;
                $_SESSION['alert_success'] = "Login successfully!";
                sleep(2);
                header('Location: home');
                exit();
            }else{
                $_SESSION['alert_error'] = "username or password is wrong!";
                sleep(2);
                header('Location: index');
                exit();
            }
        }else{
            $_SESSION['alert_error'] = "username or password is wrong!";
            sleep(2);
            header('Location: index');
            exit();
        }
    }else{
        $_SESSION['alert_error'] = "username or password is wrong!";
        sleep(2);
        header('Location: index');
        exit();

    }
}
?>