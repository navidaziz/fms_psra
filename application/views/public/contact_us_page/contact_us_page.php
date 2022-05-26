



<!-- Start Banner Area -->
	<section class="banner-area relative">
		<div class="container">
			<div class="row d-flex align-items-center justify-content-center">
				<div class="about-content col-lg-12">
					<h1 class="text-white" style="color:black !important">
							<?php echo $title; ?>
					</h1>
					<p style="color:black !important">For more information, complaint and feedback feel free to contact us </p>
					<div class="link-nav" style="color:black !important; ">
						<span class="box" style="color:black !important; border-top:1px solid black; border-bottom:1px solid black;">
                        <a style="color:black !important" href="<?php echo base_url(); ?>">
                            <i style="color:black !important" class="fa fa-home fa-lg"></i> Home</a> 
                            <i class="lnr lnr-arrow-right" style="color:black !important"></i>
    <a style="color:black !important" href="#"><?php echo $title; ?></a> 
						
						</span>
					</div>
				</div>
			</div>
		</div>
		<div class="rocket-img">
			<img src="img/ro cket.png" alt="">
		</div>
	</section>
	<!-- End Banner Area -->


<section class="contact-page-area section-gap">
		<div class="container">
			<div class="row">
				<div class="map-wrap" style="width:100%; height: 445px;" id="m ap">
                  <iframe  class="we-onmap wow fadeInUp" data-wow-delay="0.3s" style="width:100%; height: 445px;" src="<?php echo $contact_us_page[0]->google_map_link; ?>"></iframe>
                </div>
                
                
              
                
                
				<div class="col-lg-4 d-flex flex-column address-wrap">
					<div class="single-contact-address d-flex flex-row">
						<div class="icon">
							<span class="lnr lnr-home"></span>
						</div>
						<div class="contact-details">
							<!--<h5>Binghamton, New York</h5>-->
							<p>
								 <?php echo $system_global_settings->address; ?>
							</p>
						</div>
					</div>
					<div class="single-contact-address d-flex flex-row">
						<div class="icon">
							<span class="lnr lnr-phone-handset"></span>
						</div>
						<div class="contact-details">
							<h5>Contact No's</h5>
							<p><?php echo $system_global_settings->phone_number; ?> , <?php echo $system_global_settings->mobile_number; ?>, <?php echo $system_global_settings->fax_number; ?></p>
						</div>
					</div>
					<div class="single-contact-address d-flex flex-row">
						<div class="icon">
							<span class="lnr lnr-envelope"></span>
						</div>
						<div class="contact-details">
							<h5><?php echo $system_global_settings->email_address; ?></h5>
							<p>Send us your query anytime!</p>
						</div>
                        
					</div>
				</div>
				<div class="col-lg-8">
					<form class="form-area contact-form text-right" id="myForm" action="mail.php" method="post">
						<div class="row">
							<div class="col-lg-6 form-group">
								<input name="name" placeholder="Enter your name" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Enter your name'"
								 class="common-input mb-20 form-control" required type="text">

								<input name="email" placeholder="Enter email address" pattern="[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+\.[A-Za-z]{1,63}$" onfocus="this.placeholder = ''"
								 onblur="this.placeholder = 'Enter email address'" class="common-input mb-20 form-control" required type="email">

								<input name="subject" placeholder="Enter subject" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Enter subject'"
								 class="common-input mb-20 form-control" required type="text">
							</div>
							<div class="col-lg-6 form-group">
								<textarea class="common-textarea form-control" name="message" placeholder="Enter Messege" onfocus="this.placeholder = ''"
								 onblur="this.placeholder = 'Enter Messege'" required></textarea>
							</div>
							<div class="col-lg-12">
								<div class="alert-msg" style="text-align: left;"></div>
								<button class="primary-btn" style="float: right;">Send Message</button>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</section>




