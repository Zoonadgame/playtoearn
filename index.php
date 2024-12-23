
<!doctype html>
<html lang="en">

<head>
    <?php include "partial/head.php" ?>
    <title>Welcome Zoonad</title>
    <style>
        .bg-img{
            background-image: url("assets/img/bg/index.webp");
            background-size: 100% 100vh;
        }
        .ind-img{
            max-width: 220px;
        }
        .bg-transparent{
            background-color: rgba(0, 0, 0, 0.4) !important;
            padding: 1px;
            border-radius: 20px 20px 20px 20px;
            -webkit-border-radius: 20px 20px 20px 20px;
            -moz-border-radius: 20px 20px 20px 20px;
        }
    </style>
</head>

<body class="bg-img">

    <!-- loader -->
    <div id="loader-welcome">
        <img src="assets/img/loading-icon.png" alt="icon" class="loading-icon">
    </div>
    <!-- * loader -->

    <!-- App Capsule -->
    <div id="appCapsule">
        <div class="section full mb-3 text-center">
            <img src="assets/img/favicon.png" class="ind-img" alt="">
        </div>
        <div class="section mt-4 mb-3">
            <div class="transactions mb-2">
                <a href="https://t.me/zoonadcommunity" target="__blank" class="item bg-transparent">
                    <div class="detail">
                        <img src="assets/img/tele_zoonad.png" alt="img" class="image-block imaged w48">
                        <div>
                            <strong class="text-white">Join our telegram channel</strong>
                        </div>
                    </div>
                </a>
            </div>
            <div class="transactions mb-2">
                <a href="https://youtube.com/@zoonad_club" target="__blank" class="item bg-transparent">
                    <div class="detail">
                        <img src="assets/img/yt_zoonad.png" alt="img" class="image-block imaged w48">
                        <div>
                            <strong class="text-white">Subscribe</strong>
                        </div>
                    </div>
                </a>
            </div>
            <div class="transactions mb-2">
                <a href="https://www.instagram.com/zoonad_xyz" target="__blank" class="item bg-transparent">
                    <div class="detail">
                        <img src="assets/img/ig_zoonad.png" alt="img" class="image-block imaged w48">
                        <div>
                            <strong class="text-white">Follow our Instagram</strong>
                        </div>
                    </div>
                </a>
            </div>
            <div class="transactions mb-2">
                <a href="http://X.com/zoonad_xyz" target="__blank" class="item bg-transparent">
                    <div class="detail">
                        <img src="assets/img/x_zoonad.png" alt="img" class="image-block imaged w48">
                        <div>
                            <strong class="text-white">Follow our X</strong>
                        </div>
                    </div>
                </a>
            </div>
        </div>
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

</body>

</html>

