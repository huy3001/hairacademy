<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

global $product, $woocommerce_loop;

// Store loop count we're currently on
if ( empty( $woocommerce_loop['loop'] ) ) {
    $woocommerce_loop['loop'] = 0;
}

// Store column count for displaying the grid
if ( empty( $woocommerce_loop['columns'] ) ) {
    $woocommerce_loop['columns'] = apply_filters( 'loop_shop_columns', 4 );
}

// Ensure visibility
if ( ! $product || ! $product->is_visible() ) {
    return;
}

// Increase loop count
$woocommerce_loop['loop']++;

// Extra post classes
$classes = array();
if ( 0 === ( $woocommerce_loop['loop'] - 1 ) % $woocommerce_loop['columns'] || 1 === $woocommerce_loop['columns'] ) {
    $classes[] = 'first';
}
if ( 0 === $woocommerce_loop['loop'] % $woocommerce_loop['columns'] ) {
    $classes[] = 'last';
}
?>
<li <?php post_class( $classes ); ?> data-nhãn-hiệu="<?php echo $brand;?>" data-kiểu-dáng="<?php echo $fit;?>" data-chất-liệu="<?php echo $fabric;?>" data-màu-sắc="<?php echo $color;?>" data-size="<?php echo $size;?>" data-giá="<?php echo $filterPrice;?>">

    <?php
    /**
     * woocommerce_before_shop_loop_item hook.
     *
     * @hooked woocommerce_template_loop_product_link_open - 10
     */
    do_action( 'woocommerce_before_shop_loop_item' );
    ?>

    <div class="image">
        <?php
        /**
         * woocommerce_before_shop_loop_item_title hook.
         *
         * @hooked woocommerce_show_product_loop_sale_flash - 10
         * @hooked woocommerce_template_loop_product_thumbnail - 10
         */
        do_action( 'woocommerce_before_shop_loop_item_title' );
        ?>

        <?php
        $hoverImg = types_render_field("hover-image", array('url'=>true, 'size' => 'thumbnail'));
        if($hoverImg) { ?>
            <!-- Add hover image -->
            <img class="hover-image" src="<?php echo $hoverImg ?>" alt=""/>
        <?php } ?>
    </div>

    <div class="info">
        <?php if($product->sku): ?>
            <h3><?php echo $product->sku; ?></h3>
        <?php endif; ?>
        <h4><?php echo get_the_title();?></h4>
        <div class="size">
            <?php
            $sizes = get_the_terms( get_the_ID(), 'size' );
            foreach ($sizes as $size){
                if($size->slug == 's'){
                    $value = 'SS';
                }else{
                    $value = $size->slug;
                }
                echo '<span>'.$size->name .'</span>';
            }
            ?>
        </div>
    </div>

    <?php
    /**
     * woocommerce_after_shop_loop_item_title hook.
     *
     * @hooked woocommerce_template_loop_rating - 5
     * @hooked woocommerce_template_loop_price - 10
     */
    do_action( 'woocommerce_after_shop_loop_item_title' );

    /**
     * woocommerce_after_shop_loop_item hook.
     *
     * @hooked woocommerce_template_loop_product_link_close - 5
     * @hooked woocommerce_template_loop_add_to_cart - 10
     */
    do_action( 'woocommerce_after_shop_loop_item' );
    ?>

</li>