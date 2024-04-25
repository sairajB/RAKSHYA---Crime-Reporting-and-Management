<?php
include("header.php");
if(isset($_POST['submit']))
{
	$prisonerimg = rand(). $_FILES["prisonerimg"]["name"];
	move_uploaded_file($_FILES["prisonerimg"]["tmp_name"],"imgprisoner/".$prisonerimg);
	$prisinerdocument = rand(). $_FILES["prisinerdocument"]["name"];	
	move_uploaded_file($_FILES["prisinerdocument"]["tmp_name"],"docprisoner/".$prisinerdocument);
	//Update Statement starts here
	if(isset($_GET['editid']))
	{
		$sql ="UPDATE prisoner SET complaint_id='$_POST[complaint_id]',fir_id='$_POST[fir_id]',chargesheet_id='$_POST[chargesheet_id]',prisonername='$_POST[prisonername]',section='$_POST[section]',crimedetails='$_POST[crimedetails]',prisoneraddress='$_POST[prisoneraddress]'";
		if($_FILES["prisonerimg"]["name"] != "")
		{
		$sql = $sql . ",prisonerimg='$prisonerimg'";
		}
		if($_FILES["prisinerdocument"]["name"] != "")
		{
		$sql = $sql . ",prisinerdocument='$prisinerdocument'";
		}
		$sql = $sql . ",anynote='$_POST[anynote]' WHERE prisoner_id='$_GET[editid]'";
		$qsql = mysqli_query($con,$sql);
			echo mysqli_error($con);
		if(mysqli_affected_rows($con) == 1)
		{
			echo "<script>alert('station record updated successfully');</script>";
		}	
	}
	//Update Statement ends here
	//Insert statemetn starts here
	else
	{   
		$sql ="INSERT INTO prisoner(crimereport_id,complaint_id,fir_id,chargesheet_id,prisonername,section,crimedetails,prisoneraddress,prisonerimg,prisinerdocument,anynote,status) values('$_POST[crimereport_id]','$_POST[complaint_id]','$_POST[fir_id]','$_POST[chargesheet_id]','$_POST[prisonername]','$_POST[section]','$_POST[crimedetails]','$_POST[prisoneraddress]','$prisonerimg','$prisinerdocument','$_POST[anynote]','Active')";
		$qsql = mysqli_query($con,$sql);
			echo mysqli_error($con);
		if(mysqli_affected_rows($con) == 1)
		{
			echo "<script>alert('Prisoner record inserted successfully');</script>";
			echo "<script>window.location='prisoner.php?crimereport_id=$_GET[crimereport_id]';</script>";
		}
	}
	//Insert statemetn Ends here
}
?>
<?php
if(isset($_GET['editid']))
{
	$sqledit = "SELECT * FROM prisoner WHERE prisoner_id='$_GET[editid]'";
	$qsqledit = mysqli_query($con,$sqledit);
	$rsedit = mysqli_fetch_array($qsqledit);
}
?>       
        <!-- Start Breadcrumb Section -->
        <section class="breadcrumb-section parallax" style="background-image: url(assets/images/bg/breadcrumb4.jpg);">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="page-title">
                            <h1>CRIME REPORTING </h1>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- End Breadcrumb Section -->



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
			<th><h5>Prisoner Image</h5></th>
			<th><h5>Prisoner Name</h5></th>			
			<th><h5>Section</h5></th>			
			<th><h5>Crime Details</h5></th>			
			<th><h5>Prisoner Addredd</h5></th>		
			<th><h5>Prisoner Document</h5></th>			
			<th><h5>AnyNote</h5></th>	
			<th><h5>Action</h5></th>
		</tr>
	</thead>
	<tbody>
		<?php
		$sql = "SELECT * FROM prisoner WHERE crimereport_id='$_GET[crimereport_id]' AND status='Active'";
		$qsql = mysqli_query($con,$sql);
		while($rs = mysqli_fetch_array($qsql))
		{
			echo "<tr>					
						<td><center><img src='imgprisoner/$rs[prisonerimg]' style='width: 70px;height: 75px;'></center></td>
						<td>$rs[prisonername]</td>			
						<td>$rs[section]</td>			
						<td>$rs[crimedetails]</td>			
						<td>$rs[prisoneraddress]</td>	
						<td>
						<a href='docprisoner/$rs[prisinerdocument]' class='btn btn-info' style='width: 100%'>Download</a>
						</td>			
						<td>$rs[anynote]</td>
						<td>
						<a href='legalcase.php?prisoner_id=$rs[prisoner_id]' class='btn btn-primary' style='width: 100%' target='_blank'>Select</a>
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