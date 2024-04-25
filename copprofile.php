<?php
include("header.php");
if(isset($_POST['submit']))
{
	$filename = rand() . $_FILES["img"]["name"];
	move_uploaded_file($_FILES["img"]["tmp_name"],"imgcop/".$filename);
	
	//Update Statement starts here
	if(isset($_SESSION['cop_id']))
	{
		$sql ="UPDATE cop SET cop_name='$_POST[cop_name]',station_id='$_POST[station_id]',designation_id='$_POST[designation_id]'";
		if($_FILES["img"]["name"] != "")
		{
		$sql = $sql . ",img='$filename'";
		}
		$sql = $sql . ",cop_pofile='$_POST[cop_pofile]',gender='$_POST[gender]',contact_no='$_POST[contact_no]',email_id='$_POST[email_id]',login_id='$_POST[login_id]' WHERE cop_id='$_SESSION[cop_id]'";
		$qsql = mysqli_query($con,$sql);
			echo mysqli_error($con);
		if(mysqli_affected_rows($con) == 1)
		{
			echo "<script>alert('Cop Profile updated successfully');</script>";
		}	
	}
	//Update Statement ends here
	//Insert statemetn starts here
	else
	{
		$sql ="INSERT INTO cop (cop_name,station_id,designation_id,img,cop_pofile,gender,contact_no,email_id,login_id)values('$_POST[cop_name]','$_POST[station_id]','$_POST[designation_id]','$filename','$_POST[cop_pofile]','$_POST[gender]','$_POST[contact_no]','$_POST[email_id]','$_POST[login_id]')";
		$qsql = mysqli_query($con,$sql);
			echo mysqli_error($con);
		if(mysqli_affected_rows($con) == 1)
		{
			echo "<script>alert('cop record inserted successfully');</script>";
			echo "<script>window.location='cop.php';</script>";
		}
	}
}
?>
<?php
if(isset($_SESSION['cop_id']))
{
	$sqledit = "SELECT * FROM cop WHERE cop_id='$_SESSION[cop_id]'";
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
                            <h1>COP profile </h1>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- End Breadcrumb Section -->

<form method="post" action="" enctype="multipart/form-data">
        <!-- Start About Section -->
        <section class="pad-t100 pad-b70">
            <div class="container">
                <div class="row">
					<div class="col-md-12">
                        <div class="feature-4">
	<center style="padding: 15px;"><h2><a href="#">COP profile</a></h2></center>
	<hr>
<div class="intro-text">
	<p>
<div class="row">
	<div class="col-md-2">Cop Name</div>
	<div class="col-md-10">
	<input type="text" name="cop_name" id="cop_name" class="form-control" value="<?php echo $rsedit['cop_name']; ?>">
	</div>
</div><br>

<div class="row">
	<div class="col-md-2">Station</div>
	<div class="col-md-10">
<select name="station_id" id="station_id" class="form-control">
	<option value="">Select Station</option>
	<?php
	$sqlstation = "SELECT * FROM station WHERE status='Active'";
	$qsqlstation = mysqli_query($con,$sqlstation);
	while($rsstation = mysqli_fetch_array($qsqlstation))
	{
		if($rsstation['station_id'] == $rsedit['station_id'])
		{
			echo "<option value='$rsstation[station_id]' selected>$rsstation[station]</option>";
		}
	}
	?>
</select>
	</div>
</div><br>


<div class="row">
	<div class="col-md-2">Designation</div>
	<div class="col-md-10">
	<select name="designation_id" id="designation_id" class="form-control">
		<option value="">Select Designation</option>
		<?php
		$sqldesignation = "SELECT * FROM designation WHERE status='Active'";
		$qsqldesignation = mysqli_query($con,$sqldesignation);
		while($rsdesignation = mysqli_fetch_array($qsqldesignation))
		{
			if($rsdesignation['designation_id'] == $rsedit['designation_id'])
			{
			echo "<option value='$rsdesignation[designation_id]' selected>$rsdesignation[designation_type]</option>";
			}
		}
		?>
	</select>
	</div>
</div><br>

<div class="row">
	<div class="col-md-2">Image</div>
	<div class="col-md-10">
	<input type="file" name="img" id="img" class="form-control">
	<?php
	if(isset($_SESSION['cop_id']))
	{
		echo "<img src='imgcop/$rsedit[img]' style='width: 150px; height: 175px;'>";
	}
	?>
	</div>
</div><br>

<div class="row">
	<div class="col-md-2">Cop Profile</div>
	<div class="col-md-10">
		<textarea name="cop_pofile" id="cop_pofile" class="form-control"><?php echo $rsedit['cop_pofile']; ?></textarea>
	</div>
</div><br>

<div class="row">
	<div class="col-md-2">Gender</div>
	<div class="col-md-10">
	<select name="gender" id="gender" class="form-control">
		<option value="">Select Gender</option>
		<?php
		$arr = array("Male","Female");
		foreach($arr as $val)
		{
			if($val == $rsedit['gender'])
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
	<div class="col-md-2">Contact No</div>
	<div class="col-md-10">
	<input type="text" name="contact_no" id="contact_no" class="form-control" value="<?php echo $rsedit['contact_no']; ?>">
	</div>
</div><br>


<div class="row">
	<div class="col-md-2">Email Id</div>
	<div class="col-md-10">
	<input type="text" name="email_id" id="email_id" class="form-control" value="<?php echo $rsedit['email_id']; ?>">
	</div>
</div><br>


<div class="row">
	<div class="col-md-2">Login Id</div>
	<div class="col-md-10">
	<input type="text" name="login_id" id="login_id" class="form-control" value="<?php echo $rsedit['login_id']; ?>">
	</div>
</div><br>


<hr><br>
<div class="row">
	<div class="col-md-12">
	<center><input type="submit" name="submit" id="submit" class="form-control btn btn-danger" style="width: 250px;" ></center>
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