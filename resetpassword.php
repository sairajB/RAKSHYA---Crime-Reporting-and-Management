<?php
session_start();
include("dbconnection.php");
if($_SESSION['resetid'] != $_GET['resetid'])
{
	echo "<script>alert('reset link Expired..');</script>";
	echo "<script>window.location='recoverpassword.php';</script>";
}
if(isset($_POST['submit']))
{
	$sql ="UPDATE complainer SET password='$_POST[npassword]' WHERE complainer_id='$_GET[compid]'";
	$qsql = mysqli_query($con,$sql);
	echo mysqli_error($con);
	if(mysqli_affected_rows($con) >= 1)
	{
		echo "<script>alert('Password updated successfully...');</script>";
		echo "<script>window.location='complainerlogin.php';</script>";
	}
}
?>
<html>
<head>
    <title>Forgot password? </title>
    <link rel="stylesheet" type="text/css" href="style.css">   
</head>
    <body>
		<div class="login-box">
		<img src="avatar.png" class="avatar">
        <h1>Change Password.. </h1>
            <form method="post" action="">
				<br>
				<p>New password</p>
				<input type="password" name="npassword" placeholder="Enter Old password"><br>
				<p>Confirm password</p>
				<input type="password" name="cpassword" placeholder="Enter New password"><br>
				<input type="submit" name="submit" value="Click to Change Password">            
            </form>              
        </div>
    </body>
</html>