<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * For example, it puts together the home page when no home.php file exists.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
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
            <a class="permalink" href="<?php the_permalink(); ?>"></a>
            <div class="blog-post">
              <div class="row">          
                <h2><?php the_title(); ?></h2>
                <?php the_post_thumbnail('post-image'); ?>
                  <?php the_content(); ?>
                  <ul class="info muted blog-meta-small">
                    <li><i class="icon-time"></i>&nbsp;&nbsp;<?php echo sentientwp_time_ago(); ?></li>       
                    <li><i class="icon-comment-alt"></i>&nbsp;<?php echo commentCount(); ?></li>
                  </ul>
                  <p class="hidden-desktop visible-tablet visible-phone"><a class="btn btn-inverse" href="<?php the_permalink(); ?>"><?php _e('Read post', 'sentientwp'); ?></a></p>
              </div>     
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
        <article>
          <div class="blog-post">
            <div class="row">
              <ul class="pager">
                <li class="previous"><?php next_posts_link('<i class="icon-circle-arrow-left"></i>&nbsp;' . __('Older', 'sentientwp')); ?></li>
                <li class="next"><?php previous_posts_link(__('Newer', 'sentientwp') . '&nbsp;<i class="icon-circle-arrow-right"></i>'); ?></li>
              </ul>
            </div>
          </div>
          </article>
      </section>
  
<?php get_footer(); ?>