<?php
/**
 * Sentient Theme Functions
 *
 * @author Sentient Studio <hello@sentient-studio.com>
 * @package WordPress
 * @subpackage Sentient
 */
 /************************************************************************************************************************/
 /* Initialize the Update Checker
 /************************************************************************************************************************/
 require 'theme-updates/theme-update-checker.php';
 $example_update_checker = new ThemeUpdateChecker(
 	'sentientwp',
 	'http://sentient-theme.com/theme-download/info.json' );
 
 /************************************************************************************************************************/
 /* Option Tree Setup
 /************************************************************************************************************************/
 //add_filter( 'ot_show_pages', '__return_false' );
 //add_filter( 'ot_show_new_layout', '__return_false' );
 //add_filter( 'ot_theme_mode', '__return_true' );
 //load_template( trailingslashit( get_template_directory() ) . 'option-tree/ot-loader.php' );
 //load_template( trailingslashit( get_template_directory() ) . 'includes/class-theme-options.php' );
 
 /************************************************************************************************************************/
 /*  Define constants
 /************************************************************************************************************************/
 define('THEMEROOT', get_stylesheet_directory_uri());
 define('IMAGES', THEMEROOT . '/bootstrap/img/');
 define('JAVASCRIPT', THEMEROOT . '/bootstrap/js/');
 
/************************************************************************************************************************/
/*  TGM Plugin Activation
/************************************************************************************************************************/
require_once dirname( __FILE__ ) . '/includes/class-tgm-plugin-activation.php';

add_action( 'tgmpa_register', 'my_theme_register_required_plugins' );

function my_theme_register_required_plugins() {

	$plugins = array(
	
		array(
			'name' 		  => 'WordPress SEO by Yoast',
			'slug' 		  => 'wordpress-seo',
			'required' 	=> false,
		),
		
		array(
			'name' 		  => 'Google Analytics for WordPress',
			'slug' 		  => 'google-analytics-for-wordpress',
			'required' 	=> false,
		),
		
		array(
			'name' 		  => 'WP-Markdown',
			'slug' 		  => 'wp-markdown',
			'required' 	=> false,
		),
		
		array(
			'name' 		  => 'WP Retina 2x',
			'slug' 		  => 'wp-retina-2x',
			'required' 	=> false,
		),
		
		array(
			'name' 		  => 'Post Types Order',
			'slug' 		  => 'post-types-order',
			'required' 	=> false,
		),

	);

	$theme_text_domain = 'sentientwp';

	$config = array(
	        'domain'            => $theme_text_domain,           // Text domain - likely want to be the same as your theme.
	        'default_path'      => '',                           // Default absolute path to pre-packaged plugins
	        'parent_menu_slug'  => 'themes.php',                 // Default parent menu slug
	        'parent_url_slug'   => 'themes.php',                 // Default parent URL slug
	        'menu'              => 'install-required-plugins',   // Menu slug
	        'has_notices'       => true,                         // Show admin notices or not
	        'is_automatic'      => false,                        // Automatically activate plugins after installation or not
	        'message'           => '',                           // Message to output right before the plugins table
	        'strings'           => array(
          'page_title'                                => __( 'Install Required Plugins', $theme_text_domain ),
          'menu_title'                                => __( 'Install Plugins', $theme_text_domain ),
          'installing'                                => __( 'Installing Plugin: %s', $theme_text_domain ), // %1$s = plugin name
          'oops'                                      => __( 'Something went wrong with the plugin API.', $theme_text_domain ),
          'notice_can_install_required'               => _n_noop( 'This theme requires the following plugin: %1$s.', 'This theme requires the following plugins: %1$s.' ), // %1$s = plugin name(s)
          'notice_can_install_recommended'            => _n_noop( 'This theme recommends the following plugin: %1$s.', 'This theme recommends the following plugins: %1$s.' ), // %1$s = plugin name(s)
          'notice_cannot_install'                     => _n_noop( 'Sorry, but you do not have the correct permissions to install the %s plugin. Contact the administrator of this site for help on getting the plugin installed.', 'Sorry, but you do not have the correct permissions to install the %s plugins. Contact the administrator of this site for help on getting the plugins installed.' ), // %1$s = plugin name(s)
          'notice_can_activate_required'              => _n_noop( 'The following required plugin is currently inactive: %1$s.', 'The following required plugins are currently inactive: %1$s.' ), // %1$s = plugin name(s)
          'notice_can_activate_recommended'           => _n_noop( 'The following recommended plugin is currently inactive: %1$s.', 'The following recommended plugins are currently inactive: %1$s.' ), // %1$s = plugin name(s)
          'notice_cannot_activate'                    => _n_noop( 'Sorry, but you do not have the correct permissions to activate the %s plugin. Contact the administrator of this site for help on getting the plugin activated.', 'Sorry, but you do not have the correct permissions to activate the %s plugins. Contact the administrator of this site for help on getting the plugins activated.' ), // %1$s = plugin name(s)
          'notice_ask_to_update'                      => _n_noop( 'The following plugin needs to be updated to its latest version to ensure maximum compatibility with this theme: %1$s.', 'The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.' ), // %1$s = plugin name(s)
          'notice_cannot_update'                      => _n_noop( 'Sorry, but you do not have the correct permissions to update the %s plugin. Contact the administrator of this site for help on getting the plugin updated.', 'Sorry, but you do not have the correct permissions to update the %s plugins. Contact the administrator of this site for help on getting the plugins updated.' ), // %1$s = plugin name(s)
          'install_link'                              => _n_noop( 'Begin installing plugin', 'Begin installing plugins' ),
          'activate_link'                             => _n_noop( 'Activate installed plugin', 'Activate installed plugins' ),
          'return'                                    => __( 'Return to Required Plugins Installer', $theme_text_domain ),
          'plugin_activated'                          => __( 'Plugin activated successfully.', $theme_text_domain ),
          'complete'                                  => __( 'All plugins installed and activated successfully. %s', $theme_text_domain ) // %1$s = dashboard link
	        )
	    );
	tgmpa( $plugins, $config );

}

