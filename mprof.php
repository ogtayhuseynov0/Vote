<?php
session_start();
include_once 'conn.php';

//if (!isset($_SESSION["urid"])) {
//    header("location: main.php");
//}
$uml = $_SESSION['urid'];
if (isset($_POST["sbmt"])) {
    $old = $_POST["oldpss"];
    $new = $_POST["npss"];
    $cnew = $_POST["cnpss"];

    if (strcmp($new, $cnew) == 0) {
        $stpd = $pdo->prepare("SELECT * FROM regReq WHERE email=:riid AND u_pss=:pss");
        $stpd->bindValue(':riid', $uml);
        $stpd->bindValue(':pss', $old);
        $stpd->execute();
        if($stpd->rowCount()>0) {
            $stp = $pdo->prepare("UPDATE regReq SET u_pss=:pss WHERE email=:riid");
            $stp->bindValue(':pss', $new);
            $stp->bindValue(':riid', $uml);
            $stp->execute();
            if ($stp->rowCount() > 0) {
                echo "<div class='container' id='errm'><div class=\"input-field z-depth-1 card-panel green white-text \" id=\"err-panel3\" style=''>
                        Passwords has been changed!
                    <a href='#' onclick='$(\"#errm\").hide(150);'><i class='fa fa-close right' aria-hidden='true'></i></a></div></div>";
            }
        }else{
            echo "<div class='container' id='errm'><div class=\"input-field z-depth-1 card-panel red white-text \" id=\"err-panel3\" style=''>
                        Old password is not correct!
                    <a href='#' onclick='$(\"#errm\").hide(150);'><i class='fa fa-close right' aria-hidden='true'></i></a></div></div>";

        }
    } else {
        echo "<div class='container' id='errm'><div class=\"input-field z-depth-1 card-panel red white-text \" id=\"err-panel3\" style=''>
                        Passwords are not same!
                    <a href='#' onclick='$(\"#errm\").hide(150);'><i class='fa fa-close right' aria-hidden='true'></i></a></div></div>";
    }
}

if(isset($_GET["sid"])){
    if(password_verify($_GET["sid"],$_GET["hd"])==1){
        $idd=$_GET["sid"];
        $stt=$pdo->prepare("DELETE FROM scores WHERE sid=:sidd");
        $stt->bindValue(':sidd',$idd);
        $stt->execute();
        if($stt->rowCount()>0){
            echo "<div class='container' id='errm'><div class=\"input-field z-depth-1 card-panel green white-text \" id=\"err-panel3\" style=''>
                        Vote Deleted!
                    <a href='#' onclick='$(\"#errm\").hide(150);'><i class='fa fa-close right' aria-hidden='true'></i></a></div></div>";
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
        <li><a class="subheader">You</a></li>
        <li class="center">
            <span class="white-text name "><b class="myColor2"><?php echo $uml ?></b></span>
        </li>
        <li><a class="subheader">Actions</a></li>
        <li><a href="#" class="waves-effect" id="vtBtn" onclick="$('#passA').hide(150);$('#voteA').show(50);"><i
                    class="fa fa-star-half-o fa-2x" aria-hidden="true"></i>
                My Votes</a></li>
        <li><a href="#" class="waves-effect" id="infBtn" onclick="$('#voteA').hide(150);$('#passA').show(50);"><i
                    class="fa fa-asterisk fa-2x" aria-hidden="true"></i>
                Change My Password</a></li>
        <li><a href="logout.php" class="waves-effect" id="infBtn"><i class="fa fa-sign-out fa-2x"
                                                                     aria-hidden="true"></i>
                Log Out</a></li>
        <li><a class="subheader">Links</a></li>
        <li><a href="index.php" class="waves-effect" id="infBtn"><i class="fa fa-home fa-2x" aria-hidden="true"></i>
                Home</a></li>
        <li><a href="instructors.php" class="waves-effect"><i class="fa fa-users fa-2x" aria-hidden="true"></i>
                Instructors</a></li>


    </ul>
    <!--endd -->

</div>
<!--end nav-->
<div id="passA" class=" container" style="display: none">
    <div class=" card-panel">
        <form class="col s12 " method="post" action="mprof.php">
            <div class="row">
                <div class="hr-sect" id="ins">
                    <i class="material-icons prefix fa fa-pencil fa-2x" aria-hidden="true"></i>
                    <h4>&nbsp;Change Password</h4></div>
            </div>

            <div class="row">
                <div class="input-field col s12">
                    <input class="hoverable" type="password" placeholder="Old Password" name="oldpss" required>
                </div>
                <div class="input-field col s12">
                    <input class="hoverable" type="password" placeholder="New Password" name="npss" required>
                </div>
                <div class="input-field col s12">
                    <input class="hoverable" type="password" placeholder="Confirm New Password" name="cnpss" required>
                </div>
                <div class="input-field col s12">
                    <input id="cid" type="submit" class="btn myColor" value="Change" name="sbmt">
                </div>
            </div>
        </form>
    </div>
</div>

<div id="voteA">
    <div id="allIns123">
        <div id="test-list1">
            <div id="kelem">
                <?php include "myVotes.php"; ?>
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
<!--  Scripts-->
<?php include "scripts.php"?>

<script src="js/listing.min.js"></script>

<script>
    $('#sidenav-overlay').opacity = 0;
    var monkeyList1 = new List('test-list1', {
        valueNames: ['ttb'],
        page: 10,
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
