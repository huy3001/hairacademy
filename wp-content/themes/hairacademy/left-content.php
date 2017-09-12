<?php
/**
 * Created by PhpStorm.
 * User: chutienphuc
 * Date: 30/06/2016
 * Time: 16:51
 */
$jk_options = get_option('redux_demo');
?>
<div class="left-content">
    <div class="left-logo">
        <div class="logo">
            <?php if (!$jk_options['logo_img']['url']): ?>
                <i class="rombust d-bg-c d-border-c"><i
                        class="fa <?php echo $jk_options['logo_icon'] ?>"></i></i><a
                    href="<?php echo home_url(); ?>"> <?php echo $jk_options['logo_txt'] ?></a>
            <?php else: ?>
                <a href="<?php echo home_url(); ?>"> <img
                        src="<?php echo esc_url($jk_options['logo_img']['url']); ?>"
                        alt="<?php echo get_site_url() ?>"
                        width="160"
                        height="30"></a>
            <?php endif ?>
        </div>
    </div>

    <div class="left-search">
        <form role="search" method="get" class="form-search" action="<?php echo esc_url( home_url( '/' ) ); ?>" xmlns="http://www.w3.org/1999/html">
            <div class="search-item">
                <input class="form-text" placeholder="<?php echo __('Search', 'sutunam') ?>" type="text" value="<?php echo get_search_query(); ?>" name="s" id="s"/>
                <button class="form-submit" type="submit"><i class="fa fa-search" aria-hidden="true"></i></button>
            </div>
        </form>
    </div>

    <?php sutunam_menu('left-menu'); ?>

    <div class="left-login">
        <?php if (is_user_logged_in()) { ?>
            <a class="login-button" href="<?php echo wp_logout_url(home_url()); ?>">
                <i class="fa fa-user" aria-hidden="true"></i>
                <span><?php echo __('logout', 'sutunam') ?></span>
            </a>
        <?php } else { ?>
            <a class="login-button show-login" id="show-login" href="#">
                <i class="fa fa-user" aria-hidden="true"></i>
                <span><?php echo __('login', 'sutunam') ?></span>
            </a>
        <?php } ?>
    </div>
</div>