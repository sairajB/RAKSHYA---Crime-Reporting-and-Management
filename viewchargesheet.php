<?php
include("header.php");
if(!isset($_SESSION['cop_id']) && !isset($_SESSION['complainer_id']))
{
	echo "<script>window.location='index.php';</script>";
}
if(isset($_GET['delid']))
{
	$sql = "DELETE FROM chargesheet WHERE chargesheet_id='$_GET[delid]'";
	$qsql = mysqli_query($con,$sql);
		echo mysqli_error($con);
	if(mysqli_affected_rows($con) == 1)
	{
		echo "<script>alert('chargesheet record deleted successfully...');</script>";
		echo "<script>window.location='viewchargesheet.php';</script>";
	}
}
?>
        <!-- Start Text & image Section -->
        <section class="pad50" style="background-color: rgba(250, 250, 250, 1);">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="text-section">
						
<center><h3 class=""><span>View chargesheet</span></h3></center>

<p class="mb30">

<table  class="table table-striped table-bordered">
	<thead>
		<tr>
			<th colspan="6">FIR detail</th>		
		</tr>
		<tr>
			<th style='width: 76px;'>Complaint No.</th>		
			<th style='width: 76px;'>FIR No.</th>
			<th>Complaint type</th>					
			<th style='width: 250px;'>FIR detail</th>			
			<th>Date</th>		
			<th><center>Details</center></th>
		</tr>
	</thead>
	<tbody>
		<?php
		$sql = "SELECT * FROM fir WHERE status='Completed' AND fir_id='$_GET[fir_id]'";
		$qsql = mysqli_query($con,$sql);
		while($rs = mysqli_fetch_array($qsql))
		{
			$sqlchargesheet = "SELECT * FROM chargesheet where fir_id='$rs[0]'";
			$qsqlchargesheet = mysqli_query($con,$sqlchargesheet);
			$nochargesheet = mysqli_num_rows($qsqlchargesheet);
			if($nochargesheet >=1)
			{
			echo "<tr>
				<td>$rs[complaint_id]</td>						
				<td>$rs[fir_id]</td>	
				<td>$rs[complaint_type]</td>
				<td>"  . $rs['fir_detail'] . "<br>".
"Section - "  . $rs['section'] 
				. "</td>			
				<td><b>Registered on : </b>" . date("d-M-Y",strtotime($rs['fir_regdate']))  . "<br><b>From - </b>"  . date("d-M-Y",strtotime($rs['fir_start_date']))  . " <br> <b>To - </b>"  . date("d-M-Y",strtotime($rs['fir_end_date']))  . "</td>			
				<td STYLE='WIDTH: 150px;'>
				
				<center><b>No. of Chargesheets Filed :</b> $nochargesheet  </center></td>
			</tr>";
			}
		}
	?>
	</tbody>
</table>

<br>
<hr>
<br>

<table id="datatable"  class="table table-striped table-bordered">
	<thead>
		<tr>
			<th>Chargesheet No.</th>			
			<th>Complaint No.</th>			
			<th>FIR Registration No.</th>		
			<th>Section</th>		
			<th>Chargesheet description</th>
			<th>Chargesheet<br> Documents</th>
			<?php
			if(isset($_SESSION['cop_id']))
			{
			?>
			<th>Action</th>
			<?php
			}
			?>
		</tr>
	</thead>
	<tbody>
		<?php
		$sql = "SELECT * FROM chargesheet  WHERE  fir_id='$_GET[fir_id]'";
		$qsql = mysqli_query($con,$sql);
		while($rs = mysqli_fetch_array($qsql))
		{
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
			echo "</td>		";

			if(isset($_SESSION['cop_id']))
			{		
echo "<td>
<a href='chargesheet.php?editid=$rs[0]&fir_id=$rs[fir_id]' class='btn btn-warning' style='width: 100px;'>Edit</a>
<a href='viewchargesheet.php?delid=$rs[0]' onclick='return confirmdel()' class='btn btn-danger' style='width: 100px;'>Delete</a>";	
echo "</td>";
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