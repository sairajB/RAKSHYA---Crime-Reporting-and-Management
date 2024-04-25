 <?php
include("header.php");
if(isset($_POST['submit']))
	{
	//Update Statement starts here
	if(isset($_GET['editid']))
	{
		$sql ="UPDATE complaint SET station_id='$_POST[station_id]',state_id='$_POST[state_id]',city_id='$_POST[city_id]',complaint_type='$_POST[complaint_type]',accusedby='$_POST[accusedby]',complaint_date='$_POST[complaint_date]',complaint='$_POST[complaint]',complaint_detail='$_POST[complaint_detail]',victim_address='$_POST[victim_address]',accused_address='$_POST[accused_address]',victim_phoneno='$_POST[victim_phoneno]',accused_phoneno='$_POST[accused_phoneno]',evidence='$_POST[evidence]',photo_evidence='$_POST[photo_evidence]',video_evidence='$_POST[video_evidence]',anynote='$_POST[anynote]',email_id='$_POST[email_id]',phone_no='$_POST[phone_no]',complaint_status='$_POST[complaint_status]',status='$_POST[status]' WHERE station_id='$_GET[editid]'";
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
		$sql ="INSERT INTO complaint (station_id,state_id,city_id,complaint_type,accusedby,complaint_date,complaint,complaint_detail,victim_address,accused_address,victim_phoneno,accused_phoneno,evidence,photo_evidence,video_evidence,anynote,email_id,phone_no,complaint_status,status)values('$_POST[station_id]','$_POST[state_id]','$_POST[city_id]','$_POST[complaint_type]','$_POST[accusedby]','$_POST[complaint_date]','$_POST[complaint]','$_POST[complaint_detail]','$_POST[victim_address]','$_POST[accused_address]','$_POST[accused_phoneno]','$_POST[evidence]','$_POST[photo_evidence]','$_POST[photo_evidence]','$_POST[anynote]','$_POST[email_id]','$_POST[login_id]','$_POST[phone_no]','$_POST[complaint_status]','$_POST[status]')";
		$qsql = mysqli_query($con,$sql);
			echo mysqli_error($con);
		if(mysqli_affected_rows($con) == 1)
		{
			echo "<script>alert('compalint record inserted successfully');</script>";
			echo "<script>window.location='compalint.php';</script>";
		}
	}
}
?> 
<?php
	$sqledit = "SELECT complaint.*,station.station,station.contact_no,station.station_addresss, state.state,city.city, complainer.name,complainer.email_id, complainer.phoneno FROM complaint LEFT JOIN station on complaint.station_id=station.station_id LEFT JOIN state ON state.state_id=station.state_id LEFT JOIN city ON city.city_id=station.city_id LEFT JOIN complainer ON complainer.complainer_id=complaint.complainer_id WHERE complaint.complaint_id='$_GET[insid]'";
	$qsqledit = mysqli_query($con,$sqledit);
	$rsedit = mysqli_fetch_array($qsqledit);
?>     
        <!-- Start Breadcrumb Section -->
        <section class="breadcrumb-section parallax" style="background-image: url(assets/images/bg/breadcrumb4.jpg);">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="page-title">
                            <h1>Complaint Acknowledgement Receipt</h1>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- End Breadcrumb Section -->
        <form method="post" action="" id="printableArea">

        <!-- Start About Section -->
        <section class="pad-t100 pad-b90">
            <div class="container" style="padding-left: 125px;padding-right: 125px;">
                <div class="row">
					<div class="col-md-12">
                        <div class="feature-4" style="padding:20px;">
		<center>
			<h3><?php echo $rsedit['station']; ?></h3>
			<p><?php echo $rsedit['station_addresss']; ?>,<br><?php echo $rsedit['city']; ?>, <?php echo $rsedit['state']; ?><br>Ph. No. <?php echo $rsedit['contact_no']; ?></p>
		</center>	<hr>
<div class="intro-text">
	<p>
<div class="row">
<div class="col-md-12">
<center style="padding: 15px;"><h2>Complaint Letter</h2></center><hr>
</div>
</div>
<br>
<div class="row">
		<div class="col-md-6">
		<b style="color: black;">Victims detail,</b>
		<p>
		<?php echo $rsedit['victims_name']; ?><br>
		<?php echo $rsedit['victim_address']; ?><br>
		<?php echo $rsedit['victim_phoneno']; ?>'
		</p>
		</div>
		<div class="col-md-6" style="text-align: right;">
		<b style="color: black;">Complaint No. </b>
		<?php echo $rsedit[0]; ?><br><br>
		<b style="color: black;">Complaint Date: </b><br>
		<?php echo date("d-M-Y",strtotime($rsedit['complaint_date'])); ?>
		<?php echo date("h:i A",strtotime($rsedit['complaint_date'])); ?>
		</div>
