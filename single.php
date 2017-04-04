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
	global $post;
	$sidebar = get_post_meta($post->ID,'post-option-sidebar-template',true);
	global $default_post_sidebar;
	$bcontainer_class = '';
	$sidebar_class = '';
	if( empty( $sidebar ) ){ $sidebar = $default_post_sidebar; }
	  if ($sidebar == "left-sidebar" || $sidebar == "right-sidebar") {
		$sidebar_class = "sidebar-included " . $sidebar;
		$container_class = "span8";
	} else if ($sidebar == "both-sidebar") {
		$sidebar_class = "both-sidebar-included";
		 $bcontainer_class ="span9";
		 $container_class = "span6";
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
			$default_post_left_sidebar = 'Search/Archive Left Sidebar';
			$default_post_right_sidebar = 'Search/Archive Right Sidebar';
			if( empty( $left_sidebar )){ $left_sidebar = $default_post_left_sidebar; } 
			if( empty( $right_sidebar )){ $right_sidebar = $default_post_right_sidebar; } 
	
            get_sidebar('left');
			
			$num_excerpt = get_option ( THEME_NAME_S . '_search_archive_num_excerpt', 200 );
            ?>                
                    
          <div class="<?php echo esc_attr($container_class);?>">
            <div id="content">
            
       <?php 
		while (have_posts()){ the_post();
		global $post;


		echo '<!--Photo Post Start-->';
           echo '<div class="post-box">';
                echo '<div class="frame">';
					
					print_blog_thumbnail( get_the_ID(), $item_size );
				
				echo '</div>';
                echo '<div class="text-box">';
                  echo '<div class="date-box"> <strong class="comment"><i class="fa fa-comments-o"></i></strong> <strong class="date"><span>'. get_the_date('M') .'</span>'. get_the_time('j') .'</strong> </div>';
                  echo '<h2><a href="'. get_permalink() .'"> '. get_the_title() .' </a></h2>';
                  
						echo '<p>' ;
						the_content();
						echo '</p>';	
				 
                  echo '<div class="bottom-row">';
                    echo '<ul>';
                      echo '<li>Posted by ';
					  	
							$author = get_the_author_meta('display_name'); 
							echo $author_name = ucwords($author);
					  
					  echo '<span>/</span></li>';
                      echo '<li>';
					  		
							$prefix = '';
							foreach((get_the_category()) as $category) { 
							echo $prefix . '' . $category->cat_name . ''; 
							$prefix = ', ';
							} 
					
					  echo '<span>/</span></li>';
                      echo '<li>';
					  		
							comments_popup_link( __('0 Comments','cp_front_end'),
							__('1 Comment','cp_front_end'),
							__('% Comments','cp_front_end'), '',
							__('Comments are Off','cp_front_end') );
						
					  echo '</li>';
                    echo '</ul>';
                   
					echo '</div>';
					comments_template();
                    
                	echo '</div>';
				echo '</div>';
              echo '</div>';
        echo '<!--Photo Post End--> ';

		
		}					 
		?>		
					 
            </div>
          </div>
          
            <?php 
			get_sidebar ( 'right' ); 
			?>
          
        </div>
      </div>
    </section>

<?php get_footer(); ?>