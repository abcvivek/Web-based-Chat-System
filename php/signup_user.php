<?php include("./connection.php");

	if(isset($_POST['sign_up'])){

	$name = htmlentities(mysqli_real_escape_string($con,$_POST['user_name']));
	$pass = htmlentities(mysqli_real_escape_string($con,$_POST['user_pass']));
	$email = htmlentities(mysqli_real_escape_string($con,$_POST['user_email']));
	$gender = htmlentities(mysqli_real_escape_string($con,$_POST['user_gender']));

	if($name == ''){
		echo "<script>alert('Please Enter Your Name')</script>";
	}

	if(strlen($pass)<8){

	echo "<script>alert('Password should be minimum 8 characters!')</script>";
	echo "<script>window.open('./signup.php','_self')</script>";
	exit();
	}

	$check_email = "select * from users where user_email='$email'";
	$run_email = mysqli_query($con,$check_email);

	$check = mysqli_num_rows($run_email);

	if($check==1){

	echo "<script>alert('Email already exist, please try another!')</script>";
	echo "<script>window.open('./signup.php','_self')</script>";
	exit();
	}
	
	$profile_pic = "/img/chat.png";

	$insert = "insert into users (user_name,user_pass,user_email,user_profile,user_gender) values ('$name','$pass','$email','$profile_pic','$gender')";

	$query = mysqli_query($con,$insert);

	if($query){

	echo "<script>alert('Congratulations $name, your account has been created successfully.')</script>";
	echo "<script>window.open('../index.php','_self')</script>";

	}
	else {

	echo "<script>alert('Registration failed, try again!')</script>";
	echo "<script>window.open('./signup.php','_self')</script>";
	}
}
?>
