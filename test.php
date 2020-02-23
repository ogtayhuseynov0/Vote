<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
include "conn.php";
if(isset($_POST["sub"])){
    $text=$_POST["text"];
    $num=$_POST["num"];
    $target='images/'.basename($_FILES["image"]["name"]);
    $image = addslashes(file_get_contents($_FILES["image"]["tmp_name"])); //SQL Injection defence!
    $image_name = addslashes($_FILES["image"]["name"]);
    $stm=$pdo->prepare("INSERT INTO test (text,intt,blobb) VALUES (:text,:intt,:blobb)");
    $stm->bindParam(':text',$text);
    $stm->bindParam(':intt',$num);
    $stm->bindParam(':blobb',$image_name);
    $stm->execute();
    if(move_uploaded_file($_FILES["image"]["tmp_name"],'images/'.basename($_FILES["image"]["name"]))){
    }else{}
}
?>
<!doctype html>
<html lang="en">
<head>
    <title>Document</title>
</head>
<body>

<form action="test.php" method="post" role="form" enctype="multipart/form-data">
    <input type="text" placeholder="text" name="text">
    <input type="number" placeholder="number" name="num">
    <input type="file" name="image">
    <input type="submit" value="Submit" name="sub">
</form>
<?php
    $res=$pdo->prepare("SELECT * FROM test");
    $res->execute();
    $rr=$res->fetchAll();
//    foreach ($rr as $row){
//        echo $row[0]." ";
//        echo $row[1]." <br/>";
//        echo '<div><img src="images/'.$row["blobb"].'"></div><br/>';
//        echo '<hr/>';
//    }
echo rand(1,99999);
?>
</body>
</html>

