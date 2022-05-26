 <!-- Start Banner Area -->
 <section class="home-banner-area relative">
 	<div class="container">
 		<div class="row">
 			<!--<div class="row fullscreen d-flex align-items-center justify-content-center">-->

 			<div class="banner-content col-lg-8 col-md-12" style="text-align:center !important; margin:0px auto; padding-top:100px !important; padding-bottom:122px !important;">
 				<img id="logo" width="300" title="<?php echo $system_global_settings->system_title; ?> Logo" src="<?php echo base_url("assets/uploads/" . $system_global_settings->sytem_public_logo); ?>" />
 				<!--<h1 class="wow fadeIn" data-wow-duration="4s">We Rank the Best Courses <br> on the Web</h1>-->
 				<!--<p class="text-white" style="color:#000 !important">
						
					</p>
-->
 				<div class="input-wrap">
 					<h3>Call For Delivery</h3>
 					<h1 class="wow fadeIn" data-wow-duration="4s" style="color:#000 !important">(091) 724-1-724</h1>
 					<!--<form action="" class="form-box d-flex justify-content-between">
							<input type="text" placeholder="Search Courses" class="form-control" name="user_title">
							<button type="submit" class="btn search-btn">Search</button>
						</form>-->
 				</div>
 				<h4 class="text-white" style="color:#F00 !important"><span>Working Hours </span>
 					<strong>9:00 AM - 02:00 AM</strong>
 				</h4>

 				<a target="new" href="https://play.google.com/store/apps/details?id=com.darewro&hl=en">
 					<img id="logo" width="300" title="<?php echo $system_global_settings->system_title; ?> Logo" src="<?php echo base_url("assets/uploads/google_play_sote.png"); ?>" /></a>




 				<!--<div class="courses pt-20">
						<a href="#" data-wow-duration="1s" data-wow-delay=".3s" class="primary-btn transparent mr-10 mb-10 wow fadeInDown">Ruby
							on Rails</a>
						<a href="#" data-wow-duration="1s" data-wow-delay=".6s" class="primary-btn transparent mr-10 mb-10 wow fadeInDown">Python</a>
						<a href="#" data-wow-duration="1s" data-wow-delay=".9s" class="primary-btn transparent mr-10 mb-10 wow fadeInDown">Marketing</a>
						<a href="#" data-wow-duration="1s" data-wow-delay="1.2s" class="primary-btn transparent mr-10 mb-10 wow fadeInDown">UI/UX
							Design
						</a>
						<a href="#" data-wow-duration="1s" data-wow-delay="1.5s" class="primary-btn transparent mr-10 mb-10 wow fadeInDown">Android</a>
						<a href="#" data-wow-duration="1s" data-wow-delay="1.8s" class="primary-btn transparent mr-10 mb-10 wow fadeInDown">Data
							Science
						</a>
						<a href="#" data-wow-duration="1s" data-wow-delay="2.1s" class="primary-btn transparent mr-10 mb-10 wow fadeInDown">Cryptocurrency</a>
					</div>-->
 			</div>
 		</div>
 	</div>
 	<div class="rocket-img">
 		<img src="img/roc ket.png" alt="">
 	</div>
 </section>
 <!-- End Banner Area -->


 <!-- Start About Area -->
 <section class="about-area section-gap">
 	<div class="container">
 		<div class="row align-items-center justify-content-center">
 			<div class="col-lg-5 col-md-6 about-left">
 				<img class="img-fluid" src="<?php echo site_url("assets/" . PUBLIC_DIR); ?>/img/about.jpg" alt="">
 			</div>
 			<div class="offset-lg-1 col-lg-6 offset-md-0 col-md-12 about-right">
 				<h1>
 					Use Over Mobile App
 				</h1>
 				<div class="wow fadeIn" data-wow-duration="1s">
 					<p>
 						A delivery service right in your pocket. We have made it too easy for you to place your order and receive your delivery via a user-friendly mobile app.
 					</p>
 				</div>
 				<a target="new" href="https://play.google.com/store/apps/details?id=com.darewro&hl=en" class="primary-btn">Download Now</a>
 			</div>
 		</div>
 	</div>
 </section>
 <!-- End About Area -->


 <!-- Start Courses Area -->
 <section class="courses-area section-gap" style="padding-top:50px !important">
 	<div class="container">
 		<div class="row align-items-center">


 			<div class="col-lg-12">
 				<h1>
 					Restaurants
 				</h1>
 				<p><em>You can now order from almost any restaurant in the city. We've made it so easy, you can now enjoy your time in activities you love the most and still eat great!</em></p>
 				<div class="courses-right">
 					<div class="row">
 						<?php foreach ($restaurants as $restaurant) { ?>
 							<div class="col-md-3">
 								<div class="courses-list" style="text-align: center !important">
 									<a class="wow fadeInLeft" href="#" data-wow-duration="1s" data-wow-delay=".1s">
 										<img style="
    height: 100px;
    width: 100px;
    border-radius: 50px;
    margin: 20px;
    -webkit-box-shadow: 2px 2px 5px 0px rgba(0, 0, 0, 1);
    -moz-box-shadow: 2px 2px 5px 0px rgba(0, 0, 0, 1);
    box-shadow: 2px 2px 5px 0px rgba(0, 0, 0, 1);" src="<?php echo base_url("assets/uploads/" . $restaurant->restaurant_logo); ?>" class="img-responsive img-circle" alt="<?php echo $restaurant->restaurant_name; ?>" width="70" height="70" />
 									</a>
 									<br />
 									<?php echo $restaurant->restaurant_name; ?>
 								</div>
 							</div>

 						<?php } ?>



 					</div>
 				</div>
 			</div>
 		</div>
 	</div>
 </section>
 <!-- End Courses Area -->


 <!--Start Feature Area -->
 <section class="feature-area">
 	<div class="container">
 		<div class="row justify-content-center">
 			<div class="col-lg-8">
 				<div class="section-title text-center">
 					<h1>Darewro Services</h1>
 					<p>
 						Darewro is striving to bring the maximum ease in your life by offering you a wide range of services.
 					</p>
 				</div>
 			</div>
 		</div>
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


 <!-- Start Faculty Area -->
 <section class="faculty-area section-gap">
 	<div class="container">
 		<div class="row justify-content-center">
 			<div class="col-lg-8">
 				<div class="section-title text-center">
 					<h1>Why Choose us</h1>
 					<p>
 						Our story is straightforward; we believe in empowering our customers by enabling them to do more, feel better and live happier. We also believe that services delivery must be a hassle-free and exciting process. We aim to transform the everyday experiences of businesses on how to send and receive their goods and also empowering them by expanding horizon of customers for them. We are also empowering them via our state-of-the-art technology.
 					</p>
 				</div>
 			</div>
 		</div>
 		<div class="row justify-content-center d-flex align-items-center">

 			<?php foreach ($why_choose_us as $why_choose_us) : ?>


 				<div class="col-lg-6 col-md-6 col-sm-12 single-faculty" style="margin-bottom:5px !important">
 					<div class="thumb d-flex justify-content-center">
 						<img class="img-fluid" src="img/faculty/f1.jpg" alt="">
 					</div>
 					<div class="meta-text text-center">
 						<h4><?php echo $why_choose_us->why_choose_us_title; ?></h4>
 						<div class="info wow fadeIn" data-wow-duration="1s" data-wow-delay=".1s">
 							<details>
 								<summary>Reade More....</summary>
 								<p><?php echo $why_choose_us->why_choose_us_detail; ?></p>
 							</details>

 						</div>

 					</div>
 				</div>


 			<?php endforeach; ?>






 		</div>
 	</div>
 </section>
 <!-- End Faculty Area -->

 <?php if (count($testimonials) >= 2) { ?>
 	<!-- Start Testimonials Area -->
 	<section class="testimonials-area section-gap">
 		<div class="container">
 			<div class="testi-slider owl-carousel" data-slider-id="1">
 				<?php foreach ($testimonials as $testimonial) : ?>
 					<div class="item">
 						<div class="testi-item">
 							<img src="img/quote.png" alt="">
 							<h4><?php echo ucwords($testimonial->client_name); ?> <small><?php echo $testimonial->client_designation; ?></small></h4>

 							<ul class="list">
 								<li><a href="#"><i class="fa fa-star"></i></a></li>
 								<li><a href="#"><i class="fa fa-star"></i></a></li>
 								<li><a href="#"><i class="fa fa-star"></i></a></li>
 								<li><a href="#"><i class="fa fa-star"></i></a></li>
 								<li><a href="#"><i class="fa fa-star"></i></a></li>
 							</ul>
 							<div class="wow fadeIn" data-wow-duration="1s">
 								<p>
 									<?php echo $testimonial->statement; ?>
 								</p>
 							</div>
 						</div>
 					</div>
 				<?php endforeach; ?>




 			</div>
 			<!--<div class="owl-thumbs d-flex justify-content-center" data-slider-id="1">
				<div class="owl-thumb-item">
					<div>
						<img class="img-fluid" src="img/testimonial/t1.jpg" alt="">
					</div>
					<div class="overlay overlay-grad"></div>
				</div>
				<div class="owl-thumb-item">
					<div>
						<img class="img-fluid" src="img/testimonial/t2.jpg" alt="">
					</div>
					<div class="overlay overlay-grad"></div>
				</div>
				<div class="owl-thumb-item">
					<div>
						<img class="img-fluid" src="img/testimonial/t3.jpg" alt="">
					</div>
					<div class="overlay overlay-grad"></div>
				</div>
				<div class="owl-thumb-item">
					<div>
						<img class="img-fluid" src="img/testimonial/t4.jpg" alt="">
					</div>
					<div class="overlay overlay-grad"></div>
				</div>
			</div>-->
 		</div>
 	</section>
 <?php } ?>
 <!-- End Testimonials Area -->