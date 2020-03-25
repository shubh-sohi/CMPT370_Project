<?php
    $hostname="shubh-mysql-app";
	 $username="shubhuser";
	 $password="shubhpass";
	 $dbname="shubh_db";
	 $connect = mysqli_connect($hostname, $username, $password, $dbname);
	 	 
	 $sql="SELECT * FROM user";
      $result = mysqli_query($connect,$sql)or die(mysql_error());
	  //$row = mysqli_fetch_array($result);
	  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
// echo "Connected to MySQL successfully!";
// echo "<br><br>";
?>
<!DOCTYPE HTML>


<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rock A Job</title>
    <link href="signup.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0-beta/css/materialize.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0-beta/js/materialize.min.js"></script>
</head>
<body>

<?php
// define variables and set to empty values
$check_id= $check_nameF = $check_nameL = $check_email= $check_card= $check_gender=$check_phone=$check_pass =True;

$nameErr = $emailErr = $genderErr = $phoneErr = $emailErr2 = $passErr= $hcErr= "";
$p_id = $first_name = $last_name = $p_email = $p_address = $p_phone = $h_card= $p_gender= $p_pass_con = $p_pass= "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $first_name = $_POST["fname"];
	$check_nameF = True;
    // check if name only contains letters and whitespace
    if (!preg_match("/^[a-zA-Z ]*$/",$first_name)) {
		$check_nameF = False;
      $nameErr = "Only letters and white space allowed"; 
    }
	
	$last_name = $_POST["lname"];
	$check_nameL = True;
    // check if name only contains letters and whitespace
    if (!preg_match("/^[a-zA-Z ]*$/",$last_name)) {
		$check_nameL = False;
      $nameErr = "Only letters and white space allowed"; 
    }
  
  
 
	  $check_email = True;
    $p_email = $_POST["emailid"];
    // check if e-mail address is well-formed
    if (!filter_var($p_email, FILTER_VALIDATE_EMAIL)) {
		$check_email = False;
		
      $emailErr = "Invalid email format"; 
	  while($row = mysqli_fetch_array($result))
	  {
		  if($row["email"] == $p_email){
			  $check_email = False;
			  $emailErr2 = "Unique email Needed";
		  }
	  }
    }
  
	  $check_phone = True;
	  $p_phone = $_POST["pnumber"];
	  //$n = "(123)456-7890";
      //$p = "/\(\d{3}\)\d{3}-\d{4}/";
	  $p = "/\d{10}/";
	  
	  if(!preg_match($p,$p_phone)){
		  $check_phone = False;
		  $phoneErr = "Invalid Phone number format";
	  }

	  $p_pass = $_POST["pass"];
	  $check_pass = True;
	  $password_hash = md5($p_pass);
	  
	  $p_pass_con = $_POST["cpass"];
	  $check_pass = True;
	  $password_hash2 = md5($p_pass_con);
	  
	  if($password_hash != $password_hash2) {
	     $check_pass = False;
		 $passErr = "Password did not match!!";
	  }
	  $query3 = "insert INTO user (first_name,last_name,password,email,phone) VALUES 
			('$last_name','$first_name','$password_hash','$p_email','$p_phone')" ;
	if($connect->query($query3) === TRUE){
// 	 					header("Location: index.html");
		$id_n = "id";
		setcookie($id_n, $p_email, time() + (86400 * 30), "/"); // 86400 = 1 day

		echo "<script>window.location.href='index.html';</script>";
    	

 					// $message = "Successfully Signed Up, Please go to the Homepage to Login";
//                      echo "<script type='text/javascript'>alert('$message');</script>";
 				}
 				
 	else{ 
 		  
 		         $message = "Error,Please try again";
                     echo "<script type='text/javascript'>alert('$message');</script>";
 					
//  					echo("Error description: " . mysqli_error($connect));
 		  }	 

 //  if(true){
// //$check_nameF==TRUE && $check_nameL==TRUE && $check_email==TRUE && $check_phone==TRUE && $check_pass=TRUE
//            $query3 = "insert INTO user (user_name,full_name,password,email,phone,date_of_birth,address,gov_id,residency_type) VALUES 
// 			('$last_name','$first_name','$password_hash','$p_email','$p_phone','','','','')" ;
//              //echo $query3;
// 			
// 			if($connect->query($query3) === TRUE){
// 					$message = "Successfully Signed Up, Please go to the Homepage to Login";
//                     echo "<script type='text/javascript'>alert('$message');</script>";
// 					header("Location: index.html");
// 				}
// 				
//           else{ 
// 		  
// 		         $message = "Error,Please try again";
//                     echo "<script type='text/javascript'>alert('$message');</script>";
// 					
// 					//echo("Error description: " . mysqli_error($connect));
// 		  }	 
// 	 }
	//  else{
// 		 $message = "Invalid input";
//                     echo "<script type='text/javascript'>alert('$message');</script>";
// 	 }
  
  
}
function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
?>


<div>
    <svg class="logo" id="logo" height="100" width="180">
        <a href="index.html">
            <text id="rock" fill = #ffffff x="0" y="40">ROCK</text>
            <text id="a" fill = #F02B2D x="70" y="70">A</text>
            <text id="job" fill = #ffffff x="105" y="70">JOB</text>
            Sorry, your browser does not support inline SVG.
        </a>
    </svg>
    <div style="float: right">
        <button class="butns" onclick="parent.location='login.html'">LOG IN</button>
        <span class="dash" style="margin-right: -4px; font-style: normal">|</span>
        <button class="butns" onclick="parent.location='signup.html'">SIGN UP</button>
    </div>
</div>
<div class="forms">
    <div class="tab-content">
        <div id="signup">
            <h1>SIGN UP TO ROCK A JOB</h1>
            <!-- <div class="google">
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
            </p> -->
                        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
                <div class="top-row">
                    <div class="field-wrap">
                        <label for="fname">FIRST NAME<span class="req">*</span></label>
                        <input id="fname" name = 'fname' type="text" required autocomplete="off">
					
                    </div>
                    <div class="field-wrap">
                        <label for="lname">LAST NAME<span class="req">*</span></label>
                        <input id="lname" name = 'lname' type="text"required autocomplete="off">
						
                    </div>
                </div>
                <div class="field-wrap">
                    <label for="pnumber">PHONE NUMBER<span class="req">*</span></label>
                    <input id="pnumber" name = 'pnumber' type="text"required autocomplete="off">
					
					
                </div>
                <div class="field-wrap">
                    <label for="emailid">EMAIL ADDRESS<span class="req">*</span></label>
                    <input id="emailid" name = 'emailid' type="email" required autocomplete="off">
					
                </div>
                <div class="field-wrap">
                    <label for="pass">PASSWORD<span class="req">*</span></label>
                    <input id="pass" name = 'pass' type="password"required autocomplete="off">
					
                </div>
                <div class="field-wrap">
                    <label for="cpass">CONFIRM PASSWORD<span class="req">*</span></label>
                    <input id="cpass" name = 'cpass' type="password"required autocomplete="off">
					
                </div>
                <button type="submit" class="button button-block"/>GET STARTED</button>
            </form>
        </div>
        <p style = "color: #767676; font-size: 25px">ALREADY HAVE AN ACCOUNT?
            <a style = "color: #DE5F5F; font-size: 25px" href="#" target="blank">LOG IN</a>
    </div><!-- tab-content -->
</div> <!-- /form -->
</body>
<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
<script  src="signup.js"></script>
</html>
