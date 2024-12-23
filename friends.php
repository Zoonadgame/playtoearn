<?php require "config/friendsConfig.php" ?>
<!doctype html>
<html lang="en">

<head>
    <?php include "partial/head.php" ?>
    <title>Zoonad | Friends</title>
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
    <div id="appCapsule">

        <div class="section full mb-3 text-center">
            <h1 class="text-white">Invite Friends!</h1>
            <p>Invite your friends and get a reward</p>
        </div>

        <div class="section">
            <div class="section-heading">
                <h2 class="title text-white fs-5">Your friends List (<?= $getDownline['row'] ?>)</h2>
                <div class="link text-white fs-5">
                    <ion-icon name="reload-outline"></ion-icon>
                </div>
            </div>
            <?php
            if($getDownline['row'] > 0){ 
                foreach($getDownline['data'] as $downline){ 
            ?>
            <div class="card bg-transparent text-white mb-2">
                <div class="card-body">
                    <?= $downline['name'] ?>
                </div>
            </div>
            <?php }} ?>
        </div>

        <div class="button-inv">
            <div class="row">
                <div class="col-9">
                    <button class="btn btn-pink btn-lg" style="width: 100%" id="inviteButton">
                        Invite Friends <ion-icon name="person-circle-outline"></ion-icon>
                    </button>
                </div>
                <div class="col-3 text-end">
                    <button type="button" class="btn btn-pink btn-lg" id="copyButton">
                        <ion-icon name="copy-outline" style="text-align: center; margin: 0"></ion-icon>
                    </button>
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
                            URL: https://t.me/zoonad_game_bot?start=<?= $_SESSION["codeReff"] ?>
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
        <a href="mine" class="item">
            <div class="col">
            <img class="icon-nav" src="assets/img/zoonad_mine.png" alt="">
                <strong>Mine</strong>
            </div>
        </a>
        <a href="friends" class="item active">
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
    <script>
        document.getElementById("copyButton").addEventListener("click", function() {
            // Ambil teks dari elemen dengan id referralText
            var textToCopy = "https://t.me/Zoonadbot?start=<?= $_SESSION["codeReff"] ?>";

            // Salin teks ke clipboard
            navigator.clipboard.writeText(textToCopy).then(function() {
                notification('alertSuccess', 3000)
            }).catch(function(error) {
                alert("failed : " + error);
            });
        });

    </script>
    <script>
    document.getElementById("inviteButton").addEventListener("click", function() {
        // Isi dengan link bot dan pesan ajakan Anda
        const link = encodeURIComponent("https://t.me/Zoonadbot?start=<?= $_SESSION["codeReff"] ?>");
        const text = encodeURIComponent("Play with me, and get free 20.000 points! 🕹\nTap, mine, invite friends and complete tasks to get more points... 🎖\nMore friends more coins!!🥳");
        
        // URL untuk membuka aplikasi Telegram dengan pesan otomatis
        const telegramUrl = `https://t.me/share/url?url=${link}&text=${text}`;
        
        // Buka URL tersebut untuk memulai pesan di Telegram
        window.open(telegramUrl, "_blank");
    });
</script>


</body>

</html>