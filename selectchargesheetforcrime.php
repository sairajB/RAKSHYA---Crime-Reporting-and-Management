<?php
include("header.php");
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
						
<h3 class="underline"><span>View chargesheet</span></h3>

<p class="mb30">


<table id="datatable"  class="table table-striped table-bordered">
	<thead>
		<tr>
			<th>Chargesheet No.</th>			
			<th>Complaint No.</th>			
			<th>FIR Registration No.</th>		
			<th>Section</th>		
			<th>Chargesheet description</th>
			<th>Chargesheet<br> Documents</th>	
			<th>Action</th>
		</tr>
	</thead>
	<tbody>
		<?php
		$sql = "SELECT * FROM chargesheet";
		$qsql = mysqli_query($con,$sql);
		while($rs = mysqli_fetch_array($qsql))
		{
//##########
$sqledit = "SELECT * FROM crime_report WHERE chargesheet_id='$rs[chargesheet_id]'";
$qsqledit = mysqli_query($con,$sqledit);
$rsedit = mysqli_fetch_array($qsqledit);
//##########
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
			echo "</td><td>";
			if(mysqli_num_rows($qsqledit) >= 1)	
			{
				echo "<a href='crime_report.php?editid=$rsedit[0]' class='btn btn-primary' style='width: 175px;'>Edit Crime Report</a>";
			}
			else
			{
				echo "<a href='crime_report.php?chargesheet_id=$rs[0]&fir_id=$rs[fir_id]' class='btn btn-warning' style='width: 175px;'>Add Crime Report</a>";
			}
			echo "</td></tr>";
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