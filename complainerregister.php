<?php
error_reporting(0);
session_start();
include("dbconnection.php");
if(isset($_SESSION['complaint_id']))
{
	echo "<script>window.location='compaccount.php';</script>";
}
if(isset($_POST['submit']))
{
	$sql ="INSERT INTO complainer(name, email_id, phoneno, password, status) VALUES ('$_POST[name]','$_POST[email_id]','$_POST[phoneno]','$_POST[password]','Active')";
	$qsql = mysqli_query($con,$sql);
	echo mysqli_error($con);
	if(mysqli_affected_rows($con) >= 1)
	{
		echo "<script>alert('You have registered successfully..');</script>";
		echo "<script>window.location='complainerlogin.php';</script>";
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
    <div class="login-box" style="width: 500px;height: 570px;">
    <img src="avatar.png" class="avatar">
        <h1>Complainer Registration panel</h1>
            <form method="post" action="" id="register-form">
                <div class="form-group">
                    <b>Name</b><span class="errmsg" ></span>
                    <input type="text" name="name" id="name" placeholder="Enter Name">
                </div>
                <div class="form-group">
                    <b>Email ID</b><span class="errmsg" ></span>
                    <input type="text" name="email_id" id="email_id" placeholder="Enter Email ID">
                </div>
                <div class="form-group">
                    <b>Phone No.</b><span class="errmsg" ></span>
                   <input type="text" name="phoneno" id="phoneno" placeholder="Enter Phone No.">
                </div>
                <div class="form-group">
                    <b>Password</b><span class="errmsg" ></span>
                    <input type="password" name="password" id="password" placeholder="Enter Password">
                </div>
                <div class="form-group">
                    <b>Confirm Password</b><span class="errmsg" ></span>
                    <input type="password" name="cpassword" id="cpassword" placeholder="Confirm Password">
                </div>
                <div class="form-group">
                    <input type="submit" name="submit" id="submit" value="Click to Register">   
                </div>
            </form>
        </div>
    </body>
</html>

<script>
    $(document).ready(function () {
        $('#register-form').validate({
            rules: {
                name: {
                    required: true,
                    minlength: 2
                },
                email_id: {
                    required: true,
                    email: true
                },
                phoneno: {
                    required: true,
                    minlength: 10,
                    maxlength: 10,
                    number: true
                },
                password: {
                    required: true,
                    minlength: 6
                },
                cpassword: {
                    required: true,
                    equalTo: '#password'
                }
            },
            messages: {
                name: {
                    required: 'Please enter your name',
                    minlength: 'Your name must consist of at least 2 characters'
                },
                email_id: {
                    required: 'Please enter your email address',
                    email: 'Please enter a valid email address'
                },
                phoneno: {
                    required: 'Please enter your phone number',
                    minlength: 'Your phone number must consist of 10 digits',
                    maxlength: 'Your phone number must consist of 10 digits',
                    number: 'Please enter a valid phone number'
                },
                password: {
                    required: 'Please enter your password',
                    minlength: 'Your password must consist of at least 6 characters'
                },
                cpassword: {
                    required: 'Please confirm your password',
                    equalTo: 'Password does not match'
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