/************************************************************************************************************************/
/* Prevent direct access to functions.php
/************************************************************************************************************************/
if (!empty($_SERVER['SCRIPT_FILENAME']) && 'functions.php' == basename($_SERVER['SCRIPT_FILENAME'])) {
  die ('No access!');
}

/************************************************************************************************************************/
/* Remove head junk
/************************************************************************************************************************/
remove_action('wp_head', 'rsd_link');
remove_action('wp_head', 'wlwmanifest_link');
remove_action('wp_head', 'wp_generator');
remove_action('wp_head', 'start_post_rel_link');
remove_action('wp_head', 'index_rel_link');
remove_action('wp_head', 'adjacent_posts_rel_link');

/************************************************************************************************************************/
/*  Maximum allowed width of content within the theme 
/************************************************************************************************************************/
if (!isset($content_width)) {
    $content_width = 690;
}

/************************************************************************************************************************/
/*  Setup theme functions
/************************************************************************************************************************/
if (!function_exists('sentientwp_theme_setup')):
    function sentientwp_theme_setup() {
    
        // localizations
        load_theme_textdomain('sentientwp', get_template_directory() . '/lang');
        // for theme validation - not used
        add_theme_support('automatic-feed-links');
        add_theme_support('post-thumbnails');
        
        add_image_size( 'post-thumb', 690, 690, true );
        add_image_size( 'home-thumb', 690, 690, true );
        add_image_size( 'index-thumb', 690, 690, true );
        
        // this theme uses a custom image size for featured images, displayed on "standard" posts
        add_image_size( 'post-image', 690, 9999 ); // unlimited height, soft crop
        
        // this theme uses wp_nav_menu() in one location    
        register_nav_menus(
            array(
                'main-menu' => __('Main Menu', 'sentientwp'),
            ));
        // load custom walker menu class file
        require 'includes/class-sentientwp_walker_nav_menu.php';
    }
endif;
add_action('after_setup_theme', 'sentientwp_theme_setup');
add_filter( 'use_default_gallery_style', '__return_false' );

function sentientwp_add_editor_styles() {
    add_editor_style( 'editor-style.css' );
}
add_action( 'init', 'sentientwp_add_editor_styles' );

/************************************************************************************************************************/
/*  Enqueue css
/************************************************************************************************************************/
function sentientwp_styles_loader() {
    wp_enqueue_style('sentientwp-default', get_stylesheet_uri());
}
add_action('wp_enqueue_scripts', 'sentientwp_styles_loader');

/************************************************************************************************************************/
/*  Enqueue js scripts for front-end
/************************************************************************************************************************/
function sentientwp_scripts_loader() {

    if (is_singular() && comments_open() && get_option('thread_comments')) {
            wp_enqueue_script('comment-reply');   
        }
        
    wp_enqueue_script('jquery', get_template_directory_uri() . '/bootstrap/js/jquery-1.8.2.min.js', array('jquery'), '1.8.2', true);
    wp_enqueue_script('bootstrap', get_template_directory_uri() . '/bootstrap/js/bootstrap.min.js', array('jquery'),'1.1',true);
    wp_enqueue_script('sentientwp-scripts', get_template_directory_uri() . '/bootstrap/js/bootstrapnav.js', array('jquery'),'1.1',true);
    wp_enqueue_script('fluidvids', get_template_directory_uri() . '/bootstrap/js/fluidvids.min.js', array('jquery'),'1.1',true);
    wp_enqueue_script('mbp-helper', get_template_directory_uri() . '/bootstrap/js/helper.min.js', array('jquery'),'1.1',true);

}
add_action('wp_enqueue_scripts', 'sentientwp_scripts_loader');

/************************************************************************************************************************/
/*  Define default page titles
/************************************************************************************************************************/
function sentient_wp_title($title, $sep)
{
    global $paged, $page;
    if (is_feed()) {
        return $title;
    }
    // add the site name.
    $title .= get_bloginfo('name');
    // add the site description for the home/front page.
    $site_description = get_bloginfo('description', 'display');
    if ($site_description && (is_home() || is_front_page())) {
        $title = "$title $sep $site_description";
    }
    // add a page number if necessary.
    if ($paged >= 2 || $page >= 2) {
        $title = "$title $sep " . sprintf(__('Page %s', 'sentientwp'), max($paged, $page));
    }
    // do work
    return $title;
}
add_filter('wp_title', 'sentient_wp_title', 10, 2);

