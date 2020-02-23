<?php

include_once "connect.php";
$stm = $conn->query("SELECT * FROM regReq");
echo " <div class='z-depth-1' id='kelemm'>
 <ul class=\"collection with-header list\" id='test-q' >
 <li class=\"collection-header myColor2 center\"><h5>Users</h5></li>";

if ($stm->num_rows > 0) {
    while ($rr = $stm->fetch_assoc()) {
        $iid=$rr["rid"];
        $nm=$rr["email"];
        $dash=password_hash($iid,1);
        echo "<div class='ttb' id='ttb'><li class=\"collection-item itm name\"><div><h6><b class='myColor2'>$nm</b> <a href=\"admin.php?rid=$iid&dh=$dash\" class=\"secondary-content\">
        Delete &nbsp;<i class=\"fa fa-user-times \"></i></a></h6></div></li></div>";
    }
} else {
    echo "<div class='ttb' id='ttb'><li class=\"collection-item center myColor2 itm\"><div>No Users found!</div>";
}
echo "</ul>
</div>";