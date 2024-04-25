<?php
include("header.php");
if(!isset($_SESSION['cop_id']) && !isset($_SESSION['complainer_id']))
{
	echo "<script>window.location='index.php';</script>";
}
if(isset($_GET['chargesheet_id']))
{
	$sqlchargesheet = "SELECT * FROM chargesheet WHERE chargesheet_id='$_GET[chargesheet_id]'";
	$qsqlchargesheet = mysqli_query($con,$sqlchargesheet);
	$rschargesheet = mysqli_fetch_array($qsqlchargesheet);
}
?>

        <!-- Start Text & image Section -->
        <section class="pad50" style="background-color: rgba(250, 250, 250, 1);">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="text-section" id="divprintarea">
	
<p class="mb30" >					
<center><h3 class=""><span>CHARGE SHEET REPORT</span></h3></center>
<hr>


<table id="datatablefixcolumn"  class="table table-striped table-bordered">
	<thead>
		<tr>
			<th colspan="8">Complaint detail</th>		
		</tr>
		<tr>		
			<th>Complaint No.</th>		
			<th>Complaint date</th>		
			<th>Complainer</th>		
			<th>Station</th>		
			<th>Complaint Type</th>			
			<th>Complaint</th>			
			<th>Accused</th>			
			<th>Victim</th>				
		</tr>
	</thead>
	<tbody>
		<?php
		$sql = "SELECT complaint.*,station.station,station.contact_no,station.station_addresss, state.state,city.city, complainer.name,complainer.email_id, complainer.phoneno FROM complaint LEFT JOIN station on complaint.station_id=station.station_id LEFT JOIN state ON state.state_id=station.state_id LEFT JOIN city ON city.city_id=station.city_id LEFT JOIN complainer ON complainer.complainer_id=complaint.complainer_id WHERE complaint.status != '' AND complaint.complaint_id='$rschargesheet[complaint_id]'";
		$qsql = mysqli_query($con,$sql);
		while($rs = mysqli_fetch_array($qsql))
		{
			echo "<tr>		
					<td>$rs[0]</td>	
					<td>" . date("d-M-Y h:i A",strtotime($rs['complaint_date'])) ."</td>	
					<td>$rs[name]<br>$rs[email_id]<br>$rs[phoneno]</td>	
					<td>$rs[station],<br>$rs[city], $rs[state]</td>	
					<td>$rs[complaint_type]</td>			
					<td>$rs[complaint]</td>			
					<td>$rs[accusedby],<br>$rs[accused_address],<br>Ph. No. $rs[accused_phoneno]</td>			
					<td>$rs[victim_address],<br>Ph. No. $rs[victim_phoneno]</td>		
					</tr>";
		}
	?>
	</tbody>
</table>
<hr>
<br>
<table  class="table table-striped table-bordered">
	<thead>
		<tr>
			<th colspan="6">FIR detail</th>		
		</tr>
		<tr>		
			<th style='width: 76px;'>FIR No.</th>
			<th>Complaint type</th>					
			<th style='width: 300px;'>FIR detail</th>			
			<th>Date</th>		
			<th style='width: 170px;'>Details</th>
		</tr>
	</thead>
	<tbody>
		<?php
		$sql = "SELECT * FROM fir WHERE status='Completed' AND fir_id='$rschargesheet[fir_id]'";
		$qsql = mysqli_query($con,$sql);
		while($rs = mysqli_fetch_array($qsql))
		{
			$sqlchargesheet = "SELECT * FROM chargesheet where fir_id='$rs[0]'";
			$qsqlchargesheet = mysqli_query($con,$sqlchargesheet);
			$nochargesheet = mysqli_num_rows($qsqlchargesheet);
			if($nochargesheet >=1)
			{
			echo "<tr>				
				<td>$rs[fir_id]</td>	
				<td>$rs[complaint_type]</td>
				<td>"  . $rs['fir_detail'] . "<br>".
"Section - "  . $rs['section'] 
				. "</td>			
				<td><b>Registered on : </b>" . date("d-M-Y",strtotime($rs['fir_regdate']))  . "<br><b>From - </b>"  . date("d-M-Y",strtotime($rs['fir_start_date']))  . " <br> <b>To - </b>"  . date("d-M-Y",strtotime($rs['fir_end_date']))  . "</td>			
				<td STYLE='WIDTH: 170px;text-align: left;'><b>No. of Chargesheets <br>Filed :</b> $nochargesheet</td>
			</tr>";
			}
		}
	?>
	</tbody>
</table>
	
<hr>
<br>
<?php
		$sql = "SELECT * FROM chargesheet WHERE chargesheet_id='$_GET[chargesheet_id]'";
		$qsql = mysqli_query($con,$sql);
		while($rs = mysqli_fetch_array($qsql))
		{
?>
<table class="table table-striped table-bordered">
	<thead>
		<tr>
			<th>Chargesheet No.</th><td><?php echo $rs[0]; ?></td>
		</tr>
		<tr>		
			<th>Section</th><td><?php echo $rs['section']; ?></td>
		</tr>
		<tr>	
			<th>Chargesheet description</th><td><?php echo $rs['description']; ?></td>
		</tr>
		<tr>
			<th>Chargesheet<br> Report</th><td><?php echo $rs['chargesheetreport']; ?></td>
		</tr>
		<tr>	
			<th>Offense</th><td><?php echo $rs['offense']; ?></td>
		</tr>
		<tr>	
			<th>Accused</th><td><?php echo $rs['accused']; ?></td>
		</tr>
		<tr>	
			<th>Document</th><td>
		<?php
		if(file_exists("docschargesheet/".$rs['chargesheetdocs']))
		{	
			echo "<a href='docschargesheet/$rs[chargesheetdocs]' class='btn btn-info' >Download</a>";
		}	
		?>
			</td>
		</tr>
	</thead>
	<tbody>
	<?php
		}
	?>
	</tbody>
</table>



</p>
                        </div>
<hr>
<center><input type="button" name="submit" id="submit" value="Print"  class="btn btn-info"   onclick="printDiv('divprintarea')" ></center>
                    </div>
                </div>
            </div>
        </section>
        <!-- End Text & image Section -->

<?php
include("footer.php");
?>

<script>
//divprintarea
function printDiv(DivID)
{
	var mywindow = window.open('', 'PRINT', 'height=400,width=600');

    mywindow.document.write('<html><head><title>' + document.title  + '</title>');
    mywindow.document.write('</head><body >');
    mywindow.document.write('<h1>' + document.title  + '</h1>');
    mywindow.document.write(document.getElementById(DivID).innerHTML);
    mywindow.document.write('</body></html>');

    mywindow.document.close(); // necessary for IE >= 10
    mywindow.focus(); // necessary for IE >= 10*/

    mywindow.print();

    return true;
}
</script>
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