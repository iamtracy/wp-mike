<?php
/**
 *
 * Simple image slider
 * @since 1.0.0
 * @version 1.1.0
 *
 */
function gnoli_simple_slider( $atts, $content = '', $id = '' ) {

  extract( shortcode_atts( array(
    'images'  => ''
  ), $atts ) );

  $output = '';
  if ( ! empty( $images ) ) {
    $slides = explode( ',', $images );

    $output  = '<div class="img-slider">';
    $output .= '<ul class="slides">';
    foreach ( $slides as $slide ) {
      $url = ( is_numeric( $slide ) && ! empty( $slide ) ) ? wp_get_attachment_url( $slide ) : '';
      $output .= '<li><img src="' . $url . '" alt=""></li>';
    }
    $output .= '</ul>';
    $output .= '</div>';
  }

  return $output;
}
add_shortcode( 'gnoli_simple_slider', 'gnoli_simple_slider' );
