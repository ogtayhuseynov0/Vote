<?php

include_once "connect.php";
$myid = $_SESSION["dd"];
$stm = $conn->query("SELECT * FROM scores WHERE stid='$myid'");
echo " <div class='container z-depth-1' id='kelemm'>
 <ul class=\"collection with-header list\" id='test-q' >
 <li class=\"collection-header myColor2 center\"><h5>You Voted</h5></li>";

if ($stm->num_rows > 0) {
    while ($rr = $stm->fetch_assoc()) {
        $iid=$rr["insid"];
        $sid=$rr["sid"];
        $sidd=password_hash($sid,1);
        $ddd=$conn->query("SELECT * FROM instructors WHERE id='$iid'")->fetch_assoc();
        $iname=$ddd["name"];
        $dp=$ddd["dep"];
        $scr=$rr["overall"];
        $sss=$ddd["surn"];
        echo "<div class='ttb' id='ttb'><li class=\"collection-item itm name\"><div><h6><b class='myColor2'>$iname $sss - $dp</b>
<a href=\"profile.php?id=$iid\" class=\"secondary-content\">
        <b class='grey-text'>|</b> Change <b class='myColor2'>$scr </b> <i class=\"fa fa-pencil-square-o \"></i></a>
         <a href=\"mprof.php?sid=$sid&hd=$sidd\"class=\"secondary-content red-text\">
        Delete <i class=\"fa fa-times \"></i> &nbsp;</a> </h6></div></li></div>";
    }
} else {
    echo "<div class='ttb' id='ttb'><li class=\"collection-item center myColor2 itm\"><div>No Vote found!</div>";
}
echo "</ul>
</div>";