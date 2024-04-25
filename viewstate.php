<?php
include("header.php");
if(!isset($_SESSION['cop_id']))
{
	echo "<script>window.location='index.php';</script>";
}
?>

        <!-- Start Text & image Section -->
        <section class="pad50" style="background-color: rgba(250, 250, 250, 1);">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="text-section">
						
<h3 class="underline"><span>View State</span></h3>

<p class="mb30">


<table id="datatable"  class="table table-striped table-bordered">
	<thead>
		<tr>
			<th><h5>state</h5></th>		
	    	<th><h5>description</h5></th>						
			<th><h5>Status</h5></th>
			<th><h5>Action</h5></th>
		</tr>
	</thead>
	<tbody>
		<?php
		$sql = "SELECT * FROM state";
		$qsql = mysqli_query($con,$sql);
		while($rs = mysqli_fetch_array($qsql))
		{
			echo "<tr>
						<td>$rs[state]</td>						
						<td>$rs[description]</td>					
						<td>$rs[status]</td>
						<td>
			
			<a href='state.php?editid=$rs[0]' class='btn btn-warning'>Edit</a> 
						
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