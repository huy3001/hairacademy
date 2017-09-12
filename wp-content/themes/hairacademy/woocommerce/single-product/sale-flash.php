<?php
/**
 * Single Product Sale Flash
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/sale-flash.php.
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

global $post, $product;

// Background image
$bgImage = types_render_field("upload-image", array('url'=>true));
// Background type
$bgType = types_render_field("type-display", array('raw'=>true));
// Color
$bgColor = types_render_field("color", array());


?>
<div class="product-content-detail" style="
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
    <div class="product-container">
    <?php if(!$product->is_in_stock()):?>
        <?php echo apply_filters( 'woocommerce_sale_flash', '<span class="onsold">' . __( 'Sold!', 'woocommerce' ) . '</span>', $post, $product ); ?>
    <?php elseif ( $product->is_on_sale() ) : ?>
        <?php echo apply_filters( 'woocommerce_sale_flash', '<span class="onsale">' . __( 'Sale!', 'woocommerce' ) . '</span>', $post, $product ); ?>
    <?php endif; ?>

