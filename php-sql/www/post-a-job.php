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
<?php
// define variables and set to empty values

//$check_id= $check_nameF = $check_nameL = $check_email= $check_card= $check_gender=$check_phone=$check_pass =True;

//$nameErr = $emailErr = $genderErr = $phoneErr = $emailErr2 = $passErr= $hcErr= "";
$poster_id = $category = $title = $job_description = $job_id = $amount = $job_status= $job_address= $job_image = $job_phone= "";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_COOKIE["id"]) != NULL) {
    
    $poster_id = $_COOKIE["id"];
    $category = $_POST["job_category"];
    $title = $_POST["job_title"];
    $job_description = $_POST["job_dis"];
    $job_id = $_COOKIE["id"] + rand();
    $amount = $_POST["job_pay"];
    $job_status = "posted";
    $job_address = $_POST["job_address"] +"," + $_POST["job-city"] + "," + $_POST["job_province"]
    + "," + $_POST["job_postal"];
    $job_image = "dummy";
    $job_phone = $_POST["job_phone"];
    
  if(true){

  $query3 = "insert INTO job (poster_id,category,title,job_description,job_id,amount,job_status,job_address,job_image,job_phone) VALUES 
            ('$poster_id','$category','$title','$job_description','$job_id','$amount','$job_status','$job_address','$job_image','$job_phone')" ;
             //echo $query3;
            
            if($connect->query($query3) === TRUE){
                 $sql = "SELECT * FROM job";  
                 $result = $connect->query($sql);  
                 $json_array = array();
                 while($row = mysqli_fetch_assoc($result))  
           {  
                
                $extra = array(  
                     'poster_id'               =>     $row["poster_id"],  
                     'category'               =>     $row["category"], 
                     'title'               =>     $row["title"],
                     'job_description'               =>     $row["job_description"],
                     'job_id'               =>     $row["job_id"],
                     'amount'               =>     $row["amount"],
                     'job_status'               =>     $row["job_status"],
                     'job_address'               =>     $row["job_address"],
                     'job_phone'               =>     $row["job_phone"]
                ); 
                $json_array[] = $extra;                 
           }  
           if(file_exists('jobs.json'))  
           {  
                
                $final_data = json_encode($json_array);  
                if(file_put_contents('jobs.json', $final_data))  
                {  
                     $message = "<label class='text-success'>File Appended Success fully</p>";  
                }  
           }  
           else  
           {  
                $error = 'JSON File not exits';  
           }  
                
                
                /*$id_n = "id";
                setcookie($id_n, $p_email, time() + (86400 * 30), "/"); // 86400 = 1 day*/
                    //$message = "Successfully Signed Up, Please go to the Homepage to Login";
                    //echo "<script type='text/javascript'>alert('$message');</script>";
                    header("Location: index.html");
                }
                
          else{ 
          
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
    <link rel="stylesheet" type="text/css" href="post.css">
    <!-- <link rel="stylesheet" type="text/css" href="main.css"> -->

    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://fonts.googleapis.com/css?family=Cinzel&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans+Condensed:300&display=swap" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0-beta/js/materialize.min.js"></script>


</head>
<body>
<div class="cover">
    <div>
        <svg class="logo" id="logo" height="100" width="180">
            <a href="index.php">
                <text id="rock" fill = #ffffff x="0" y="40">ROCK</text>
                <text id="a" fill = #F02B2D x="70" y="70">A</text>
                <text id="job" fill = #ffffff x="105" y="70">JOB</text>
                Sorry, your browser does not support inline SVG.
            </a>
        </svg>
        <div style="float: right">
            <?php 
        
        if (isset($_COOKIE["id"]) == NULL){
            //setcookie("id", NULL, time() + 3600 , "/");
            
        echo"<button class='butns' onclick=";echo '"parent.location=';echo "'index.php'";echo '">LOG IN First</button>';
        //echo '<span class="dash" style="margin-right: -4px; font-style: normal">|</span>';
        //echo '<button class="butns" onclick="parent.location=';echo "'signup.php'";echo '">SIGN UP</button>';
            
            
            }
            else {
                //echo $_COOKIE["id"];
             $user_email = $_COOKIE["id"];
             echo '<button class="butns" onclick="parent.location=';echo "'#'";echo '"> ';echo $user_email; echo '</button>';
             
             echo '<span class="dash" style="margin-right: -4px; font-style: normal">|</span>';
             echo '<button class="butns" onclick="parent.location=';echo "'logout.php'";echo '">Log Out</button>';
 
            
            }
        
        
        ?>
        </div>
    </div>
    <div class="post-container">
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">

            <div class="post-form">
                <span style="color: #F02B2D; font-size: 35px; font-weight: bold; font-size: 60px;">Post A Job To Rock A Job</span><br>
                <div class="rows-container"><span style="float: left; font-size: 45px;">Job Details</span></div>
                <div class="rows-container">
                    <input type="text" class="job-title" id="job_title" name="job_title" placeholder="Add Title" required>
                </div>
                <div class="rows-container">
                    <select class="job-category" id="job_category" name="job_category" required>
                        <option value="" disabled selected hidden>Select Category</option>
                        <option>Whatever 1</option>
                        <option>whatever 2</option>
                        <option>Whatever 3</option>
                        <option>Whatever 4</option>
                        <option>Whatever 5</option>
                        <option>Whatever 6</option>
                        <option>Whatever 7</option>
                        <option>Whatever 8</option>
                        <option>Whatever 9</option>
                        <option>Whatever 10</option>
                    </select>
                    <input type="text" class="job-pay" id="job_pay" name="job_pay" placeholder="Job pay in CAD" required>
                </div>
                <div class="rows-container">
                    <textarea placeholder="Add Discription" rows="5" cols="3" class="job-discription" id="job_dis" name="job_dis" required></textarea>
                </div>


                <div class="rows-container"><span style="float: left; margin-top: 20px; font-size: 45px;">Media</span></div>
                <div class="rows-container">
                    <input type="file" id="job_pictures" name="job_pictures" onchange="previewImages(event)" multiple>
                    <label for="job_pictures" class="job-pictures">Upload Images</label>
                </div>
                <div class="rows-container">
                    <div class="display-images">
                        <a onclick="delImg()">
                        <div id="preview"></div>
                        </a>
                        <script src="images_upload.js"></script>

                    </div>
                </div>


                <div class="rows-container"><span style="float: left; margin-top: 20px; font-size: 45px;">Location</span></div>
                <div class="rows-container">
                    <input type="text" class="job-address" id="job_address" name="job_address" placeholder="Street Address" required>
                    <select class="job-province" id="job_province" name="job_province" onchange="provCheck()" required>
                    <option value="" disabled selected hidden>Select Province</option>
                    </select>
                </div>
                <div class="rows-container">
                 <input type="text" class="job-city" id="job-city" name="job-city" placeholder="City" required>
                    <!--<select class="job-city" id="job_city" name="job_city" required>
                        <option value="" disabled selected hidden>Select City</option>
                        <option>Saskatoon</option>
                    </select> -->
                    <script src="location.js"></script>
                    <input type="text" class="job-postal" id="job_postal" name="job_postal" placeholder=" Postal code" required>
                </div>
                <div class="rows-container">
                    <input type="text" class="job-phone" id="job_phone" name="job_phone" placeholder="Phone Number" required>
                </div><br>
                <input type="submit" class="job-submit" value="Submit">
            </div>
        </form>
    </div>
</div>

</body>
</html>