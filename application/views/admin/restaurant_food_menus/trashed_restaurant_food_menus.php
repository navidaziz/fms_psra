<!-- PAGE HEADER-->
<div class="row">
	<div class="col-sm-12">
		<div class="page-header">
			<!-- STYLER -->
			
			<!-- /STYLER -->
			<!-- BREADCRUMBS -->
			<ul class="breadcrumb">
				<li>
					<i class="fa fa-home"></i>
					<a href="<?php echo site_url(ADMIN_DIR.$this->session->userdata("role_homepage_uri")); ?>"><?php echo $this->lang->line('Home'); ?></a>
				</li><li>
				<i class="fa fa-table"></i>
				<a href="<?php echo site_url(ADMIN_DIR."restaurant_food_menus/view/"); ?>"><?php echo $this->lang->line('Restaurant Food Menus'); ?></a>
                
			</li>
            
            <li><?php echo $title; ?></li>
			</ul>
			<!-- /BREADCRUMBS -->
            <div class="row">
                        
                <div class="col-md-6">
                    <div class="clearfix">
					  <h3 class="content-title pull-left"><?php echo $title; ?></h3>
					</div>
					<div class="description"><?php echo $title; ?></div>
                </div>
                
                <div class="col-md-6">
                    <div class="pull-right">
                        <a class="btn btn-primary btn-sm" href="<?php echo site_url(ADMIN_DIR."restaurant_food_menus/add"); ?>"><i class="fa fa-plus"></i> <?php echo $this->lang->line('New'); ?></a>
                        <a class="btn btn-danger btn-sm" href="<?php echo site_url(ADMIN_DIR."restaurant_food_menus/trashed"); ?>"><i class="fa fa-trash-o"></i> <?php echo $this->lang->line('Trash'); ?></a>
                    </div>
                </div>
                
            </div>
            
			
		</div>
	</div>
</div>
<!-- /PAGE HEADER -->

<!-- PAGE MAIN CONTENT -->
<div class="row">
		<!-- MESSENGER -->
	<div class="col-md-12">
	<div class="box border blue" id="messenger">
		<div class="box-title">
			<h4><i class="fa fa-bell"></i> <?php echo $title; ?></h4>
		</div><div class="box-body">
			
            <div class="table-responsive">
                
                    <table class="table table-table-bordered">
						<thead>
						  <tr>
							<th><?php echo $this->lang->line('restaurant_food_name'); ?></th>
<th><?php echo $this->lang->line('restaurant_food_price'); ?></th>
<th><?php echo $this->lang->line('restaurant_food_quantity'); ?></th>
<th><?php echo $this->lang->line('restaurant_food_description'); ?></th>
<th><?php echo $this->lang->line('restaurant_food_image'); ?></th>
<th><?php echo $this->lang->line('restaurant_food_category'); ?></th>
<th><?php echo $this->lang->line('restaurant_name'); ?></th>
                            <th><?php echo $this->lang->line('Action'); ?></th>
						  </tr>
						</thead>
						<tbody>
					  <?php foreach($restaurant_food_menus as $restaurant_food_menu): ?>
                         <tr>
                            
                            
            <td>
                <?php echo $restaurant_food_menu->restaurant_food_name; ?>
            </td>
            <td>
                <?php echo $restaurant_food_menu->restaurant_food_price; ?>
            </td>
            <td>
                <?php echo $restaurant_food_menu->restaurant_food_quantity; ?>
            </td>
            <td>
                <?php echo $restaurant_food_menu->restaurant_food_description; ?>
            </td>
            <td>
            <?php
                echo file_type(base_url("assets/uploads/".$restaurant_food_menu->restaurant_food_image));
            ?>
            </td>
            <td>
                <?php echo $restaurant_food_menu->restaurant_food_category; ?>
            </td>
            <td>
                <?php echo $restaurant_food_menu->restaurant_name; ?>
            </td>
                            
                            <td>
                                <a class="llink llink-view" href="<?php echo site_url(ADMIN_DIR."restaurant_food_menus/view_restaurant_food_menu/".$restaurant_food_menu->restaurant_food_menu_id."/".$this->uri->segment(3)); ?>"><i class="fa fa-eye"></i> </a>
                                <a class="llink llink-restore" href="<?php echo site_url(ADMIN_DIR."restaurant_food_menus/restore/".$restaurant_food_menu->restaurant_food_menu_id."/".$this->uri->segment(3)); ?>"><i class="fa fa-undo"></i></a>
                                <a class="llink llink-delete" href="<?php echo site_url(ADMIN_DIR."restaurant_food_menus/delete/".$restaurant_food_menu->restaurant_food_menu_id."/".$this->uri->segment(3)); ?>"><i class="fa fa-times"></i></a>
                            </td>
                         </tr>
                      <?php endforeach; ?>
						</tbody>
					  </table>
                      <?php echo $pagination; ?>

            </div>
			
			
		</div>
		
	</div>
	</div>
	<!-- /MESSENGER -->
</div>
