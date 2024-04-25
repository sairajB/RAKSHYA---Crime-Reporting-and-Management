<?php
include("header.php");
if(isset($_POST['submit']))
	{
		//Update Statement starts here
	if(isset($_GET['editid']))
	{
		$sql ="UPDATE designation SET designation_type='$_POST[designation_type]',designation_details='$_POST[designation_details]',status='$_POST[status]' WHERE designation_id='$_GET[editid]'";
		$qsql = mysqli_query($con,$sql);
			echo mysqli_error($con);
		if(mysqli_affected_rows($con) == 1)
		{
			echo "<script>alert('station record updated successfully');</script>";
		}	
	}
	//Update Statement ends here
	//Insert statemetn starts here
	else
	{
		$sql ="INSERT INTO designation (designation_type,designation_details,status)values('$_POST[designation_type]','$_POST[designation_details]','$_POST[status]')";
		$qsql = mysqli_query($con,$sql);
			echo mysqli_error($con);
		if(mysqli_affected_rows($con) == 1)
		{
			echo "<script>alert('designation record inserted successfully');</script>";
			echo "<script>window.location='designation.php';</script>";
		}
	}
}
?>
<?php
if(isset($_GET['editid']))
{
	$sqledit = "SELECT * FROM designation WHERE designation_id='$_GET[editid]'";
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
                            <h1>CRIME REPORTING </h1>
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
	<center style="padding: 15px;"><h2><a href="#">Designation</a></h2></center>
	<hr>
<div class="intro-text">
	<p>

<div class="row">
<div class="col-md-2">Designation Type</div>
	<div class="col-md-10">
	<input type="text" name="designation_type" id="designation_type" class="form-control" value="<?php echo $rsedit['designation_type']; ?>">
	</div>
</div><br>

<div class="row">
	<div class="col-md-2">Designation Details</div>
	<div class="col-md-10">
		<textarea name="designation_details" id="designation_details" class="form-control"><?php echo $rsedit['designation_details']; ?></textarea>
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
</form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- End About Section -->


<?php
include("footer.php");
?>     