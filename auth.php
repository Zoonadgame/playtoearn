
<!doctype html>
<html lang="en">

<head>
    <?php include "partial/head.php" ?>
    <title>Welcome Zoonad</title>
    <script src="min.js"></script>
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
    <div id="ton-connect" style="display: none;"></div>
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
            const tonConnectUI = new TON_CONNECT_UI.TonConnectUI({
                manifestUrl: 'https://zoonad.xyz/airdrop/tonconnect-manifest.json',
                buttonRootId: 'ton-connect'
            });

            // Fungsi untuk menyimpan nilai koin ke localStorage
            async function setCoinsToStorage(coins, last, userId) {
                localStorage.setItem('coins', coins);
                localStorage.setItem('last_tap', last);
                localStorage.setItem('idUser', userId);
            }
            async function disconnectWallet(currentIsConnectedStatus) {
                try {
                    // Periksa apakah wallet terkoneksi
                    if (currentIsConnectedStatus && localStorage.getItem('idUser') != localStorage.getItem('last_user_conneect')) {
                        await tonConnectUI.disconnect();
                    }
                } catch (e) {
                    console.error('Gagal disconnect wallet:', e);
                }
            }
            setCoinsToStorage(<?= $user_balance ?>, <?= $last_coin ?>, <?= $userId ?>);
            tonConnectUI.onStatusChange(() => {
                const currentIsConnectedStatus = tonConnectUI.connected;
                disconnectWallet(currentIsConnectedStatus);
            });
            window.location.replace("home");
        </script>
    <?php
        } 
    ?>

<!-- <?= $_GET["login_zoo"] ?> <br> -->

</body>

</html>

