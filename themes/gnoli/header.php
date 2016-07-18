<?php
/**
 *
 * The Header for our theme
 * @since 1.0.0
 * @version 1.0.0
 *
 */
global $gnoli;
?>
<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" <?php language_attributes(); ?>> <!--<![endif]-->
  <head>
    <meta charset="utf-8">
    <?php wp_head(); ?>

    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="<?php echo esc_url( $gnoli['site_favicon'] ) ;?>">

  </head>

  <body <?php body_class(); ?>>
    <!-- MAIN_WRAPPER -->
    <div class="main-wrapper animsition">
      <?php $image = get_header_image (); ?>
      <!-- HEADER -->
      <header>
        <!-- LOGO -->
        <div><!-- <img class="logo" src="<?php echo $image; ?>"> --><h1>Mike Zorbas</h1></div>
        <!-- /LOGO -->

        <!-- MOB MENU -->
        <div class="container">
          <!-- MOB MENU ICON -->
            <a href="#" class="mob-nav">
              <i class="fa fa-bars"></i>
            </a>
          <!-- /MOB MENU ICON -->
        </div>
        
        <!-- NAVIGATION -->
        <div class="container">
          <nav class="text-left" id="topmenu">
            <?php gnoli_custom_menu(); ?>
          </nav>
        </div>
        
        <!-- NAVIGATION -->

      </header>