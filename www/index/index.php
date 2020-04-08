<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Rock A job</title>

    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="main.css">
    <link href="https://fonts.googleapis.com/css?family=Ewert&display=swap" rel="stylesheet">

</head>
<body>
<div>
    <div>
        <svg class="logo" id="logo" height="100" width="180">
            <a href="index.php">
                <text id="rock" fill=#ffffff x="0" y="40">ROCK</text>
                <text id="a" fill=#F02B2D x="70" y="70">A</text>
                <text id="job" fill=#ffffff x="105" y="70">JOB</text>
                Sorry, your browser does not support inline SVG.
            </a>
        </svg>
        <div style="float: right">
            <?php
            if (isset($_COOKIE["id2"]) == NULL) {
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
            <!--<button class="butns" onclick="parent.location='../log-in/login.php'">LOG IN</button>
            <span class="dash" style="margin-right: -4px; font-style: normal">|</span>
            <button class="butns" onclick="parent.location='../sign-up/signup.php'">SIGN UP</button>-->
        </div>
    </div>
    <div class="banner-container">
        <div class="banner">
            <p style="margin: 0">get your <span style="color: #F02B2D;">WORK</span> done</p>
        </div>
        <div class="pick-post-buttons" style="margin-top: 80px">
            <button id="pick" class="pick-post" onclick="parent.location='../pick-a-job/pick-a-job.php'"> PICK A JOB
            </button>
            <button id="post" class="pick-post" onclick="parent.location='../post-a-job/post-a-job.php'"> POST A JOB
            </button>
        </div>
    </div>
</div>


</body>
</html>