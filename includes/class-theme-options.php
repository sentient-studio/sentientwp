<?php
/**
 * Initialize the custom theme options.
 */
add_action( 'admin_init', 'custom_theme_options' );

/**
 * Build the custom settings & update OptionTree.
 */
function custom_theme_options() {
  /**
   * Get a copy of the saved settings array. 
   */
  $saved_settings = get_option( 'option_tree_settings', array() );
  
  /**
   * Custom settings array that will eventually be 
   * passes to the OptionTree Settings API Class.
   */
  $custom_settings = array( 
    'contextual_help' => array( 
      'sidebar'       => ''
    ),
    'sections'        => array( 
      array(
        'id'          => 'sentientwp_options',
        'title'       => 'Favicon'
      )
    ),
    'settings'        => array( 
      array(
        'id'          => 'sentientwp_favicon',
        'label'       => __('Theme Favicon', 'sentientwp'),
        'desc'        => __('Upload a favicon for your site. We recommend a 32 x 32 pixel .png file.', 'sentientwp'),
        'std'         => '',
        'type'        => 'upload',
        'section'     => 'sentientwp_options',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => ''
      ),
      array(
        'id'          => 'sentientwp_touchicon',
        'label'       => __('Theme Touch Icon', 'sentientwp'),
        'desc'        => __('Upload a touch icon for your site. We recommend a 144 x 144 pixel .png file.', 'sentientwp'),
        'std'         => '',
        'type'        => 'upload',
        'section'     => 'sentientwp_options',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => ''
      )
    )
  );
  
  /* allow settings to be filtered before saving */
  $custom_settings = apply_filters( 'option_tree_settings_args', $custom_settings );
  
  /* settings are not the same update the DB */
  if ( $saved_settings !== $custom_settings ) {
    update_option( 'option_tree_settings', $custom_settings ); 
  }
  
}