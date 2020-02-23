<?php

include_once "connect.php";

$inss = $_SESSION["ins"];
$dd = $_SESSION["dep"];

if (strcmp($dd, "all") == 0) {
    $res = $conn->query("select * from instructors WHERE name LIKE '%$inss%' OR surn LIKE '%$inss%' ORDER BY name");
} else {
    if (is_null($inss) || strcmp($inss,"")==0) {
        $res = $conn->query("select * from instructors WHERE dep='$dd'");
    } else {
        $res = $conn->query("select * from instructors WHERE dep='$dd' and name LIKE '%$inss%' OR surn LIKE '%$inss%' ORDER BY name");
    }
}
if($res->num_rows>0) {
echo '<div class="row z-depth-1 list" id="full-list">';
    while ($row = $res->fetch_assoc()) {
        $idd = $row["id"];
        $avg = $conn->query("SELECT AVG (overall) FROM scores WHERE insid='$idd'")->fetch_row()[0];
        $fgrd=number_format((float)$avg, 2, '.', '');
        echo '<div class="col s12 m4 l4 inSec name">
            <div class="card small myshad">
                <div class="card-image z-depth-1">
                    <img src="images/'.$row['prof_image']. '" class="materialboxed" onerror="this.src=\'images/ins2.jpg\'">
                </div>
                <div class="card-content">
                    <p>Name: <b>' . $row['name'] . ' ' . $row['surn'] . '</b></p>
                    <p>Department: <b>' . $row['dep'] . '</b></p>
                </div>
                <div class="card-action ">
                    <div class="myColor2"> ' . $fgrd . ' <i class="fa fa-star " aria-hidden="true"></i> <a href="profile.php?id=' . $row['id'] . '"
                                                                                                 class="right text-darken-2">
                        See Profile</a></div>
                </div>
            </div>
        </div>';

    }
    echo '</div>';
}else{
    echo "<h1 class='myColor center white-text z-depth-1'>No matched Result</h1>";
}