/************************************************************************************************************************/
/*  Adds custom classes to the array of body classes
/************************************************************************************************************************/
function sentientwp_body_classes($classes) {
    if (is_single()) {
        $classes[] = 'inactive-post-class';
    }
    // do work
    return $classes;
}
add_filter('body_class', 'sentientwp_body_classes');

/************************************************************************************************************************/
/*  Display template for comments and pingbacks
/************************************************************************************************************************/
if (!function_exists('sentientwp_comment')) :
    function sentientwp_comment($comment, $args, $depth)
    {
        $GLOBALS['comment'] = $comment;
        switch ($comment->comment_type) :
            case 'pingback' :
            case 'trackback' : ?>

                <li class="comment media" id="comment-<?php comment_ID(); ?>">
                    <div class="media-body">
                        <p>
                            <?php _e('Pingback:', 'sentientwp'); ?> <?php comment_author_link(); ?>
                        </p>
                    </div><!--/.media-body -->
                <?php
                break;
            default :
                // proceed with normal comments.
                global $post; ?>

                <li class="comment media" id="li-comment-<?php comment_ID(); ?>">
                        <a href="<?php echo $comment->comment_author_url;?>" class="pull-left">
                            <?php echo get_avatar($comment, 64); ?>
                        </a>
                        <div class="media-body">
                            <h4 class="media-heading comment-author vcard">
                                <?php
                                printf('%1$s %2$s',
                                    get_comment_author_link(),
                                    // if current post author is also comment author, make it known visually.
                                    ($comment->user_id === $post->post_author) ? '<span class="label"> ' . __(
                                        'Post author',
                                        'sentientwp'
                                    ) . '</span> ' : ''); ?>
                            
                            <span class="pull-right">
                            <?php comment_reply_link( array_merge($args, array(
                                        'reply_text' => __('Reply', 'sentientwp'),
                                        'depth'      => $depth,
                                        'max_depth'  => $args['max_depth']
                                    )
                                )); ?>
                            </span>
                            </h4>

                            <?php if ('0' == $comment->comment_approved) : ?>
                                <p class="comment-awaiting-moderation"><?php _e(
                                    'Your comment is awaiting moderation.',
                                    'sentientwp'
                                ); ?></p>
                            <?php endif; ?>

                            <?php comment_text(); ?>
                            <ul class="info muted blog-meta-small">
                    
                                <li><i class="icon-calendar-empty"></i>&nbsp;&nbsp;<?php printf('<time date="%1$s" datetime="%2$s">%3$s</time></a>',
                                            esc_url(get_comment_link($comment->comment_ID)),
                                            get_comment_time('c'),
                                            sprintf(
                                                __('%1$s at %2$s', 'bootstrapwp'),
                                                get_comment_date(),
                                                get_comment_time()
                                            )
                                        ); ?></li>
                            
                            </ul>
                        </div>
                        <!--/.media-body -->
                <?php
                break;
        endswitch;
    }
endif;

/************************************************************************************************************************/
/*  Custom comments form
/************************************************************************************************************************/
function sentientwp_custom_comment_form($defaults) {
  $defaults['comment_notes_before'] = '';
  $defaults['id_form'] = 'comment-form';
  $defaults['comment_field'] = '<p><textarea class="span12" id="comment" name="comment" rows="7"></textarea></p>';
  
  // do work
  return $defaults;  
}
add_filter('comment_form_defaults', 'sentientwp_custom_comment_form');

function sentientwp_custom_comment_fields() {
  $commenter = wp_get_current_commenter();
  $req = get_option('require_name_email');
  $aria_req = ($req ? " aria-required='true'" : ' ');
  
  $fields = array(
      'author' => '<label class="control-label" for="author">' . __('Name', 'sentientwp') . ' ' . ($req ? '*' : '') . '</label>' .
                  '<input class="input-xlarge" type="text" id="author" name="author" value="' . esc_attr($commenter['comment_author']) . '" ' . $aria_req .' />',
      'email' =>  '<label class="control-label" for="email">' . __('Email', 'sentientwp') . ' ' . ($req ? '*' : '') . '</label>' . 
                  '<input class="input-xlarge" type="text" id="email" name="email" value="' . esc_attr($commenter['comment_author_email']) . '" ' . $aria_req .' />',
      );
  
  // do work
  return $fields;
}
add_filter('comment_form_default_fields', 'sentientwp_custom_comment_fields');

/************************************************************************************************************************/
/* Comments, pings, trackbacks and pingbacks count
/************************************************************************************************************************/
function commentCount($type = 'comments'){
        if($type == 'comments'):
                $typeSql = 'comment_type = ""';
                $oneText = __('One comment', 'sentientwp');
                $moreText = __('% comments', 'sentientwp');
                $noneText = __('No comments', 'sentientwp');
        elseif($type == 'pings'):
                $typeSql = 'comment_type != ""';
                $oneText = __('One pingback/trackback', 'sentientwp');
                $moreText = __('% pingbacks/trackbacks', 'sentientwp');
                $noneText = __('No pinbacks/trackbacks', 'sentientwp');
        elseif($type == 'trackbacks'):
                $typeSql = 'comment_type = "trackback"';
                $oneText = __('One trackback', 'sentientwp');
                $moreText = __('% trackbacks', 'sentientwp');
                $noneText = __('No trackbacks', 'sentientwp');
        elseif($type == 'pingbacks'):
                $typeSql = 'comment_type = "pingback"';
                $oneText = __('One pingback', 'sentientwp');
                $moreText = __('% pingbacks', 'sentientwp');
                $noneText = __('No pingbacks', 'sentientwp');
        endif;
        global $wpdb;
    $result = $wpdb->get_var('
        SELECT
            COUNT(comment_ID)
        FROM
            '.$wpdb->comments.'
        WHERE
            '.$typeSql.' AND
            comment_approved="1" AND
            comment_post_ID= '.get_the_ID()
    );
        if($result == 0):
                echo str_replace('%', $result, $noneText);
        elseif($result == 1):
                echo str_replace('%', $result, $oneText);
        elseif($result > 1):
                echo str_replace('%', $result, $moreText);
        endif;
}

