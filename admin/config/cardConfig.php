<?php 
session_start();
error_reporting(0);
if(!$_SESSION['login_zoo_admin']){
    header('Location: index');
    exit();
}

require "database/connMySQLClass.php";
require "database/cardTableClass.php";

$cardTableClass = new cardTableClass();

$page = isset($_GET['page']) ? $_GET['page'] : '1'; // number page

$dataTable = dataTable($page);

function dataTable($page){
    global $cardTableClass;
    $start = 6 * ($page - 1);

    $data = $cardTableClass->selectCard(
        fields: "*",
        key: "1 ORDER BY card_date DESC LIMIT $start, 6"
    );

    return $data;
}

function countDataCard(){
    global $cardTableClass;

    $data = $cardTableClass->selectCard(
        fields: "COUNT(id) AS total",
        key: "1"
    );

    return $data['data'][0]['total'];
}

function optValue(){
    global $cardTableClass;
    $data = $cardTableClass->selectCard(
        fields: "card_id, card_name",
        key: "1 ORDER BY card_date DESC"
    );
    return $data;
}

function checkNameCard($name){
    global $cardTableClass;
    $data = $cardTableClass->selectCard(
        fields: "card_id",
        key: "card_name = '$name'"
    );
    return $data['row'];
}

function createIDCard(){
    global $cardTableClass;

    $id = substr(md5(uniqid(rand(), true)), 0, 7);

    $check = $cardTableClass->selectCard(fields: "card_id", key: "card_id = '$id' LIMIT 1");

    if($check['row'] > 0){
        return createIDCard();
    }else{
        return $id;
    }
}

if (isset($_POST['saveCard'])) {
    $nameCard = htmlspecialchars(trim($_POST['name']));
    $descName = htmlspecialchars(trim($_POST['descName']));
    $categoryCard = htmlspecialchars(trim($_POST['category']));
    $startfee = htmlspecialchars(trim($_POST['startfee']));
    $profitpersen = htmlspecialchars(trim($_POST['profitpersen']));
    $upfeepersen = htmlspecialchars(trim($_POST['upfeepersen']));
    $unlock = htmlspecialchars(trim($_POST['unlock']));
    $cd = htmlspecialchars(trim($_POST['cd']));

    // Mengecek apakah ada inputan yang kosong
    if (
        empty($nameCard) || 
        empty($descName) || 
        empty($categoryCard) || 
        empty($startfee) || 
        empty($profitpersen) || 
        empty($cd) || 
        empty($upfeepersen)
    ) {
        $_SESSION['alert_error'] = "Data input tidak boleh kosong.";
        header('Location: card');
        exit();
    }

    // Jika unlock tidak NONE
    $errorInput = false;
    $otCdDetail = "NONE";
    $otCdId = "NONE";
    $lvlCard = 0;
    if ($unlock != "NONE") {
        if($unlock == "OWNED OTHER CARD"){
            $otCd = htmlspecialchars(trim($_POST['otCd']));
            $lvlCard = htmlspecialchars(trim($_POST['lvlCard']));
            if (
                empty($otCd) || 
                empty($lvlCard)
            ) {
                $errorInput = true;
            }else{
                $otCdDetail = explode(".", $otCd)[1];
                $otCdId = explode(".", $otCd)[0];
            }
        }elseif($unlock == "STREAK LOGIN"){
            $lvlCard = htmlspecialchars(trim($_POST['lvlCard']));
            if (
                empty($lvlCard)
            ) {
                $errorInput = true;
            }
        }
    }

    if (!$errorInput) {
        if(checkNameCard($nameCard) > 0){
            sleep(1);
            $_SESSION['alert_error'] = "Card sudah ada.";
            header('Location: card');
            exit();
        }else{
            sleep(1);
            // Validasi file
            if (!isset($_FILES['img']) || $_FILES['img']['error'] != UPLOAD_ERR_OK) {
                $_SESSION['alert_error'] = "File gambar wajib diunggah.";
                header('Location: card');
                exit();
            }
    
            $file = $_FILES['img'];
            $fileName = $file['name'];
            $fileTmp = $file['tmp_name'];
            $fileSize = $file['size'];
            $fileError = $file['error'];
            $fileExt = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
    
            // Cek ekstensi file
            if ($fileExt !== 'png') {
                $_SESSION['alert_error'] = "File harus berformat PNG.";
                header('Location: card');
                exit();
            }
    
            // Cek ukuran file (contoh: maksimal 2MB)
            if ($fileSize > 2 * 1024 * 1024) {
                $_SESSION['alert_error'] = "Ukuran file maksimal 2MB.";
                header('Location: card');
                exit();
            }
    
            // Folder tujuan upload
            $uploadDir = '../assets/img/card/';
            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0777, true);
            }
    
            // Format nama file dari $nameCard
            $safeNameCard = preg_replace('/[^a-zA-Z0-9_-]/', '_', $nameCard); // Ganti karakter tak valid
            $uniqueFileName = $safeNameCard . '.' . $fileExt; // Gunakan nama $nameCard sebagai nama file
            $uploadPath = $uploadDir . $uniqueFileName;
            $savePath = 'assets/img/card/' . $uniqueFileName;
            
            // Proses upload file
            if (!move_uploaded_file($fileTmp, $uploadPath)) {
                $_SESSION['alert_error'] = "Gagal mengunggah file.";
                header('Location: card');
                exit();
            }
            $profitpersen /= 100;
            $upfeepersen /= 100;
            $cd *= 1000;
            
            $idCard = createIDCard();
            $dateNow = round(microtime(true) * 1000);
            $setCard = $cardTableClass->insertCard(
                fields: "
                    card_id,
                    card_img,
                    card_name,
                    card_desc,
                    card_category,
                    card_profit,
                    card_start_fee,
                    card_up_fee,
                    card_category_unlock,
                    card_unlock_detail,
                    card_unlock_id,
                    card_unlock_num_condition,
                    card_duration_countdown,
                    card_date
                ",
                value: "
                    '$idCard',
                    '$savePath',
                    '$nameCard',
                    '$descName',
                    '$categoryCard',
                    '$profitpersen',
                    '$startfee',
                    '$upfeepersen',
                    '$unlock',
                    '$otCdDetail',
                    '$otCdId',
                    '$lvlCard',
                    '$cd',
                    '$dateNow'
                "
            );
            $_SESSION['alert_success'] = "Data berhasil disimpan.";
            header('Location: card');
            exit();
        }
    } else {
        sleep(1);
        $_SESSION['alert_error'] = ">Data input tidak boleh kosong.";
        header('Location: card');
        exit();
    }
}

?>