<?php
include("dbconnection.php");
?>
<select name="station_id" id="station_id" class="form-control">
	<option value="">Select station </option>
	<?php
	$sqlstation = "SELECT * FROM station WHERE	status='Active'";
	if(isset($_GET['editid']))
	{
	$sqlstation = $sqlstation . " AND city_id='$rsedit[city_id]'";
	}
	else
	{
	$sqlstation = $sqlstation . " AND city_id='$_GET[city_id]'";
	}
	$qsqlstation = mysqli_query($con,$sqlstation);
	while($rsstation = mysqli_fetch_array($qsqlstation))
	{
		if($rsstation['station_id'] == $rsedit['station_id'])
		{
			echo "<option value='$rsstation[station_id]' selected>$rsstation[station]</option>";
		}
		else
		{
			echo "<option value='$rsstation[station_id]'>$rsstation[station]</option>";
		}
	}
	?>
</select>