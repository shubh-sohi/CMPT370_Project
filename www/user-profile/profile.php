<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>User Profile</title>
    <link rel="stylesheet" type="text/css" href="profile.css">
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
        <div style ="margin-left: 20px; padding-top: 10px">
            <?php
            $var = $_GET['var'];
            // connects to the database
            $con = new mysqli("shubh-mysql-app", "shubhuser", "shubhpass", "shubh_db");
            $result = mysqli_query($con, "SELECT * FROM user");
            while ($row = mysqli_fetch_array($result)) {
                if ("Rohan Patel" != NULL) {
                    if ($var == $row["first_name"] . " " . $row["last_name"]) {
                        echo '<h1>USER PROFILE</h1>';
                        echo "<b>USER-ID :- </b> " . $row['user_id'];
                        echo "<br /><b>NAME : </b> " . strtoupper($row["first_name"] . " " . $row["last_name"]);
                        echo "<br /><b>EMAIL-ID : </b> " . $row['email'];
                        echo "<br /><b>PHONE NUMBER - </b> " . $row['phone'];
                        echo "<br />";
                        echo "<br />";

                        echo "<h1>JOB'S COMPLETED</h1>";
                        $uid = $row['user_id'];
                        $result2 = mysqli_query($con, "SELECT * FROM requestedjobs WHERE user_id = '$uid' and is_assigned = '1'");
                        $row2 = mysqli_fetch_array($result2);
                        while ($row2 = mysqli_fetch_array($result2)) {
                            $jid = $row2["job_id"];
                            $result3 = mysqli_query($con, "SELECT * FROM job WHERE job_id = '$jid'");
                            while ($row3 = mysqli_fetch_array($result3)) {
                                echo '<div class="postcontain" style="border: 2px solid #767676; border-radius: 25px;">';
                                echo '<b>Title : </b>' . $row3['title'];
                                echo '<br /><b>Pay : </b>' . $row3["amount"];
                                echo '<br /><b>Job Location : </b>' . $row3["job_address"] . ', ' . 'Saskatoon' . ', ' . $row3["job_postal"] . '.';
                                echo '<br /><b>Job Description : </b>' . ucfirst($row3["job_description"]);
                                echo '</div>';
                                echo '<br />';
                            }
                        }
                        echo "No jobs completed yet by this user.";
                    }
                } else {
                    echo '<b>User Details Not Found</b>';
                }
            }
            mysqli_close($con);
            ?>
        </div>
    </div>
</body>
</html>