</div>
<hr><br>
<div class="row">
	<div class="col-md-12">
		<b><label  style="color: black;">Complaint Subject:</label> <?php echo $rsedit['complaint']; ?> </b><br>
		<?php echo $rsedit['complaint_detail']; ?>
	</div>
</div>
<br>
<div class="row">
	<div class="col-md-6">
		<b  style="color: black;">Accuser detail:</b><br>
		<?php echo $rsedit['accusedby']; ?>,<br>
		<?php echo $rsedit['accused_address']; ?>,<br>
		<b>Ph. No.</b> <?php echo $rsedit['accused_phoneno']; ?>
	</div>
	<div class="col-md-6">
		<b  style="color: black;">Evidence:</b><br><?php echo $rsedit['evidence']; ?>
	</div>
</div>
<br>
<div class="row">
	<div class="col-md-6">
		<b style="color: black;">Photo Evidence:</b>
		<br>
		<?php 
if($rsedit['photo_evidence'] == "")
{
	echo $img =  "<img src='assets/images/No-Image-Available.png' style='width: 100%; height: 350px'>";
}
else if(file_exists("imgphoto_evidence/".$rsedit['photo_evidence']))
{
	echo $img =  "<img src='imgphoto_evidence/$rsedit[photo_evidence]' class='img' style='width: 100%; height: 350px'>";
}
else
{
	echo $img = "<img src='assets/images/No-Image-Available.png' style='width: 100%; height: 350px'>";
}
		?>
	</div>
	<div class="col-md-6">
<?php 
if($rsedit['video_evidence'] == "")
{
	$vid =  "<img src='assets/images/No-Image-Available.png' style='width: 100%; height: 350px'>";
}
else if(file_exists("imgvideo_evidence/".$rsedit['video_evidence']))
{
	$vid =  "imgvideo_evidence/$rsedit[video_evidence]";
}
else
{
	$vid = "<img src='assets/images/No-Image-Available.png' style='width: 100%; height: 350px'>";
}
		?>
		<b style="color: black;">Video Evidence:</b><br><video autoplay  style='width: 100%; height: 350px' controls><source  src="<?php echo $vid; ?>" type="video/mp4"></video>
	</div>
</div>
<br><hr>
<div class="row">
		<div class="col-md-6">
		<b style="color: black;">Complainer detail,</b>
		<p>
		<?php echo $rsedit['name']; ?><br>
		<?php echo $rsedit['email_id']; ?><br>
		<?php echo $rsedit['phoneno']; ?>
		</p>
		</div>
		<div class="col-md-6" style="text-align: right;">
		
		</div>
</div>

<br><hr>
<?php
if($rsedit['status'] == "Active")
{
?>
<div class="row">
		<div class="col-md-12">
		<b style="color: black;">Police station Response,</b>
		<p>
		<b>Complaint Type : </b><?php echo $rsedit['complaint_type']; ?><br>
		<b>Note from Police Station : </b><?php echo $rsedit['anynote']; ?><br>
		<b>Complaint Status: </b><?php echo $rsedit['complaint_status']; ?>
		</p>
		</div>
</div>
<hr>
<?php
}
else
{
?>
<div class="row">
		<div class="col-md-12"><br>
		<center><b style="color: red;">Complaint not processed yet...</b></center>
		</div>
</div>
<?php
}
?>
	</p>
</div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- End About Section -->
		
		
    </form>

        <form method="post" action="">

        <!-- Start About Section -->
        <section class="">
            <div class="container" style="padding-left: 125px;padding-right: 125px;">
                <div class="row">
					<div class="col-md-12">
                        <div class="feature-4" style="padding:10px;">

<div class="intro-text">
	<div class="row">
		<div class="col-md-12">
		<center><input type="button" name="submit" id="submit" value="Click here to file FIR" class="form-control btn btn-primary" style="width: 500px;height: 100px; font-size: 35px;"  onclick="window.location='fir.php?complaint_id=<?php echo $_GET['insid']; ?>'" ></center>
		</div>
	</div>
</div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- End About Section -->
		
		
    </form>

<?php
include("footer.php");
?>
<script>
function printDiv(divName) {
     var printContents = document.getElementById(divName).innerHTML;
     var originalContents = document.body.innerHTML;

     document.body.innerHTML = printContents;

     window.print();

     document.body.innerHTML = originalContents;
}
</script>