<?php
include_once 'connect.php';
session_start();
$dd = $_SESSION["pid"];
$emid = $_SESSION["dd"];
?>

<nav class="myColor " role="navigation">
    <div class="nav-wrapper container">
        <ul class="left">
            <?php  if(isset($_SESSION["urid"])){
                echo '<a href="mprof.php">My Profile</a>';
            }else{
                echo 'You must be logged in to Vote!';
            }
            ?>

        </ul>
        <ul class="right ">

            <?php
            if (isset($_SESSION["urid"])) {
                echo '<li><a href="logout.php">Logout</a></li>';
            } else {
                echo '<li><a href="main.php">Login | Register</a></li>';
            }
            ?>
        </ul>
    </div>
</nav>
</div>
<div class="container">

    <div class="row ">
        <?php
        $stmt=$conn->query("select * from scores where insid='$dd' and stid='$emid'");
        $ress=$stmt->fetch_assoc();
        if($stmt->num_rows>0){
            echo '<div class="row card-panel "><em class="red-text">You have already voted for this Instructor!!</em>
          <b class="myColor2"> &nbsp;Given average grade is '.$ress["overall"].'</b>
          </div>';
        }else{

        }

        ?>
        <?php echo '<form action="profile.php?id=' . $dd . '" method="post" class="">' ?>
        <div class="row card-panel">
            <h6>Your opinion about <b class="myColor2"> difficulty level of the exams </b> of this Instructor?</h6>

            <div class="col s12 m2">
                <p>
                    <input class="with-gap" name="de" type="radio" id="test1" value="5" required/>
                    <label for="test1">Easy</label>
                </p>
            </div>
            <div class="col s12 m2">

                <p>
                    <input class="with-gap" name="de" type="radio" id="test2" value="4" required/>
                    <label for="test2">Acceptable</label>
                </p>
            </div>
            <div class="col s12 m2">

                <p>
                    <input class="with-gap" name="de" type="radio" id="test3" value="3" required/>
                    <label for="test3">Normal</label>
                </p>
            </div>
            <div class="col s12 m2">

                <p>
                    <input class="with-gap" name="de" type="radio" id="test4" value="2" required/>
                    <label for="test4">Difficult</label>
                </p>
            </div>
            <div class="col s12 m2">
                <p>
                    <input class="with-gap" name="de" type="radio" id="test5" value="1" required/>
                    <label for="test5">Imposable to pass</label>
                </p>
            </div>
            <div class="col s12 m2">

                <p>
                    <input class="with-gap" name="de" type="radio" id="test6" value="0" required/>
                    <label for="test6">Not Sure</label>
                </p>
            </div>
        </div>
        <!--  ------------------------------------------>
        <div class="row card-panel">
            <h6>Your opinion about <b class="myColor2"> methodology </b> of this Instructor?</h6>
            <div class="col s12 m2">
                <p>
                    <input class="with-gap" name="me" type="radio" id="test7" value="5" required/>
                    <label for="test7">Excellent</label>
                </p>
            </div>
            <div class="col s12 m2">

                <p>
                    <input class="with-gap" name="me" type="radio" id="test8" value="4" required/>
                    <label for="test8">Good</label>
                </p>
            </div>
            <div class="col s12 m2">

                <p>
                    <input class="with-gap" name="me" type="radio" id="test9" value="3" required/>
                    <label for="test9">Normal</label>
                </p>
            </div>
            <div class="col s12 m2">

                <p>
                    <input class="with-gap" name="me" type="radio" id="test10" value="2" required/>
                    <label for="test10">Insufficient</label>
                </p>
            </div>
            <div class="col s12 m2">

                <p>
                    <input class="with-gap" name="me" type="radio" id="test11" value="1" required/>
                    <label for="test11">Bad</label>
                </p>
            </div>
            <div class="col s12 m2">

                <p>
                    <input class="with-gap" name="me" type="radio" id="test12" value="0" required/>
                    <label for="test12">Not Sure</label>
                </p>
            </div>
        </div>
        <!--gradeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeee-->
        <div class="row card-panel">
            <h6>Your opinion about <b class="myColor2"> language use </b> of this Instructor?</h6>
            <div class="col s12 m2">
                <p>
                    <input class="with-gap" name="lu" type="radio" id="test13" value="5" required/>
                    <label for="test13">Excellent</label>

                </p>
            </div>
            <div class="col s12 m2">

                <p>
                    <input class="with-gap" name="lu" type="radio" id="test14" value="4" required/>
                    <label for="test14">Good</label>
                </p>
            </div>
            <div class="col s12 m2">

                <p>
                    <input class="with-gap" name="lu" type="radio" id="test15" value="3" required/>
                    <label for="test15">Normal</label>
                </p>
            </div>
            <div class="col s12 m2">

                <p>
                    <input class="with-gap" name="lu" type="radio" id="test16" value="2" required/>
                    <label for="test16">Insufficient</label>
                </p>
            </div>
            <div class="col s12 m2">

                <p>
                    <input class="with-gap" name="lu" type="radio" id="test17" value="1" required/>
                    <label for="test17">Bad</label>
                </p>
            </div>
            <div class="col s12 m2">

                <p>
                    <input class="with-gap" name="lu" type="radio" id="test18" value="0" required/>
                    <label for="test18">Not Sure</label>
                </p>
            </div>
        </div>
        <div class="row card-panel">
            <h6>Your opinion about <b class="myColor2"> difficulty level of the course materials </b> of this
                Instructor?</h6>
            <div class="col s12 m2">
                <p>
                    <input class="with-gap" name="dlm" type="radio" id="test19" value="5" required/>
                    <label for="test19">Easy</label>
                </p>
            </div>
            <div class="col s12 m2">

                <p>
                    <input class="with-gap" name="dlm" type="radio" id="test20" value="4" required/>
                    <label for="test20">Good</label>
                </p>
            </div>
            <div class="col s12 m2">

                <p>
                    <input class="with-gap" name="dlm" type="radio" id="test21" value="3" required/>
                    <label for="test21">Normal</label>
                </p>
            </div>
            <div class="col s12 m2">

                <p>
                    <input class="with-gap" name="dlm" type="radio" id="test22" value="2" required/>
                    <label for="test22">Insufficient</label>
                </p>
            </div>
            <div class="col s12 m2">

                <p>
                    <input class="with-gap" name="dlm" type="radio" id="test23" value="1" required/>
                    <label for="test23">Difficult</label>
                </p>
            </div>
            <div class="col s12 m2">

                <p>
                    <input class="with-gap" name="dlm" type="radio" id="test24" value="0" required/>
                    <label for="test24">Not Sure</label>
                </p>
            </div>
        </div>
        <div class="row card-panel">
            <h6><b class="myColor2">Average final grade of the previous class you got </b> from this Instructor?</h6>
            <div class="col s12 m2">
                <p>
                    <input class="with-gap" name="grd" type="radio" id="test25" value="5" required/>
                    <label for="test25">>A</label>
                </p>
            </div>
            <div class="col s12 m2">

                <p>
                    <input class="with-gap" name="grd" type="radio" id="test26" value="4" required/>
                    <label for="test26">>B</label>
                </p>
            </div>
            <div class="col s12 m2">

                <p>
                    <input class="with-gap" name="grd" type="radio" id="test27" value="3" required/>
                    <label for="test27">>C</label>
                </p>
            </div>
            <div class="col s12 m2">

                <p>
                    <input class="with-gap" name="grd" type="radio" id="test28" value="2" required/>
                    <label for="test28">>D</label>
                </p>
            </div>
            <div class="col s12 m2">

                <p>
                    <input class="with-gap" name="grd" type="radio" id="test29" value="1" required/>
                    <label for="test29">F<</label>
                </p>
            </div>
            <div class="col s12 m2">

                <p>
                    <input class="with-gap" name="grd" type="radio" id="test30" value="0" required/>
                    <label for="test30">I did not take</label>
                </p>
            </div>
        </div>

        <div class="row card-panel">
            <div class="col s12 ">
                            <textarea class="materialize-textarea hoverable" name="cmntt"
                                      placeholder="Final thoughts and suggestion.." id="cmnt"></textarea>

                <p>
                    <input class="btn myColor" name="vote" id="vtBtn" type="submit" value="Vote" style="width: 100%"/>
                </p>
            </div>
        </div>

        </form>
    </div>


</div>
<script>
    $(document).ready(function () {
        var bt = $('#vtBtn');

        bt.on('click', function (event) {
            event.preventDefault();

        });
    });

</script>

