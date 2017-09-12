<?php
/**
 * The Template for displaying all single products
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you (the theme developer).
 * will need to copy the new files to your theme to maintain compatibility. We try to do this.
 * as little as possible, but it does happen. When this occurs the version of the template file will.
 * be bumped and the readme will list any important changes.
 *
 * @see 	    http://docs.woothemes.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
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
	<?php
	global $product;
	//Display sub-category

	echo '<div class="cat-sub-list"><div class="container"><div class="row">';
	$cats = get_the_terms( $product->ID, 'product_cat' );
	foreach ($cats as $cat){
		if($cat->parent == 0){
			$parent = $cat->term_id;
		}else{
            $parent = $cat->parent;
        }
        break;
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
	<?php
	//Add prev,next products
	$cat_id = WC()->session->get( 'category_id' );
	$cat = get_term_by('id', $cat_id, 'product_cat');
	?>
	<div class="navigation">
        <div class="container">
            <div class="row">
                <a href="<?php echo get_permalink(get_adjacent_post(false,'',false)); ?>" class="btn-left-detail"><?php echo __('Trước', 'sutunam') ?></a>
                <?php if($cat->name):?>
                    <a href="<?php echo get_term_link( $cat->slug, $cat->taxonomy ); ?>" class="center-navigation"><?php echo __('Trở về', 'sutunam') ?> <?php echo $cat->name;?> </a>
                <?php endif;?>
                <a href="<?php echo get_permalink(get_adjacent_post(false,'',true)); ?>" class="btn-right-detail"><?php echo __('Sau', 'sutunam') ?></a>
            </div>
        </div>
	</div>
		<?php while ( have_posts() ) : the_post(); ?>

			<?php wc_get_template_part( 'content', 'single-product' ); ?>

		<?php endwhile; // end of the loop. ?>

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

