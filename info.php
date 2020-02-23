<?php
include_once 'connect.php';
session_start();
$dd=$_SESSION["pid"];
//
//if (!isset($_SESSION["login"])) {
//    header("location: main.php");
//}
$stm=$conn->query("select * from instructors WHERE id='$dd'");
$res=$stm->fetch_assoc();
$avg = $conn->query("SELECT AVG (overall) FROM scores WHERE insid='$dd'")->fetch_row()[0]+0;

$avgG = $conn->query("SELECT AVG (avggrade) FROM scores WHERE insid='$dd'")->fetch_row()[0]+0;
$avgDLE = $conn->query("SELECT AVG (difexam) FROM scores WHERE insid='$dd'")->fetch_row()[0]+0;
$avgLU = $conn->query("SELECT AVG (languse) FROM scores WHERE insid='$dd'")->fetch_row()[0]+0;
$avgDLCM = $conn->query("SELECT AVG (crmat) FROM scores WHERE insid='$dd'")->fetch_row()[0]+0;
$avgM = $conn->query("SELECT AVG (method) FROM scores WHERE insid='$dd'")->fetch_row()[0]+0;
$avg=number_format((float)$avg, 2, '.', '');

$avgG=number_format((float)$avgG, 2, '.', '');
$avgDLE=number_format((float)$avgDLE, 2, '.', '');
$avgLU=number_format((float)$avgLU, 2, '.', '');
$avgDLCM=number_format((float)$avgDLCM, 2, '.', '');
$avgM=number_format((float)$avgM, 2, '.', '');

echo "
<div class=\"col s12\">
        <ul class=\"tabs myColor tabs-fixed-width\">
            <li class=\"tab col s3\"><a class=\"white-text\" href=\"#test1\">About</a></li>
            <li class=\"tab col s3\"><a class=\"white-text\" href=\"#test2\">Education</a></li>
            <li class=\"tab col s3\"><a class=\"white-text\" href=\"#test3\">Experience</a></li>
            <li class=\"tab col s3\"><a class=\"white-text\" href=\"#test4\">Vote Score</a></li>
        </ul>
    </div>
    <div id=\"test1\" class=\"col s12\">
        <div class=\"row\">
            <div class=\"col s12 m10 l10 offset-l1 offset-m1 z-depth-1 white msp\">
                <div class=\"row\">
                    <div class=\"hr-sect\" id=\"ins\"><h4>About</h4></div>
                </div>
                <p>
                   ".$res["about"]."

            </div>
        </div>
    </div>
    <div id=\"test2\" class=\"col s12\">
        <div class=\"row\">
            <div class=\"col s12 m10 l10 offset-l1 offset-m1 z-depth-1 white msp\">
                <div class=\"row\">
                    <div class=\"hr-sect\"><h4>Education</h4></div>
                </div>
                <p>
                    ".$res["edc"]."

            </div>
        </div>
    </div>
    <div id=\"test3\" class=\"col s12\">
        <div class=\"row\">
            <div class=\"col s12 m10 l10 offset-l1 offset-m1 z-depth-1 white msp\">
                <div class=\"row\">
                    <div class=\"hr-sect\"><h4>Experience</h4></div>
                </div>
                <p>
                   ".$res["exp"]."

            </div>
        </div>
    </div>
    <div id=\"test4\" class=\"col s12\">
        <div class=\"row\">
            <div class=\"col s12 m10 l10 offset-l1 offset-m1 z-depth-1 white msp\">
                <div class=\"row\">
                    <div class=\"hr-sect\"><h4>Vote Score</h4></div>
                </div>
                <ul class=\"collection\">
                    <li class=\"collection-item avatar\">
                        <i class=\"fa fa-star circle red\" style='margin-top:10px;'></i>
                        <br/>
                        <span class=\"title\">Grading</span>
                      
                        <a href=\"#!\" class=\"secondary-content\" style='margin-top:10px;'><b>Result: $avgG</b>
                        </a>
                    </li>
                    <li class=\"collection-item avatar\">
                        <i class=\"fa fa-book circle green\" style='margin-top:10px;'></i><br/>
                        <span class=\"title\">Difficulty of exams</span>
                        <a href=\"#!\" class=\"secondary-content\" style='margin-top:10px;'><b>Result: $avgDLE</b>
                        </a>
                    </li>
                    <li class=\"collection-item avatar\">
                        <i class=\"fa fa-user circle blue-grey\" style='margin-top:10px;'></i><br/>
                        <span class=\"title\">Language use</span>
                        <a href=\"#!\" class=\"secondary-content\" style='margin-top:10px;'><b>Result: $avgLU</b>
                        </a>
                    </li>
                    <li class=\"collection-item avatar\">
                        <i class=\"fa fa-list circle blue\" style='margin-top:10px;'></i><br/>
                        <span class=\"title\">Difficulty of materials</span>
                        <a href=\"#!\" class=\"secondary-content\" style='margin-top:10px;'><b>Result: $avgDLCM</b>
                        </a>
                    </li>
                    <li class=\"collection-item avatar\">
                        <i class=\"fa fa-pencil circle yellow\" style='margin-top:10px;'></i><br/>
                        <span class=\"title\">Methodology</span>
                        <a href=\"#!\" class=\"secondary-content\" style='margin-top:10px;'><b>Result: $avgM</b>
                        </a>
                    </li>
                    <li class=\"collection-item avatar\">
                        <i class=\"fa fa-calculator circle myColor\" style='margin-top:10px;'></i><br/>
                        <span class=\"title\">Overall</span>
                        <a href=\"#!\" class=\"secondary-content myColor2\" style='margin-top:10px;'><b>Result: $avg</b>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    
";
include "scripts.php";