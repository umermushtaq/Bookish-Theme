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
								$item_size='';
								$num_excerpt='';
								$full_content='';
								$item_xml='';
								$category_id='';
		
								$item_type = get_option ( THEME_NAME_S . '_search_archive_item_size' );
								$num_excerpt = get_option ( THEME_NAME_S . '_search_archive_num_excerpt' );
								$full_content = get_option ( THEME_NAME_S . '_search_archive_full_blog_content' );
								
								if( $full_content == 'Yes' ){
									global $more;
									$more = 0;
								}
								global $paged;
								
								if(empty($paged)){
									$paged = (get_query_var('paged')) ? get_query_var('paged') : 1; 
								}
								
								while (have_posts()){ the_post();
								global $post;
								
								echo '<!--Photo Post Start-->';
								   echo '<div class="post-box">';
										echo '<div class="frame"><a href="'. get_permalink() .'">';
											
											print_blog_thumbnail( get_the_ID(), $item_size );
										
										echo '</a></div>';
										echo '<div class="text-box">';
										  echo '<div class="date-box"> <strong class="comment"><i class="fa fa-comments-o"></i></strong> <strong class="date"><span>'. get_the_date('M') .'</span>'. get_the_time('j') .'</strong> </div>';
										  echo '<h2><a href="'. get_permalink() .'"> '. get_the_title() .' </a></h2>';
										 
													echo '<p>';
													echo mb_substr( get_the_excerpt(), 0, $num_excerpt ) ; 
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
											echo '<a href="'. get_permalink() .'" class="readmore">'.  __('Read More','cp_front_end') .'</a> </div>';
										echo '</div>';
									  echo '</div>';
								echo '<!--Photo Post End--> ';
								
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
          
            <?php 
			get_sidebar ( 'right' ); 
			?>
          
        </div>
      </div>
    </section>

<?php get_footer(); ?>