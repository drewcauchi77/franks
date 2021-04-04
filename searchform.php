<form role="search" method="get" id="searchform" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<div>
	    <label for="s">Search:</label>
		<input type="text" value="<?php echo get_search_query(); ?>" name="s" id="s" placeholder="" />
	</div>
</form>