<?php
$host="localhost";
$usr="root";
$pass="root";
$db="u161225217_usg";
$conn=new mysqli($host,$usr,$pass,$db);
if($conn->connect_error){
    echo 'Eroor '.$conn->connect_error;
}else {
}
