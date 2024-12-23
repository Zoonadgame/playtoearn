<?php require "config/mineConfig.php" ?>
<!doctype html>
<html lang="en">

<head>
    <?php include "partial/head.php" ?>
    <title>Zoonad | Mine</title>
    <style>
        .main {
            border-radius: 35px;
            border-radius: 35px 35px 0px 0px;
            -webkit-border-radius: 35px 35px 0px 0px;
            -moz-border-radius: 35px 35px 0px 0px;
            box-shadow: 2px -15px 18px -3px rgba(222,64,189,0.39);
            -webkit-box-shadow: 2px -15px 18px -3px rgba(222,64,189,0.39);
            -moz-box-shadow: 2px -15px 18px -3px rgba(222,64,189,0.39);
            border-top: 2px solid #ff2ca9;
            height: auto;
            background: #202022;
        }
        .box-info{
            background-color: rgba(255, 255, 255, 0.1);
            padding: 1px;
            border-radius: 100px 100px 100px 100px;
            -webkit-border-radius: 100px 100px 100px 100px;
            -moz-border-radius: 100px 100px 100px 100px;
        }
        .box-info img{
            min-width: 10px;
            max-width: 15px;
        }

        .bg-nav{
            background-color: rgba(255, 255, 255, 0.1);
            padding: 1px;
            border-radius: 100px 100px 100px 100px;
            -webkit-border-radius: 100px 100px 100px 100px;
            -moz-border-radius: 100px 100px 100px 100px;
        }


        .modal .modal-dialog .modal-content{
            border-radius: 35px;
            border-radius: 35px 35px 0px 0px;
            -webkit-border-radius: 35px 35px 0px 0px;
            -moz-border-radius: 35px 35px 0px 0px;
            box-shadow: 2px -15px 18px -3px rgba(222,64,189,0.39);
            -webkit-box-shadow: 2px -15px 18px -3px rgba(222,64,189,0.39);
            -moz-box-shadow: 2px -15px 18px -3px rgba(222,64,189,0.39);
            border-top: 2px solid #ff2ca9;
        }
        .modal .modal-dialog .modal-content .modal-header{
            /* padding: 2px; */
            border: 0;
        }

        .modal .modal-dialog .modal-content .modal-body button{
            
            background-color: rgba(255, 255, 255, 0.1);
        }
        
        .modal .modal-dialog .modal-content .modal-header button{
            background-color: rgba(255, 255, 255, 0.1);
            border-radius: 200px 200px 200px 200px;
            -webkit-border-radius: 200px 200px 200px 200px;
            -moz-border-radius: 200px 200px 200px 200px;
        }
        
        
    </style>
    <link rel="stylesheet" href="assets/css/custome.css">
</head>

