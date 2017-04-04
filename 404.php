<?php
	/*
	 * This file will generate 404 error page.
	 */	
get_header(); 

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
          
			 <?php echo __('Our blog page', 'crunchpress'); ?> 
                
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
            
            
            				<div class="content-col">
                            
                            <h1 class="heading-404">
								 <?php echo __('404','cp_front_end'); ?>
                             </h1>
                             <h3 class="sub-heading-404">
                                <?php echo __('We are sorry! But the page you were looking for does not exist.','cp_front_end'); ?>
                             </h3>
                                   
							</div>
  		
       
       
            </div>
          </div>
          
            <?php 
			get_sidebar ( 'right' ); 
			?>
          
        </div>
      </div>
    </section>

      
        
<!--content-separator-->
<?php get_footer();?>
