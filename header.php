<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes(); ?>>
  <head>
  	<meta charset="<?php bloginfo( 'charset' ); ?>" />
    <title><?php wp_title( ' - ', true, 'left' ); ?></title>
    <meta http-equiv="cache-control" content="no-cache">
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <meta name="viewport" content="initial-scale=1, maximum-scale=1">
    <meta name="viewport" content="width=device-width">
    <link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>" type="text/css" />
	
    <?php

		/**
		* Enqueue the Open Sans font.
		*/

		function mytheme_fonts() {
		$protocol = is_ssl() ? 'https' : 'http';
		wp_enqueue_style( 'mytheme-raleway', "$protocol://fonts.googleapis.com/css?family=Raleway:400,300,800,900,700" );
		wp_enqueue_style( 'mytheme-raleway', "$protocol://fonts.googleapis.com/css?family=Oswald:400,700,300" );
		wp_enqueue_style( 'mytheme-raleway', "$protocol://fonts.googleapis.com/css?family=Open+Sans:400,700" );
		}
		add_action( 'wp_enqueue_scripts', 'mytheme_fonts' );	

	?>

    <!-- Google Font -->

    <!-- Favicon -->
	<?php

		// FAVICON
		// LOCATION (\themes\bookish\framework\cp-functions.php)
		/////////////////////////////////////////////////////////////

        CP_FAVICON(); 

    ?>
    
	<!-- FB Thumbnail -->
	<?php 

		// LINK RELEVANT
		// LOCATION (\themes\bookish\framework\cp-functions.php)
		//////////////////////////////////////////////////////////////

        CP_LINK_REL(); 

    ?>

    <?php wp_head(); ?>
    
    <?php  if ( is_user_logged_in() ) { ?>
              <style>
				  #header {
					margin-top: 32px !important;
					
				  }
			  </style>
	<?php  } ?>

  </head>

  <body data-spy="scroll" data-target=".navbar" <?php body_class( ); ?>>
   <!-- <div id="preloader">
      <div id="status">&nbsp;</div>
    </div>-->

    <!-- Start Main Wrapper -->
    <div class="wrapper">
      
    <!--Header Start-->
  	<header id="header">
    
    <!--Header Top Start-->
		
        <?php if(cp_woocommerce_enabled()) { ?>
			
        	<div class="header-top">
                  <div class="row-fluid">
                        <div class="container">
                                  <div class="span6">
                                    <div class="header-top-left"> 
                                        <?php $cp_shop_phone = get_option(THEME_NAME_S.'_top_shop_phone_number'); ?>
                                        <?php echo __('Telephone: ', 'crunchpress'); ?><span class="num"> <?php echo $cp_shop_phone; ?> </span>
                                    </div>
                                  </div>
            
                                  <div class="span6">
                                        <div class="header-top-right">               
                                            <div class="top-nav">
                                                <?php  if(cp_woocommerce_enabled()) { echo cp_shop_nav(); }  ?>
                                            </div>
                                            <section class="e-commerce-list">
                                                <?php if(cp_woocommerce_enabled()) {  echo  cp_shop_nav_top();} ?>
                                                    <div class="c-btn">  <?php  global $woocommerce;  if(cp_woocommerce_enabled()) {  echo cp_woocommerce_cart_dropdown();}?> </div>
                                            </section>
                                        </div>
                                  </div>
                          </div>
                     </div>
        	</div>

		<?php } ?>
        
    <div class="container"> 
    	<strong class="logo">
    			<?php 

					// LOGO
					// LOCATION (\themes\bookish\framework\cp-functions.php)
					///////////////////////////////////////////////////////////////

					CP_LOGO(); 		
						
				?>
        </strong> 
      <!--Navigation Area Start-->
      <div class="navigation-area">
        <nav id="nav">
          <div class="navbar navbar-inverse pull-right span9">
            <div class="navbar-inner">
              <button data-target=".nav-collapse" data-toggle="collapse" class="btn btn-navbar" type="button"> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
              <div class="nav-collapse collapse">
                <?php 

					// MAIN NAVIGATION
					// LOCATION (\themes\bookish\framework\cp-functions.php)
					///////////////////////////////////////////////////////////////
					CP_MAIN_NAVIGATION() ;
					
					

				?>
              </div>
              <!--/.nav-collapse --> 
            </div>
            <!-- /.navbar-inner --> 
          </div>
          <!-- /.navbar --> 
        </nav>
      </div>
      <!--Navigation Area End--> 
    </div>
  </header>
  	<!--Header End--> 