<?php
/**
 *
 * Custom banner
 * @since 1.0.0
 * @version 1.1.0
 *
 */
function gnoli_custom_banner( $atts, $content = '', $id = '' ) {

  extract( shortcode_atts( array(
    'size'      => 'h1',
    'title'     => '',
    'image'     => '',
    'link_text' => '',
    'link_url'  => ''
  ), $atts ) );

  $url = ( is_numeric( $image ) && ! empty( $image ) ) ? wp_get_attachment_url( $image ) : '';
  
  $output  = '<section class="cta text-center pad-50 text-light" style="background-image: url(' . $url . ')" data-stellar-background-ratio=".1">';
  $output .= '<div class="overlay overlay-dark-2x"></div>';
  $output .= '<' . $size . ' class="title font-banner-style">' . $title . '</' . $size . '>';
  if ( ! empty( $link_url ) && ! empty( $link_text ) ) {
    $output .= '<a href="' . $link_url . '" class="button outline light">' . $link_text . '</a>';
  }
  $output .= '</section>';

  return $output;
}
add_shortcode( 'gnoli_custom_banner', 'gnoli_custom_banner' );
