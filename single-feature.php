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


		
		$sidebar = get_post_meta ( $post->ID, 'post-option-sidebar-template', true );
        $sidebar_class = '';
        if ($sidebar == "left-sidebar" || $sidebar == "right-sidebar") {
            $sidebar_class = "sidebar-included " . $sidebar;
			$container_class = "span8";
        } else if ($sidebar == "both-sidebar") {
            $sidebar_class = "both-sidebar-included";
			 $bcontainer_class ="span8";
			 $container_class = "span6";
        } else {
		    $container_class = "span12";	
			$sidebar_class = "no-sidebar";
		}
        	$left_sidebar = get_post_meta ( $post->ID, "post-option-choose-left-sidebar", true );
			$right_sidebar = get_post_meta ( $post->ID, "post-option-choose-right-sidebar", true );

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
            $left_sidebar = get_post_meta( $post->ID , "post-option-choose-left-sidebar", true);
            $right_sidebar = get_post_meta( $post->ID , "post-option-choose-right-sidebar", true);
            global $default_post_left_sidebar, $default_post_right_sidebar;
            if( empty( $left_sidebar )){ $left_sidebar = $default_post_left_sidebar; } 
            if( empty( $right_sidebar )){ $right_sidebar = $default_post_right_sidebar; } 

            get_sidebar('left');
            ?>                
                    
          <div class="<?php echo esc_attr($container_class);?>">
            <div id="content">
            
                             <?php print_feature_single_full(); ?>		
					 
            </div>
          </div>
          
            <?php get_sidebar ( 'right' ); ?>
          
        </div>
      </div>
    </section>

<?php get_footer(); ?>