<?php
include("header.php");
if(!isset($_SESSION['cop_id']))
{
	echo "<script>window.location='index.php';</script>";
}
$sqlfir = "SELECT * FROM fir WHERE fir_id='$_GET[fir_id]'";
$qsqlfir = mysqli_query($con,$sqlfir);
$rsfir = mysqli_fetch_array($qsqlfir);
if(isset($_POST['submit']))
{
	$chargesheetdocs = rand() . $_FILES['chargesheetdocs']['name'];
	move_uploaded_file($_FILES['chargesheetdocs']['tmp_name'],"docschargesheet/".$chargesheetdocs);
	//Update Statement starts here
	if(isset($_GET['editid']))
	{
		$sql ="UPDATE chargesheet SET complaint_id='$rsfir[complaint_id]',fir_id='$rsfir[fir_id]',section='$_POST[section]',chargesheetreport='$_POST[chargesheetreport]',offense='$_POST[offense]',accused='$_POST[accused]',description='$_POST[description]'";
		if($_FILES['chargesheetdocs']['name'] != "")
		{
		$sql = $sql . ",chargesheetdocs='$chargesheetdocs'";
		}
		$sql = $sql . ",status='$_POST[status]' WHERE chargesheet_id ='$_GET[editid]'";
		$qsql = mysqli_query($con,$sql);
			echo mysqli_error($con);
		if(mysqli_affected_rows($con) == 1)
		{
			echo "<script>alert('Charge sheet record updated successfully');</script>";
		}
		//Update Statement ends here
	}
	else
	{
		$sql ="INSERT INTO chargesheet (complaint_id,fir_id,section,chargesheetreport,offense,accused,description,chargesheetdocs,status)values('$rsfir[complaint_id]','$rsfir[fir_id]','$_POST[section]','$_POST[chargesheetreport]','$_POST[offense]','$_POST[accused]','$_POST[description]','$chargesheetdocs','$_POST[status]')";
		$qsql = mysqli_query($con,$sql);
			echo mysqli_error($con);
		if(mysqli_affected_rows($con) == 1)
		{ $insid= mysqli_insert_id($con);
			echo "<script>alert('Charge sheet record inserted successfully...');</script>";
			echo "<script>window.location='chargesheetreport.php?chargesheet_id=$insid';</script>";
		}
	}
}
?> 
<?php
if(isset($_GET['editid']))
{
	$sqledit = "SELECT * FROM chargesheet WHERE chargesheet_id='$_GET[editid]'";
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
                            <h1>Chargesheet </h1>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- End Breadcrumb Section -->
<form method="post" action="" enctype="multipart/form-data">
<?php
 	$sql = "SELECT * FROM fir WHERE status='Completed' AND fir_id='$_GET[fir_id]'";
	$qsql = mysqli_query($con,$sql);
?>
<input type="hidden" name="complaint_id" id="complaint_id" class="form-control" value="<?php echo $rsfir['complaint_id']; ?>">
<input type="hidden" name="fir_id" id="fir_id" class="form-control" value="<?php echo $rsfir['fir_id']; ?>">
<!-- Start About Section -->
        <section class="pad-t100 pad-b70">
            <div class="container">
                <div class="row">
					<div class="col-md-12">
                        <div class="feature-4">
	<center style="padding: 15px;"><h2><a href="#">Chargesheet</a></h2></center>
	<hr>
<div class="intro-text">

<table  class="table table-striped table-bordered">
	<thead>
		<tr>
			<th style='width: 76px;'>Complaint No.</th>		
			<th>FIR Registration <br>No.</th>		
	    	<th>Section</th>			
			<th>Complaint type</th>					
			<th style='width: 250px;'>FIR detail</th>			
			<th>Date</th>	
		</tr>
	</thead>
	<tbody>
		<?php
		$sql = "SELECT * FROM fir WHERE status='Completed' AND fir_id='$_GET[fir_id]'";
		$qsql = mysqli_query($con,$sql);
		while($rs = mysqli_fetch_array($qsql))
		{
			echo "<tr>
			<td>$rs[complaint_id]</td>						
			<td>$rs[fir_id]</td>						
			<td>$rs[section]</td>			
			<td>$rs[complaint_type]</td>
			<td>"  . $rs['fir_detail'] . "</td>			
			<td><b>Registered on : </b><br>" . date("d-M-Y",strtotime($rs['fir_regdate']))  . "<br><b>From - </b>"  . date("d-M-Y",strtotime($rs['fir_start_date']))  . " <br> <b>To - </b>"  . date("d-M-Y",strtotime($rs['fir_end_date']))  . "</td></tr>";
		}
		$rsfir = mysqli_fetch_array($qsql);
		
	?>
	</tbody>
</table>
<hr>
	<p>
	
<div class="row">
	<div class="col-md-3"> Section</div>
	<div class="col-md-9">
	<input type="text" name="section" id="section" class="form-control" value="<?php echo $rsedit['section']; ?>" style="text-transform: uppercase;"></div>
</div><br>


<div class="row">
	<div class="col-md-3">Brief description</div>
	<div class="col-md-9">
		<textarea name="description" id="description" class="form-control"><?php echo $rsedit['description']; ?></textarea>
	</div>
</div><br>

<div class="row">
	<div class="col-md-3"> Charge Sheet Report</div>
	<div class="col-md-9">
	<textarea  name="chargesheetreport" id="chargesheetreport" class="form-control" ><?php echo $rsedit['chargesheetreport']; ?></textarea>
	</div>
</div><br>

<div class="row">
	<div class="col-md-3">Offense</div>
	<div class="col-md-9">
		<textarea  name="offense" id="offense" class="form-control" ><?php echo $rsedit['offense']; ?></textarea>
	</div>
</div><br>


<div class="row">
	<div class="col-md-3">Accused	</div>
	<div class="col-md-9">
		<textarea  name="accused" id="accused" class="form-control" ><?php echo $rsedit['accused']; ?></textarea>
	</div>
</div><br>


<div class="row">
	<div class="col-md-3">Chargesheet Document	</div>
	<div class="col-md-9">
	<input type="file" name="chargesheetdocs" id="chargesheetdocs" class="form-control">
	<?php
	if(isset($_GET['editid']))
	{
		if(file_exists("docschargesheet/".$rsedit['chargesheetdocs']))
		{
			echo "<a href='docschargesheet/$rsedit[chargesheetdocs]' class='btn btn-warning'>Download</a>";
		}
	}
	?>
	</div>
</div><br>


<div class="row">
	<div class="col-md-3">Status</div>
	<div class="col-md-9">
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
	<div class="col-md-3"></div>
	<div class="col-md-9">
	<input type="submit" name="submit" id="submit" value="Submit Charge Sheet Report" class="form-control btn btn-danger" style="width: 250px;" >
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
    


<script src="https://cdn.tiny.cloud/1/vkp7vwptosm1ao2ztjqdp0riscxgp2sxw81z6ma02p9h4oqc/tinymce/5/tinymce.min.js" ></script>
<script>tinymce.init({ selector:'textarea' });</script>
<?php
include("footer.php");
?>     