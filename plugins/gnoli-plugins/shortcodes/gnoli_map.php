<?php
/**
 *
 * Gnoli map
 * @since 1.0.0
 * @version 1.1.0
 *
 */
function gnoli_map( $atts, $content = '', $id = '' ) {
  wp_enqueue_script( 'gmaps', 'http://maps.google.com/maps/api/js?sensor=false', array( 'jquery' ), true, false );
  extract( shortcode_atts( array(
    'latitude'    => '51.5255069',
    'longitude'   => '-0.0836207',
    'marker'      => '',
    'zoom'        => '14',
    'marker_text' => '',
    't1_title'    => 'Office',
    't1_icon'     => 'pe-7s-map-2',
    't1_text1'    => 'UK, London',
    't1_text2'    => 'Paul Street 86-90',
    't2_title'    => 'Phone',
    't2_icon'     => 'pe-7s-phone',
    't2_text1'    => '+987 123 456',
    't2_text2'    => '+123 976 432',
    't3_title'    => 'Email',
    't3_icon'     => 'pe-7s-mail',
    't3_text1'    => 'mail@example.com',
    't3_text2'    => 'support@mail.com'
  ), $atts ) );

  $marker = ( is_numeric( $marker ) && ! empty( $marker ) ) ? wp_get_attachment_url( $marker ) : get_template_directory_uri() . '/assets/images/map-marker.png';
  $map_zoom = ( is_numeric( $zoom ) ) ? $zoom : 14;

  $output  = '';

  if( is_numeric( $latitude ) and is_numeric( $longitude ) ) {
    $output .= '<div id="google-map" data-string="' . $marker_text . '" data-lat="' . $latitude . '" data-lng="' . $longitude . '" data-zoom="' . $map_zoom . '" data-marker="' . $marker . '"></div>';
    $output .= '<div class="map-button" data-text="' . __( 'map', 'js-composer') . '" data-replace-text="' . __( 'info', 'js-composer') . '">' . __( 'map', 'js-composer') . '</div>';
    $output .= '<div class="contact-info text-light pad-100">';
    if ( ! empty( $t1_title ) && ( ! empty( $t1_text1 ) || ! empty( $t1_text2 ) ) ) {
      $output .= '<div class="info-box">';
      $output .= '<i class="' . $t1_icon . ' pe-4x"></i>';
      $output .= '<div class="details">';
      $output .= '<h5 class="title">' . $t1_title . '</h5>';
      $output .= '<p class="separator-left"></p>';
      $output .= ( ! empty( $t1_text1 ) ) ? '<h6>' . $t1_text1 . '</h6>' : '';
      $output .= ( ! empty( $t1_text2 ) ) ? '<h6>' . $t1_text2 . '</h6>' : '';
      $output .= '</div>';
      $output .= '</div>';
    }
    if ( ! empty( $t2_title ) && ( ! empty( $t2_text1 ) || ! empty( $t2_text2 ) ) ) {
      $output .= '<div class="info-box">';
      $output .= '<i class="' . $t2_icon . ' pe-4x"></i>';
      $output .= '<div class="details">';
      $output .= '<h5 class="title">' . $t2_title . '</h5>';
      $output .= '<p class="separator-left"></p>';
      $output .= ( ! empty( $t2_text1 ) ) ? '<h6>' . $t2_text1 . '</h6>' : '';
      $output .= ( ! empty( $t2_text2 ) ) ? '<h6>' . $t2_text2 . '</h6>' : '';
      $output .= '</div>';
      $output .= '</div>';
    }
    if ( ! empty( $t3_title ) && ( ! empty( $t3_text1 ) || ! empty( $t3_text2 ) ) ) {
      $output .= '<div class="info-box">';
      $output .= '<i class="' . $t3_icon . ' pe-4x"></i>';
      $output .= '<div class="details">';
      $output .= '<h5 class="title">' . $t3_title . '</h5>';
      $output .= '<p class="separator-left"></p>';
      $output .= ( ! empty( $t3_text1 ) ) ? '<h6>' . $t3_text1 . '</h6>' : '';
      $output .= ( ! empty( $t3_text2 ) ) ? '<h6>' . $t3_text2 . '</h6>' : '';
      $output .= '</div>';
      $output .= '</div>';
    }
    $output .= '</div>';
  }
  return $output;
}
add_shortcode( 'gnoli_map', 'gnoli_map' );
?>
