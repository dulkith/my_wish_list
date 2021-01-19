<html>

<head>
    <meta charset="UTF-8">
    <title>My Wish List</title>
    <!-- Google fonts import  -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
          rel="stylesheet">
    <!-- Bootstrap style sheet -->
    <link rel="stylesheet" href="<?php echo base_url("assets/css/bootstrap.css"); ?>"/>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url("assets/js/bootstrap.js"); ?>"></script>
    <!-- Custom style sheet -->
    <link rel="stylesheet" href="<?php echo base_url("assets/css/main.css"); ?>"/>
    <script defer src="<?php echo base_url("assets/js/font-awsome/all.js"); ?>"></script>
    <script defer src="<?php echo base_url("assets/js/app.js"); ?>"></script>
    <!--  CW2 required libraries  -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/underscore.js/1.8.3/underscore-min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/backbone.js/1.4.0/backbone-min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <!--	TEST-->
    <script>
        // ***ONLY FOR TEST
        //setInterval(function(){location.reload(true);}, 10000);
    </script>
    <!--load all styles -->
</head>

<body>
<!-- Header -->
<header>
    <nav id="wishListHeader" class="fixed-top navbar navbar-expand-lg">
        <div class="container">
            <!-- Wish list logo -->
            <a class="nav-link" href="<?php echo base_url(); ?>index.php/wishListHome/index">
                <img class="logo" src="<?php echo base_url("assets/images/wish_list_logo_main.png"); ?>"
                     alt="Logo"></a>
            <div class="collapse navbar-collapse" id="navbarNav">
                <!-- Main navigation bar items -->
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item active">
                        <a class="nav-link" href="<?php echo base_url(); ?>index.php/wishListHome/index"><i
                                    class="fas fa-home fa-fw"></i> Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#"><i class="fas fa-heart fa-fw"></i> My Wish List</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#"><i class="fas fa-info-circle fa-fw"></i> About</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#"><i class="fas fa-sign-in-alt fa-fw"></i> Login</a>
                    </li>
                    <li class="nav-item">
                        <a href="<?php echo base_url(); ?>index.php/cart" class="nav-link d-flex flex-row">
                            <h3><span class="badge badge-success badge-danger">5</span>
                            </h3>
                            &nbsp;<i class="fas fa-gifts fa-2x"></i>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</header>
<!-- Header End -->
<script>
    window.onscroll = function () {
        handleScroll();
    }

    function handleScroll() {
        if (document.body.scrollTop > 1) {
            document.getElementById("wishListHeader").style.backgroundColor = "#f5f5f5";
        } else {
            document.getElementById("wishListHeader").style.backgroundColor = "transparent";
        }
    }
</script>