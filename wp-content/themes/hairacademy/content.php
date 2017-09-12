<?php
/**
 * Created by PhpStorm.
 * User: chutienphuc
 * Date: 22/04/2015
 * Time: 17:46
 */?>

<article id="post-<?php the_ID();?>" <?php post_class();?>>
    <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute() ?>">
        <?php if(!is_single() && has_post_thumbnail()): ?>
        <div class="entry-thumbnail">
            <?php sutunam_thumbnail('thumbnail')?>
            <div class="timestamp">
                <span class="date"><?php echo get_the_date('d') ?></span>
                <span class="month"><?php echo get_the_date('M') ?></span>
                <span class="year"><?php echo get_the_date('Y') ?></span>
            </div>
        </div>
        <?php endif; ?>
        <div class="entry-info">
            <div class="entry-header">
                <?php sutunam_entry_header();?>
                <?php /*sutunam_entry_meta();*/?>
            </div>
            <div class="entry-content">
                <?php sutunam_entry_content(); ?>
                <span class="read-more"><?php echo __('Read more', 'sutunam') ?></span>
            </div>
        </div>
    </a>
</article>