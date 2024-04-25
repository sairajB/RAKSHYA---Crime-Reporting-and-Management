<?php
include("header.php");
if(isset($_POST['submit']))
{
	//Update Statement starts here
	if(isset($_GET['editid']))
	{
		$sql ="UPDATE complainer SET name='$_POST[name]',email_id='$_POST[email_id]',phoneno='$_POST[phoneno]',password='$_POST[password]',status='$_POST[status]' WHERE complainer_id='$_GET[editid]'";
		$qsql = mysqli_query($con,$sql);
		if(mysqli_affected_rows($con) == 1)
		{
			echo "<script>alert('complainer record updated successfully');</script>";
		}
		else
		{
			echo mysqli_error($con);
		}		
	}
	//Update Statement ends here
	//Insert statemetn starts here
	else
	{
		$sql ="INSERT INTO complainer (name,email_id,phoneno,password,status)values('$_POST[name]','$_POST[email_id]','$_POST[phoneno]','$_POST[password]','$_POST[status]')";
		$qsql = mysqli_query($con,$sql);
		if(mysqli_affected_rows($con) == 1)
		{
			echo "<script>alert('complainer record inserted successfully');</script>";
			echo "<script>window.location='complainer.php';</script>";
		}
		else
		{
			echo mysqli_error($con);
		}
	}
}
?>
<?php
if(isset($_GET['editid']))
{
	$sqledit = "SELECT * FROM complainer WHERE complainer_id='$_GET[editid]'";
	$qsqledit = mysqli_query($con,$sqledit);
	$rsedit = mysqli_fetch_array($qsqledit);
}
?>      
        <!-- Start Breadcrumb Section -->
        <section class="breadcrumb-section parallax" style="background-image: url(assets/images/bg/breadcrumb4.jpg);">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="page-title">
                            <h1>Complainer </h1>
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
	<center style="padding: 15px;"><h2><a href="#">Complainer</a></h2></center>
	<hr>
<div class="intro-text">
	<p>
	
<div class="row">
	<div class="col-md-2">Name</div>
	<div class="col-md-10">
		<input type="text" name="name" id="name" class="form-control" value="<?php echo $rsedit['name']; ?>" >
	</div>
</div><br>

<div class="row">
	<div class="col-md-2">Email ID </div>
	<div class="col-md-10">
		<input type="text" name="email_id" id="email_id" class="form-control" value="<?php echo $rsedit['email_id']; ?>" >
	</div>
</div><br>

<div class="row">
	<div class="col-md-2">Phone Number</div>
	<div class="col-md-10">
		<input type="text" name="phoneno" id="phoneno" class="form-control" value="<?php echo $rsedit['phoneno']; ?>" >
	</div>
</div><br>

<div class="row">
	<div class="col-md-2">Password </div>
	<div class="col-md-10">
		<input type="password" name="password" id="password" class="form-control" value="<?php echo $rsedit['password']; ?>" >
	</div>
</div><br>

<div class="row">
	<div class="col-md-2">Confirm Password </div>
	<div class="col-md-10">
		<input type="password" name="cpassword" id="cpassword" class="form-control" value="<?php echo $rsedit['password']; ?>" >
	</div>
</div><br>




<div class="row">
	<div class="col-md-2">Status</div>
	<div class="col-md-10">
	<select name="status" id="status" class="form-control">
		<option value="">Select Status</option>
		<?php
		$arr = array("Active","Inactive");
		foreach($arr as $val)
		{
			if($val == $rsedit['status'])
			{
			echo "<option value='$val' selected>$val</option>";
			}
			else
			{
			echo "<option value='$val'>$val</option>";
			}
		}
		?>
	</select>
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
        <!-- End About Section -->
</form>

<?php
include("footer.php");
?>     