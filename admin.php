<?php
session_start();

if (!strcmp($_SESSION["urid"], "admin@ada.edu.az") == 0) {
    header("location: main.php");
}
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
include_once "conn.php";
if (isset($_POST["submit"])) {
    $target = 'images/' . basename($_FILES["img"]["name"]);
    $image = addslashes(file_get_contents($_FILES["img"]["tmp_name"])); //SQL Injection defence!
    $image_name = addslashes($_FILES["img"]["name"]);
    $nname = $_POST["nm"];
    $surname = $_POST["sm"];
    $pos = $_POST["pos"];
    $dep = $_POST["dep"];
    $about = $_POST["about"];
    $exper = $_POST["exper"];
    $educ = $_POST["educ"];

    $sql = "INSERT INTO instructors (name,surn,pos,dep,about,edc,exp,prof_image) 
VALUES(:name,:surn,:pos,:dep,:about,:edc,:exp,:prof_image)";
    $stm = $pdo->prepare($sql);
    $stm->bindParam(':name', $nname);
    $stm->bindParam(':surn', $surname);
    $stm->bindParam(':pos', $pos);
    $stm->bindParam(':dep', $dep);
    $stm->bindParam(':about', $about);
    $stm->bindParam(':edc', $educ);
    $stm->bindParam(':exp', $exper);
    $stm->bindParam(':prof_image', $image_name);
    $stm->execute();
    move_uploaded_file($_FILES["img"]["tmp_name"], 'images/' . basename($_FILES["img"]["name"]));
    if ($stm->rowCount() > 0) {
        echo "<div class='container' id='errm'><div class=\"input-field z-depth-1 card-panel green white-text \" id=\"err-panel3\" style=''>
                        User Added
                    <a href='#' onclick='$(\"#errm\").hide(150);'><i class='fa fa-close right' aria-hidden='true'></i></a></div></div>";

    }

}
if (isset($_GET["did"])) {
    $didd = $_GET["did"];
    $das = $_GET["dh"];
    if (password_verify($didd, $das) == 1) {

        $stom = $pdo->prepare("DELETE FROM instructors WHERE id=:did");
        $stom->bindValue(':did', $didd);
        $stom->execute();
        if ($stom->rowCount() > 0) {
            echo "<div class='container' id='errm'><div class=\"input-field z-depth-1 card-panel green white-text \" id=\"err-panel3\" style=''>
                        Instructor Deleted
                    <a href='#' onclick='$(\"#errm\").hide(150);'><i class='fa fa-close right' aria-hidden='true'></i></a></div></div>";

        }
    }
}
if (isset($_GET["rid"])) {
    $didd = $_GET["rid"];
    $das = $_GET["dh"];
    if (password_verify($didd, $das) == 1) {
        $stom = $pdo->prepare("DELETE FROM regReq WHERE rid=:did");
        $stom->bindValue(':did', $didd);
        $stom->execute();
        if ($stom->rowCount() > 0) {
            echo "<div class='container' id='errm'><div class=\"input-field z-depth-1 card-panel green white-text \" id=\"err-panel3\" style=''>
                        User Deleted
                    <a href='#' onclick='$(\"#errm\").hide(150);'><i class='fa fa-close right' aria-hidden='true'></i></a></div></div>";

        }
    }
}
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin</title>
    <!--    css-->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="css/font-awesome.min.css" rel="stylesheet">
    <?php include "css.php" ?>
    <link href="css/style.css" type="text/css" rel="stylesheet" media="screen,projection"/>
    <link href="css/profile.css" type="text/css" rel="stylesheet">
    <link href="css/form.css" type="text/css" rel="stylesheet">

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
        <li><a class="subheader">Actions</a></li>
        <li><a href="#" class="waves-effect" id="vtBtn" onclick="$('#addInst').show(150);$('#manIns').hide(150);$('#userMan').hide(150);"><i
                    class="fa fa-user-plus fa-2x" aria-hidden="true"></i>
                Add Instructor</a></li>
        <li><a href="#" class="waves-effect" id="infBtn" onclick="$('#addInst').hide(150);$('#manIns').show(150);$('#userMan').hide(150);"><i
                    class="fa fa-list-alt fa-2x" aria-hidden="true"></i>
                Manage Instructors</a></li>
        <li><a href="#" class="waves-effect" id="infBtn" onclick="$('#addInst').hide(150);$('#manIns').hide(150);$('#userMan').show(150);">
                <i class="fa fa-users fa-2x" aria-hidden="true"></i>
                Manage Users</a></li>
        <li><a href="logout.php" class="waves-effect" id="infBtn">
                <i class="fa fa-sign-out fa-2x" aria-hidden="true"></i>
                Log Out</a></li>
        <li><a class="subheader">Links</a></li>
        <li><a href="index.php" class="waves-effect" id="infBtn">
                <i class="fa fa-home fa-2x" aria-hidden="true"></i>
                Home</a></li>
        <li><a href="instructors.php" class="waves-effect">
                <i class="fa fa-users fa-2x" aria-hidden="true"></i>
                Instructors</a></li>


    </ul>
    <!--endd -->
