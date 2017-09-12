<?php
/**
 * Single Product Image
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/product-image.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you (the theme developer).
 * will need to copy the new files to your theme to maintain compatibility. We try to do this.
 * as little as possible, but it does happen. When this occurs the version of the template file will.
 * be bumped and the readme will list any important changes.
 *
 * @see 	    http://docs.woothemes.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.0.14
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $post, $woocommerce, $product;

// Background image
$bgImage = types_render_field("upload-image", array('url'=>true));
// Background type
$bgType = types_render_field("type-display", array('raw'=>true));
// Color
$bgColor = types_render_field("color", array());

?>
<div class="images" style="
<?php
if($bgImage) {
    echo 'background-image:url('.$bgImage.');';
}
if($bgType) {
    if($bgType == 'no-repeat') {
        echo 'background-size:cover;';
    }
    echo 'background-repeat:'.$bgType.';';
}
if($bgColor) {
    echo 'background-color:'.$bgColor.';';
}
?>;">
    <ul class="image-list">
	<?php
		if ( has_post_thumbnail() ) {
			$image_caption = get_post( get_post_thumbnail_id() )->post_excerpt;
			$image_link    = wp_get_attachment_url( get_post_thumbnail_id() );
			$image         = get_the_post_thumbnail( $post->ID, apply_filters( 'single_product_large_thumbnail_size', 'shop_single' ), array(
				'title'	=> get_the_title( get_post_thumbnail_id() ),
                'data-zoom-image' => wp_get_attachment_url( get_post_thumbnail_id() )
			) );

			$attachment_count = count( $product->get_gallery_attachment_ids() );

			if ( $attachment_count > 0 ) {
				$gallery = '[product-gallery]';
			} else {
				$gallery = '';
			}

			echo apply_filters( 'woocommerce_single_product_image_html', sprintf( '<li><a href="%s" itemprop="image" class="woocommerce-main-image" title="%s" style="background-image: url(%s);">%s</a></li>', $image_link, $image_caption, $image_link, $image ), $post->ID );
			$attachment_ids = $product->get_gallery_attachment_ids();
			if ( $attachment_ids ) {
				foreach ( $attachment_ids as $attachment_id ) {
					$image_link    = wp_get_attachment_url( $attachment_id );
					$img = wp_get_attachment_image_src($attachment_id,'large')[0];

					echo apply_filters( 'woocommerce_single_product_image_html', sprintf( '<li><a href="%s" itemprop="image" class="woocommerce-main-image" title="%s" style="background-image: url(%s);"><img src="%s" data-zoom-image="%s" /></a></li>', $image_link, '', $image_link, $img, $image_link ), $attachment_id );
				}
			}
		} else {

			echo apply_filters( 'woocommerce_single_product_image_html', sprintf( '<img src="%s" alt="%s" />', wc_placeholder_img_src(), __( 'Placeholder', 'woocommerce' ) ), $post->ID );

		}
	?>
    </ul>

	<?php do_action( 'woocommerce_product_thumbnails' ); ?>
</div>
