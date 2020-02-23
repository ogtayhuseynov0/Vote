<?php
session_start();
//
//if (!isset($_SESSION["urid"])) {
//    header("location: main.php");
//}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0"/>
    <meta http-equiv="expires" content="30"/>
    <title>USG</title>

    <!-- CSS  -->
    <link href="css/font-awesome.min.css" rel="stylesheet">
    <link href="css/materialize.css" type="text/css" rel="stylesheet" media="screen,projection"/>
    <link href="css/style.css" type="text/css" rel="stylesheet" media="screen,projection"/>
    <!--end CSS-->
</head>
<body>
<!--begin nav-->
<div class="">
    <nav class="myColor " role="navigation">
        <div class="nav-wrapper container"><a href="#" class="brand-logo" id="mmm">USG</a>
            <ul class="right hide-on-med-and-down">
                <li><a href="#" onclick="anm(document.getElementById('ins'))">Instructors</a></li>
                <li><a href="#" onclick="anm(document.getElementById('abt'))">About</a></li>
                <?php
                if (isset($_SESSION["urid"])) {
                    echo '<li><a href="logout.php">Logout</a></li>';
                }else{
                    echo '<li><a href="main.php">Login | Register</a></li>';
                }
                ?>
            </ul>

            <ul id="nav-mobile" class="side-nav">
                <li><a href="#" onclick="anm(document.getElementById('ins'))">Instructors</a></li>
                <li><a href="#" onclick="anm(document.getElementById('abt'))">About</a></li>
                <?php
                if (isset($_SESSION["urid"])) {
                    echo '<li><a href="logout.php">Logout</a></li>';
                }else{
                    echo '<li><a href="main.php">Login | Register</a></li>';
                }
                ?>
            </ul>
            <a href="#" data-activates="nav-mobile" class="button-collapse"><i class="fa fa-bars"></i></a>
        </div>
    </nav>
</div>
<!--end nav-->
<!---->
<div class="parallax-container">
    <div class="parallax"><img src="images/unnamed.jpg"></div>
</div>
<div class="section ">
    <!--instructors-->
    <div class="container">
        <div class="row">
            <div class="hr-sect" id="ins"><h4>Top Scored Instructors</h4></div>
        </div>
        <div class="row">
            <?php include "topTree.php" ?>
        </div>
        <h6 class="center">
            <a href="instructors.php" class="btn myColor sll">See All</a>
        </h6>
    </div>
    <!--instructors-->
    <div class="row container">
        <div class="hr-sect"><h4 class="header" id="abt">About</h4></div>
        <p class="grey-text text-darken-3 lighten-3">
            This page was created by USG and published as a service for voting instructors of ADA University.
            To Vote and see results you should sign in from university mails which has ada.edu.az domains.
            So to vote you should be member of ADA community. Voting, criticizing and etc. completely anonim.
        </p>
    </div>
</div>
<div class="parallax-container">
    <div class="parallax"><img src="images/aasa.jpeg"></div>
</div>

<!--folating action button-->
<div class="fixed-action-btn">
    <a class="btn-floating btn-large myColor" id="upBtn" onclick="anm(document.getElementById('mmm'))">
        <i class="fa fa-arrow-circle-up"></i>
    </a>
</div>

<!---->
<footer class=" section" style="background-color: #ae475e;">
    <div class="footer-copyright">
        <div class="container">
            <span class="white-text">2017 All Rights Reserved by USG ©</span>
        </div>
    </div>
</footer>

<!--  Scripts-->
<script src="js/jquery-2.1.1.min.js"></script>
<script src="js/materialize.js"></script>
<script src="js/init.js"></script>
<script>

    function anm(item) {
        $('html, body').animate({
            scrollTop: $(item).offset().top
        }, 500);
    }
</script>
</body>
</html>
