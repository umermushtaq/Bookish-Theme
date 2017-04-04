
	<?php  //CP_EXTRA_FUNCTIONS_CALL(); ?>
 
 
 
 
 
<footer id="footer"> 
      <!--Newsletter Section Start-->
              <?php cp_feedburner(); ?>
      <!--Newsletter Section End--> 
      
      <!--Footer Bottom Section Start-->
      <section class="footer-bottom-section">
        <div class="container">
          <div class="row-fluid">
            <div class="span6">
              <nav>
                <?php
					$defaults = array(
						'theme_location'  => '',
						'menu'            => 'Footer Navigation',
						'echo'            => true,
						'menu_class'      => 'footer-nav',	
						'fallback_cb'     => 'wp_page_menu',
						'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s</ul>',
						'depth'           => 0,
						'walker'          => ''
					);
					wp_nav_menu( $defaults );
				?>
              </nav>
            </div>
            <div class="span6"> <?php CP_COPYRIGHT(); ?></div>
          </div>
        </div>
      </section>
<!--Footer Bottom Section End--> 
</footer>
 
 
<noscript>
 <style type="text/css" scoped>
        #socialicons>a span { top: 0px; left: -100%; -webkit-transition: all 0.3s ease; -moz-transition: all 0.3s ease-in-out; -o-transition: all 0.3s ease-in-out; -ms-transition: all 0.3s ease-in-out; transition: all 0.3s 	ease-in-out;}
        #socialicons>ahover div{left: 0px;}
 </style>
</noscript>
    
<script type="text/javascript">
	  
	<?php /*if(is_single() or is_archive() or is_category() or is_tag() or is_search() or is_404() or !is_front_page()) :  else: ?>	
	 jQuery(document).ready(function () {
		jQuery('#side_navigation li a').click(function(e) {
			e.preventDefault();
			jQuery('a').removeClass('active');
			jQuery(this).addClass('active');
		});
	});
	<?php endif;*/ ?>
</script>

 <?php wp_footer(); ?>

</body>
</html>