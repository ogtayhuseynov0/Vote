<?php
session_start();
include_once 'connect.php';
$uid = $_GET['id'];
$_SESSION["pid"] = $uid;

//if (!isset($_SESSION["urid"])) {
//    header("location: main.php");
//}
$stm = $conn->query("select * from instructors WHERE id='$uid'");
$res = $stm->fetch_assoc();
if ($stm->num_rows == 0) {
    header("location: instructors.php");
}

if (isset($_POST['vote'])) {
    if (!isset($_SESSION["urid"])) {
        header("location: main.php");
    } else {
        $insid = $_SESSION["pid"];
        $usid = $_SESSION["dd"];
        $s1 = $_POST["de"];
        $s2 = $_POST["me"];
        $s3 = $_POST["lu"];
        $s4 = $_POST["dlm"];
        $s5 = $_POST["grd"];
        $cmnt = $_POST["cmntt"];
        $overall = ($s1 + $s2 + $s3 + $s4 + $s5) / 5;
        $stmt = $conn->query("select * from scores where insid='$insid' and stid='$usid'");
        if ($stmt->num_rows > 0) {
            $conn->query("UPDATE scores SET difexam='$s1',method='$s2',languse='$s3',crmat='$s4',avggrade='$s5',
commentt='$cmnt',overall='$overall' WHERE insid='$insid' AND stid='$usid'");
        } else {
            $conn->query("INSERT INTO scores (insid,stid,difexam,method,
languse,crmat,avggrade,commentt,overall) VALUES ('$insid','$usid','$s1','$s2','$s3','$s4','$s5','$cmnt','$overall')");
        }
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0"/>
    <meta http-equiv="expires" content="30"/>
    <title>Profile</title>
    <!-- CSS  -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="css/font-awesome.min.css" rel="stylesheet">
    <?php include "css.php" ?>
    <link href="css/style.css" type="text/css" rel="stylesheet" media="screen,projection"/>
    <link href="css/profile.css" type="text/css" rel="stylesheet">
    <link href="css/form.css" type="text/css" rel="stylesheet">
    <!--end CSS-->
</head>
<body>
<!--begin nav-->
<div class="tt">
    <nav class="myColor nav-extended hide-on-large-only" id="mainNav" role="navigation">
        <div class="nav-wrapper "><a href="index.php" class="brand-logo" id="mmm">Vote</a>
            <a href="#" data-activates="slide-out" class="button-collapse"><i class="fa fa-bars mn"></i></a>

        </div>
    </nav>

    <!-- to see top nav remove hide-on-med-and-up  ve ul ni ice sal eslinde vacib deil deil ama yenede!!-->
    <ul id="slide-out" class="side-nav fixed show-on-medium sdn">
        <li>
            <div class="userView center">
                <div class="background  z-depth-1">
                    <?php echo '<img src="images/'.$res['prof_image']. '" width="300px" height="250" class="materialboxed" onerror="this.src=\'images/ins2.jpg\'">' ?>
                </div>
                <a href="#"><span class="circle center-block"></span></a>
                <a href="#"><span class="white-text name "><b class="myColor2"></b></span></a>
                <a href="#"><span class="white-text email "><b class="myColor2"></b></span></a><br><br>
            </div>
        </li>
        <li><a class="subheader">Who?</a></li>
        <li class="center">
            <span class="white-text name "><b
                    class="myColor2"><?php echo $res['name'] . ' ' . $res['surn'] ?></b></span>
            <br>
            <span class="white-text email "><b class="myColor2"><?php echo $res['pos'] ?></b></span>
        </li>
        <li><a class="subheader">Actions</a></li>
        <li><a href="#" class="waves-effect" id="infBtn"><i class="fa fa-info-circle fa-2x"
                                                            aria-hidden="true"></i>
                Info</a></li>
        <li><a href="#" class="waves-effect" id="vtBtn"><i class="fa fa-star-half-o fa-2x"
                                                           aria-hidden="true"></i>
                Vote</a></li>
        <li><a href="index.php" class="waves-effect"><i class="fa fa-home fa-2x" aria-hidden="true"></i>
                Home</a></li>
        <li><a href="instructors.php" class="waves-effect"><i class="fa fa-users fa-2x" aria-hidden="true"></i>
                Instructors</a></li>

        <?php
        if (isset($_SESSION["urid"])) {
            if (strcmp($_SESSION["urid"], "admin@ada.edu.az") == 0) {
                echo '<li><a href="admin.php" class="waves-effect"><i class="fa fa-user fa-2x" aria-hidden="true"></i>
        Admin</a></li>';
            }
            echo '<li><a href="mprof.php" class="waves-effect"><i class="fa fa-user fa-2x" aria-hidden="true"></i>
        My Profile</a></li>';
            echo '<li><a href="logout.php" class="waves-effect"><i class="fa fa-sign-out fa-2x" aria-hidden="true"></i>
        Logout</a></li>';
        } else {
            echo '<li><a href="main.php" class="waves-effect"><i class="fa fa-sign-in fa-2x" aria-hidden="true"></i>
        Login | Register</a></li>';
        }
        ?>

    </ul>
    <!--endd -->

</div>
<!--end nav-->
<!--begin loader-->
<div class="row center pred hide" id="propred">
    <div class="preloader-wrapper big active">
        <div class="spinner-layer spinner-myColor-only">
            <div class="circle-clipper left">
                <div class="circle"></div>
            </div>
            <div class="gap-patch">
                <div class="circle"></div>
            </div>
            <div class="circle-clipper right">
                <div class="circle"></div>
            </div>
        </div>
    </div>
</div>
<!-- endl loader-->


<div id="infoA">
    <?php include "info.php" ?>
</div>
<!--  Scripts-->
<?php include "scripts.php"?>

<script src="js/profAjax.js"></script>
<script src="js/vote.js"></script>
<script>
    $('#sidenav-overlay').opacity = 0;

    function anm(item) {
        $('html, body').animate({
            scrollTop: $(item).offset().top
        }, 500);
    }
</script>
</body>
</html>