/************************************************************************************************************************/
/*  Display Twitter like time on posts
/************************************************************************************************************************/
function sentientwp_time_ago( $type = 'post' ) {
        $d = 'comment' == $type ? 'get_comment_time' : 'get_post_time';
        return human_time_diff($d('U'), current_time('timestamp')) . " " . __('ago', 'sentientwp');
}

/************************************************************************************************************************/
/*  Improved pagination: http://bit.ly/1c8qtBD
/************************************************************************************************************************/
function hw_link_pages( $args = '' ) {
        $defaults = array(
                'before'           => '',
                'after'            => '',
                'link_before'      => '',
                'link_after'       => '',
                'next_or_number'   => 'number',
                'nextpagelink'     => __( 'Next page', 'sentientwp' ),
                'previouspagelink' => __( 'Previous page', 'sentientwp' ),
                'pagelink'         => '%',
                'echo'             => true,
        );
        $r = wp_parse_args( $args, $defaults );
        $r = apply_filters( 'hw_link_pages_args', $r );
        global $page, $numpages, $multipage, $more;
        $output = '';
        if ( $multipage ) {
                if ( 'number' == $r['next_or_number'] ) {
                      $output .= '<div class="pagination pagination-large pagination-centered"><ul>';
                      if ( ! empty( $r['before'] ) )
                              $output .= '<li><span>'. $r['before'] . '</span></li>';
                      for ( $i = 1; $i < ( $numpages + 1 ); $i = $i + 1 ) {
                              $j = str_replace( '%', $i, $r['pagelink'] );
                              $not_current = ( $i != $page ) || ( ( ! $more ) && ( $page == 1 ) );
                              if ( $not_current )
                                      $output .= '<li>' . _wp_link_page( $i );
                              else
                                      $output .= '<li class="active"><span>';
                              $output .= $r['link_before'] . $j . $r['link_after'];
                              if ( $not_current )
                                      $output .= '</a></li>';
                              else
                                      $output .= '</span></li>';
                      }
                      if ( ! empty( $r['after'] ) )
                              $output .= '<li><span>'. $r['after'] . '</span></li>';
                      $output .= '</ul></div>';
                }
                else {
                      if ( $more ) {
                              $output .= '<ul class="pager">';
                              $i = $page - 1;
                              if ( $i && $more ) {
                                      $output .= '<li class="previous">' . _wp_link_page( $i );
                                      $output .= $r['link_before'] . $r['previouspagelink'] . $r['link_after'] . '</a></li>';
                              }
                              $i = $page + 1;
                              if ( $i <= $numpages && $more ) {
                                      $output .= '<li class="next">' . _wp_link_page( $i );
                                      $output .= $r['link_before'] . $r['nextpagelink'] . $r['link_after'] . '</a></li>';
                              }
                              $output .= '</ul>';
                         }
                }
        }
        $output = apply_filters( 'hw_link_pages_html', $output );
        if ( $r['echo'] )
                echo $output;
        // do work
        return $output;
}


function excerpt_readmore($more) {
        global $post;
        return '&nbsp;[&hellip;] <a href="'. get_permalink($post->ID) . '" class="readmore">' . 'Read More' . '</a>';
}
add_filter('excerpt_more', 'excerpt_readmore');

/************************************************************************************************************************/
/*  Remove the p from around img: http://bit.ly/sIr1EU
/************************************************************************************************************************/
function sentientwp_filter_ptags_on_images($content){
   return preg_replace('/<p>\s*(<a .*>)?\s*(<img .* \/>)\s*(<\/a>)?\s*<\/p>/iU', '\1\2\3', $content);
}
add_filter('the_content', 'sentientwp_filter_ptags_on_images');

/************************************************************************************************************************/
/*  Remove height/width attributes in admin on images so they can be responsive
/************************************************************************************************************************/
function sentientwp_remove_thumbnail_dimensions($html) {
    $html = preg_replace( '/(width|height)=\"\d*\"\s/', "", $html );
    return $html;
}
add_filter( 'post_thumbnail_html', 'sentientwp_remove_thumbnail_dimensions', 10 );
add_filter( 'image_send_to_editor', 'sentientwp_remove_thumbnail_dimensions', 10 );

