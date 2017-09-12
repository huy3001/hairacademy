<?php
/**
 * Created by PhpStorm.
 * User: chutienphuc
 * Date: 23/09/2015
 * Time: 10:47
 * Template Name: Shoes Page
 */
get_header(); ?>
<?php
$jk_options = get_option('redux_demo');
?>
<?php include (TEMPLATEPATH . '/left-content.php'); ?>
<div class="right-content">
	<div class="container">
		<div class="row">
            <?php
            $args = array(
                'post_type' => 'product',
                'product_cat' =>'shoes',
                'meta_key' => '_featured',
                'meta_value' => 'yes',
                'posts_per_page' => 1
            );
            $loop = new WP_Query( $args );
            ?>
			<div class="shoes-option-1 content-block <?php if (!$loop->have_posts()) echo 'no-feature'?>">
                <?php
                if ($loop->have_posts()) :?>
                    <div class="feature-product">
                        <?php while ($loop->have_posts()) : $loop->the_post();
                            $product = new WC_product($loop->post->ID);
                            ?>
                            <?php echo '<a href="'.get_permalink($loop->post->ID).'">';?>
                            <span class="info">
                                    <span class="name"><?php echo $product->get_title();?></span>
                                    <span class="price"><?php echo $product->get_price_html();?></span>
                                    <span class="shop">Shop</span>
                                </span>
                            <?php echo $product->get_image('image');?>
                            <?php echo '</a>';?>
                        <?php endwhile;?>
                    </div>
                <?php endif;?>
                <?php wp_reset_postdata(); ?>
                <div class="content-block-img">
				    <img src="<?php echo $jk_options['shoes_img_option_1']['url'] ?>" alt="" />
                </div>
				<div class="content-block-body">
					<?php echo $jk_options['shoes_desc_option_1']?>
					<a href="<?php echo $jk_options['shoes_url_option_1']?>" target="_self">
						<span>shopping</span>
					</a>
				</div>
			</div>
		</div>
        <div class="row">
            <?php
            $args = array(
                'post_type' => 'product',
                'product_cat' =>'shoes',
                'meta_key' => '_featured',
                'meta_value' => 'yes',
                'posts_per_page' => 1
            );
            $loop = new WP_Query( $args );
            ?>
            <div class="shoes-option-2 content-block <?php if (!$loop->have_posts()) echo 'no-feature'?>">
                <?php
                if ($loop->have_posts()) :?>
                    <div class="feature-product">
                        <?php while ($loop->have_posts()) : $loop->the_post();
                            $product = new WC_product($loop->post->ID);
                            ?>
                            <?php echo '<a href="'.get_permalink($loop->post->ID).'">';?>
                            <span class="info">
                                    <span class="name"><?php echo $product->get_title();?></span>
                                    <span class="price"><?php echo $product->get_price_html();?></span>
                                    <span class="shop">Shop</span>
                                </span>
                            <?php echo $product->get_image('image');?>
                            <?php echo '</a>';?>
                        <?php endwhile;?>
                    </div>
                <?php endif;?>
                <?php wp_reset_postdata(); ?>
                <div class="content-block-img">
                    <img src="<?php echo $jk_options['shoes_img_option_2']['url'] ?>" alt="" />
                </div>
                <div class="content-block-body">
                    <?php echo $jk_options['shoes_desc_option_2']?>
                    <a href="<?php echo $jk_options['shoes_url_option_2']?>" target="_self">
                        <span>shopping</span>
                    </a>
                </div>
            </div>
        </div>
        <div class="row">
            <?php
            $args = array(
                'post_type' => 'product',
                'product_cat' =>'shoes',
                'meta_key' => '_featured',
                'meta_value' => 'yes',
                'posts_per_page' => 1
            );
            $loop = new WP_Query( $args );
            ?>
            <div class="shoes-option-3 content-block <?php if (!$loop->have_posts()) echo 'no-feature'?>">
                <?php
                if ($loop->have_posts()) :?>
                    <div class="feature-product">
                        <?php while ($loop->have_posts()) : $loop->the_post();
                            $product = new WC_product($loop->post->ID);
                            ?>
                            <?php echo '<a href="'.get_permalink($loop->post->ID).'">';?>
                            <span class="info">
                                    <span class="name"><?php echo $product->get_title();?></span>
                                    <span class="price"><?php echo $product->get_price_html();?></span>
                                    <span class="shop">Shop</span>
                                </span>
                            <?php echo $product->get_image('image');?>
                            <?php echo '</a>';?>
                        <?php endwhile;?>
                    </div>
                <?php endif;?>
                <?php wp_reset_postdata(); ?>
                <div class="content-block-img">
                    <img src="<?php echo $jk_options['shoes_img_option_3']['url'] ?>" alt="" />
                </div>
                <div class="content-block-body">
                    <?php echo $jk_options['shoes_desc_option_3']?>
                    <a href="<?php echo $jk_options['shoes_url_option_3']?>" target="_self">
                        <span>shopping</span>
                    </a>
                </div>
            </div>
        </div>
	</div>
    <?php get_footer(); ?>
