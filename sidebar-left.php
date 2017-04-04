<?php 
	/*
	 * This file is used to generate left sidebar
	 */	
?>
<?php
	global $sidebar; 
	global $left_sidebar;
	if( $sidebar == "left-sidebar" ){
		
		echo '<div class="span4 last sidebar-left">';
		echo '<aside class="sidebar">';
					dynamic_sidebar(  $left_sidebar );
		echo "</aside>";
		echo "</div>";
	
	}else if( $sidebar == "both-sidebar" ){
		
			echo '<div class="span3 sidebar-left">';
			echo '<aside class="sidebar">';
					dynamic_sidebar( $left_sidebar );
  		    echo "</aside>";				
			echo "</div>";
	}

?>
    
    