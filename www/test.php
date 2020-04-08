
<!DOCTYPE html>
<html>
<head>
<title>Sample test for Rock A Job</title>
</head>
<body>

<?php 
    
     $hostname = "shubh-mysql-app";
	 $username = "shubhuser";
	 $password = "shubhpass";
	 $dbname = "shubh_db";
	 $connect = mysqli_connect($hostname, $username, $password, $dbname);
	 if ($connect->connect_error) {
    die("Connection failed: " . $connect->connect_error);
} 

echo nl2br("\n");  //new line

      $query38 = "DELETE FROM user WHERE email = 'Shubh001@gmail.com'";
      if($connect->query($query38) === TRUE){}

       //Getting all the user from data base
	   echo "<h2>Getting all the user from data base: </h2>";
		echo nl2br("\n");
		$query1 = "SELECT * FROM user";
		$result2 = $connect->query($query1);
		$count = 0;
		while($row = mysqli_fetch_assoc($result2)) {	
		    $count++;
			echo "user "; echo $count; echo ":";
			echo $row["email"];
			echo nl2br("\n");					
		}
		echo nl2br("\n");
		echo nl2br("\n");
		
	   
	 
	   //Sign up Test
		echo "<h2>Sign up Test: </h2>";
		echo nl2br("\n");
		echo nl2br("\n");
		$p_pass = "12345";
		$password_hash = md5($p_pass);
		echo "Query to insert the sign up data into the database:";
		echo nl2br("\n");
		$query3 = "insert INTO user (first_name,last_name,password,email,phone) VALUES 
			('Shubh','Sahi','$password_hash','Shubh001@gmail.com','3062033669')" ;
			echo $query3;
			echo nl2br("\n");
			echo nl2br("\n");
			if($connect->query($query3) === TRUE){
					$message = "Successfully Registered As 'Shubh'";
                    echo $message;
					echo nl2br("\n");
					echo nl2br("\n");
				}
				
          else{ 		  
		         $message = "Error,Please try again";
                    echo "<script type='text/javascript'>alert('$message');</script>";
					
		  }	

        //Login test
		echo "<h2>Login test: </h2>";
		echo nl2br("\n");
		echo nl2br("\n");
		$query = "SELECT * FROM user where email = 'ask172@usask.ca'";
		echo "Query to fetch the login data from the database:";
		echo nl2br("\n");
		echo $query;
		echo nl2br("\n");
		echo nl2br("\n");
	    $result = $connect->query($query);
		//echo mysqli_num_rows($result);
		//echo nl2br("\n");
					if (mysqli_num_rows($result) > 0) {
				
    while($row = mysqli_fetch_assoc($result)) {
		
        
			if($password_hash ===  $row["password"]){
				
				echo "Logged in successfully as Alavi";
                echo nl2br("\n");
                echo nl2br("\n");				
			}
			else{
	
				$message = "Error in Login:Wrong Password, Please try again!!!!";
                    echo "<script type='text/javascript'>alert('$message');</script>";
			}
		
		}
} else {
    //echo "Wrong Username";
	$message = "Error in Login:Wrong UserID, Please try again!!!!";
                    echo "<script type='text/javascript'>alert('$message');</script>";
					//echo '<a href="Login_pick.html" target="blank">Click to try again</a>';
}

        //Showing all the jobs from data base
	   echo "<h2>Showing all the jobs from data base: </h2>";
		echo nl2br("\n");
		$query4 = "SELECT * FROM job";
		$result4 = $connect->query($query4);
		$count = 0;
		while($row = mysqli_fetch_assoc($result4)) {	
		    $count++;
			echo "Job "; echo $count; echo ":";
			echo nl2br("\n");
			echo "Job title: ", $row["title"]; echo nl2br("\n");
			echo "Job Category: ", $row["category"]; echo nl2br("\n");
			echo "Job Description: ", $row["job_description"]; echo nl2br("\n");
			echo "Job ID: ", $row["job_id"]; echo nl2br("\n");
			echo "Job Amount: ", $row["amount"]; echo nl2br("\n");
			echo "Job status: ", $row["job_status"]; echo nl2br("\n");
						
			echo nl2br("\n");					
		}
		echo nl2br("\n");
		echo nl2br("\n");
		
		//Showing available jobs from data base
	   echo "<h2>Showing open status jobs from data base: </h2>";
		echo nl2br("\n");
		$query4 = "SELECT * FROM job where job_status = 'open'";
		$result4 = $connect->query($query4);
		$count = 0;
		while($row = mysqli_fetch_assoc($result4)) {	
		    $count++;
			echo "Job "; echo $count; echo ":";
			echo nl2br("\n");
			echo "Job title: ", $row["title"]; echo nl2br("\n");
			echo "Job Category: ", $row["category"]; echo nl2br("\n");
			echo "Job Description: ", $row["job_description"]; echo nl2br("\n");
			echo "Job ID: ", $row["job_id"]; echo nl2br("\n");
			echo "Job Amount: ", $row["amount"]; echo nl2br("\n");
			echo "Job status: ", $row["job_status"]; echo nl2br("\n");
						
			echo nl2br("\n");					
		}
		echo nl2br("\n");
		echo nl2br("\n");


    //Post a job test:
	echo "<h2>post a job test: </h2>";
	echo nl2br("\n");
	echo nl2br("\n");
	echo "Query to post a job in database:";
	echo nl2br("\n");
	$query2 = "insert INTO job (category,title,job_description,amount,job_address,job_province,job_city,job_postal,job_phone,job_status,poster_email) VALUES 
			('Paint','Need to paint my kitchen','Approximate 5 hours of work. Students Only','200','91 campus DR','SK','saskatoon','S7N5E8','3062033669','open','adi@gmail.com')" ;
			echo $query2;
			echo nl2br("\n");
			echo nl2br("\n");
			if($connect->query($query2) === TRUE){
					$message = "Successfully posted the job";
                    echo $message;
					echo nl2br("\n");
					echo nl2br("\n");
				}
				
          else{ 		  
		         $message = "Error,Please try again";
                    echo "<script type='text/javascript'>alert('$message');</script>";
					
		  }	
		  
		  //Showing available jobs from data base
	   echo "<h2>Showing available jobs after posting a new one from data base: </h2>";
		echo nl2br("\n");
		$query4 = "SELECT * FROM job where job_status = 'Posted'";
		$result4 = $connect->query($query4);
		$count = 0;
		while($row = mysqli_fetch_assoc($result4)) {	
		    $count++;
			echo "Job "; echo $count; echo ":";
			echo nl2br("\n");
			echo "Job title: ", $row["title"]; echo nl2br("\n");
			echo "Job Category: ", $row["category"]; echo nl2br("\n");
			echo "Job Description: ", $row["job_description"]; echo nl2br("\n");
			echo "Job ID: ", $row["job_id"]; echo nl2br("\n");
			echo "Job Amount: ", $row["amount"]; echo nl2br("\n");
			echo "Job status: ", $row["job_status"]; echo nl2br("\n");
						
			echo nl2br("\n");					
		}
		echo nl2br("\n");
		echo nl2br("\n");
		
		
		//Assign a job test
		echo "<h2>Assign a job test: </h2>";
	echo nl2br("\n");
	echo nl2br("\n");
		$sql2="UPDATE job SET job_status='Assigned' WHERE job_id='1'";
		echo "Query to Assign a job in database:";
	    echo nl2br("\n");
		echo $sql2;
		echo nl2br("\n");
		if($connect->query($sql2) === TRUE){
					$message = "Successfully Assigned the job with id: '1' ";
                    echo $message;
					echo nl2br("\n");
					echo nl2br("\n");
				}
				
				//Showing Assigned jobs from data base
	   echo "<h2>Showing Assigned jobs after assigning a job: </h2>";
		echo nl2br("\n");
		$query4 = "SELECT * FROM job where job_status = 'Assigned'";
		$result4 = $connect->query($query4);
		$count = 0;
		while($row = mysqli_fetch_assoc($result4)) {	
		    $count++;
			echo "Job "; echo $count; echo ":";
			echo nl2br("\n");
			echo "Job title: ", $row["title"]; echo nl2br("\n");
			echo "Job Category: ", $row["category"]; echo nl2br("\n");
			echo "Job Description: ", $row["job_description"]; echo nl2br("\n");
			echo "Job ID: ", $row["job_id"]; echo nl2br("\n");
			echo "Job Amount: ", $row["amount"]; echo nl2br("\n");
			echo "Job status: ", $row["job_status"]; echo nl2br("\n");
					
			echo nl2br("\n");					
		}
		echo nl2br("\n");
		echo nl2br("\n");
		
		
	
?>


</body>
</html> 















