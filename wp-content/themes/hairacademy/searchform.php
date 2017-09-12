<?php
/**
 * Created by PhpStorm.
 * User: chutienphuc
 * Date: 19/10/2015
 * Time: 17:48
 */
?>
<form role="search" method="get" id="form-search" class="form-search" action="<?php echo esc_url( home_url( '/' ) ); ?>" xmlns="http://www.w3.org/1999/html">
    <button class="toggle-search" type="button"><i class="fa fa-search" aria-hidden="true"></i></button>
    <div class="search-item">
        <input class="form-text" placeholder="<?php echo __('Search', 'sutunam') ?>" type="text" value="<?php echo get_search_query(); ?>" name="s" id="s"/>
        <button class="form-submit" type="submit"><i class="fa fa-search" aria-hidden="true"></i></button>
        <label class="form-close" for=""><i class="fa fa-times" aria-hidden="true"></i></label>
    </div>
</form>