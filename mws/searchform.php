<form role="search" method="get" action="<?php echo home_url( '/' ); ?>">
	<div class="input-group">
    	<input type="text" class="form-control" name="s" id="s" value="<?php echo get_search_query(); ?>" placeholder="<?php echo esc_attr_x( 'Suchen …', 'placeholder' ) ?>">

    	<span class="input-group-btn">
  			<button class="btn btn-primary" type="submit" id="searchsubmit">
  				<?php echo esc_attr_x( 'Search', 'submit button' ); ?>
  			</button>
  		</span>
  	</div>
</form>