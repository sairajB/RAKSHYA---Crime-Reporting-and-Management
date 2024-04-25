<?php
include("header.php");
if(!isset($_SESSION['cop_id']))
{
	echo "<script>window.location='index.php';</script>";
}
?>
<!-- Start Team Member Section -->
<section class="pad-t100 pad-b70">
<div class="container">
	<div class="row">
		<div class="col-md-12">
			<div class="section-title text-center">
				<h3>ADMIN DASHBOARD</h3>
			</div>
		</div>
	</div>
	<div class="row">
	
		<div class="col-md-4 col-sm-4">
			<div class="team-member-1">
				<div >
					<img class="img-responsive" src="assets/images/complain.webp" STYLE="width: 100%;height: 250px;">
				</div>
				<div class="team-info">
					<div class="team-name">Complainer Records</div>
					<div class="team-designation">
					<?php
					$sql ="SELECT  * FROM complainer";
					$qsql = mysqli_query($con,$sql);
					echo mysqli_num_rows($qsql);
					?>
					records
					</div>
				</div>
			</div>
		</div>
			
		<!-- <div class="col-md-4 col-sm-4">
			<div class="team-member-1">
				<div >
					<img class="img-responsive" src="assets/images/police/chargesheet.jpg" STYLE="width: 100%;height: 250px;">
				</div>
				<div class="team-info">
					<div class="team-name">Chargesheet Records</div>
					<div class="team-designation">
					<?php
					/*
					$sql ="SELECT  * FROM chargesheet";
					$qsql = mysqli_query($con,$sql);
					echo mysqli_num_rows($qsql);
					*/
					?>
					records
					</div>
				</div>
			</div>
		</div> -->
		
		<div class="col-md-4 col-sm-4">
			<div class="team-member-1">
				<div >
					<img class="img-responsive" src="assets/images/police/city.jpg" STYLE="width: 100%;height: 250px;">
				</div>
				<div class="team-info">
					<div class="team-name">city Records</div>
					<div class="team-designation">
					<?php
					$sql ="SELECT  * FROM city";
					$qsql = mysqli_query($con,$sql);
					echo mysqli_num_rows($qsql);
					?>
					records
					</div>
				</div>
			</div>
		</div>
		
			
		<div class="col-md-4 col-sm-4">
			<div class="team-member-1">
				<div >
					<img class="img-responsive" src="assets/images/police/complaint.jpg" STYLE="width: 100%;height: 250px;">
				</div>
				<div class="team-info">
					<div class="team-name">complaint Records</div>
					<div class="team-designation">
					<?php
					$sql ="SELECT  * FROM complaint";
					$qsql = mysqli_query($con,$sql);
					echo mysqli_num_rows($qsql);
					?>
					records
					</div>
				</div>
			</div>
		</div>
		

		<!-- <div class="col-md-4 col-sm-4">
			<div class="team-member-1">
				<div >
					<img class="img-responsive" src="assets/images/police/cop.jpg" STYLE="width: 100%;height: 250px;">
				</div>
				<div class="team-info">
					<div class="team-name">Cop Records</div>
					<div class="team-designation">
					<?php 
					/*
					$sql ="SELECT  * FROM cop";
					$qsql = mysqli_query($con,$sql);
					echo mysqli_num_rows($qsql);
					*/
					?>
					records
					</div>
				</div>
			</div>
		</div> -->

		
		<!-- <div class="col-md-4 col-sm-4">
			<div class="team-member-1">
				<div >
					<img class="img-responsive" src="assets/images/police/Designation.jpg" STYLE="width: 100%;height: 250px;">
				</div>
				<div class="team-info">
					<div class="team-name">Designation Records</div>
					<div class="team-designation">
					<?php
					/*
					$sql ="SELECT  * FROM designation";
					$qsql = mysqli_query($con,$sql);
					echo mysqli_num_rows($qsql);
					*/
					?>
					records
					</div>
				</div>
			</div>
		</div> -->
		

		<div class="col-md-4 col-sm-4">
			<div class="team-member-1">
				<div >
					<img class="img-responsive" src="assets/images/police/fir.jpg" STYLE="width: 100%;height: 250px;">
				</div>
				<div class="team-info">
					<div class="team-name">FIR Records</div>
					<div class="team-designation">
					<?php
					$sql ="SELECT  * FROM designation";
					$qsql = mysqli_query($con,$sql);
					echo mysqli_num_rows($qsql);
					?>
					records
					</div>
				</div>
			</div>
		</div>


		<!-- <div class="col-md-4 col-sm-4">
			<div class="team-member-1">
				<div >
					<img class="img-responsive" src="assets/images/police/LegalCase.jpg" STYLE="width: 100%;height: 250px;">
				</div>
				<div class="team-info">
					<div class="team-name">LegalCase Records</div>
					<div class="team-designation">
					<?php
					/*
					$sql ="SELECT  * FROM legalcase";
					$qsql = mysqli_query($con,$sql);
					echo mysqli_num_rows($qsql);
					*/
					?>
					records
					</div>
				</div>
			</div>
		</div> -->



		<!-- <div class="col-md-4 col-sm-4">
			<div class="team-member-1">
				<div >
					<img class="img-responsive" src="assets/images/police/prisoner.jpg" STYLE="width: 100%;height: 250px;">
				</div>
				<div class="team-info">
					<div class="team-name">Prisoner Records</div>
					<div class="team-designation">
					<?php/*
					$sql ="SELECT  * FROM prisoner";
					$qsql = mysqli_query($con,$sql);
					echo mysqli_num_rows($qsql);*/
					?>
					records
					</div>
				</div>
			</div>
		</div> -->



		<div class="col-md-4 col-sm-4">
			<div class="team-member-1">
				<div >
					<img class="img-responsive" src="assets/images/police/th.jpg" STYLE="width: 100%;height: 250px;">
				</div>
				<div class="team-info">
					<div class="team-name">State Records</div>
					<div class="team-designation">
					<?php
					$sql ="SELECT  * FROM state";
					$qsql = mysqli_query($con,$sql);
					echo mysqli_num_rows($qsql);
					?>
					records
					</div>
				</div>
			</div>
		</div>


		<div class="col-md-4 col-sm-4">
			<div class="team-member-1">
				<div >
					<img class="img-responsive" src="assets/images/police/station.jpg" STYLE="width: 100%;height: 250px;">
				</div>
				<div class="team-info">
					<div class="team-name">station Records</div>
					<div class="team-designation">
					<?php
					$sql ="SELECT  * FROM station";
					$qsql = mysqli_query($con,$sql);
					echo mysqli_num_rows($qsql);
					?>
					records
					</div>
				</div>
			</div>
		</div>
		
		
	</div>
</div>
</section>
<!-- End Team Member Section -->

<?php
include("footer.php");
?>

        