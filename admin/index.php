<?php include "config/authConfig.php" ?>
<!doctype html>
<html lang="en">

<head>
    <?php include "head.php" ?>
    <title>Admin | Login</title>
    <style>
        .bg-transparent{
            background-color: rgba(255, 255, 255, 0.1) !important;
            padding: 5px 10px 5px 10px;
            border-radius: 20px 20px 20px 20px;
            -webkit-border-radius: 20px 20px 20px 20px;
            -moz-border-radius: 20px 20px 20px 20px;
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
    <div class="appHeader no-border transparent position-absolute">
        <div class="left">
        </div>
        <div class="pageTitle">Admin Zoonad</div>
        <div class="right">
        </div>
    </div>
    <!-- * App Header -->

    <!-- App Capsule -->
    <div id="appCapsule">

        <div class="section mt-2 text-center">
            <h1 class="text-white">Log in</h1>
        </div>
        <div class="section mb-5 p-2">

            <form action="" method="post">
                <div class="card bg-transparent">
                    <div class="card-body pb-1">
                        <div class="form-group basic">
                            <div class="input-wrapper">
                                <label class="label" for="username">Username</label>
                                <input type="text" class="form-control" id="username" name="username" placeholder="Your Username">
                                <i class="clear-input">
                                    <ion-icon name="close-circle"></ion-icon>
                                </i>
                            </div>
                        </div>

                        <div class="form-group basic">
                            <div class="input-wrapper">
                                <label class="label" for="password">Password</label>
                                <input type="password" class="form-control" id="password" name="password" autocomplete="off"
                                    placeholder="Your password">
                                <i class="clear-input">
                                    <ion-icon name="close-circle"></ion-icon>
                                </i>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="form-button-group  transparent">
                    <button type="submit" name="loginAdmin" onclick="loadingForm()" class="btn btn-pink btn-block btn-lg">Log in</button>
                </div>

            </form>
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