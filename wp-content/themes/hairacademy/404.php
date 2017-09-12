<?php
/**
 * Created by PhpStorm.
 * User: chutienphuc
 * Date: 23/09/2015
 * Time: 10:47
 * Template Name: News Page
 */
get_header();
?>
<?php
$image = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), FALSE);
?>
<section class="p404-wrapper">
    <div class="container">
        <div class="p404-heading">
            <h1 class="txt-title title-nobreadcrum p404-title">
                <?php echo __('Page not found','sutunam') ?>
            </h1>

            <p><?php echo __("It seems we can't find what you're looking for. Perhaps searching can help.",'sutunam'); ?></p>

        </div>
    </div>
    <div class="container">
        <div class="col-lg-9">
            <div class="separator-line">
                <p><?php echo __('Or you can browse the site by categories','sutunam') ?></p>
            </div>
            <div class="sitemap-404">
                <?php sutunam_menu('') ?>
            </div>
        </div>
        <div class="right-sidebar col-xs-12 col-sm-3">
            <?php dynamic_sidebar('right-sidebar') ?>
        </div>
    </div>
</section>
<?php
get_footer();
?>
