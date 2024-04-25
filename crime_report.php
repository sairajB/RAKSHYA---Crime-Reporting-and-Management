<?php
include("header.php");
if(!isset($_SESSION['cop_id']))
{
	echo "<script>window.location='index.php';</script>";
}
if(isset($_POST['submit']))
{
	$crime_report = mysqli_real_escape_string($con,$_POST['crime_report']);
	//Update Statement starts here
	if(isset($_GET['editid']))
	{
		$sql ="UPDATE crime_report SET complaint_id='$_POST[complaint_id]',reportdate='$_POST[reportdate]',crime_reporttitle='$_POST[crime_reporttitle]',crime_report='$_POST[crime_report]',status='$_POST[status]' WHERE crimereport_id='$_GET[editid]'";
		$qsql = mysqli_query($con,$sql);
			echo mysqli_error($con);
		if(mysqli_affected_rows($con) == 1)
		{
			echo "<script>alert('Crime Report updated successfully');</script>";
		}	
	}
	//Update Statement ends here
	//Insert statemetn starts here
	else
	{
		$sql ="INSERT INTO crime_report(complaint_id,chargesheet_id,reportdate,crime_reporttitle,crime_report,status)values('$_POST[complaint_id]','$_POST[chargesheet_id]','$_POST[reportdate]','$_POST[crime_reporttitle]','$_POST[crime_report]','Active')";
		$qsql = mysqli_query($con,$sql);
			echo mysqli_error($con);
		if(mysqli_affected_rows($con) == 1)
		{
			echo "<script>alert('crime record inserted successfully');</script>";
			$insid = mysqli_insert_id($con);
			echo "<script>window.location='crime_report.php?editid=$insid';</script>";
		}
	}
}
?>  
<?php
if(isset($_GET['editid']))
{
	$sqledit = "SELECT * FROM crime_report WHERE crimereport_id='$_GET[editid]'";
	$qsqledit = mysqli_query($con,$sqledit);
	$rsedit = mysqli_fetch_array($qsqledit);
	$_GET['chargesheet_id'] = $rsedit['chargesheet_id'];
	$_GET['complaint_id'] = $rsedit['complaint_id'];
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
	<center style="padding: 15px;"><h2><a href="#">Crime Report</a></h2></center>
	<hr>
<div class="intro-text">

<table class="table table-striped table-bordered">
	<thead>
		<tr>
			<th>Chargesheet No.</th>			
			<th>Complaint No.</th>			
			<th>FIR Registration No.</th>		
			<th>Section</th>		
			<th>Chargesheet description</th>
			<th>Chargesheet<br> Documents</th>	
		</tr>
	</thead>
	<tbody>
		<?php
		$sql = "SELECT * FROM chargesheet WHERE chargesheet_id='$_GET[chargesheet_id]'";
		$qsql = mysqli_query($con,$sql);
		$rs = mysqli_fetch_array($qsql);
		
			echo "<tr>
						<td>$rs[0]</td>			
						<td>$rs[complaint_id]</td>			
						<td>$rs[fir_id]</td>			
						<td>$rs[section]</td>	
						<td>$rs[description]</td>			
						<td>";
if(file_exists("docschargesheet/".$rs['chargesheetdocs']))
{	
	echo "<a href='docschargesheet/$rs[chargesheetdocs]' class='btn btn-info' >Download</a>";
}				
			echo "</td>		
				</tr>";
	?>
	</tbody>
</table>

<hr>

	<p>
<input type="hidden" name="complaint_id" id="complaint_id" value="<?php echo $rs['complaint_id']; ?>" >
<input type="hidden" name="chargesheet_id" id="chargesheet_id" value="<?php echo $_GET['chargesheet_id']; ?>" >
<div class="row">
	<div class="col-md-2">Crime Report Date</div>
	<div class="col-md-10">
		<input type="date" name="reportdate" id="reportdate" class="form-control" max="<?php echo date("Y-m-d"); ?>" value="<?php echo date("Y-m-d"); ?>">
	</div>
</div><br>


<div class="row">
	<div class="col-md-2">Crime Report Title</div>
	<div class="col-md-10">
		<input type="text" name="crime_reporttitle" id="crime_reporttitle" class="form-control" value="<?php echo  $rsedit['crime_reporttitle']; ?>">
	</div>
</div><br>


<div class="row">
	<div class="col-md-2">Crime Report</div>
	<div class="col-md-10">
		<textarea name="crime_report" id="crime_report" class="form-control" rows="15"><?php echo $rsedit['crime_report']; ?></textarea>
<script src="assets/js/tinymce.min.js" ></script>
<script>tinymce.init({ selector:'textarea' });</script>		
	</div>
</div><br>


<div class="row">
	<div class="col-md-12">
		<center><input type="submit" name="submit" id="submit" class="form-control btn btn-danger" style="width: 250px;" ></center>
	</div>
</div>

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