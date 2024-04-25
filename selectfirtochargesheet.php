<?php
include("header.php");
if(isset($_GET['delid']))
{
	$sql = "DELETE FROM fir WHERE fir_id='$_GET[delid]'";
	$qsql = mysqli_query($con,$sql);
		echo mysqli_error($con);
	if(mysqli_affected_rows($con) == 1)
	{
		echo "<script>alert('fir record deleted successfully...');</script>";
		echo "<script>window.location='viewfir.php';</script>";
	}
}
?>

        <!-- Start Text & image Section -->
        <section class="pad50" style="background-color: rgba(250, 250, 250, 1);">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="text-section">
						
<h3 class="underline"><span>View FIR</span></h3>

<p class="mb30">


<table id="datatable"  class="table table-striped table-bordered">
	<thead>
		<tr>
			<th style='width: 76px;'>Complaint No.</th>		
			<th style='width: 76px;'>FIR Registration No.</th>		
	    	<th>Section</th>			
			<th>Complaint type</th>					
			<th style='width: 250px;'>FIR detail</th>			
			<th>Date</th>	
			<th>Action</th>
		</tr>
	</thead>
	<tbody>
		<?php
		$sql = "SELECT * FROM fir WHERE status='Completed'";
		$qsql = mysqli_query($con,$sql);
		while($rs = mysqli_fetch_array($qsql))
		{
			echo "<tr>
				<td>$rs[complaint_id]</td>						
				<td>$rs[fir_id]</td>						
				<td>$rs[section]</td>			
				<td>$rs[complaint_type]</td>
				<td>"  . $rs['fir_detail'] . "</td>			
				<td><b>Registered on : </b><br>" . date("d-M-Y",strtotime($rs['fir_regdate']))  . "<br><b>From - </b>"  . date("d-M-Y",strtotime($rs['fir_start_date']))  . " <br> <b>To - </b>"  . date("d-M-Y",strtotime($rs['fir_end_date']))  . "</td>			
				<td STYLE='WIDTH: 150px;'><a href='chargesheet.php?fir_id=$rs[0]' class='btn btn-primary' STYLE='WIDTH: 150px;'>FILE <br> Charge Sheet</a></td>
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