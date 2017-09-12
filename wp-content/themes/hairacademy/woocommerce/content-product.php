<?php
/**
 * The template for displaying product content within loops
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you (the theme developer).
 * will need to copy the new files to your theme to maintain compatibility. We try to do this.
 * as little as possible, but it does happen. When this occurs the version of the template file will.
 * be bumped and the readme will list any important changes.
 *
 * @see     http://docs.woothemes.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 2.5.0
 */

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
<?php
//Add fit filter
$fits = get_the_terms( $post->ID, 'fit' );
$fit = null;
$i =0;
?>
<?php foreach($fits as $item){
    if($i == 0)
		$fit = $item->name;
    else
		$fit .= ', '.$item->name;
    $i++;
}
?>
<?php
//Add color filter
$colors = get_the_terms( $post->ID, 'color' );
$color = null;
$i =0;
?>
<?php foreach($colors as $item){
    if($i == 0)
		$color = $item->name.'-'.get_term_meta($item->term_id, 'color', true);
    else
		$color .= ', '.$item->name.'-'.get_term_meta($item->term_id, 'color', true);
    $i++;
}
?>

<?php
//Add fabric filter
$fabrics = get_the_terms( $post->ID, 'fabric' );
$fabric = null;
$i =0;
?>
<?php foreach($fabrics as $item){
	if($i == 0)
		$fabric = $item->name;
	else
		$fabric .= ', '.$item->name;
	$i++;
}
?>

<?php
//Add brand filter
$brands = get_the_terms( $post->ID, 'brand' );
$brand = null;
$i =0;
?>
<?php foreach($brands as $item){
	if($i == 0)
		$brand = $item->name;
	else
		$brand .= ', '.$item->name;
	$i++;
}
?>

<?php
//Add size filter
$sizes = get_the_terms( $post->ID, 'size' );
$size = null;
$i =0;
?>
<?php foreach($sizes as $item){
	if($i == 0)
		$size = $item->name;
	else
		$size .= ', '.$item->name;
	$i++;
}
$price = $product->price;
if ($price <= 100000){
	$filterPrice = '< 100.000 VND';
}elseif($price > 100000 && $price <= 200000){
	$filterPrice = '> 100.000 VND';
}elseif($price > 200000 && $price <= 300000){
	$filterPrice = '> 200.000 VND';
}elseif($price > 300000 && $price <= 400000){
	$filterPrice = '> 300.000 VND';
}elseif($price > 400000 && $price <= 500000){
	$filterPrice = '> 400.000 VND';
}else{
	$filterPrice = '> 500.000 VND';
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