/************************************************************************************************************************/
/*  Remove height/width attributes on attached images so they can be responsive
/************************************************************************************************************************/
function sentientwp_image_downsize( $value = false, $id, $size ) {
    if ( !wp_attachment_is_image($id) )
        return false;

    $img_url = wp_get_attachment_url($id);
    $is_intermediate = false;
    $img_url_basename = wp_basename($img_url);

    // try for a new style intermediate size
    if ( $intermediate = image_get_intermediate_size($id, $size) ) {
        $img_url = str_replace($img_url_basename, $intermediate['file'], $img_url);
        $is_intermediate = true;
    }
    elseif ( $size == 'thumbnail' ) {
        // fall back to the old thumbnail
        if ( ($thumb_file = wp_get_attachment_thumb_file($id)) && $info = getimagesize($thumb_file) ) {
            $img_url = str_replace($img_url_basename, wp_basename($thumb_file), $img_url);
            $is_intermediate = true;
        }
    }
    // we have the actual image size, but might need to further constrain it if content_width is narrower
    if ( $img_url) {
        return array( $img_url, 0, 0, $is_intermediate );
    }
    // do work
    return false;
}
add_filter( 'image_downsize', 'sentientwp_image_downsize', 1, 3 );

/************************************************************************************************************************/
/*  Rebuild the image tag with only the stuff I want: http://bit.ly/16QcMo1
/************************************************************************************************************************/
class bwd_img_rebuilder
{
  public $caption_class   = 'wp-caption';
  public $caption_p_class = 'wp-caption-text';
  public $caption_id_attr = FALSE;
  public $caption_padding = 8; // Double of the padding on $caption_class
 
  public function __construct()
  {
    add_filter( 'img_caption_shortcode', array( $this, 'img_caption_shortcode' ), 1, 3 );
    add_filter( 'get_avatar', array( $this, 'recreate_img_tag' ) );
    add_filter( 'the_content', array( $this, 'the_content') );
  }
 
  public function recreate_img_tag( $tag )
  {
    // supress SimpleXML errors
    libxml_use_internal_errors( TRUE );
 
    try
    {
      $x = new SimpleXMLElement( $tag );
 
      // we only want to rebuild img tags
      if( $x->getName() == 'img' )
      {
        // Get the attributes I'll use in the new tag
        $alt        = (string) $x->attributes()->alt;
        $src        = (string) $x->attributes()->src;
        $classes    = (string) $x->attributes()->class;
        $class_segs = explode(' ', $classes);
 
        // all images have a source
        $img = '<img src=\'' . $src . '\'';
 
        // if alt not empty, add it
        if( ! empty( $alt ) )
        {
          $img .= ' alt="' . $alt . '"';
        }
 
        // only alignment classes are allowed
        $allowed_classes = array(
          'alignleft',
          'alignright',
          'alignnone',
          'aligncenter'
        );
 
        if( in_array( $class_segs[0], $allowed_classes ) )
        {
          $img .= ' class="' . $class_segs[0] . '"';
        }
 
        // finish up the img tag
        $img .= ' />';
 
        return $img;
      }
    }
    catch ( Exception $e ){}
 
    // tag not an img, so just return it untouched
    return $tag;
  }
 
  /**
   * Search post content for images to rebuild
   */
  public function the_content( $html )
  {
    return preg_replace_callback(
      '|(<img.*/>)|',
      array( $this, 'the_content_callback' ),
      $html
    );
  }
 
  /**
   * Rebuild an image in post content
   */
  private function the_content_callback( $match )
  {
    return $this->recreate_img_tag( $match[0] );
  }
 
  /**
   * Customize caption shortcode
   */
  public function img_caption_shortcode( $output, $attr, $content )
  {
    // not for feed
    if ( is_feed() )
      return $output;
 
    // set up shortcode atts
    $attr = shortcode_atts( array(
      'align'   => 'alignnone',
      'caption' => '',
      'width'   => ''
    ), $attr ); 
    // add id and classes to caption
    $attributes = '';    
    // define variable
    $caption_id_attr = '';
 
    if( $caption_id_attr && ! empty( $attr['id'] ) )
    {
      $attributes .= ' id="' . esc_attr( $attr['id'] ) . '"';
    }
 
    $attributes .= ' class="' . $this->caption_class . ' ' . esc_attr( $attr['align'] ) . '"';
 
    // set the max-width of the caption
    $attributes .= ' style="max-width:' . ( $attr['width'] + $this->caption_padding ) . 'px;"';
 
    // create caption HTML
    $output = '
      <div' . $attributes .'>' .
        do_shortcode( $content ) .
        '<p class="' . $this->caption_p_class . '">' . $attr['caption'] . '</p>' .
      '</div>
    ';
 
    return $output;
  }
} 
$bwd_img_rebuilder = new bwd_img_rebuilder;

/************************************************************************************************************************/
/*  Insert wmode parameter into oEmbeds
/************************************************************************************************************************/
function sentientwp_wmode_opaque( $html, $url, $args ) {
        if ( strpos( $html, '<param name="movie"' ) !== false )
          $html = preg_replace( '|</param>|', '</param><param name="wmode" value="opaque"></param>', $html, 1 );
        if ( strpos( $html, '<embed' ) !== false )
          $html = str_replace( '<embed', '<embed wmode="opaque"', $html );
        // do work
        return $html;
}
add_filter( 'oembed_result', 'sentientwp_wmode_opaque', 10, 3 );

