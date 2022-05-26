<?php $this->load->view(PUBLIC_DIR."components/slider_banners"); ?>

<hr>
<div class="big-hr color-1 wow zoomInUp" data-wow-delay="0.3s">
  <div class="text-left" style="margin-right:40px;">
    <p><?php echo $home_page[0]->home_page_content; ?></p>
  </div>
  <div><!--<a class="btn btn-success btn-lg" href="<?php echo site_url("assets/".PUBLIC_DIR); ?>/#"><?php echo $this->lang->line("REQUEST A FREE QUOTE"); ?></a>--></div>
</div>
<style>
    
    .inner-offset {
    padding-top: 5px !important;
    padding-bottom: 5px !important;
}
    
</style>

 
 <div class="fleet-gallery block-content bg-image inner-offset" style="margin:5px !important;">
  <div class="container-fluid inner-offset" style="padding:10px !important">
    <div class="text-center hgroup wow zoomInUp" data-wow-delay="0.3s">
      <h1>Restaurants</h1>
      <h2>Order your favorite food from any restaurant</h2>
    </div>
    <div id="fleet-gallery" class="owl-carousel enable-owl-carousel" data-pagination="false" data-navigation="true" data-min450="2" data-min600="2" data-min768="4">
     <?php foreach($restaurants as $restaurant){ ?>
      <div class="wow rotateIn" data-wow-delay="0.3s">
      <a href="#" >
     	<img src="<?php echo base_url("assets/uploads/".$restaurant->restaurant_logo); ?>"  class="img-responsive img-circle" alt="<?php echo $restaurant->restaurant_name; ?>">
      </a>
      </div>
      <?php } ?>
     </div>
  </div>
</div>
 
 <?php ?>

<div class="container-fluid block-content">
  <div class="text-center hgroup wow zoomInUp" data-wow-delay="0.3s">
    <h1><?php echo $this->lang->line("OUR SERVICES"); ?></h1>
    <h2><?php echo $this->lang->line("OUR SERVICES DETAIL"); ?></h2>
  </div>
  <div class="row our-services">
    <?php foreach($services as $service){ ?>
    <div class="col-sm-6 col-md-4 col-lg-4 wow zoomInLeft" data-wow-delay="0.3s"> <a href="<?php echo base_url("service/view_service/".$service->service_id); ?>" > <span><img  src="<?php echo base_url("assets/uploads/".$service->service_image); ?>" width="50" height="50" /></span>
      <h4><?php echo $service->service_title; ?></h4>
      <p> <?php echo $service->service_summery; ?></p>
      </a> </div>
    <?php } ?>
  </div>
</div>


<div class="container-fluid block-content">
  <div class="row">
    <div class="col-md-6 col-lg-6 wow fadeInLeft" data-wow-delay="0.3s">
      <div class="hgroup">
        <h1><?php echo $this->lang->line("TRUSTED CLIENTS"); ?></h1>
        <h2><?php echo $this->lang->line("TRUSTED CLIENTS DETAIL"); ?></h2>
      </div>
      <div id="testimonials" class="owl-carousel enable-owl-carousel" data-single-item="true" data-pagination="false" data-navigation="true" data-auto-play="true">
        <?php foreach($testimonials as $testimonial): ?>
        <div>
          <div class="testimonial-content"> <span><i class="fa fa-quote-left"></i></span>
            <p><?php echo $testimonial->statement; ?></p>
          </div>
          <div class="text-right testimonial-author">
            <h4><?php echo ucwords($testimonial->client_name); ?></h4>
            <small><?php echo $testimonial->client_designation; ?></small> </div>
        </div>
        <?php endforeach; ?>
      </div>
    </div>
    <div class="col-md-6 col-lg-6 wow fadeInRight" data-wow-delay="0.3s" id="why_choose_us">
      <div class="hgroup">
        <h1><?php echo $this->lang->line("WHY CHOOSE US"); ?></h1>
        <h2><?php echo $this->lang->line("WHY CHOOSE US DETAIL"); ?></h2>
      </div>
      <ul class="why-us">
        <?php foreach($why_choose_us as $why_choose_us): ?>
        <li> <?php echo $why_choose_us->why_choose_us_title; ?>
          <p><?php echo $why_choose_us->why_choose_us_detail; ?></p>
          <span>+</span> </li>
        <?php endforeach; ?>
      </ul>
    </div>
  </div>
</div>
<hr>
