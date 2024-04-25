<?php
include("header.php");
if(!isset($_SESSION['cop_id']))
{
	echo "<script>window.location='index.php';</script>";
}
if(isset($_POST['submit']))
{
	//Update Statement starts here
	if(isset($_GET['editid']))
	{
		$sql ="UPDATE city SET city='$_POST[city]',state_id='$_POST[state_id]',description='$_POST[description]',status='$_POST[status]' WHERE city_id='$_GET[editid]'";
		$qsql = mysqli_query($con,$sql);
		echo mysqli_error($con);
		if(mysqli_affected_rows($con) == 1)
		{
			echo "<script>alert('city record updated successfully');</script>";
		}		
	}
	//Update Statement ends here
	//Insert statemetn starts here
	else
	{
		$sql ="INSERT INTO city (city,state_id,description,status)values('$_POST[city]','$_POST[state_id]','$_POST[description]','$_POST[status]')";
		$qsql = mysqli_query($con,$sql);
		echo mysqli_error($con);
		if(mysqli_affected_rows($con) == 1)
		{
			echo "<script>alert('City record inserted successfully');</script>";
			echo "<script>window.location='city.php';</script>";
		}
	}
}
?>
<?php
if(isset($_GET['editid']))
{
	$sqledit = "SELECT * FROM city WHERE city_id='$_GET[editid]'";
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
                            <h1>CITY </h1>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- End Breadcrumb Section -->


        <!-- Start About Section -->
		<form method="post" action="" >
        <section class="pad-t100 pad-b70">
            <div class="container">
                <div class="row">
					<div class="col-md-12">
                        <div class="feature-4">
	<center style="padding: 15px;"><h2><a href="#">City</a></h2></center>
	<hr>
<div class="intro-text">
	<p>
	
<div class="row">
	<div class="col-md-2">City</div>
	<div class="col-md-10">
	<input type="text" name="city" id="city" class="form-control"value="<?php echo $rsedit['city']; ?>">
	</div>
</div><br>


<div class="row">
	<div class="col-md-2">State</div>
	<div class="col-md-10">
	<select name="state_id" id="state_id" class="form-control">
		<option value="">Select State</option>
		<?php
		$sqlstate = "SELECT * FROM state WHERE status='Active'";
		$qsqlstate = mysqli_query($con,$sqlstate);
		while($rsstate = mysqli_fetch_array($qsqlstate))
		{
			if($rsstate['state_id'] == $rsedit['state_id'])
			{
			echo "<option value='$rsstate[state_id]' selected>$rsstate[state]</option>";
			}
			else
			{
			echo "<option value='$rsstate[state_id]'>$rsstate[state]</option>";
			}
		}
		?>te
	</select>
	</div>
</div><br>

<div class="row">
	<div class="col-md-2">Description</div>
	<div class="col-md-10">
		<textarea name="description" id="description" class="form-control"><?php echo $rsedit['description']; ?></textarea>
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
		</form>
        <!-- End About Section -->


<?php
include("footer.php");
?>     