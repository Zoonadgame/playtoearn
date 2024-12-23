<?php require "config/rankConfig.php" ?>
<!doctype html>
<html lang="en">

<head>
    <?php include "partial/head.php" ?>

    <title>Zoonad | Rank</title>
    <style>
        .button-inv{
            z-index: 999;
            position: fixed;
            bottom: 65px;
            left: 0;
            right: 0;
            padding-left: 10px;
            padding-right: 10px; 
        }

        .bg-transparent{
            background-color: rgba(255, 255, 255, 0.1) !important;
            padding: 1px;
            border-radius: 20px 20px 20px 20px;
            -webkit-border-radius: 20px 20px 20px 20px;
            -moz-border-radius: 20px 20px 20px 20px;
        }

        .earn-img{
            max-width: 120px;
        }

        .fee img{
            min-width: 10px;
            max-width: 15px;
        }
    </style>
    <?php $timestamp = time(); ?>
    <link rel="stylesheet" href="assets/css/custome.css?v=<?= $timestamp ?>">
</head>

<body>

    <!-- loader -->
    <div id="loader">
        <img src="assets/img/loading-icon.png" alt="icon" class="loading-icon">
    </div>
    <!-- * loader -->
    <?php  
        $dataLvl = dataLvl();
    ?>

    <!-- App Capsule -->
    <div id="appCapsule mt-0">

        <div class="section">
            <div class="section-header">
                <div class="left-section">
                    <?php if($dataLvl['before'] != "none"){ ?>
                        <a href="?level=<?= $dataLvl['before'] ?>" class="headerButton goBack">
                            <ion-icon name="chevron-back-outline"></ion-icon>
                        </a>
                    <?php } ?>
                </div>

                <div class="pageTitle">LeaderBoard</div>
                
                <div class="right-section">
                    <?php if($dataLvl['next'] != "none"){ ?>
                        <a href="?level=<?= $dataLvl['next'] ?>" class="headerButton goBack">
                            <ion-icon name="chevron-forward-outline"></ion-icon>
                        </a>
                    <?php } ?>
                </div>
            </div>
        </div>

        <div class="section">
            <div class="text-center mb-3">
                <img src="assets/img/lvl/<?= $level ?>.png" class="earn-img mb-2" alt="">
                <h1 class="text-white text-center">
                    <?= $level ?>
                </h1>
                <span class="text-muted">(<?= $dataLvl['number'] ?>/<?= $dataLvl['total'] ?>)</span>
            </div>
            <div class="transactions">
                <?php  
                    $num = 0;
                    $getUserRank = getDataUser();
                    foreach($getUserRank as $row){
                        ++$num;
                        $borderColor = "border-emas";
                        if($num > 3 && $num <= 7){
                            $borderColor = "border-pink";
                        }elseif($num > 7){
                            $borderColor = "border-bronze";
                        }
                ?>
                <!-- item -->
                <div href="" class="item mb-3 <?= $borderColor ?>">
                    <div class="detail">
                        <div class="image-block imaged w48">
                            <span style="font-size: large;" class="text-white"><?= $num ?></span>
                        </div>
                        <div>
                            <strong class="text-white"><?= $row['name'] ?></strong>
                            <p>Profit per hour</p>
                        </div>
                    </div>
                    <div class="right">
                        <div class="price text-white">
                            <img src="assets/img/bl.svg" alt="" class="icon-coin-rank"> + <?= formatAngka($row['profit']) ?>
                        </div>
                    </div>
                </div>
                <!-- * item -->
                <?php } ?>
            </div>
            <br><br>
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
                        <div class="text" id="errorText">
                            Error
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
                        <div class="text" id="successText">
                            Claim Success
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- * ios style 16 -->
        
        <script>
            function loadingForm() {
                // Mengatur tombol menjadi tidak dapat di-klik selama proses loading
                document.getElementById("loader").style.display  = "";
            }

        </script>
        
    </div>
    <!-- * App Capsule -->


    <!-- App Bottom Menu -->
    <div class="appBottomMenu no-border mt-2">
        <a href="home" class="item">
            <div class="col">
                <img class="icon-nav" src="assets/img/zoonad_home.png" alt="">
                <strong>Home</strong>
            </div>
        </a>
        <a href="mine" class="item">
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
<?php $_SESSION['alert_error'] = ""; $_SESSION['alert_success'] = "" ?>