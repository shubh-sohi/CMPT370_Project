<?php
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");
$hostname = "shubh-mysql-app";
$username = "shubhuser";
$password = "shubhpass";
$dbname = "shubh_db";
$connect = mysqli_connect($hostname, $username, $password, $dbname);
if ($connect->connect_error) {
    die("Connection failed: " . $connect->connect_error);
}
// define variables and set to empty values

//$check_id= $check_nameF = $check_nameL = $check_email= $check_card= $check_gender=$check_phone=$check_pass =True;

//$nameErr = $emailErr = $genderErr = $phoneErr = $emailErr2 = $passErr= $hcErr= "";
$poster_id = $category = $title = $job_description = $job_id = $amount = $job_status = $job_address = $job_image = $job_phone = "";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_COOKIE["id"]) != NULL) {
    //postedjobs table
    $poster_email = $_COOKIE["id"];
    //jobs table

    //$job_id =5;
    $category = $_POST["job_category"];
    $title = $_POST["job_title"];
    $job_description = $_POST["job_dis"];
    $amount = $_POST["job_pay"];
    $job_address = $_POST["job_address"];
    $job_province = $_POST["job_province"];
    $job_city = $_POST["job-city"];
    $job_postal = $_POST["job_postal"];
    $job_phone = $_POST["job_phone"];
    $job_status = "open";

    //$job_image = "dummy";


    if (true) {

        $query3 = "insert INTO job (category,title,job_description,amount,job_address,job_province,job_city,job_postal,job_phone,job_status,poster_email) VALUES 
			('$category','$title','$job_description','$amount','$job_address','$job_province','$job_city','$job_postal','$job_phone','$job_status','$poster_email')";
        //echo $query3;

        if ($connect->query($query3) === TRUE) {
            $sql2 = "SELECT * FROM user where email = '$poster_email'";
            $result2 = $connect->query($sql2);
            $row2 = mysqli_fetch_assoc($result2);
            $poster_id = $row2["user_id"];

            $sql3 = "SELECT * FROM job where poster_email = '$poster_email'";
            $result3 = $connect->query($sql3);
            $row3 = mysqli_fetch_assoc($result3);
            $job_id = $row3["job_id"];

            $query4 = "insert INTO postedjobs (user_id,job_id) VALUES 
			('$poster_id','$job_id')";
            if ($connect->query($query4) === TRUE) {

                $sql = "SELECT * FROM job";
                $result = $connect->query($sql);
                $json_array = array();
                while ($row = mysqli_fetch_assoc($result)) {

                    $extra = array(
                        'job_id' => $row["job_id"],
                        'category' => $row["category"],
                        'title' => $row["title"],
                        'job_description' => $row["job_description"],
                        'amount' => $row["amount"],
                        'job_address' => $row["job_address"],
                        'job_province' => $row["job_province"],
                        'job_city' => $row["job_city"],
                        'job_postal' => $row["job_postal"],
                        'job_phone' => $row["job_phone"],
                        'job_status' => $row["job_status"],
                        'poster_email' => $row["poster_email"]

                    );
                    $json_array[] = $extra;
                }
                if (file_exists('../jobsjson/jobs.json')) {

                    $final_data = json_encode($json_array);
                    if (file_put_contents('../jobsjson/jobs.json', $final_data)) {
                        $message = "<label class='text-success'>File Appended Success fully</p>";
                    }
                } else {
                    $error = 'JSON File not exits';
                }


                /*$id_n = "id";
                setcookie($id_n, $p_email, time() + (86400 * 30), "/"); // 86400 = 1 day*/
                //$message = "Successfully Signed Up, Please go to the Homepage to Login";
                //echo "<script type='text/javascript'>alert('$message');</script>";
                header("Location: ../index/index.php");
            } else {
                $message = "Error in postedjobs db,Please try again";
                echo "<script type='text/javascript'>alert('$message');</script>";
            }
        } else {

            $message = "Error,Please try again";
            echo "<script type='text/javascript'>alert('$message');</script>";

            //echo("Error description: " . mysqli_error($connect));
        }
    }


}
/*else {
	$message = "Error,Please Login first and try again";
                    echo "<script type='text/javascript'>alert('$message');</script>";
	
}*/

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Rock A Job</title>
    <link href="../index/main.css" rel="stylesheet" type="text/css">
    <meta content="width=device-width, initial-scale=1" name="viewport">
    <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
    <script src="post.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0-beta/js/materialize.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0-beta/css/materialize.min.css" rel="stylesheet">
    <link href="post.css" rel="stylesheet" type="text/css">
