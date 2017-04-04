<?php
/*
 * This file is used to generate WordPress standard archive/category pages.
 */
get_header ();

$item_class=''; 
$item_size=''; 
$item_index=''; 
$num_excerpt='';
$full_content='';
$cp_sidebar_position='';
	
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
	
	/* Thumbnail Size */
	global $sidebar;
		if( $sidebar == "left-sidebar" || $sidebar == "right-sidebar" ){
			$item_size = "850x250";
		}else if( $sidebar == "both-sidebar" ){
			$item_size = "560x200";
		}else{
			$item_size = "1144x350";
		} 

		global $post;

?>
<div id="main"> 
    <!--Inner Heading Start-->
    <section class="inner-heading">
      <div class="container">
        <div class="left-box">
          <h1>
          
			<?php if (is_category()) { ?>
                <?php _e('Categories', 'crunchpress'); ?> : <?php echo single_cat_title(); ?>  
                <?php } elseif (is_day()) { ?>
                <?php _e('Archive for', 'crunchpress'); ?> <?php the_time('F jS, Y'); ?>
                <?php } elseif (is_month()) { ?>
                <?php _e('Archive for', 'crunchpress'); ?> <?php the_time('F, Y'); ?>
                <?php } elseif (is_year()) { ?>
                <?php _e('Archive for', 'crunchpress'); ?> <?php the_time('Y'); ?>
                <?php } elseif (is_author()) { ?>
                <?php _e('Archive by Author', 'crunchpress'); ?>
                <?php } elseif (is_search()) { ?>
                <?php _e('Search results for', 'crunchpress'); ?><?php get_search_query() ?>
                <?php } elseif (is_tag()) { ?>
                <?php _e('Tag Archives', 'crunchpress'); ?> : <?php echo single_tag_title('', true); ?>
            <?php } ?>
                
          </h1>
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
								print_feature_medium ( $item_class, $item_size, $item_index, $num_excerpt );
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