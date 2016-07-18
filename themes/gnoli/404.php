<?php
/**
 * 404 Page
 *
 * @package gnoli
 * @since 1.0
 *
 */
global $gnoli;
get_header();?>
<div class="hero">
  <div class="hero-inner bg-cover" style="background-image: url('<?php echo esc_url( $gnoli['image_404'] );?>')">
    <div class="overlay overlay-dark-2x"></div>
    <div class="container fullheight text-light text-center">
      <div class="centered">
        <h1 class="bigtext"><?php _e( '404', 'gnoli' ); ?></h1>
        <h6 class="title bold mrg-btm-20"><?php echo esc_html( $gnoli['error_title'] );?></h6>
        <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="button outline light"><?php echo esc_html( $gnoli['error_btn_text'] );?></a>
      </div>
    </div>
  </div>
</div>
<?php get_footer(); ?>
