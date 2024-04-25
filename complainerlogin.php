<?php
error_reporting(0);
session_start();
include("dbconnection.php");
if(isset($_SESSION['complainer_id']))
{
	echo "<script>window.location='compaccount.php';</script>";
}
if(isset($_POST['submit']))
{
	$sql ="SELECT * FROM complainer WHERE email_id='$_POST[username]' and password='$_POST[password]' and status='Active'";
	$qsql = mysqli_query($con,$sql);
	echo mysqli_error($con);
	if(mysqli_num_rows($qsql) >= 1)
	{
		$rspro = mysqli_fetch_array($qsql);
		$_SESSION['complainer_id'] = $rspro['complainer_id'];
		echo "<script>window.location='compaccount.php';</script>";
	}
	else
	{
		echo "<script>alert('You have entered invalid login credentials..');</script>";
	}
}
?>
<html>
<head>
    <title> Crime Report Management System </title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.js"></script>
    <style type="text/css">
        .errmsg
        {
            float: right;
            color: red;
        }
    </style> 
</head>
    <body>
    <div class="login-box">
    <img src="avatar.png" class="avatar">
        <h1>Login Here</h1>
            <form method="post" action="" id="login-form">
            <div class="form-group">
            	<b>Email ID</b><span class="errmsg" ></span>
            	<input type="text" name="username" placeholder="Enter Username">
        	</div>
            <div class="form-group">
            <b>Password</b><span class="errmsg" ></span>
            	<input type="password" name="password" placeholder="Enter Password">
            </div>
            <div class="form-group">
            	<input type="submit" name="submit" value="Login">
        	</div>
            <a href="recoverpassword.php">Forget Password</a>    
            </form>
        </div>
    </body>
</html>

<script>
    $(document).ready(function () {
        $('#login-form').validate({
            rules: {
		      username: {
		        required: true,
		        email: true
		      },
		      password: {
		        required: true
		      }
		    },
		    messages: {
		      username: {
		        required: "Required field",
		        email: "Enter valid Email ID"
		      },
		      password: {
		        required: "Required field",
		      }
		    },
            errorPlacement: function(error, element) {
                error.appendTo($(element).closest('.form-group').find('.errmsg'));
            },
            submitHandler: function (form) {
                form.submit();
            }
        });
    });
</script>