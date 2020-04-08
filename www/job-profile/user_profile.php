<?php
if (isset($_POST['assignJob'])) {
    $this_user_id = $_POST['user_id'];
    $this_job_id = $_POST['job_id'];
    $assign_job = "UPDATE requestedjobs SET is_assigned = 1 WHERE user_id = '$this_user_id' AND job_id = '$this_job_id'";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>User Profile</title>
    <link rel="stylesheet" type="text/css" href="user_profile.css">
</head>
<body>
<div>
    <div>
        <svg class="logo" id="logo" height="100" width="180">
            <a href="../index/index.php">
                <text id="rock" fill=#ffffff x="0" y="40">ROCK</text>
                <text id="a" fill=#F02B2D x="70" y="70">A</text>
                <text id="job" fill=#ffffff x="105" y="70">JOB</text>
                Sorry, your browser does not support inline SVG.
            </a>
        </svg>
        <div style="float: right">
            <?php
            if (isset($_COOKIE["id2"]) == NULL) {
                //setcookie("id", NULL, time() + 3600 , "/");
                echo "<button class='butns' onclick=";
                echo '"parent.location=';
                echo "'../log-in/login.php'";
                echo '">LOG IN</button>';
                echo '<span class="dash" style="margin-right: -4px; font-style: normal">|</span>';
                echo '<button class="butns" onclick="parent.location=';
                echo "'../sign-up/signup.php'";
                echo '">SIGN UP</button>';
            } else {
                //echo $_COOKIE["id2"];
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
    <div class="container">
        <div style="margin-left: 20px; padding-top: 10px">
            <?php
            // connects to the database
            $con = new mysqli("shubh-mysql-app", "shubhuser", "shubhpass", "shubh_db");
            if (!(empty($assign_job))) {
                if ($con->query($assign_job) === TRUE) {
                    echo "done!";
                    $to_email = 'sss669@usask.ca';
                    $subject = 'Testing PHP Mail';
                    $message = 'This mail is sent using the PHP mail function';
                    $headers = 'From: noreply@company.com';
                    mail($to_email,$subject,$message,$headers);
                }
            }
            $result = mysqli_query($con, "SELECT * FROM user");
            while ($row = mysqli_fetch_array($result)) {
                if (isset($_COOKIE["id2"]) != NULL) {
                    if ($_COOKIE["id2"] == $row["first_name"] . " " . $row["last_name"]) {
                        echo '<h1>USER PROFILE</h1>';
                        echo "<b>USER-ID :- </b> " . $row['user_id'];
                        echo "<br /><b>NAME : </b> " . strtoupper($row["first_name"] . " " . $row["last_name"]);
                        echo "<br /><b>EMAIL-ID : </b> " . $row['email'];
                        echo "<br /><b>PHONE NUMBER - </b> " . $row['phone'];
                        echo "<br />";
                        echo "<br />";
                        echo "<h1>JOB'S POSTED</h1>";
                        $user = $row['email'];
                        $result1 = mysqli_query($con, "SELECT * FROM job WHERE poster_email = '$user'");
                        $row1 = mysqli_fetch_array($result1);
                        if (empty($row1)) {
                            echo '<p style= "font-weight:normal;">No jobs posted by this user.</p>';
                        } else {
                            while ($row1) {
                                $job_id = $row1['job_id'];
                                echo '<div class="postcontain" style="border: 2px solid #767676; border-radius: 25px;">';
                                echo '<b>Title : </b>' . $row1['title'];
                                echo '<br /><b>Pay : </b>' . $row1["amount"] . '$';
                                echo '<br /><b>Job Location : </b>' . $row1["job_address"] . ', ' . 'Saskatoon' . ', ' . $row1["job_postal"] . '.';
                                echo '<br /><b>Job Status : </b>' . ucfirst($row1["job_status"]);
                                echo '<br />';
                                $row1 = mysqli_fetch_array($result1);
                                echo '<b style="font-size: 35px">Please assign the job to one of the following user:<br /></b>';
                                echo '<b style="font-size: 25px">Clicking the users name will open their profile.</b>';
                                $result4 = mysqli_query($con, "SELECT * FROM requestedjobs WHERE job_id = '$job_id'");
                                if (!(empty($result4))){
                                    while ($row4  = mysqli_fetch_array($result4)) {
                                        $user_id = $row4['user_id'];
                                        echo '<br />';
                                        ;
                                        $result5 = mysqli_query($con, "SELECT * FROM user WHERE user_id = '$user_id'");
                                        $row5 = mysqli_fetch_array($result5);
                                        $name = $row5['first_name'] . " " . $row5['last_name'] . " ";
                                        echo '<form method="post" action="user_profile.php" id="req_button">';
                                        echo '<input type="hidden" name="job_id" value ="' . $job_id . '">';
                                        echo '<input type="hidden" name="user_id" value ="' . $user_id . '">';
                                        echo '<input type="submit" class="butns" name="assignJob" value ="Click here to assign job to following:">';
                                        echo '</form>';
                                        echo '<button class="butns" onclick="window.location=';
                                        echo "'http://localhost:30001/user-profile/profile.php?var=$name'";
                                        echo '"> ';
                                        echo $name;
                                        echo '</button>';
                                    }
                                }else {
                                    echo $job_id;
                                    echo "Nothing here";
                                }
                                echo '</div>';
                                echo '<br />';
                            }
                        }
                        echo "<h1>JOB'S COMPLETED</h1>";
                        $uid = $row['user_id'];
                        $result2 = mysqli_query($con, "SELECT * FROM requestedjobs WHERE user_id = '$uid' and is_assigned = '2'");
                        $row2 = mysqli_fetch_array($result2);
                        if (empty($row2)) {
                            echo '<p style= "font-weight:normal;">No jobs completed by this user.</p>';
                        } else {
                            while ($row2) {
                                $jid = $row2["job_id"];
                                $result3 = mysqli_query($con, "SELECT * FROM job WHERE job_id = '$jid'");
                                while ($row3 = mysqli_fetch_array($result3)) {
                                    echo '<div class="postcontain" style="border: 2px solid #767676; border-radius: 25px;">';
                                    echo '<b>Title : </b>' . $row3['title'];
                                    echo '<br /><b>Pay : </b>' . $row3["amount"] . '$';
                                    echo '<br /><b>Job Location : </b>'.$row3["job_address"].', '.'Saskatoon'.','.$row3["job_postal"].'.';
                                    echo '<br /><b>Job Description : </b>' . ucfirst($row3["job_description"]);
                                    echo '</div>';
                                    echo '<br />';
                                }
                            }
                        }
                    }
                }
            }
            mysqli_close($con);
            ?>
        </div>
    </div>
</body>
</html>
