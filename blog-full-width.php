<?php get_header();
/* Template Name: Blog FullWidth */
 ?>

	<?php
		// Sidebar check and class
		$sidebar = get_post_meta($post->ID,'post-option-sidebar-template',true);
		global $default_post_sidebar;
		if( empty( $sidebar ) ){ $sidebar = $default_post_sidebar; }
		if( $sidebar == "left-sidebar" || $sidebar == "right-sidebar"){
			$sidebar_class = "sidebar-included " . $sidebar;
		}else if( $sidebar == "both-sidebar" ){
			$sidebar_class = "both-sidebar-included";
		}else{
			$sidebar_class = '';
		}
	?>

<!-- Start Inner Page Holder -->
		<section id="inner-page-holder">
		<!-- Start Inner Page Title Bar -->
			<section id="title-bar" class="content-col">
				<section class="container-fluid container">
					<section class="row-fluid">
						<article class="span8">
							<h2> <?php echo __('Our blog page', 'crunchpress'); ?> </h2>
							<p id="breadcrumb"><span> <?php echo __('You are here:', 'crunchpress'); ?> </span>  <?php cp_breadcrumbs(); ?> </p>
						</article>
						
                        <?php print_social(); ?>
                        
					</section>
				</section>
			</section>
		<!-- End Inner Page Title Bar -->
		
		<!-- Start Inner Main Content Holder -->
			<section id="col-holder">
				<section class="container-fluid container">
					<section class="row-fluid">
                                       
                      
						<article class="span12">
							<div class="content-col">
                            
                             <?php
								$item_type = get_option ( THEME_NAME_S . '_search_archive_item_size', '1/1 Full Thumbnail' );
								$num_excerpt = get_option ( THEME_NAME_S . '_search_archive_num_excerpt', 200 );
								$full_content = get_option ( THEME_NAME_S . '_search_archive_full_blog_content', 'No' );
								
									if ($item_type == '1/1 Full Thumbnail') {
										print_blog_full ( $item_class, $item_size, $item_index, $num_excerpt, $full_content );
									} else if ($item_type == '1/1 Medium Thumbnail') {
										print_blog_medium ( $item_class, $item_size, $item_index, $num_excerpt );
									}
							 ?>
                                
                                    <div class="default-pagination">
										<ul>
											<?php if(function_exists('wp_paginate')) {
												  wp_paginate();
												  }
											?>
										</ul>
									</div>
							</div>
                           
                                
						</article>
                        
                        
                    
                       
						
					</section>
				</section>
			</section>
		<!-- End Inner Main Content Holder -->
		
		</section>
<!-- End Inner Page Holder -->

<?php get_footer(); ?>