/************************************************************************************************************************/
/*  Redirect to single post if there is one post in category/tag
/************************************************************************************************************************/
function sentientwp_redirect_to_post(){
    global $wp_query; 
    // if there is one post on archive page
    if( is_archive() && $wp_query->post_count == 1 ){
        // setup post data
        the_post();
        // get permalink
        $post_url = get_permalink();
        // redirect to post page
        wp_redirect( $post_url );
    }   
} 
add_action('template_redirect', 'sentientwp_redirect_to_post');

/************************************************************************************************************************/
/*  Remove 'more' jump
/************************************************************************************************************************/
function sentientwp_remove_more_jump_link($link) { 
	$offset = strpos($link, '#more-');
	if ($offset) {
		$end = strpos($link, '"', $offset);
	}
	if ($end) {
		$link = substr_replace($link, '', $offset, $end-$offset);
	}
	return $link;
}
add_filter('the_content_more_link', 'sentientwp_remove_more_jump_link');

/************************************************************************************************************************/
/*  Hide Unused Admin Items please...
/************************************************************************************************************************/
if (!function_exists('sentientwp_hide_menus')) {
    function sentientwp_hide_menus() {
    	global $current_user;
    	get_currentuserinfo();
    
    	if($current_user->user_login = 'admin') {
    		?>
    		<style>
    		p.hide-if-no-customize,
    		#toplevel_page_edit-post_type-acf,
    		#dashboard_quick_press .wp-media-buttons,
    		#dashboard_quick_press div.input-text-wrap:last-child,
    		#wp-content-media-buttons,
    		#wp-admin-bar-new-media,
    		#wp-admin-bar-new-link,
    		#menu-appearance li,
    		#menu-appearance .wp-submenu-wrap,
    		#menu-appearance .wp-submenu,
    		#menu-appearance .wp-submenu li a[href="theme-editor.php"],
    		#menu-pages li,
    		#menu-pages .wp-submenu-wrap,
    		#menu-pages .wp-submenu,
    		#menu-posts li,
    		#menu-posts .wp-submenu-wrap,
    		#menu-posts .wp-submenu,
    		#pageparentdiv,
    		#postcustom,
    		#postexcerpt,
    		#trackbacksdiv,
    		.theme-options {
    		display:none;
    		}
    		</style>
    		<?php
    	}
    }
}
add_action('admin_head', 'sentientwp_hide_menus');

/************************************************************************************************************************/
/*  Remove WordPress Update Nag - Admin
/************************************************************************************************************************/
function sentientwp_remove_update_nag() {
   echo '<style type="text/css">
           .update-nag {display: none}
         </style>';
}
add_action('admin_head', 'sentientwp_remove_update_nag');

/************************************************************************************************************************/
/*  Remove Option Tree Settings Menu
/************************************************************************************************************************/
//function sentientwp_remove_ot_menu () {
//	remove_menu_page( 'ot-settings' );
//}
//add_action( 'admin_menu', 'sentientwp_remove_ot_menu' );

/************************************************************************************************************************/
/*  Add Twitter to user profile - Admin
/************************************************************************************************************************/
if (!function_exists('sentientwp_contact_info')) {
    function sentientwp_contact_info($contactmethods) {
        
        // unset irrelevant methods
        unset($contactmethods['aim']);
        unset($contactmethods['yim']);
        unset($contactmethods['jabber']);       
        
        // set relevant methods
        $contactmethods['twitter'] = __('Twitter Username <span class="description">(required)</span>', 'sentientwp');        
        
        // do work
        return $contactmethods;
    }
}
add_filter('user_contactmethods', 'sentientwp_contact_info');

/************************************************************************************************************************/
/*  No unrequired Dashboard Widgets please...
/************************************************************************************************************************/
if (!function_exists('sentientwp_remove_dashboard_widgets')) {
    function sentientwp_remove_dashboard_widgets() {
    	global $wp_meta_boxes;
    	unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_plugins']);
    	unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_recent_comments']);
    	unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_incoming_links']);
    	unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_right_now']);
    	unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_primary']);
    	unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_secondary']);
    }
}
add_action('wp_dashboard_setup', 'sentientwp_remove_dashboard_widgets');

