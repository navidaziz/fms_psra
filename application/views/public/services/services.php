<!-- Start Banner Area -->
<section class="banner-area relative">
	<div class="container">
		<div class="row d-flex align-items-center justify-content-center">
			<div class="about-content col-lg-12">
				<h1 class="text-white" style="color:black !important">
					<?php echo $title; ?>
				</h1>
				<p style="color:black !important">Darewro is striving to bring the maximum ease in your life by offering you a wide range of services.</p>
				<div class="link-nav">
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








<section class="feature-area">
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