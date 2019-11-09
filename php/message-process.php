<!DOCTYPE html>
<?php
session_start();

include("./connection.php");

if(!isset($_SESSION['user_email'])){
	
	header("location: ../index.php");

}
else{ ?>

<html>
<head>
	<title>Chat - Home</title>
	<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="../css/home.css">
	<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
</head>
<body>

<?php
    if(isset($_POST['submit']) && $_POST['randcheck'] == $_SESSION['rand']){
        $msg = htmlentities($_POST['msg_content']);
        
        $username = $_POST['loggedin_user'];
        $user_name = $_POST['msg_receiver'];
            
        if($msg == ""){
            echo"

            <div class='alert alert-danger'>
              <strong><center>Message was unable to send!</center></strong>
            </div>

            ";
        }else if(strlen($msg) > 100){
            echo"

            <div class='alert alert-danger'>
              <strong><center>Message is Too long! Use only 100 characters</center></strong>
            </div>

            ";
        }
        else{

        $insert = "insert into users_chat(sender_username,receiver_username,msg_content,msg_status,msg_date) values ('$user_name','$username','$msg','unread',NOW())";
        
        $run_insert = mysqli_query($con,$insert);

        echo "<script>window.open('./home.php?user_name=$username','_self')</script>";

        }
    }
 ?>
</body>
<?php } ?>