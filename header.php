<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="lt-ie9 lt-ie8 lt-ie7" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 7]>         <html class="lt-ie9 lt-ie8" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 8]>         <html class="lt-ie9" <?php language_attributes(); ?>> <![endif]-->
<!--[if gt IE 8]><!--> <html <?php language_attributes(); ?>> <!--<![endif]-->
  <head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <title><?php wp_title('&middot;', true, 'right'); ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    
    <meta name="author" content="">    

    <!-- Favicon and Touch Icon -->
    <?php $touchicon_img = ot_get_option('sentientwp_touchicon'); ?>
    <link rel="apple-touch-icon" sizes="144x144" href="<?php echo $touchicon_img; ?>" />
    <?php $favicon_img = ot_get_option('sentientwp_favicon'); ?>
    <link rel="shortcut icon" href="<?php echo $favicon_img; ?>" />
    <!-- HTML5 shiv, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="<?php print JAVASCRIPT; ?>html5shiv.js"></script>
    <![endif]-->    
    <?php wp_head(); ?>
  </head>
  <body <?php body_class(); ?>>
    
    <div class="container-narrow">
      
      <div class="navbar-wrapper">
        <div class="navbar navbar-inverse">
          <div class="navbar-inner">
            <div class="container">
              <button type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
              </button>
              <a class="brand" href="<?php echo home_url('/'); ?>" title="<?php echo esc_attr(get_bloginfo('name', 'display')); ?>" rel="home"><?php bloginfo('name'); ?></a>
             <?php wp_nav_menu(
                      array(
                          'menu' => 'main-menu',
                          'container_class' => 'nav-collapse collapse',
                          'menu_class' => 'nav',
                          'fallback_cb' => '',
                          'menu_id' => 'main-menu',
                          'walker' => new Sentientwp_Walker_Nav_Menu()
                      )
                  ); ?>
            </div><!-- /.container -->
          </div> <!-- /.navbar-inner -->
        </div><!-- /.navbar -->
      
      </div><!-- /.navbar-wrapper -->