<?php
include("header.php");
if(!isset($_SESSION['cop_id']))
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
		$sql = "SELECT * FROM chargesheet ";
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
			echo "</td>		
				<td>
			<a href='legalcase.php?chargesheet_id=$rs[chargesheet_id]' target='_blank' class='btn btn-warning' style='width: 100px;'>ENTER</a>
						
			</td>
				</tr>";
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