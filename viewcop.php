<?php
include("header.php");
if(!isset($_SESSION['cop_id']))
{
	echo "<script>window.location='index.php';</script>";
}
if(isset($_GET['delid']))
{
	$sql = "DELETE FROM cop WHERE cop_id='$_GET[delid]'";
	$qsql = mysqli_query($con,$sql);
		echo mysqli_error($con);
	if(mysqli_affected_rows($con) == 1)
	{
		echo "<script>alert('Cop record deleted successfully...');</script>";
		echo "<script>window.location='viewcop.php';</script>";
	}
}
?>

        <!-- Start Text & image Section -->
        <section class="pad50" style="background-color: rgba(250, 250, 250, 1);">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="text-section">
						
<h3 class="underline"><span>View COP</span></h3>

<p class="mb30">


<table id="datatable"  class="table table-striped table-bordered">
<thead>
<tr>		
	<th><h5>Image</h5></th>		
	<th><h5>Cop Name</h5></th>			
	<th><h5>Station</h5></th>			
	<th><h5>Designation</h5></th>				
	<th><h5>Gender</h5></th>			
	<th><h5>Contact detail</h5></th>			
	<th><h5>Login ID</h5></th>				
	<th><h5>Status</h5></th>
	<th><h5>Action</h5></th>
</tr>
</thead>
<tbody>
<?php
$sql = "SELECT cop.*,designation.designation_type,station.station FROM cop LEFT JOIN station on cop.station_id=station.station_id LEFT JOIN designation ON designation.designation_id=cop.designation_id";
$qsql = mysqli_query($con,$sql);
while($rs = mysqli_fetch_array($qsql))
{
		if($rs['img'] == "")
		{
			$img = "assets/images/No-Image-Available.png";
		}
		else if(file_exists('imgcop/'.$rs['img']))
		{
			$img = 'imgcop/'.$rs['img'];
		}
		else
		{
			$img = "assets/images/No-Image-Available.png";
		}
	echo "<tr>			
				<td><img src='$img' style='width: 70px; height: 75px;' ></td>		
				<td>$rs[cop_name]</td>			
				<td>$rs[station]</td>			
				<td>$rs[designation_type]</td>			
				<td>$rs[gender]</td>			
				<td>
				<b>Ph. No.</b> $rs[contact_no]<br>
				<b>Email:</b> $rs[email_id]
				</td>
				<td>$rs[login_id]</td>					
				<td>$rs[status]</td>
	
	<td>
	
	<a href='cop.php?editid=$rs[0]' class='btn btn-warning' style='width: 75px;'>Edit</a>
				
	<a href='viewcop.php?delid=$rs[0]'onclick='return confirmdel()' class='btn btn-danger' style='width: 75px;'>Delete</a>
				
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