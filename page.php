<?php
/*
 * This file is used to generate WordPress standard archive/category pages.
 */
get_header ();

$item_class =''; 
$item_size =''; 
$item_index =''; 
$num_excerpt ='';
$full_content = '';
$cp_sidebar_position = '';


		
		$sidebar = get_post_meta ( $post->ID, 'page-option-sidebar-template', true );
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
        	$left_sidebar = get_post_meta ( $post->ID, "page-option-choose-left-sidebar", true );
			$right_sidebar = get_post_meta ( $post->ID, "page-option-choose-right-sidebar", true );

		global $post;
?>
<div id="main"> 
    <!--Inner Heading Start-->
    <section class="inner-heading">
      <div class="container">
        <div class="left-box">
          <h1>
              <?php echo get_the_title($post->ID); ?>  
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
								
								// Page title and content
								$cp_show_title = get_post_meta ( $post->ID, 'page-option-show-title', true );
								$cp_show_content = get_post_meta ( $post->ID, 'page-option-show-content', true );
								if ($cp_show_title != "No") {
									while ( have_posts () ) {
										the_post ();

											if (! empty ( $cp_page_xml )) {
													$page_xml_val = new DOMDocument ();
													$page_xml_val->loadXML ( $cp_page_xml );
													
											foreach ( $page_xml_val->documentElement->childNodes as $item_xml ) {
													$page_title = ($item_xml->nodeName);
													}
											}

										$content = get_the_content ();

										if ($cp_show_content != 'No' && ! empty ( $content )) {

											echo '<div class="cp-page-content">';

											the_content ();
											wp_link_pages ( array ('before' => '<div class="page-link"><span>' . __ ( 'Pages:', 'cp_front_end' ) . '</span>', 'after' => '</div>' ) );
											
											echo '</div>';
											echo '<div class="clear"></div>';
										}
									}
								} else {
									while ( have_posts () ) {
										the_post ();

										$content = get_the_content ();

										if ($cp_show_content != 'No' && ! empty ( $content )) {

											echo '<div class="cp-page-content">';
											the_content ();
											echo '</div>';
										}
									}

								}

								$cp_page_xml1 = get_post_meta($post->ID,'page-option-item-xml', true);

								// Page Item Part

								if (! empty ( $cp_page_xml1 )) {
									
									$page_xml_val = new DOMDocument ();
									$page_xml_val->loadXML ( $cp_page_xml1 );
									
									foreach ( $page_xml_val->documentElement->childNodes as $item_xml ) {
				
										switch ($item_xml->nodeName) {
											case 'Accordion' :
												print_item_size ( find_xml_value ( $item_xml, 'size' ) );
												print_accordion_item ( $item_xml );
												break;
											case 'Blog' :
												print_item_size ( find_xml_value ( $item_xml, 'size' ));
												print_blog_item ( $item_xml );
												break;
											case 'Contact-Form' :
												print_item_size ( find_xml_value ( $item_xml, 'size' ), 'mt0' );
												print_contact_form ( $item_xml );
												break;
											case 'Column' :
												print_item_size ( find_xml_value ( $item_xml, 'size' ) );
												print_column_item ( $item_xml );
												break;
											case 'Content' :
												print_item_size ( find_xml_value ( $item_xml, 'size' ) );
												print_content_item ( $item_xml );
												break;
											case 'Divider' :
												print_item_size ( find_xml_value ( $item_xml, 'size' ), 'wrapper' );
												print_divider ( $item_xml );
												break;
											case 'Gallery' :
												print_item_size ( find_xml_value ( $item_xml, 'size' ),'wrapper');
												print_gallery_item ( $item_xml );
												break;
											case 'Message-Box' :
												print_item_size ( find_xml_value ( $item_xml, 'size' ) );
												print_message_box ( $item_xml );
												break;
											case 'Page' :
												print_item_size ( find_xml_value ( $item_xml, 'size' ), 'wrapper cp-portfolio-item mt0' );
												print_page_item ( $item_xml );
												break;
											case 'Price-Item' :
												print_item_size ( find_xml_value ( $item_xml, 'size' ), 'cp-price-item' );
												print_price_item ( $item_xml );
												break;
											case 'Slider' :
												print_item_size ( find_xml_value ( $item_xml, 'size' ), 'mt20' );
												print_slider_item ( $item_xml );
												break;
											case 'Text-Widget' :
												print_item_size ( find_xml_value ( $item_xml, 'size' ), 'mt0' );
												print_text_widget ( $item_xml );
												break;
											case 'Tab' :
												print_item_size ( find_xml_value ( $item_xml, 'size' ) );
												print_tab_item ( $item_xml );
												break;
											//case 'Reviews' :
											//	print_item_size ( find_xml_value ( $item_xml, 'size' ));
											//	print_reviews ( $item_xml );
												break;
											case 'Toggle-Box' ;
												print_item_size ( find_xml_value ( $item_xml, 'size' ) );
												print_toggle_box_item ( $item_xml );
												break;
											default :
												print_item_size ( find_xml_value ( $item_xml, 'size' ) );
												break;
												
											/// Title Element
											case 'Title-Element' :
												//print_item_size ( find_xml_value ( $item_xml, 'size' ) );
												print_title_element ( $item_xml );
												break;
											///////////////
											/// Text Box Element
											case 'Text-Box' :
												print_item_size ( find_xml_value ( $item_xml, 'size' ) );
												print_text_box ( $item_xml );
												break;
											///////////////
											/// Feature Element
											case 'Feature' :
												print_item_size ( find_xml_value ( $item_xml, 'size' ) );
												print_feature ( $item_xml );
												break;
											///////////////
											/// Bx Slider Element
											case 'Bx-Slider' :
												//print_item_size ( find_xml_value ( $item_xml, 'size' ) );
												print_top_bx_slider ( $item_xml );
												break;
											///////////////
											/// About Author Element
											case 'About-Author' :
												//print_item_size ( find_xml_value ( $item_xml, 'size' ) );
												print_about_author ( $item_xml );
												break;
											//////////////
											/// About Author Element
											case 'Scroll-Gallery' :
												//print_item_size ( find_xml_value ( $item_xml, 'size' ) );
												print_scrollgallery ( $item_xml );
												break;
											///////////////
											/// About Author Element
											case 'Mobile-Ready-Item' :
												//print_item_size ( find_xml_value ( $item_xml, 'size' ) );
												print_mobileready ( $item_xml );
												break;
											///////////////
											/// About Author Element
											case 'Quote-Box' :
												//print_item_size ( find_xml_value ( $item_xml, 'size' ) );
												print_quote_box ( $item_xml );
												break;
											///////////////
											/// Book Info Element
											case 'Book-Info' :
												print_item_size ( find_xml_value ( $item_xml, 'size' ) );
												print_book_info ( $item_xml );
												break;
											///////////////
											/// Book Info Element
											case 'Quick-View' :
												//print_item_size ( find_xml_value ( $item_xml, 'size' ) );
												print_quick_view ( $item_xml );
												break;
											///////////////
											/// Book Info Element
											case 'Reviews' :
												//print_item_size ( find_xml_value ( $item_xml, 'size' ) );
												print_reviews_home ( $item_xml );
												break;
											///////////////

										}
										echo "</article>";
									}
								}
                            ?>		
					 
            </div>
          </div>
          
            <?php get_sidebar ( 'right' ); ?>
          
        </div>
      </div>
    </section>

<?php get_footer(); ?>