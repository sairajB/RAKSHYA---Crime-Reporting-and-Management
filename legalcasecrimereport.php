<?php
include("header.php");
if(!isset($_SESSION['cop_id']))
{
	echo "<script>window.location='index.php';</script>";
}
if(isset($_GET['delid']))
{
	$sql = "DELETE FROM crime_report WHERE crimereport_id='$_GET[delid]'";
	$qsql = mysqli_query($con,$sql);
	echo mysqli_error($con);
	if(mysqli_affected_rows($con) == 1)
	{
		echo "<script>alert('crime_report record deleted successfully...');</script>";
		echo "<script>window.location='viewcrime_report.php';</script>";
	}
}
?>

        <!-- Start Text & image Section -->
        <section class="pad50" style="background-color: rgba(250, 250, 250, 1);">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="text-section">
						
<h3 class="underline"><span>View Crime Report</span></h3>

<p class="mb30">


<table id="datatable"  class="table table-striped table-bordered">
	<thead>
		<tr>
			<th><h5>Complaint No.</h5></th>			
			<th><h5>Chargesheet No.</h5></th>			
			<th><h5>Report Date</h5></th>			
			<th><h5>Crime Report Title</h5></th>			
			<th><h5>Crime Report</h5></th>
			<th><h5>Prisoners</h5></th>
			<th><h5>Action</h5></th>
		</tr>
	</thead>
	<tbody>
		<?php
		$sql = "SELECT * FROM crime_report";
		$qsql = mysqli_query($con,$sql);
		while($rs = mysqli_fetch_array($qsql))
		{
			$sqlprisoner = "SELECT * FROM prisoner WHERE crimereport_id='$rs[0]'";
			$qsqlprisoner =  mysqli_query($con,$sqlprisoner);
			$countprisoner = mysqli_num_rows($qsqlprisoner);
			echo "<tr>
	<td>$rs[complaint_id]</td>			
	<td>$rs[chargesheet_id]</td>				
	<td> " . date("d-M-Y",strtotime($rs['reportdate'])) . "</td>			
	<td>$rs[crime_reporttitle]</td>			
	<td><a href='' onclick='return false;' class='btn btn-info' style='width: 100px;'  data-toggle='modal' data-target='#myModal$rs[0]' >View</a></td>			
	
	<td><a href='viewprisoners.php?crimereport_id=$rs[0]' target='_blank' class='btn btn-primary' >Prisoners ($countprisoner)</a></td>			
	
	<td style='width: 100px;'>
	
	<a href='legalcase.php?crimereport_id=$rs[crimereport_id]' target='_blank' class='btn btn-warning' style='width: 100px;'>Select</a>

	</td>
				</tr>";
?>
<div id="myModal<?php echo $rs[0]; ?>" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title"><?php echo $rs['crime_reporttitle']; ?></h4>
      </div>
      <div class="modal-body">
        <p><?php echo $rs['crime_report']; ?></p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<?php
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