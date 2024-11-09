
<!doctype html>
<html lang="en">

<head>
    <?php include "partial/head.php" ?>
    <title>Welcome Zoonad</title>
</head>

<body class="bg-white">

    <!-- loader -->
    <div id="loader-welcome">
        <img src="assets/img/loading-icon.png" alt="icon" class="loading-icon">
    </div>
    <!-- * loader -->

    <!-- App Header -->
    <!-- <div class="appHeader no-border">
        <div class="left">
            <a href="#" class="headerButton goBack">
                <ion-icon name="chevron-back-outline"></ion-icon>
            </a>
        </div>
        <div class="pageTitle">
            Splash Page Image
        </div>
        <div class="right">
        </div>
    </div> -->
    <!-- * App Header -->

    <!-- App Capsule -->
    <img src="assets/img/bg/cover.png" width="100%" style="height: 100vh;"></img>
    <!-- <?= $_GET["user_id"] ?> <br>
    <?= $_GET["key"] ?> <br>
    <?= $_GET["username"] ?> <br>
    <?= $_GET["login_zoo"] ?> <br> -->
    <!-- * App Capsule -->


    <!-- ========= JS Files =========  -->
    <!-- Bootstrap -->
    <script src="assets/js/lib/bootstrap.bundle.min.js"></script>
    <!-- Ionicons -->
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
    <!-- Splide -->
    <script src="assets/js/plugins/splide/splide.min.js"></script>
    <!-- Base Js File -->
    <script src="assets/js/base.js"></script>

    <?php require "config/authConfig.php" ?>
    <?php if($_SESSION['login_zoo']){  ?>
        <script>
            // Fungsi untuk menyimpan nilai koin ke localStorage
            async function setCoinsToStorage(coins, last) {
                localStorage.setItem('coins', coins);
                localStorage.setItem('last_tap', last);
            }
            setCoinsToStorage(<?= $user_balance ?>, <?= $last_coin ?>);
            window.location.replace("home");
        </script>
    <?php
        } 
    ?>

<!-- <?= $_GET["login_zoo"] ?> <br> -->

</body>

</html>

