<?php
session_start();
include_once "conn.php";

if (isset($_SESSION["urid"])) {
    header("location: index.php");
}


?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="css/font-awesome.min.css" rel="stylesheet">
    <?php include "css.php" ?>
    <link href="css/style.css" type="text/css" rel="stylesheet" media="screen,projection"/>
    <link href="css/form.css" type="text/css" rel="stylesheet">
    <title>Login</title>
</head>
<body style="background-image: url('./images/unnamed.jpg');">
<div class="">
    <nav class="myColor " role="navigation">
        <div class="nav-wrapper container">
            <a href="index.php" class="brand-logo center" id="mmm">Vote</a>
        </div>
    </nav>
</div>
<!--main-->
<div class="row ">
    <div id="logDiv" class="col s12 m4 offset-m4 hoverable card-panel"
         style="border: 1px solid #bababa;border-radius: 1px;">
        <div id="loginDiv">
            <div class="form " style="margin-right: 10px">
                <div class="row">
                    <div class="hr-sect" id="ins">
                        <i class="material-icons prefix fa fa-sign-in fa-2x" aria-hidden="true"></i>
                        <h4>&nbsp;Login</h4></div>
                </div>
                <form action="main.php" method="post">
                    <div class="input-field s12 ">
                        <i class="material-icons prefix fa fa-envelope-o" aria-hidden="true"></i>
                        <input type="email" name="em" id="em" placeholder="ADA email.."
                               class="hoverable">
                    </div>
                    <div class="input-field">
                        <i class="material-icons prefix fa fa-asterisk" aria-hidden="true"></i>
                        <input type="password" name="ps" id="ps" placeholder="Password"
                               class="hoverable">
                    </div>
                    <?php
                    if (isset($_POST["ps"])) {
                        $mel = $_POST["em"];
                        $psr = $_POST["ps"];
                        $stm = $pdo->prepare("select * from regReq where email=:email and u_pss = :u_pass");
                        $stm->bindValue(':email', $mel);
                        $stm->bindValue(':u_pass', $psr, PDO::PARAM_STR);
                        $stm->execute();
                        $rese = $stm->fetchAll(PDO::FETCH_ASSOC);
//                        $stm = $conn->query("select * from regReq where email='$mel' and u_pss='$psr'");
//                        $res = $stm->fetch_assoc();

                        if (count($rese) > 0) {
                            if ($rese[0]["confirmed"] == 0) {
                                echo "<div class=\"input-field z-depth-1 card-panel red white-text \" id=\"err-panel3\">
                            Registered but not confirmed!! Confrm your email
                            </div>";
                            } else {
                                $_SESSION["urid"] = $rese[0]["email"];
                                $_SESSION["dd"] = $rese[0]["rid"];
                                header("location: index.php");
                            }

                        } else {
                            echo "<div class=\"input-field z-depth-1 card-panel red white-text \" id=\"err-panel3\">
                    Not registered!
                    </div>";
                        }
                    }
                    if (isset($_GET["ml"]) && isset($_GET["mr"])) {
                        $rdd = $_GET["mr"] - 5;
                        if (password_verify($rdd, $_GET["ml"])) {
                            $bir = 1;
                            $quer = "UPDATE regReq SET confirmed=:confirmed WHERE rand_n=:rand_n";
                            $stm = $pdo->prepare($quer);
                            $stm->bindValue(":confirmed", $bir);
                            $stm->bindValue(":rand_n", $rdd);
                            $stm->execute();
                            echo "<div class=\"input-field z-depth-1 card-panel green white-text \" id=\"err-panel3\">
                        Registration Completed!!
                    </div>";
                        }
                    }
                    if (isset($_POST["rem"])) {

                        $mel = $_POST["rem"];
                        $psr = $_POST["rps"];
                        $rannd = rand(1, 99999);
                        $zero = 0;
                        $qr="SELECT * FROM regReq WHERE email=:eml";
                        $stf=$pdo->prepare($qr);
                        $stf->bindValue(":eml",$mel);
                        $stf->execute();
                        if($stf->rowCount()>0){
                            echo "<div class=\"input-field z-depth-1 card-panel red white-text \" id=\"err-panel3\">
                        Email already registred!
                    </div>";
                        }else {
                            $stm = $pdo->prepare("insert into regReq(email,u_pss,rand_n,confirmed) VALUES (:email,:u_pass,:rand_n,:confirmed)");
                            $stm->bindValue(':email', $mel);
                            $stm->bindValue(':u_pass', $psr);
                            $stm->bindValue(':rand_n', $rannd);
                            $stm->bindValue(':confirmed', $zero);

                            $stm->execute();
                            include_once "send.php";
                            send($mel, $rannd);
                        }
//    $stm = $conn->query("insert into regReq(email,u_pss,rand_n,confirmed) VALUES ('$mel','$psr','12345','0')");
                    }

                    ?>
                    <div class="input-field z-depth-1 card-panel red white-text " id="err-panel1">

                    </div>
                    <div class="input-field">
                        <input type="submit" name="lbtt" id="ps" value="Log me in" class="myColor btn"
                               style="margin-bottom: 10px">
                        <p>Don't have account? <a href="#" id="rBtn">Register</a></p>
                    </div>
                </form>
            </div>
        </div>
        <div>
            <h6><em>You should be logged in for being able to Vote for instructors.</em></h6>
        </div>
    </div>

    <!--            register -------------------------------------------->

    <div class="col s12 m4  offset-m4 card-panel offset-m1 hoverable  " id="regDiv"
         style="border: 1px solid #bababa;border-radius: 1px;">
        <div id="">
            <div class="form " style="margin-right: 10px">
                <div class="row">
                    <div class="hr-sect" id="ins">
                        <i class="material-icons prefix fa fa-user-plus fa-2x" aria-hidden="true"></i>
                        <h4>&nbsp;Register</h4></div>
                </div>
                <form action="main.php" method="POST" role="" id="regForm">

                    <div class="input-field  s8">
                        <i class="material-icons prefix fa fa-envelope-o" aria-hidden="true"></i>
                        <input type="text" name="rem" id="rem" placeholder="Enter a valid ADA email"
                               class="hoverable">
                    </div>
                    <div class="input-field">
                        <i class="material-icons prefix fa fa-asterisk" aria-hidden="true"></i>
                        <input type="password" name="rps" id="rps" placeholder="Password"
                               class="hoverable">
                    </div>
                    <div class="input-field">
                        <i class="material-icons prefix fa fa-asterisk" aria-hidden="true"></i>
                        <input type="password" name="crps" id="crps" placeholder="Confirm password"
                               class="hoverable">
                    </div>
                    <div class="input-field z-depth-1 card-panel red white-text " id="err-panel">

                    </div>
                    <div class="input-field">
                        <input type="submit" name="bsrr" id="rbtn" value="Register" class="myColor btn">
                        <p style="margin-bottom: 10px">Already have an anccount? <a href="#" id="lBtn">Login</a></p>
                    </div>
                    <div>
                        <h6><em>You should confirm your ADA email in order to complete registration
                                and use website fully.</em></h6>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php include "scripts.php"?>

</body>
</html>
