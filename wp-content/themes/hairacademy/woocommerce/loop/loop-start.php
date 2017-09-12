<?php
/**
 * Product Loop Start
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/loop/loop-start.php.
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
?>
<button class="btn-filter" type="button"><?php echo __('Lọc sản phẩm','sutunam') ?></button>
<div class="filter-container">
    <button class="btn-close" type="button"><?php echo __('Lọc','sutunam') ?></button>
    <div id="placeHolder"></div>
    <div id="legend" style="display:none;"></div>
</div>
<div class="reset-filter" title="<?php echo __('Đặt lại','sutunam') ?>" style="display:none;">
    <span><?php echo __('Đặt lại','sutunam') ?></span>
</div><!-- End reset filter -->
<?php if(is_product_category()):?>
<div class="product-count">
    <?php global $wp_query;?>
    <span><?php echo $wp_query->found_posts == 0 ? 'Không tìm thấy' : $wp_query->found_posts;?></span> <?php echo __('sản phẩm','sutunam')?>
</div>
</div></div></div><!-- End filter bar -->
<?php endif;?>
<ul class="products" id="product-category">
