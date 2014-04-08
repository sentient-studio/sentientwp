<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
* @author Sentient Studio <hello@sentient-studio.com>
* @package WordPress
* @subpackage Sentient
*/

get_header(); ?>

  <div class="row-fluid" role="main">
    <div class="span12">
      <section id="articles">
        <?php if (have_posts()) : while(have_posts()) : the_post(); ?>
          <article <?php post_class('clearfix'); ?> id="post-<?php the_ID(); ?>">
            <div class="blog-post">
              <div class="row">
                <h2><?php the_title(); ?></h2>
                  <?php the_post_thumbnail('post-image'); ?>
                   <?php the_content(); ?>
                </div>
                <?php hw_link_pages(); ?>
                <?php wp_link_pages( array('before' => '<div class="page-links">' . __('Pages:', 'sentientwp'), 'after' => '</div>')); ?>
                <?php edit_post_link(__('Edit', 'sentientwp'), '<span class="btn btn-inverse">', '</span>'); ?>
              </div>
          </article>
        <?php endwhile; else : ?>
          <article>
            <div class="blog-post">
              <div class="row">
                <h1><?php _e('No posts were found!', 'sentientwp'); ?></h1> 
              </div>
            </div>
          </article>
        <?php endif; ?>
      </section>
  
<?php get_footer(); ?>