<?php
/**
 * The template for displaying search results pages.
 *
 * @package WordPress
 * @subpackage Twenty_Fifteen
 * @since Twenty Fifteen 1.0
 */

get_header(); ?>

<?php include(TEMPLATEPATH . '/left-content.php'); ?>
<div class="right-content">
    <div class="archive tax-product_cat woocommerce">
        <section id="primary" class="search-result-wrapper">
            <div class="row">
                <div class="search-result-heading">
                    <!--<h1 class="txt-title"><?php echo __('Search result', 'sutunam') ?></h1>-->
                    <?php if (have_posts()) : ?>
                        <?php
                        global $wp_query;
                        ?>
                        <h1><?php printf(__('%s results for %s', 'sutunam'), $wp_query->found_posts, get_search_query()); ?></h1>
                    <?php else: ?>
                        <h1><?php echo __("There's no matched result for ", 'sutunam') . get_search_query() ?></h1>
                    <?php endif ?>
                </div>
                <!-- search-result-heading -->
            </div>

        </section><!-- .content-area -->

        <div id="content" role="main" class="search-result-content">
            <?php if (have_posts()) : ?>
                <ul id="product-category" class="products">
                    <?php while (have_posts()) : the_post(); ?>
                        <?php get_template_part('content', 'search'); ?>
                    <?php endwhile; ?>
                </ul>
            <?php endif ?>
        </div>
    </div>

    <?php get_footer(); ?>
