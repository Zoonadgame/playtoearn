<!doctype html>
<html lang="en">

<head>
    <?php include "partial/head.php" ?>
    <title>Zoonad | Mine</title>
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
            background: #202022;
        }
        .box-info{
            background-color: rgba(255, 255, 255, 0.1);
            padding: 1px;
            border-radius: 100px 100px 100px 100px;
            -webkit-border-radius: 100px 100px 100px 100px;
            -moz-border-radius: 100px 100px 100px 100px;
        }
        .box-info img{
            min-width: 10px;
            max-width: 15px;
        }

        .bg-nav{
            background-color: rgba(255, 255, 255, 0.1);
            padding: 1px;
            border-radius: 100px 100px 100px 100px;
            -webkit-border-radius: 100px 100px 100px 100px;
            -moz-border-radius: 100px 100px 100px 100px;
        }

        .card-up{
            width: 100%;
            height: 220px;
            background-color: rgba(255, 255, 255, 0.1);
            padding: 2px;
            border-radius: 10px 10px 10px 10px;
            -webkit-border-radius: 10px 10px 10px 10px;
            -moz-border-radius: 10px 10px 10px 10px;
            display: block;
            color: #757073;
        }

        .card-up img{
            min-width: 10px;
            max-width: 35%;
            border-radius: 100px 100px 100px 100px;
            -webkit-border-radius: 100px 100px 100px 100px;
            -moz-border-radius: 100px 100px 100px 100px;
        }

        .card-up h3{
            font-size: medium;
            color: #ffffff;
        }

        .card-up .text-profit{
            font-size: smaller;
            color: #ffffff;
        }

        .card-up .fee img{
            min-width: 10px;
            max-width: 15px;
        }

        .card-up .footer-card-up{
            width: 100%;
            padding-top: 15px;
            border-top: 1px solid rgba(1,1,1,0.57);
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
        .modal .modal-dialog .modal-content .modal-body img{
            min-width: 10px;
            max-width: 95px;
            border-radius: 100px 100px 100px 100px;
            -webkit-border-radius: 100px 100px 100px 100px;
            -moz-border-radius: 100px 100px 100px 100px;
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
        <img src="assets/img/loading-icon.png" alt="icon" class="loading-icon">
    </div>
    <!-- * loader -->

    <!-- App Capsule -->
    <div id="appCapsule mt-0">

    
        <div class="section full">
            <div class="row">
                <div class="col-5 p-2 text-start">
                    <!-- LVL -->
                    <div class="row">
                        <!-- label lvl -->
                        <div class="col text-start">
                            <span class="text-white" style="font-size: 0.7rem;">Bronze ></span>
                        </div>
                        <!-- num lvl -->
                        <div class="col text-end">
                            <span class="text-white" style="font-size: 0.7rem;">Level 1/10</span>
                        </div>
                    </div>
                    <!-- lvl progress -->
                    <div class="progress" style="height: 5px;">
                        <div class="progress-bar" role="progressbar" style="width: 25%; background-color: #ff2ca9;" aria-valuenow="25"
                            aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                </div>
                <div class="col-7 p-2 text-end">
                    <div class="box-info text-center">
                        <span class="text-white"  style="font-size: 0.7rem;">Profit per hour</span> | 
                        <img src="assets/img/coin.svg" alt="" >
                        <span class="text-white"  style="font-size: 0.7rem;">+12k</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="section full">
            <div class="card main">
                <div class="card-body">
                    <!-- category -->
                    <div class="bg-nav mt-2">
                        <div class="btn-group" role="group" style="width: 100%;">
                            <input type="radio" class="btn-check" name="categoryCard" id="categoryCardSkill" checked>
                            <label class="btn btn-outline-danger border-0" for="categoryCardSkill">Skills</label>
    
                            <input type="radio" class="btn-check" name="categoryCard" id="categoryCardBusiness">
                            <label class="btn btn-outline-danger border-0" for="categoryCardBusiness">Business</label>
    
                            <input type="radio" class="btn-check" name="categoryCard" id="categoryCardSpecial">
                            <label class="btn btn-outline-danger border-0" for="categoryCardSpecial">Special</label>
                        </div>
                    </div>

                    <div id="skillCard" class="row g-0 mt-5">
                        <div class="col-6 mb-2">
                            <button data-bs-toggle="modal" data-bs-target="#actionSheet" class="card-up text-center">
                                <img src="assets/img/card/zoo.svg" alt=""> <br>
                                <h3>Zoo Portal</h3>
                                <span class="text-profit">Profit per hour </span> 
                                <span class="fee"><img src="assets/img/coin-dark.svg" alt=""> +100</span>
                                <div class="footer-card-up mt-2">
                                    <div class="row">
                                        <div class="col text-end">
                                            <span>lvl 0</span>
                                        </div>
                                        <div class="col text-start">
                                            <span class="fee text-white"><img src="assets/img/coin.svg" alt=""> 1k</span>
                                        </div>
                                    </div>
                                </div>
                            </button>
                        </div>
                        <div class="col-6 mb-2">
                            <button class="card-up text-center">
                                <img src="assets/img/card/zoo-lock.svg" alt=""> <br>
                                <h3>Zoo Portal 2</h3>
                                <span class="text-profit">Profit per hour </span> 
                                <span class="fee"><img src="assets/img/coin-dark.svg" alt=""> +100</span>
                                <div class="footer-card-up mt-2">
                                    <span>lvl 0</span> | <span class="fee" style="font-size: smaller;">Zoo Portal lvl 5</span>
                                    <!-- <div class="row">
                                        <div class="col">
                                        </div>
                                        <div class="col">
                                        </div>
                                        <div class="col text-start">
                                        </div>
                                    </div> -->
                                </div>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Default Action Sheet -->
        <div class="modal fade action-sheet" id="actionSheet" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content bg-black">
                    <div class="modal-header text-end">
                        <button type="button" data-bs-dismiss="modal" class="btn btn-icon text-white me-1 mt-3 mb-1">
                            <ion-icon name="close-outline"></ion-icon>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="action-sheet-content">
                            
                            <div class="mb-3 text-center">
                                <img src="assets/img/card/zoo.svg" alt="">
                                <h1 class="text-white">Zoo Portal</h1>
                                <p style="font-size: small;">Lorem ipsum dolor sit amet consectetur adipisicing elit. Vitae illo laborum delectus aliquid esse voluptate, doloremque quasi explicabo, accusamus </p>
                                <p>Profit per hour</p>
                                <span class="fee"><img src="assets/img/coin.svg" alt=""> +1000</span>
                            </div>

                            <div class="form-group basic">
                                <button type="button" class="btn btn-block btn-lg text-white"
                                    data-bs-dismiss="modal">
                                    <span class="fee">Level 1 <img src="assets/img/coin.svg" alt=""> 1k</span>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- * Default Action Sheet -->


    </div>
    <!-- * App Capsule -->


    <!-- App Bottom Menu -->
    <div class="appBottomMenu no-border">
        <a href="home" class="item">
            <div class="col">
                <ion-icon name="home-outline"></ion-icon>
                <strong>Home</strong>
            </div>
        </a>
        <a href="mine" class="item active">
            <div class="col">
                <ion-icon name="hammer-outline"></ion-icon>
                <strong>Mine</strong>
            </div>
        </a>
        <a href="friends" class="item">
            <div class="col">
                <ion-icon name="people-outline"></ion-icon>
                <strong>Friends</strong>
            </div>
        </a>
        <a href="earn" class="item">
            <div class="col">
                <ion-icon name="diamond-outline"></ion-icon>
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


</body>

</html>