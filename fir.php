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
		$sql ="UPDATE fir SET complaint_id='$_POST[complaint_id]',section='$_POST[section]',complaint_type='$_POST[complaint_type]',fir_regdate='$_POST[fir_regdate]',fir_detail='$_POST[fir_detail]',fir_start_date='$_POST[fir_start_date]',fir_end_date='$_POST[fir_end_date]',status='$_POST[status]' WHERE fir_id='$_GET[editid]'";
		$qsql = mysqli_query($con,$sql);
			echo mysqli_error($con);
		if(mysqli_affected_rows($con) == 1)
		{
			echo "<script>alert('FIR Report updated successfully');</script>";
		}		
	}
	//Update Statement ends here
	//Insert statemetn starts here
	else
	{
		$sql ="INSERT INTO fir (complaint_id,section,complaint_type,fir_regdate,fir_detail,fir_start_date,fir_end_date,status)values('$_POST[complaint_id]','$_POST[section]','$_POST[complaint_type]','$_POST[fir_regdate]','$_POST[fir_detail]','$_POST[fir_start_date]','$_POST[fir_end_date]','$_POST[status]')";
		$qsql = mysqli_query($con,$sql);
			echo mysqli_error($con);
		if(mysqli_affected_rows($con) == 1)
		{
			echo "<script>alert('fir record inserted successfully');</script>";
			echo "<script>window.location='fir.php';</script>";
		}
	}
}
?>
<?php
if(isset($_GET['editid']))
{
	$sqledit = "SELECT * FROM fir WHERE fir_id='$_GET[editid]'";
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
                            <h1>FIR Registration FORM</h1>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- End Breadcrumb Section -->

<form method="post" action="">
<input type="hidden" name="complaint_id" id="complaint_id" value="<?php echo $_GET['complaint_id']; ?>">
        <!-- Start About Section -->
        <section class="pad-t100 pad-b70">
            <div class="container">
                <div class="row">
					<div class="col-md-12">
                        <div class="feature-4">
						

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

<div class="intro-text">
	<p>

<div class="row">
	<div class="col-md-2">Section</div>
	<div class="col-md-10">
		<input type="text" name="section" id="section" class="form-control" value="<?php echo $rsedit['section']; ?>" >
	</div>
</div><br>

<div class="row">
	<div class="col-md-2">Complaint Type</div>
	<div class="col-md-10">
		<input type="text" name="complaint_type" id="complaint_type" class="form-control"  value="<?php echo $rsedit['complaint_type']; ?>">
	</div>
</div><br>

<div class="row">
	<div class="col-md-2">Registration date</div>
	<div class="col-md-10">
		<input type="date" name="fir_regdate" id="fir_regdate" class="form-control" min="<?php echo date("Y-m-d"); ?>"  value="<?php echo $rsedit['fir_regdate']; ?>">
	</div>
</div><br>

<div class="row">
	<div class="col-md-2">FIR detail</div>
	<div class="col-md-10">
		<textarea name="fir_detail" id="fir_detail" class="form-control"><?php echo $rsedit['fir_detail']; ?></textarea>
	</div>
</div><br>
<script src="https://cdn.tiny.cloud/1/vkp7vwptosm1ao2ztjqdp0riscxgp2sxw81z6ma02p9h4oqc/tinymce/5/tinymce.min.js" ></script>
<script>tinymce.init({ selector:'textarea' });</script>

<div class="row">
	<div class="col-md-2">FIR Starts from</div>
	<div class="col-md-10">
		<input type="date" name="fir_start_date" id="fir_start_date" class="form-control" max="<?php echo date("Y-m-d"); ?>"  value="<?php echo $rsedit['fir_start_date']; ?>" >
	</div>
</div><br>



<div class="row">
	<div class="col-md-2">FIR ends on</div>
	<div class="col-md-10">
		<input type="date" name="fir_end_date" id="fir_end_date" class="form-control" value="<?php echo $rsedit['fir_end_date']; ?>" >
	</div>
</div><br>


<div class="row">
	<div class="col-md-2">Status</div>
	<div class="col-md-10">
	<select name="status" id="status" class="form-control">
		<option value="">Select Status</option>
		<?php
		$arr = array("Under Process","Completed");
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