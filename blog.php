<?php 
/* Template Name: Blog */
get_header(); 
?>

	<?php
		// Sidebar check and class
		$sidebar = get_option ( THEME_NAME_S . '_search_archive_sidebar', 'no-sidebar' );
	$left_sidebar = "Search/Archive Left Sidebar";
	$right_sidebar = "Search/Archive Right Sidebar";
	 get_option( 'date_format' );
		$sidebar_class = '';
	if ($sidebar == "left-sidebar" || $sidebar == "right-sidebar") {
		$sidebar_class = "sidebar-included " . $sidebar;
		$container_class = "span8";
	} else if ($sidebar == "both-sidebar") {
		$sidebar_class = "both-sidebar-included";
		 $bcontainer_class ="span8";
		 $container_class = "span8";
	} else {
		$container_class = "span12";	
	}
	?>






<div id="main"> 
    <!--Inner Heading Start-->
    <section class="inner-heading">
      <div class="container">
        <div class="left-box">
          <h1><?php echo __('Our blog page', 'crunchpress'); ?></h1>
          <div class="breadcrumbs"> <strong class="title"><?php echo __('You are here:', 'crunchpress'); ?></strong>
            <ul>
             	 <?php cp_breadcrumbs(); ?>
            </ul>
          </div>
        </div>
        
        <?php print_social(); ?>
        
      </div>
    </section>
    <!--Inner Heading End-->
    <section class="content-area">
      <div class="container">
        <div class="row-fluid <?php echo esc_attr($sidebar_class);?>">
        
        	<?php
            
            get_sidebar('left');
            ?>       
                    
         <div class="<?php echo esc_attr($container_class);?>">
            <div id="content">
            

                            <?php
								$item_type = get_option ( THEME_NAME_S . '_search_archive_item_size', '1/1 Full Thumbnail' );
								$num_excerpt = get_option ( THEME_NAME_S . '_search_archive_num_excerpt', 200 );
								$full_content = get_option ( THEME_NAME_S . '_search_archive_full_blog_content', 'No' );
								
									if ($item_type == '1/1 Full Thumbnail') {
										print_blog_page_full ( $item_class, $item_size, $item_index, $num_excerpt, $full_content );
									} else if ($item_type == '1/1 Medium Thumbnail') {
										print_blog_medium ( $item_class, $item_size, $item_index, $num_excerpt );
									}
							 ?>
                           
						
					 <!--Pagination Start-->
              <div class="pagination-box">
                <div class="pagination pagination-centered">
                  <ul>
                    <?php if(function_exists('wp_paginate')) {
						  wp_paginate();
						  }
					?>
                  </ul>
                </div>
              </div>
              <!--Pagination End--> 
            </div>
          </div>
          
            <?php get_sidebar('right'); ?>      
          
        </div>
      </div>
    </section>

<?php get_footer(); ?>