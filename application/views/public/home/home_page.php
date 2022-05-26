 <!-- Start Banner Area -->
 <section class="home-banner-area relative" style="min-height: 100px;">
 	<div class="container">
 		<div class="row d-flex align-items-center justify-content-center">
 			<div class="about-content col-lg-12">
 				<div class="banner-content col-md-12" style="">
 					<div style="background-color: #7FB1EB; width:60%; margin:0px auto; min-height:50px; padding:30px; ">


 						<div class="row">
 							<div class="col-lg-2 col-md-2 about-right" style="padding-right: 5px; padding-left: 5px;">
 								<div style="height: 80px; background-color:white;">

 								</div>
 							</div>
 							<div class="col-lg-10 col-md-10 about-right" style="padding-right: 5px; padding-left: 5px;">
 								<div style="background-color: white; padding:2px">
 									<h2 style="text-align: left;">Media Matters for Democracy</h2>
 								</div>
 								<h3 style="text-align: left;">React Resist, Reclaim</h3>
 							</div>
 						</div>
 					</div>

 				</div>
 				<br />
 				<div class="link-nav">
 					<span class="box" style="color:black !important; border-top:1px solid black; border-bottom:1px solid black;">
 						<a style="color:black !important" href="#">
 							Community Awareness and Media Innovation Lab Address <strong>Projects</strong>
 						</a>

 					</span>
 				</div>
 			</div>
 		</div>

 	</div>
 	<div class="rocket-img">
 		<img src="img/roc ket.png" alt="">
 	</div>
 </section>
 <!-- End Banner Area -->


 <!--Start Feature Area -->
 <section class="feature-area" style="padding: 10px 0 120px;">
 	<div class="container">

 		<div class="feature-inner row">

 			<?php foreach ($services as $service) { ?>

 				<div class="col-lg-4 col-md-6">
 					<!--<a href="<?php echo base_url("service/view_service/" . $service->service_id); ?>" >-->
 					<div class="feature-item" style="padding:0px !important">
 						<img src="<?php echo base_url("assets/uploads/" . $service->service_image); ?>" width="100%" />
 						<div style="margin:5px !important">
 							<h4 style="margin:0px !important"><?php echo $service->service_title; ?></h4>
 							<div class="wow fadeIn" data-wow-duration="1s" data-wow-delay=".1s">
 								<p><?php echo $service->service_summery; ?></p>
 							</div>
 						</div>
 					</div>
 					<!-- </a>-->
 				</div>

 			<?php } ?>






 		</div>
 	</div>
 </section>
 <!-- End Feature Area -->