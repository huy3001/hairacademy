<?php
/**
 * Created by PhpStorm.
 * User: chutienphuc
 * Date: 23/09/2015
 * Time: 10:47
 * Template Name: Contact Page
 */

get_header();
include(TEMPLATEPATH . '/left-content.php');
?>
<div class="right-content">
<?php
$image = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), FALSE);
?>
<!--<section class="contact-top-img parallax-window" style="background-image: url('<?php echo $image[0] ?>')">
    <img src="<?php echo $image[0] ?>" alt=""/>
</section>
<section class="contact-wrapper">
    <div class="container">
        <?php if (function_exists('yoast_breadcrumb')) {
            yoast_breadcrumb('<p id="breadcrumbs" class="breadcrumbs">', '</p>');
        } ?>
        <div class="contact-heading">
            <h1 class="txt-title contact-title">
                <?php echo get_the_title() ?>
            </h1>
            <div class="txt-description contact-desc text-center">
                <?php echo __('Find your closest Newviet Dairy Agency','sutunam'); ?>
            </div>
        </div>

        <div class="contact-us-map">
            <?php echo do_shortcode('[wpsl]'); ?>
        </div>
    </div>
</section>
<section class="contact-us-block contact-us-form jarallax" style="background-image: url('<?php echo get_template_directory_uri(); ?>/images/contact/contact-form-bg.jpg')">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 contact-form-wrapper">
                <h3 class="txt-title"><?php echo __('Have questions?','sutunam')?><br/><?php echo __('Send us your concern!','sutunam')?></h3>
                <div class="row">
                    <?php if (get_locale() == 'en_US'): ?>
                        <?php echo do_shortcode('[contact-form-7 id="1967" title="contact-us" html_class="use-floating-validation-tip"]'); ?>
                    <?php else: ?>
                        <?php echo do_shortcode('[contact-form-7 id="15" title="contact-us" html_class="use-floating-validation-tip"]'); ?>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</section>-->
<?php
get_footer();
?>

