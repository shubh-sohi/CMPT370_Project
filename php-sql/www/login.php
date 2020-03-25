<?php 
    
     $hostname="shubh-mysql-app";
	 $username="shubhuser";
	 $password="shubhpass";
	 $dbname="shubh_db";
	 $connect = mysqli_connect($hostname, $username, $password, $dbname);
	 if ($connect->connect_error) {
    die("Connection failed: " . $connect->connect_error);
}
?>

<!DOCTYPE HTML>

<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login_Client</title>
    <link href="login.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0-beta/css/materialize.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0-beta/js/materialize.min.js"></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
    <script  src="login.js"></script>
</head>
<body>
<?php 
if ($_SERVER["REQUEST_METHOD"] == "POST") {
			
						
			$id = $_POST["emailid"];		
			$pass=$_POST["pass"];
			
			
			$query = "SELECT * FROM user where email = '$id'";
			
	        $result = $connect->query($query);
			
			
			//$row = mysqli_fetch_array($result);
			
			if (mysqli_num_rows($result) > 0) {
				
    // output data of each row
    while($row = mysqli_fetch_assoc($result)) {
		
		   $password_hash = md5($pass);
		   //$password_hash = $pass;
        
			if($password_hash ===  $row["password"]){
				$id_n = "id";
				setcookie($id_n, $id, time() + (86400 * 30), "/"); // 86400 = 1 day
				$message = "Successfully Logged In, Go to Post a Job Page";
                    echo "<script type='text/javascript'>alert('$message');</script>";
				header("Location: post-a-job.html");
				
			}
			else{
				//echo "Wrongggggggggggggggggggggg pass";
				$message = "Error in Login:Wrong Password, Please try again!!!!";
                    echo "<script type='text/javascript'>alert('$message');</script>";
					echo '<a href="login.php" target="blank">Click to try again</a>';
			}
		
		}
} else {
    //echo "Wrong Username";
	$message = "Error in Login:Wrong Email, Please try again!!!!";
                    echo "<script type='text/javascript'>alert('$message');</script>";
					echo '<a href="login.php" target="blank">Click to try again</a>';
}
			
			
			
		}

?>
<div>
    <svg class="logo" id="logo" height="100" width="180">
        <a href="../index/index.html">
            <text id="rock" fill = #ffffff x="0" y="40">ROCK</text>
            <text id="a" fill = #F02B2D x="70" y="70">A</text>
            <text id="job" fill = #ffffff x="105" y="70">JOB</text>
            Sorry, your browser does not support inline SVG.
        </a>
    </svg>
    <div style="float: right">
        <button class="butns" onclick="parent.location='../log-in/login.html'">LOG IN</button>
        <span class="dash" style="margin-right: -4px; font-style: normal">|</span>
        <button class="butns" onclick="parent.location='../sign-up/signup.html'">SIGN UP</button>
    </div>
</div>
<div class="forms">
    <div id="signup">
        <h1>LOG IN TO ROCK A JOB</h1>
        <div class="google">
            <a class="oauth-container" href="/users/google-oauth/">
                <div class="left">
                    <img width="30px" style="margin-top:36%; margin-left:480%" alt="Google sign-in"
                         src="https://upload.wikimedia.org/wikipedia/commons/thumb/5/53/Google_%22G%22_Logo.svg/512px-Google_%22G%22_Logo.svg.png" />
                </div>
                LOGIN WITH GOOGLE
            </a>
        </div>
        <p style=" font-size:25px; color:#767676;width: 100%; text-align: center; border-bottom: 1px solid #000;
             line-height: 0.1em; margin: 30px 0 20px;">
                <span style="background:#fff; padding:0 10px;">
                    OR
                </span>
        </p>
        <form action="/" method="post">
            <div class="top-row">
                <div class="field-wrap">
                    <label for="emailid">EMAIL ADDRESS<span class="req">*</span></label>
                    <input id="emailid" type="email" required autocomplete="off">
                </div>
                <div class="field-wrap">
                    <label for="pass">PASSWORD<span class="req">*</span></label>
                    <input id="pass" type="password" required autocomplete="off">
                </div>
            </div>
            <button type="submit" class="button button-block"/>GET STARTED</button>
        </form>
    </div>
    <p style = "color: #767676; font-size: 25px">FORGOT PASSWORD ?
        <a style = "color: #DE5F5F; font-size: 25px" href="#" target="blank">RESET PASSWORD</a>
</div> <!-- /form -->
</body>
</html>