/************************************************************************************************************************/
/*  Show admin notice - Contextual Help
/************************************************************************************************************************/
function my_admin_notice(){
    global $pagenow;
    if ( $pagenow == 'themes.php' ) {
         echo _e('<div class="update-nag">
             <strong>Information about Sentient Theme, menus, media, Twitter and sample data under &#8216;Help&#8217; &rarr;</strong>
         </div>', 'sentientwp');
    }
}
add_action('admin_notices', 'my_admin_notice');

/************************************************************************************************************************/
/*  Contextual Help
/************************************************************************************************************************/
function sentientwp_theme_help( $old_help, $screen_id, $screen ) {
    
    # Uncomment this to see actual screen
    # echo 'Screen ID = '.$screen_id.'<br />';
    // not our screen, exit earlier
    // adjust for your correct screen_id, see plugin recommendation below
    if( 'themes' != $screen_id )
        return;

    // remove default tabs
    $screen->remove_help_tabs();

    // add one help tab
    // for new ones: duplicate this, change id's and create custom callbacks
    $screen->add_help_tab( array(
        'id'      => 'theme-overview',
        'title'   => __('Overview', 'sentientwp'),
        'content' => '', // left empty on purpose, we use the callback bellow
        'callback' => 'sentientwp_overview_help'
    ));
    $screen->add_help_tab( array(
        'id'      => 'menus-help',
        'title'   => __('Menus', 'sentientwp'),
        'content' => '', // left empty on purpose, we use the callback bellow
        'callback' => 'sentientwp_menu_help'
    ));
    $screen->add_help_tab( array(
        'id'      => 'images-help',
        'title'   => __('Media', 'sentientwp'),
        'content' => '', // left empty on purpose, we use the callback bellow
        'callback' => 'sentientwp_image_help'
    ));
    $screen->add_help_tab( array(
        'id'      => 'twitter-help',
        'title'   => __('Twitter', 'sentientwp'),
        'content' => '', // left empty on purpose, we use the callback bellow
        'callback' => 'sentientwp_twitter_help'
    ));
    $screen->add_help_tab( array(
        'id'      => 'data-help',
        'title'   => __('Sample Data', 'sentientwp'),
        'content' => '', // left empty on purpose, we use the callback bellow
        'callback' => 'sentientwp_data_help'
    ));

    // This sets the sidebar, which is common for all tabs of this screen
    get_current_screen()->set_help_sidebar(
        '<p><strong>' . __('More information:', 'sentientwp') . '</strong></p>' .
        '<p>' . __('<a href="http://codex.wordpress.org/Edit_Media" title="WordPress.org Editing Media" target="_blank">Editing Media</a>', 'sentientwp') . '</p>' .
        '<p>' . __('<a href="http://codex.wordpress.org/Embeds" title="WordPress.org Embeds" target="_blank">Embed Video</a>', 'sentientwp') . '</p>' . 
        '<p>' . __('<a href="http://wordpress.org/support/" target="_blank">Support Forums</a>', 'sentientwp') . '</p>'
    );

    return $old_help;
}

function sentientwp_overview_help() {
    echo __('
        <h3>Sentient &ndash; Overview</h3>        	       
        <p><strong>Sentient</strong> eliminates all of the unnecessary elements found in typical WordPress themes allowing you to focus on beautiful responsive text. <strong>Sentient</strong> provides a distraction-free writing and reading experience for you and your audience with uncluttered and sophisticated presentation of your content on desktop and mobile devices&hellip;</p>
        ', 'sentientwp');
}

function sentientwp_menu_help() {
    echo __('
        <h3>Sentient &ndash; Menus</h3>      	       
        <p><strong>Sentient</strong> supports custom menus with dropdown items. <strong>To use:</strong> go to &#8216;Appearance > Menus&#8217; and create a blank top level &#8216;Links&#8217; item. In the &#8216;URL&#8217; field delete &#8216;http://&#8217; and enter a hash (#). Enter your &#8216;Link Text&#8217; and click &#8216;Add to Menu&#8217;.</p>
          <img src="http://www.sentient-theme.com/theme-help/img/menu_help.jpg" /> 
        <p>Drag your menu sub items below your newly created top level item. Save Menu.</p>
        ', 'sentientwp');
}

function sentientwp_image_help() {
    echo __('
        <h3>Sentient &ndash; Media</h3>       	       
        <p>For <strong>Sentient</strong> to display images optimally on desktop, laptop, tablet and mobile devices please ensure all images are at <strong>690 pixels wide</strong> in either landscape and portrait orientation.</p>
        <p>Retina HD images are supported by installing the recommended &#8216;WP-Retina&#8217; plugin. See the <a href="http://wordpress.org/plugins/wp-retina-2x/" target="_blank">WordPress.org WP Retina plugin page</a> for more information.</p>               	       
        <p><strong>Sentient</strong> supports responsive video from YouTube and Vimeo in posts and pages. For example:</p>
        <code>
        Check out this cool video:<br />      
        http://youtu.be/9bZkp7q19f0<br />      
        That was a cool video.
        </code>
        <p><strong>Important:</strong> the video URL <strong>must</strong> be on its own line in your post.</p>       
        <p>For detailed instructions on using the WordPress &#8216;Embeds&#8217; function for video see &#8216;Embed Video&#8217; under &#8216;More information&#8217;.</p>
        ', 'sentientwp');
}

function sentientwp_twitter_help() {
    echo __('
        <h3>Sentient &ndash; Twitter</h3>     	       
        <p><strong>Sentient</strong> supports Tweeting on any post. <strong>To use:</strong> enter your &#8216;Twitter Username&#8217; in &#8216;Users&#8217;, &#8216;Your Profile&#8217; under &#8216;Contact Information&#8217; (without the &#8216;&#64;&#8217; symbol).</p>
        ', 'sentientwp');
}

function sentientwp_data_help() {
    echo __('
        <h3>Sentient &ndash; Sample Data</h3>     	       
        <p><strong>Sentient</strong> includes a complete sample data file. Sample data is great for those who don&#8217;t want to start a new WordPress site from scratch, or for those who just want to see how the demo is put together.</p>
        <p>To import the sample data into the Sentient theme follow these steps:</p>
        <ol>
          <li>Locate the sample data XML file included with the theme download package at root level in a folder called XML</li>
          <li>Go to Tools: Import in the WordPress admin panel</li>
          <li>Install the "WordPress" importer from the list</li>
          <li>Upload the sample data XML file using the form provided on that page</li>
          <li>You will first be asked to map the authors in this export file to users on the site. You may choose to map to an existing user on the site &ndash; usually &#8216;Admin&#8217; &ndash;  or to create a new user</li>
          <li>WordPress will then import each of the menus, posts, pages, comments, categories, etc. contained in this file into your site</li>
        </ol> 
        ', 'sentientwp');
}
// Priority 5 allows the removal of default tabs and insertion of other plugin's tabs 
add_filter('contextual_help', 'sentientwp_theme_help', 5, 3);

/************************************************************************************************************************/
/*  Dashboard Widgets in a single column please...
/************************************************************************************************************************/
function single_screen_columns($columns) {
    $columns['dashboard'] = 1;
    // do work
    return $columns;
}
add_filter( 'screen_layout_columns', 'single_screen_columns' );

function single_screen_dashboard() {
  // do work
  return 1;
}
add_filter('get_user_option_screen_layout_dashboard', 'single_screen_dashboard');

/************************************************************************************************************************/
/* Creates post or page duplicate as a draft and redirects then to the edit post screen
/************************************************************************************************************************/
function sentientwp_duplicate_post_as_draft(){
	global $wpdb;
	if (! ( isset( $_GET['post']) || isset( $_POST['post'])  || ( isset($_REQUEST['action']) && 'rd_duplicate_post_as_draft' == $_REQUEST['action'] ) ) ) {
		wp_die('No post to duplicate has been supplied!');
	}
	// get the original post id
	$post_id = (isset($_GET['post']) ? $_GET['post'] : $_POST['post']);
	// and all the original post data then
	$post = get_post( $post_id ); 
	/*
	 * if you don't want current user to be the new post author,
	 * then change next couple of lines to this: $new_post_author = $post->post_author;
	 */
	$current_user = wp_get_current_user();
	$new_post_author = $current_user->ID;
 
	// if post data exists, create the post duplicate
	if (isset( $post ) && $post != null) {
 
		// new post data array
		$args = array(
			'comment_status' => $post->comment_status,
			'ping_status'    => $post->ping_status,
			'post_author'    => $new_post_author,
			'post_content'   => $post->post_content,
			'post_excerpt'   => $post->post_excerpt,
			'post_name'      => $post->post_name,
			'post_parent'    => $post->post_parent,
			'post_password'  => $post->post_password,
			'post_status'    => 'draft',
			'post_title'     => $post->post_title,
			'post_type'      => $post->post_type,
			'to_ping'        => $post->to_ping,
			'menu_order'     => $post->menu_order
		);
 
		// insert the post by wp_insert_post() function
		$new_post_id = wp_insert_post( $args );
 
		// get all current post terms ad set them to the new post draft
		$taxonomies = get_object_taxonomies($post->post_type); // returns array of taxonomy names for post type, ex array("category", "post_tag");
		foreach ($taxonomies as $taxonomy) {
			$post_terms = wp_get_object_terms($post_id, $taxonomy);
			for ($i=0; $i<count($post_terms); $i++) {
				wp_set_object_terms($new_post_id, $post_terms[$i]->slug, $taxonomy, true);
			}
		}
 
		// duplicate all post meta
		$post_meta_infos = $wpdb->get_results("SELECT meta_key, meta_value FROM $wpdb->postmeta WHERE post_id=$post_id");
		if (count($post_meta_infos)!=0) {
			$sql_query = "INSERT INTO $wpdb->postmeta (post_id, meta_key, meta_value) ";
			foreach ($post_meta_infos as $meta_info) {
				$meta_key = $meta_info->meta_key;
				$meta_value = addslashes($meta_info->meta_value);
				$sql_query_sel[]= "SELECT $new_post_id, '$meta_key', '$meta_value'";
			}
			$sql_query.= implode(" UNION ALL ", $sql_query_sel);
			$wpdb->query($sql_query);
		}
		
		// finally, redirect to the edit post screen for the new draft
		wp_redirect( admin_url( 'post.php?action=edit&post=' . $new_post_id ) );
		exit;
	} else {
		wp_die('Post creation failed, could not find original post: ' . $post_id);
	}
}
add_action( 'admin_action_rd_duplicate_post_as_draft', 'sentientwp_duplicate_post_as_draft' );
 
// add the duplicate link to action list for post_row_actions
function sentientwp_duplicate_post_link( $actions, $post ) {
	if (current_user_can('edit_posts')) {
		$actions['duplicate'] = '<a href="admin.php?action=rd_duplicate_post_as_draft&amp;post=' . $post->ID . '" title="Duplicate this item" rel="permalink">Duplicate</a>';
	}
	// do work
	return $actions;
} 
add_filter( 'post_row_actions', 'sentientwp_duplicate_post_link', 10, 2 );
add_filter('page_row_actions', 'sentientwp_duplicate_post_link', 10, 2);

/************************************************************************************************************************/
/*  Change the Dashboard Footer Text
/************************************************************************************************************************/
function sentientwp_remove_footer_admin () {
    echo "Sentient WordPress Theme Version 1.0 &ndash; For beautiful responsive text&hellip;";
} 
add_filter('admin_footer_text', 'sentientwp_remove_footer_admin');

// THE END :)
?>