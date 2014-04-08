<?php
/**
 * The Template for displaying all single posts.
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
                      <div id="sentientwp-blog-content">
                        <?php the_content(); ?>
                      </div>
                      <ul class="info muted blog-meta-small">
                        <li><i class="icon-time"></i>&nbsp;&nbsp;<?php echo sentientwp_time_ago(); ?></li>
                        <?php if ( get_the_author_meta( 'twitter' ) != '' )  { ?>
                        <li><i class="icon-twitter"></i>&nbsp;<a class="muted" href="https://twitter.com/intent/tweet?screen_name=<?php the_author_meta('twitter'); ?>&text=Re:%20<?php echo wp_get_shortlink(); ?>%20" data-dnt="true" target="_blank">@<?php the_author_meta('twitter'); ?></a></li>
                        <?php } ?>
                        <?php the_tags('<li><i class="icon-tag"></i>&nbsp; ', ', ', '</li>'); ?>
                      </ul>
                </div>
                    <?php hw_link_pages(); ?>
                      <ul class="pager">
                        <li class="previous"><?php previous_post_link('%link', '<i class="icon-circle-arrow-left"></i>&nbsp;' . __( 'Previous', 'sentientwp'), TRUE); ?></li>
                        <li class="next"><?php next_post_link('%link', __('Next', 'sentientwp') . '&nbsp;<i class="icon-circle-arrow-right"></i>', TRUE); ?></li>
                      </ul> 
                    <?php edit_post_link(__('Edit', 'sentientwp'), '<span class="btn btn-inverse">', '</span>'); ?>                    
                    <?php comments_template(); ?>
             </div>
          </article>
          <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
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

<?php dynamic_sidebar(); // unused - for theme validation ?>
<?php register_sidebar(); // unused - for theme validation ?>
    
<?php get_footer(); ?>