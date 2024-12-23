<?php include "config/homeConfig.php" ?>
<!doctype html>
<html lang="en">

<head>
    <?php include "head.php" ?>
    <title>Admin | Home</title>
    <style>
        .bg-transparent{
            background-color: rgba(255, 255, 255, 0.1) !important;
            padding: 5px 10px 5px 10px;
            border-radius: 20px 20px 20px 20px;
            -webkit-border-radius: 20px 20px 20px 20px;
            -moz-border-radius: 20px 20px 20px 20px;
        }
        .appHeader-custome{
            border-radius: 0px 0px 20px 20px;
            -webkit-border-radius: 0px 0px 20px 20px;
            -moz-border-radius: 0px 0px 20px 20px;
            border-bottom: 5px solid #ff2ca9 !important;
            box-shadow: 0px 8px 13px 0px rgba(255,44,169,0.59);
            -webkit-box-shadow: 0px 8px 13px 0px rgba(255,44,169,0.59);
            -moz-box-shadow: 0px 8px 13px 0px rgba(255,44,169,0.59);
        }
    </style>
</head>

<body>

    <!-- loader -->
    <div id="loader">
        <img src="../assets/img/loading-icon.png" alt="icon" class="loading-icon">
    </div>
    <!-- * loader -->

    <script>
        function loadingForm() {
            setInterval(() => {
                // Mengatur tombol menjadi tidak dapat di-klik selama proses loading
                document.getElementById("loader").style.display  = "";
            }, 100);
        }
    </script>

    <!-- App Header -->
    <div class="appHeader no-border position-absolute appHeader-custome">
        <div class="left">
        </div>
        <div class="pageTitle">Home</div>
        <div class="right">
            <a href="config/configLogout" class="headerButton" onclick="loadingForm()">
                <ion-icon name="power"></ion-icon>
            </a>
        </div>
    </div>
    <!-- * App Header -->

    <!-- App Capsule -->
    <div id="appCapsule">

        <div class="section mb-5 p-2">
            <div class="stat-box bg-primary">
                <div class="title text-light">Income</div>
                <div class="value text-white"><?= number_format(totalTon(),3) ?> TON</div>
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
                    <!-- <div class="right">
                        <span>5 mins ago</span>
                        <a href="#" class="close-button">
                            <ion-icon name="close-circle"></ion-icon>
                        </a>
                    </div> -->
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
                    <!-- <div class="right">
                        <span>5 mins ago</span>
                        <a href="#" class="close-button">
                            <ion-icon name="close-circle"></ion-icon>
                        </a>
                    </div> -->
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
    <div class="appBottomMenu no-border appBottomMenu-custome">
        <a href="home" class="item active">
            <div class="col">
                <ion-icon name="home"></ion-icon>
                <strong>Home</strong>
            </div>
        </a>
        <a href="card" class="item">
            <div class="col">
                <ion-icon name="card"></ion-icon>
                <strong>card</strong>
            </div>
        </a>
        <a href="user" class="item">
            <div class="col">
                <ion-icon name="people"></ion-icon>
                <strong>User</strong>
            </div>
        </a>
    </div>
    <!-- * App Bottom Menu -->


    <!-- ========= JS Files =========  -->
    <!-- Bootstrap -->
    <script src="../assets/js/lib/bootstrap.bundle.min.js"></script>
    <!-- Ionicons -->
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
    <!-- Splide -->
    <script src="../assets/js/plugins/splide/splide.min.js"></script>
    <!-- Base Js File -->
    <script src="../assets/js/base.js"></script>
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