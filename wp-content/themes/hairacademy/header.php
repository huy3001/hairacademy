<?php
/**
 * Created by PhpStorm.
 * User: chutienphuc
 * Date: 22/04/2015
 * Time: 17:45
 * This template to display header
 */
?>
<?php

$jk_options = get_option('redux_demo');

?>
<!DOCTYPE html>
<!--[if IE 8]>
<html <?php language_attributes(); ?> class="ie8"> <![endif]-->
<!--[if !IE]>
<html <?php language_attributes(); ?>> <![endif]-->
<head>
    <meta charset="<?php bloginfo('charset'); ?>"/>
    <meta http-equiv="content-language" content="<?php bloginfo('language'); ?>" />
    <meta name="contact" content="<?php bloginfo('admin_email'); ?>" />
    <meta name="description" content="<?php bloginfo('description'); ?>" />
    <meta name="keywords" content="" />

    <!-- ======================================================================
    Mobile Specific Meta
    ======================================================================= -->
    <meta name="viewport"
          content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no"/>

    <link rel="profile" href="http://gmgp.org/xfn/11"/>
    <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>"/>
    <link rel="shortcut icon"
          href="<?php echo $jk_options['fav_img']['url']; ?>"
          type="image/x-icon"/>
    <?php wp_head(); ?>

</head>
<body <?php body_class('no-sidebar'); ?> <?php language_attributes(); ?>>
<!-- Facebook SDK -->
<script>
    window.fbAsyncInit = function() {
        FB.init({
            appId      : '297276577364321',
            xfbml      : true,
            version    : 'v2.9'
        });
        FB.AppEvents.logPageView();
    };

    (function(d, s, id){
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) {return;}
        js = d.createElement(s); js.id = id;
        js.src = "//connect.facebook.net/en_US/sdk.js";
        fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));
</script>
<!-- End Facebook SDK -->
<div id="wrapper">
<header id="header">
    <div class="menu nav-menu">
        <div class="container">
            <button class="toggle-menu">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>

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

            <div class="login">
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

            <?php /*
            <div class="language">
                <?php if (get_locale() == 'en_US'): ?>
                    <a href="<?php echo get_site_url(1); ?>" class="vn-lang"><?php echo __('VN') ?></a>
                    |
                    <a href="<?php echo get_site_url() ?>" class="en-lang current"><?php echo __('EN') ?></a>
                <?php else: ?>
                    <a href="<?php echo get_site_url() ?>" class="vn-lang current"><?php echo __('VN') ?></a>
                    |
                    <a href="<?php echo get_site_url(2); ?>" class="en-lang"><?php echo __('EN') ?></a>
                <?php endif; ?>
            </div>
            */?>

            <div class="search-form">
                <?php get_search_form(); ?>
            </div>
            <?php
            global $woocommerce;
            $cart_url = $woocommerce->cart->get_cart_url();
            $cart_count = $woocommerce->cart->cart_contents_count;
            if ($cart_count > 0) {
            ?>
            <div class="shopping-cart">
                <a class="cart-icon" href="<?php echo $cart_url;?>">
                    <span class="cart-count"><?php echo esc_html($cart_count); ?></span>
                    <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                </a>
            </div>
			<?php } ?>
            <?php sutunam_menu('top-menu'); ?>
        </div>
    </div>

</header>
<div id="container">

