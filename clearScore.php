<?php
include_once "connect.php";

$ins = $conn->query("delete from scores where insid not in (select id from instructors);");

header("location: index.php");


