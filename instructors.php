<?php
session_start();

//if (!isset($_SESSION["urid"])) {
//    header("location: main.php");
//}
$dep = "all";
$ins = null;
if (isset($_POST["dep"])) {
    $dep = $_POST["dep"];
    $ins = $_POST["insId"];

}
$_SESSION["dep"] = $dep;
$_SESSION["ins"] = $ins;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0"/>
    <meta http-equiv="expires" content="30"/>

    <title>Instructors</title>

    <!-- CSS  -->
    <link href="css/font-awesome.min.css" rel="stylesheet">
    <?php include "css.php" ?>
    <link href="css/style.css" type="text/css" rel="stylesheet" media="screen,projection"/>
    <link href="css/form.css" type="text/css" rel="stylesheet">
    <link href="css/inst.css" type="text/css" rel="stylesheet" media="screen,projection"/>

    <!--end CSS-->
</head>
<body>
<!--begin nav-->
<div class="">
    <nav class="myColor" role="navigation">
        <div class="nav-wrapper container"><a id="logo-container" href="index.php" class="brand-logo">Vote</a>
            <ul class="right hide-on-med-and-down">
                <li><a href="index.php" onclick="anm(document.getElementById('abt'))">Home</a></li>
                <?php
                if (isset($_SESSION["urid"])) {
                    if (strcmp($_SESSION["urid"], "admin@ada.edu.az") == 0) {
                        echo '<li><a href="admin.php">Admin Page</a></li>';
                    }
                    echo '<li><a href="mprof.php">My Profile</a></li>';
                    echo '<li><a href="logout.php">Logout</a></li>';
                } else {
                    echo '<li><a href="main.php">Login | Register</a></li>';
                }
                ?>
            </ul>

            <ul id="nav-mobile" class="side-nav">
                <li><a href="index.php?akda=adas" onclick="anm(document.getElementById('abt'))">Home</a></li>
                <?php
                if (isset($_SESSION["urid"])) {
                    if (strcmp($_SESSION["urid"], "admin@ada.edu.az") == 0) {
                        echo '<li><a href="admin.php">Admin Page</a></li>';
                    }
                    echo '<li><a href="mprof.php">My Profile</a></li>';
                    echo '<li><a href="logout.php">Logout</a></li>';
                } else {
                    echo '<li><a href="main.php">Login | Register</a></li>';
                }
                ?>
            </ul>
            <a href="#" data-activates="nav-mobile" class="button-collapse "><i class="fa fa-bars white-text"></i></a>
        </div>
    </nav>
</div>

<!--<nav class="row white">-->
<div class="container">
    <div class="row">
        <div class=" col s12 card-panel" style="margin-top: 1%">
            <div class="row cc">
                <h5 class="left myColor2">&nbsp;&nbsp;Search Form</h5>
                <a href="#" onclick="$('#srcForm').hide(150);"><i class="fa fa-angle-up right fa-2x"></i></a>
                <a href="#" onclick="$('#srcForm').show(150);"><i class="fa fa-angle-down right fa-2x"></i></a>
            </div>

            <form method="post" action="instructors.php" id="srcForm" style="">
                <div class="input-field col s6">
                    <input id="searchc" type="text" placeholder="Instructor Name" name="insId">
                </div>
                <div class="input-field col s4">
                    <select id="sec" name="dep">
                        <option value="all" selected>All</option>
                        <option value="site">SITE</option>
                        <option value="sb">SB</option>
                        <option value="spia">SPIA</option>
                    </select>
                    <label for="sec">Deaprtment</label>
                </div>
                <div class="input-field col s1">
                    <button id="subb" type="submit" class="btn-floating waves-effect waves-light myColor" name="sss">
                        <i class="fa fa-search"></i>
                    </button>
                </div
            </form>
        </div>
    </div>
</div>
<!--</nav>-->
<!--main-->

<!--instructors-->
<div class="container">
    <div class="row">
        <div class="hr-sect" id="ins"><h4>Results</h4></div>
    </div>
    <div id="allIns">
        <div id="test-list">
            <div id="kelem">
                <?php include "all.php"; ?>
            </div>
            <div class="row">
                <div class="center-align">
                    <ul class="pagination myColor2">

                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<!--end main-->


<!--footer-->
<footer class="section" style="">
    <div class="footer-copyright">
        <div class="container">
            <span class="">2017 All Rights Reserved by Vote ©</span>
        </div>
    </div>
</footer>
<!--  Scripts-->


<?php include "scripts.php"?>

<script src="js/listing.min.js"></script>

<script>
    var monkeyList = new List('test-list', {
        valueNames: ['name'],
        page: 6,
        pagination: true
    });

    function anm(item) {
        $('html, body').animate({
            scrollTop: $(item).offset().top
        }, 500);
    }
</script>
</body>
</html>