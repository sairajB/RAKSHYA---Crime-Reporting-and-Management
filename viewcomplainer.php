<?php
include("header.php");
if(!isset($_SESSION['cop_id']))
{
	echo "<script>window.location='index.php';</script>";
}
if(isset($_GET['delid']))
{
	$sql = "DELETE FROM complainer WHERE complainer_id='$_GET[delid]'";
	$qsql = mysqli_query($con,$sql);
	echo mysqli_error($con);
	if(mysqli_affected_rows($con) == 1)
	{
		echo "<script>alert('Complainer Record deleted successfully...');</script>";
		echo "<script>window.location='viewcomplainer.php';</script>";
	}
}
?>

        <!-- Start Text & image Section -->
        <section class="pad50" style="background-color: rgba(250, 250, 250, 1);">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="text-section">
						
<h3 class="underline"><span>View Complainer</span></h3>

<p class="mb30">


<table id="datatable"  class="table table-striped table-bordered">
	<thead>
		<tr>		
	    	<th><h5>Name</h5></th>			
			<th><h5>Email ID </h5></th>			
			<th><h5>phone No.</h5></th>				
			<th><h5>Status</h5></th>
			<th style='width: 170px;'><h5>Complaint</h5></th>
			<th style='width: 140px;'><h5>Action</h5></th>
		</tr>
	</thead>
	<tbody>
		<?php
		$sql = "SELECT * FROM complainer";
		$qsql = mysqli_query($con,$sql);
		while($rs = mysqli_fetch_array($qsql))
		{
			echo "<tr>					
						<td>$rs[name]</td>			
						<td>$rs[email_id]</td>			
						<td>$rs[phoneno]</td>				
						<td>$rs[status]</td>
						<td>
			
			<a href='complaint.php?complainerid=$rs[0]' class='btn btn-info'>Add</a>
						
			<a href='viewcomplaint.php?complainerid=$rs[0]' class='btn btn-primary'>View</a>
						
			</td>
						<td>
			
			<a href='complainer.php?editid=$rs[0]' class='btn btn-warning'>Edit</a>
						
			<a href='viewcomplainer.php?delid=$rs[0]'onclick='return confirmdel()' class='btn btn-danger'>Delete</a>
						
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