<body>

    <!-- loader -->
    <div id="loader">
        <img src="assets/img/loading-icon.png" alt="icon" class="loading-icon">
    </div>
    <!-- * loader -->

    <!-- App Capsule -->
    <div id="appCapsule mt-0">

    
        <div class="section full">
            <div class="row">
                <div class="col-5 p-2 text-start">
                    <!-- LVL -->
                    <div class="row">
                        <!-- label lvl -->
                        <div class="col text-start">
                            <span class="text-white" style="font-size: 0.4rem;"><?= $autoUpLvl['nameLvl'] ?></span>
                        </div>
                        <!-- num lvl -->
                        <div class="col text-end">
                            <span class="text-white" style="font-size: 0.4rem;">Level <?= $autoUpLvl['numLvl'] ?>/11</span>
                        </div>
                    </div>
                    <!-- lvl progress -->
                    <div class="progress" style="height: 5px;">
                        <div class="progress-bar" role="progressbar" style="width: <?= number_format($autoUpLvl['progress']) ?>%; background-color: #ff2ca9;" aria-valuenow="25"
                            aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                </div>
                <div class="col-7 p-2 text-end">
                    <div class="box-info text-center">
                        <span class="text-white"  style="font-size: 0.7rem;">Profit per hour</span> | 
                        <img src="assets/img/bl.svg" alt="" >
                        <span class="text-white"  style="font-size: 0.7rem;">+<?= formatAngka($getDataUser['user_profit_per_our']) ?></span>
                    </div>
                </div>
            </div>
        </div>

        <div class="section full">
            <div class="card main">
                <div class="card-body">

                    <!-- category -->
                    <div class="bg-nav mt-2">
                        <div class="btn-group" role="group" style="width: 100%;">
                            <input type="radio" class="btn-check" name="categoryCard" id="categoryCardsatu" <?= $_SESSION['cat_tem'] == "1" || $_SESSION['cat_tem'] == "" ? "checked" : ""  ?>>
                            <label class="btn btn-outline-danger border-0" for="categoryCardsatu">Tech Upgrade</label>
    
                            <input type="radio" class="btn-check" name="categoryCard" id="categoryCarddua" <?= $_SESSION['cat_tem'] == "2" ? "checked" : ""  ?>>
                            <label class="btn btn-outline-danger border-0" for="categoryCarddua">Market</label>
    
                            <input type="radio" class="btn-check" name="categoryCard" id="categoryCardtiga" <?= $_SESSION['cat_tem'] == "3" ? "checked" : ""  ?>>
                            <label class="btn btn-outline-danger border-0" for="categoryCardtiga">Special Power</label>
                        </div>
                    </div>
                    <?php $dateMiliNow = round(microtime(true) * 1000); $checkStreakLogin = checkStreakLogin()['streakDays'] - 1; ?>
                    <script>
                        function loadingForm() {
                            // Mengatur tombol menjadi tidak dapat di-klik selama proses loading
                            document.getElementById("loader").style.display  = "";
                        }
                    </script>
                    <div class="row g-0 mt-5 mb-4 category-section" id="category_satu">
                        <?php  
                            foreach($getCardSatu as $cardData){
                                $cardOwned = getCardOwned($cardData['card_id']);
                                $startFee = $cardData['card_start_fee'];
                                $card_duration_countdown = $cardData['card_duration_countdown'];
                                $fee = $startFee;
                                $jumlah = 0;
                                $card_owned_upgrade_date = 0;
                                if($cardOwned['row'] > 0){
                                    $jumlah = $cardOwned['data'][0]['card_owned_lvl'];
                                    $persenToUp = $cardData['card_up_fee'] * ($jumlah + 1);
                                    $fee += $startFee * $persenToUp;
                                    $card_owned_upgrade_date = $cardOwned['data'][0]['card_owned_upgrade_date'];
                                    $card_duration_countdown *= ($jumlah * 1.3);

                                }
                                $profit = $fee * $cardData['card_profit'];
                                $endCountDown = $card_owned_upgrade_date + $card_duration_countdown;
                                $textFee = '<img class="icon-coin" src="assets/img/coin-dark.svg" alt=""> ' . formatAngka($fee);
                                $textFeeModal = '<img class="icon-coin" src="assets/img/coin-dark.svg" alt=""> ' . number_format($fee);
                                if($jumlah > 0){
                                    $textFee = '<img class="icon-coin" src="assets/img/coin.svg" alt=""> ' . formatAngka($fee);
                                    $textFeeModal = '<img class="icon-coin" src="assets/img/coin.svg" alt=""> ' . number_format($fee);
                                }
                                $lock = false;
                                if($jumlah >= 15){
                                    $lock = true;
                                    $textFee = " Level Max ";
                                    $textFeeModal = " Level Max ";
                                }else{
                                    if($cardData['card_category_unlock'] != "NONE"){
                                        $lock = true;
                                        if($cardData['card_category_unlock'] == "OWNED OTHER CARD"){
                                            $cardOwnedOther = getCardOwned($cardData['card_unlock_id']);
                                            if($cardOwnedOther['row'] > 0){
                                                $lvlUnlock = $cardData['card_unlock_num_condition'];
                                                $lvlOtherCard =  $cardOwnedOther['data'][0]['card_owned_lvl'];
                                                if($lvlUnlock > $lvlOtherCard){
                                                    $textFee = ucwords($cardData['card_unlock_detail']) . " Lvl " . $cardData['card_unlock_num_condition'];
                                                    $textFeeModal = ucwords($cardData['card_unlock_detail']) . " Lvl " . $cardData['card_unlock_num_condition'];
                                                }else{
                                                    $lock = false;
                                                }
                                            }else{
                                                $textFee = ucwords($cardData['card_unlock_detail']) . " Lvl " . $cardData['card_unlock_num_condition'];
                                                $textFeeModal = ucwords($cardData['card_unlock_detail']) . " Lvl " . $cardData['card_unlock_num_condition'];
                                            }
                                        }elseif($cardData['card_category_unlock'] == "STREAK LOGIN"){
                                            if($jumlah == 0){
                                                $lvlUnlock = $cardData['card_unlock_num_condition'];
                                                if($lvlUnlock > $checkStreakLogin){
                                                    $textFee = "Requires " . $cardData['card_unlock_num_condition'] . " Daily Login Streak!";
                                                    $textFeeModal = "Requires " . $cardData['card_unlock_num_condition'] . " Daily Login Streak!";
                                                }else{
                                                    $lock = false;
                                                }
                                            }else{
                                                $lock = false;
                                            }
                                        }
                                    }
                                }
                        ?>
                        <a data-bs-toggle="modal" data-bs-target="#actionSheet<?= $cardData['card_id'] ?>" class="col-6 mb-3">
                            <div class="card-mine text-center">
                                <div class="card-mine-body">
                                    <div class="title-img mb-1">
                                        <?php if($lock){ ?>
                                        <img class="card-mine-img-cover mb-2" src="assets/img/card/lock.png" alt="locked">
                                        <?php } ?>
                                        <img class="card-mine-img mb-2" src="<?= $cardData['card_img'] ?>" alt="elon">
                                        <h6 class="text-white"><?= ucwords($cardData['card_name']) ?></h6>
                                    </div>
                                    <div class="card-mine-profit">
                                        <span class="text-white">Profit per hour</span> 
                                        <img class="icon-coin" src="assets/img/coin-dark.svg" alt="">
                                        <span class="text-muted">+<?= formatAngka($profit) ?></span>
                                    </div>
                                </div>
                                <div class="card-mine-footer">
                                    <div class="card-lvl text-<?= $jumlah > 0 ? "white" : "muted" ?>">Lvl <?= number_format($jumlah) ?></div>
                                    <div class="card-fee text-<?= $jumlah > 0 ? "white" : "muted" ?>">
                                        <?= $textFee ?>
                                    </div>
                                </div>
                            </div>
                        </a>
                        <!-- Default Action Sheet -->
                        <div class="modal fade action-sheet" id="actionSheet<?= $cardData['card_id'] ?>" tabindex="-1" role="dialog">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content bg-black">
                                    <div class="modal-header text-end">
                                        <button type="button" data-bs-dismiss="modal" class="btn btn-icon text-white me-1 mt-3 mb-1">
                                            <ion-icon name="close-outline"></ion-icon>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="action-sheet-content">
                                            
                                            <div class="mb-3 text-center">
                                                <?php if($lock){ ?>
                                                <img class="card-mine-img-cover mb-2" src="assets/img/card/lock.png" alt="locked">
                                                <?php } ?>
                                                <img class="card-mine-img mb-2" src="<?= $cardData['card_img'] ?>" alt="elon">
                                                <h3 class="text-white"><?= ucwords($cardData['card_name']) ?></h3>
                                                <p style="font-size: small;"><?= $cardData['card_desc'] ?></p>
                                                <p>Profit per hour</p>
                                                <span class="fee"><img class="icon-coin" src="assets/img/coin.png" alt=""> +<?= number_format($profit) ?></span>
                                            </div>
                                            
                                            <form method="post" action="" class="form-group basic">
                                                <input type="hidden" name="idCard" value="<?= $cardData['card_id'] ?>">
                                                <?php if(!$lock && $dateMiliNow < $endCountDown){ ?>
                                                
                                                <button type="button" disabled onclick="loadingForm()" name="buyCard" id="actionButtonSatu<?= $cardData['card_id'] ?>" class="btn btn-block btn-lg text-white"
                                                    data-bs-dismiss="modal">
                                                    <span class="card-fee-modal" id="textCountDownSatu<?= $cardData['card_id'] ?>">
                                                    </span>
                                                    <span class="card-fee-modal" id="textFeeSatu<?= $cardData['card_id'] ?>" style="display: none;">
                                                        <?= $textFeeModal ?>
                                                    </span>
                                                </button>
                                                <script>
                                                    (function() {
                                                        const endTime = <?= $endCountDown ?>;
                                                        const button = document.getElementById("actionButtonSatu<?= $cardData['card_id'] ?>");
                                                        const textCountDown = document.getElementById("textCountDownSatu<?= $cardData['card_id'] ?>");
                                                        const textFee = document.getElementById("textFeeSatu<?= $cardData['card_id'] ?>");

                                                        function updateCountdown() {
                                                            const now = Date.now();
                                                            const timeLeft = endTime - now;

                                                            if (timeLeft <= 0) {
                                                                textCountDown.style.display = "none";
                                                                textFee.style.display = "";
                                                                button.type = "submit";
                                                                button.classList.add("btn-pink");
                                                                button.disabled = false;
                                                                clearInterval(countdownInterval);
                                                                return;
                                                            }

                                                            const hours = Math.floor((timeLeft / (1000 * 60 * 60)) % 24);
                                                            const minutes = Math.floor((timeLeft / (1000 * 60)) % 60);
                                                            const seconds = Math.floor((timeLeft / 1000) % 60);

                                                            textCountDown.innerHTML = `${hours.toString().padStart(2, '0')}:${minutes.toString().padStart(2, '0')}:${seconds.toString().padStart(2, '0')}`;
                                                        }

                                                        const countdownInterval = setInterval(updateCountdown, 1000);
                                                        updateCountdown();
                                                    })();

                                                </script>
                                                <?php }else{ ?>
                                                <button type="<?= $lock ? 'button' : 'submit' ?>" <?= $lock ? 'disabled' :  'onclick="loadingForm()"' ?> name="buyCard" class="btn btn-block <?= $lock ? '' : 'btn-pink' ?> btn-lg text-white"
                                                    data-bs-dismiss="modal">
                                                    <span class="card-fee-modal">
                                                        <?= $textFeeModal ?>
                                                    </span>
                                                </button>
                                                <?php } ?>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- * Default Action Sheet -->
                        <?php } ?>
                    </div>
                    <div class="row g-0 mt-5 mb-4 category-section" id="category_dua" style="display: none;">
                        <?php  
                            foreach($getCardDua as $cardData){
                                $cardOwned = getCardOwned($cardData['card_id']);
                                $startFee = $cardData['card_start_fee'];
                                $card_duration_countdown = $cardData['card_duration_countdown'];
                                $fee = $startFee;
                                $jumlah = 0;
                                $card_owned_upgrade_date = 0;
                                if($cardOwned['row'] > 0){
                                    $jumlah = $cardOwned['data'][0]['card_owned_lvl'];
                                    $persenToUp = $cardData['card_up_fee'] * ($jumlah + 1);
                                    $fee += $startFee * $persenToUp;
                                    $card_owned_upgrade_date = $cardOwned['data'][0]['card_owned_upgrade_date'];
                                    $card_duration_countdown *= ($jumlah * 1.3);
                                }
                                $profit = $fee * $cardData['card_profit'];
                                $endCountDown = $card_owned_upgrade_date + $card_duration_countdown;
                                $textFee = '<img class="icon-coin" src="assets/img/coin-dark.svg" alt=""> ' . formatAngka($fee);
                                $textFeeModal = '<img class="icon-coin" src="assets/img/coin-dark.svg" alt=""> ' . number_format($fee);
                                if($jumlah > 0){
                                    $textFee = '<img class="icon-coin" src="assets/img/coin.svg" alt=""> ' . formatAngka($fee);
                                    $textFeeModal = '<img class="icon-coin" src="assets/img/coin.svg" alt=""> ' . number_format($fee);
                                }
                                $lock = false;
                                if($jumlah >= 15){
                                    $lock = true;
                                    $textFee = " Level Max ";
                                    $textFeeModal = " Level Max ";
                                }else{
                                    if($cardData['card_category_unlock'] != "NONE"){
                                        $lock = true;
                                        if($cardData['card_category_unlock'] == "OWNED OTHER CARD"){
                                            $cardOwnedOther = getCardOwned($cardData['card_unlock_id']);
                                            if($cardOwnedOther['row'] > 0){
                                                $lvlUnlock = $cardData['card_unlock_num_condition'];
                                                $lvlOtherCard =  $cardOwnedOther['data'][0]['card_owned_lvl'];
                                                if($lvlUnlock > $lvlOtherCard){
                                                    $textFee = ucwords($cardData['card_unlock_detail']) . " Lvl " . $cardData['card_unlock_num_condition'];
                                                    $textFeeModal = ucwords($cardData['card_unlock_detail']) . " Lvl " . $cardData['card_unlock_num_condition'];
                                                }else{
                                                    $lock = false;
                                                }
                                            }else{
                                                $textFee = ucwords($cardData['card_unlock_detail']) . " Lvl " . $cardData['card_unlock_num_condition'];
                                                $textFeeModal = ucwords($cardData['card_unlock_detail']) . " Lvl " . $cardData['card_unlock_num_condition'];
                                            }
                                        }elseif($cardData['card_category_unlock'] == "STREAK LOGIN"){
                                            if($jumlah == 0){
                                                $lvlUnlock = $cardData['card_unlock_num_condition'];
                                                if($lvlUnlock > $checkStreakLogin){
                                                    $textFee = "Requires " . $cardData['card_unlock_num_condition'] . " Daily Login Streak!";
                                                    $textFeeModal = "Requires " . $cardData['card_unlock_num_condition'] . " Daily Login Streak!";
                                                }else{
                                                    $lock = false;
                                                }
                                            }else{
                                                $lock = false;
                                            }
                                        }
                                    }
                                }
                        ?>
                        <a data-bs-toggle="modal" data-bs-target="#actionSheet<?= $cardData['card_id'] ?>" class="col-6 mb-3">
                            <div class="card-mine text-center">
                                <div class="card-mine-body">
                                    <div class="title-img mb-1">
                                        <?php if($lock){ ?>
                                        <img class="card-mine-img-cover mb-2" src="assets/img/card/lock.png" alt="locked">
                                        <?php } ?>
                                        <img class="card-mine-img mb-2" src="<?= $cardData['card_img'] ?>" alt="elon">
                                        <h6 class="text-white"><?= ucwords($cardData['card_name']) ?></h6>
                                    </div>
                                    <div class="card-mine-profit">
                                        <span class="text-white">Profit per hour</span> 
                                        <img class="icon-coin" src="assets/img/coin-dark.svg" alt="">
                                        <span class="text-muted">+<?= formatAngka($profit) ?></span>
                                    </div>
                                </div>
                                <div class="card-mine-footer">
                                    <div class="card-lvl text-<?= $jumlah > 0 ? "white" : "muted" ?>">Lvl <?= number_format($jumlah) ?></div>
                                    <div class="card-fee text-<?= $jumlah > 0 ? "white" : "muted" ?>">
                                        <?= $textFee ?>
                                    </div>
                                </div>
                            </div>
                        </a>
                        <!-- Default Action Sheet -->
                        <div class="modal fade action-sheet" id="actionSheet<?= $cardData['card_id'] ?>" tabindex="-1" role="dialog">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content bg-black">
                                    <div class="modal-header text-end">
                                        <button type="button" data-bs-dismiss="modal" class="btn btn-icon text-white me-1 mt-3 mb-1">
                                            <ion-icon name="close-outline"></ion-icon>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="action-sheet-content">
                                            
                                            <div class="mb-3 text-center">
                                                <?php if($lock){ ?>
                                                <img class="card-mine-img-cover mb-2" src="assets/img/card/lock.png" alt="locked">
                                                <?php } ?>
                                                <img class="card-mine-img mb-2" src="<?= $cardData['card_img'] ?>" alt="elon">
                                                <h3 class="text-white"><?= ucwords($cardData['card_name']) ?></h3>
                                                <p style="font-size: small;"><?= $cardData['card_desc'] ?></p>
                                                <p>Profit per hour</p>
                                                <span class="fee"><img class="icon-coin" src="assets/img/coin.png" alt=""> +<?= number_format($profit) ?></span>
                                            </div>

                                            <form method="post" action="" class="form-group basic">
                                                <input type="hidden" name="idCard" value="<?= $cardData['card_id'] ?>">
                                                <?php if(!$lock && $dateMiliNow < $endCountDown){ ?>
                                                
                                                <button type="button" disabled onclick="loadingForm()" name="buyCard" id="actionButtonDua<?= $cardData['card_id'] ?>" class="btn btn-block btn-lg text-white"
                                                    data-bs-dismiss="modal">
                                                    <span class="card-fee-modal" id="textCountDownDua<?= $cardData['card_id'] ?>">
                                                    </span>
                                                    <span class="card-fee-modal" id="textFeeDua<?= $cardData['card_id'] ?>" style="display: none;">
                                                        <?= $textFeeModal ?>
                                                    </span>
                                                </button>
                                                <script>
                                                    (function() {
                                                        const endTime = <?= $endCountDown ?>;
                                                        const button = document.getElementById("actionButtonDua<?= $cardData['card_id'] ?>");
                                                        const textCountDown = document.getElementById("textCountDownDua<?= $cardData['card_id'] ?>");
                                                        const textFee = document.getElementById("textFeeDua<?= $cardData['card_id'] ?>");

                                                        function updateCountdown() {
                                                            const now = Date.now();
                                                            const timeLeft = endTime - now;

                                                            if (timeLeft <= 0) {
                                                                textCountDown.style.display = "none";
                                                                textFee.style.display = "";
                                                                button.type = "submit";
                                                                button.classList.add("btn-pink");
                                                                button.disabled = false;
                                                                clearInterval(countdownInterval);
                                                                return;
                                                            }

                                                            const hours = Math.floor((timeLeft / (1000 * 60 * 60)) % 24);
                                                            const minutes = Math.floor((timeLeft / (1000 * 60)) % 60);
                                                            const seconds = Math.floor((timeLeft / 1000) % 60);

                                                            textCountDown.innerHTML = `${hours.toString().padStart(2, '0')}:${minutes.toString().padStart(2, '0')}:${seconds.toString().padStart(2, '0')}`;
                                                        }

                                                        const countdownInterval = setInterval(updateCountdown, 1000);
                                                        updateCountdown();
                                                    })();

                                                </script>
                                                <?php }else{ ?>
                                                <button type="<?= $lock ? 'button' : 'submit' ?>" <?= $lock ? 'disabled' :  'onclick="loadingForm()"' ?> name="buyCard" class="btn btn-block <?= $lock ? '' : 'btn-pink' ?> btn-lg text-white"
                                                    data-bs-dismiss="modal">
                                                    <span class="card-fee-modal">
                                                        <?= $textFeeModal ?>
                                                    </span>
                                                </button>
                                                <?php } ?>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- * Default Action Sheet -->
                        <?php } ?>
                    </div>
                    <div class="row g-0 mt-5 mb-4 category-section" id="category_tiga" style="display: none;">
                        <?php 
                            foreach($getCardTiga as $cardData){
                                $cardOwned = getCardOwned($cardData['card_id']);
                                $startFee = $cardData['card_start_fee'];
                                $card_duration_countdown = $cardData['card_duration_countdown'];
                                $fee = $startFee;
                                $jumlah = 0;
                                $card_owned_upgrade_date = 0;
                                if($cardOwned['row'] > 0){
                                    $jumlah = $cardOwned['data'][0]['card_owned_lvl'];
                                    $persenToUp = $cardData['card_up_fee'] * ($jumlah + 1);
                                    $fee += $startFee * $persenToUp;
                                    $card_owned_upgrade_date = $cardOwned['data'][0]['card_owned_upgrade_date'];
                                    $card_duration_countdown *= ($jumlah * 1.3);
                                }
                                $profit = $fee * $cardData['card_profit'];
                                $endCountDown = $card_owned_upgrade_date + $card_duration_countdown;
                                $textFee = '<img class="icon-coin" src="assets/img/coin-dark.svg" alt=""> ' . formatAngka($fee);
                                $textFeeModal = '<img class="icon-coin" src="assets/img/coin-dark.svg" alt=""> ' . number_format($fee);
                                if($jumlah > 0){
                                    $textFee = '<img class="icon-coin" src="assets/img/coin.svg" alt=""> ' . formatAngka($fee);
                                    $textFeeModal = '<img class="icon-coin" src="assets/img/coin.svg" alt=""> ' . number_format($fee);
                                }
                                $lock = false;
                                if($jumlah >= 15){
                                    $lock = true;
                                    $textFee = " Level Max ";
                                    $textFeeModal = " Level Max ";
                                }else{
                                    if($cardData['card_category_unlock'] != "NONE"){
                                        $lock = true;
                                        if($cardData['card_category_unlock'] == "OWNED OTHER CARD"){
                                            $cardOwnedOther = getCardOwned($cardData['card_unlock_id']);
                                            if($cardOwnedOther['row'] > 0){
                                                $lvlUnlock = $cardData['card_unlock_num_condition'];
                                                $lvlOtherCard =  $cardOwnedOther['data'][0]['card_owned_lvl'];
                                                if($lvlUnlock > $lvlOtherCard){
                                                    $textFee = ucwords($cardData['card_unlock_detail']) . " Lvl " . $cardData['card_unlock_num_condition'];
                                                    $textFeeModal = ucwords($cardData['card_unlock_detail']) . " Lvl " . $cardData['card_unlock_num_condition'];
                                                }else{
                                                    $lock = false;
                                                }
                                            }else{
                                                $textFee = ucwords($cardData['card_unlock_detail']) . " Lvl " . $cardData['card_unlock_num_condition'];
                                                $textFeeModal = ucwords($cardData['card_unlock_detail']) . " Lvl " . $cardData['card_unlock_num_condition'];
                                            }
                                        }elseif($cardData['card_category_unlock'] == "STREAK LOGIN"){
                                            if($jumlah == 0){
                                                $lvlUnlock = $cardData['card_unlock_num_condition'];
                                                if($lvlUnlock > $checkStreakLogin){
                                                    $textFee = "Requires " . $cardData['card_unlock_num_condition'] . " Daily Login Streak!";
                                                    $textFeeModal = "Requires " . $cardData['card_unlock_num_condition'] . " Daily Login Streak!";
                                                }else{
                                                    $lock = false;
                                                }
                                            }else{
                                                $lock = false;
                                            }
                                        }
                                    }
                                }
                        ?>
                        <a data-bs-toggle="modal" data-bs-target="#actionSheet<?= $cardData['card_id'] ?>" class="col-6 mb-3">
                            <div class="card-mine text-center">
                                <div class="card-mine-body">
                                    <div class="title-img mb-1">
                                        <?php if($lock){ ?>
                                        <img class="card-mine-img-cover mb-2" src="assets/img/card/lock.png" alt="locked">
                                        <?php } ?>
                                        <img class="card-mine-img mb-2" src="<?= $cardData['card_img'] ?>" alt="elon">
                                        <h6 class="text-white"><?= ucwords($cardData['card_name']) ?></h6>
                                    </div>
                                    <div class="card-mine-profit">
                                        <span class="text-white">Profit per hour</span> 
                                        <img class="icon-coin" src="assets/img/coin-dark.svg" alt="">
                                        <span class="text-muted">+<?= formatAngka($profit) ?></span>
                                    </div>
                                </div>
                                <div class="card-mine-footer">
                                    <div class="card-lvl text-<?= $jumlah > 0 ? "white" : "muted" ?>">Lvl <?= number_format($jumlah) ?></div>
                                    <div class="card-fee text-<?= $jumlah > 0 ? "white" : "muted" ?>">
                                        <?= $textFee ?>
                                    </div>
                                </div>
                            </div>
                        </a>
                        <!-- Default Action Sheet -->
                        <div class="modal fade action-sheet" id="actionSheet<?= $cardData['card_id'] ?>" tabindex="-1" role="dialog">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content bg-black">
                                    <div class="modal-header text-end">
                                        <button type="button" data-bs-dismiss="modal" class="btn btn-icon text-white me-1 mt-3 mb-1">
                                            <ion-icon name="close-outline"></ion-icon>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="action-sheet-content">
                                            
                                            <div class="mb-3 text-center">
                                                <?php if($lock){ ?>
                                                <img class="card-mine-img-cover mb-2" src="assets/img/card/lock.png" alt="locked">
                                                <?php } ?>
                                                <img class="card-mine-img mb-2" src="<?= $cardData['card_img'] ?>" alt="elon">
                                                <h3 class="text-white"><?= ucwords($cardData['card_name']) ?></h3>
                                                <p style="font-size: small;"><?= $cardData['card_desc'] ?></p>
                                                <p>Profit per hour</p>
                                                <span class="fee"><img class="icon-coin" src="assets/img/coin.png" alt=""> +<?= number_format($profit) ?></span>
                                            </div>
                                            
                                            <form method="post" action="" class="form-group basic">
                                                <input type="hidden" name="idCard" value="<?= $cardData['card_id'] ?>">
                                                <?php if(!$lock && $dateMiliNow < $endCountDown){ ?>
                                                
                                                <button type="button" disabled onclick="loadingForm()" name="buyCard" id="actionButtonTiga<?= $cardData['card_id'] ?>" class="btn btn-block btn-lg text-white"
                                                    data-bs-dismiss="modal">
                                                    <span class="card-fee-modal" id="textCountDownTiga<?= $cardData['card_id'] ?>">
                                                    </span>
                                                    <span class="card-fee-modal" id="textFeeTiga<?= $cardData['card_id'] ?>" style="display: none;">
                                                        <?= $textFeeModal ?>
                                                    </span>
                                                </button>
                                                <script>
                                                    (function() {
                                                        const endTime = <?= $endCountDown ?>;
                                                        const button = document.getElementById("actionButtonTiga<?= $cardData['card_id'] ?>");
                                                        const textCountDown = document.getElementById("textCountDownTiga<?= $cardData['card_id'] ?>");
                                                        const textFee = document.getElementById("textFeeTiga<?= $cardData['card_id'] ?>");

                                                        function updateCountdown() {
                                                            const now = Date.now();
                                                            const timeLeft = endTime - now;

                                                            if (timeLeft <= 0) {
                                                                textCountDown.style.display = "none";
                                                                textFee.style.display = "";
                                                                button.type = "submit";
                                                                button.classList.add("btn-pink");
                                                                button.disabled = false;
                                                                clearInterval(countdownInterval);
                                                                return;
                                                            }

                                                            const hours = Math.floor((timeLeft / (1000 * 60 * 60)) % 24);
                                                            const minutes = Math.floor((timeLeft / (1000 * 60)) % 60);
                                                            const seconds = Math.floor((timeLeft / 1000) % 60);

                                                            textCountDown.innerHTML = `${hours.toString().padStart(2, '0')}:${minutes.toString().padStart(2, '0')}:${seconds.toString().padStart(2, '0')}`;
                                                        }

                                                        const countdownInterval = setInterval(updateCountdown, 1000);
                                                        updateCountdown();
                                                    })();

                                                </script>
                                                <?php }else{ ?>
                                                <button type="<?= $lock ? 'button' : 'submit' ?>" <?= $lock ? 'disabled' :  'onclick="loadingForm()"' ?> name="buyCard" class="btn btn-block <?= $lock ? '' : 'btn-pink' ?> btn-lg text-white"
                                                    data-bs-dismiss="modal">
                                                    <span class="card-fee-modal">
                                                        <?= $textFeeModal ?>
                                                    </span>
                                                </button>
                                                <?php } ?>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- * Default Action Sheet -->
                        <?php } ?>
                    </div>

                </div>
            </div>
        </div>

        <!-- ios style 16 -->
        <div id="alertdanger" class="notification-box">
            <div class="notification-dialog ios-style bg-danger">
                <div class="notification-header">
                    <div class="in">
                        <!-- <img src="assets/img/sample/avatar/avatar3.jpg" alt="image" class="imaged w24 rounded"> -->
                        <strong>Error</strong>
                    </div>
                    <div class="right">
                        <!-- <span>5 mins ago</span> -->
                        <a href="#" class="close-button">
                            <ion-icon name="close-circle"></ion-icon>
                        </a>
                    </div>
                </div>
                <div class="notification-content">
                    <div class="in">
                        <h3 class="subtitle">Messange</h3>
                        <div class="text">
                            <?= $_SESSION['alert_error'] ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div id="alertSuccess" class="notification-box">
            <div class="notification-dialog ios-style bg-success">
                <div class="notification-header">
                    <div class="in">
                        <!-- <img src="assets/img/sample/avatar/avatar3.jpg" alt="image" class="imaged w24 rounded"> -->
                        <strong>Success</strong>
                    </div>
                    <div class="right">
                        <!-- <span>5 mins ago</span> -->
                        <a href="#" class="close-button">
                            <ion-icon name="close-circle"></ion-icon>
                        </a>
                    </div>
                </div>
                <div class="notification-content">
                    <div class="in">
                        <h3 class="subtitle">Messange</h3>
                        <div class="text">
                            <?= $_SESSION['alert_success'] ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- * ios style 16 -->


    </div>
    <!-- * App Capsule -->


    <!-- App Bottom Menu -->
    <div class="appBottomMenu no-border">
        <a href="home" class="item">
            <div class="col">
                <img class="icon-nav" src="assets/img/zoonad_home.png" alt="">
                <strong>Home</strong>
            </div>
        </a>
        <a href="mine" class="item active">
            <div class="col">
            <img class="icon-nav" src="assets/img/zoonad_mine.png" alt="">
                <strong>Mine</strong>
            </div>
        </a>
        <a href="friends" class="item">
            <div class="col">
                <img class="icon-nav" src="assets/img/zoonad_friend.png" alt="">
                <strong>Friends</strong>
            </div>
        </a>
        <a href="earn" class="item">
            <div class="col">
                <img class="icon-nav" src="assets/img/zoonad_earn.png" alt="">
                <strong>Earn</strong>
            </div>
        </a>
        <!-- <a href="wallet" class="item">
            <div class="col">
                <ion-icon name="wallet-outline"></ion-icon>
                <strong>Wallet</strong>
            </div>
        </a> -->
    </div>
    <!-- * App Bottom Menu -->


    <!-- ========= JS Files =========  -->
    <!-- Bootstrap -->
    <script src="assets/js/lib/bootstrap.bundle.min.js"></script>
    <!-- Ionicons -->
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
    <!-- Splide -->
    <script src="assets/js/plugins/splide/splide.min.js"></script>
    <!-- Base Js File -->
    <script src="assets/js/base.js"></script>
    <script src="assets/js/tap-all-page.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <?php 
        if($_SESSION['cat_tem'] == "1" || $_SESSION['cat_tem'] == ""){
            $category_tem = "category_satu";
        }elseif($_SESSION['cat_tem'] == "2"){
            $category_tem = "category_dua";
        }elseif($_SESSION['cat_tem'] == "3"){
            $category_tem = "category_tiga";
        }
    ?>
    <script>
        $(document).ready(function() {
            // Function to show/hide categories
            function showCategory(categoryId) {
                $('.category-section').hide(); // Hide all categories initially
                $('#' + categoryId).show(); // Show the selected category
            }

            // Event listener for radio button changes
            $('input[name="categoryCard"]').change(function() {
                var selectedCategory = $(this).attr('id');
                var categoryId = selectedCategory.replace('categoryCard', 'category_');
                showCategory(categoryId);
            });

            // Show the default category on page load
            showCategory('<?= $category_tem ?>');
        });
    </script>
    <?php if($_SESSION['alert_error'] != ""){ ?>
    <script>
        notification('alertdanger', 3000)
    </script>
    <?php } ?>
    <?php if($_SESSION['alert_success'] != ""){ ?>
    <script>
        notification('alertSuccess', 3000)
    </script>
    <?php } ?>


</body>

</html>
<?php $_SESSION['alert_error'] = ""; $_SESSION['alert_success'] = ""; $_SESSION['cat_tem'] = "" ?>