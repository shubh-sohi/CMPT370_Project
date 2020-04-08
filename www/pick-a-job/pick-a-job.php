<?php
$hostname = "shubh-mysql-app";
$username = "shubhuser";
$password = "shubhpass";
$dbname = "shubh_db";
$connect = mysqli_connect($hostname, $username, $password, $dbname);

if ($connect->connect_error) {
    die("Connection failed: " . $connect->connect_error);
}
$sql = "SELECT * FROM user";
$result = $connect->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while ($row = $result->fetch_assoc()) {
        if (isset($_COOKIE["id2"]) != NULL) {
            if ($_COOKIE["id2"] == $row["first_name"] . " " . $row["last_name"]) {
                $setVal = $row["user_id"];
            }
        }
    }
} else {
    echo "0 results";
}

if (isset($_POST['request_btn'])) {
    if (isset($_COOKIE["id2"]) == NULL) {
        $message = "Please Sign In first!";
        echo "<script type='text/javascript'>alert('$message');</script>";
    } else {
        $ID = $_POST['btn_val'];
        $query5 = "INSERT INTO requestedjobs VALUE ('$setVal','$ID','0')";
        if ($connect->query($query5) === TRUE) {
            $message = "You have Successfully requested this job. The job poster will review all of the requests
            and assign the job to the candidate of his choice. Keep and eye out in your email inbox for the job approval.";
            echo "<script type='text/javascript'>alert('$message');</script>";
        } else {
            $message = "Error,Please try againnnnn";
//            echo "<script type='text/javascript'>alert('$message');</script>";

            echo("Error description: " . mysqli_error($connect));
        }
//        echo $ID;
//        echo "getting here";
    }
}
?>

<?php
$searchcheck = 0;
//coding for backend of search option and create jobsjson/search.json file with the searched jobs output

if ($_SERVER["REQUEST_METHOD"] == "POST" || isset($_COOKIE["id"]) != NULL) {

    $searchInput = $_POST["search"];

    $sql = "SELECT * FROM job where title LIKE '%$searchInput%' OR job_description LIKE '%$searchInput%'";

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
    if (file_exists('../jobsjson/search.json')) {

        $final_data = json_encode($json_array);
        if (file_put_contents('../jobsjson/search.json', $final_data)) {
            $message = "<label class='text-success'>File Appended Success fully</p>";
        }
    } else {
        $error = 'JSON File not exits';
    }


    /*$id_n = "id";
    setcookie($id_n, $p_email, time() + (86400 * 30), "/"); // 86400 = 1 day*/
    //$message = "Successfully Signed Up, Please go to the Homepage to Login";
    //echo "<script type='text/javascript'>alert('$message');</script>";
    //header("Location: pick.css");
    //Shubh: Instead of the header redirection please redisplay the jobs from
    //search.json file instead of jobs.json file
    echo "<script src='search-helper.js'></script>";


} else if ($searchcheck == 0) {
    echo "<script src='pick-helper.js'></script>";

}


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Rock A Job</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" type="text/css" href="../index/main.css">
    <link rel="stylesheet" type="text/css" href="pick.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">


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
            <!--<button class="butns" >Fname LName</button>-->
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
</div>
<span style="margin-top:15px; font-size: 55px; color: #F02B2D; margin-left: 20px;">Pick A Job</span>

<!-- Search input -->
<div class="search-container">
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
    <input type="text" placeholder="Search for Jobs" name="search">
    <i style="font-size:30px; left: -50px; margin-top: 11px;" class="fa fa-search"></i>
    <button style=" margin-left: -25px; font-family: DIN-Condensed-Bold; font-size:30px; border-radius:15px; padding: 5px 10px;" type="submit">SEARCH</button>
</form>
</div>

<div class="job-container">
    <div class="left-container" id="mini_disc">
        <!--<div class="mini-job-container">-->
        <!--<div>ok-->
        <!--ok</div>-->
        <!--<div>ok</div>-->
        <!--</div>-->
        <!--<div class="mini-job-container" >-->
        <!--ok-->
        <!--</div>-->
    </div>
    <div class="right-container" id="detail_disc">
        <div class="job-details-container">
            <form method="post" action="pick-a-job.php" id="req_button">
            </form>
            Detailed job description will be displayed here.<br>
        </div>
    </div>
</div>
<!--<script src="pick-helper.js"></script>-->

</body>
</html>