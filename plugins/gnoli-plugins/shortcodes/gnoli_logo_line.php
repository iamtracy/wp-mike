<?php
/**
 *
 * Bodo logo slider
 * @since 1.0.0
 * @version 1.1.0
 *
 */
function gnoli_logo_line( $atts, $content = '', $id = '' ) {

  extract( shortcode_atts( array(
    'images'  => ''
  ), $atts ) );

  $output = '';
  if ( ! empty( $images ) ) {
    $slides = explode( ',', $images );

    $output  = '<section class="clients grey">';
    $output .= '<div class="container pad-top-60 pad-btm-60">';
    $output .= '<div class="row">';
    foreach ( $slides as $slide ) {
      $url = ( is_numeric( $slide ) && ! empty( $slide ) ) ? wp_get_attachment_url( $slide ) : '';
      $output .= '<div class="col-md-2 col-sm-4 col-xs-6">';
      $output .= '<img src="' . $url . '" alt="">';
      $output .= '</div>';
    }
    $output .= '</div>';
    $output .= '</div>';
    $output .= '</section>';
  }

  return $output;
}
add_shortcode( 'gnoli_logo_line', 'gnoli_logo_line' );

