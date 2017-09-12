<?php
/**
 * Created by PhpStorm.
 * User: chutienphuc
 * Date: 23/09/2015
 * Time: 10:47
 * Template Name: News Page
 */
get_header();
?>
<?php
$image = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), FALSE);
?>
<section class="news-top-img parallax-window" style="background-image: url('<?php echo esc_url($image[0])?>')">
    <img src="<?php echo esc_url($image[0])?>" alt=""/>
</section>
<section class="news-wrapper">
    <div class="container">
        <?php if (function_exists('yoast_breadcrumb')) {
            yoast_breadcrumb('<p id="breadcrumbs" class="breadcrumbs">', '</p>');
        } ?>
        <div class="news-heading">
            <h1 class="txt-title news-title">
                <?php echo __('Latest News','sutunam') ?>
            </h1>
            <div class="txt-description news-desc text-center">
                <?php echo types_render_field("news-description", array()); ?>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="news news-list col-xs-12 col-sm-9">
                <?php
                $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
                $args = array(
                    'post_type' => 'post',
                    'posts_per_page' => 3,
                    'paged' => $paged
                );
                // The Query
                $the_query = new WP_Query( $args );

                if($the_query->have_posts()):
                    while ($the_query->have_posts()):$the_query->the_post();
                        $url = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID) ,false);
                        ?>
                        <div class="news-item">
                            <div class="news-content">
                                <div class="timestamp">
                                    <div class="date"><?php echo get_the_date('d')?></div>
                                    <div class="month"><?php echo get_the_date('M')?></div>
                                    <div class="year"><?php echo get_the_date('Y')?></div>
                                </div>
                                <div class="news-title">
                                    <h3><a href="<?php echo get_permalink(); ?>"><?php echo __(get_the_title()); ?></a></h3>
                                </div>
                                <div class="category-list">
                                    <?php echo get_the_category_list('<span>|</span>');?>
                                </div>
                                <div class="entry-content">
                                    <p><?php echo __(substr(get_the_excerpt(), 0 , 300)); ?></p>
                                </div>
                            </div>
                            <div class="news-link">
                                <a href="<?php the_permalink(); ?>"><?php echo __('Read more &rarr;');?></a>
                            </div>
                            <div class="news-image">
                                <img src="<?php echo esc_url($url[0])?>" alt="<?php echo get_the_title()?>" />
                            </div>
                        </div>
                    <?php
                    endwhile;
                endif;
                $total_pages = $the_query->max_num_pages;
                if ($total_pages > 1) {
                    $current_page = max(1, get_query_var('paged'));
                    echo ' <div class="clear"></div> <div class="page-nav">';
                    echo paginate_links(array(
                        'current' => $current_page,
                        'total' => $total_pages,
                        'prev_text' => __('&larr; Prev'),
                        'next_text' => __('Next &rarr;')
                    ));
                    echo '</div>';
                }
                ?>
            </div>
            <div class="right-sidebar col-xs-12 col-sm-3">
                <?php dynamic_sidebar('right-sidebar')?>
            </div>
        </div>
    </div>
</section>
<?php
get_footer();
?>