</head>
<body>
<div class="cover">
    <div>
        <a href="../index/index.html">
            <svg class="logo" height="100" id="logo" width="180">
                <a href="../index/index.php">
                    <text fill=#ffffff id="rock" x="0" y="40">ROCK</text>
                    <text fill=#F02B2D id="a" x="70" y="70">A</text>
                    <text fill=#ffffff id="job" x="103" y="70">JOB</text>
                    Sorry, your browser does not support inline SVG.
                </a>
            </svg>
        </a>
        <div style="float: right">
            <!--<button class="butns">USER'S NAME</button>-->

            <?php

            if (isset($_COOKIE["id2"]) == NULL) {
                //setcookie("id", NULL, time() + 3600 , "/");

                echo "<button class='butns' onclick=";
                echo '"parent.location=';
                echo "'../log-in/login.php'";
                echo '">LOG IN First</button>';
                //echo '<span class="dash" style="margin-right: -4px; font-style: normal">|</span>';
                //echo '<button class="butns" onclick="parent.location=';echo "'signup.php'";echo '">SIGN UP</button>';


            } else {
                //echo $_COOKIE["id"];
                $user_email = $_COOKIE["id2"];
                echo '<button class="butns" onclick="parent.location=';
                echo "'../job-profile/user_profile.php'";
                echo '"> ';
                echo $user_email;
                echo '</button>';

                echo '<span class="dash" style="margin-right: -4px; font-style: normal">|</span>';
                echo '<button class="butns" onclick="parent.location=';
                echo "'../logout/logout.php'";
                echo '">Log Out</button>';

            }

            ?>

        </div>
    </div>
    <div class="post-container">
        <form action="post-a-job.php" method="post">
            <div class="forms">
                <div class="tab-content">
                    <div id="postajob">
                        <h1>POST A JOB TO ROCK A JOB</h1>
                        <br>
                        <div id="jobleft">
                            <div class="rows-container"><span style="float: left; font-size: 35px;">JOB DETAILS</span>
                            </div>
                            <br>
                            <div class="grid-container">
                                <div class="item-one">
                                    <div class="rows-container">
                                        <div class="field-wrap">
                                            <label for="job-title">JOB TITLE<span class="req">*</span></label>
                                            <input autocomplete="off" id="job-title" name="job_title" required
                                                   type="text">
                                        </div>
                                    </div>
                                </div>
                                <div class="item-two">
                                    <div class="rows-container">
                                        <div class="field-wrap">
                                            <select class="job-category" id="job-category" name="job_category" required>
                                                <option value="" disabled selected hidden>JOB CATEGORY*</option>
                                                <option>COOKING</option>
                                                <option>TUTOR</option>
                                                <option>INFORMATION TECHNOLOGY</option>
                                                <option>HOSPITALITY</option>
                                                <option>HUMAN SERVICES</option>
                                                <option>TRANSPORTATION</option>
                                                <option>GARDENING</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="item-three">
                                    <div class="rows-container">
                                        <div class="field-wrap">
                                            <label for="job-pay">JOB PAYMENT<span class="req">*</span></label>
                                            <input autocomplete="off" class="job-pay" id="job-pay" name="job_pay"
                                                   required type="text">
                                        </div>
                                    </div>
                                </div>
                                <div class="item-four">
                                    <div class="rows-container">
                                        <div class="field-wrap">
                                            <label for="job-description">JOB DESCRIPTION<span
                                                        class="req">*</span></label>
                                            <textarea autocomplete="off" class="job-description" cols="3"
                                                      id="job-description" name="job_dis" required rows="5"></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="rows-container"><span style="float: left;">MEDIA</span></div>
                            <br>
                            <div class="rows-container">
                                <div class="field-wrap" style="margin-top: 10px">
                                    <div class="upload">
                                        <span style="color: #767676">UPLOAD IMAGES*</span>
                                        <input class="job-pictures" id="job-pictures" name="job_pictures" multiple
                                               onchange="previewImages(event)" type="file">
                                    </div>
                                </div>
                            </div>
                            <div class="rows-container">
                                <div class="display-images">
                                    <a onclick="delImg()">
                                        <div id="preview"></div>
                                    </a>
                                    <script src="images_upload.js"></script>
                                </div>
                            </div>
                            <br>
                            <br>
                            <div class="rows-container"><span style="float: left; margin-top: 50px;">JOB LOCATION</span>
                            </div>
                            <br>
                            <br>
                            <div class="grid-container">
                                <div class="item-five">
                                    <div class="rows-container">
                                        <div class="field-wrap">
                                            <label for="job-address">STREET ADDRESS<span class="req">*</span></label>
                                            <input class="job-address" id="job-address" name="job_address" required
                                                   type="text">
                                        </div>
                                    </div>
                                </div>
                                <div class="item-six">
                                    <div class="rows-container">
                                        <div class="field-wrap">
                                            <select class="job-province" id="job-province" name="job_province"
                                                    onchange="provCheck()" required>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="item-seven">
                                    <div class="rows-container">
                                        <!--<input class="job-city" id="job-city" name="job-city" placeholder="City" required>-->
                                        <div class="field-wrap">

                                            <select class="job-city" id="job-city" name="job-city" required>
                                            </select>
                                            <script src="location.js"></script>
                                        </div>
                                    </div>
                                </div>
                                <div class="item-eight">
                                    <div class="rows-container">
                                        <div class="field-wrap">
                                            <label for="job-postal">POSTAL CODE<span class="req">*</span></label>
                                            <input class="job-postal" id="job-postal" name="job_postal" required
                                                   type="text">
                                        </div>
                                    </div>
                                </div>
                                <div class="item-nine">
                                    <div class="rows-container">
                                        <div class="field-wrap">
                                            <label for="job-phone">PHONE NUMBER<span class="req">*</span></label>
                                            <input class="job-phone" id="job-phone" name="job_phone" type="text">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <br>
                            <div class="rows-container">
                                <div class="wrapper">
                                    <div class="field-wrap">
                                        <input class="job-submit" type="submit" value="SUBMIT">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>

</div>
</body>
</html>