</div>
<!--Add Instrcutor-->
<div id="addInst">
    <div class="container">
        <div class="row card-panel" id="fullInserForm">
            <div class="row">
                <div class="hr-sect" id="ins">
                    <i class="material-icons prefix fa fa-user-plus fa-2x" aria-hidden="true"></i>
                    <h4>&nbsp;Add Instructor</h4></div>
            </div>
            <div class="col s12 ">
                <form method="post" role="form" action="admin.php" id="frm" enctype="multipart/form-data">
                    <label for="nm">Name: </label>
                    <input type="text" name="nm" id="nm" placeholder="Instructor name">
                    <label for="sm">Surname: </label>
                    <input type="text" name="sm" id="sm" placeholder="Instructor surname">
                    <label for="pos">Position: </label>
                    <input type="text" name="pos" id="pos" placeholder="Ex. Instructor">
                    <select form="frm" name="dep">
                        <option value="" disabled selected>Department</option>
                        <option value="SITE">SITE</option>
                        <option value="SPIA">SPIA</option>
                        <option value="SB">SB</option>
                    </select>

                    <label for="ab">About: </label>
                    <textarea type="text" class="materialize-textarea" title="About" name="about" id="ab"
                              placeholder="About"></textarea>
                    <label for="exp">Experience: </label>
                    <textarea type="text" class="materialize-textarea" title="Experience" name="exper"
                              placeholder="Experience"></textarea>
                    <label for="ed">Education: </label>
                    <textarea type="text" class="materialize-textarea" title="Education" name="educ"
                              placeholder="Education"></textarea>
                    <div class="file-field input-field">
                        <div class="btn">
                            <span>Picture</span>
                            <input type="file" name="img">
                        </div>
                        <div class="file-path-wrapper">
                            <input class="file-path validate" type="text" placeholder="Profile Pic.">
                        </div>
                    </div>
                    <input type="submit" value="Load" name="submit" class="btn">
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Manage-->
<div id="manIns" style="display: none">
    <div class="container">
        <div class="row card-panel">
            <div class="row">
                <div class="hr-sect" id="ins">
                    <i class="material-icons prefix fa fa-list-alt fa-2x" aria-hidden="true"></i>
                    <h4> &nbsp; Manage Instructors</h4></div>
            </div>
            <div id="test-list1">
                <div id="kelem">
                    <?php include "manInst.php"; ?>
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
</div>

<div id="userMan" style="display: none">
    <div class="container">
        <div class="row card-panel">
            <div class="row">
                <div class="hr-sect" id="ins">
                    <i class="material-icons prefix fa fa-users fa-2x" aria-hidden="true"></i>
                    <h4> &nbsp; Manage Users</h4></div>
            </div>
            <div id="test-list12">
                <div id="kelem">
                    <?php include "mUSERS.php"; ?>
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
</div>

<!--  Scripts-->
<?php include "scripts.php"?>

<script src="js/listing.min.js"></script>

<script>
    var monkeyList1 = new List('test-list1', {
        valueNames: ['ttb'],
        page: 10,
        pagination: true
    });
    var monkeyList12 = new List('test-list12', {
        valueNames: ['ttb'],
        page: 10,
        pagination: true
    });
    $(document).ready(function () {
        $('select').material_select();
    });
</script>
</body>
</html>
