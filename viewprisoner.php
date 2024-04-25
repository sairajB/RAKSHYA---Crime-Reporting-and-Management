<?php
include("header.php");
if(!isset($_SESSION['cop_id']))
{
	echo "<script>window.location='index.php';</script>";
}
if(isset($_GET['delid']))
{
	$sql = "DELETE FROM prisoner WHERE prisoner_id='$_GET[delid]'";
	$qsql = mysqli_query($con,$sql);
		echo mysqli_error($con);
	if(mysqli_affected_rows($con) == 1)
	{
		echo "<script>alert('prisoner record deleted successfully...');</script>";
		echo "<script>window.location='viewprisoner.php';</script>";
	}
}
?>

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
			<th><h5>Complaint ID</h5></th>			
			<th><h5>FIR ID</h5></th>			
			<th><h5>Chargesheet ID</h5></th>			
			<th><h5>Prisoner Name</h5></th>			
			<th><h5>Section</h5></th>			
			<th><h5>Crime Details</h5></th>			
			<th><h5>Prisoner Addredd</h5></th>			
			<th><h5>Prisoner Image</h5></th>
			<th><h5>Prisoner Document</h5></th>			
			<th><h5>AnyNote</h5></th>	
			<th><h5>Status</h5></th>
			<th><h5>Action</h5></th>
		</tr>
	</thead>
	<tbody>
		<?php
		$sql = "SELECT * FROM prisoner";
		$qsql = mysqli_query($con,$sql);
		while($rs = mysqli_fetch_array($qsql))
		{
			echo "<tr>
						<td>$rs[complaint_id]</td>			
						<td>$rs[fir_id]</td>			
						<td>$rs[chargesheet_id]</td>			
						<td>$rs[prisonername]</td>			
						<td>$rs[section]</td>			
						<td>$rs[crimedetails]</td>			
						<td>$rs[prisoneraddress]</td>			
						<td>$rs[prisonerimg]</td>
						<td>$rs[prisinerdocument]</td>			
						<td>$rs[anynote]</td>
						<td>$rs[status]</td>
						<td>
			
			<a href='prisoner.php?editid=$rs[0]' class='btn btn-warning'>Edit</a>
						
			<a href='viewprisoner.php?delid=$rs[0]'onclick='return confirmdel()' class='btn btn-danger'>Delete</a>
						
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