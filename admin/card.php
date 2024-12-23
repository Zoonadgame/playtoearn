<?php include "config/cardConfig.php" ?>
<!doctype html>
<html lang="en">

<head>
    <?php include "head.php" ?>
    <title>Admin | Card</title>
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
    <link rel="stylesheet" href="../assets/css/custome.css">
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
        <div class="pageTitle">Card</div>
        <div class="right">
            <a href="config/configLogout" class="headerButton" onclick="loadingForm()">
                <ion-icon name="power"></ion-icon>
            </a>
        </div>
    </div>
    <!-- * App Header -->

    <!-- App Capsule -->
    <div id="appCapsule">
        <div class="section mt-3">
            <button type="button" data-bs-toggle="modal" data-bs-target="#addCard" class="btn btn-pink btn-sm" style="width: 100%;">Add Card</button>
            <!-- Default Action Sheet -->
            <div class="modal fade modalbox" id="addCard" tabindex="-1" role="dialog">
                <div class="modal-dialog" role="document">
                    <form action="" method="post" class="modal-content bg-black" enctype="multipart/form-data">
                        <div class="modal-header" style="background-color: #ff2ca9;">
                            <h5 class="modal-title text-white">Add Card</h5>
                            <a href="#" data-bs-dismiss="modal" class="text-white">
                                close
                            </a>
                        </div>
                        <div class="modal-body">
                            <div class="action-sheet-content">
                                <div class="mb-2">
                                    <label for="img" class="form-label text-white">Image</label>
                                    <input type="file" id="img" name="img" class="form-control form-control-sm">
                                </div>
                                <div class="mb-2">
                                    <label for="name" class="form-label text-white">Title</label>
                                    <input type="text" id="name" name="name" class="form-control form-control-sm" placeholder="cth: Elons Tweet">
                                </div>
                                <div class="mb-2">
                                    <label for="descName" class="form-label text-white">Desc</label>
                                    <textarea id="descName" name="descName" class="form-control form-control-sm" placeholder="Desc Card"></textarea>
                                </div>
                                <div class="mb-2">
                                    <label for="category" class="form-label text-white">Category</label>
                                    <select name="category" id="category" class="form-select" style="background-color: white;">
                                        <option value="">--Choose Category--</option>
                                        <option value="1">Tech Upgrade</option>
                                        <option value="2">Market</option>
                                        <option value="3">Special Power</option>
                                    </select>
                                </div>
                                <div class="mb-2">
                                    <div class="row">
                                        <div class="col-4">
                                            <label for="startfee" class="form-label text-white">Fee lvl 1</label>
                                            <input type="number" id="startfee" name="startfee" step="0.0001" class="form-control form-control-sm" placeholder="1000">
                                        </div>
                                        <div class="col-4">
                                            <label for="profitpersen" class="form-label text-white">Profit (%)</label>
                                            <input type="number" id="profitpersen" name="profitpersen" step="0.0001" class="form-control form-control-sm" placeholder="10">
                                        </div>
                                        <div class="col-4">
                                            <label for="upfeepersen" class="form-label text-white">Up Fee (%)</label>
                                            <input type="number" id="upfeepersen" name="upfeepersen" step="0.0001" class="form-control form-control-sm" placeholder="100">
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-2">
                                    <label for="cd" class="form-label text-white">Countdown (Detik)</label>
                                    <input type="number" id="cd" name="cd" class="form-control form-control-sm" placeholder="cth: 3600">
                                </div>
                                <div class="mb-2">
                                    <label for="unlock" class="form-label text-white">Unlock</label>
                                    <select name="unlock" id="unlock" class="form-select" style="background-color: white;">
                                        <option value="NONE">None</option>
                                        <option value="OWNED OTHER CARD">Owned Other Card</option>
                                        <option value="STREAK LOGIN">Streak Login</option>
                                    </select>
                                </div>
                                <div class="mb-2">
                                    <label for="otCd" class="form-label text-white">Other Card</label>
                                    <select name="otCd" id="otCd" class="form-select" style="background-color: white;">
                                        <option value="">--Choose Other Card--</option>
                                        <?php  
                                            $optValue = optValue();
                                            foreach($optValue['data'] as $opt){
                                        ?>
                                            <option value="<?= $opt['card_id'] ?>.<?= $opt['card_name'] ?>"><?= $opt['card_name'] ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="mb-2">
                                    <label for="lvlCard" class="form-label text-white">Lvl Card / Hari</label>
                                    <input type="number" id="lvlCard" name="lvlCard" class="form-control form-control-sm" placeholder="cth: 5">
                                </div>
                                <div class="mb-2 text-start">
                                    <span>Keterangan Unlock:</span>
                                    <ul style="font-size: smaller;">
                                        <li>None: Kosongkan Other Card dan Lvl card / hari</li>
                                        <li>Owned Other Card: Wajib menginput Other Card dan Lvl card / hari</li>
                                        <li>Streak Login: Wajib menginput Lvl card / hari sebagai jumlah hari login streak</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-pink" style="width: 100%;" type="submit" name="saveCard" onclick="loadingForm()">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
            <!-- * Default Action Sheet -->
        </div>
        <?php $total = countDataCard(); ?>
        <div class="section mt-3">
            <div class="row">
                <?php
                if($dataTable['row'] > 0){ 
                    foreach($dataTable['data'] as $val){ 
                ?>
                <a data-bs-toggle="modal" data-bs-target="#actionSheet" class="col-6 mb-3">
                    <div class="card-mine text-center">
                        <div class="card-mine-body">
                            <div class="title-img mb-1">
                                <img class="card-mine-img mb-2" src="../<?= $val['card_img'] ?>" alt="elon">
                                <h6 class="text-white"><?= $val['card_name'] ?></h6>
                            </div>
                        </div>
                        <div class="text-center mt-2">
                            <button class="btn btn-danger btn-sm">Delete</button>
                        </div>
                    </div>
                </a>
                <?php }} ?>
            </div>
        </div>

        <?php  
            $hrefAdd = "";
            $limit = 6;
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
        <a href="card" class="item active">
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
    <script>
        function loadingForm() {
            // Mengatur tombol menjadi tidak dapat di-klik selama proses loading
            document.getElementById("loader").style.display  = "";
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