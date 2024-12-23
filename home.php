<?php require "config/homeConfig.php" ?>
<!doctype html>
<html lang="en">

<head>
    <?php include "partial/head.php" ?>
    <title>Zoonad | Home</title>
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
            background-image: url("assets/img/bg/bg-main.png");
            background-size: cover;
            background-position: center;
        }
        .box-info{
            background-color: rgba(255, 255, 255, 0.1);
            padding: 10px;
            border-radius: 9px 9px 9px 9px;
            -webkit-border-radius: 9px 9px 9px 9px;
            -moz-border-radius: 9px 9px 9px 9px;
        }
        .box-info img{
            min-width: 10px;
            max-width: 24px;
        }
        .balance-home {
            text-align: center; /* Menengahkan elemen secara horizontal */
            min-width: 300px; /* Sesuaikan lebar minimum sesuai kebutuhan */
            margin: 0 auto;
        }
        .balance-home .d-flex {
            display: inline-flex;
            align-items: center;
            justify-content: center; /* Menengahkan elemen anak secara horizontal */
        }
        .balance-home .d-flex img {
            min-width: 50px; /* Sesuaikan ukuran gambar */
            max-width: 50px;
            margin-right: 10px;
            margin-bottom: 10px;
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
    <?php $timestamp = time(); ?>
    <link rel="stylesheet" href="assets/css/custome.css?v=<?= $timestamp ?>">
    
    <script src="min.js"></script>
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
            <div class="section-header">
                <div class="left-section">
                    <div class="headerButtonSection" style="color: white;">
                        <ion-icon name="person-circle-sharp"></ion-icon> <?= $_SESSION['usernameDB'] ?> (KEEPER)
                    </div>
                </div>
                <!-- <div class="pageTitle">
                    Contact
                </div> -->
                <div class="right-section">
                    
                    <div id="ton-connect">
                    </div>
                    
                </div>
            </div>
        </div>

        <div class="section full">
            <div class="card main">
                <div class="card-body">
                    <div class="row mb-3 mt-2">

                        <!-- earn per tab -->
                        <div class="col">
                            <div class="box-info text-center">
                                <span class="text-white">Earn per tab</span> <br>
                                <img src="assets/img/bl.svg" alt="" class="pt-10">
                                <span class="text-white">+<?= formatAngka($getTap['tap_total']) ?></span>
                            </div>
                        </div>

                        <!-- profit -->
                        <div class="col">
                            <div class="box-info text-center">
                                <span class="text-white">Profit per hour</span> <br>
                                <img src="assets/img/bl.svg" alt="" class="pt-10">
                                <span class="text-white">+<?= formatAngka($getDataUser['user_profit_per_our']) ?></span>
                            </div>
                        </div>
                    </div>

                    <!-- temp balance -->
                    <div class="balance-home mb-2">
                        <div class="d-flex">
                            <img src="assets/img/bl.svg" alt="" class="pt-10">
                            <h1 class="text-white" id="coin_count">0</h1>
                        </div>
                    </div>

                    <!-- LVL -->
                    <div class="row mb-1">
                        <!-- label lvl -->
                        <div class="col text-start">
                            <a href="rank?level=<?= $autoUpLvl['nameLvl'] ?>">
                                <span class="text-white" style="font-size: smaller;"><img src="assets/img/lvl/<?= $autoUpLvl['nameLvl'] ?>.png" alt="" class="lvl-icon">  <?= $autoUpLvl['nameLvl'] ?> ></span>
                            </a>
                        </div>
                        <!-- num lvl -->
                        <div class="col text-end">
                            <span class="text-white" style="font-size: smaller;">Level <?= $autoUpLvl['numLvl'] ?>/11</span>
                        </div>
                    </div>
                    
                    <!-- lvl progress -->
                    <div class="progress mb-2">
                        <div class="progress-bar" role="progressbar" style="width: <?= number_format($autoUpLvl['progress']) ?>%; background-color: #ff2ca9;" aria-valuenow="<?= number_format($autoUpLvl['progress']) ?>" aria-valuemin="0" aria-valuemax="100">
                        </div>
                        <div class="progress-label text-dark"><?= number_format($autoUpLvl['coinNextLvl']) ?></div>

                    </div>
                    
                    <!-- button tap -->
                    <button type="button" style="text-decoration: none; background: none; border: none" class="item-center-bl mb-2" id="tap_button">
                        <img src="assets/img/Tap2.png" alt="">
                        <span class="number-add text-white" id="number-add"></span>
                    </button>

                    <div class="row mb-3">
                        <div class="col">
                            <div class="box-info text-center">
                                <img src="assets/img/bl.svg" alt="" class="pt-10">
                                <span class="text-white" id="max_tap"></span>
                            </div>
                        </div>
                        <a class="col" href="" data-bs-toggle="modal" data-bs-target="#boost">
                            <div class="box-info text-center">
                                <img src="assets/img/zoonad_upgrade.png" alt="" >
                                <span class="text-white">Booster</span>
                            </div>
                        </a>
                    </div>

                    <br><br><br>
                </div>
            </div>
        </div>

        <!-- Default Action Sheet -->
        <div class="modal fade action-sheet" id="boost" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content bg-black">
                    <div class="modal-header text-end">
                        <button type="button" data-bs-dismiss="modal" class="btn btn-icon text-white me-1 mt-3 mb-0">
                            <ion-icon name="close-outline"></ion-icon>
                        </button>
                    </div>
                    <div class="modal-body mt-0">
                        <div class="action-sheet-content">
                            
                            <div class="mb-2 text-center">
                                <div class="boost">
                                    <h2 class="text-white mt-2"><img src="assets/img/zoonad_upgrade.png" alt="" > Booster</h2>
                                </div>
                                <span class="fee">Upgrade your tap and Energy!</span>
                            </div>
                            <script>
                                function loadingForm() {
                                    // Mengatur tombol menjadi tidak dapat di-klik selama proses loading
                                    document.getElementById("loader").style.display  = "";
                                }
                            </script>
                            <form action="" method="post" class="form-group basic d-flex">
                                <button type="submit" name="tapUp" onclick="loadingForm()" class="btn btn-block d-block btn-lg text-white btn-boost" data-bs-dismiss="modal">
                                    Tap +1 <p style="color: #A9ABAD;"><?= number_format($priceBooster['feeUpTap']) ?></p>
                                </button>
                                <button type="submit" name="energyUp" onclick="loadingForm()" class="btn btn-block btn-lg d-block text-white btn-boost" data-bs-dismiss="modal">
                                    Energi +10 <p style="color: #A9ABAD;"><?= number_format($priceBooster['feeUpEnergy']) ?></p>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- * Default Action Sheet -->

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
        <a href="home" class="item active">
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
    <script src="assets/js/tap.js?v=<?= $timestamp ?>"></script>
    <script>
        const themes = TON_CONNECT_UI.THEME;
        const uiWallet = TON_CONNECT_UI.UIWallet;

        const tonConnectUI = new TON_CONNECT_UI.TonConnectUI({
            manifestUrl: 'https://zoonad.xyz/airdrop/tonconnect-manifest.json',
            buttonRootId: 'ton-connect'
        });

        tonConnectUI.uiOptions = {
            uiPreferences: {
                theme: themes.DARK,
                borderRadius: 's',
                colorsSet: {
                    [themes.DARK]: {
                        connectButton: {
                            background: '#ff2ca9'
                        }
                    }
                }
            },
            twaReturnUrl: 'https://t.me/Zoonadbot?start'
        };

        // Tunggu perubahan status koneksi
        tonConnectUI.onStatusChange(updateLastConnect);
        function updateLastConnect() {
            const currentIsConnectedStatus = tonConnectUI.connected;
            const idUserLogin = localStorage.getItem('idUser');
    
            if (currentIsConnectedStatus) {
                localStorage.setItem('last_user_conneect', idUserLogin);
            } else {
                localStorage.removeItem('last_user_conneect');
            }
        }
                
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
<?php $_SESSION['alert_error'] = ""; $_SESSION['alert_success'] = "" ?>