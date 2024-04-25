<?php
include("header.php");
?>

        <!-- Start Text & image Section -->
        <section class="pad50" style="background-color: rgba(250, 250, 250, 1);">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="text-section">
						
<h3 class="underline"><span>View Station</span></h3>

<p class="mb30">


<table id="datatable"  class="table table-striped table-bordered">
	<thead>
		<tr>
			<th><h5>stationt</h5></th>			
			<th><h5>state_id</h5></th>			
			<th><h5>city_id</h5></th>			
			<th><h5>station_addresss</h5></th>			
			<th><h5>contact_no</h5></th>			
			<th><h5>img</h5></th>			
			<th><h5>Description</h5></th>			
			<th><h5>Chargesheet Documents</h5></th>			
			<th><h5>Status</h5></th>
			<th><h5>Action</h5></th>
		</tr>
	</thead>
	<tbody>
		<?php
		$sql = "SELECT * FROM station";
		$qsql = mysqli_query($con,$sql);
		while($rs = mysqli_fetch_array($qsql))
		{
			echo "<tr>
						<td>$rs[station]</td>			
						<td>$rs[state_id]</td>			
						<td>$rs[city_id]</td>			
						<td>$rs[station_addresss]</td>			
						<td>$rs[contact_no]</td>			
						<td>$rs[img]</td>			
						<td>$rs[description]</td>			
						<td>$rs[chargesheetdocs]</td>			
						<td>$rs[status]</td>
						
						<td>
			
			<a href='station.php?editid=$rs[0]' class='btn btn-warning'>Edit</a>
						
			<a href='viewstation.php?delid=$rs[0]'onclick='return confirmdel()' class='btn btn-danger'>Delete</a>
						
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