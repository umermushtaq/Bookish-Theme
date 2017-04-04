<?php 
	/*
	 * This file is used to generate right sidebar
	 */	
?>
<?php
	global $sidebar;
	//echo $sidebar;
	global $right_sidebar;
	if( $sidebar == "right-sidebar" ){
		
		echo '<div class="span4 sidebar-right">';
		echo '<aside class="sidebar">';
					dynamic_sidebar( $right_sidebar );
		echo "</aside>";
		echo "</div>";
	
	}else if( $sidebar == "both-sidebar" ){
	
			echo '<div class="span3 sidebar-right">';
			echo '<aside class="sidebar">';
					dynamic_sidebar( $right_sidebar );
  		    echo "</aside>";				
			echo "</div>";
			
	}

?>
   