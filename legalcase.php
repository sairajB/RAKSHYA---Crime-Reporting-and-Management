<?php
include("header.php");
if(!isset($_SESSION['cop_id']))
{
	echo "<script>window.location='index.php';</script>";
}
if(isset($_POST['submit']))
{
	$casedocument = rand(). $_FILES['casedocument']['name'];
	move_uploaded_file($_FILES['casedocument']['tmp_name'],"doclegal/".$casedocument);
	//Update Statement starts here
	if(isset($_GET['editid']))
	{
		$sql ="UPDATE legalcase SET complaint_id='$_POST[complaint_id]',fir_id='$_POST[fir_id]',chargesheet_id='$_POST[chargesheet_id]',casetitle='$_POST[casetitle]',casedetails='$_POST[casedetails]',dateofhearing='$_POST[imdateofhearingg]',casereport='$_POST[casereport]'";
		if($_FILES['casedocument']['name'] != "")
		{
		$sql = $sql . ",casedocument='$casedocument'";
		}
		$sql = $sql . ",casestatus='$_POST[casestatus]' WHERE station_id='$_GET[editid]'";
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
		$sql ="INSERT INTO legalcase (complaint_id,fir_id,chargesheet_id,casetitle,casedetails,dateofhearing,casereport,casedocument,casestatus,case_file_no,crimereport_id,prisoner_id)values('$_POST[complaint_id]','$_GET[fir_id]','$_GET[chargesheet_id]','$_POST[casetitle]','$_POST[casedetails]','$_POST[dateofhearing]','$_POST[casereport]','$casedocument','$_POST[casestatus]','$_POST[case_file_no]','$_GET[crimereport_id]','$_GET[prisoner_id]')";
		$qsql = mysqli_query($con,$sql);
			echo mysqli_error($con);
		if(mysqli_affected_rows($con) == 1)
		{
			echo "<script>alert('Legalcase  record inserted successfully');</script>";
			echo "<script>window.location='viewlegalcase.php';</script>";
		}
	}
}
?>
<?php
if(isset($_GET['editid']))
{
	$sqledit = "SELECT * FROM legalcase WHERE legalcase_id='$_GET[editid]'";
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
                            <h1>LEGAL CASE</h1>
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
	<center style="padding: 15px;"><h2><a href="#">LEGAL CASE</a></h2></center>
	<hr>
<div class="intro-text">
	<p>
<?php
if(isset($_GET['complaint_id']))	
{
?>
<table id="datatablefixcolumn"  class="table table-striped table-bordered">
	<thead>
		<tr>		
			<th>Complaint No.</th>		
			<th>Complaint date</th>		
			<th>Complainer</th>		
			<th>Station</th>		
			<th>Complaint Type</th>			
			<th>Complaint</th>			
			<th>Accused</th>			
			<th>Victim</th>
		</tr>
	</thead>
	<tbody>
		<?php
		$sql = "SELECT complaint.*,station.station,station.contact_no,station.station_addresss, state.state,city.city, complainer.name,complainer.email_id, complainer.phoneno FROM complaint LEFT JOIN station on complaint.station_id=station.station_id LEFT JOIN state ON state.state_id=station.state_id LEFT JOIN city ON city.city_id=station.city_id LEFT JOIN complainer ON complainer.complainer_id=complaint.complainer_id WHERE complaint.complaint_id='$_GET[complaint_id]' ";
		$qsql = mysqli_query($con,$sql);
		$rs = mysqli_fetch_array($qsql);
		echo "<tr>			
				<td>$rs[0]</td>	
				<td>" . date("d-M-Y h:i A",strtotime($rs['complaint_date'])) ."</td>	
				<td>$rs[name]<br>$rs[email_id]<br>$rs[phoneno]</td>	
				<td>$rs[station],<br>$rs[city], $rs[state]</td>	
				<td>$rs[complaint_type]</td>			
				<td>$rs[complaint]</td>			
				<td>$rs[accusedby],<br>$rs[accused_address],<br>Ph. No. $rs[accused_phoneno]</td>			
				<td>$rs[victim_address],<br>Ph. No. $rs[victim_phoneno]</td>
			</tr>";
	?>
	</tbody>
</table>	
<input type="hidden" name="complaint_id" id="complaint_id" value="<?php echo $_GET['complaint_id']; ?>" >	
<?php
}
?>
<?php
if(isset($_GET['chargesheet_id']))
{
?>
<table id="datatable"  class="table table-striped table-bordered">
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
		$sql = "SELECT * FROM chargesheet WHERE  chargesheet_id='$_GET[chargesheet_id]'";
		$qsql = mysqli_query($con,$sql);
		while($rs = mysqli_fetch_array($qsql))
		{
			$complaint_id = $rs['complaint_id'];
			echo "<tr>
						<td>$rs[0]</td>			
						<td>$rs[complaint_id]</td>			
						<td>$rs[fir_id]</td>			
						<td>$rs[section]</td>	
						<td>$rs[description]";

	echo "<a href='chargesheetreport.php?chargesheet_id=$rs[0]' class='btn btn-primary' target='_blank' >View Chargesheet Report</a>";			
			echo "</td>			
						<td>";
if(file_exists("docschargesheet/".$rs['chargesheetdocs']))
{	
	echo "<a href='docschargesheet/$rs[chargesheetdocs]' class='btn btn-info' >Download</a>";
}				
			echo "</td>	
				</tr>";
		}
	?>
	</tbody>
</table>
<hr><br>
<input type="hidden" name="complaint_id" id="complaint_id" value="<?php echo $complaint_id; ?>" >	
<?php
}
?>
<?php
if(isset($_GET['crimereport_id']))
{
?>
<table  class="table table-striped table-bordered">
	<thead>
		<tr>
			<th><h5>Complaint No.</h5></th>			
			<th><h5>Chargesheet No.</h5></th>			
			<th><h5>Report Date</h5></th>			
			<th><h5>Crime Report Title</h5></th>			
			<th><h5>Crime Report</h5></th>
			<th><h5>Prisoners</h5></th>
		</tr>
	</thead>
	<tbody>
		<?php
		$sql = "SELECT * FROM crime_report WHERE crimereport_id='$_GET[crimereport_id]'";
		$qsql = mysqli_query($con,$sql);
		while($rs = mysqli_fetch_array($qsql))
		{
			$sqlprisoner = "SELECT * FROM prisoner WHERE crimereport_id='$rs[0]'";
			$qsqlprisoner =  mysqli_query($con,$sqlprisoner);
			$countprisoner = mysqli_num_rows($qsqlprisoner);
			$complaint_id = $rs['complaint_id'];
			echo "<tr>
	<td>$rs[complaint_id]</td>			
	<td>$rs[chargesheet_id]</td>				
	<td> " . date("d-M-Y",strtotime($rs['reportdate'])) . "</td>			
	<td>$rs[crime_reporttitle]</td>			
	<td><a href='' onclick='return false;' class='btn btn-info' style='width: 100px;'  data-toggle='modal' data-target='#myModal$rs[0]' >View</a></td>			
	
	<td><a href='viewprisoners.php?crimereport_id=$rs[0]' target='_blank' class='btn btn-primary' >Prisoners ($countprisoner)</a></td>			
	
				</tr></table>";
?>
<input type="hidden" name="complaint_id" id="complaint_id" value="<?php echo $complaint_id; ?>" >
<hr><br>
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
<hr><br>
<?php
}
?>
<?php
if(isset($_GET['prisoner_id']))
{
?>
<table class="table table-striped table-bordered">
	<thead>
		<tr>			
			<th><h5>Prisoner Image</h5></th>
			<th><h5>Prisoner Name</h5></th>			
			<th><h5>Section</h5></th>			
			<th><h5>Crime Details</h5></th>			
			<th><h5>Prisoner Addredd</h5></th>		
			<th><h5>Prisoner Document</h5></th>			
			<th><h5>AnyNote</h5></th>	
		</tr>
	</thead>
	<tbody>
		<?php
		$sql = "SELECT * FROM prisoner WHERE  status='Active' AND prisoner_id='$_GET[prisoner_id]'";
		$qsql = mysqli_query($con,$sql);
		
		while($rs = mysqli_fetch_array($qsql))
		{
			 $complaint_id = $rs['complaint_id'];
			echo "<tr>					
						<td><center><img src='imgprisoner/$rs[prisonerimg]' style='width: 70px;height: 75px;'></center></td>
						<td>$rs[prisonername]</td>			
						<td>$rs[section]</td>			
						<td>$rs[crimedetails]</td>			
						<td>$rs[prisoneraddress]</td>	
						<td>
						<a href='docprisoner/$rs[prisinerdocument]' class='btn btn-info' style='width: 100%'>Download</a>
						</td>			
						<td>$rs[anynote]</td>
			</tr>";
		}
	?>
	</tbody>
</table>
<hr><br>
<input type="hidden" name="complaint_id" id="complaint_id" value="<?php echo $complaint_id; ?>" >
<?php
}
?>
<div class="row">
	<div class="col-md-2">Case File No.</div>
	<div class="col-md-10">
	<input type="text" name="case_file_no" id="case_file_no" class="form-control">
	</div>
</div><br>

<div class="row">
	<div class="col-md-2">Date of hearing</div>
	<div class="col-md-10">
		<input type="date" name="dateofhearing" id="dateofhearing" class="form-control" max="<?php echo date("Y-m-d"); ?>">
	</div>
</div><br>

	
<div class="row">
	<div class="col-md-2">Case Title</div>
	<div class="col-md-10">
	<input type="text" name="casetitle" id="casetitle" class="form-control">
	</div>
</div><br>


<div class="row">
	<div class="col-md-2">Case Details</div>
	<div class="col-md-10">
		<textarea name="casedetails" id="casedetails" class="form-control" rows="10"><?php echo $rsedit['casedetails']; ?></textarea>
	</div>
</div><br>

<div class="row">
	<div class="col-md-2">Case Report</div>
	<div class="col-md-10">
		<textarea name="casereport" id="casereport" class="form-control" rows="10"><?php echo $rsedit['casereport']; ?></textarea>
	</div>
</div><br>


<div class="row">
	<div class="col-md-2">Case Document</div>
	<div class="col-md-10">
	<input type="file" name="casedocument" id="casedocument" class="form-control">
	</div>
</div><br>

<div class="row">
	<div class="col-md-2">Case status</div>
	<div class="col-md-10">
	<select name="casestatus" id="casestatus" class="form-control">
		<option value="">Select Status</option>
		<?php
		$arr = array("Under Proces","Adjourned","Closed");
		foreach($arr as $val)
		{
			if($val == $rsedit['casestatus'])
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

 <div class="row"><hr><br></div>
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
        <!-- End About Section -->
</form>

<script src="https://cdn.tiny.cloud/1/vkp7vwptosm1ao2ztjqdp0riscxgp2sxw81z6ma02p9h4oqc/tinymce/5/tinymce.min.js" ></script>
<script>tinymce.init({ selector:'textarea' });</script>
<?php
include("footer.php");
?>     