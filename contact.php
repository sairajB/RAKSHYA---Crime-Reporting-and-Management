<?php
include("header.php");
?>




        <!-- Start Breadcrumb Section -->
        <section class="breadcrumb-section parallax" style="background-image: url(assets/images/bg/breadcrumb4.jpg);">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="page-title">
                            <h1>Contact us</h1>
                        </div>
                        <div class="breadcrumb">
                            <ul>
                                <li>You Are Here :</li>
                                <li><a href="#">Home</a></li>
                                <li>Contact</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- End Breadcrumb Section -->


        <!-- Start Contact Form Section -->
        <section class="pad100">
            <div class="container">
                <div class="row">
                    <div class="section-title text-center">
                        <h3>Drop Us a Message</h3>
                    </div>
                </div>
                <div class="col-md-8">
                    <form id="contactForm" class="contact-form" method="post" role="form">
                        <div class="messages"></div>
                        <div class="controls">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <input id="form_name" type="text" name="name" class="form-control" placeholder="Name *" required="required" data-error="Name is required.">
                                        <div class="help-block with-errors"></div>
                                    </div>
                                    <div class="form-group">
                                        <input id="form_email" type="email" name="email" class="form-control" placeholder="Email *" required="required" data-error="Valid email is required.">
                                        <div class="help-block with-errors"></div>
                                    </div>
                                    <div class="form-group">
                                        <input id="form_phone" type="text" name="phone" class="form-control" placeholder="Phone">
                                        <div class="help-block with-errors"></div>
                                    </div>
                                    <div class="form-group">
                                        <input id="form_subject" type="text" name="subject" class="form-control" placeholder="Subject *" required="required" data-error="Subject is required.">
                                        <div class="help-block with-errors"></div>
                                    </div>
                                    <div class="form-group">
                                        <textarea id="form_message" name="message" class="form-control" placeholder="Message *" required="required" data-error="Please,leave us a message." style="min-height: 175px;"></textarea>
                                        <div class="help-block with-errors"></div>
                                    </div>
                                    <input type="submit" class="btn btn-primary mb30" value="Send message">
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col-md-12">
                                    <p class="text-muted"><strong>*</strong> These fields are required.</p>
                                </div>
                            </div>
                        </div>

                    </form>
                    
                </div>
                <div class="col-md-4 mbl-mar-top">
                    <div class="feature-5">
                        <div class="media">
                            <div class="media-left">
                                <div class="icon">
                                    <i class="fa fa-map-marker"></i>
                                </div>
                            </div>
                            <div class="media-body">
                                <a href="#"><h4>Address</h4></a>
                                <div class="feature-text">
                                    <p>PICT, Dhankawdi<br/>Pune - 411037</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="feature-5">
                        <div class="media">
                            <div class="media-left">
                                <div class="icon">
                                    <i class="fa fa-envelope"></i>
                                </div>
                            </div>
                            <div class="media-body">
                                <a href="#"><h4>E-mail</h4></a>
                                <div class="feature-text">
                                    <p>pbl.proj.24@gmail.com</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="feature-5">
                        <div class="media">
                            <div class="media-left">
                                <div class="icon">
                                    <i class="fa fa-phone"></i>
                                </div>
                            </div>
                            <div class="media-body">
                                <a href="#"><h4>Phone</h4></a>
                                <div class="feature-text">
                                    <p>+917709361699<br/>+919423118169<br/>+919823679615<br/>+917823858364</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- End Contact Form Section -->
		<hr>

 <?php
include("footer.php");
?>
 