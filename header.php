<?php
error_reporting(E_ALL & ~E_NOTICE  &  ~E_STRICT  &  ~E_WARNING);
session_start();
$dt = date("Y-m-d");
$tim = date("H:i:s");
$dttim = date("Y-m-d H:i:s");
include("dbconnection.php");
//Default Admin record starts here
$sqldesignation ="SELECT * FROM designation";
$qsqldesignation = mysqli_query($con,$sqldesignation);
echo mysqli_error($con);
if(mysqli_num_rows($qsqldesignation) == 0)
{
	$sql = "INSERT INTO designation(designation_id,designation_type,status)values('1','Administrator','Active')";
	$qsql = mysqli_query($con,$sql);
}
//Default Admin record ends here
//Default cop record starts here
$sqldesignation ="SELECT * FROM cop";
$qsqldesignation = mysqli_query($con,$sqldesignation);
echo mysqli_error($con);
if(mysqli_num_rows($qsqldesignation) == 0)
{
	$sql = "INSERT INTO cop(cop_id,designation_id,cop_name,login_id,password,status)values('1','1','Administrator','admin','adminadminadmin','Active')";
	$qsql = mysqli_query($con,$sql);
}
//Default cop record ends here
if(isset($_POST['btncomplogin']))
{
	$sql ="SELECT * FROM complaint WHERE email_id='$_POST[compemailid]' and password='$_POST[comppassword]' and status='Active'";
	$qsql = mysqli_query($con,$sql);
	echo mysqli_error($con);
	if(mysqli_num_rows($qsql) >= 1)
	{
		$rspro = mysqli_fetch_array($qsql);
		$_SESSION['complaint_id'] = $rspro['complaint_id'];
		echo "<script>window.location='compaccount.php';</script>";
	}
	else
	{
		echo "<script>alert('You have entered invalid login credentials..');</script>";
	}
}
if(isset($_POST['btncoplogin']))
{
	$sql ="SELECT * FROM cop WHERE login_id='$_POST[coploginid]' and password='$_POST[coppassword]' and status='Active'";
	$qsql = mysqli_query($con,$sql);
	echo mysqli_error($con);
	if(mysqli_num_rows($qsql) >= 1)
	{
		$rspro = mysqli_fetch_array($qsql);
		$_SESSION['cop_id'] = $rspro['cop_id'];
		$_SESSION['designation_id'] = $rspro['designation_id'];
		echo "<script>window.location='dashboard.php';</script>";
	}
	else
	{
echo "<script>alert('You have entered invalid login credentials..');</script>";
	}
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title>Crime Report Management System</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- favicons -->
        <link rel="shortcut icon" href="assets/favicon/favicon.ico">
    
        <!-- load google font -->
        <link href="https://fonts.googleapis.com/css?family=Lato:300,400,400i,700,700i" rel="stylesheet">
        
        <!-- all stylesheets include start -->
        <!-- Bootstrap css -->
        <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
        <!-- revolution slider css -->
        <link rel="stylesheet" href="assets/css/rev_slider/settings.css">
        <link rel="stylesheet" href="assets/css/rev_slider/layers.css">
        <link rel="stylesheet" href="assets/css/rev_slider/navigation.css">
        <!-- fontawesome css -->
        <link rel="stylesheet" href="assets/css/font-awesome.min.css">
        <!-- ET Lineicon CSS -->
        <link rel="stylesheet" href="assets/css/lineicon.css">
        <!-- Light Box CSS -->
        <link rel="stylesheet" href="assets/css/lightbox.css">
        <link rel="stylesheet" href="assets/css/animate.css">

        <!-- Owl Carousel CSS -->
        <link rel="stylesheet" href="assets/css/owl.carousel.css">
        <link rel="stylesheet" href="assets/css/owl.theme.css">
        <link rel="stylesheet" href="assets/css/owl.transitions.css">

        <!-- theme style css -->
        <link rel="stylesheet" href="assets/css/style.css">
        <!-- responsive css -->
        <link rel="stylesheet" href="assets/css/responsive.css">
        <!-- all stylesheets include end -->
        <link rel="stylesheet" href="assets/css/jquery.dataTables.min.css">
        <link rel="stylesheet" href="assets/css/fixedColumns.dataTables.min.css">
    </head>
    <body>
    <div id="container">
        <!-- Start Top Header Section -->
        <section class="topbar">
            <div class="container">
                <div class="row">
                    <div class="col-md-5">
                        <ul class="social-icons">

	<li class="drop"><a href="about.php">About</a></li>
	<li><a href="contact.php">Contact</a></li>
	
                    </div>
                    <div class="col-md-7">
                        <div class="contact-info">
						
                        <ul class="social-icons">

							<li><a target="_blank" href="#"><i class="fa fa-facebook"></i></a></li>
							<li><a target="_blank" href="#"><i class="fa fa-twitter"></i></a></li>
							<li><a target="_blank" href="#"><i class="fa fa-youtube"></i></a></li>
                        </ul>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- End Top Header Section -->

        <!-- Start Header & Navigation Section -->
        <header class="clearfix" id="header">
            <!-- Static navbar -->
            <nav class="navbar navbar-default">
                 
                <div class="container">
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                        <a class="navbar-brand" href="index.php"><img alt="" src="assets\images\others\logo1.png" style="width: 75px; height: auto;"></a>

                    </div>
                    <div class="navbar-collapse collapse">
<ul class="nav navbar-nav navbar-right">
<?php
	if(isset($_SESSION['complainer_id']))
	{
?>
	<li class="drop"><a class="active" href="index.php">Home</a></li>
	<li><a href='complaint_registration.php'>Register a Complaint</a></li>	
	<li class="drop"><a href="#">Profile <i class="fa fa-arrow-down" aria-hidden="true"></i></a> 
		<ul class="drop-down">
			<li><a href="complainerprofile.php">Update Profile</a></li>
			<li><a href="complainerchangepassword.php">Change password</a></li>
		</ul>
	</li>
	<li class="drop"><a href="#">Report <i class="fa fa-arrow-down" aria-hidden="true"></i></a> 
		<ul class="drop-down">
			<li><a href="viewcomplaint.php">Complaint Report</a></li>
			<li><a href="viewfir.php">FIR Report</a></li>
			<!-- <li><a href="viewfirtochargesheet.php">Chargesheet Report</a></li>
			<li><a href="viewcrime_report.php">Crime Report</a></li>
			<li><a href="viewlegalcase.php">Legal Case</a></li> -->
		</ul>
	</li>
	<li><a href="logout.php">Logout</a></li>
<?php
	}
	else if(isset($_SESSION['cop_id']))
	{
?>
	<li class="drop"><a class="active" href="dashboard.php">Dashboard</a></li>		
	<li class="drop"><a href="#">Complaint <i class="fa fa-arrow-down" aria-hidden="true"></i></a> 
		<ul class="drop-down">
			<li><a href="viewcomplaint.php">View Complaint</a></li>
			<li><a href="complainer.php">Add Complainer</a></li>
			<li><a href="viewcomplainer.php">View Complainer</a></li>
		</ul>
	</li>
	
	<li class="drop"><a href="#">FIR <i class="fa fa-arrow-down" aria-hidden="true"></i></a> 
		<ul class="drop-down">
			<li><a href="firregistration.php">FIR Registration </a></li>
			<?php /* <li><a href="fir.php">Add FIR</a></li> */ ?>
			<li><a href="viewfir.php">View FIR</a></li>
		</ul>
	</li>
	
	<!-- <li class="drop"><a href="#">Chargesheet <i class="fa fa-arrow-down" aria-hidden="true"></i></a> 
		<ul class="drop-down">
			<li><a href="selectfirtochargesheet.php">Add Chargesheet</a></li>
			<li><a href="viewfirtochargesheet.php">View Chargesheet</a></li>
		</ul>
	</li> -->
	
	<!-- <li class="drop"><a href="#">Crime Report <i class="fa fa-arrow-down" aria-hidden="true"></i></a> 
		<ul class="drop-down">
			<li><a href="selectchargesheetforcrime.php">Add Crime Report</a></li>
			<li><a href="viewcrime_report.php">View Crime Report</a></li>
		</ul>
	</li> -->
	
	<!-- <li class="drop"><a href="#">Legal  <i class="fa fa-arrow-down" aria-hidden="true"></i></a> 
		<ul class="drop-down">
			<li><a href="selectlegalcase.php">Add Legal Case Report</a></li>
			<li><a href="viewlegalcase.php">View Legal Case Report</a></li>
		</ul>
	</li> -->
<?php
if($_SESSION['designation_id'] == 1)	
{
?>
	<!-- <li class="drop"><a href="#">Station <i class="fa fa-arrow-down" aria-hidden="true"></i></a> 
		<ul class="drop-down">
			<li><a href="cop.php">Add Cop</a></li>
			<li><a href="viewcop.php">View Cop</a></li>
			<li><a href="station.php">Add Station</a></li>
			<li><a href="viewstation.php">View Station</a></li>
			<li><a href="designation.php">Add Designation</a></li>
			<li><a href="viewdesignation.php">View Designation</a></li>
		</ul>
	</li>	 -->
	<li class="drop"><a href="#">Setting<i class="fa fa-arrow-down" aria-hidden="true"></i></a> 
		<ul class="drop-down">
			<li><a href="city.php">Add City</a></li>
			<li><a href="viewcity.php">View City</a></li>
			<li><a href="state.php">Add state</a></li>
			<li><a href="viewstate.php">View state</a></li>
		</ul>
	</li>
<?php
}
?>
	<li class="drop"><a href="#">Profile <i class="fa fa-arrow-down" aria-hidden="true"></i></a> 
		<ul class="drop-down">
			<li><a href="copprofile.php">Update Profile</a></li>
			<li><a href="copchangepassword.php">Change Password</a></li>
		</ul>
	</li>	
	<li><a href="logout.php">Logout</a></li>	
<?php
	}
	else
	{
?>
	<li class="drop"><a class="active" href="index.php">Home</a></li>
	<?php
		if(isset($_SESSION['complainer_id']))
		{
		echo "<li><a href='complaint_registration.php'>Register a Complaint</a></li>";
		}
		else
		{
		echo "<li><a href='#' onclick='alert(`Kindly login before registering complaint..`);'>Register a Complaint</a></li>";			
		}	
	?>
	<li class="drop"><a class="active" href="complainerlogin.php" target="_blank">Login</a></li>
	<li class="drop"><a class="active" href="complainerregister.php" target="_blank">Register</a></li>
<?php
	}
?>
</ul>
                    </div>
                </div>
            </nav>
        </header>
        <!-- End Header -->
        <!-- End Header & Navigation Section -->