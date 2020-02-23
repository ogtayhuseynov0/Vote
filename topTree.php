<?php

include_once "connect.php";
$count=$conn->query("SELECT * FROM instructors");
$intcount=$count->num_rows;
if($intcount>=3){
    $topTree=$conn->query("SELECT insid, AVG(overall) FROM scores GROUP BY insid ORDER BY AVG(overall) DESC  LIMIT 0,3");
}else{
    $topTree=$conn->query("SELECT insid, AVG(overall) FROM scores GROUP BY insid ORDER BY AVG(overall) DESC  LIMIT 0,$intcount");
}

if ($topTree->num_rows>0) {
    while ($row = $topTree->fetch_assoc()) {
        $idd = $row["insid"];
        $grd = $row["AVG(overall)"];
        $res = $conn->query("select * from instructors WHERE id='$idd'")->fetch_assoc();
        $fgrd=number_format((float)$grd, 2, '.', '');
        echo '<div class="col s12 m4 l4">
                <div class="card small myshad">
                    <div class="card-image">
                    <img src="images/' . $res['prof_image'] . '" class="materialboxed" onerror="this.src=\'images/ins2.jpg\'">
                    </div>
                    <div class="card-content">
                        <p>Name: <b>' . $res['name'] . ' ' . $res['surn'] . '</b></p>

                        <p>Department: <b>' . $res['dep'] . '</b></p>
                    </div>
                    <div class="card-action ">
                        <div class="myColor2"> ' . $fgrd . ' <i class="fa fa-star " aria-hidden="true"></i> <a href="profile.php?id=' . $res['id'] . '"
                                                                                                     class="right text-darken-2">
                                See Profile</a></div>
                    </div>
                </div>
            </div>';
    }
}else{
    echo "<h2 class='myColor center white-text z-depth-1'>There is no voted instructor</h2>";

}
