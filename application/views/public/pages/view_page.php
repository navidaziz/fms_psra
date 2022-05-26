
<!-- Start Banner Area -->
	<section class="banner-area relative">
		<div class="container">
			<div class="row d-flex align-items-center justify-content-center">
				<div class="about-content col-lg-12">
					<h1 class="text-white">
							<?php echo $title; ?>
					</h1>
					<p><?php echo $pages[0]->page_content; ?></p>
					<div class="link-nav">
						<span class="box">
                        <a href="<?php echo base_url(); ?>"><i class="fa fa-home fa-lg"></i> Home</a> <i class="lnr lnr-arrow-right"></i>
    <a href="#"><?php echo $title; ?></a> 
						
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


<section class="post-content-area single-post-area">
		<div class="container">
			<div class="row">
				<div class="col-lg-8 posts-list">
					<div class="single-post row">
                    
						
                        
                        
                        <?php foreach($page_contents as $page_content): ?>
						<div class="col-lg-12 col-md-12 ">
                        <h3 style="margin:5px !important"><?php echo $page_content->page_content_title; ?></h3>
							<div class="feature-img">
								<img class="img-fluid" src="<?php echo base_url("assets/uploads/".$page_content->attachment); ?>" alt="<?php echo $page_content->page_content_title; ?>"> 
							</div>
							
                            <h4 style="margin:5px !important"><?php echo $page_content->page_content_sub_title; ?></h4>
							<p class="excert">
								<?php echo $page_content->page_content_detail; ?>
							</p>
							
						</div>
                        <?php endforeach; ?>
                        
					</div>
                    
				</div>
                 <?php $this->load->view(PUBLIC_DIR."components/side_bar"); ?>
				
			</div>
		</div>
	</section>
















