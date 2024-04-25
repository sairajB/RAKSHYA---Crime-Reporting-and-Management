<?php
include("header.php");
if(isset($_POST['submit']))
{
 	$sql ="UPDATE complainer  SET password='$_POST[npassword]' WHERE password='$_POST[epassword]' AND complainer_id='$_SESSION[complainer_id]'";
	$qsql = mysqli_query($con,$sql);
	echo mysqli_error($con);
	if(mysqli_affected_rows($con) == 1)
	{
		echo "<script>alert('Complainer password updated successfully');</script>";
		echo "<script>window.location='complainerchangepassword.php';</script>";
	}
	else
	{
		echo "<script>alert('Failed to update Complainer password');</script>";
		echo "<script>window.location='complainerchangepassword.php';</script>";
	}
}
?>   
        <!-- Start Breadcrumb Section -->
        <section class="breadcrumb-section parallax" style="background-image: url(assets/images/bg/breadcrumb4.jpg);">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="page-title">
                            <h1 style="background-color: #626262; background-color: rgba(98, 98, 98, 0.6);">Complainer - Change Password</h1>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- End Breadcrumb Section -->

<form method="post" action="">
        <!-- Start About Section -->
        <section class="pad-t100 pad-b70">
            <div class="container">
                <div class="row">
					<div class="col-md-12">
                        <div class="feature-4">
	<center style="padding: 15px;"><h2><a href="#">Complainer - Change Password</a></h2></center>
	<hr>
<div class="intro-text">
	<p>
	
<div class="row">
	<div class="col-md-2">Existing Password</div>
	<div class="col-md-10">
	<input type="password" name="epassword" id="epassword" class="form-control">
	</div>
</div><br>

<div class="row">
	<div class="col-md-2">New Password</div>
	<div class="col-md-10">
	<input type="password" name="npassword" id="npassword" class="form-control">
	</div>
</div><br>

<div class="row">
	<div class="col-md-2">Confirm Password</div>
	<div class="col-md-10">
	<input type="password" name="cpassword" id="cpassword" class="form-control">
	</div>
</div><br>

<div class="row">
	<div class="col-md-2"></div>
	<div class="col-md-10">
	<input type="submit" name="submit" id="submit" class="form-control btn btn-danger" style="width: 250px;" >
	</div>
</div><br>

	</p>
</div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
		</form>
        <!-- End About Section -->


<?php
include("footer.php");
?>     