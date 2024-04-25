<?php
include("header.php");
if(!isset($_SESSION['cop_id']) && !isset($_SESSION['complainer_id']))
{
	echo "<script>window.location='index.php';</script>";
}
if(isset($_GET['delid']))
{
	$sql = "DELETE FROM legalcase WHERE legalcase_id='$_GET[delid]'";
	$qsql = mysqli_query($con,$sql);
		echo mysqli_error($con);
	if(mysqli_affected_rows($con) == 1)
	{
		echo "<script>alert('legalcase record deleted successfully...');</script>";
		echo "<script>window.location='viewlegalcase.php';</script>";
	}
}
?>

        <!-- Start Text & image Section -->
        <section class="pad50" style="background-color: rgba(250, 250, 250, 1);">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="text-section">
						
<h3 class="underline"><span>View Legal Case</span></h3>

<p class="mb30">


<table id="datatable"  class="table table-striped table-bordered">
	<thead>
		<tr>
			<th><h5>Case for</h5></th>			
			<th><h5>Case <br>File No.</h5></th>			
			<th><h5>Date of Hearing</h5></th>				
			<th><h5>Case Details</h5></th>				
			<th><h5>Case Report</h5></th>			
			<th><h5>Case Status</h5></th>
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
		$sql = "SELECT * FROM legalcase LEFT JOIN complaint on complaint.complaint_id=legalcase.complaint_id WHERE legalcase.legalcase_id!='0' ";
		if(isset($_SESSION['complainer_id']))
		{
			$sql = $sql . " AND complaint.complainer_id='$_SESSION[complainer_id]' ";
		}
		$qsql = mysqli_query($con,$sql);
		while($rs = mysqli_fetch_array($qsql))
		{
			echo "<tr>
						<td>";
						if($rs['complaint_id']  != 0)
						{
						echo "Complaint No .  $rs[complaint_id] <br>";
						}
						if($rs['fir_id']  != 0)
						{
						echo "FIR No. $rs[fir_id] <br>";
						}
						if($rs['crimereport_id']  != 0)
						{
						echo "Crime Report No. $rs[crimereport_id] <br>";
						}
						if($rs['chargesheet_id']  != 0)
						{
						echo "Chargesheet No. $rs[chargesheet_id]";
						}
						if($rs['prisoner_id']  != 0)
						{
						echo "Prisoner No. $rs[prisoner_id]";
						}
			echo "</td><td>$rs[case_file_no]</td>";		
			echo "<td>" . date("d-M-Y",strtotime($rs['dateofhearing'])) . "</td>";
			echo "
						<td><b style='color: red;'>$rs[casetitle]</b><br>$rs[casedetails]</td>			
						<td>$rs[casereport]<br>";
						if(file_exists("doclegal/".$rs['casedocument']))
						{
			echo "<a href='doclegal/$rs[casedocument]' class='btn btn-primary'>Download</a>";
						}
			echo "</td>		
						<td>$rs[casestatus]</td>";
			if(isset($_SESSION['cop_id']))
			{
			echo "<td>
			
			<a href='legalcase.php?editid=$rs[0]' class='btn btn-warning'>Edit</a>
						
			<a href='viewlegalcase.php?delid=$rs[0]'onclick='return confirmdel()' class='btn btn-danger'>Delete</a>
						
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