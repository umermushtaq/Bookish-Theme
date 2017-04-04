<?php
/*
 * This file is used to generate main index page.
 */
get_header ();
/*
Template Name: Bookish Home
*/
?>

  
    	<?php			
			 
			$menu_to_display = get_theme_mod('nav_menu_locations');
			$menu_display_id_varible = array_chunk($menu_to_display, 1);
			$selected_menu_id = $menu_display_id_varible[0][0];
		?>
     
       <?php
	   				
					$args = array(
									'order'                  => 'ASC',
									'orderby'                => 'menu_order',
									'post_type'              => 'nav_menu_item',
									'post_status'            => 'publish',
									'update_post_term_cache' => false );
					$items = wp_get_nav_menu_items( $selected_menu_id, $args );
		
		
		global $cp_top_slider_type, $cp_top_slider_xml;
		 
		?>
        
        	<section  id="home">
        	<section id="main_slider" <?php if( $cp_top_slider_type == 'Layer Slider' ){ ?> style="padding-top:90px; padding-bottom:0px;" <?php } ?>>
        
             
             <?php
				// Top Slider Part
				//global $cp_top_slider_type, $cp_top_slider_xml;
				if( $cp_top_slider_type == 'Layer Slider' ){
					$layer_slider_id = get_post_meta( $post->ID, 'page-option-layer-slider-id', true);
					//echo $layer_slider_id;
					echo '<div class="slider-wrapper">';
					echo '<section class="slider-container">';
					echo do_shortcode('[layerslider id="' . $layer_slider_id . '"]');									    
					echo '</section>';
					echo '</div>';
				}else if( $cp_top_slider_type == 'Bx Slider' ){
                    print_top_bx_slider($cp_page_xml1);             		
				}else if ($cp_top_slider_type != "No Slider" && $cp_top_slider_type != '') {
					echo '<section class="slider-wrapper top-slider">';
					$slider_xml = "<Slider>" . create_xml_tag ( 'size', 'full-width' );
					$slider_xml = $slider_xml . create_xml_tag ( 'height', get_post_meta ( $post->ID, 'page-option-top-slider-height', true ) );
					$slider_xml = $slider_xml . create_xml_tag ( 'width', 960 );
					$slider_xml = $slider_xml . create_xml_tag ( 'slider-type', $cp_top_slider_type );
					$slider_xml = $slider_xml . $cp_top_slider_xml;
					$slider_xml = $slider_xml . "</Slider>";
					$slider_xml_dom = new DOMDocument ();
					$slider_xml_dom->loadXML ( $slider_xml );
					print_slider_item ( $slider_xml_dom->documentElement );
					echo '</section>';
				  }
			?>
            
            </section>    
            </section>   
       
       
       
        <div id="main">
             
        <?php		
					wp_reset_query();	
					if ( !empty( $selected_menu_id ) && $selected_menu_id != 'none' ):
		?>
        
        			
		<?php			
					foreach($items as $key => $menu_item):
						$page = $menu_item->object_id;
						$all_pages = new WP_Query(array('page_id' => ''. $menu_item->object_id .'', 'order' => 'ASC', 'orderby' => 'menu_order', 'posts_per_page' => -1));					
						while ($all_pages->have_posts()) : $all_pages->the_post();
						global $post;
						$page_id_name = strtolower($menu_item->title);
						$page_list_id = str_replace(' ', '_', $page_id_name);
						
						$cp_show_fullwidth_section = get_post_meta ( $post->ID, 'page-option-fullwidth', true );
						$cp_show_header_section_type = get_post_meta ( $post->ID, 'page-option-header-section-type', true );
						$cp_show_header_section = get_post_meta ( $post->ID, 'page-option-header-section', true );
						$cp_show_header_section_title = get_post_meta ( $post->ID, 'page-option-header-title', true );
						$cp_show_header_section_description = get_post_meta ( $post->ID, 'page-option-header-title-description', true );
						
		?> 								
        				
                         <?php if( $cp_show_header_section == 'Yes' ){ ?>
                        	 <section class="sec-head">
                              <section class="<?php if( $cp_show_header_section_type == 'Solid Background' ){ echo 'solid-head'; } else if( $cp_show_header_section_type == 'Parallax' ){ echo 'parallax'; }?> slide" id="slide1" data-slide="1" data-stellar-background-ratio="0.5"> 
                              	<strong class="title"> <?php echo $cp_show_header_section_title; ?> </strong>
                              	<strong class="desc"> <?php echo $cp_show_header_section_description; ?></strong>
                             </section>
                            </section>
                             
                             
                        <?php } ?>
                        
						<section id="<?php echo esc_attr($page_list_id); ?>">
                           
                            <?php 
								if( $cp_show_fullwidth_section == 'No' ) {
								echo '<section class="container">';
								echo '<section class="row">';    
								} 
							?>  
                             
                               <?php do_shortcode(the_content()); ?>                               
                               
                               
                               <?php
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
											case 'Product-Home' :
												print_item_size ( find_xml_value ( $item_xml, 'size' ) );
												product_home_element ( $item_xml );
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
												print_item_size ( find_xml_value ( $item_xml, 'size' ), 'row-fluid' );
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
											case 'Toggle-Box' :
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
											///////////////
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
											/// Single Book Product Element
											case 'Single-Product-Element' :
												//print_item_size ( find_xml_value ( $item_xml, 'size' ) );
												print_book_single_product ( $item_xml );
												break;
											///////////////
											
										}
										//echo "</article>";
									}
								}
                            ?>
                  
                <?php 
					if( $cp_show_fullwidth_section == 'No' ) {                                
                    echo '</section>';
                	echo '</section>';
                	} 
				?>
                
             </section> 
						<?php
                        
						endwhile;
					endforeach;
					endif;

	  ?>      
     	</div><!--- Id Main End --->
       
  
<?php get_footer(); ?>