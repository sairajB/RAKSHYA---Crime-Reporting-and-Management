<?php
session_start();
include("dbconnection.php");
if(isset($_POST['submit']))
{
	$sql ="SELECT * FROM complainer WHERE email_id='$_POST[username]' and status='Active'";
	$qsql = mysqli_query($con,$sql);
	echo mysqli_error($con);
	if(mysqli_num_rows($qsql) >= 1)
	{
		$_SESSION['resetid']=rand();
		$rspro = mysqli_fetch_array($qsql);
		$url = 'http://'.$_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF']);
		echo $message = "Hello $rspro[name],<br>
		You have sent request to recover password. Kindly press below link to reset password...<br><br>
		Visit Link - <b><a href='$url/resetpassword.php?resetid=$_SESSION[resetid]&compid=$rspro[0]'>Click here</a></b><br>
		";
		include("phpmailer.php");
		sendmail($rspro['email_id'], $rspro['name'] , "Password Recovery Mail", $message);
		echo "<script>alert('Password reset link sent to your Email ID..');</script>";
		echo "<script>window.location='index.php';</script>";
	}
	else
	{
		echo "<script>alert('You have entered invalid login credentials..');</script>";
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
        <h1>Forgot password? </h1>
            <form method="post" action="">
			<br>
            <p>Enter Email ID</p>
            <input type="text" name="username" placeholder="Enter Email ID">
            <input type="submit" name="submit" value="Click to Recover Password">
            
            </form>
        
        
        </div>
    
    </body>
</html>