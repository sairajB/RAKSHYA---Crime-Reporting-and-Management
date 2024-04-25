<?php
include("header.php");
?>
     
        <!-- Start Breadcrumb Section -->
        <section class="breadcrumb-section parallax" style="background-image: url(assets/images/bg/breadcrumb4.jpg);">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="page-title">
                            <h1 style="background-color: #626262; background-color: rgba(98, 98, 98, 0.6);">User Account</h1>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- End Breadcrumb Section -->

        <!-- Start Text & image Section -->
        <section class="pad100" style="background-color: rgba(250, 250, 250, 1);">
            <div class="container">
                <div class="row">
                    <div class="col-md-5">
                        <div class="template-image">
                            <img src="assets/images/others/1.png" alt="" class="img-responsive">
                        </div>
                    </div>
                    <div class="col-md-7">
                        <div class="text-section">
                            <h3 class="underline">RAKSHYA <br/> Crime Report  <br/><span>Management System</span></h3>
                            <p class="mb30"><strong>Rakshya :</strong>Crime Report Management System  is a website in which will reduce the paperwork of the
police station.This project is maintained in a single server and it makes handling of records
easier. Here we can maintain, add and retrieve all the records like criminal record, complaint
record, most wanted criminal record, case history, many more in a single database system.</p>
                            <a href="about.php" class="btn btn-primary mini-mar-bottom">VIEW MORE</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- End Text & image Section -->

        <!-- Start Animated Counter -->
        <!-- <section class="pad-t100 pad-b70 parallax" style="background-image: url(assets/images/bg/bg2.png); background-position: 50% 40px;">
            <div class="container">
                <div class="row">
                    
<?php
/*
$sqlcomplainer ="SELECT * FROM complainer";
$qsqlcomplainer  = mysqli_query($con,$sqlcomplainer);
*/
?>					
                    <div class="col-md-3 col-sm-6">
                        <div class="animated-counter text-center white">
                            <div class="animated-number" data-from="0" data-to="<?php /*echo mysqli_num_rows($qsqlcomplainer); ?>"><?php echo mysqli_num_rows($qsqlcomplainer); */?></div>
                            <h4>Complainers</h4>
                        </div>
                    </div>
<?php
/*
$sqlcomplaint ="SELECT * FROM complaint";
$qsqlcomplaint  = mysqli_query($con,$sqlcomplaint);
*/
?>	
                    <div class="col-md-3 col-sm-6">
                        <div class="animated-counter text-center white">
                            <div class="animated-number" data-from="0" data-to="<?php /*echo mysqli_num_rows($qsqlcomplaint); ?>"><?php echo mysqli_num_rows($qsqlcomplaint); */?></div>
                            <h4> Complaints</h4>
                        </div>
                    </div>
<?php
/*
$sqlstation ="SELECT * FROM station";
$qsqlstation  = mysqli_query($con,$sqlstation);
*/
?>	
                    <div class="col-md-3 col-sm-6">
                        <div class="animated-counter text-center white">
                            <div class="animated-number" data-from="0" data-to="<?php /*echo mysqli_num_rows($qsqlstation); ?>"><?php echo mysqli_num_rows($qsqlstation); /*?></div>
                            <h4>Stations</h4>
                        </div>
                    </div>
<?php
/*
$sqlcop ="SELECT * FROM cop";
$qsqlcop  = mysqli_query($con,$sqlcop);
*/
?>	
                    <div class="col-md-3 col-sm-6">
                        <div class="animated-counter text-center white">
                            <div class="animated-number" data-from="0" data-to="<?php /*echo mysqli_num_rows($qsqlcop); ?>"><?php echo mysqli_num_rows($qsqlcop);*/ ?></div>
                            <h4>Cops</h4>
                        </div>
                    </div>
                </div>
            </div>
        </section> -->
        <!-- End Animated Counter -->


        <!-- Start Service Section -->
        <section class="pad-t100 pad-b70">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="section-title text-center">
                            <h3>Police Info Management System</h3>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="feature-1">
                            <div class="media">
                                <div class="media-left">
                                    <div class="feature-icon text-center">
                                        <i class="fa fa icon-lightbulb"></i>
                                    </div>
                                </div>
                                <div class="media-body">
                                    <h4>Cop Account</h4>
                                    <p>This module allows station admin to add all cop details like name, address, designation, etc into the system. This can also edit or modify..  Admin is the main user of the system. Cops has limited authority. Cops can login to the system by entering User Name and password. Different types of users like Inspector, Sup inspector, Constable, etc can be maintained in the system. Cops can update their profile details and they can change password.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="feature-1">
                            <div class="media">
                                <div class="media-left">
                                    <div class="feature-icon text-center">
                                        <i class="fa fa icon-layers"></i>
                                    </div>
                                </div>
                                <div class="media-body">
                                    <h4>Complainer </h4>
                                    <p>This module stores complainer profile details. Complainer needs to register to the system. After the login complainer can file or lodge complaint in the complaint section. Complainer can view complaint status, fir status, crime details, charge sheet details, etc..</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="feature-1">
                            <div class="media">
                                <div class="media-left">
                                    <div class="feature-icon text-center">
                                        <i class="fa fa icon-gears"></i>
                                    </div>
                                </div>
                                <div class="media-body">
                                    <h4>Complaint</h4>
                                    <p>Any public members can file complaint through online by entering Complaint reason, evidence, complaint details, complaint type, etc. Even police department can file complaint from their account if anyone gives complaint directly by visiting police station. Complaint can be closed anytime if both parties agrees. If the complaint not closed in 2-3 days then the cops has right to add the complaint to FIR. .</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- End Service Section -->
<hr>


        <!-- Start Team Member Section -->
        <!-- <section class="pad-t100 pad-b70">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="section-title text-center">
                            <h3>Cops Profile</h3>
                        </div>
                    </div>
                </div>
                <div class="row">
				<?php
                /*
			$sql = "SELECT cop.*,designation.designation_type,station.station FROM cop LEFT JOIN station on cop.station_id=station.station_id LEFT JOIN designation ON designation.designation_id=cop.designation_id WHERE cop.status='Active' AND cop.cop_id!= '0' limit 0,9 ";
$qsql = mysqli_query($con,$sql);
while($rsprofile = mysqli_fetch_array($qsql))
{*/
				?>
<div class="col-md-4 col-sm-4">
	<div class="team-member-1">
		<div class="team-member-img">
			<img class="img-responsive" src="imgcop/<?php /*echo $rsprofile['img']; */?>" alt="" style="width: 100%; height: 400px;">
		</div>
		<div class="team-info">
			<div class="team-name"><?php /*echo $rsprofile['cop_name']; */?></div>
			<div class="team-designation"><?php /* echo $rsprofile['designation_type'];*/ ?></div>
		</div>
		<div class="social-icon">
			<ul class="icon">
				<li>
					<a href="#"><i class="fa fa-facebook"></i></a>
				</li>
				<li>
					<a href="#"><i class="fa fa-twitter"></i></a>
				</li>
				<li>
					<a href="#"><i class="fa fa-google-plus"></i></a>
				</li>
				<li>
					<a href="#"><i class="fa fa-linkedin"></i></a>
				</li>
			</ul>
		</div>
	</div>
</div>
<?php
/*}*/
?>

				</div>
            </div>
        </section> -->
        <!-- End Team Member Section -->

<?php
include("footer.php");
?>