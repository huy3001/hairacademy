<?php
/**
 * The Template for displaying product archives, including the main shop page which is a post type archive
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/archive-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you (the theme developer).
 * will need to copy the new files to your theme to maintain compatibility. We try to do this.
 * as little as possible, but it does happen. When this occurs the version of the template file will.
 * be bumped and the readme will list any important changes.
 *
 * @see 	    http://docs.woothemes.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

get_header( 'shop' ); ?>
<?php include (TEMPLATEPATH . '/left-content.php'); ?>
<div class="right-content">

	<?php
		/**
		 * woocommerce_before_main_content hook.
		 *
		 * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
		 * @hooked woocommerce_breadcrumb - 20
		 */
		do_action( 'woocommerce_before_main_content' );
	?>
        <div class="cat-header">
            <?php
            global $wp_query;
            $cat = $wp_query->get_queried_object();
			WC()->session->set('category_id' , $cat->term_id );
            ?>
            <?php

            // Display sub-category
            echo '<div class="cat-sub-list"><div class="container"><div class="row">';
            if($cat->parent == 0){
                $parent = $cat->term_id;
            }else{
                $parent = $cat->parent;
            }
            $args = array(
                'hierarchical' => 1,
                'show_option_none' => '',
                'hide_empty' => 0,
                'parent' => $parent,
                'taxonomy' => 'product_cat'
            );
            $categories = get_categories( $args );
            echo '<div class="cat-list swiper-container"><div class="swiper-wrapper">';
            foreach($categories as $category){
                $link = get_term_link( $category->slug, $category->taxonomy );
                $thumbnail = get_woocommerce_term_meta( $category->term_id, 'thumbnail_id', true );
                $image_sub = wp_get_attachment_url( $thumbnail );
				if($category->term_id == $cat->term_id)
                	echo '<div class="swiper-slide active"><a href="'. $link .'"><figure><img src="'. $image_sub .'" /></figure><span>'. $category->name .'</span></a></div>';
				else
					echo '<div class="swiper-slide"><a href="'. $link .'"><figure><img src="'. $image_sub .'" /></figure><span>'. $category->name .'</span></a></div>';
            }
            echo '</div></div></div></div></div>';
            ?>
            <div class="cat-info">
                <?php if ( apply_filters( 'woocommerce_show_page_title', true ) ) : ?>

                    <h1 class="page-title"><?php woocommerce_page_title(); ?></h1>

                <?php endif; ?>
                <?php
                /**
                 * woocommerce_archive_description hook.
                 *
                 * @hooked woocommerce_taxonomy_archive_description - 10
                 * @hooked woocommerce_product_archive_description - 10
                 */
                do_action( 'woocommerce_archive_description' );
                ?>

                <?php if ( have_posts() ) : ?>
            </div>

			<?php
			// Display category image
            $thumbnail_id = get_woocommerce_term_meta( $cat->term_id, 'thumbnail_id', true );
            $image = wp_get_attachment_url( $thumbnail_id );
            if($image):
                ?>
                <div class="cat-image">
                    <img src="<?php echo $image;?>" />
                </div>
            <?php endif;?>
        </div><!-- End cat header -->

        <!-- Filter bar -->
        <div class="filter-bar"><div class="container"><div class="row">
			<?php
				/**
				 * woocommerce_before_shop_loop hook.
				 *
				 * @hooked woocommerce_result_count - 20
				 * @hooked woocommerce_catalog_ordering - 30
				 */
				do_action( 'woocommerce_before_shop_loop' );
			?>

            <?php woocommerce_product_loop_start(); ?>

            <?php woocommerce_product_subcategories(); ?>

				<?php while ( have_posts() ) : the_post(); ?>

					<?php wc_get_template_part( 'content', 'product' ); ?>

				<?php endwhile; // end of the loop. ?>

			<?php woocommerce_product_loop_end(); ?>
			<?php
				/**
				 * woocommerce_after_shop_loop hook.
				 *
				 * @hooked woocommerce_pagination - 10
				 */
				do_action( 'woocommerce_after_shop_loop' );
			?>

		<?php elseif ( ! woocommerce_product_subcategories( array( 'before' => woocommerce_product_loop_start( false ), 'after' => woocommerce_product_loop_end( false ) ) ) ) : ?>

			<?php wc_get_template( 'loop/no-products-found.php' ); ?>

		<?php endif; ?>

	<?php
		/**
		 * woocommerce_after_main_content hook.
		 *
		 * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
		 */
		do_action( 'woocommerce_after_main_content' );
	?>

	<?php
		/**
		 * woocommerce_sidebar hook.
		 *
		 * @hooked woocommerce_get_sidebar - 10
		 */
		do_action( 'woocommerce_sidebar' );
	?>

    <?php get_footer( 'shop' ); ?>