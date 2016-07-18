<?php
/**
 *
 * Accordian
 * @since 1.0.0
 * @version 1.1.0
 *
 */
function gnoli_accordian( $atts, $content = '', $id = '' ) {
  return '<div class="toggles">' . do_shortcode( $content ) . '</div>';
}
add_shortcode( 'gnoli_accordian', 'gnoli_accordian' );

function gnoli_accordian_item( $atts, $content = '', $id = '' ) {

  extract( shortcode_atts( array(
    'title'    => '',
    'expanded' => ''
  ), $atts ) );

  $expanded = ( isset( $expanded ) && $expanded == 'yes' ) ? 'active' : '';

  $output  = '<div class="toggle ' . $expanded . '">';
  $output .= '<div class="toggle-title">' . $title . '</div>';
  $output .= '<div class="toggle-content">';
  $output .= '<p>' . $content . '</p>';
  $output .= '</div>';
  $output .= '</div>';

  return $output;
}
add_shortcode( 'gnoli_accordian_item', 'gnoli_accordian_item' );
