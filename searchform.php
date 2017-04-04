<form method="get" id="searchform" action="<?php  echo home_url(); ?>/">
	<input type="text" value="<?php the_search_query(); ?>" name="s" id="s" autocomplete="off" />
	<input class="register" type="submit" id="searchsubmit" value="Search" />
</form>
