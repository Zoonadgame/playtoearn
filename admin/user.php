<?php include "config/userConfig.php" ?>
<!doctype html>
<html lang="en">

<head>
    <?php include "head.php" ?>
    <title>Admin | User</title>
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
        .modal .modal-dialog .modal-content .fee img{
            min-width: 10px;
            max-width: 15px;
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
        <div class="pageTitle">User</div>
        <div class="right">
            <a href="config/configLogout" class="headerButton" onclick="loadingForm()">
                <ion-icon name="power"></ion-icon>
            </a>
        </div>
    </div>
    <!-- * App Header -->

    <!-- App Capsule -->
    <div id="appCapsule">

        <div class="section mt-4 mb-2">
            <div class="section-heading mb-4">
                <h2 class="title text-white fs-5">Total User (<?= $total = countDataUser(); ?>)</h2>
            </div>
            <ul class="listview image-listview text inset">
                <?php
                if($dataTable['row'] > 0){ 
                    foreach($dataTable['data'] as $val){ 
                ?>
                <li>
                    <a href="#" data-bs-toggle="modal" data-bs-target="#actionSheet<?= $val['id'] ?>"  class="item bg-dark">
                        <div class="in text-white">
                            <div><?= $val['name'] ?></div> 
                            <span class="text-primary"></span>
                        </div>
                    </a>
                </li>
                <!-- Default Action Sheet -->
                <div class="modal fade action-sheet" id="actionSheet<?= $val['id'] ?>" tabindex="-1" role="dialog">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content bg-black">
                            <div class="modal-header text-end">
                                <button type="button" data-bs-dismiss="modal" class="btn btn-icon text-white me-1 mt-3 mb-1">
                                    <ion-icon name="close-outline"></ion-icon>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="action-sheet-content">
                                    
                                    <div class="mb-2 text-center">
                                        <h2 class="text-white mt-2"><?= strtoupper($val['name']) ?></h2>
                                        <span class="text-muted">(<?= $val['lvl'] ?>)</span> <br><br>
                                        <a href="#" class="btn btn-pink"><span class="fee text-light"><img src="../assets/img/bl.svg" alt=""> <?= number_format(totalBalance($val['id'], $val['balance'])) ?></span></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- * Default Action Sheet -->
                <?php }} ?>
            </ul>
        </div>

        <?php  
            $hrefAdd = "";
            $limit = 10;
            $total_pages = ceil($total / $limit);
            $prev = max(1, $page - 1);
            $next = min($total_pages, $page + 1);
            if($total_pages > 1 && $dataTable['row'] > 0){
        ?>
        <div class="section mb-2 full">
            <nav aria-label="Page navigation example">
                <ul class="pagination pagination-sm  justify-content-center">
                    <li class="page-item <?= $page <= 1 ? 'disabled' : '' ?>">
                        <a class="page-link" href="?page=<?= $prev.$hrefAdd ?>" aria-label="Previous">
                            <span aria-hidden="true">«</span>
                        </a>
                    </li>
                    <?php  
                                if($total_pages <= 6){
                                    for($i = 1; $i <= $total_pages; $i++){
                            ?>
                    <li class="page-item <?= $page == $i ? 'active' : '' ?>">
                        <a class="page-link" href="?page=<?= $i.$hrefAdd ?>"><?= $i ?></a>
                    </li>
                    <?php  
                                    }
                                }else{
                                    if($page < 5){
                                        for($i = 1; $i <= 5; $i++){
                            ?>
                    <li class="page-item <?= $page == $i ? 'active' : '' ?>">
                        <a class="page-link" href="?page=<?= $i.$hrefAdd ?>"><?= $i ?></a>
                    </li>
                    <?php
                                        }
                            ?>
                    <li class="page-item disabled">
                        <a class="page-link">...</a>
                    </li>
                    <li class="page-item <?= $page == $total_pages ? 'active' : '' ?>">
                        <a class="page-link"
                            href="?page=<?= $total_pages.$hrefAdd ?>"><?= $total_pages; ?></a>
                    </li>
                    <?php
                                    }elseif($page == $total_pages || $total_pages-$page < 4){
                            ?>
                    <li class="page-item <?= $page == 1 ? 'active' : '' ?>">
                        <a class="page-link" href="?page=1<?= $hrefAdd ?>">1</a>
                    </li>
                    <li class="page-item disabled">
                        <a class="page-link">...</a>
                    </li>
                    <?php  
                                        for($i = $total_pages-4; $i <= $total_pages; $i++){
                            ?>
                    <li class="page-item <?= $page == $i ? 'active' : '' ?>">
                        <a class="page-link" href="?page=<?= $i.$hrefAdd ?>"><?= $i ?></a>
                    </li>
                    <?php
                                        }
                                    }else{
                            ?>
                    <li class="page-item <?= $page == 1 ? 'active' : '' ?>">
                        <a class="page-link" href="?page=1<?= $hrefAdd ?>">1</a>
                    </li>
                    <li class="page-item disabled">
                        <a class="page-link">...</a>
                    </li>
                    <?php  
                                        for($i = $page-1; $i <= $page+1; $i++){
                            ?>
                    <li class="page-item <?= $page == $i ? 'active' : '' ?>">
                        <a class="page-link" href="?page=<?= $i.$hrefAdd ?>"><?= $i; ?></a>
                    </li>
                    <?php  
                                        }
                            ?>
                    <li class="page-item disabled">
                        <a class="page-link">...</a>
                    </li>
                    <li class="page-item <?= $page == $total_pages ? 'active' : '' ?>">
                        <a class="page-link"
                            href="?page=<?= $total_pages.$hrefAdd ?>"><?= $total_pages; ?></a>
                    </li>
                    <?php
                                    }
                                }
                            ?>
                    <li class="page-item <?= $page >= $total_pages ? 'disabled' : '' ?>">
                        <a class="page-link" href="?page=<?= $next.$hrefAdd ?>" aria-label="Next">
                            <span aria-hidden="true">»</span>
                        </a>
                    </li>
                </ul>
            </nav>
        </div>
        <?php } ?>




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
        <a href="home" class="item">
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
        <a href="user" class="item active">
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