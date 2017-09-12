<?php
/**
 * Created by PhpStorm.
 * User: chutienphuc
 * Date: 23/09/2015
 * Time: 10:47
 * Template Name: Ingredient Page
 */
get_header();
?>
<?php
$image = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), FALSE);
$ingredient_background = types_render_field("ingredient-background", array('output' => 'raw'));
?>

    <section class="ingredient-top-img parallax-window"
             style="background-image: url('<?php echo $ingredient_background ?>')">
        <img src="<?php echo $ingredient_background ?>" alt=""/>
    </section>
    <section class="ingredient-wrapper">
        <div class="container">
            <?php if (function_exists('yoast_breadcrumb')) {
                yoast_breadcrumb('<p id="breadcrumbs" class="breadcrumbs">', '</p>');
            } ?>
            <h1 class="row txt-title ingredient-title">
                <?php echo get_the_title() ?>
            </h1>

            <div class="row txt-description ingredient-desc">
                <div class="col-lg-6 col-lg-push-3">
                    <?php echo types_render_field("ingredient-description", array()); ?>
                </div>
            </div>
            <div class="ingredient-items">
                <?php
                $args = array(
                    'post_type' => 'ingredient',
                    'posts_per_page' => -1,
                    'order' => 'ASC'
                );
                global $post;
                query_posts($args);
                if (have_posts()) :
                    while (have_posts()) : the_post();
                        $product_img = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), FALSE);
                        ?>
                        <div class="row ingredient-product"
                             id="<?php echo $post->post_name; ?>">
                            <div class="col-lg-7 col-md-7 product-item">
                                <div class="product-img">
                                    <?php $large_image_url = wp_get_attachment_image_src(get_post_thumbnail_id(), 'large'); ?>
                                    <img src="<?php echo $large_image_url[0] ?>"
                                         width="100%"/>
                                    <?php $terms = apply_filters('taxonomy-images-get-the-terms', '', array(
                                            'taxonomy' => 'ingredient-distributor',
                                            'post_id' => get_the_ID()
                                        )
                                    );
                                    foreach ($terms as $term) {
                                        $distributor_img = wp_get_attachment_image_src($term->image_id, FALSE);
                                    } ?>
                                    <div class="distributor">
                                        <img
                                            src="<?php echo esc_url($distributor_img[0]) ?>"/>
                                    </div>
                                </div>

                            </div>
                            <div class="col-lg-5 col-md-5 product-detail">
                                <div class="product-content">
                                    <h2><?php echo get_the_title() ?></h2>

                                    <div class="product-desc">
                                        <?php echo get_the_content() ?>
                                    </div>
                                </div>
                                <div class="contact-us-button">
                                    <button
                                        class="btn btn-double">
                                        <a><?php echo __('Contact us','sutunam') ?></a>
                                    </button>
                                </div>
                            </div>
                        </div>
                    <?php endwhile;?>
                <?php else:
                    get_template_part('content', 'none');
                endif;
                ?>
            </div>
        </div>
    </section>
    <section class="ingredients-related-wrapper">
        <?php
        $args = array(
            'post_type' => 'ingredient',
            'posts_per_page' => -1,
            'order' => 'ASC'
        );
        query_posts($args);
        if (have_posts()) :?>
            <ul id="ingredients-related" class="owl-carousel container">
                <?php while (have_posts()) : the_post();
                    $product_img = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), FALSE);
                    ?>
                    <li class="ingredient-item item-<?php echo $post->post_name ?>">
                        <a href="#<?php echo($post->post_name); ?>">
                            <img class="lazyOwl" data-src="
                                    <?php echo esc_url(types_render_field("ingredient-product-thumbnail", array('output' => 'raw'))) ?>"
                                 width="100%"/>

                            <div class="ingredient-item-title">
                                <h4 class="txt-title">
                                    <?php echo get_the_title() ?>
                                </h4>
                            </div>
                        </a>
                    </li>
                <?php endwhile;?>
            </ul>
            <div class="slider-nav">
                <span class="slider-prev"></span>
                <span class="slider-next"></span>
            </div>
        <?php else:
            get_template_part('content', 'none');
        endif; ?>

    </section>
    <section class="ingredient-download download-block">
        <div class="container">
            <h3 class="txt-title"><?php echo __('More technical documentations about our<br/> ingredients are available here.', 'sutunam') ?></h3>

            <p><?php echo __("Haven't got an account?", 'sutunam')?> <?php echo __('Please contact your account manager', 'sutunam')?></p>
            <button
                class="btn btn-double"><a href="https://mydairydata.newviet.vn/" target="_blank"><?php echo __('Sign in', 'sutunam')?></a></button>
        </div>
    </section>
    <section
        id="ingredient-contact-us"
        class="ingredient-contact-us contact-us-block jarallax"
        style="background-image: url('<?php echo get_template_directory_uri(); ?>/images/ingredient_contact_us_bg.jpg')">
        <div class="container" style="position: relative;z-index:3">
            <div class="col-lg-7 contact-form-wrapper">
                <h3 class="txt-title"><?php echo __('want a bulk order','sutunam')?> <br/><?php echo __('of our ingredients?','sutunam')?>
                </h3>
                <?php echo do_shortcode('[contact-form-7 id="69" title="ingredient-contact-us" html_class="use-floating-validation-tip"]'); ?>
            </div>
        </div>
    </section>

<?php
get_footer();
?>