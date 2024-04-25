<?php
include("header.php");
if(isset($_GET['delid']))
{
	$sql = "DELETE FROM prisoner WHERE prisoner_id='$_GET[delid]'";
	$qsql = mysqli_query($con,$sql);
		echo mysqli_error($con);
	if(mysqli_affected_rows($con) == 1)
	{
		echo "<script>alert('prisoner record deleted successfully...');</script>";
		echo "<script>window.location='prisoner.php?crimereport_id=$_GET[crimereport_id]';</script>";
	}
}
if(isset($_POST['submit']))
{
	$prisonerimg = rand(). $_FILES["prisonerimg"]["name"];
	move_uploaded_file($_FILES["prisonerimg"]["tmp_name"],"imgprisoner/".$prisonerimg);
	$prisinerdocument = rand(). $_FILES["prisinerdocument"]["name"];	
	move_uploaded_file($_FILES["prisinerdocument"]["tmp_name"],"docprisoner/".$prisinerdocument);
	//Update Statement starts here
	if(isset($_GET['editid']))
	{
		$sql ="UPDATE prisoner SET complaint_id='$_POST[complaint_id]',fir_id='$_POST[fir_id]',chargesheet_id='$_POST[chargesheet_id]',prisonername='$_POST[prisonername]',section='$_POST[section]',crimedetails='$_POST[crimedetails]',prisoneraddress='$_POST[prisoneraddress]'";
		if($_FILES["prisonerimg"]["name"] != "")
		{
		$sql = $sql . ",prisonerimg='$prisonerimg'";
		}
		if($_FILES["prisinerdocument"]["name"] != "")
		{
		$sql = $sql . ",prisinerdocument='$prisinerdocument'";
		}
		$sql = $sql . ",anynote='$_POST[anynote]' WHERE prisoner_id='$_GET[editid]'";
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
		$sql ="INSERT INTO prisoner(crimereport_id,complaint_id,fir_id,chargesheet_id,prisonername,section,crimedetails,prisoneraddress,prisonerimg,prisinerdocument,anynote,status) values('$_POST[crimereport_id]','$_POST[complaint_id]','$_POST[fir_id]','$_POST[chargesheet_id]','$_POST[prisonername]','$_POST[section]','$_POST[crimedetails]','$_POST[prisoneraddress]','$prisonerimg','$prisinerdocument','$_POST[anynote]','Active')";
		$qsql = mysqli_query($con,$sql);
			echo mysqli_error($con);
		if(mysqli_affected_rows($con) == 1)
		{
			echo "<script>alert('Prisoner record inserted successfully');</script>";
			echo "<script>window.location='prisoner.php?crimereport_id=$_GET[crimereport_id]';</script>";
		}
	}
	//Insert statemetn Ends here
}
?>
<?php
if(isset($_GET['editid']))
{
	$sqledit = "SELECT * FROM prisoner WHERE prisoner_id='$_GET[editid]'";
	$qsqledit = mysqli_query($con,$sqledit);
			echo mysqli_error($con);
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


        <!-- Start About Section -->
		<form method="post" action="" enctype="multipart/form-data" >
        <section class="pad-t100 pad-b70">
            <div class="container">
                <div class="row">
					<div class="col-md-12">
                        <div class="feature-4">
	<center style="padding: 15px;"><h2><a href="#">prisoner information</a></h2></center>
	<hr>
<div class="intro-text">
	<p>
<table  class="table table-striped table-bordered">
	<thead>
		<tr>
			<th><h5>Complaint No.</h5></th>			
			<th><h5>Chargesheet No.</h5></th>			
			<th><h5>Report Date</h5></th>			
			<th><h5>Crime Report Title</h5></th>			
			<th><h5>Crime Report</h5></th>
		</tr>
	</thead>
	<tbody>
		<?php
		$sql = "SELECT crime_report.*,chargesheet.fir_id  FROM crime_report LEFT JOIN chargesheet on  crime_report.chargesheet_id= chargesheet.chargesheet_id WHERE crime_report.crimereport_id='$_GET[crimereport_id]'";
		$qsql = mysqli_query($con,$sql);
		while($rs = mysqli_fetch_array($qsql))
		{
		?>
<input type="hidden" name="crimereport_id" id="crimereport_id" value="<?php echo $rs['crimereport_id']; ?>">
<input type="hidden" name="complaint_id" id="complaint_id" value="<?php echo $rs['complaint_id']; ?>">
<input type="hidden" name="chargesheet_id" id="chargesheet_id" value="<?php echo $rs['chargesheet_id']; ?>">
<input type="hidden" name="fir_id" id="fir_id" value="<?php echo $rs['fir_id']; ?>">
		<?php
			$sqlprisoner = "SELECT * FROM prisoner WHERE crimereport_id='$rs[0]'";
			$qsqlprisoner =  mysqli_query($con,$sqlprisoner);
			$countprisoner = mysqli_num_rows($qsqlprisoner);
			echo "<tr>
	<td>$rs[complaint_id]</td>			
	<td>$rs[chargesheet_id]</td>				
	<td> " . date("d-M-Y",strtotime($rs['reportdate'])) . "</td>			
	<td>$rs[crime_reporttitle]</td>			
	<td><a href='' onclick='return false;' class='btn btn-info' style='width: 100px;'  data-toggle='modal' data-target='#myModal$rs[0]' >View</a></td>			
		
				</tr>";
?>
<div id="myModal<?php echo $rs[0]; ?>" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title"><?php echo $rs['crime_reporttitle']; ?></h4>
      </div>
      <div class="modal-body">
        <p><?php echo $rs['crime_report']; ?></p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<?php
		}
	?>
	</tbody>
</table>
<?php
	if(isset($_SESSION['cop_id']))
	{
?>
<div class="row">
	<div class="col-md-12"><hr><br></div>
</div>

<div class="row">
	<div class="col-md-3">Prisoner Name</div>
	<div class="col-md-9">
	<input type="text" name="prisonername" id="prisonername" value="<?php echo $rsedit['prisonername']; ?>" class="form-control">
	</div>
</div><br>

<div class="row">
	<div class="col-md-3">Section</div>
	<div class="col-md-9">
	<input type="text" name="section" id="section"  value="<?php echo $rsedit['section']; ?>" class="form-control">
	</div>
</div><br>

<div class="row">
	<div class="col-md-3">Crime Details</div>
	<div class="col-md-9">
	<textarea name="crimedetails" id="crimedetails" class="form-control"><?php echo $rsedit['crimedetails']; ?></textarea>
	</div>
</div><br>

<div class="row">
	<div class="col-md-3">Prisoner Address</div>
	<div class="col-md-9">
	<textarea name="prisoneraddress" id="prisoneraddress" class="form-control"><?php echo $rsedit['prisoneraddress']; ?></textarea>
	</div>
</div><br>

<div class="row">
	<div class="col-md-3">Prisoner Image</div>
	<div class="col-md-9">
	<input type="file" name="prisonerimg" id="prisonerimg" class="form-control">
<?php
if(isset($_GET['editid']))
{
echo "<img src='imgprisoner/$rsedit[prisonerimg]' style='width: 70px;height: 75px;'>";
}
?>	
	</div>
</div><br>

<div class="row">
	<div class="col-md-3">Prisoner Document Proof</div>
	<div class="col-md-9">
	<input type="file" name="prisinerdocument" id="prisinerdocument" class="form-control">
<?php
if(isset($_GET['editid']))
{
echo "<a href='docprisoner/$rs[prisinerdocument]' class='btn btn-info' style='width: 300px;'>Download</a>";
}
?>	
	</div>
</div><br>

<div class="row">
	<div class="col-md-3">Any Note</div>
	<div class="col-md-9">
	<textarea name="anynote" id="anynote" class="form-control"><?php echo $rsedit['anynote']; ?></textarea>
	</div>
</div><br>


<div class="row">
	<div class="col-md-12">
	<center><input type="submit" name="submit" id="submit" class="form-control btn btn-danger" style="width: 250px;" </center>
	</div>
</div><br>
<?php
	}
?>
	</p>
</div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        </form>
		<!-- End About Section -->


        <!-- Start Text & image Section -->
        <section class="pad50" style="background-color: rgba(250, 250, 250, 1);">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="text-section">
						
<h3 class="underline"><span>View Prisoner Details</span></h3>

<p class="mb30">


<table id="datatable"  class="table table-striped table-bordered">
	<thead>
		<tr>			
			<th><h5>Prisoner Image</h5></th>
			<th><h5>Prisoner Name</h5></th>			
			<th><h5>Section</h5></th>			
			<th><h5>Crime Details</h5></th>			
			<th><h5>Prisoner Addredd</h5></th>		
			<th><h5>Prisoner Document</h5></th>			
			<th><h5>AnyNote</h5></th>	
			<th><h5>Status</h5></th>
<?php
	if(isset($_SESSION['cop_id']))
	{
?>		
			<th><h5>Action</h5></th>
<?php
	}
?>
		</tr>
	</thead>
	<tbody>
		<?php
		$sql = "SELECT * FROM prisoner WHERE crimereport_id='$_GET[crimereport_id]'";
		$qsql = mysqli_query($con,$sql);
		while($rs = mysqli_fetch_array($qsql))
		{
			echo "<tr>					
						<td><center><img src='imgprisoner/$rs[prisonerimg]' style='width: 70px;height: 75px;'></center></td>
						<td>$rs[prisonername]</td>			
						<td>$rs[section]</td>			
						<td>$rs[crimedetails]</td>			
						<td>$rs[prisoneraddress]</td>	
						<td>
						<a href='docprisoner/$rs[prisinerdocument]' class='btn btn-info' style='width: 100%' download>Download</a>
						</td>			
						<td>$rs[anynote]</td>
						<td>$rs[status]</td>";
	if(isset($_SESSION['cop_id']))
	{					
					echo "<td>
			
			<a href='prisoner.php?editid=$rs[0]&crimereport_id=$_GET[crimereport_id]' class='btn btn-warning' style='width: 100%'>Edit</a>
						
			<a href='prisoner.php?delid=$rs[0]&crimereport_id=$_GET[crimereport_id]' onclick='return confirmdel()' class='btn btn-danger' style='width: 100%'>Delete</a>
						
			</td>";
	}				
			echo "</tr>";
			
		
				
		}
	?>
	</tbody>
</table>



</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- End Text & image Section -->

<?php
include("footer.php");
?>     
<script>
function confirmdel()
{
	if(confirm("Are you sure want to delete this record?") == true)
	{
		return true;
	}
	else
	{
		return false;
	}
}
</script>