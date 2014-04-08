<?php
/**
 * The template for displaying Comments.
 *
 * The area of the page that contains both current comments
 * and the comment form. The actual display of comments is
 * handled by a callback to sentientwp_comment() which is
 * located in the functions.php file.
 *
 *
 * @author Sentient Studio <hello@sentient-studio.com>
 * @package WordPress
 * @subpackage Sentient
 */
 // prevent direct loading of this file
 if (!empty($_SERVER['SCRIPT-FILENAME']) && basename($_SERVER['SCRIPT-FILENAME']) == 'comments.php') {
   die(__('You cannot access this file directly.', 'sentientwp'));
 }
 
 // return early no password has been entered for protected posts.
 if (post_password_required()) {
     // do work
     return;
 } ?>
<div id="comments" class="comments-area">
    <?php if (have_comments()) : ?>
      <hr/>
        <ul class="media-list">
            <?php wp_list_comments(array('callback' => 'sentientwp_comment')); ?>
        </ul><!-- /.commentlist -->

        <?php if (get_comment_pages_count() > 1 && get_option('page_comments')) : ?>        
            <ul class="pager">
              <li class="previous"><?php previous_comments_link('<i class="icon-circle-arrow-left"></i>&nbsp;' . __('Older', 'sentientwp')); ?></li>
              <li class="next"><?php next_comments_link(__('Newer', 'sentientwp') . '&nbsp;<i class="icon-circle-arrow-right"></i>'); ?></li>
            </ul>
        <?php endif; // check for comment navigation ?>

        <?php elseif (!comments_open() && '0' != get_comments_number() && post_type_supports(get_post_type(), 'comments')) : ?>
            <p class="nocomments"><?php _e('Comments are closed.', 'sentientwp'); ?></p>
    <?php endif; ?>

    <?php comment_form(); ?>
</div><!-- #comments .comments-area -->