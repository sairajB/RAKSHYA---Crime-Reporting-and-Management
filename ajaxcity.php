<?php
include("dbconnection.php");
?>
<select name="city_id" id="city_id" class="form-control" onchange="loadpolicestation(this.value)">
	<option value="">Select City</option>
	<?php
	$sqlcity = "SELECT * FROM city WHERE status='Active' ";
	if(isset($_GET['editid']))
	{
	$sqlcity = $sqlcity . " AND state_id='$rsedit[state_id]'";
	}
	else
	{
	$sqlcity = $sqlcity . " AND state_id='$_GET[state_id]'";
	}
	$qsqlcity = mysqli_query($con,$sqlcity);
	while($rscity = mysqli_fetch_array($qsqlcity))
	{
		if($rscity['city_id'] == $rsedit['city_id'])
		{
			echo "<option value='$rscity[city_id]' selected>$rscity[city]</option>";
		}
		else
		{
			echo "<option value='$rscity[city_id]'>$rscity[city]</option>";
		}
	}
	?>
</select>